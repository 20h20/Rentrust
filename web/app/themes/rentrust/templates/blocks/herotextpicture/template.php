<?php
	$title	= get_field('herotextpicture_title');
	$content	= get_field('herotextpicture_content');
	$picture	= get_field('herotextpicture_picture');
?>

<section class="cbo-herotextpicture">
	<div class="herotextpicture-inner cbo-container container--nomargin container--padding">
		<?php if($picture): ?>
			<div class="herotextpicture-picture cbo-picture-cover slide-up">
				<div class="picture-frame"></div>
				<img
					src="<?php echo esc_url($picture['sizes']['xsmall']); ?>"
					srcset="<?php echo esc_url($picture['sizes']['small']); ?> 320w,
							<?php echo esc_url($picture['sizes']['large']); ?> 1024w"
					sizes="100vw"
					alt="<?php echo esc_attr($picture['alt'] ?: 'Illustration décorative'); ?>"
					width="900"
					height="900"
					class=""
				>
			</div>
		<?php endif; ?>

		<div class="herotextpicture-content slide-up">
			<?php
				if (!is_front_page()):
					get_part('breadcrumb/template');
				endif;
			?>

			<?php if($title): ?>
				<div class="herotextpicture-title cbo-title-1 slide-up" itemprop="headline">
					<?php echo wp_kses_post($title); ?>
				</div>
			<?php endif; ?>

			<?php if($content): ?>
				<div class="herotextpicture-text cbo-chapo cbo-cms slide-up">
					<?php echo wp_kses_post($content); ?>
				</div>
			<?php endif; ?>

			<?php
				get_part('button/template');
			?>
		</div>
	</div>
</section>