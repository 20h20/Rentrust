<?php
    //
    // Fonction d'inclusion des parts et des blocks dans les différentes templates
    //

    if (!function_exists('get_part')) {
        function get_part($path, $slug = null) {

            // Inclure le template
            get_template_part('templates/parts/' . $path, $slug);

            // Déterminer le nom de la part
            $segments = explode('/', $path);

            if (end($segments) === 'template' && count($segments) > 1) {
                $part_name = $segments[count($segments) - 2]; 
            } else {
                $part_name = end($segments);
            }
            if (function_exists('cbo_register_part_usage')) {
                cbo_register_part_usage($part_name);
            }
        }
    }

    if (!function_exists('get_block')) {
        function get_block($block_name, $args = []) {
            $block_template = get_template_directory() . '/templates/blocks/' . $block_name . '/template.php';

            if (!file_exists($block_template)) {
                return;
            }

            if (function_exists('cbo_register_block_usage')) {
                cbo_register_block_usage($block_name);
            }

            if (!empty($args)) {
                extract($args);
            }

            require $block_template;
        }
    }
?>