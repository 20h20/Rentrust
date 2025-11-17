<?php
	get_header();
?>
	<div class="cbo-page page--archive">
		<section class="cbo-herosimple">
			<div class="herosimple-inner cbo-container container--nomargin container--padding">

				<?php
					if (!is_front_page()):
						get_part('breadcrumb/template');
					endif;
				?>

				<div class="herosimple-content">
					<h1 class="herosimple-title cbo-title-1" itemprop="headline">
						<?php single_cat_title(); ?>
						<?php if (is_paged()): ?>
							<span class="title-page slide-up"><?php pll_e('Page numéro') ?> <?php echo max(1, get_query_var('paged')); ?></span>
						<?php endif; ?>
					</h1>

					<div class="herosimple-text cbo-cms cbo-chapo">
						<?php if ( ! is_paged() ) : ?>	
							<?php echo category_description(); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<section class="cbo-articles">
			<div class="articles-inner cbo-container">

				<?php
					get_part('filters/template');
				?>

				<div class="articles-list">
					<?php
						global $post;
						if (have_posts()) :
						while (have_posts()) : the_post();
							get_part('article/template');
						endwhile;
						echo page_navi();
						endif;
					?>
				</div>
			</div>
		</section>
	</div>
<?php
	get_footer();
?>