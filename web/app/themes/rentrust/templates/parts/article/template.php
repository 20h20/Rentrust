<?php
	$categories = get_the_category();
	$categories_list = '';
	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		foreach ( $categories as $category ) {
			$categories_list .= '<span class="cbo-tag" itemprop="articleSection">' . esc_html( $category->name ) . '</span>';
		}
	}
	$excerpt = get_the_excerpt();
	$limited_excerpt = wp_trim_words($excerpt, 16, '...');
?>
<article <?php post_class('list-el'); ?> itemprop="blogPosts" itemscope itemtype="http://schema.org/BlogPosting">
	<a class="el-inner slide-up" href="<?php the_permalink(); ?>" itemprop="url">
		<?php if ( has_post_thumbnail() ) { ?>
			<span class="el-picture cbo-picture-cover slide-up">
				<?php 
					the_post_thumbnail('small', array(
						'sizes' => '(max-width:320px) 145px, (max-width:425px) 220px, 500px',
						'itemprop' => 'image',
					));
				?>
			</span>
		<?php } else { ?>
			<span class="el-picture picture--none cbo-picture-cover slide-up">
				<img
					src="<?php bloginfo('template_directory'); ?>/library/img/logo-rentrust-white.svg"
					alt="Rentrust, l’alternative intelligente au dépôt de garantie"
					itemprop="image"
					loading="lazy"
					decoding="async"
					width="250"
					height="250"
				>
			</span>
		<?php } ?>

		<span class="el-content">
			<span class="content-top">
				<span class="content-category slide-up">
					<?php echo $categories_list; ?>
				</span>

				<h3 class="content-title cbo-title-4 slide-up">
					<?php the_title(); ?>
				</h3>

				<span class="content-text slide-up">
					<?php echo $limited_excerpt; ?>
				</span>
			</span>

			<span class="content-link cbo-link slide-up">
				<span class="link-inner">
					<span class="link-txt">
						Lire l'article
					</span>
					<i class="icon icon--arrow-next" aria-hidden="true"></i>
				</span>
			</span>
		</span>
	</a>
</article>