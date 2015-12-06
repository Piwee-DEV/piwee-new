</div>

<footer id="site-footer">

    <div class="container">
        <div class="row">
            <?php dynamic_sidebar('footer-sidebar'); ?>
        </div>
    </div><?php

    $footer_text = blt_get_option('footer_text', 'Copyright &copy; {year} &middot; Theme design by Bluthemes &middot; <a href="http://www.bluthemes.com" rel="nofollow">www.bluthemes.com</a>');

    if (!empty($footer_text)) { ?>
        <div class="footer-text">
        <div class="container">
            <p><?php echo html_entity_decode(str_replace("{year}", date('Y'), $footer_text)); ?></p>
        </div>
        </div><?php
    } ?>

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