<?php
	// Sont appelé ici tous les composants ACF

	require get_template_directory() . '/templates/blocks/accordion/block.php';
	require get_template_directory() . '/templates/blocks/accordionpicture/block.php';
	require get_template_directory() . '/templates/blocks/blocs/block.php';
	require get_template_directory() . '/templates/blocks/blocspicture/block.php';
	require get_template_directory() . '/templates/blocks/calculator/block.php';
	require get_template_directory() . '/templates/blocks/contact/block.php';
	require get_template_directory() . '/templates/blocks/cta/block.php';
	require get_template_directory() . '/templates/blocks/herocalculator/block.php';
	require get_template_directory() . '/templates/blocks/herosimple/block.php';
	require get_template_directory() . '/templates/blocks/herotextpicture/block.php';
	require get_template_directory() . '/templates/blocks/picture/block.php';
	require get_template_directory() . '/templates/blocks/profiles/block.php';
	require get_template_directory() . '/templates/blocks/relationel/block.php';
	require get_template_directory() . '/templates/blocks/steps/block.php';
	require get_template_directory() . '/templates/blocks/table/block.php';
	require get_template_directory() . '/templates/blocks/testimonials/block.php';
	require get_template_directory() . '/templates/blocks/text/block.php';
	require get_template_directory() . '/templates/blocks/textpicture/block.php';

	function allow_only_custom_blocks( $allowed_blocks, $editor_context ) {
		return array(
			'acf/accordion',
			'acf/accordionpicture',
			'acf/blocs',
			'acf/blocspicture',
			'acf/calculator',
			'acf/contact',
			'acf/cta',
			'acf/herocalculator',
			'acf/herosimple',
			'acf/herotextpicture',
			'acf/picture',
			'acf/profiles',
			'acf/relationel',
			'acf/steps',
			'acf/table',
			'acf/testimonials',
			'acf/text',
			'acf/textpicture',
		);
	}
	add_filter( 'allowed_block_types_all', 'allow_only_custom_blocks', 10, 2 );


	/* ************************* */
	/* ADD NEW CATEGORIES INTO ACF BLOCK REGISTER */
	/* ************************* */
	function add_custom_block_categories($categories) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'hero',
					'title' => __('En-tête'),
					'icon'  => null,
				),
				array(
					'slug'  => 'featured',
					'title' => __('Mise en avant'),
					'icon'  => null,
				),
				array(
					'slug'  => 'text',
					'title' => __('Texte'),
					'icon'  => null,
				),
				array(
					'slug'  => 'relation',
					'title' => __('Relation'),
					'icon'  => null,
				),
			)
		);
	}
	add_filter('block_categories_all', 'add_custom_block_categories');

?>