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

<script id='aksdk' type='text/javascript' data-cfasync='true'>
    function adikteev_no_ad(formats) {
        if (formats.indexOf && (formats.indexOf("m-story-mobile") >= 0 || formats.indexOf("m-story-max-mobile") >= 0 || formats.indexOf("m-gallery-mobile") >= 0)) {
            window.MzPub = window.MzPub|| {};
            MzPub.pub = MzPub.pub || {};
            MzPub.pub.id = '4558421';
            MzPub.pub.size = '320x50';
            MzPub.pub.pub_size = ['320x480','300x250','100x320','320x100'];
            MzPub.pub.ref = 'piwee.net';
            MzPub.pub.tab_size = ['728x90','1024x150','150x500','1024x768','768x1024'];
            MzPub.pub.mob_page = true;
            MzPub.pub.publisher_click = '';
            MzPub.pub.age = '18-64';
            MzPub.pub.gender = 'm';
            var elem = document.createElement('SCRIPT');
            elem.src = 'http://storage.mozoo.com/publisher_scripts/mz_pubscript.js';
            if(document.body) {
                document.body.appendChild(elem);
            } else {
                window.addEventListener('DOMContentLoaded', function() {
                    document.body.appendChild(elem);
                });
            }
        }
    }
    (function(e,t){
        t=t||{};var n=document.createElement('script');
        var r='https:'==window.location.protocol?'https://':'http://';
        n.src=r+'cdn.adikteev.com/lib/v3/aksdk.moment?t='+((new Date).getTime()/1e3/3600).toFixed();
        n.type='text/javascript';n.async='true';
        n.onload=n.onreadystatechange=function(){
            var n=this.readyState;if(n&&n!='complete'&&n!='loaded')return;
            try{top.AKSdk.init(e,t) }catch(r){}
        };
        try{ var i=top.document.getElementsByTagName('script')[0];i.parentNode.insertBefore(n,i); }catch(e){};
    })({desktop:'sYMu7jz1yovpvi-ONrOLKRKi-pFZOCT6n7Ium2Sby9Y=', mobile:'wI_SDAg0KmFhBMSbdRRtsxq-3P9tdVFrndF8ykXdVOE='}, {noad_callback: adikteev_no_ad});
</script>

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