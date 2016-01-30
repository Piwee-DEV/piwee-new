<?php get_header(); ?>

    <div class="container post">

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="post-container">

                    <?php

                    if (have_posts()) {

                        while (have_posts()) {
                            the_post();

                            get_template_part('inc/template-parts/attachment', get_post_format());

                        }

                    } ?>

                </div>

                <div class="row">

                    <div class="post-below-widget-container col-md-12">
                        <?php
                        dynamic_sidebar('katla-below-post')
                        ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

<?php

get_footer();

?>