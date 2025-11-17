	</div><!-- End main -->

	<?php
		$description	= get_field('footer_description', 'option');
		$twitterurl	= get_field('global_twitterurl', 'option');
		$linkedinurl	= get_field('global_linkedinurl', 'option');
	?>

	<footer itemscope itemtype="http://schema.org/WPFooter" role="contentinfo">
		<div class="footer-inner cbo-container container--nomargin container--padding">
			<div class="footer-content">
				<div class="footer-col footer-logo slide-up" itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
					<a class="logo-picture cbo-picture-contain" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>/" rel="home" aria-label="<?php pll_e('Revenir à l\'accueil') ?>">
						<img
							decoding="async"
							src="<?php bloginfo('template_directory'); ?>/library/img/logo-rentrust-white.svg"
							alt="<?php echo esc_attr( get_bloginfo('name') ); ?>"sizes="100vw"
							loading="lazy"
							width="136" height="120"
							itemprop="logo"
						>
					</a>
					<?php echo wp_kses_post($description); ?>
				</div>

				<div class="footer-navwrap">
					<div class="footer-col col--nav slide-up">
						<div class="footer-title">
							<?php pll_e('Navigation') ?>
							<i class="icon icon--arrow-next" aria-hidden="true"></i>
						</div>
						<div class="col-inner">
							<nav class="footer-nav" role="navigation" aria-label="<?php pll_e('Navigation du pied de page') ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">
								<?php wp_nav_menu( array(
									'theme_location' => 'menu-footer',
								));?>
							</nav>
						</div>
					</div>

					<div class="footer-col col--socials slide-up">
						<div class="footer-title">
							<?php pll_e('Nous suivre') ?>
						</div>
						<div class="socials-list">
							<a class="list-el" href="<?php echo esc_url( $linkedinurl ); ?>" itemprop="sameAs" target="_blank" title="<?php pll_e('Notre compte Linkedin') ?>" rel="noopener noreferrer">
								<i class="icon icon--linkedin" aria-hidden="true"></i>
							</a>
							<a class="list-el" href="<?php echo esc_url( $twitterurl ); ?>" target="_blank" title="<?php pll_e('Notre compte Twitter') ?>" rel="noopener noreferrer">
								<i class="icon icon--twitter" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom slide-up">
				<span itemprop="copyrightHolder">© <?php echo date("Y"); ?> <span itemprop="name">Rentrust</span> - <?php pll_e('Tous droits réservés') ?></span>
				<nav role="navigation" aria-label="<?php pll_e('Navigation légale') ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu( array(
						'theme_location' => 'menu-annexe',
					));?>
				</nav>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
	<script defer="defer" src="<?php echo get_template_directory_uri(); ?>/library/js/scripts.js"></script>

</body>
</html>