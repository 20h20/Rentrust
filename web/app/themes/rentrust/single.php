<?php
	get_header();
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('cbo-page page--single'); ?>>
		<div class="single-content">
			<?php
				if(have_posts()):
					the_post();
					get_part('articlehero/template');
					get_part('articlesummary/template');
					the_content();
				endif;
			?>
		</div>

		<section class="cbo-relation">
			<div class="relation-inner cbo-container">

				<div class="relation-head slide-up">
					<div class="relation-title cbo-title-2 slide-up">
						<h3>
							<?php pll_e('Nos articles similaires') ?>
						</h3>
					</div>

					<a class="relation-button cbo-button slide-up" href="<?php echo home_url(); ?>/notre-actualite/">
						<?php pll_e('Tous les articles') ?>
					</a>
				</div>

				<div class="articles-list relation-list">
					<?php
						$post_id = get_the_ID();

						if ( $post_id ) {
							$categories = get_the_category($post_id);

							if ( $categories && ! is_wp_error($categories) && isset($categories[0]) ) {
								$current_category = $categories[0]->slug;

								$args = array(
									'post_type' => 'post',
									'posts_per_page' => 4,
									'post__not_in' => array($post_id),
									'category_name' => $current_category,
								);

								$query = new WP_Query($args);

								if ($query->have_posts()) :
									while ($query->have_posts()) : $query->the_post();
										get_part('article/template');
									endwhile;
									wp_reset_postdata();
								else :
									echo '<strong style="text-align:center;width:100%">' . pll_e('Aucun article') . '</strong>';
								endif;

							} else {
								echo '<strong style="text-align:center;width:100%">' . pll_e('Aucune catégorie associée à cet article') . '</strong>';
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