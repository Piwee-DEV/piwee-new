<?php get_header(); ?>

<header class="site-content-header">

    <div class="container">
        <h1 class="header-title"><?php printf(__('Résultats de la recherche pour : <span>%s</span>', 'bluthemes'), get_search_query()); ?></h1>
    </div>

</header><!-- .page-header -->

<div class="container search" class="clearfix">

    <div id="row">

        <div class="col-md-12">

            <?php

            if (is_archive()) {
                blt_archive_title('<h1 class="page-title">', '</h1>');
            }

            if (have_posts()) {

                while (have_posts()) {

                    the_post();
                    get_template_part('inc/template-parts/content', get_post_format());
                }

            } else {

                get_template_part('inc/template-parts/content', 'none');
            }

            ?>
        </div>

    </div>


    <div id="row">

        <div class="col-md-12 pagination-container">

            <?php

            if (have_posts()) {

                // Previous/next page navigation.
                the_posts_pagination(array(
                    'prev_text' => __('Page précédente', 'bluthemes'),
                    'next_text' => __('Page suivante', 'bluthemes'),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'bluthemes') . ' </span>',
                ));

            }

            ?>

        </div>

    </div>

</div>

<?php get_footer(); ?>			