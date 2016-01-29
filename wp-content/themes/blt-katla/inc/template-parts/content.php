<?php

    $post = get_post(get_the_ID());
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');

?>

<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 article-vignette">
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