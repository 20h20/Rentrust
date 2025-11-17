<?php
	$uptitle	= get_field('textpicture_uptitle');
	$title	= get_field('textpicture_title');
	$content	= get_field('textpicture_content');
	$picture	= get_field('textpicture_picture');
	$picturepos	= get_field('textpicture_picturepos');
?>

<section class="cbo-textpicture textpicture--<?php echo $picturepos; ?>">
	<div class="textpicture-inner cbo-container container--medium">

		<div class="textpicture-picture cbo-picture-cover slide-up">
			<img 
				src="<?php echo esc_url($picture['sizes']['medium']); ?>"
				srcset="<?php echo esc_url($picture['sizes']['small']); ?> 320w, 
					<?php echo esc_url($picture['sizes']['medium']); ?> 768w, 
					<?php echo esc_url($picture['sizes']['large']); ?> 1024w"
				alt="<?php echo esc_attr($picture['alt']); ?>"
				sizes="(min-width: 1024px) 50vw, (min-width: 768px) 60vw, 100vw"
				loading="lazy"
				decoding="async"
				width="1000" 
				height="1000"
			>
		</div>

		<div class="textpicture-content">
			<?php if($uptitle): ?>
				<div class="content-uptitle cbo-tag slide-up">
					<?php echo esc_html($uptitle); ?>
				</div>
			<?php endif; ?>

			<?php if($title): ?>
				<div class="content-title cbo-title-2 slide-up" itemprop="headline">
					<?php echo wp_kses_post($title); ?>
				</div>
			<?php endif; ?>

			<?php if($content): ?>
				<div class="content-text cbo-cms slide-up">
					<?php echo wp_kses_post($content); ?>
				</div>
			<?php endif; ?>

			<?php
				get_part('button/template', null, array());
			?>
		</div>

	</div>
</section>