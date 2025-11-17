<?php
	if (!isset($item_id)) {
		$section_id = isset($section_id) ? $section_id : uniqid('accordion--');
		static $auto_index = 0;
		$item_id = $section_id . '-item-' . $auto_index;
		$auto_index++;
	}
?>
<div class="list-el" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
	<h3 class="el-wrapper" itemprop="name">
		<button 
			type="button"
			class="el-title cbo-title-3" 
			aria-expanded="false" 
			aria-controls="<?php echo esc_attr($item_id); ?>" 
			id="<?php echo esc_attr($item_id); ?>-button"
		>
			<?php the_title(); ?>
			<i class="icon icon--cross" aria-hidden="true"></i>
		</button>
	</h3>

	<div 
		id="<?php echo esc_attr($item_id); ?>" 
		class="el-content cbo-cms" 
		role="region" 
		aria-labelledby="<?php echo esc_attr($item_id); ?>-button" 
		hidden 
		itemscope 
		itemprop="acceptedAnswer" 
		itemtype="https://schema.org/Answer"
	>
		<?php the_excerpt(); ?>
	</div>
</div>