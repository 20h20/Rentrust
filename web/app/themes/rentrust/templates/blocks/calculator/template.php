<?php
	$title = get_field('calculator_title');
	$button = get_field('calculator_bt');
?>

<section class="cbo-calculator">
	<div class="calculator-inner cbo-container container--medium container--padding container--nomargin">

		<div class="calculator-form slide-up">
			<?php if($title): ?>
				<div class="form-title cbo-title-2">
					<?php echo wp_kses_post($title); ?>
				</div>
			<?php endif; ?>

			<div class="form-inner cbo-form">
				<?php
					$posts = get_field('calculator_form');
					if( $posts ):
						foreach( $posts as $p ):
							$cf7_id= $p->ID;
							echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' );
						endforeach;
					endif;
				?>

				<?php if($button): ?>
					<div class="form-field field--submit">
						<div class="field-inner">
							<a class="cbo-button" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
								<?php echo esc_html($button['title']); ?>
							</a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="calculator-list">
			<?php
				if( have_rows('calculator_list') ):
				while ( have_rows('calculator_list') ) : the_row();
				$icon	= get_sub_field('icon');
				$title	= get_sub_field('title');
				$content	= get_sub_field('text');
			?>
				<div class="list-el">
					<div class="el-inner slide-up">
						<?php if($icon): ?>
							<span class="el-picture cbo-picture-contain">
								<img
									decoding="async"
									src="<?php echo esc_url($icon['sizes']['xsmall']); ?>"
									srcset="<?php echo esc_url($icon['sizes']['xsmall']); ?> 320w"
									alt="" sizes="100vw"
									loading="lazy"
									width="20" height="20"
								>
							</span>
						<?php endif; ?>

						<?php if($title): ?>
							<div class="el-title cbo-title-4">
								<?php echo esc_html($title); ?>
							</div>
						<?php endif; ?>

						<?php if($content): ?>
							<div class="el-content">
								<?php echo wp_kses_post($content); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php
				endwhile;
				endif;
			?>
		</div>
	</div>
</section>