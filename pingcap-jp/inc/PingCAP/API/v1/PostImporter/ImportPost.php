<?php
namespace PingCAP\API\v1\PostImporter;

use Blueprint\WPHooks;
use PingCAP\Constants;
use WP_Error;
use WP_REST_Response;
use Exception;
use DOMDocument;

class ImportPost
{
	public array $errors = [];
	public bool $hash_check_skip = false;


	public function __construct(string $namespace, string $url)
	{
		register_rest_route($namespace, $url, [
			[
				'methods' => 'POST',
				'callback' => [&$this, 'importPost'],
				'permission_callback' => function () {
					$user = wp_get_current_user();

					return in_array('administrator', $user->roles, true);
				},
				'args' => [],
			]
		]);
	}

	public function importPost($req)
	{
		$this->errors = [];

		// ensure that valid JSON has been sent in the request body
		$post_data_json = trim($req->get_body());

		if (!$post_data_json) {
			return new WP_Error('no-data', 'No post data received');
		}

		$post_data = json_decode($post_data_json, true);

		if (!$post_data) {
			return new WP_Error('invalid-json', 'Post data is not valid JSON');
		}

		// begin import process
		$post_id = 0;

		try {
			$existing_post_id = 0;

			if (isset($post_data['fileRefHash'])) {
				$existing_post_id = $this->getPostIdForMetaRecord('_existing_import_hash', $post_data['fileRefHash']);
			}

			if ($existing_post_id) {
				$post_id = $existing_post_id;

				$this->hash_check_skip = true;
			} else {
				$this->validatePostData($post_data);

				$is_case_study = isset($post_data['customer']) && trim($post_data['customer']);

				$post_id = $this->upsertPost($post_data['fileRef'], [
					'post_date' => $post_data['date'],
					'post_date_gmt' => $post_data['date'],
					'post_content' => wpautop($post_data['htmlContent']),
					'post_title' => $post_data['title'],
					'post_excerpt' => $post_data['excerpt'] ?? '',
					'post_status' => 'publish',
					'post_type' => $is_case_study ? Constants\CPT::CASE_STUDY : Constants\CPT::BLOG,
					'comment_status' => 'closed',
					'ping_status' => 'closed',
					'post_name' => sanitize_title(basename($post_data['fileRef'], '.md'))
				]);

				// parse the post content, import the images referenced, and update their img src URLs
				$this->updateContentImages($post_id, $post_data['htmlContent'], $post_data['featuredImageURL'] ?? '');

				if ($is_case_study && isset($post_data['customerCategory'])) {
					// assign the "industry" term if this is a case study with a valid customer category
					$this->assignCategoriesToPost($post_id, [$post_data['customerCategory']], Constants\Taxonomies::INDUSTRY);
				} elseif (is_array($post_data['categories'])) {
					// assign the category terms
					$this->assignCategoriesToPost($post_id, $post_data['categories']);
				}

				// assign the tags
				if (is_array($post_data['tags'])) {
					$this->assignTagsToPost($post_id, $post_data['tags']);
				}

				// assign the featured image
				if (is_string($post_data['featuredImageURL']) && $post_data['featuredImageURL']) {
					$this->setPostFeaturedImage($post_id, $post_data['featuredImageURL']);
				}

				// assign the author(s)
				if (isset($post_data['authors']) && is_array($post_data['authors'])) {
					$this->setPostAuthors($post_id, $post_data['authors']);
				}

				// create/update customer post data if this is a case study
				if ($is_case_study) {
					$customer_term_id = $this->setupCustomerDataForPost(
						$post_id,
						$post_data['customer'],
						$post_data['customerCategory'],
						$post_data['customerLogoURL']
					);

					if (!$customer_term_id) {
						$this->errors[] = 'Unable to create/update the customer term';
					}
				}

				// press releases aren't differentiated from other blog posts on the current site
				if (isset($post_data['isPressRelease']) && $post_data['isPressRelease'] && function_exists('update_field')) {
					update_field('press_release', '1', $post_id);
				}

				if (isset($post_data['fileRefHash'])) {
					update_post_meta($post_id, '_existing_import_hash', $post_data['fileRefHash']);
				}
			}
		} catch (Exception $e) {
			return new WP_Error('error', $e->getMessage());
		}

		// send the response
		$res = new WP_REST_Response([
			'post_id' => $post_id,
			'errors' => $this->errors,
			'hash_check_skip' => $this->hash_check_skip
		]);

		// phpcs:ignore
		$res->header('Access-Control-Allow-Origin', apply_filters(WPHooks::FILTER_REST_API_ACCESS_CONTROL_ALLOW_ORIGIN, '*', $req->get_route()));

		return $res;
	}

	protected function setPostAuthors(int $post_id, array $authors)
	{
		$author_ids = [];

		foreach ($authors as $author) {
			$user_id = $this->upsertUser($author);

			if ($user_id) {
				$author_ids[] = $user_id;
			} else {
				$this->errors[] = 'Unable to create/retrieve user: ' . $author;
			}
		}

		// assign primary (first) author to this post
		if (isset($author_ids[0])) {
			wp_update_post([
				'ID' => $post_id,
				'post_author' => $author_ids[0]
			]);
		}


		if (count($author_ids) > 1) {
			$extra_author_ids = array_slice($author_ids, 1);

			// NOTE: ACF wants to see the author id values as strings
			$author_ids_as_strings = array_map(
				fn ($author_id) => strval($author_id),
				$extra_author_ids
			);

			if (function_exists('update_field')) {
				update_field('additional_authors', $author_ids_as_strings, $post_id);
			}
		}
	}

	protected function upsertUser(string $name): int
	{
		$username = sanitize_title($name);

		$existing_user = get_user_by('login', $username);
		$user_id = 0;

		if ($existing_user) {
			$user_id = $existing_user->ID;
		} else {
			$new_user_id = wp_insert_user([
				'user_pass' => uniqid(),
				'user_login' => $username,
				'display_name' => $name,
				'role' => 'contributor'
			]);

			if (!is_wp_error($new_user_id)) {
				$user_id = $new_user_id;
			}
		}

		return $user_id;
	}

	protected function setupCustomerDataForPost(int $case_study_post_id, string $customer_name, string $customer_category, string $customer_logo_url): int
	{
		// create the customer taxonomy term if needed
		$customer_term_id = $this->upsertCustomerTerm($customer_name);

		if (!$customer_term_id) {
			$this->errors[] = 'unable to setup customer data due to invalid customer term id';
			return 0;
		}

		// assign the customer term to the case study post
		$assign_term_res = wp_set_object_terms($case_study_post_id, $customer_term_id, Constants\Taxonomies::CUSTOMER);

		if (is_wp_error($assign_term_res)) {
			$this->errors[] = 'customer term assignment error: ' . $assign_term_res->get_error_message();
		}

		// set the customer term logo
		if ($customer_logo_url) {
			$attachment_id = $this->setCustomerTermImage(
				$customer_term_id,
				str_ireplace('/images/blog/', '', $customer_logo_url),
				false
			);

			if (!$attachment_id) {
				$this->errors[] = 'Unable to set customer term image';
			}
		}

		return $customer_term_id;
	}

	protected function validatePostData(array $post_data)
	{
		$must_exist = ['fileRef', 'title', 'date', 'htmlContent'];

		foreach ($must_exist as $param_name) {
			if (!isset($post_data[$param_name]) || !$post_data[$param_name]) {
				throw new Exception($param_name . ' parameter missing');
			}
		}
	}

	protected function requireWPMediaFunctions()
	{
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';
	}

	protected function updateContentImages(int $post_id, string $post_content, string $featured_image_ref = '')
	{
		// create a DOMDocument object to parse the post content
		$dom = new DOMDocument();

		// NOTE: The markup generated from the source markdown files will likely
		// not have a root element. We give the content a temporary root element
		// here (<div>) so that it is parsed correctly by DOMDocument.
		//
		// mb_convert_encoding is used to convert characters such as "ü" to "&uuml;"
		// so that they loaded incorrectly by DOMDocument.
		$load_content = mb_convert_encoding('<div>' . $post_content . '</div>', 'HTML-ENTITIES', 'UTF-8');
		$dom->loadHTML($load_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOBLANKS);

		$img_tags = $dom->getElementsByTagName('img');

		// leave if no img tags were found
		if (!count($img_tags)) {
			return;
		}

		// loop through each img tag
		foreach ($img_tags as $img) {
			// create the import URL from the "src" attribute and import the image
			$src_attr = $img->getAttribute('src');

			if (stripos($src_attr, 'media/') === 0) {
				$url = 'https://raw.githubusercontent.com/pingcap/blog/master/' . $src_attr;
			} else {
				$url = $src_attr;
			}

			// remove this img node if it is also the featured image
			if ($featured_image_ref && basename($featured_image_ref) === basename($src_attr)) {
				$img->parentNode->removeChild($img);
				continue;
			}

			$attachment_id = $this->importImageFromURL($url, $post_id);

			// process if the import was successful and we have an attachment id
			if ($attachment_id) {
				// add the "wp-image-#" class
				$classnames = explode(' ', $img->getAttribute('class'));
				$classnames[] = 'wp-image-' . $attachment_id;

				$img->setAttribute('class', trim(implode(' ', $classnames)));

				// get the attachment URL and update the "src" attribute
				$attachment_url = wp_get_attachment_image_url($attachment_id, 'full');

				if ($attachment_url) {
					$img->setAttribute('src', $attachment_url);
				}
			}
		}

		// remove any empty <p> tags left behind by the featured image removal
		foreach ($dom->firstChild->childNodes as $child_node) {
			if ($child_node->nodeName === 'p' && trim($child_node->nodeValue) === '') {
				$child_node->parentNode->removeChild($child_node);
			}
		}

		// render the update post content
		$updated_content = $dom->saveHTML();

		// remove the temporary root element markup (<div> and </div>)
		$updated_content = substr($updated_content, 5, strlen($updated_content) - 12);

		// normalize any empty lines left over from the empty <p> tag removal above
		$updated_content = wpautop($updated_content);

		// update the post
		$update_res = wp_update_post([
			'ID' => $post_id,
			'post_content' => $updated_content
		], true);

		if (is_wp_error($update_res)) {
			$this->errors[] = 'unable to update post content with new image URLs: ' . $update_res->get_error_message();
		}
	}

	protected function importImageFromURL(string $url, int $post_id = 0, bool $check_existing = true): int
	{
		if ($check_existing) {
			$existing_attachment_id = $this->getPostIdForMetaRecord('_import_image_url', $url);

			if ($existing_attachment_id) {
				return $existing_attachment_id;
			}
		}

		$this->requireWPMediaFunctions();

		// import image and create a new attachment id
		$attachment_id = media_sideload_image($url, $post_id, basename(parse_url($url, PHP_URL_PATH)), 'id');

		if (is_wp_error($attachment_id)) {
			$errors = array_map(
				function ($error_msg) use ($url) {
					return $error_msg . ' (' . $url . ')';
				},
				$attachment_id->get_error_messages()
			);

			$this->errors = array_merge($this->errors, $errors);

			return 0;
		}

		if (!$attachment_id) {
			$this->errors[] = 'invalid attachment id for imported image: ' . $url;

			return 0;
		}

		update_post_meta($attachment_id, '_import_image_url', $url);

		return $attachment_id;
	}

	protected function setPostFeaturedImage(int $post_id, string $image_filename, bool $use_basename = true)
	{
		$image_url = $image_filename;

		if (
			stripos($image_filename, 'http://') === false &&
			stripos($image_filename, 'https://') === false
		) {
			$image_url = 'https://raw.githubusercontent.com/pingcap/blog/master/media/';
			$image_url .= $use_basename ? basename($image_filename) : $image_filename;
		}

		$featured_image_id = $this->importImageFromURL($image_url, $post_id);

		if ($featured_image_id) {
			set_post_thumbnail($post_id, $featured_image_id);
		}

		return $featured_image_id;
	}

	protected function setCustomerTermImage(int $term_id, string $image_filename, bool $use_basename = true)
	{
		$image_url = $image_filename;

		if (
			stripos($image_filename, 'http://') === false &&
			stripos($image_filename, 'https://') === false
		) {
			$image_url = 'https://raw.githubusercontent.com/pingcap/blog/master/media/';
			$image_url .= $use_basename ? basename($image_filename) : $image_filename;
		}

		$attachment_id = $this->importImageFromURL($image_url);

		if ($attachment_id) {
			update_field('logo', $attachment_id, 'term_' . $term_id);
		}

		return $attachment_id;
	}

	protected function getPostIdForMetaRecord(string $meta_key, $meta_value): int
	{
		global $wpdb;

		$post_id = 0;

		$q = $wpdb->prepare("SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = %s AND meta_value = %s", $meta_key, $meta_value);
		$row = $wpdb->get_row($q); // phpcs:ignore

		if ($row !== null && property_exists($row, 'post_id')) {
			$post_id = (int)$row->post_id;
		}

		return $post_id;
	}

	protected function getTermIdForMetaRecord(string $meta_key, $meta_value): int
	{
		global $wpdb;

		$term_id = 0;

		$q = $wpdb->prepare("SELECT term_id FROM {$wpdb->termmeta} WHERE meta_key = %s AND meta_value = %s", $meta_key, $meta_value);
		$row = $wpdb->get_row($q); // phpcs:ignore

		if ($row !== null && property_exists($row, 'term_id')) {
			$term_id = (int)$row->term_id;
		}

		return $term_id;
	}

	protected function upsertPost(string $import_file_ref, array $params): int
	{
		$return_post_id = 0;
		$existing_post_id = $this->getPostIdForMetaRecord('_import_file_ref', $import_file_ref);

		if ($existing_post_id) {
			// update
			$return_post_id = wp_update_post(array_merge($params, ['ID' => $existing_post_id]), true);

			if (is_wp_error($return_post_id)) {
				throw new Exception('error-updating-post', $return_post_id->get_error_message());
			}
		} else {
			// insert
			$return_post_id = wp_insert_post($params, true);

			if (is_wp_error($return_post_id)) {
				throw new Exception('error-creating-post', $return_post_id->get_error_message());
			}

			if ($return_post_id) {
				update_post_meta($return_post_id, '_import_file_ref', $import_file_ref);
			}
		}

		return $return_post_id;
	}

	protected function assignCategoriesToPost(int $post_id, array $cats = [], string $tax_slug = Constants\Taxonomies::BLOG_CATEGORY)
	{
		$res = wp_set_object_terms($post_id, $cats, $tax_slug);

		if (is_wp_error($res)) {
			$this->errors[] = 'category/industry assignment error: ' . $res->get_error_message();
		}
	}

	protected function assignTagsToPost(int $post_id, array $tags = [])
	{
		$res = wp_set_object_terms($post_id, $tags, Constants\Taxonomies::BLOG_TAG);

		if (is_wp_error($res)) {
			$this->errors[] = 'tag assignment error: ' . $res->get_error_message();
		}
	}

	protected function upsertCustomerTerm(string $customer_name, array $params = []): int
	{
		$return_term_id = 0;
		$existing_term_id = $this->getTermIdForMetaRecord('_import_customer_name', $customer_name);

		if ($existing_term_id) {
			// update
			$update_res = wp_update_term($existing_term_id, Constants\Taxonomies::CUSTOMER, $params);

			if (is_wp_error($update_res)) {
				$this->errors[] = 'error updating customer term: ' . $update_res->get_error_message();
			} else {
				$return_term_id = $update_res['term_id'];
			}
		} else {
			// insert
			$insert_res = wp_insert_term($customer_name, Constants\Taxonomies::CUSTOMER, $params);

			if (is_wp_error($insert_res)) {
				$this->errors[] = 'error creating customer term: ' . $insert_res->get_error_message();
			} else {
				$return_term_id = $insert_res['term_id'];
			}

			if ($return_term_id) {
				update_term_meta($return_term_id, '_import_customer_name', $customer_name);
			}
		}

		return $return_term_id;
	}
}
