<?php get_header(); ?>

<?php
    $permalink = $_SERVER["REQUEST_URI"];

    if (strpos($permalink, 'top10') !== false) {

        $title = 'Top 10';

        $posts = query_posts(
            array(
                'meta_key' => 'total_share_count',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'posts_per_page' => 10,
                'ignore_sticky_posts' => 1
            )
        );
    }
    else {
        $category = get_the_category();
        $title = $category[0]->name;
        $posts = query_posts(array('category__in' => array($category[0]->cat_ID), 'posts_per_page' => 10, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish'));
    }
?>

    <div class="container archive">

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                <div class="row">

                    <div class="col-md-12">
                        <div class="title-section archive">
                            <h3><?php echo $title; ?></h3>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <?php foreach ($posts as $post): ?>

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

            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">

                <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                    <?php get_sidebar('home'); ?>
                </div>

            </div>

        </div>

    </div>

<?php get_footer(); ?>