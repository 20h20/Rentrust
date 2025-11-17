<?php
	$title	= get_field('profiles_title');
	$chapo	= get_field('profiles_chapo');
?>

<section class="cbo-profiles">
	<div class="profiles-inner cbo-container">

		<?php if($title): ?>
			<div class="profiles-title cbo-title-2 slide-up" itemprop="headline">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<?php if($chapo): ?>
			<div class="profiles-chapo slide-up">
				<?php echo wp_kses_post($chapo); ?>
			</div>
		<?php endif; ?>

		<?php
			if( have_rows('profiles_list') ):
				$profiles = [];
				while ( have_rows('profiles_list') ) : the_row();
					$profiles[] = [
						'picture' => get_sub_field('picture'),
						'libelle' => get_sub_field('libelle')
					];
				endwhile;
			endif;
		?>
		<div class="profiles-container">
			<?php
				for($i=0; $i<3; $i++):
				$direction = ($i === 1) ? 'reverse' : 'normal';
			?>
				<div class="profiles-list <?php echo $direction; ?>">
					<?php
						foreach($profiles as $profile):
					?>
						<div class="list-el">
							<div class="el-inner">
								<?php if($profile['picture']): ?>
									<span class="inner-picture cbo-picture-cover">
										<img decoding="async"
										src="<?php echo $profile['picture']['sizes']['small']; ?>"
										srcset="<?php echo $profile['picture']['sizes']['small']; ?> 320w, <?php echo $profile['picture']['sizes']['small']; ?> 768w"
										alt="<?php echo $profile['picture']['alt']; ?>"
										sizes="100vw"
										loading="lazy"
										width="60" height="60"
									>
									</span>
								<?php endif; ?>

								<?php if($profile['libelle']): ?>
									<span class="inner-text"><?php echo $profile['libelle']; ?></span>
								<?php endif; ?>
							</div>
						</div>
					<?php
						endforeach;
					?>
				</div>
			<?php
				endfor;
			?>
		</div>

	</div>
</section>