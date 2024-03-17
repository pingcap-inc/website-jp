<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;
use PingCAP\Constants;

class AuthorBox implements IComponent
{
	/**
	 * The author (user) ID
	 *
	 * @var integer
	 */
	public int $author_id = 0;

	public string $author_name = '';

	public string $bio = '';

	public string $image_url = '';

	public bool $author_archive_mode = false;


	public function __construct(array $params)
	{
		$this->author_id = Arrays::get_value_as_int(
			$params,
			'author_id',
			fn () => get_the_author_meta('ID')
		);

		$this->author_name = Arrays::get_value_as_string(
			$params,
			'author_name',
			fn () => get_the_author_meta('display_name', $this->author_id)
		);

		$this->bio = Arrays::get_value_as_string(
			$params,
			'bio',
			fn () => get_the_author_meta('description', $this->author_id)
		);

		$this->image_url = Arrays::get_value_as_string(
			$params,
			'image_url',
			fn () => get_avatar_url($this->author_id, [
				'size' => 120
			])
		);

		$this->author_archive_mode = Arrays::get_value_as_bool(
			$params,
			'author_archive_mode',
			false
		);
	}

	public function render(): void
	{
		if ($this->author_archive_mode && !$this->bio) {
			return;
		}

		$posts_url = get_author_posts_url($this->author_id);

?>
		<div class="author-box">
			<?php if ($this->image_url) { ?>
				<img class="author-box__image" src="<?php echo esc_url($this->image_url); ?>">
			<?php } ?>
			<?php if ($posts_url && $this->author_name && !$this->author_archive_mode) { ?>
				<a class="author-box__author-name" href="<?php echo esc_url($posts_url); ?>"><?php echo esc_html($this->author_name); ?></a>
			<?php } ?>
		</div>
<?php
	}
}
