<?php
namespace PingCAP\CPT;

use WPUtil\Vendor\ACF;

abstract class Testimonial
{
	/**
	 * Return the image (featured image) used by a testimonial post. The boolean
	 * false will be returned if no image has been set.
	 *
	 * @param integer $testimonial_id
	 * @return array<string, mixed>|false
	 */
	public static function getImage(int $testimonial_id)
	{
		return ACF::get_featured_image_acf_object($testimonial_id);
	}

	/**
	 * Return the testimonial post image.
	 *
	 * @param integer $testimonial_id
	 * @return array
	 */
	public static function getTestimonialImage(int $testimonial_id): array
	{
		return ACF::get_field_array('image', $testimonial_id);
	}

	/**
	 * Return the testimonial post content.
	 *
	 * @param integer $testimonial_id
	 * @return string
	 */
	public static function getTestimonial(int $testimonial_id): string
	{
		return ACF::get_field_string('testimonial', $testimonial_id);
	}

	/**
	 * Return the testimonial post attribution.
	 *
	 * @param integer $testimonial_id
	 * @return string
	 */
	public static function getAttribution(int $testimonial_id): string
	{
		return ACF::get_field_string('attribution', $testimonial_id);
	}
}
