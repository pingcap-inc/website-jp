<?php
namespace PingCAP\Components\UI;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, SVG };
use PingCAP\Models\AccordionSection;

class Accordion implements IComponent
{
	/**
	 * The accordion sections; each item must be an instance of \PingCAP\Models\AccordionSection
	 *
	 * @var array<\PingCAP\Models\AccordionSection>
	 */
	public array $sections = [];

	/**
	 * The accordion container classes
	 *
	 * @var array<string>
	 */
	public array $container_classes = ['accordion'];

	/**
	 * The accordion section classes
	 *
	 * @var array<string>
	 */
	public array $section_classes = ['accordion__section'];

	/**
	 * Flag indicating that content sections should use the "wysiwyg" class
	 *
	 * @var boolean
	 */
	public bool $content_use_wysiwyg_class = true;

	/**
	 * Flag indicating that multiple sections can be open simultaneously
	 *
	 * @var boolean
	 */
	public bool $allow_multiple_open = true;

	/**
	 * Flag indicating that the first section should be open by default
	 *
	 * @var boolean
	 */
	public bool $open_first_section = false;

	/**
	 * The type of tag that will will be used for the section title text
	 *
	 * @var string
	 */
	public string $title_text_tag = 'h5';


	public function __construct(array $params)
	{
		$this->sections = Arrays::get_value_as_array($params, 'sections');
		$this->container_classes = array_merge(
			$this->container_classes,
			Arrays::get_value_as_array($params, 'add_container_classes')
		);
		$this->section_classes = array_merge(
			$this->section_classes,
			Arrays::get_value_as_array($params, 'add_section_classes')
		);
		$this->content_use_wysiwyg_class = Arrays::get_value_as_bool($params, 'content_use_wysiwyg_class', true);
		$this->allow_multiple_open = Arrays::get_value_as_bool($params, 'allow_multiple_open', true);
		$this->open_first_section = Arrays::get_value_as_bool($params, 'open_first_section', true);
		$this->title_text_tag = Arrays::get_value_as_string($params, 'title_text_tag', 'span');
	}

	public function render(): void
	{
		if (!$this->sections) {
			return;
		}

		$field_id = uniqid('accordion_');

		?>
		<div class="<?php echo esc_attr(implode(' ', $this->container_classes)); ?>">
			<?php
			foreach ($this->sections as $index => $section) {
				if (!($section instanceof AccordionSection)) {
					continue;
				}

				$section_id = $field_id . '_' . $index;
				$content_inner_classes = ['accordion__section-content-inner'];

				if ($this->content_use_wysiwyg_class) {
					$content_inner_classes[] = 'wysiwyg';
				}

				?>
				<div class="<?php echo esc_attr(implode(' ', $this->section_classes)); ?>">
					<input
						style="display: none;"
						type="<?php echo $this->allow_multiple_open ? 'checkbox' : 'radio'; ?>"
						name="<?php echo esc_attr($field_id); ?>"
						id="<?php echo esc_attr($section_id); ?>"
						class="accordion__section-title-input"
						<?php if ($index === 0 && $this->open_first_section) { ?>checked<?php } ?>
					>
					<label class="accordion__section-title" for="<?php echo esc_attr($section_id); ?>">
						<span class="accordion__plus-icon"></span>
						<<?php echo esc_attr($this->title_text_tag); ?> class="accordion__section-title-text">
							<?php echo esc_html($section->title ?? ''); ?>
						</<?php echo esc_attr($this->title_text_tag); ?>>
					</label>
					<div class="accordion__section-content">
						<div class="<?php echo esc_attr(implode(' ', $content_inner_classes)); ?>">
							<?php echo wp_kses_post($section->content ?? ''); ?>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
}
