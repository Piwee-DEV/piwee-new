<?php get_header(); ?>

<?php


$most_shared_post_of_the_week_x_next = get_most_shared_posts_of_the_week(3);

//Get the first sticky post if there is
$sticky_query = query_posts(array(
    'posts_per_page' => 1,
    'post__in' => get_option('sticky_posts'),
    'ignore_sticky_posts' => 1
));
$sticky_post = $sticky_query[0];

$first_big_post = $sticky_post ? $sticky_post : $most_shared_post_of_the_week_x_next[0];

$recent_posts = query_posts(array('offset' => 0, 'cat' => -1459, 'posts_per_page' => 8, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
$marketing_posts = query_posts(array('category__in' => getCategoryIdsArrayFromParent(211), 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish'));
$infographie_posts = query_posts(array('category__in' => getCategoryIdsArrayFromParent(1393), 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish'));
$citations_posts = query_posts(array('category__in' => getCategoryIdsArrayFromParent(1459), 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish'));
$we_love_twitter_posts = query_posts(array('category__in' => getCategoryIdsArrayFromParent(359), 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish'));

?>

<div class="container home">

    <div class="row flex-row">

        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

            <div class="article-mega-featured">

                <a href="<?php echo get_permalink($first_big_post->ID) ?>">
                    <div class="article-mega-featured-img-container big">
                        <?php echo get_the_post_thumbnail($first_big_post->ID, "attachment-large") ?>
                        <div class="sharing-interactive">
                            <?php if (function_exists("social_shares_button")) social_shares_button($first_big_post->ID); ?>
                        </div>
                        <div class="article-mega-featured-title">
                            <h2><?php echo $first_big_post->post_title; ?></h2>
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

                            <?php
                            $brand = get_brand_for_post_or_category($post->ID);
                            if (isset($brand)) :
                                ?>

                                <div class="article-vignette-branding"><img src="<?php echo $brand['brandLogo'] ?>">
                                    <span class="brandPresentedBy">Présenté par : <span
                                            class="brandName"><?php echo $brand['brandName'] ?></span></span></div>

                            <?php endif; ?>

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

            <div class="row">
                <div class="col-md-12">
                    <a href="<?php get_home_url() ?>/category/recent" class="sub-category-btn">
                        <i class="fa fa-chevron-right"></i> Tous les nouveaux articles
                    </a>
                </div>
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

            <div class="row citations-container">

                <div class="col-md-12" style="padding-left:10px;padding-right:10px;">

                    <?php foreach ($citations_posts as $post): ?>

                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>

                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 citation-col">
                            <a href="<?php echo get_permalink($post->ID); ?>">
                                <img src="<?php echo $image[0]; ?>">
                            </a>
                        </div>

                    <?php endforeach ?>

                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <a href="<?php get_home_url() ?>/category/petites-pensees" class="sub-category-btn">
                        <i class="fa fa-chevron-right"></i> Toutes les pensées
                    </a>
                </div>
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

                            <?php
                            $brand = get_brand_for_post_or_category($post->ID);
                            if (isset($brand)) :
                                ?>

                                <div class="article-vignette-branding"><img src="<?php echo $brand['brandLogo'] ?>">
                                    <span class="brandPresentedBy">Présenté par : <span
                                            class="brandName"><?php echo $brand['brandName'] ?></span></span></div>

                            <?php endif; ?>

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

            <div class="row">
                <div class="col-md-12">
                    <a href="<?php get_home_url() ?>/category/marketing-2" class="sub-category-btn">
                        <i class="fa fa-chevron-right"></i> La suite
                    </a>
                </div>
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

            <div class="row">
                <div class="col-md-12">
                    <a href="<?php get_home_url() ?>/category/infographie" class="sub-category-btn">
                        <i class="fa fa-chevron-right"></i> La suite
                    </a>
                </div>
            </div>

            <hr>

            <div class="row">

                <div class="col-md-12 more-margin">
                    <div class="title-section">
                        <h3>WE <i class="fa fa-heart" style="color: #e84c3d; font-size: 1.0em;"></i> TWITTER</h3>

                        <p>On aime aussi les Community Managers et leurs réactions marrantes<br>mais aussi les
                            twittos qui nous font rire tous les jours</p>
                    </div>
                </div>

            </div>

            <div class="row">

                <?php foreach ($we_love_twitter_posts as $post): ?>

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

            <div class="row">
                <div class="col-md-12">
                    <a href="<?php get_home_url() ?>/category/digital-2/twitter" class="sub-category-btn">
                        <i class="fa fa-chevron-right"></i> La suite
                    </a>
                </div>
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
