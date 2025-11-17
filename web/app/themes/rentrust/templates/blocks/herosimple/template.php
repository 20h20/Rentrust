<?php
	$title   = get_field('herosimple_title');
	$content = get_field('herosimple_content');

	// Récupération du titre pour les singles
	if (!empty($use_post_title)) {
		$title = get_the_title();
	}
?>
<section class="cbo-herosimple">
    <div class="herosimple-inner cbo-container container--nomargin container--padding">

        <?php
			if (!is_front_page()) get_part('breadcrumb/template');
		?>

        <div class="herosimple-content">
            <?php if ($title): ?>
                <div class="herosimple-title cbo-title-1 slide-up" itemprop="headline">
                    <?php echo wp_kses_post($title); ?>
                </div>
            <?php endif; ?>

            <?php if ($content): ?>
                <div class="herosimple-text cbo-cms cbo-chapo slide-up">
                    <?php echo wp_kses_post($content); ?>
                </div>
            <?php endif; ?>

            <?php
				get_part('button/template');
			?>
        </div>
    </div>
</section>
