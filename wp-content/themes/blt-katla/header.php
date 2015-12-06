<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/piwee-override.css"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <script>
        document.domain = "<?php echo $_SERVER["SERVER_NAME"]; ?>";

        $(document).ready(function () {
            $menuLeft = $('.pushmenu-left');
            $nav_list = $('#burger-button-lnk');

            $nav_list.click(function () {
                $(this).toggleClass('active');
                $('.pushmenu-push').toggleClass('pushmenu-push-toright');
                $(".mobile-header").toggleClass("disable-fixed-on-mobile-menu");
                $menuLeft.toggleClass('pushmenu-open');
            });
        });
    </script>
    <?php wp_head(); ?>
</head>
<body class="pushmenu-push">

<nav class="pushmenu pushmenu-left">
    <a href="/"><i class="fa fa-rss"></i> Les Articles</a>
    <a href="/category/fait-maison"><i class="fa fa-paint-brush"></i> Nos Créa</a>
    <a href="/category/petites-pensees"><i class="fa fa-pencil"></i> Petites Pensées</a>
    <a href="/top10"><i class="fa fa-trophy"></i> TOP 10</a>
    <a href="/random"><i class="fa fa-random"></i> Random</a>
</nav>

<main id="site">

    <header>
        <div class="container desktop-header hidden-sm hidden-xs">
            <div class="navbar-inner row">
                <div class="col-md-12">

                    <div class="piwee-logo">
                        <a href="<?php echo get_home_url() ?>">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-piwee.png">
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="container mobile-header hidden-lg hidden-md">
            <div class="row">
                <div class="col-xs-2 col-sm-2">
                    <div class="burger-button">
                        <a href="#" id="burger-button-lnk">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xs-8 col-sm-8 text-center">
                    <a href="<?php echo get_home_url() ?>">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-piwee-mobile.png"
                             class="piwee-mobile-icon">
                    </a>
                </div>
                <div class="col-xs-2 col-sm-2">

                </div>
            </div>
        </div>
    </header>

    <div class="secondary-menu hidden-sm hidden-xs">
        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <div class="collapse navbar-collapse" id="katla-sec-navbar">
                        <ul class="menu-header">
                            <li class="item-menu-header">
                                <a href="#">LES ARTICLES</a>

                                <div class="opened-menu-container">
                                    <div class="row">

                                        <div class="col-md-8">

                                            <div class="row">

                                                <div class="col-md-12">

                                                    <h3 class="title-menu-section">CATEGORIES</h3>
                                                    <hr>

                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-4">

                                                    <h4><a href="/category/inspiration"><i
                                                                class="fa fa-paint-brush"></i> ART</a></h4>

                                                    <p><a href="/category/inspiration/photographie">Photographie</a></a>
                                                    </p>

                                                    <p><a href="/category/inspiration/peinture">Peinture</a></p>

                                                    <p><a href="/category/inspiration/dessin">Dessin</a></p>

                                                    <p><a href="/category/inspiration/design">Design</a></p>

                                                    <p><a href="/category/inspiration/sculpture">Sculpture</a></p>

                                                    <h4><a href="/category/pub"><i class="fa fa-tv"></i> PUB</a></h4>

                                                    <p><a href="/category/pub/panneau-pub">Panneau Pub</a></p>

                                                    <p><a href="/category/pub/print">Print</a></p>

                                                    <p><a href="/category/pub/spot-video">Spot vidéo</a></p>

                                                    <p><a href="/category/pub/tv-insolites">TV insolites</a></p>

                                                </div>

                                                <div class="col-md-4">

                                                    <h4><a href="/category/marketing-2"><i class="fa fa-bullhorn"></i>
                                                            MARKETING</a></h4>

                                                    <p><a href="/category/marketing-2/operation-marketing">Opération
                                                            Marketing</a></p>

                                                    <p><a href="/category/marketing-2/street-marketing-2">Street
                                                            Marketing</a></p>

                                                    <p>
                                                        <a href="/category/marketing-2/sensibilisation">Sensibilisation</a>
                                                    </p>

                                                    <p><a href="/category/marketing-2/pop-up-store">Pop-up Store</a></p>

                                                    <h4><a href="/category/digital-2"><i
                                                                class="fa fa-mouse-pointer"></i> DIGITAL</a></h4>

                                                    <p><a href="/category/digital-2/operation-socialmedia">Opération
                                                            Social Media</a></p>

                                                    <p><a href="/category/digital-2/twitter">Twitter</a></p>

                                                    <p><a href="/category/digital-2/facebook">Facebook</a></p>

                                                    <p><a href="/category/digital-2/instagram">Instagram</a></p>

                                                    <p><a href="/category/digital-2/web-digital-2">Web</a></p>

                                                </div>

                                                <div class="col-md-4">

                                                    <h4><a href="/category/digital-2/twitter"><i
                                                                class="fa fa-twitter"></i> WE <3 TWITTER</a></h4>

                                                    <p><a href="/category/digital-2/twitter/cm">Community managers</a>
                                                    </p>

                                                    <p><a href="/category/digital-2/twitter/tweets-amusants">Tweets
                                                            marrants</a></p>

                                                    <p><a href="/category/digital-2/twitter/comptes-a-suivre">Les
                                                            comptes à suivre</a></p>

                                                    <h4><a href="/category/innovation"><i class="fa fa-cogs"></i>
                                                            INNOVATION</a></h4>

                                                    <h4><a href="/category/auto"><i class="fa fa-automobile"></i>
                                                            AUTO</a></h4>

                                                    <p><a href="/category/auto/pub-marketing">Pub/marketing</a></p>

                                                    <p><a href="/category/auto/essais">Essais</a></p>

                                                    <h4><a href="/category/gadget"><i class="fa fa-mobile"></i>
                                                            GADGET</a></h4>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="row">

                                                <h3 class="title-menu-section">ARTICLES</h3>
                                                <hr>

                                                <a class="btn-piwee" href="/genie">
                                                    <img
                                                        src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-genie.png">
                                                </a>
                                                <a class="btn-piwee" href="/creatif">
                                                    <img
                                                        src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-creatif.png">
                                                </a>
                                                <a class="btn-piwee" href="/deja-vu">
                                                    <img
                                                        src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-deja-vu.png">
                                                </a>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="row">

                                                <h3 class="title-menu-section">PIWEE</h3>
                                                <hr>

                                                <p class="piwee-title-menu-col3"><a href="/la-vie-du-blog">LA VIE DU
                                                        BLOG</a></p>

                                                <p class="piwee-title-menu-col3"><a href="/julienfabro">ABOUT</a></p>

                                                <p class="piwee-title-menu-col3"><a href="/partenaires">PARTENAIRES</a>
                                                </p>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </li>
                            <li class="item-menu-header"><a href="/category/fait-maison">NOS CREA</a></li>
                            <li class="item-menu-header"><a href="/category/petites-pensees"><i
                                        class="fa fa-pencil"></i> PETITES PENSEES</a></li>
                            <li class="item-menu-header"><a href="/top10"><i class="fa fa-trophy"></i> TOP 10</a></li>
                            <li class="item-menu-header"><a href="/random"><i class="fa fa-random"></i> RANDOM</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="site-body">