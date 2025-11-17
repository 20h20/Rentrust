<?php
	$title	= get_field('accordionpicture_title');
	$content	= get_field('accordionpicture_content');
	$picturepos = get_field('accordionpicture_picturepos');
	$section_id = uniqid('accordionpicture--');

	$first_item_picture = false;
	$first_item_cover	= 0;

	if (have_rows('accordionpicture_list')):
		while (have_rows('accordionpicture_list')): the_row();
			$picture = get_sub_field('picture');
			$cover   = get_sub_field('cover');
			if ($picture) {
				$first_item_picture = $picture;
			}
			$first_item_cover = $cover ? 1 : 0;
			break;
		endwhile;
		reset_rows();
	endif;
?>

<section class="cbo-accordionpicture accordionpicture--<?php echo esc_attr($picturepos); ?>">
	<div class="accordionpicture-inner cbo-container container--medium">

		<div class="accordionpicture-picture slide-up <?php echo $first_item_cover ? 'cbo-picture-cover' : 'cbo-picture-contain'; ?>" id="<?php echo esc_attr($section_id); ?>-picture">
			<?php if ($first_item_picture): ?>
				<img
					src="<?php echo esc_url($first_item_picture['sizes']['medium']); ?>"
					srcset="<?php echo esc_url($first_item_picture['sizes']['small']); ?> 320w, 
							<?php echo esc_url($first_item_picture['sizes']['medium']); ?> 768w, 
							<?php echo esc_url($first_item_picture['sizes']['large']); ?> 1024w"
					alt="<?php echo esc_attr($first_item_picture['alt']); ?>"
					id="<?php echo esc_attr($section_id); ?>-img"
					sizes="(min-width: 1024px) 50vw, (min-width: 768px) 60vw, 100vw"
					loading="lazy"
					decoding="async"
				>
			<?php endif; ?>
		</div>

		<div class="accordionpicture-content">
			<?php if ($title): ?>
				<div class="content-title cbo-title-2 slide-up" itemprop="headline">
					<?php echo wp_kses_post($title); ?>
				</div>
			<?php endif; ?>

			<?php if ($content): ?>
				<div class="content-text cbo-cms slide-up">
					<?php echo wp_kses_post($content); ?>
				</div>
			<?php endif; ?>

			<div class="accordionpicture-list">
				<?php
					$index = 0;
					if (have_rows('accordionpicture_list')):
					while (have_rows('accordionpicture_list')): the_row();
						$item_id       = $section_id . '-item-' . $index;
						$title_item    = get_sub_field('title');
						$content_item  = get_sub_field('content');
						$item_picture  = get_sub_field('picture');
						$item_cover    = get_sub_field('cover');
						$is_first      = ($index === 0);
						$picture_small  = $item_picture['sizes']['small'] ?? '';
						$picture_medium = $item_picture['sizes']['medium'] ?? '';
						$picture_large  = $item_picture['sizes']['large'] ?? '';
						$picture_alt    = $item_picture['alt'] ?? '';
				?>
					<div class="list-el <?php echo $is_first ? 'el--open' : ''; ?>">
						<h3 class="el-wrapper slide-up" itemprop="name">
							<button
								type="button"
								class="el-title cbo-title-3"
								aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
								aria-controls="<?php echo esc_attr($item_id); ?>"
								id="<?php echo esc_attr($item_id); ?>-button"
								data-picture-small="<?php echo esc_url($picture_small); ?>"
								data-picture-medium="<?php echo esc_url($picture_medium); ?>"
								data-picture-large="<?php echo esc_url($picture_large); ?>"
								data-alt="<?php echo esc_attr($picture_alt); ?>"
								data-cover="<?php echo $item_cover ? 'cover' : 'contain'; ?>"
							>
								<?php echo esc_html($title_item); ?>
							</button>
						</h3>

						<div
							id="<?php echo esc_attr($item_id); ?>"
							class="el-content cbo-cms"
							role="region"
							aria-labelledby="<?php echo esc_attr($item_id); ?>-button"
							<?php echo $is_first ? '' : 'hidden'; ?>
						>
							<?php echo wp_kses_post($content_item); ?>
						</div>
					</div>
				<?php
					$index++;
					endwhile;
					endif;
				?>
			</div>

			<?php
				get_part('button/template', null, array());
			?>
		</div>
	</div>
</section>