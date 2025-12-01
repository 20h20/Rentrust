<?php
	$title	= get_field('herocalculator_title');
	$content	= get_field('herocalculator_content');
	$picture	= get_field('herocalculator_picture');
	$formtitle	= get_field('herocalculator_formtitle');
?>

<section class="cbo-herocalculator">
	<div class="herocalculator-inner cbo-container container--nomargin container--padding">
		<?php if($picture): ?>
			<div class="herocalculator-picture cbo-picture-cover parallax-container">
				<div class="picture-frame"></div>
				<img
					src="<?php echo esc_url($picture['sizes']['xsmall']); ?>"
					srcset="<?php echo esc_url($picture['sizes']['small']); ?> 320w,
						<?php echo esc_url($picture['sizes']['large']); ?> 1024w"
					sizes="100vw"
					alt="<?php echo esc_attr($picture['alt'] ?: 'Illustration décorative'); ?>"
					width="900"
					height="900"
					class="parallax-image"
				>
			</div>
		<?php endif; ?>

		<div class="herocalculator-content slide-up">
			<?php
				if (!is_front_page()):
					get_part('breadcrumb/template');
				endif;
			?>

			<?php if($title): ?>
				<div class="herocalculator-title cbo-title-1 slide-up" itemprop="headline">
					<?php echo wp_kses_post($title); ?>
				</div>
			<?php endif; ?>

			<?php if($content): ?>
				<div class="herocalculator-text cbo-chapo cbo-cms slide-up">
					<?php echo wp_kses_post($content); ?>
				</div>
			<?php endif; ?>

			<div class="herocalculator-form slide-up">
				<?php if($formtitle): ?>
					<div class="form-title cbo-title-3">
						<?php echo esc_html($formtitle); ?>
					</div>
				<?php endif; ?>

				<div class="form-inner cbo-form">
					<?php
						$posts = get_field('herocalculator_form');
						if( $posts ):
							foreach( $posts as $p ):
								$cf7_id= $p->ID;
								echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' );
							endforeach;
						endif;
					?>
				</div>
			</div>
		</div>
	</div>
</section>