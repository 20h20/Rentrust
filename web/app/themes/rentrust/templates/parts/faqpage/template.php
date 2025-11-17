<?php
    $phone	= get_field('global_phone', 'option');
    $mail	= get_field('global_mail', 'option');
?>

<section class="cbo-accordion" itemscope itemtype="https://schema.org/FAQPage">
	<div class="accordion-inner cbo-container container--medium">
		<?php
			$parent_terms = get_terms([
				'taxonomy'   => 'faq_cat',
				'parent'     => 0,
				'hide_empty' => true,
				'orderby'    => 'name',
				'order'      => 'ASC',
			]);

			if (!empty($parent_terms) && !is_wp_error($parent_terms)) :
		?>
			<div class="cbo-tabs">
				<div class="tabs-filter slide-up">
					<ul class="filter-list" role="tablist">
						<?php
							$first = true;
							foreach ($parent_terms as $index => $parent) :
						?>
							<li class="list-el" role="presentation">
								<button
									class="filter-btn <?php echo $first ? 'is-active' : ''; ?>"
									id="tab-<?php echo esc_attr($parent->slug); ?>"
									role="tab"
									aria-selected="<?php echo $first ? 'true' : 'false'; ?>"
									aria-controls="panel-<?php echo esc_attr($parent->slug); ?>"
									tabindex="<?php echo $first ? '0' : '-1'; ?>"
									data-term="<?php echo esc_attr($parent->slug); ?>"
								>
									<?php echo esc_html($parent->name); ?>
								</button>
							</li>
						<?php
							$first = false;
							endforeach;
						?>
					</ul>
				</div>

				<div class="tabs-content">
					<?php
						foreach ($parent_terms as $index => $parent) :
					?>
						<div
							class="content-panel <?php echo $index === 0 ? 'panel--active' : ''; ?>"
							id="panel-<?php echo esc_attr($parent->slug); ?>"
							role="tabpanel"
							aria-labelledby="tab-<?php echo esc_attr($parent->slug); ?>"
							<?php echo $first ? '' : 'hidden'; ?>
							data-term="<?php echo esc_attr($parent->slug); ?>"
						>
							<?php
								$child_terms = get_terms([
									'taxonomy'   => 'faq_cat',
									'parent'     => $parent->term_id,
									'hide_empty' => true,
									'orderby'    => 'name',
									'order'	=> 'ASC',
								]);
								if (!empty($child_terms)) :
							?>
								<div class="cbo-summary">
									<div class="summary-inner">
										<div class="cbo-search cbo-form slide-up">
											<form id="search-form" class="search-form" action="#" method="get">
												<input 
													type="search" 
													id="search-field" 
													class="search-field" 
													placeholder="Rechercher dans toute la FAQ" 
													autocomplete="off"
												>
											</form>
										</div>

										<ul class="summary-list slide-up">
											<?php foreach ($child_terms as $child) : ?>
												<li class="list-el">
													<a href="#faq-cat-<?php echo esc_attr($child->slug); ?>" class="el-inner">
														<?php echo esc_html($child->name); ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>

									<div class="summary-cta">
										<div class="cta-inner">
											<div class="cta-title cbo-title-3">
												<?php pll_e('Service client') ?>
											</div>

											<div class="cta-list">
												<div class="list-el slide-up">
													<a class="el-content" href="tel:<?php echo esc_html($phone); ?>" itemprop="telephone">
														<i class="icon icon--phone" aria-hidden="true"></i>
														<?php echo esc_html($phone); ?>
													</a>
												</div>

												<div class="list-el  slide-up">
													<a class="el-content" href="mailto:<?php echo esc_html($mail); ?>" itemprop="mail">
														<i class="icon icon--mail" aria-hidden="true"></i>
														<?php echo esc_html($mail); ?>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="panel-text">
									<div id="faq-search-results" class="faq-search-results" style="display:none;">
										<div class="accordion-list"></div>
									</div>

									<?php
										foreach ($child_terms as $child) :
									?>
										<div class="text-content" id="faq-cat-<?php echo esc_attr($child->slug); ?>">
											<h3 class="content-title cbo-title-2">
												<?php echo esc_html($child->name); ?>
											</h3>

											<div class="accordion-list">
												<?php
													$faq_query = new WP_Query([
														'post_type'      => 'faq',
														'posts_per_page' => -1,
														'tax_query'      => [
															[
																'taxonomy' => 'faq_cat',
																'field'    => 'term_id',
																'terms'    => $child->term_id,
															],
														],
														'orderby' => 'menu_order',
														'order'   => 'ASC',
													]);
													if ($faq_query->have_posts()) :
														while ($faq_query->have_posts()) :
															$faq_query->the_post();
															get_part('faq/template');
														endwhile;
														wp_reset_postdata();
													endif;
												?>
											</div>
										</div>
									<?php
									endforeach;
								else :
									echo '<p>'. pll_e('Aucune catégorie associée à cette faq') . esc_html($parent->name) . '.</p>';
								endif;
								?>
								</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		<?php else : ?>
			<p><?php pll_e('Aucune catégorie trouvée.') ?></p>
		<?php endif; ?>
	</div>
</section>