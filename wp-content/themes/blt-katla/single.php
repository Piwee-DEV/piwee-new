<?php get_header(); ?>

    <div class="container">

        <div class="row">

            <div class="post-container col-xs-12 col-sm-12 col-md-8 col-lg-8">

                <?php

                if ($ad_spot_between_posts = blt_get_option('spot_above_content', 'none') != 'none') {
                    blt_get_ad_spot('spot_above_content');
                }

                if (have_posts()) {

                    while (have_posts()) {
                        the_post();

                        get_template_part('inc/template-parts/single', get_post_format());

                        get_template_part('inc/template-parts/post-share');

                        // Previous/next post navigation.
                        the_post_navigation(array(
                            'next_text' => '<span class="meta-nav meta-nav-next" aria-hidden="true">' . __('Next', 'bluthemes') . '</span><span class="post-title">%title</span>',
                            'prev_text' => '<span class="meta-nav meta-nav-prev" aria-hidden="true">' . __('Previous', 'bluthemes') . '</span><span class="post-title">%title</span>',
                        ));

                        // Related Posts
                        if (blt_get_option('show_related_posts', true)) {
                            get_template_part('inc/template-parts/post-related');
                        }
                    }

                    // If comments are open load up the default comment template provided by Wordpress
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }

                } ?>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                    <aside id="site-content-sidebar">
                        <div class="content-sidebar-wrap">
                            <?php dynamic_sidebar('katla-right-post'); ?>
                        </div>
                    </aside>
                </div>
            </div>

        </div>

    </div>

<?php

get_footer();

?>