<?php
	$button	= get_field('button');
	$addbutton	= get_field('button_add');
	$buttontwo	= get_field('button_two');
?>
<?php if($button): ?>
	<div class="button-container slide-up">
		<a class="cbo-button" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
			<?php echo esc_html($button['title']); ?>
		</a>

		<?php if($addbutton == 1): ?>
			<a class="cbo-button button--border" href="<?php echo esc_url($buttontwo['url']); ?>" target="<?php echo esc_attr($buttontwo['target'] ?: '_self'); ?>">
				<?php echo esc_html($buttontwo['title']); ?>
			</a>
		<?php endif; ?>
	</div>
<?php endif; ?>