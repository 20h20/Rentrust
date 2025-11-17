<?php
	$title	= get_field('blocs_title');
	$chapo	= get_field('blocs_chapo');
?>

<section class="cbo-blocspicture">
	<div class="blocspicture-inner cbo-container container--small">

		<?php if($title): ?>
			<div class="blocspicture-title cbo-title-2 slide-up" itemprop="headline">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<?php if($chapo): ?>
			<div class="blocspicture-chapo cbo-chapo slide-up">
				<?php echo wp_kses_post($chapo); ?>
			</div>
		<?php endif; ?>

		<div class="blocspicture-list">
			<?php
				if( have_rows('blocs_list') ):
				while ( have_rows('blocs_list') ) : the_row();
				$picture	= get_sub_field('picture');
				$url	= get_sub_field('link');
				$title	= get_sub_field('title');
				$content	= get_sub_field('text');
			?>
				<a class="list-el slide-up" href="<?php echo esc_url($url['url']); ?>" target="<?php echo esc_attr($url['target'] ?: '_self'); ?>">
					<span class="el-inner">
						<?php if($picture): ?>
							<span class="inner-picture cbo-picture-cover">
								<img
									decoding="async"
									src="<?php echo esc_url($picture['sizes']['xsmall']); ?>"
									srcset="<?php echo esc_url($picture['sizes']['small']); ?> 320w, <?php echo esc_url($picture['sizes']['medium']); ?> 768w"
									alt="<?php echo $picture['alt']; ?>" sizes="100vw"
									loading="lazy"
									width="398" height="230"
								>
							</span>
						<?php endif; ?>

						<span class="inner-content">
							<span class="content-top">
								<?php if($title): ?>
									<span class="content-title cbo-title-3 slide-up">
										<?php echo esc_html($title); ?>
									</span>
								<?php endif; ?>

								<?php if($content): ?>
									<span class="content-text cbo-cms slide-up">
										<?php echo wp_kses_post($content); ?>
									</span>
								<?php endif; ?>
							</span>
						
							<span class="content-link cbo-link slide-up">
								<span class="link-inner">
									<span class="link-txt">
										<?php echo esc_html($url['title']); ?>
									</span>
									<i class="icon icon--arrow-next" aria-hidden="true"></i>
								</span>
							</span>
						</span>
					</span>
				</a>
			<?php
				endwhile;
				endif;
			?>
		</div>
	</div>
</section>