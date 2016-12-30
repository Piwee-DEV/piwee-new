</div>

</div>

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


<div class="secondary-footer hidden-sm hidden-xs">

    <div class="progress">
        <div class="progress-bar progress-bar-reading" role="progressbar" aria-valuenow="0"
             aria-valuemin="0" aria-valuemax="100" style="width:0%">
        </div>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-md-2 secondary-footer-logo-container secondary-footer-col">
                <a href="<?php echo get_home_url() ?>">
                    <img
                        src="<?php echo get_template_directory_uri() ?>/assets/img/logo-piwee-white-header.png">
                </a>
            </div>

            <div class="col-md-5 estimated-reading-title-container secondary-footer-col">
                <span class="estimated-reading-time"><?php post_read_time(); ?></span>
                <span class="post-title"><?php echo the_title() ?></span>
            </div>

            <div class="col-md-2 secondary-footer-col">

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

                <div class="open-menu-post-type-popover bubble-speech">
                    N'oublie pas de voter !
                </div>

                <div class="secondary-footer-post-type-container open-menu-post-type">

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

            <div class="col-md-3 secondary-footer-share-container secondary-footer-col">

                <div class="secondary-footer-shareimg-container">
                    <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>"
                       target="_blank">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/FB_icon_piwee.png">
                    </a>
                    <a href="https://twitter.com/home?status=<?php echo get_the_title() . ' ' . get_permalink() ?>"
                       target="_blank">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/twitter_icon_piwee.png">
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink() ?>&title=<?php echo get_the_title() . ' ' . get_permalink() ?>&summary=&source=Piwee.net"
                       target="_blank">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/linkedin_icon_piwee.png">
                    </a>
                    <a href="mailto:?subject=<?php echo rawurlencode(get_the_title() . ' | Piwee.net') ?>&body=<?php echo rawurlencode(get_the_title() . ' ' . get_permalink()) ?>">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/mail_icon_piwee.png">
                    </a>
                </div>

                <span class="secondary-footer-share-text">Partagez cet article</span>

            </div>
        </div>

    </div>

</div>

<div class="container footer">

    <footer id="site-footer">

        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-item">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-logo-sans-ombres.png"
                         class="logo-footer">
                </div>
                <div class="col-md-2 footer-item">
                    <strong>EN SAVOIR PLUS</strong>
                    <ul>
                        <li><a href="/about">A propos</a></li>
                        <li><a href="/equipe">L'équipe</a></li>
                        <li><a href="/devenir-redacteur">Devenez rédacteur</a></li>
                        <li><a href="/contacts">Nous contacter</a></li>
                    </ul>
                </div>
                <div class="col-md-2 footer-item">
                    <strong>PUBLICITE</strong>
                    <ul>
                        <li><a href="/annonceurs">Annoncez chez Piwee</a></li>
                        <li><a href="/about">Les Chiffres</a></li>
                    </ul>
                </div>
                <div class="col-md-4 footer-item">
                    <strong>SUIVEZ NOUS SUR LES RESEAUX SOCIAUX</strong>
                    <div class="clear"></div>
                    <div class="social-network-headband">
                        <a href="https://www.facebook.com/piwee.net" target="_blank">
                            <img
                                src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/FB_icon_piwee.png">
                        </a>
                        <a href="https://twitter.com/piweeFR" target="_blank">
                            <img
                                src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/twitter_icon_piwee.png">
                        </a>
                        <a href="https://www.instagram.com/piweefr" target="_blank">
                            <img
                                src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/insta_icon_piwee.png">
                        </a>
                        <a href="<?php get_home_url() ?>/contact" target="_blank">
                            <img
                                src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/mail_icon_piwee.png">
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                Designé par <a href="<?php get_home_url() ?>/author/julien.fabro" target="_blank">Julien Fabro</a> - Développé par <a href="http://alexandrenguyen.fr" target="_blank">Alexandre Nguyen</a>
            </div>
        </div>

    </footer>

</div>

</main>

<?php wp_footer(); ?>

<div id="fb-root"></div>

<!-- ADVERTISING SCRIPTS -->

<script>
    var unruly = window.unruly || {};
    unruly.native = unruly.native || {};
    unruly.native.siteId = 1005784;
</script>
<script src="//video.unrulymedia.com/native/native-loader.js"></script>

<script type="text/javascript">
    window._taboola = window._taboola || [];
    _taboola.push({flush: true});
</script>

<!-- END ADVERTISING SCRIPTS -->


<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1411359452474265";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<script>!function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, 'script', 'twitter-wjs');</script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-37101533-3', 'auto');
    ga('send', 'pageview');

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js"></script>

</body>
</html>