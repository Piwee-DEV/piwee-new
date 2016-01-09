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
                <div class="col-md-3 articles-headband-col">
                    <div class="articles-headband">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/options-icon.png">
                        <span>LES ARTICLES</span>
                    </div>

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
                </div>
                <div class="col-md-6">
                    <div class="piwee-logo">
                        <a href="<?php echo get_home_url() ?>">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-piwee.png">
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="social-network-headband">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-fb-gold.png">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-twitter-gold.png">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-instagram-gold.png">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-rss-gold.png">
                    </div>
                </div>
            </div>
        </div>

        <div class="container mobile-header hidden-lg hidden-md">
            <div clas="row">
                <div class="col-xs-3 mobile-header-col">
                    <div class="burger-button">
                        <a href="#" id="burger-button-lnk">
                            <img
                                src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/options-icon-gold.png"
                                class="piwee-burger-icon">
                        </a>
                    </div>
                </div>
                <div class="col-xs-6 mobile-header-col-2 mobile-header-col">
                    <a href="<?php echo get_home_url() ?>">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-piwee-mobile.png"
                             class="piwee-mobile-icon">
                    </a>
                </div>
                <div class="col-xs-3 mobile-header-col">
                    <div class="mobile-header-post-type-container <?php if(!is_single()): ?>hidden-xs hidden-sm <?php endif ?>">

                        <div class="open-menu-post-type">
                            <div class="menu-post-type-text">
                                <span class="percent">50%</span>
                                <br>
                                <span class="description">Génie</span>
                            </div>
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-genie.png">
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="mobile-menu-post-type-opened">
            <div class="container">
                <div class="row bar">
                    <div class="col-xs-2 bar-item bar-img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-genie.png">
                    </div>
                    <div class="col-xs-8 bar-item bar-progress">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percentage="50">
                                <span class="sr-only">40% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 bar-item bar-percent">
                        <span>50%</span>
                    </div>
                </div>

                <div class="row bar">
                    <div class="col-xs-2 bar-item bar-img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-fun.png">
                    </div>
                    <div class="col-xs-8 bar-item bar-progress">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percentage="20">
                                <span class="sr-only">20% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 bar-item bar-percent">
                        <span>20%</span>
                    </div>
                </div>

                <div class="row bar">
                    <div class="col-xs-2 bar-item bar-img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-creatif.png">
                    </div>
                    <div class="col-xs-8 bar-item bar-progress">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percentage="20">
                                <span class="sr-only">20% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 bar-item bar-percent">
                        <span>20%</span>
                    </div>
                </div>

                <div class="row bar">
                    <div class="col-xs-2 bar-item bar-img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-dejavu.png">
                    </div>
                    <div class="col-xs-8 bar-item bar-progress">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="10"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%" data-percentage="10">
                                <span class="sr-only">10% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 bar-item bar-percent">
                        <span>10%</span>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <div class="secondary-menu hidden-sm hidden-xs">
        <div class="container">
            <div class="row">

                <div class="col-md-10">

                    <div class="collapse navbar-collapse" id="katla-sec-navbar">
                        <ul class="menu-header">
                            <li class="item-menu-header"><a href="/category/inspiration">ART</a></li>
                            <li class="item-menu-header"><a href="/category/marketing-2">MARKETING</a></li>
                            <li class="item-menu-header"><a href="/category/innovation">INNOVATION</a></li>
                            <li class="item-menu-header"><a href="/category/infographie">INFOGRAPHIES</a></li>
                            <li class="item-menu-header"><a href="/tops">TOPS</a></li>
                            <li class="item-menu-header"><a href="/category/digital-2/twitter">WE <i class="fa fa-heart"></i>
                                    TWITTER</a></li>
                            <li class="item-menu-header"><a href="/category/petites-pensees">PENSEES</a></li>
                            <li class="item-menu-header"><a href="/random">RANDOM</a></li>
                            <li class="item-menu-header"><a href="/top10">TOP 10</a></li>
                        </ul>
                    </div>

                </div>

                <div class="col-md-2">
                    <div class="input-group">
                        <input type="text" class="form-control custom-search-headband">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="secondary-header hidden-sm hidden-xs">

        <div class="container">

            <div class="row">
                <div class="col-md-4 secondary-header-share-container">
                    <span class="secondary-header-share-text">Partagez cet article</span>

                    <div class="secondary-header-shareimg-container">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/FB_icon_piwee.png">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/twitter_icon_piwee.png">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/inta_icon_piwee.png">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/mail_icon_piwee.png">
                    </div>
                </div>
                <div class="col-md-4 secondary-header-logo-container">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-piwee-white-header.png">
                </div>
                <div class="col-md-4">

                    <div class="secondary-header-post-type-container">

                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-genie.png">

                        <div>
                            <span class="percent">70%</span>
                            <br>
                            <span class="description">Génie</span>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>


    <div id="site-body">