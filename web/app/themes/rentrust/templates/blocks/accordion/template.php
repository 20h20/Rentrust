<?php
	$title = get_field('accordion_title');
	$chapo = get_field('accordion_chapo');
	$color = get_field('accordion_color');
	$section_id = uniqid('accordion--');
?>

<section class="cbo-accordion <?php echo ($color === 'beige') ? 'accordion--beige' : ''; ?>" itemscope itemtype="https://schema.org/FAQPage">
	<div class="accordion-inner cbo-container container--small <?php echo ($color === 'beige') ? 'container--padding container--nomargin' : ''; ?>">
	
		<?php if ($title): ?>
			<div class="accordion-title cbo-title-1 slide-up">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<?php if ($chapo): ?>
			<div class="accordion-chapo cbo-chapo cbo-cms slide-up">
				<?php echo wp_kses_post($chapo); ?>
			</div>
		<?php endif; ?>

		<div class="accordion-list">
			<?php 
				$posts = get_field('accordion_list');
				if ($posts):
					global $post;
					$original_post = $post;
					$index = 0;
					foreach ($posts as $post):
						setup_postdata($post);
						$item_id = $section_id . '-item-' . $index;
						$index++;
						get_part('faq/template');
					endforeach;
					$post = $original_post;
					wp_reset_postdata();
				endif;
			?>
		</div>
	</div>
</section>