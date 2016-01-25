<?php
$parent = get_post_field('post_parent', get_the_ID());
$link = get_permalink($parent);
$title = get_the_title($parent);
?>


<article <?php post_class(); ?>>

    <h1 class="single-title">
        <a href="<?php echo $link ?>">
            <?php echo $title; ?>
        </a>
    </h1>

    <div class="header-article">

        <div class="row">
            <div class="col-md-4 col-sm-8 col-xs-8">
                <div class="author-container">

                    <?php
                    echo get_avatar(get_the_author_id());
                    echo '<a href="#">' . get_the_author() . '</a><br>';
                    the_date();
                    ?>

                </div>
            </div>
            <div class="col-md-8 col-sm-4 col-xs-4">
                <div class="share-container">
                    <div class="share-count">
                        <span class="share-count-views"><?php echo shorten_number_k(get_total_share_count(get_the_ID())['total_share_count']) ?></span>
                        <br>
                        Partages
                    </div>
                    <div class="share-buttons">
                        <img class="hidden-xs hidden-sm"
                             src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-fb-btn.png">
                        <img class="hidden-xs hidden-sm"
                             src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-twitter-btn.png">
                        <img class="hidden-xs hidden-sm"
                             src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-linkedin.png">
                        <img class="hidden-xs hidden-sm"
                             src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-pinterest.png">
                        <img class="hidden-xs hidden-sm"
                             src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-mail.png">
                        <img class="hidden-md hidden-lg"
                             src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-fb.png">
                        <img class="hidden-md hidden-lg"
                             src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-con-piwee-twitter.png">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="post attachment">
        <?php $image = wp_get_attachment_image_src(get_the_ID(), 'full') ?>
        <img src="<?php echo $image[0] ?>">
        <a href="<?php echo $link ?>">(Voir l'article)</a>
    </div>

</article>