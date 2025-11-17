<?php
	get_header();
?>
	<div class="cbo-page page-404">
		<section class="cbo-text">
			<div class="text-inner cbo-container container--small" style="text-align:center">
				<div class="cbo-title-1 slide-up" itemprop="headline">
					<h1>
						<?php pll_e('Erreur 404') ?>
					</h1>
				</div>
				<div class="slide-up cbo-cms cbo-chapo">
					<p>
						<?php pll_e('La page que vous rechechez n\'existe pas.<br />Vous pouvez toujours revenir sur vos pas.') ?><br /><br />
					</p>
				</div>
				<div>
					<a href="<?php echo home_url(); ?>" class="cbo-button slide-up">
						<?php pll_e('Revenir à l\'accueil') ?>
					</a>
				</div>
			</div>
		</section>

		<section class="cbo-relation">
			<div class="relation-inner cbo-container">

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