<?php
	$title	= get_field('picture_title');
	$chapo	= get_field('picture_chapo');
	$picture	= get_field('picture_picture');
?>
<section class="cbo-picture">
	<div class="picture-inner cbo-container container--small">

		<?php if ($title): ?>
			<div class="picture-title cbo-title-2 slide-up">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<?php if ($chapo): ?>
			<div class="picture-chapo cbo-chapo cbo-cms slide-up">
				<?php echo wp_kses_post($chapo); ?>
			</div>
		<?php endif; ?>

		<div class="picture-wrap cbo-picture-cover slide-up">
			<div class="picture-frame"></div>
			<img
				decoding="async"
				src="<?php echo $picture['sizes']['large']; ?>"
				srcset="<?php echo $picture['sizes']['large']; ?> 320w, <?php echo $picture['sizes']['large']; ?> 768w, <?php echo $picture['sizes']['xlarge']; ?> 1024w"
				alt="<?php echo $picture['alt']; ?>"
				sizes="100vw"
				loading="lazy"
				width="1200"
				height="1000"
			>
		</div>
	</div>
</section>