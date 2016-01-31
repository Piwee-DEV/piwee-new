<?php

if (is_single()) {

    //Getting the #1 Vote entity
    $maxVoteEntity = getMaxVoteEntity(get_the_ID());

    $vote_icon = '';

    switch ($maxVoteEntity['name']) {
        case "Génie":
            $vote_icon = get_template_directory_uri() . '/assets/img/piwee-icon/GENIE-flat-icons-piwee.png';
            break;
        case "déjà vu":
            $vote_icon = get_template_directory_uri() . '/assets/img/piwee-icon/DEJA-VU-flat-icons-piwee.png';
            break;
        case "Fun":
            $vote_icon = get_template_directory_uri() . '/assets/img/piwee-icon/FUN-flat-icons-piwee.png';
            break;
        case "Créatif":
            $vote_icon = get_template_directory_uri() . '/assets/img/piwee-icon/CREATIF-flat-icons-piwee.png';
            break;
    }

}

?>

<?php $votes = getPostVoteCountAndPercent(get_the_ID()); ?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/piwee-override.css"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/sweetalert.css"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/assets/js/sweetalert.min.js"></script>
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



    <?php

    //TODO : refactor this snippet

    $fullsite_campain_bg_image = get_option("campain_bg_image");
    $fullsite_campain_mobile_header = get_option("campain_mobile_header");
    $fullsite_campain_margin_top = get_option("campain_margin_top");
    $fullsite_campain_url = get_option("campain_url");
    $fullsite_campain_injected_code = get_option("campain_injected_code");
    $fullsite_campain_background_color = get_option("campain_background_color");

    $campain_bg_image = get_post_meta(get_the_ID(), "campain_bg_image", true);
    $campain_mobile_header = get_post_meta(get_the_ID(), "campain_mobile_header", true);
    $campain_margin_top = get_post_meta(get_the_ID(), "campain_margin_top", true);
    $campain_url = get_post_meta(get_the_ID(), "campain_url", true);
    $campain_injected_code = get_post_meta(get_the_ID(), "campain_injected_code", true);
    $campain_background_color = get_post_meta(get_the_ID(), "campain_background_color", true);

    //article
    if (!is_home() && is_single(get_the_ID()) && strlen($campain_bg_image) > 0 && strlen($campain_margin_top) > 0) {
        $isCampain = true;
        $display_video = false;
    } //fullsite
    else if ((is_home() || is_single(get_the_ID())) && strlen($fullsite_campain_bg_image) > 0 && strlen($fullsite_campain_margin_top) > 0) {
        $isCampain = true;
        $display_video = true;

        $campain_bg_image = $fullsite_campain_bg_image;
        $campain_mobile_header = $fullsite_campain_mobile_header;
        $campain_margin_top = $fullsite_campain_margin_top;
        $campain_url = $fullsite_campain_url;
        $campain_injected_code = $fullsite_campain_injected_code;
        $campain_background_color = $fullsite_campain_background_color;
    } else {
        $isCampain = false;
    }

    if ($isCampain) {

        ?>

        <style type="text/css">
            .campain_bg {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
                cursor: pointer;
                z-index: 1;
            }

            #campain_mobile_header {
                margin-top: 60px;
                display: none;
            }

            .wrapperVideo {
                width: 1020px;
                position: relative;
            }

            @media (min-width: 480px) {
                #site-body {
                    padding-top: <?php echo $campain_margin_top ?>px;
                }
            }

            @media only screen and (min-width: 480px) and (max-width: 1224px) {
                body {
                    padding-top: 0;
                }

                #campain_mobile_header {
                    display: block;
                }

                .wrapperVideo {
                    display: none;
                }
            }

            @media (max-width: 480px) {

                #campain_mobile_header {
                    margin-top: 60px;
                    display: block;
                }

                .wrapperVideo {
                    display: none;
                }
            }
        </style>

        <?php

        $campain_onclick_script = '
        <script>

        jQuery(document).ready(function() {

            jQuery(\'#campain_bg\').click(function(e){
                window.open("' . $campain_url . '");
                TrackClick(\'' . $campain_url . '\', \'' . $campain_url . '\');
            });

        });
        </script>';
    }

    ?>

    <?php echo $campain_onclick_script; ?>

</head>

<body class="pushmenu-push">

<nav class="pushmenu pushmenu-left">
    <a href="/"><i class="fa fa-rss"></i> Les Articles</a>
    <a href="/category/fait-maison"><i class="fa fa-paint-brush"></i> Nos Créa</a>
    <a href="/category/petites-pensees"><i class="fa fa-pencil"></i> Petites Pensées</a>
    <a href="/category/top10"><i class="fa fa-trophy"></i> TOP 10</a>
    <a href="/random"><i class="fa fa-random"></i> Random</a>
</nav>

<main id="site">

    <header>
        <div class="container desktop-header hidden-sm hidden-xs">
            <div class="navbar-inner row">
                <div class="col-md-3 articles-headband-col">
                    <div class="articles-headband">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/options-icon.png">
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

                                    <a class="btn-piwee" href="/category/genie">
                                        <img
                                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-genie.png">
                                    </a>
                                    <a class="btn-piwee" href="/category/creatif">
                                        <img
                                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-creatif.png">
                                    </a>
                                    <a class="btn-piwee" href="/category/deja-vu">
                                        <img
                                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-deja-vu.png">
                                    </a>
                                    <a class="btn-piwee" href="/category/fun">
                                        <img
                                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-fun.png">
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
                        <a href="https://www.facebook.com/piwee.net" target="_blank">
                            <img
                                src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-fb-gold.png">
                        </a>
                        <a href="https://twitter.com/piweeFR" target="_blank">
                            <img
                                src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-twitter-gold.png">
                        </a>
                        <a href="https://www.instagram.com/piweefr" target="_blank">
                            <img
                                src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-instagram-gold.png">
                        </a>
                        <a href="<?php get_home_url() ?>/feed" target="_blank">
                            <img
                                src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-rss-gold.png">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mobile-header hidden-lg hidden-md">
            <div class="container">
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
                        <div
                            class="mobile-header-post-type-container <?php if (!is_single()): ?>hidden-xs hidden-sm <?php endif ?>">

                            <div class="open-menu-post-type">

                                <?php if ($maxVoteEntity): ?>

                                    <div class="menu-post-type-text max-vote-entity">
                                        <span class="percent"><?php echo $maxVoteEntity['percent'] ?>%</span>
                                        <span class="description"><?php echo $maxVoteEntity['name'] ?></span>
                                    </div>

                                    <img src="<?php echo $vote_icon ?>" class="img-max-entity">

                                <?php endif ?>

                            </div>

                        </div>
                    </div>

                    <div class="menu-post-type-opened">
                        <p class="total-vote-count"><?php echo $votes['total'] ?> votes</p>
                        <div class="row bar">
                            <div class="col-xs-2 bar-item bar-img">
                                <a href="#"
                                   onclick="PiweeVote(<?php echo get_the_ID(); ?>, <?php echo getChoiceIdByName('Génie'); ?>); return false;">
                                    <img
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-genie.png">
                                </a>
                            </div>
                            <div class="col-xs-8 bar-item bar-progress">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                         aria-valuenow="<?php echo $votes['Génie']['percent'] ?>"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                         data-percentage="<?php echo $votes['Génie']['percent'] ?>"
                                         data-name="Génie">
                                <span class="sr-only"><?php echo $votes['Génie']['percent'] ?>
                                    % Complete (success)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2 bar-item bar-percent">
                                <span><?php echo $votes['Génie']['percent'] ?>%</span>
                            </div>
                        </div>

                        <div class="row bar">
                            <div class="col-xs-2 bar-item bar-img">
                                <a href="#"
                                   onclick="PiweeVote(<?php echo get_the_ID(); ?>, <?php echo getChoiceIdByName('Fun'); ?>); return false;">
                                    <img
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-fun.png">
                                </a>
                            </div>
                            <div class="col-xs-8 bar-item bar-progress">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                         aria-valuenow="<?php echo $votes['Fun']['percent'] ?>"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                         data-percentage="<?php echo $votes['Fun']['percent'] ?>"
                                         data-name="Fun">
                                        <span class="sr-only"><?php echo $votes['Fun']['percent'] ?>
                                            % Complete (success)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2 bar-item bar-percent">
                                <span><?php echo $votes['Fun']['percent'] ?>%</span>
                            </div>
                        </div>

                        <div class="row bar">
                            <div class="col-xs-2 bar-item bar-img">
                                <a href="#"
                                   onclick="PiweeVote(<?php echo get_the_ID(); ?>, <?php echo getChoiceIdByName('Créatif'); ?>); return false;">
                                    <img
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-creatif.png">
                                </a>
                            </div>
                            <div class="col-xs-8 bar-item bar-progress">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                         aria-valuenow="<?php echo $votes['Créatif']['percent'] ?>"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                         data-percentage="<?php echo $votes['Créatif']['percent'] ?>"
                                         data-name="Créatif">
                                <span class="sr-only"><?php echo $votes['Créatif']['percent'] ?>
                                    % Complete (success)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2 bar-item bar-percent">
                                <span><?php echo $votes['Créatif']['percent'] ?>%</span>
                            </div>
                        </div>

                        <div class="row bar">
                            <div class="col-xs-2 bar-item bar-img">
                                <a href="#"
                                   onclick="PiweeVote(<?php echo get_the_ID(); ?>, <?php echo getChoiceIdByName('déjà vu'); ?>); return false;">
                                    <img
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-dejavu.png">
                                </a>
                            </div>
                            <div class="col-xs-8 bar-item bar-progress">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar"
                                         aria-valuenow="<?php echo $votes['déjà vu']['percent'] ?>"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                         data-percentage="<?php echo $votes['déjà vu']['percent'] ?>"
                                         data-name="déjà vu">
                                <span class="sr-only"><?php echo $votes['déjà vu']['percent'] ?>
                                    % Complete (success)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2 bar-item bar-percent">
                                <span><?php echo $votes['déjà vu']['percent'] ?>%</span>
                            </div>
                        </div>
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
                            <li class="item-menu-header"><a href="/category/compilations">TOPS</a></li>
                            <li class="item-menu-header"><a href="/category/digital-2/twitter">WE <i
                                        class="fa fa-heart"></i>
                                    TWITTER</a></li>
                            <li class="item-menu-header"><a href="/category/petites-pensees">PENSEES</a></li>
                            <li class="item-menu-header"><a href="<?php echo get_the_guid(get_random_post()->ID) ?>">RANDOM</a>
                            </li>
                            <li class="item-menu-header"><a href="/category/top10">TOP 10</a></li>
                        </ul>
                    </div>

                </div>

                <div class="col-md-2">
                    <?php get_search_form(); ?>
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
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/FB_icon_piwee.png">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/twitter_icon_piwee.png">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/inta_icon_piwee.png">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/mail_icon_piwee.png">
                    </div>
                </div>
                <div class="col-md-4 secondary-header-logo-container">
                    <a href="<?php echo get_home_url() ?>">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/logo-piwee-white-header.png">
                    </a>
                </div>
                <div class="col-md-4">

                    <div class="secondary-header-post-type-container open-menu-post-type">

                        <?php if ($maxVoteEntity): ?>

                            <img src="<?php echo $vote_icon ?>" class="img-max-entity">

                            <div class="max-vote-entity">
                                <span class="percent"><?php echo $maxVoteEntity['percent'] ?>%</span>
                                <br>
                                <span class="description"><?php echo $maxVoteEntity['name'] ?></span>
                            </div>

                        <?php endif ?>

                    </div>

                </div>
            </div>


            <div class="menu-post-type-opened">
                <p class="total-vote-count"><?php echo $votes['total'] ?> votes</p>
                <div class="row bar">
                    <div class="col-xs-2 bar-item bar-img">
                        <a href="#"
                           onclick="PiweeVote(<?php echo get_the_ID(); ?>, <?php echo getChoiceIdByName('Génie'); ?>); return false;">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-genie.png">
                        </a>
                    </div>
                    <div class="col-xs-8 bar-item bar-progress">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                 aria-valuenow="<?php echo $votes['Génie']['percent'] ?>"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                 data-percentage="<?php echo $votes['Génie']['percent'] ?>"
                                 data-name="Génie">
                                <span class="sr-only"><?php echo $votes['Génie']['percent'] ?>
                                    % Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 bar-item bar-percent">
                        <span><?php echo $votes['Génie']['percent'] ?>%</span>
                    </div>
                </div>

                <div class="row bar">
                    <div class="col-xs-2 bar-item bar-img">
                        <a href="#"
                           onclick="PiweeVote(<?php echo get_the_ID(); ?>, <?php echo getChoiceIdByName('Fun'); ?>); return false;">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-fun.png">
                        </a>
                    </div>
                    <div class="col-xs-8 bar-item bar-progress">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                 aria-valuenow="<?php echo $votes['Fun']['percent'] ?>"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                 data-percentage="<?php echo $votes['Fun']['percent'] ?>"
                                 data-name="Fun">
                                <span class="sr-only"><?php echo $votes['Fun']['percent'] ?>% Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 bar-item bar-percent">
                        <span><?php echo $votes['Fun']['percent'] ?>%</span>
                    </div>
                </div>

                <div class="row bar">
                    <div class="col-xs-2 bar-item bar-img">
                        <a href="#"
                           onclick="PiweeVote(<?php echo get_the_ID(); ?>, <?php echo getChoiceIdByName('Créatif'); ?>); return false;">
                            <img
                                src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-creatif.png">
                        </a>
                    </div>
                    <div class="col-xs-8 bar-item bar-progress">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                 aria-valuenow="<?php echo $votes['Créatif']['percent'] ?>"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                 data-percentage="<?php echo $votes['Créatif']['percent'] ?>"
                                 data-name="Créatif">
                                <span class="sr-only"><?php echo $votes['Créatif']['percent'] ?>
                                    % Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 bar-item bar-percent">
                        <span><?php echo $votes['Créatif']['percent'] ?>%</span>
                    </div>
                </div>

                <div class="row bar">
                    <div class="col-xs-2 bar-item bar-img">
                        <a href="#"
                           onclick="PiweeVote(<?php echo get_the_ID(); ?>, <?php echo getChoiceIdByName('déjà vu'); ?>); return false;">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icon-dejavu.png">
                        </a>
                    </div>
                    <div class="col-xs-8 bar-item bar-progress">
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                 aria-valuenow="<?php echo $votes['déjà vu']['percent'] ?>"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                 data-percentage="<?php echo $votes['déjà vu']['percent'] ?>"
                                 data-name="déjà vu">
                                <span class="sr-only"><?php echo $votes['déjà vu']['percent'] ?>
                                    % Complete (success)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-2 bar-item bar-percent">
                        <span><?php echo $votes['déjà vu']['percent'] ?>%</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <?php if ($isCampain): ?>
    <div id="site-body-parent"
         style="background-image:url('<?php echo $campain_bg_image ?>'); background-repeat: no-repeat; background-position: 50% 0;background-color: <?php echo $campain_background_color ?>">
        <?php else: ?>
        <div id="site-body-parent">
            <?php endif ?>

            <div id="campain_bg" class="campain_bg"></div>

            <?php echo stripslashes($campain_injected_code); ?>

            <?php if ($display_video): ?>

                <?php //HELPER TO DISPLAY VIDEO ! ?>

            <?php endif; ?>

            <?php if ($isCampain): ?>

                <a href="<?php echo $campain_url ?>" target="_blank">
                    <img src="<?php echo $campain_mobile_header ?>" id="campain_mobile_header">
                </a>

            <?php endif; ?>


            <div id="site-body">