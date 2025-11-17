<?php
	$title	= get_field('blocs_title');
	$chapo	= get_field('blocs_chapo');
?>

<section class="cbo-blocs">
	<div class="blocs-inner cbo-container container--nomargin container--padding">

		<?php if($title): ?>
			<div class="blocs-title cbo-title-2 slide-up" itemprop="headline">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<?php if($chapo): ?>
			<div class="blocs-chapo cbo-chapo slide-up">
				<?php echo wp_kses_post($chapo); ?>
			</div>
		<?php endif; ?>

		<div class="blocs-list">
			<?php
				if( have_rows('blocs_list') ):
				while ( have_rows('blocs_list') ) : the_row();
				$title	= get_sub_field('title');
				$content	= get_sub_field('text');
			?>
				<div class="list-el">
					<div class="el-inner">
						<?php if($title): ?>
							<div class="inner-title cbo-title-3 slide-up">
								<?php echo esc_html($title); ?>
							</div>
						<?php endif; ?>

						<?php if($content): ?>
							<div class="inner-content cbo-cms slide-up">
								<?php echo esc_html($content); ?>
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