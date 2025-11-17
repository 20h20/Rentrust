<?php
	function cbo_testimonial() { 
		register_post_type( 'testimonial',
		array( 'labels' => array(
			'name' => __( 'Témoignages', 'bonestheme' ),
			'singular_name' => __( 'Témoignage', 'bonestheme' ),
			'all_items' => __( 'Tous les témoignages', 'bonestheme' ), 
			'add_new' => __( 'Ajouter', 'bonestheme' ), 
			'add_new_item' => __( 'Ajouter un témoignage', 'bonestheme' ),
			'edit' => __( 'Modifier', 'bonestheme' ),
			'edit_item' => __( 'Modifier un témoignage', 'bonestheme' ),
			'new_item' => __( 'Nouveau témoignage', 'bonestheme' ),
			'view_item' => __( 'Voir le témoignage', 'bonestheme' ),
			'search_items' => __( 'Rechercher', 'bonestheme' ),
			'not_found' =>  __( 'Aucun témoignage.', 'bonestheme' ),
			'not_found_in_trash' => __( 'Aucune étude de cas dans la corbeille', 'bonestheme' ),
			'parent_item_colon' => ''
		),
		'public' => false,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 3, 
		'menu_icon' => 'dashicons-megaphone',
		'rewrite'	=> array( 'slug' => 'temoignage', 'with_front'   => false ), // slug du single
		'has_archive' => 'nos-temoignages', // slug de la page d'archive
		'capability_type' => 'post',
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields'),
		'show_in_rest'	=> false,
	)); }
	add_action( 'init', 'cbo_testimonial');
?>