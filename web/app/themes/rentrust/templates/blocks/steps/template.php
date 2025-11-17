<?php
	$title	= get_field('steps_title');
	$chapo	= get_field('steps_chapo');
	$color	= get_field('steps_color');
?>

<section class="cbo-steps <?php echo ($color === 'beige') ? 'steps--beige' : ''; ?>">
	<div class="steps-inner cbo-container container--small <?php echo ($color === 'beige') ? 'container--padding container--nomargin' : ''; ?>">

		<?php if($title): ?>
			<div class="steps-title cbo-title-2 slide-up" itemprop="headline">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<?php if($chapo): ?>
			<div class="steps-chapo cbo-chapo slide-up">
				<?php echo wp_kses_post($chapo); ?>
			</div>
		<?php endif; ?>

		<div class="steps-list">
			<?php
				if( have_rows('steps_list') ):
				$i = 1;
				while ( have_rows('steps_list') ) : the_row();
				$picture = get_sub_field('picture');
				$title = get_sub_field('title');
				$content = get_sub_field('content');
			?>
				<div class="list-el">
					<div class="el-inner slide-up">
						<div class="inner-top">
							<div class="inner-number slide-up">
								<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>
							</div>

							<?php if($picture): ?>
								<div class="inner-picture cbo-picture-contain slide-up">
									<img
										src="<?php echo esc_url($picture['sizes']['small']); ?>"
										srcset="<?php echo esc_url($picture['sizes']['small']); ?> 320w, <?php echo esc_url($picture['sizes']['medium']); ?> 768w, <?php echo esc_url($picture['sizes']['medium']); ?> 1024w"
										alt="<?php echo esc_attr($picture['alt']); ?>" sizes="100vw"
										loading="lazy"
										decoding="async"
										width="90" height="80"
									>
								</div>
							<?php endif; ?>
						</div>

						<div class="inner-content">
							<?php if($title): ?>
								<div class="content-title cbo-title-3 slide-up">
									<?php echo esc_html($title); ?>
								</div>
							<?php endif; ?>

							<?php if($content): ?>
								<div class="content-text cbo-cms slide-up">
									<?php echo wp_kses_post($content); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php
				$i++;
				endwhile;
				endif;
			?>
		</div>
	</div>
</section>