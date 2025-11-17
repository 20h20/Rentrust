<?php
	get_header();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('cbo-page page--single'); ?>>
		<div class="single-content">
			<?php
			if (have_posts()) :
				the_post();
				get_block('herosimple', [
					'use_post_title' => true
				]);
				the_content();
			endif;
			?>
		</div>

		<section class="cbo-accordion accordion--beige" itemscope itemtype="https://schema.org/FAQPage">
			<div class="accordion-inner cbo-container container--small container--padding container--nomargin">
				<h3 class="accordion-title cbo-title-1 slide-up">
					<?php pll_e('Dans la même catégorie') ?>
				</h3>

				<div class="accordion-list">
					<?php
						$post_id = get_the_ID();
						if ($post_id) {
							$terms = wp_get_post_terms($post_id, 'faq_cat');
							if ($terms && !is_wp_error($terms) && isset($terms[0])) {
								$current_term = $terms[0]->slug;
								$args = [
									'post_type'	=> 'faq',
									'posts_per_page' => 4,
									'post__not_in'   => [$post_id],
									'tax_query'	=> [
										[
											'taxonomy' => 'faq_cat',
											'field'	=> 'slug',
											'terms'	=> $current_term,
										],
									],
								];

								$query = new WP_Query($args);

								if ($query->have_posts()) :
									while ($query->have_posts()) : $query->the_post();
										get_part('faq/template');
									endwhile;
									wp_reset_postdata();
								else :
									echo '<strong style="text-align:center;width:100%">' . pll_e('Aucune faq') . '</strong>';
								endif;

							} else {
								echo '<strong style="text-align:center;width:100%">' . pll_e('Aucune catégorie associée à cette faq') . '</strong>';
							}
						}
					?>
				</div>
			</div>
		</section>
	</article>
<?php
	get_footer();
?>