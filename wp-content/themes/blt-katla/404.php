<?php get_header(); ?>

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

<?php get_footer(); ?>