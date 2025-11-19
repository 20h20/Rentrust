<?php
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
    }, 100);

    add_filter('template_include', function ($template) {
        if (function_exists('cbo_register_part_usage')) {
            cbo_register_part_usage('button');
        }

        return $template;
    }, 5);

    $GLOBALS['cbo_used_blocks'] = $GLOBALS['cbo_used_blocks'] ?? [];


    /* ---------------------------------------------------- */
    /*  Register - blocs et parts                           */
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
        }
    }

    /* ---------------------------------------------------- */
    /*  REMPLACE get_template_part -> get_part()            */
    /* ---------------------------------------------------- */
    function get_part($path, $slug = null) {
        get_template_part('templates/parts/' . $path, $slug);
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
        /*  CSS blocks    */
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
        /*  CSS parts        */
        /* --------------------- */
        $css_parts_path = get_stylesheet_directory() . '/library/css/parts/';
        $css_parts_url  = get_stylesheet_directory_uri() . '/library/css/parts/';
        add_action('wp_footer', function() {
            global $cbo_used_parts;
        
            $css_parts_path = get_stylesheet_directory() . '/library/css/parts/';
            $css_parts_url  = get_stylesheet_directory_uri() . '/library/css/parts/';
        
            foreach ($cbo_used_parts as $part_name) {
                $css_file = $css_parts_path . $part_name . '.min.css';
                if (file_exists($css_file)) {
                    echo '<link rel="stylesheet" href="' . $css_parts_url . $part_name . '.min.css?ver=' . filemtime($css_file) . '" />' . "\n";
                } else {
                }
            }
        }, 100);
    }, 20);


    /* ---------------------------------------------------- */
    /*  ADMIN CSS                                            */
    /* ---------------------------------------------------- */
    function admin_css(){
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


    /* Charger les CSS des parts dans l’admin (éditeur) */
    add_action('admin_enqueue_scripts', function() {
        $css_parts_path = get_stylesheet_directory() . '/library/css/parts/';
        $css_parts_url  = get_stylesheet_directory_uri() . '/library/css/parts/';
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

?>