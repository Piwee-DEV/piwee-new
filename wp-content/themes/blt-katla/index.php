<?php get_header(); ?>

<?php

    $week = date('W.m.Y');

    $most_shared_post_of_the_week_x_next = query_posts(
        array(
            'meta_key' => 'share_count_week_diff_' . $week,
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'posts_per_page' => 3,
            'ignore_sticky_posts' => 1
        )
    );

?>
<?php $recent_posts = query_posts(array('posts_per_page' => 8, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish', 'ignore_sticky_posts' => 1)); ?>
<?php $marketing_posts = query_posts(array('category__in' => array(211), 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish')); ?>
<?php $infographie_posts = query_posts(array('category__in' => array(1393), 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish')); ?>
<?php $citations_posts = query_posts(array('category__in' => array(1158), 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish')); ?>

    <div class="container home">

        <div class="row flex-row">

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                <div class="article-mega-featured">

                    <a href="<?php echo get_permalink($most_shared_post_of_the_week_x_next[0]->ID) ?>">
                        <div class="article-mega-featured-img-container big">
                            <?php echo get_the_post_thumbnail($most_shared_post_of_the_week_x_next[0]->ID, "attachment-large") ?>
                            <div class="sharing-interactive">
                                <?php if (function_exists("social_shares_button")) social_shares_button($most_shared_post_of_the_week_x_next[0]->ID); ?>
                            </div>
                            <div class="article-mega-featured-title">
                                <h2><?php echo $most_shared_post_of_the_week_x_next[0]->post_title; ?></h2>
                            </div>
                        </div>
                    </a>

                </div>

            </div>


            <div
                class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm article-mega-featured-secondary-container">

                <div class="article-mega-featured smaller">

                    <a href="<?php echo get_permalink($most_shared_post_of_the_week_x_next[1]->ID) ?>">

                        <div class="article-mega-featured-img-container">
                            <?php echo get_the_post_thumbnail($most_shared_post_of_the_week_x_next[1]->ID, "attachment-large") ?>
                            <div class="sharing-interactive">
                                <?php if (function_exists("social_shares_button")) social_shares_button($most_shared_post_of_the_week_x_next[1]->ID); ?>
                            </div>
                            <div class="article-mega-featured-title">
                                <h2><?php echo $most_shared_post_of_the_week_x_next[1]->post_title; ?></h2>
                            </div>
                        </div>

                    </a>

                </div>

                <div class="article-mega-featured smaller secondary">

                    <a href="<?php echo get_permalink($most_shared_post_of_the_week_x_next[2]->ID) ?>">

                        <div class="article-mega-featured-img-container">
                            <?php echo get_the_post_thumbnail($most_shared_post_of_the_week_x_next[2]->ID, "attachment-large") ?>
                            <div class="sharing-interactive">
                                <?php if (function_exists("social_shares_button")) social_shares_button($most_shared_post_of_the_week_x_next[2]->ID); ?>
                            </div>
                            <div class="article-mega-featured-title">
                                <h2><?php echo $most_shared_post_of_the_week_x_next[2]->post_title; ?></h2>
                            </div>
                        </div>
                    </a>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                <hr>

                <div class="title-section">

                    <h3>DERNIERS ARTICLES</h3>

                    <p>Marketing, art, innovation, CM...<br>Toutes les idées & concepts créatifs, amusants &
                        inspirants du moment</p>

                </div>


                <div class="row">

                    <?php foreach ($recent_posts as $post): ?>

                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 article-vignette">
                            <div class="article-vignette-inside-image"
                                 style="background-image: url('<?php echo $image[0]; ?>')">
                                <a href="<?php echo get_permalink($post->ID); ?>" class="home-article-background-link">
                                </a>

                                <div class="sharing-interactive" id="sharing-interactive-<?php echo $post->ID; ?>"
                                     onmouseover="openSharePanelForID('<?php echo $post->ID; ?>')"
                                     onmouseout="hideSharePanelForID('<?php echo $post->ID; ?>');">
                                    <?php if (function_exists("social_shares_button")) social_shares_button($post->ID); ?>
                                    <div id="post-share-box-<?php echo $post->ID; ?>" class="post-share-article">
                                        <div class="fb-like" data-href="<?php echo get_permalink($post->ID); ?>"
                                             data-layout="button" data-action="like" data-show-faces="false"
                                             data-share="false"></div>
                                        <a href="http://twitter.com/share" class="twitter-share-button"
                                           {count}>Tweet</a>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo get_permalink($post->ID); ?>">
                                <div class="article-vignette-inside-text">
                                    <h4><?php echo $post->post_title; ?></h4>
                                </div>
                            </a>
                        </div>

                    <?php endforeach ?>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-12">
                        <div class="title-section">
                            <h3>PENSÉES ET PETITES PHRASES</h3>

                            <p>Tous les matins, une petite phrase pour vous inspirer et vous faire attaquer la journée
                                avec
                                le sourire</p>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <?php foreach ($citations_posts as $post): ?>

                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>

                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <a href="<?php echo get_permalink($post->ID); ?>">
                                <img src="<?php echo $image[0]; ?>">
                            </a>
                        </div>

                    <?php endforeach ?>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-12 more-margin">
                        <div class="title-section">

                            <h3>MARKETING & COM</h3>

                            <p>Un street marketing créatif, un spot viral, une opération digitale amusante...<br>ça se
                                passe
                                ici (et on adore ça !)</p>

                        </div>
                    </div>

                </div>

                <div class="row">

                    <?php foreach ($marketing_posts as $post): ?>

                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 article-vignette">
                            <div class="article-vignette-inside-image"
                                 style="background-image: url('<?php echo $image[0]; ?>')">
                                <a href="<?php echo get_permalink($post->ID); ?>" class="home-article-background-link">
                                </a>

                                <div class="sharing-interactive" id="sharing-interactive-<?php echo $post->ID; ?>"
                                     onmouseover="openSharePanelForID('<?php echo $post->ID; ?>')"
                                     onmouseout="hideSharePanelForID('<?php echo $post->ID; ?>');">
                                    <?php if (function_exists("social_shares_button")) social_shares_button($post->ID); ?>
                                    <div id="post-share-box-<?php echo $post->ID; ?>" class="post-share-article">
                                        <div class="fb-like" data-href="<?php echo get_permalink($post->ID); ?>"
                                             data-layout="button" data-action="like" data-show-faces="false"
                                             data-share="false"></div>
                                        <a href="http://twitter.com/share" class="twitter-share-button"
                                           {count}>Tweet</a>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo get_permalink($post->ID); ?>">
                                <div class="article-vignette-inside-text">
                                    <h4><?php echo $post->post_title; ?></h4>
                                </div>
                            </a>
                        </div>

                    <?php endforeach ?>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-12 more-margin">
                        <div class="title-section">
                            <h3>INFOGRAPHIES</h3>

                            <p>Plein de petites choses du quotidien expliquées avec des picto</p>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <?php foreach ($infographie_posts as $post): ?>

                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 article-vignette">
                            <div class="article-vignette-inside-image"
                                 style="background-image: url('<?php echo $image[0]; ?>')">
                                <a href="<?php echo get_permalink($post->ID); ?>" class="home-article-background-link">
                                </a>

                                <div class="sharing-interactive" id="sharing-interactive-<?php echo $post->ID; ?>"
                                     onmouseover="openSharePanelForID('<?php echo $post->ID; ?>')"
                                     onmouseout="hideSharePanelForID('<?php echo $post->ID; ?>');">
                                    <?php if (function_exists("social_shares_button")) social_shares_button($post->ID); ?>
                                    <div id="post-share-box-<?php echo $post->ID; ?>" class="post-share-article">
                                        <div class="fb-like" data-href="<?php echo get_permalink($post->ID); ?>"
                                             data-layout="button" data-action="like" data-show-faces="false"
                                             data-share="false"></div>
                                        <a href="http://twitter.com/share" class="twitter-share-button"
                                           {count}>Tweet</a>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo get_permalink($post->ID); ?>">
                                <div class="article-vignette-inside-text">
                                    <h4><?php echo $post->post_title; ?></h4>
                                </div>
                            </a>
                        </div>

                    <?php endforeach ?>

                </div>

                <div class="home-below-widget-container col-md-12">
                    <?php
                    dynamic_sidebar('katla-below-home')
                    ?>
                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">

                <hr>

                <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                    <?php get_sidebar('home'); ?>
                </div>

            </div>

        </div>

    </div>


<?php get_footer(); ?>