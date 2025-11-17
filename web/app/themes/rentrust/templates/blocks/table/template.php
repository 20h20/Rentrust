
<?php
	$title	= get_field('table_title');
  $tablehead	= get_field('table_addheader');
  $tablefoot	= get_field('table_addfooter');  
?>
<section class="cbo-table">
	<div class="table-inner cbo-container container--xsmall">

		<?php if($title): ?>
			<div class="table-title cbo-title-2 slide-up">
				<?php echo $title ?>
			</div>
		<?php endif; ?>

		<?php if($tablehead == 1): ?>
			<div class="table-header">
				<?php
					if( have_rows('table_row') ):
					while( have_rows('table_row') ): the_row();
					$content = get_sub_field('content');
					$featured = get_sub_field('featured');
				?>
					<div class="header-row <?php if($featured == 1): ?>row--featured<?php endif; ?>">
						<div class="cbo-title-3 slide-up">
							<?php echo $content ?>
						</div>
					</div>
				<?php
					endwhile;
					endif;
				?>
			</div>
		<?php endif; ?>

		<div class="table-body">
			<?php
				if( have_rows('table_lines') ):
				while( have_rows('table_lines') ): the_row();
			?>
				<div class="table-row">
					<?php
						if( have_rows('table_col') ):
						while ( have_rows('table_col') ) : the_row();
						$featured = get_sub_field('featured');
						$content = get_sub_field('content');
						$check = get_sub_field('check');
					?>
						<div class="table-cell <?php if($featured == 1): ?>cell--featured<?php endif; ?>">
							<?php echo $content ?>
							<?php if($check == 1): ?>
								<i class="icon icon--checkbox slide-up"></i>
							<?php endif; ?>
						</div>
					<?php
						endwhile;
						endif;
					?>
				</div>
			<?php
				endwhile;
				endif;
			?>
		</div>

		<?php if($tablefoot == 1): ?>
			<div class="table-footer">
				<?php
					if( have_rows('table_rowfooter') ):
					while( have_rows('table_rowfooter') ): the_row();
					$content = get_sub_field('content');
					$featured = get_sub_field('featured');
					$button = get_sub_field('button'); 
				?>
					<div class="footer-row <?php if($featured == 1): ?>row--featured<?php endif; ?>">
						<?php echo $content ?>
						<?php if($button): ?>
							<a class="cbo-button button--white slide-up" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
								<?php echo esc_html($button['title']); ?>
							</a>
						<?php endif; ?>
					</div>
				<?php
					endwhile;
					endif;
				?>
			</div>
		<?php endif; ?>
	</div>
</section>