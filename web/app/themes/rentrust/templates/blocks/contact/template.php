<?php
	$picture = get_field('contact_picture');
	$formcall = get_field('contact_call');
	$formail = get_field('contact_mail');
	$title = get_field('contact_title');
?>
<section class="cbo-contact" itemscope itemtype="http://schema.org/ContactPage">
	<div class="contact-inner cbo-container container--medium container--padding">

		<div class="contact-form slide-up">
			<?php if($title): ?>
				<div class="contact-title cbo-title-1  slide-up">
					<?php echo wp_kses_post($title); ?>
				</div>
			<?php endif; ?>

			<div class="contact-list">
				<div class="list-el slide-up">
					<a class="el-content" href="tel:<?php echo $formcall ?>" itemprop="telephone">
						<i class="icon icon--phone" aria-hidden="true"></i>
						<?php echo $formcall ?>
					</a>
				</div>

				<div class="list-el  slide-up">
					<a class="el-content" href="mailto:<?php echo $formail ?>" itemprop="mail">
						<i class="icon icon--mail" aria-hidden="true"></i>
						<?php echo $formail ?>
					</a>
				</div>
			</div>

			<div class="cbo-form slide-up">
				<?php
					$posts = get_field('contact_form');
					if( $posts ):
						foreach( $posts as $p ):
							$cf7_id= $p->ID;
							echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' );
						endforeach;
					endif;
				?>
			</div>
		</div>

		<?php if($picture): ?>
			<div class="contact-picture cbo-picture-cover">
				<img
					decoding="async"
					src="<?php echo $picture['sizes']['xsmall']; ?>"
					srcset="<?php echo $picture['sizes']['xsmall']; ?> 320w, <?php echo $picture['sizes']['medium']; ?> 768w, <?php echo $picture['sizes']['large']; ?> 1024w"
					alt="<?php echo $picture['alt']; ?>" sizes="100vw"
					loading="lazy"
					width="2000" height="2000"
				>
			</div>
		<?php endif; ?>

	</div>
</section>