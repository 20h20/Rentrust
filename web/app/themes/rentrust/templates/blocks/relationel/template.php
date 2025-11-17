<?php
    $color  = get_field('relationel_color');
    $title  = get_field('relationel_title');
    $button = get_field('relationel_button');
    $last   = get_field('relationel_lastarticles');
    $is_articles_page = is_home() || is_category() || is_tag() || is_archive() || is_404();
?>

<section class="cbo-relation <?php echo ($color === 'beige') ? 'relation--beige' : ''; ?>">
    <div class="relation-inner cbo-container <?php echo ($color === 'beige') ? 'container--padding container--nomargin' : ''; ?>">

        <?php if ($title || $button): ?>
            <div class="relation-head slide-up">
                <?php if ($title): ?>
                    <div class="relation-title cbo-title-2 slide-up">
                        <?php echo wp_kses_post($title); ?>
                    </div>
                <?php endif; ?>

                <?php if ($button): ?>
                    <a class="relation-button cbo-button slide-up" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
                        <?php echo esc_html($button['title']); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php
            if ($is_articles_page) :
                get_part('filters/template');
            endif;
        ?>

        <div class="articles-list <?php echo !$is_articles_page ? 'relation-list' : ''; ?>">
            <?php
                if ($last) {
                    if ($is_articles_page) {
                        if (have_posts()) :
                            while (have_posts()) : the_post();
                            get_part('article/template');
                            endwhile;

                            if (function_exists('page_navi')) {
                                page_navi();
                            } else {
                                the_posts_pagination();
                            }
                        else:
                            echo '<p>' . esc_html__('Aucun article trouvé.', 'textdomain') . '</p>';
                        endif;
                    } else {
                        $args = [
                            'posts_per_page' => 4,
                            'post_status'   => 'publish',
                        ];
                        $posts_query = new WP_Query($args);
                        if ($posts_query->have_posts()) :
                            while ($posts_query->have_posts()) : $posts_query->the_post();
                            get_part('article/template');
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    }
                } else {
                    $acf_posts = get_field('relationel_articles');
                    if (!$is_articles_page && !empty($acf_posts)):
                        global $post;
                        $original_post = $post;
                        foreach ($acf_posts as $post):
                            setup_postdata($post);
                            get_part('article/template');
                        endforeach;
                        $post = $original_post;
                        wp_reset_postdata();
                    endif;
                }
            ?>
        </div>
    </div>
</section>