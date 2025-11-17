<?php
	$title	= get_field('cta_title');
	$chapo	= get_field('cta_chapo');
	$pictureone	= get_field('cta_pictureone');
	$picturetwo	= get_field('cta_picturetwo');
?>

<section class="cbo-cta" itemscope itemtype="https://schema.org/Offer">
	<div class="cta-inner cbo-container container--medium">
		<div class="cta-box">
			<div class="box-content">
				<?php if($title): ?>
					<div class="content-title cbo-title-1 slide-up" itemprop="headline">
						<?php echo wp_kses_post($title); ?>
					</div>
				<?php endif; ?>

				<?php if($chapo): ?>
					<div class="cbo-chapo slide-up" itemprop="description">
						<?php echo wp_kses_post($chapo); ?>
					</div>
				<?php endif; ?>
				<?php get_part('button/template', null, array()); ?>
			</div>

			<?php if($pictureone): ?>
				<div class="box-picture picture--one cbo-picture-cover" data-scroll-picture="up">
					<img
						src="<?php echo esc_url($pictureone['sizes']['medium']); ?>"
						srcset="<?php echo esc_attr($pictureone['sizes']['small']); ?> 480w,
								<?php echo esc_attr($pictureone['sizes']['medium']); ?> 768w,
								<?php echo esc_attr($pictureone['sizes']['large']); ?> 1024w"
						sizes="(max-width: 768px) 100vw, 50vw"
						alt="<?php echo esc_attr($pictureone['alt']); ?>"
						loading="lazy"
						decoding="async"
					>
				</div>
			<?php endif; ?>

			<?php if($picturetwo): ?>
				<div class="box-picture picture--two cbo-picture-cover" data-scroll-picture="down">
					<img
						src="<?php echo esc_url($picturetwo['sizes']['small']); ?>"
						srcset="<?php echo esc_attr($picturetwo['sizes']['small']); ?> 320w, <?php echo esc_attr($picturetwo['sizes']['medium']); ?> 768w, <?php echo esc_attr($picturetwo['sizes']['medium']); ?> 1024w"
						alt="" sizes="100vw"
						loading="lazy"
						decoding="async"
						width="300" height="300"
					>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>