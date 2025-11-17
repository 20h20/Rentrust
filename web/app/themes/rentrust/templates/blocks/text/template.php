<?php
	$text = get_field('text_content');
	$size = get_field('text_size');
?>
<section class="cbo-text text--<?php echo $size; ?>">
	<div class="text-inner cbo-container container--small">
		<div class="cbo-cms">
			<?php echo $text; ?>
		</div>
	</div>
</section>