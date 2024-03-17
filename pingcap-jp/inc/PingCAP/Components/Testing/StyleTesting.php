<?php
namespace PingCAP\Components\Testing;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Component, SVG };
use PingCAP\Components;

class StyleTesting implements IComponent
{
	public function __construct(array $params)
	{
	}

	public function render(): void
	{
		?>
		<div class="style-testing__row contain wysiwyg">
			<div>
				<h4>Typography</h4>
				<hr>

				<h1>H1: Main Header Cras Justo Odio, Dapibus</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vulputate diam eu pretium. Mauris elit orci, ultricies id fermentum vel, porta et eros. Vestibulum condimentum lectus in convallis feugiat. Sed vulputate fringilla felis. Aliquam ut arcu et dui feugiat scelerisque eu quis diam. Mauris placerat congue dui sit amet blandit. Phasellus condimentum libero vel velit auctor, sit amet tincidunt velit varius.</p>

				<h2>H2: This is a subtitle morbi leo risus, porta ac consectetur ac</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vulputate diam eu pretium. Mauris elit orci, ultricies id fermentum vel, porta et eros. Vestibulum condimentum lectus in convallis feugiat. Sed vulputate fringilla felis. Aliquam ut arcu et dui feugiat scelerisque eu quis diam. Mauris placerat congue dui sit amet blandit. Phasellus condimentum libero vel velit auctor, sit amet tincidunt velit varius.</p>

				<h3>h3: This is a section title nullam id dolor id nibh ultricies vehicula ut id elit</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vulputate diam eu pretium. Mauris elit orci, ultricies id fermentum vel, porta et eros. Vestibulum condimentum lectus in convallis feugiat. Sed vulputate fringilla felis. Aliquam ut arcu et dui feugiat scelerisque eu quis diam. Mauris placerat congue dui sit amet blandit. Phasellus condimentum libero vel velit auctor, sit amet tincidunt velit varius.</p>

				<h4>h4: This is a section subtitle praesent commodo cursus magna, vel scelerisque nisl consectetur et</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vulputate diam eu pretium. Mauris elit orci, ultricies id fermentum vel, porta et eros. Vestibulum condimentum lectus in convallis feugiat. Sed vulputate fringilla felis. Aliquam ut arcu et dui feugiat scelerisque eu quis diam. Mauris placerat congue dui sit amet blandit. Phasellus condimentum libero vel velit auctor, sit amet tincidunt velit varius.</p>

				<h5>h5: This is a section subtitle morbi leo risus, porta ac consectetur ac, vestibulum at eros</h5>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vulputate diam eu pretium. Mauris elit orci, ultricies id fermentum vel, porta et eros. Vestibulum condimentum lectus in convallis feugiat. Sed vulputate fringilla felis. Aliquam ut arcu et dui feugiat scelerisque eu quis diam. Mauris placerat congue dui sit amet blandit. Phasellus condimentum libero vel velit auctor, sit amet tincidunt velit varius.</p>

				<h6>h6: This is a section subtitle Praesent commodo cursus magna, vel scelerisque nisl consectetur et cursus magna, vel scelerisque nisl</h6>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vulputate diam eu pretium. Mauris elit orci, ultricies id fermentum vel, porta et eros. Vestibulum condimentum lectus in convallis feugiat. Sed vulputate fringilla felis. Aliquam ut arcu et dui feugiat scelerisque eu quis diam. Mauris placerat congue dui sit amet blandit. Phasellus condimentum libero vel velit auctor, sit amet tincidunt velit varius.</p>

				<p><strong>strong tag: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</strong></p>

				<p><small>small tag: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</small></p>

				<p class="small">small class: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>

				<p class="large">large class: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>

				<p><pre>pre tag: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</pre></p>

				<p><code>code tag: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</code></p>
			</div>
		</div>

		<div class="style-testing__row style-testing__row--two-col contain wysiwyg">
			<div>
				<h4>Unordered List</h4>
				<hr>

				<ul>
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
					<li>Cras dapibus vulputate diam eu pretium.</li>
					<li>Mauris elit orci, ultricies id fermentum vel, porta et eros.
						<ul>
							<li>Vestibulum condimentum lectus in convallis feugiat</li>
							<li>Sed vulputate fringilla felis.</li>
						</ul>
					</li>
					<li>Aliquam ut arcu et dui feugiat scelerisque eu quis diam.</li>
				</ul>
			</div>
			<div>
				<h4>Ordered List</h4>
				<hr>

				<ol>
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
					<li>Cras dapibus vulputate diam eu pretium.</li>
					<li>Mauris elit orci, ultricies id fermentum vel, porta et eros.
						<ol>
							<li>Vestibulum condimentum lectus in convallis feugiat</li>
							<li>Sed vulputate fringilla felis.</li>
						</ol>
					</li>
					<li>Aliquam ut arcu et dui feugiat scelerisque eu quis diam.</li>
				</ol>
			</div>
		</div>

		<div class="style-testing__row style-testing__row--two-col contain wysiwyg">
			<div>
				<h4>Buttons (primary)</h4>
				<hr>

				<div class="style-testing__buttons-container">
					<a href="#" class="button">Button</a>
					<a href="#" class="button active">Button (active)</a>
					<a href="#" class="button disabled" disabled>Button (disabled)</a>
				</div>
			</div>
			<div>
				<h4>Buttons (secondary)</h4>
				<hr>

				<div class="style-testing__buttons-container">
					<a href="#" class="button button--secondary">Button</a>
					<a href="#" class="button button--secondary active">Button (active)</a>
					<a href="#" class="button button--secondary disabled" disabled>Button (disabled)</a>
				</div>
			</div>
		</div>

		<div class="style-testing__row style-testing__row--two-col contain wysiwyg">
			<div>
				<h4>Buttons Slim (primary)</h4>
				<hr>

				<div class="style-testing__buttons-container">
					<?php
					Component::render(Components\UI\Button::class, [
						'link' => '#',
						'text' => 'Button',
						'style' => 'button--slim'
					]);

					Component::render(Components\UI\Button::class, [
						'link' => '#',
						'text' => 'Button (active)',
						'style' => 'button--slim',
						'additional_classes' => ['active']
					]);
					?>
					<a href="#" class="button button--slim disabled" disabled>Button (disabled)</a>
				</div>
			</div>
			<div>
				<h4>Buttons Large (primary)</h4>
				<hr>

				<div class="style-testing__buttons-container">
					<?php
					Component::render(Components\UI\Button::class, [
						'link' => '#',
						'text' => 'Button',
						'style' => 'button--large'
					]);

					Component::render(Components\UI\Button::class, [
						'link' => '#',
						'text' => 'Button (active)',
						'style' => 'button--large',
						'additional_classes' => ['active']
					]);
					?>
					<a href="#" class="button button--large disabled" disabled>Button (disabled)</a>
				</div>
			</div>
		</div>

		<div class="style-testing__row contain wysiwyg">
			<div>
				<h4>Links</h4>
				<hr>

				<p>Lorem ipsum, <a href="#">dolor sit amet</a> consectetur adipisicing elit. <a href="#">Aliquid quidem quos asperiores</a> facere maxime beatae tenetur soluta voluptatem delectus <a href="#">tempora</a>!</p>
			</div>
		</div>

		<div class="style-testing__row style-testing__row--two-col contain wysiwyg">
			<div>
				<h4>Blockquote (WYSIWYG)</h4>
				<hr>

				<blockquote>
					<p>Ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vulputate diam eu pretium. Mauris elit orci.</p>
					<cite>Citation</cite>
				</blockquote>
			</div>
			<div>
				<h4>Blockquote (Testimonial)</h4>
				<hr>

				<?php
				Component::render(Components\Testimonial::class, [
					'content' => 'Ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus vulputate diam eu pretium. Mauris elit orci.',
					'attribution' => 'Citation'
				]);
				?>
			</div>
		</div>

		<div class="style-testing__row contain wysiwyg">
			<div>
				<h4>Table</h4>
				<hr>

				<table>
					<thead>
						<tr>
							<th>th - Consectetur</th>
							<th>Lorem ipsum dolor</th>
							<th>Consectetur adipiscing elit</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>td - Praesent commodo</td>
							<td>Sit amet consectetur</td>
							<td>Ut nec volutpat sem, sed eleifend tellus</td>
						</tr>
						<tr>
							<td>Magna vel scelerisque nisl</td>
							<td>Adipiscing elit</td>
							<td>Suspendisse sit amet orci hendrerit, scelerisque leo eu</td>
						</tr>
						<tr>
							<td>Consectetur et</td>
							<td>Integer posuere</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit</td>
						</tr>
						<tr>
							<td>Fusce dapibus tellus</td>
							<td>Dapibus posuere velit</td>
							<td>Integer posuere erat a ante venenatis dapibus posuere velit aliquet</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="style-testing__row style-testing__row--two-col contain wysiwyg">
			<div>
				<h4>Text Inputs</h4>
				<hr>

				<div class="style-testing__form-fields-container">
					<input type="text" placeholder="Placeholder">
					<input type="text" placeholder="Disabled" disabled>
				</div>
			</div>
			<div>
				<h4>Select</h4>
				<hr>

				<div class="style-testing__form-fields-container">
					<select>
						<option value="">Option 1</option>
						<option value="">Option 2</option>
						<option value="">Option 3</option>
					</select>

					<select disabled>
						<option value="">Option 1 (disabled)</option>
						<option value="">Option 2 (disabled)</option>
						<option value="">Option 3 (disabled)</option>
					</select>
				</div>
			</div>
		</div>

		<div class="style-testing__row style-testing__row--two-col contain wysiwyg">
			<div>
				<h4>Checkbox</h4>
				<hr>

				<div class="style-testing__form-fields-container">
					<div>
						<?php $check_id = uniqid(); ?>
						<input type="checkbox" name="<?php echo esc_attr($check_id); ?>" id="<?php echo esc_attr($check_id); ?>">
						<label for="<?php echo esc_attr($check_id); ?>">Checkbox (unchecked)</label>
					</div>
					<div>
						<?php $check_id = uniqid(); ?>
						<input type="checkbox" name="<?php echo esc_attr($check_id); ?>" id="<?php echo esc_attr($check_id); ?>" checked>
						<label for="<?php echo esc_attr($check_id); ?>">Checkbox (checked)</label>
					</div>
					<div>
						<?php $check_id = uniqid(); ?>
						<input type="checkbox" name="<?php echo esc_attr($check_id); ?>" id="<?php echo esc_attr($check_id); ?>" disabled>
						<label for="<?php echo esc_attr($check_id); ?>">Checkbox (disabled)</label>
					</div>
				</div>
			</div>
			<div>
				<h4>Radio Button</h4>
				<hr>

				<div class="style-testing__form-fields-container">
					<div>
						<?php $radio_id = uniqid(); ?>
						<input type="Radio" name="<?php echo esc_attr($radio_id); ?>" id="<?php echo esc_attr($radio_id); ?>_1">
						<label for="<?php echo esc_attr($radio_id); ?>_1">Radio (unchecked)</label>
					</div>
					<div>
						<input type="Radio" name="<?php echo esc_attr($radio_id); ?>" id="<?php echo esc_attr($radio_id); ?>_2" checked>
						<label for="<?php echo esc_attr($radio_id); ?>_2">Radio (checked)</label>
					</div>
					<div>
						<input type="Radio" name="<?php echo esc_attr($radio_id); ?>" id="<?php echo esc_attr($radio_id); ?>_3" disabled>
						<label for="<?php echo esc_attr($radio_id); ?>_3">Radio (disabled)</label>
					</div>
				</div>
			</div>
		</div>

		<div class="style-testing__row contain wysiwyg">
			<div>
				<h4>Textarea</h4>
				<hr>

				<textarea cols="30" rows="10">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</textarea>
			</div>
		</div>

		<div class="style-testing__row contain wysiwyg">
			<div>
				<h4>Input with Icon</h4>
				<hr>

				<?php
				Component::render(Components\UI\InputWithIcon::class);
				?>
			</div>
		</div>

		<?php
		$icons = SVG::get_svg_list();

		if ($icons)
		{
			?>
			<div class="style-testing__row contain">
				<div>
					<h4>Icons</h4>
					<hr>

					<div class="style-testing__icon-container">
						<?php
						foreach ($icons as $icon)
						{
							?>
							<div class="style-testing__icon-row">
								<?php
								SVG::the_svg($icon['name'], [
									'class' => 'style-testing__icon'
								]);
								?>
								<span class="style-testing__icon-name">
									<?php echo esc_html($icon['name']); ?>
								</span>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
