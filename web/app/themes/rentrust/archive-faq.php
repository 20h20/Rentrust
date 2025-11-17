<?php
	get_header();
	$title	= get_field('faq_title', 'option');
	$chapo	= get_field('faq_chapo', 'option');
?>

<div class="cbo-page page--faq">
	<section class="cbo-herosimple">
		<div class="herosimple-inner cbo-container container--nomargin container--padding">

			<?php
				get_part('breadcrumb/template');
			?>

			<div class="herosimple-content">
				<?php if($title): ?>
					<h1 class="herosimple-title cbo-title-1 slide-up" itemprop="headline">
						<?php echo wp_kses_post($title); ?>
					</h1>
				<?php endif; ?>

				<?php if($chapo): ?>
					<div class="herosimple-text cbo-cms cbo-chapo slide-up">
						<?php echo wp_kses_post($chapo); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php
		get_part('faqpage/template');
	?>

	<section class="cbo-relation relation--beige">
		<div class="relation-inner cbo-container container--nomargin container--padding">

			<div class="relation-head slide-up">
				<div class="relation-title cbo-title-2 slide-up">
					<h2><?php pll_e('Nos derniers articles') ?></h2>
				</div>

				<a class="relation-button cbo-button slide-up" href="<?php echo home_url(); ?>/notre-actualite/">
					<?php pll_e('Tous les articles') ?>
				</a>
			</div>

			<div class="articles-list relation-list">
				<?php
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 4,
						'orderby' => 'date',
						'order' => 'DESC',
					);
					$query = new WP_Query($args);
					if ($query->have_posts()) :
						while ($query->have_posts()) : $query->the_post();
						get_part('article/template');
					endwhile;
					else :
				?>
					<p><?php pll_e('Aucun article') ?></p>
				<?php
					endif;
					wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
</div>

<?php
	get_footer();
?>