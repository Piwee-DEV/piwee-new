<?php get_header(); ?>

<?php
$permalink = $_SERVER["REQUEST_URI"];

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

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
} else if (strpos($permalink, 'recent') !== false) {

    $title = 'Récemment';

    $posts = query_posts(
        array(
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 10,
            'ignore_sticky_posts' => 1,
            'cat' => -1459,
            'paged' => $paged
        )
    );
} else if ($vp = getVotePostsForCategory($permalink)) {
    $title = $vp['title'];
    $posts = $vp['posts'];
} else {
    $category = get_category(get_query_var('cat'));;
    $title = $category->name;
    $posts = query_posts(array('paged' => $paged, 'category__in' => array($category->cat_ID), 'posts_per_page' => 10, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish'));
}
?>

    <div class="container category">

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

                <div id="row">

                    <div class="col-md-12 pagination-container">

                        <?php

                        if (have_posts() && strpos($permalink, 'top10') === false) {

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

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">

                <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                    <?php get_sidebar('home'); ?>
                </div>

            </div>

        </div>

    </div>

<?php get_footer(); ?>