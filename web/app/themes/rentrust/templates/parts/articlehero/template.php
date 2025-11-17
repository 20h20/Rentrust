<?php
	$categories = get_the_category();
	$categories_list = '';
	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		foreach ( $categories as $category ) {
			$class_slug = sanitize_title($category->name);
			$url = get_category_link( $category->term_id );
	
			$categories_list .= '<a href="' . esc_url( $url ) . '" class="cbo-tag" itemprop="articleSection">';
			$categories_list .= esc_html( $category->name );
			$categories_list .= '</a>';
		}
	}
	$published_date = get_the_date('Ymd');
?>
<section class="cbo-heroarticle">
	<div class="heroarticle-inner cbo-container container--nomargin container--padding">

		<?php
			if (!is_front_page()):
				get_part('breadcrumb/template');
			endif;
		?>

		<div class="heroarticle-content">
			<div class="heroarticle-category slide-up">
				<?php echo $categories_list; ?>
			</div>

			<div class="heroarticle-title cbo-title-1 slide-up" itemprop="headline">
				<h1>
					<?php the_title(); ?>
				</h1>
			</div>

			<div class="heroarticle-picture cbo-picture-cover slide-up">
				<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('small', array('sizes' => '(max-width:320px) 145px, (max-width:425px) 220px, 500px', 'itemprop' => 'image'));
					} else {
						echo '<img src="' . get_template_directory_uri() . '/library/img/logo-rentrust-white.svg" class="picture-default" alt="" itemprop="image">';
					}
				?>
			</div>

			<div class="heroarticle-share slide-up">
				<div class="share-title">
					<?php pll_e('Partager :') ?>
				</div>
				<a class="share-el" href="#" id="linkedin-share-button" class="social-icon" target="_blank" title="<?php pll_e('Partager l\'article sur Linkedin') ?>" rel="noopener noreferrer">
					<i class="icon icon--linkedin" aria-hidden="true"></i>
				</a>
			</div>
		</div>	
	</div>
</section>