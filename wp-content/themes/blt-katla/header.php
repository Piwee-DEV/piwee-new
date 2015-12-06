<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/piwee-override.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="what-size"></div>
<main id="site"><?php

    // AD SPOT #1
    blt_get_ad_spot('spot_above_menu'); ?>

    <header id="site-header" class="navbar">
        <div class="primary-menu">
            <div class="container">
                <div class="navbar-inner row">
                    <div class="col-md-12">

                        <div class="piwee-logo">
                            <a href="<?php echo get_home_url() ?>">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-piwee.png">
                            </a>
                        </div>


                        <div class="collapse navbar-collapse" id="katla-pri-navbar">

                            <div class="navbar-right hidden-xs"><?php

                                if (is_single()) {

                                    $post_voting = blt_get_option('post_voting', true);

                                    echo '<div class="header-share hidden-xs' . ($post_voting ? ' voting-enabled' : ' voting-disabled') . '">';

                                    // If post voting is enabled in the theme options
                                    if ($post_voting) {

                                        $score = get_post_meta(get_the_ID(), 'blt_score', true);

                                        if (empty($score)) {
                                            $score = 0;
                                        } ?>
                                        <div class="post-vote-header">
                                        <a class="btn btn-default post-vote post-vote-up"
                                           data-post-id="<?php echo get_the_ID() ?>" href="#vote-up"
                                           title="<?php echo esc_attr(__('Like', 'bluthemes')) ?>"><i
                                                class="fa fa-chevron-up"></i></a>
                                        <span class="vote-count"><?php echo esc_attr($score); ?></span>
                                        <a class="btn btn-default post-vote post-vote-down"
                                           data-post-id="<?php echo get_the_ID() ?>" href="#vote-down"
                                           title="<?php echo esc_attr(__('Dislike', 'bluthemes')) ?>"><i
                                                class="fa fa-chevron-down"></i></a>
                                        </div><?php
                                    }

                                    get_share_buttons();
                                    echo '</div>';
                                }

                                ?>

                            </div>

                            <!-- 			 	  -->
                            <!-- RESPONSIVE MENUS -->
                            <!-- 				  -->

                            <ul class="user-nav nav navbar-nav visible-xs-block">

                                <?php if (is_user_logged_in()) {

                                    global $current_user;
                                    ?>
                                    <li class="user-nav-info">
                                    <?php echo get_avatar(get_current_user_id(), '50'); ?>
                                    <h4><?php echo $current_user->display_name; ?></h4>
                                    </li><?php

                                    if (blt_get_option('show_search_in_header', true)) { ?>
                                        <li>
                                            <form action="<?php echo home_url('/'); ?>" class="navbar-form navbar-left"
                                                  role="search">
                                                <input type="text" class="form-control" name="s"
                                                       placeholder="<?php _e('Search...', 'bluthemes') ?>"
                                                       value="<?php the_search_query(); ?>">
                                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                            </form>
                                        </li>
                                    <?php
                                    }

                                    if (has_nav_menu('user_logged_in_menu')) {

                                        wp_nav_menu(array(
                                            'theme_location' => 'user_logged_in_menu',
                                            'menu_class' => '',
                                            'container' => false,
                                            'depth' => 1,
                                            'items_wrap' => '%3$s',
                                            'walker' => new wp_bootstrap_navwalker(),
                                        ));

                                    } else { ?>
                                        <li><a href="<?php echo esc_url($user_posts_page_url) ?>"><i
                                                class="fa fa-cloud-upload"></i> <?php _e('Add post', 'bluthemes') ?></a>
                                        </li><?php
                                    } ?>


                                    <li class="divider"></li>
                                    <li><a role="menuitem" tabindex="-1"
                                           href="<?php echo wp_logout_url(home_url()); ?>"><i
                                            class="fa fa-sign-out"></i> <?php _e('Logout', 'bluthemes') ?></a></li><?php


                                } else {

                                    if (blt_get_option('show_search_in_header', true)) { ?>
                                        <li>
                                            <form action="<?php echo home_url('/'); ?>" class="navbar-form navbar-left"
                                                  role="search">
                                                <input type="text" class="form-control" name="s"
                                                       placeholder="<?php _e('Search...', 'bluthemes') ?>"
                                                       value="<?php the_search_query(); ?>">
                                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                            </form>
                                        </li>
                                    <?php
                                    }

                                    if ($show_header_buttons) { ?>
                                        <li><a href="#blt-login"><i
                                                    class="fa fa-cloud-upload"></i> <?php _e('Add post', 'bluthemes') ?>
                                            </a></li>
                                        <li><a href="#blt-login"><?php _e('Login / Register', 'bluthemes') ?></a>
                                        </li><?php
                                    }
                                } ?>
                            </ul><?php

                            if (has_nav_menu('primary')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class' => 'nav navbar-nav',
                                    'container' => false,
                                    'depth' => 1,
                                    'walker' => new wp_bootstrap_navwalker(),
                                ));
                            }

                            if (has_nav_menu('secondary')) {
                                wp_nav_menu(array(
                                    'theme_location' => 'secondary',
                                    'menu_class' => 'nav navbar-nav visible-xs-block',
                                    'container' => false,
                                    'depth' => 2,
                                    'walker' => new wp_bootstrap_navwalker(),
                                ));
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div><?php

        if (has_nav_menu('secondary')) { ?>
            <div class="secondary-menu hidden-xs">
            <div class="container">
                <div class="row">

                    <div class="collapse navbar-collapse" id="katla-sec-navbar"><?php
                        wp_nav_menu(array(
                            'theme_location' => 'secondary',
                            'menu_class' => 'nav navbar-nav',
                            'container' => false,
                            'depth' => 2,
                            'walker' => new wp_bootstrap_navwalker(),
                        )); ?>
                    </div>

                </div>
            </div>
            </div><?php
        } ?>
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

                                                    <h4><a href="/category/inspiration"><i class="fa fa-paint-brush"></i> ART</a></h4>

                                                    <p><a href="/category/inspiration/photographie">Photographie</a></a></p>
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

                                                    <h4><a href="/category/marketing-2"><i class="fa fa-bullhorn"></i> MARKETING</a></h4>
                                                    <p><a href="/category/marketing-2/operation-marketing">Opération Marketing</a></p>
                                                    <p><a href="/category/marketing-2/street-marketing-2">Street Marketing</a></p>
                                                    <p><a href="/category/marketing-2/sensibilisation">Sensibilisation</a></p>
                                                    <p><a href="/category/marketing-2/pop-up-store">Pop-up Store</a></p>

                                                    <h4><a href="/category/digital-2"><i class="fa fa-mouse-pointer"></i> DIGITAL</a></h4>

                                                    <p><a href="/category/digital-2/operation-socialmedia">Opération Social Media</a></p>
                                                    <p><a href="/category/digital-2/twitter">Twitter</a></p>
                                                    <p><a href="/category/digital-2/facebook">Facebook</a></p>
                                                    <p><a href="/category/digital-2/instagram">Instagram</a></p>
                                                    <p><a href="/category/digital-2/web-digital-2">Web</a></p>

                                                </div>

                                                <div class="col-md-4">

                                                    <h4><a href="/category/digital-2/twitter"><i class="fa fa-twitter"></i> WE <3 TWITTER</a></h4>
                                                    <p><a href="/category/digital-2/twitter/cm">Community managers</a></p>
                                                    <p><a href="/category/digital-2/twitter/tweets-amusants">Tweets marrants</a></p>
                                                    <p><a href="/category/digital-2/twitter/comptes-a-suivre">Les comptes à suivre</a></p>

                                                    <h4><a href="/category/innovation"><i class="fa fa-cogs"></i> INNOVATION</a></h4>

                                                    <h4><a href="/category/auto"><i class="fa fa-automobile"></i> AUTO</a></h4>
                                                    <p><a href="/category/auto/pub-marketing">Pub/marketing</a></p>
                                                    <p><a href="/category/auto/essais">Essais</a></p>

                                                    <h4><a href="/category/gadget"><i class="fa fa-mobile"></i> GADGET</a></h4>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="row">

                                                <h3 class="title-menu-section">ARTICLES</h3>
                                                <hr>

                                                <a class="btn-piwee" href="/genie">
                                                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-genie.png">
                                                </a>
                                                <a class="btn-piwee"href="/creatif">
                                                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-creatif.png">
                                                </a>
                                                <a class="btn-piwee" href="/deja-vu">
                                                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/icone-piwee-vote-deja-vu.png">
                                                </a>
                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="row">

                                                <h3 class="title-menu-section">PIWEE</h3>
                                                <hr>

                                                <p class="piwee-title-menu-col3"><a href="/la-vie-du-blog">LA VIE DU BLOG</a></p>
                                                <p class="piwee-title-menu-col3"><a href="/julienfabro">ABOUT</a></p>
                                                <p class="piwee-title-menu-col3"><a href="/partenaires">PARTENAIRES</a></p>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </li>
                            <li class="item-menu-header"><a href="/category/fait-maison">NOS CREA</a></li>
                            <li class="item-menu-header"><a href="/category/petites-pensees"><i class="fa fa-pencil"></i> PETITES PENSEES</a></li>
                            <li class="item-menu-header"><a href="/top10"><i class="fa fa-trophy"></i> TOP 10</a></li>
                            <li class="item-menu-header"><a href="/random"><i class="fa fa-random"></i> RANDOM</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="site-body"><?php

// AD SPOT #3
blt_get_ad_spot('spot_below_menu');