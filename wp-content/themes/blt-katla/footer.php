</div>

<footer id="site-footer">

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-piwee-white-header.png" class="logo-footer">
            </div>
            <div class="col-md-2">
                <strong>EN SAVOIR PLUS</strong>
                <ul>
                    <li>A propos</li>
                    <li>L'équipe</li>
                    <li>Devenez rédacteur</li>
                    <li>Nous contacter</li>
                </ul>
            </div>
            <div class="col-md-2">
                <strong>PUBLICITE</strong>
                <ul>
                    <li>Annoncez chez Piwee</li>
                    <li>Les Chiffres</li>
                </ul>
            </div>
            <div class="col-md-4">
                <strong>SUIVEZ NOUS SUR LES RESEAUX SOCIAUX</strong>
                <div class="clear"></div>
                <div class="social-network-headband">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/FB_icon_piwee.png">
                    <img
                        src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/twitter_icon_piwee.png">
                    <img
                        src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/inta_icon_piwee.png">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/mail_icon_piwee.png">
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            Designé par Julien Fabro - Codé par Alexandre Nguyen
        </div>
    </div>

</footer>

</main>

<?php wp_footer(); ?>

<div id="fb-root"></div>
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

</body>
</html>