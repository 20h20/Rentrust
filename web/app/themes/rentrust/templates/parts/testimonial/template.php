<?php
	global $post;
	$function = get_field('testimonial_function', $post->ID);
	$note	= get_field('testimonial_note', $post->ID);
?>
<div class="list-el">
	<div class="el-inner">
		<div class="content-wrap">
			<div class="content-stars stars--list slide-up">
				<?php for ($i = 1; $i <= 5; $i++): ?>
					<div class="star" aria-hidden="true">
						<i class="icon <?php echo $i <= $note ? 'icon--star' : 'icon--star-empty'; ?>"></i>
					</div>
				<?php endfor; ?>
			</div>

			<div class="el-content slide-up">
				<?php echo apply_filters('the_content', $post->post_content); ?>
			</div>
		</div>

		<div class="el-infos">
			<span class="infos-name slide-up">
				<?php echo esc_html(get_the_title($post->ID)); ?>
			</span>

			<?php if ($function): ?>
				<div class="infos-function slide-up">
					<?php echo esc_html($function); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>