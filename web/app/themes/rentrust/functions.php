<?php

	function bones_ahoy() {
		require_once( 'library/inc/styles-import.php' );
		require_once( 'library/inc/custom-cleanup.php' );
		require_once( 'library/inc/custom-admin.php' );
		require_once( 'library/inc/custom-dashboard.php' );
		require_once( 'library/inc/acf.php' );
		require_once( 'library/inc/custom-post/cpt-faq.php' );
		require_once( 'library/inc/custom-post/cpt-testimonial.php' );
		require_once( 'library/inc/themes-settings/includes.php' );
	}
	add_action( 'after_setup_theme', 'bones_ahoy' );

	
	/* ************************* */
	// Pic size
	/* ************************* */
	add_action('after_setup_theme', function() {
		add_image_size('xsmall', 320, 320, false);
		add_image_size('small', 768, 768, false);
		add_image_size('medium', 1200, 1200, false);
		add_image_size('xlarge', 1920, 1920, false);
	});


	/* ************************* */
	// Add `loading="lazy"` attribute to images output by the_post_thumbnail().
	/* ************************* */
	add_filter( 'post_thumbnail_html', 'wpdd_modify_post_thumbnail_html', 10, 5 );
	
	function wpdd_modify_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
		return str_replace( '<img', '<img loading="lazy"', $html );
	}

	/* ************************* */
	// Removing autoP from CF7
	/* ************************* */
	add_filter('wpcf7_autop_or_not', '__return_false');


	/* ************************* */
	/* AJOUT OPTIONS AU DASHBOARD */
	/* ************************* */
	add_action('acf/init', function() {
		if ( function_exists('acf_add_options_page') ) {
			acf_add_options_page();
		}
	});


	/* ************************* */
	/* Add styles to wysiwyg editor */
	/* ************************* */
	function add_style_select_button($buttons) {
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}
	add_filter('mce_buttons_2', 'add_style_select_button');
	function my_mce_before_init_insert_formats( $init_array ) {
		$style_formats = array(
			array(
				'title' => 'Chapô',
				'block' => 'strong',
				'classes' => 'cbo-chapo',
				'wrapper' => true
			),
			array(
				'title' => 'Bouton rouge',
				'block' => 'a',
				'classes' => 'cbo-button',
				'wrapper' => true,
				'attributes' => array(
					'href' => '#'
				)
			),
			array(
				'title' => 'Bouton bordure rouge',
				'block' => 'a',
				'classes' => 'cbo-button button--border',
				'wrapper' => true,
				'attributes' => array(
					'href' => '#'
				)
			),
			array(
				'title' => 'Bouton blanc',
				'block' => 'a',
				'classes' => 'cbo-button button--white',
				'wrapper' => true,
				'attributes' => array(
					'href' => '#'
				)
			),
		);
		$init_array['style_formats'] = json_encode( $style_formats );
		return $init_array;
	}
	add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );


	/* ************************* */
	/* Add only tables to Tiny MCE editor */
	/* ************************* */
	function add_the_table_button( $buttons ) {
		array_push( $buttons, 'separator', 'table' );
		return $buttons;
	}
	add_filter( 'mce_buttons', 'add_the_table_button' );

	function add_the_table_plugin( $plugins ) {
		$plugins['table'] = get_template_directory_uri() . '/library/inc/tinymce-plugins/mce/table/plugin.min.js';
		return $plugins;
	}
	add_filter( 'mce_external_plugins', 'add_the_table_plugin' );


	/* ************************* */
	// Add Color choices
	/* ************************* */
	function my_mce4_options($init) {
		$custom_colours = '
			"da291c", "Rouge",
			"023047", "Bleu foncé",
			"FFFF", "Blanc",
		';
		$init['textcolor_map'] = '['.$custom_colours.']';
		$init['textcolor_rows'] = 1;
		return $init;
	}
	add_filter('tiny_mce_before_init', 'my_mce4_options');


	/* ************************* */
	/* CRÉATION PAGINATION */
	/* ************************* */
	function page_navi($before = '', $after = '') {
		global $wpdb, $wp_query;
		$request = $wp_query->request;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$paged = intval(get_query_var('paged'));
		$numposts = $wp_query->found_posts;
		$max_page = $wp_query->max_num_pages;
		if ( $numposts <= $posts_per_page ) { return; }
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = 7;
		$pages_to_show_minus_1 = $pages_to_show-1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
		echo $before.'<ul class="cbo-pagination">'."";

		$prevposts = get_previous_posts_link('<i class="icon icon--arrow-next"></i>');
		if($prevposts) { echo '<li class="cbo-paginate-prev">' . $prevposts  . '</li>'; }
		else { echo '<li class="disabled"><a href="#"><i class="icon icon--arrow-next"></i></a></li>'; }

		for($i = $start_page; $i  <= $end_page; $i++) {
			if($i == $paged) {
				echo '<li class="active"><a href="#">'.$i.'</a></li>';
			} else {
				echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
			}
		}

		$nextposts = get_next_posts_link('<i class="icon icon--arrow-next"></i>');
		if($nextposts) { echo '<li class="cbo-paginate-next">' . $nextposts  . '</li>'; }
		else { echo '<li class="disabled"><a href="#"><i class="icon icon--arrow-next"></i></a></li>'; }
		
		echo '</ul>'.$after."";
	}


	/* ************************* */
	/* Pagination pour les articles : fait en sorte que la pagination amène bien sur la suite des articles */
	/* ************************* */
	if (!function_exists('setup_articles_pagination')) {
		function setup_articles_pagination() {

			$articles_page_id = get_option('page_for_posts');
			if (!$articles_page_id) return;

			$slug = get_post_field('post_name', $articles_page_id);
			add_action('init', function() use ($slug) {
				add_rewrite_rule(
					"^$slug/page/([0-9]{1,})/?$",
					'index.php?pagename=' . $slug . '&paged=$matches[1]',
					'top'
				);
			});

			add_action('pre_get_posts', function($query) use ($articles_page_id) {
				if (is_admin() || !$query->is_main_query()) return;

				if (($query->is_page() && $query->get('page_id') == $articles_page_id) || $query->is_home()) {
					$paged = max(1, get_query_var('paged', 1));

					$query->set('post_type', 'post');
					$query->set('paged', $paged);
					$query->is_page = false;
					$query->is_home = true;
				}
			});
		}
		setup_articles_pagination();
	}


	/* ************************* */
	// Register menu
	/* ************************* */
	function register_my_menu() {
		register_nav_menu('primary-menu',__( 'Menu Principal' ));
		register_nav_menu('menu-annexe',__( 'Menu Annexe' ));
		register_nav_menu('menu-footer',__( 'Menu Footer' ));
	}
	add_action( 'init', 'register_my_menu' );


	/* ************************* */
	/* CUSTOM LOGIN */
	/* ************************* */
	function childtheme_custom_login() {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/library/css/style.min.css" />';
	}
	add_action('login_head', 'childtheme_custom_login');


	/* ************************* */
	// Add a custom tool bar
	/* ************************* */
	function custom_acf_wysiwyg_toolbar($toolbars) {
		$toolbars['Custom'] = [];
		$toolbars['Custom'][1] = ['forecolor', 'formatselect', 'underline'];
		return $toolbars;
	}
	add_filter('acf/fields/wysiwyg/toolbars', 'custom_acf_wysiwyg_toolbar');


	/* ************************* */
	// AJAX global search for FAQ
	/* ************************* */
	function cbo_ajax_search_faq() {
		$search_query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

		$args = [
			'post_type'	=> 'faq',
			'posts_per_page' => -1,
			's'	=> $search_query,
		];
		$faq_query = new WP_Query($args);
		ob_start();

		if ($faq_query->have_posts()) :
			echo '<div class="accordion-list">';
			while ($faq_query->have_posts()) :
				$faq_query->the_post();
				get_template_part('templates/parts/faq/template');
			endwhile;
			echo '</div>';
		else :
			echo '<p>Aucun résultat trouvé pour cette recherche.</p>';
		endif;

		wp_reset_postdata();

		$output = ob_get_clean();
		wp_send_json_success($output);
	}
	add_action('wp_ajax_cbo_search_faq', 'cbo_ajax_search_faq');
	add_action('wp_ajax_nopriv_cbo_search_faq', 'cbo_ajax_search_faq');

	/* Localisation de la variable AJAX pour le JS */
	function cbo_enqueue_faq_search_script() {
		$main_handle = 'theme-scripts';

		if (wp_script_is($main_handle, 'enqueued') || wp_script_is($main_handle, 'registered')) {
			wp_localize_script($main_handle, 'faq_search', [
				'ajax_url' => admin_url('admin-ajax.php'),
			]);
		} else {
			wp_register_script('cbo-faq-fallback', false);
			wp_localize_script('cbo-faq-fallback', 'faq_search', [
				'ajax_url' => admin_url('admin-ajax.php'),
			]);
			wp_enqueue_script('cbo-faq-fallback');
		}
	}
	add_action('wp_enqueue_scripts', 'cbo_enqueue_faq_search_script', 20);


	/* ************************* */
	/* TRANSLATE KEYS */
	/* ************************* */
	add_action('init', function() {
		pll_register_string( 'article', "Nos derniers articles");
		pll_register_string( 'article', "Tous les articles");
		pll_register_string( 'article', "Aucun article");
		pll_register_string( 'article', "Page numéro");
		pll_register_string( 'article', "Nos articles similaires");
		pll_register_string( 'article', "Aucune catégorie associée à cet article");
		pll_register_string( 'article', "Partager l\'article sur Linkedin");
		pll_register_string( 'article', "Partager :");

		pll_register_string( '404', "Erreur 404");
		pll_register_string( '404', "La page que vous rechechez n\'existe pas.<br />Vous pouvez toujours revenir sur vos pas.");
		
		pll_register_string( 'faq', "Aucune catégorie trouvée.");
		pll_register_string( 'faq', "Service client");
		pll_register_string( 'faq', "Aucune faq");
		pll_register_string( 'faq', "Aucune catégorie associée à cette faq");
		pll_register_string( 'faq', "Dans la même catégorie");

		pll_register_string( 'footer', "Revenir à l\'accueil");
		pll_register_string( 'footer', "Navigation");
		pll_register_string( 'footer', "Navigation du pied de page");
		pll_register_string( 'footer', "Nous suivre");
		pll_register_string( 'footer', "Notre compte Linkedin");
		pll_register_string( 'footer', "Notre compte Twitter");
		pll_register_string( 'footer', "Navigation légale");
		pll_register_string( 'footer', "Tous droits réservés");

		pll_register_string( 'header', "Navigation principale");
		pll_register_string( 'header', "Ouvrir la navigation principale");

		pll_register_string( 'header', "Filtrer les articles par catégorie");
		pll_register_string( 'header', "Filtrer par :");
	});
?>