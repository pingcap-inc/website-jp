<?php
// set JPEG compression quality
add_filter('jpeg_quality', function () {
	return 75;
});

add_filter('algolia_post_images_sizes', function () {
	return [
		'hero',
	];
}, 10, 2);

// enable media library support for SVGs
WPUtil\Media::add_upload_mime_types([
	'svg' => 'image/svg+xml'
]);

// enable post thumbnail support
WPUtil\ThemeSupport::post_thumbnails(300, 300, true);

// set image sizes
// WPUtil\ThemeSupport::image_sizes([
// 	'small' => [
// 		'width' => 300,
// 		'height' => 300,
// 		'crop' => false
// 	],
// 	'xlarge' => [
// 		'width' => 1440,
// 		'height' => 1900,
// 		'crop' => false
// 	]
// ]);

// Disable automatic image resizing for large images (especially GIFs)
add_filter('big_image_size_threshold', '__return_false');

/**
 * Skip thumbnail generation for GIF files to avoid memory issues
 * during animated GIF processing (Imagick often fails on large GIFs)
 */
add_filter('intermediate_image_sizes_advanced', function($sizes, $metadata) {
    if (isset($metadata['file']) && preg_match('/\.gif$/i', $metadata['file'])) {
        return []; // Remove all intermediate sizes for GIFs
    }
    return $sizes;
}, 10, 2);

/**
 * Prefer GD image editor over Imagick.
 * GD does not try to process animated GIF frames individually,
 * which helps avoid failures or corrupted uploads.
 */
add_filter('wp_image_editors', function($editors) {
    return ['WP_Image_Editor_GD', 'WP_Image_Editor_Imagick'];
});

/**
 * Prevent WP Offload Media from uploading intermediate sizes of GIFs.
 * (Optional: Only needed if thumbnails still show up in S3)
 */
add_filter('as3cf_pre_filter_attachment_metadata', function($data, $attachment_id) {
    $file = get_attached_file($attachment_id);
    if (preg_match('/\.gif$/i', $file)) {
        if (isset($data['sizes'])) {
            unset($data['sizes']); // Remove resized versions before offload
        }
    }
    return $data;
}, 10, 2);

// add ImageBuddy 'data-ib-sources' values to background images
add_filter('grav_blocks_background_image_attributes', function ($bg_image_attrs, $block_attrs, $acf_image_object) {
	$bg_image_attrs['style'] = 'background-image: url(data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==);';
	$bg_image_attrs['data-bg'] = $acf_image_object['url'];
	$bg_image_attrs['class'] = array_merge($block_attrs['class'], array('lazy'));

	return $bg_image_attrs;
}, 10, 3);

// add ImageBuddy 'data-ib-sources' values to images
add_filter('grav_blocks_image_tag', function ($default_markup, $tag, $attributes, $acf_image_object) {
	if ($tag !== 'img') {
		return $default_markup;
	}

	if (isset($attributes['data-lazy-ignore'])) {
		$attributes['src'] = $acf_image_object['url'];
	} else {
		$attributes['src'] = '"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAAABCAQAAACC0sM2AAAADElEQVR42mNkGCYAAAGSAAIVQ4IOAAAAAElFTkSuQmCC"'; // 100x1
		$attributes['data-src'] = $acf_image_object['url'];
		$attributes['class'] = '"lazy ' . str_replace('"', '', $attributes['class'] ?? '') . '"';
	}

	$attributes['title'] = '""';

	// check for elements specific image instances by classname
	if (isset($attributes['class'])) {
		$classnames = explode(' ', str_replace('"', '', $attributes['class']));

		if (in_array('block-cta__column-icon-image', $classnames, true)) {
			// use a 1x1 transparent PNG for this image class to prevent y-axis overflow issues
			$attributes['src'] = '"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="';
		}
	}

	$attributes_str = trim(urldecode(http_build_query($attributes, '', ' ')));

	return "<img {$attributes_str} />";
}, 10, 4);

// add ImageBuddy 'data-ib-sources' values to ACF wysiwyg fields when they are loaded
add_filter('acf/load_value/type=wysiwyg', function ($value, $post_id, $field) {
	if (!is_string($value)) {
		return '';
	}

	return is_admin() ? $value : \WPUtil\Images::replace_content_with_ib_images($value);
}, 10, 3);

// add ImageBuddy 'data-ib-sources' values to post content when it is loaded
add_filter('the_content', function ($content) {
	if (!is_string($content)) {
		return '';
	}

	return is_admin() ? $content : \WPUtil\Images::replace_content_with_ib_images($content);
});

// FUNCTION FOR UPDATING UPLOADS CDN URL
function grav_update_postmeta_with_s3($bucket = '', $region = '', $overwrite = false)
{
	global $wpdb;

	if ($bucket) {
		$meta_values = $wpdb->get_results("SELECT * FROM " . $wpdb->postmeta . " WHERE meta_key = '_wp_attached_file'");

		if (!empty($meta_values)) {
			foreach ($meta_values as $meta) {
				if (!empty($meta->post_id)) {
					if ($overwrite || !get_post_meta($meta->post_id, 'amazonS3_info', true)) // If does not currently have amazonS3_info then add it
					{
						update_post_meta($meta->post_id, 'amazonS3_info', array('bucket' => $bucket, 'key' => '' . $meta->meta_value, $region));
						echo 'Updated ' . $meta->meta_value . ' from the S3 Bucket<br>';
					}
				}
			}
		}
	}
}

// grav_update_postmeta_with_s3('uploads.pingcap.com','us-west-2',true);