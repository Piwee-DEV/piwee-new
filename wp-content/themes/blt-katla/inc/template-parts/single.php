<article <?php post_class(); ?>>

    <h1 class="single-title"><?php the_title(); ?></h1>

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
                        <span
                            class="share-count-views"><?php echo shorten_number_k(get_total_share_count(get_the_ID())['total_share_count']) ?></span>
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

    <div class="post">

        <?php

        ob_start();
        the_content();
        $content = ob_get_clean();

        if (mt_rand(0, 1) == 0) {
            $content = str_replace("ca-pub-9594201080211682", "ca-pub-0031647560032028", $content);
            $content = str_replace("9566298656", "5696989724", $content);
            $content = str_replace("6678475853", "7394048928", $content);
            $content = str_replace("7312035054", "2503493328", $content);
            $content = str_replace("3357873053", "7980959322", $content);
        }

        echo $content;

        ?>

    </div>

</article>