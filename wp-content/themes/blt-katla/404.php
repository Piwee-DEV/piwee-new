<?php get_header(); ?>


<?php

$permalink = $_SERVER["REQUEST_URI"];

if (strpos($permalink, 'recent') !== false) {

    $no404 = true;

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

    get_template_part('category');
}

if (!$no404):

    ?>

    <div class="container not-found">

        <div class="row">

            <div class="col-md-7 col-md-offset-3">

                <div class="notfound-img-container">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/404.jpg' ?>" class="notfound-img">
                </div>

                <div class="notfound-text-container">
                    <h1>Arf...</h1>

                    <p>Petite erreur. Cette page n'existe pas. Oui ça arrive, alors 3 solutions s'offrent à vous :</p>
                    <p>
                        <a href="<?php echo get_home_url() ?>">#1 Retourner sur Piwee</a>
                        <br>
                        <a href="<?php echo get_home_url() ?>">#2 Retourner sur Piwee</a>
                        <br>
                        <a href="<?php echo get_home_url() ?>">#3 Retourner sur Piwee</a>
                    </p>
                </div>

            </div>

        </div>

    </div>

<?php
    endif;
    get_footer();
?>