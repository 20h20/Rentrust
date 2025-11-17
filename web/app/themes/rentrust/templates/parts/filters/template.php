<nav class="cbo-filters" aria-label="Filtrer les articles par catégorie">
    <div class="filters-inner slide-up">
        <div class="filters-menu">
            <span id="filter-label">Filtrer par :</span>
        </div>
        <ul class="filters-list" aria-labelledby="filter-label" itemscope itemtype="https://schema.org/SiteNavigationElement" aria-label="Filtrer les articles par catégorie">
            <?php
                $args = array(
                    'orderby' => 'name',
                    'order'   => 'ASC'
                );
                $cats = get_categories($args);
                $is_main_archive = is_home() || is_post_type_archive('post');
                $current_cat_id = get_queried_object_id();
                $all_articles_link = get_permalink(get_option('page_for_posts'));

                echo '<li><a class="list-el ' . ($is_main_archive ? 'el--active' : '') . '" href="' . esc_url($all_articles_link) . '" itemprop="url">';
                echo '<span class="el-inner">Tous les articles</span></a></li>';

                foreach ($cats as $cat) {
                    $active_class = ($current_cat_id == $cat->term_id) ? 'el--active' : '';
                    echo '<li><a class="list-el ' . esc_attr($active_class) . '" href="' . esc_url(get_term_link($cat->term_id)) . '" itemprop="url">';
                    echo '<span class="el-inner">' . esc_html($cat->name) . '</span></a></li>';
                }
            ?>
        </ul>
    </div>
</nav>
