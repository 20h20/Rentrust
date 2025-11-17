<?php
// /**
//  * Chargement conditionnel des styles blocs ACF + parts
//  * Compilation via Grunt dans /library/css/blocks/ et /library/css/parts/
//  */

// /* ---------------------------------------------------- */
// /*  TABLEAUX GLOBAUX : blocs + parts utilisés            */
// /* ---------------------------------------------------- */

// if (!isset($GLOBALS['cbo_used_blocks'])) {
//     $GLOBALS['cbo_used_blocks'] = array();
// }

// if (!isset($GLOBALS['cbo_used_parts'])) {
//     $GLOBALS['cbo_used_parts'] = array();
// }


// /* ---------------------------------------------------- */
// /*  REGISTRE : blocs et parts utilisés                  */
// /* ---------------------------------------------------- */

// /**
//  * Enregistrer un bloc ACF utilisé
//  */
// function cbo_register_block_usage($block_name)
// {
//     if (!in_array($block_name, $GLOBALS['cbo_used_blocks'])) {
//         $GLOBALS['cbo_used_blocks'][] = $block_name;
//     }
// }

// /**
//  * Enregistrer une part utilisée
//  */
// function cbo_register_part_usage($part_name)
// {
//     if (!in_array($part_name, $GLOBALS['cbo_used_parts'])) {
//         $GLOBALS['cbo_used_parts'][] = $part_name;
//     }
// }


// /* ---------------------------------------------------- */
// /*  FRONTEND CSS LOADER                                 */
// /* ---------------------------------------------------- */

// add_action('wp_enqueue_scripts', 'cbo_scripts_and_styles', 20);

// function cbo_scripts_and_styles()
// {
//     global $cbo_used_blocks, $cbo_used_parts;


// $cbo_used_blocks = $GLOBALS['cbo_used_blocks'];
// $cbo_used_parts  = $GLOBALS['cbo_used_parts'];

//     if (is_admin()) return;

//     /* --------------------- */
//     /*  Styles globaux       */
//     /* --------------------- */
//     $global_css_file = get_stylesheet_directory() . '/library/css/style.min.css';
//     $global_css_version = file_exists($global_css_file)
//         ? filemtime($global_css_file)
//         : wp_get_theme()->get('Version');

//     wp_enqueue_style(
//         'global-styles',
//         get_stylesheet_directory_uri() . '/library/css/style.min.css',
//         [],
//         $global_css_version
//     );


//     /* --------------------- */
//     /*  Analyse du contenu   */
//     /* --------------------- */

//     $content = '';

//     // Page / post
//     if (is_singular()) {
//         global $post;
//         $content = $post->post_content;
//     }

//     // Page d’articles
//     elseif (is_home()) {
//         $blog_page_id = get_option('page_for_posts');
//         if ($blog_page_id) {
//             $blog_page = get_post($blog_page_id);
//             if ($blog_page) {
//                 $content = $blog_page->post_content;
//             }
//         }
//     }

//     // Extraction des blocs ACF depuis le contenu
//     if (!empty($content)) {
//         preg_match_all('/wp:acf\/([a-z0-9-]+)/', $content, $matches);

//         if (!empty($matches[1])) {
//             foreach ($matches[1] as $block_name) {
//                 cbo_register_block_usage($block_name);
//             }
//         }
//     }


//     /* ---------------------------------------------------- */
//     /*  Blocs forcés dans les archives / 404                */
//     /* ---------------------------------------------------- */
//     if (is_home() || is_category() || is_tag() || is_archive() || is_404()) {

//         // Ajouter ici les blocs nécessaires sur les pages d’archives
//         $forced_blocks = ['relationel', 'article'];

//         foreach ($forced_blocks as $block_name) {
//             cbo_register_block_usage($block_name);
//         }
//     }


//     /* ---------------------------------------------------- */
//     /*  CSS des BLOCS ACF                                   */
//     /* ---------------------------------------------------- */
//     $css_blocks_path = get_stylesheet_directory() . '/library/css/blocks/';
//     $css_blocks_url  = get_stylesheet_directory_uri() . '/library/css/blocks/';

//     if (!empty($cbo_used_blocks)) {
//         foreach ($cbo_used_blocks as $block_name) {

//             $block_css_file = $css_blocks_path . $block_name . '.min.css';

//             if (file_exists($block_css_file)) {
//                 wp_enqueue_style(
//                     'block-' . $block_name,
//                     $css_blocks_url . $block_name . '.min.css',
//                     [],
//                     filemtime($block_css_file)
//                 );
//             }
//         }
//     }


//     /* ---------------------------------------------------- */
//     /*  CSS des PARTS                                        */
//     /* ---------------------------------------------------- */
//     $css_parts_path = get_stylesheet_directory() . '/library/css/parts/';
//     $css_parts_url  = get_stylesheet_directory_uri() . '/library/css/parts/';

//     if (!empty($cbo_used_parts)) {

//         foreach ($cbo_used_parts as $part_name) {

//             $part_css_file = $css_parts_path . $part_name . '.min.css';

//             if (file_exists($part_css_file)) {
//                 wp_enqueue_style(
//                     'part-' . $part_name,
//                     $css_parts_url . $part_name . '.min.css',
//                     [],
//                     filemtime($part_css_file)
//                 );
//             }
//         }
//     }

//         // Réinjection dans $GLOBALS
//         $GLOBALS['cbo_used_blocks'] = $cbo_used_blocks;
//         $GLOBALS['cbo_used_parts']  = $cbo_used_parts;

//         error_log('Parts utilisés : ' . print_r($cbo_used_parts, true));

// }






// /* ************************* */
// 	// Ajoute les styles sur Archive, Taxo, etc
// 	/* ************************* */
// 	add_action('wp', function() {
// 		if (is_home() || is_category() || is_tag() || is_archive() || is_404() || is_single()) {
// 			$blocks_path = get_stylesheet_directory() . '/templates/blocks/';
// 			$all_blocks = [];

// 			foreach (glob($blocks_path . '*', GLOB_ONLYDIR) as $dir) {
// 				$block_name = basename($dir);
// 				$all_blocks[] = $block_name;
// 			}

// 			foreach ($all_blocks as $block_name) {
// 				if (function_exists('cbo_register_block_usage')) {
// 					cbo_register_block_usage($block_name);
// 				}
// 			}
// 		}
// 	});










// /**
//  * Détecte les parts utilisées pour une page et les enregistre avant wp_enqueue_scripts.
//  */
// function cbo_detect_parts_from_content($template) {

//     // Commence par récupérer le contenu du post
//     if (is_singular()) {
//         global $post;
//         if ($post && isset($post->post_content)) {

//             // Recherche des blocs ACF comme avant
//             preg_match_all('/wp:acf\/([a-z0-9-]+)/', $post->post_content, $matches);
//             if (!empty($matches[1])) {
//                 foreach ($matches[1] as $block_name) {
//                     cbo_register_block_usage($block_name);
//                 }
//             }
//         }
//     }

//     // Détecter les parts **manuellement** utilisées via get_template_part
//     // Ici, tu peux lister toutes les parts que tu sais être sur la page
//     // ou, si tu veux vraiment automatique, tu peux parcourir les includes du template principal

//     // Exemple manuel (pour commencer) :
//     cbo_register_part_usage('articlehero');
//     cbo_register_part_usage('articlesummary');

//     return $template;
// }
// add_filter('template_include', 'cbo_detect_parts_from_content');






























add_action('wp_enqueue_scripts', function () {

    if (is_admin()) return;

    $global_css = get_stylesheet_directory() . '/library/css/style.min.css';

    if (file_exists($global_css)) {
        wp_enqueue_style(
            'theme-style',
            get_stylesheet_directory_uri() . '/library/css/style.min.css',
            [],
            filemtime($global_css)
        );
    }

}, 5);


add_action('wp_footer', function() {
    global $cbo_used_parts;

    $css_parts_path = get_stylesheet_directory() . '/library/css/parts/';
    $css_parts_url  = get_stylesheet_directory_uri() . '/library/css/parts/';

    foreach ($cbo_used_parts as $part_name) {
        $css_file = $css_parts_path . $part_name . '.min.css';
        if (file_exists($css_file)) {
            wp_enqueue_style(
                'part-' . $part_name,
                $css_parts_url . $part_name . '.min.css',
                [],
                filemtime($css_file)
            );
        }
    }
}, 100); // priorité haute pour s’assurer que c’est après tout le rendu

add_filter('template_include', function ($template) {
    if (function_exists('cbo_register_part_usage')) {

        // Exemple : détection automatique ou manuelle des parts dans le template
        cbo_register_part_usage('button');
        cbo_register_part_usage('article');
        // Tu peux ajouter ici toutes les parts qui seront utilisées sur la page
    }

    return $template;
}, 5);

/**
 * Chargement conditionnel des styles blocs ACF + parts
 */

/* ---------------------------------------------------- */
/*  TABLEAUX GLOBAUX                                    */
/* ---------------------------------------------------- */

$GLOBALS['cbo_used_blocks'] = $GLOBALS['cbo_used_blocks'] ?? [];


/* ---------------------------------------------------- */
/*  REGISTRE - blocs et parts                           */
/* ---------------------------------------------------- */

function cbo_register_block_usage($block_name) {
    if (!in_array($block_name, $GLOBALS['cbo_used_blocks'])) {
        $GLOBALS['cbo_used_blocks'][] = $block_name;
    }
}



if (!isset($GLOBALS['cbo_used_parts'])) {
    $GLOBALS['cbo_used_parts'] = [];
}

function cbo_register_part_usage($part_name) {
    if (!in_array($part_name, $GLOBALS['cbo_used_parts'])) {
        $GLOBALS['cbo_used_parts'][] = $part_name;
        // error_log("PART enregistrée : $part_name");
    }
}



/* ---------------------------------------------------- */
/*  REMPLACE get_template_part -> get_part()            */
/* ---------------------------------------------------- */

function get_part($path, $slug = null) {

    get_template_part('templates/parts/' . $path, $slug);

    // Déduction du nom de la part : /button/template → "button"
    $segments = explode('/', $path);
    $last     = end($segments);

    if ($last === 'template' && count($segments) > 1) {
        $part_name = $segments[count($segments) - 2];
    } else {
        $part_name = $last;
    }

    cbo_register_part_usage($part_name);
}



add_action('wp', function() {
    if (is_home() || is_category() || is_tag() || is_archive() || is_404() || is_single()) {
        $blocks_path = get_stylesheet_directory() . '/templates/blocks/';
        $all_blocks = [];
        foreach (glob($blocks_path . '*', GLOB_ONLYDIR) as $dir) {
            $block_name = basename($dir);
            $all_blocks[] = $block_name;
        }
        foreach ($all_blocks as $block_name) {
            cbo_register_block_usage($block_name);
        }
    }
});


/* ---------------------------------------------------- */
/*  CHARGEMENT DES STYLES                               */
/* ---------------------------------------------------- */

add_action('wp_enqueue_scripts', function() {

    global $cbo_used_blocks, $cbo_used_parts;

    if (is_admin()) return;

    /* --------------------- */
    /*  Style global         */
    /* --------------------- */
    $global_css = get_stylesheet_directory() . '/library/css/style.min.css';
    if (file_exists($global_css)) {
        wp_enqueue_style(
            'global-styles',
            get_stylesheet_directory_uri() . '/library/css/style.min.css',
            [],
            filemtime($global_css)
        );
    }

    /* --------------------- */
    /*  Détection des blocs  */
    /* --------------------- */

    $content = '';

    if (is_singular()) {
        global $post;
        $content = $post->post_content ?? '';
    }

    if (!empty($content)) {
        preg_match_all('/wp:acf\/([a-z0-9-]+)/', $content, $matches);
        foreach ($matches[1] ?? [] as $block_name) {
            cbo_register_block_usage($block_name);
        }
    }

    /* --------------------- */
    /*  CSS des blocs ACF    */
    /* --------------------- */

    $css_blocks_path = get_stylesheet_directory() . '/library/css/blocks/';
    $css_blocks_url  = get_stylesheet_directory_uri() . '/library/css/blocks/';

    foreach ($cbo_used_blocks as $block_name) {
        $file = $css_blocks_path . $block_name . '.min.css';
        if (file_exists($file)) {
            wp_enqueue_style(
                'block-' . $block_name,
                $css_blocks_url . $block_name . '.min.css',
                [],
                filemtime($file)
            );
        }
    }

    /* --------------------- */
    /*  CSS des parts        */
    /* --------------------- */

    
    $css_parts_path = get_stylesheet_directory() . '/library/css/parts/';
    $css_parts_url  = get_stylesheet_directory_uri() . '/library/css/parts/';

    add_action('wp_footer', function() {
        global $cbo_used_parts;
    
        $css_parts_path = get_stylesheet_directory() . '/library/css/parts/';
        $css_parts_url  = get_stylesheet_directory_uri() . '/library/css/parts/';
    
        foreach ($cbo_used_parts as $part_name) {
            $css_file = $css_parts_path . $part_name . '.min.css';
            // error_log("Test du fichier CSS : " . $css_file);
            if (file_exists($css_file)) {
                echo '<link rel="stylesheet" href="' . $css_parts_url . $part_name . '.min.css?ver=' . filemtime($css_file) . '" />' . "\n";
                // error_log("PART CSS chargé : $part_name.min.css");
            } else {
                // error_log("PART CSS introuvable : $part_name.min.css");
            }
        }
    }, 100);
    



}, 20);



/* ---------------------------------------------------- */
/*  ADMIN CSS                                            */
/* ---------------------------------------------------- */

function admin_css()
{
    wp_enqueue_style(
        'gutenberg-styles',
        get_template_directory_uri() . '/library/css/gutenberg.min.css'
    );

    wp_enqueue_style(
        'backoffice',
        get_template_directory_uri() . '/library/css/style.min.css'
    );
}
add_action('admin_print_styles', 'admin_css', 11);


/**
 * Charger les CSS des parts dans l’admin (éditeur)
 */
add_action('admin_enqueue_scripts', function() {
    $css_parts_path = get_stylesheet_directory() . '/library/css/parts/';
    $css_parts_url  = get_stylesheet_directory_uri() . '/library/css/parts/';

    // Si tu veux charger **toutes** les parts disponibles
    foreach (glob($css_parts_path . '*.min.css') as $file) {
        $part_name = basename($file, '.min.css');
        wp_enqueue_style(
            'admin-part-' . $part_name,
            $css_parts_url . $part_name . '.min.css',
            [],
            filemtime($file)
        );
    }
});
