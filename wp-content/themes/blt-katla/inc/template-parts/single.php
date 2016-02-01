<article <?php post_class(); ?>>

    <h1 class="single-title"><?php the_title(); ?></h1>

    <div class="header-article">

        <div class="row">
            <div class="col-md-4 col-sm-8 col-xs-8">
                <div class="author-container">

                    <?php
                    echo get_avatar(get_the_author_meta('ID'));
                    the_author_posts_link();
                    echo '<br>';
                    the_date();
                    ?>

                </div>
            </div>
            <div class="col-md-8 col-sm-4 col-xs-4">
                <div class="share-container">
                    <div class="share-count">
                        <span
                            class="share-count-views"><?php echo shorten_number_k(get_total_share_count(get_the_ID())['total_share_count']) ?></span>
                        <br>
                        Partages
                    </div>
                    <div class="share-buttons">
                        <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>"
                           target="_blank">
                            <img class="hidden-xs hidden-sm"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-fb-btn.png">
                        </a>
                        <a href="https://twitter.com/home?status=<?php echo get_the_title() . ' ' . get_permalink() ?>"
                           target="_blank">
                            <img class="hidden-xs hidden-sm"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-twitter-btn.png">
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink() ?>&title=<?php echo get_the_title() . ' ' . get_permalink() ?>&summary=&source=Piwee.net"
                           target="_blank">
                            <img class="hidden-xs hidden-sm"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-linkedin.png">
                        </a>
                        <a href="https://pinterest.com/pin/create/button/?url=<?php echo get_permalink() ?>&description=<?php echo get_the_title() . ' ' . get_permalink() ?>"
                           target="_blank">
                            <img class="hidden-xs hidden-sm"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-pinterest.png">
                        </a>
                        <a href="mailto:?subject=<?php echo rawurlencode(get_the_title() . ' | Piwee.net') ?>&body=<?php echo rawurlencode(get_the_title() . ' ' . get_permalink()) ?>">
                            <img class="hidden-xs hidden-sm"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-mail.png">
                        </a>
                        <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>"
                           target="_blank">
                            <img class="hidden-md hidden-lg"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-fb.png">
                        </a>
                        <a href="https://twitter.com/home?status=<?php echo get_the_title() . ' ' . get_permalink() ?>"
                           target="_blank">
                            <img class="hidden-md hidden-lg"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-twitter.png">
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="post">
        <?php the_content(); ?>
    </div>

</article>