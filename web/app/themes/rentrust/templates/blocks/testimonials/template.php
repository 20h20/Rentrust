<?php
	$title = get_field('testimonials_title');
?>

<section class="cbo-testimonials">
	<div class="testimonials-inner cbo-container container--padding container--nomargin">

		<?php if ($title): ?>
			<div class="testimonials-title cbo-title-2 slide-up">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<?php
			if (have_rows('testimonials_tabs')):
		?>
			<div class="testimonials-tabs cbo-tabs">

				<div class="tabs-filter">
					<ul class="filter-list slide-up" role="tablist">
						<?php
							$i = 0;
							while (have_rows('testimonials_tabs')): the_row();
							$tabtxt = get_sub_field('tab_txt');
							$tab_id = 'tab-' . $i;
						?>
							<li class="list-el" role="presentation">
								<button
									class="filter-btn <?php echo $i === 0 ? 'is-active' : ''; ?>"
									id="<?php echo esc_attr($tab_id); ?>"
									role="tab"
									aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
									aria-controls="panel-<?php echo esc_attr($tab_id); ?>"
									tabindex="<?php echo $i === 0 ? '0' : '-1'; ?>"
									data-tab="<?php echo esc_attr($tab_id); ?>"
								>
									<?php echo esc_html($tabtxt); ?>
								</button>
							</li>
						<?php
							$i++;
							endwhile;
						?>
					</ul>
				</div>

				<div class="tabs-content">
					<?php
						$i = 0;
						while (have_rows('testimonials_tabs')): the_row();
						$tab_id = 'tab-' . $i;
						$active_panel = $i === 0 ? 'panel--active' : '';
						$posts = get_sub_field('testimonial_list');
					?>
						<div
							id="panel-<?php echo esc_attr($tab_id); ?>"
							class="testimonials-list content-panel <?php echo esc_attr($active_panel); ?>"
							role="tabpanel"
							aria-labelledby="<?php echo esc_attr($tab_id); ?>"
						>
							<?php
								if ($posts && is_array($posts)):
									global $post;
									$original_post = $post;
									foreach ($posts as $post_item):
										if ($post_item instanceof WP_Post) {
											$post = $post_item;
											setup_postdata($post);
											get_part('testimonial/template');
										}
									endforeach;
									wp_reset_postdata();
									$post = $original_post;
								else:
									echo '<p>Aucun témoignage pour cet onglet.</p>';
								endif;
							?>
						</div>
					<?php
					$i++;
						endwhile;
					?>
				</div>
			</div>
		<?php endif; ?>
    </div>
</section>