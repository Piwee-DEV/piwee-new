var GlobalSpecific = {};

function openMobilePostType() {

    $('.menu-post-type-opened').toggle();

    setTimeout(function () {

        $('.menu-post-type-opened .progress .progress-bar').each(function () {

            var me = $(this);
            var perc = me.attr("data-percentage");

            var current_perc = 0;

            var progress = setInterval(function () {
                if (current_perc >= perc) {
                    clearInterval(progress);
                } else {
                    current_perc += 1;
                    me.css('width', (current_perc) + '%');
                }
            }, 10);

        });

    }, 100);
}

jQuery(document).ready(function () {

    /**
     * Hiding widget_text if ADBLOCK is enabled...
     */

    // Function called if AdBlock is detected
    function adBlockDetected() {
        $(document).find(".widget_text").each(function() {
            $(this).hide();
        });
    }

    // Recommended audit because AdBlock lock the file 'fuckadblock.js'
    // If the file is not called, the variable does not exist 'fuckAdBlock'
    // This means that AdBlock is present
    if(typeof fuckAdBlock === 'undefined') {
        adBlockDetected();
    } else {
        fuckAdBlock.onDetected(adBlockDetected);
        fuckAdBlock.on(true, adBlockDetected);
    }

    $('.open-menu-post-type').on('touchstart click',function (e){
        e.preventDefault();
        openMobilePostType();
    });

    responsiveControl();

    jQuery(window).resize(function () {
        responsiveControl();
    });

    if (jQuery(window).width() > 650) {

        jQuery(".header-article").scrollToFixed({
            preFixed: function () {
                jQuery(".secondary-header").animate({top: "0px"}, 200);
                jQuery(".header-article").css('visibility', 'hidden');
                jQuery("#wpadminbar").hide();
            },
            postFixed: function () {
                jQuery(".secondary-header").animate({top: "-70px"}, 200);
                jQuery(".header-article").css("visibility", 'visible');
                jQuery("#wpadminbar").show();

                $('.menu-post-type-opened').hide();
            },
            zIndex: 999999
        });

        var marginTopNewsletterWidget = 0;
        if(jQuery('.post-container') && jQuery('.post-container').length > 0) {
            marginTopNewsletterWidget = $('.header-article').height() + 20;
        }

        jQuery(".widget_newsletter_widget").scrollToFixed({
            marginTop: marginTopNewsletterWidget,
            preFixed: function () {

            },
            postFixed: function () {

            },
            zIndex: 999999
        });

    }

    jQuery(".img-pub-right").scrollToFixed({
        preFixed: function () {

        },
        postFixed: function () {

        },
        zIndex: 999999
    });

});

jQuery.sharedCount = function (url, fn) {
    url = encodeURIComponent(url || location.href);
    var domain = "//free.sharedcount.com/";
    /* SET DOMAIN */
    var apikey = "479dfb502221d2b4c4a0433c600e16ba5dc0df4e"
    /*API KEY HERE*/
    var arg = {
        data: {
            url: url,
            apikey: apikey
        },
        url: domain,
        cache: true,
        dataType: "json"
    };
    if ('withCredentials' in new XMLHttpRequest) {
        arg.success = fn;
    }
    else {
        var cb = "sc_" + url.replace(/\W/g, '');
        window[cb] = fn;
        arg.jsonpCallback = cb;
        arg.dataType += "p";
    }
    return jQuery.ajax(arg);
};

function openSharePanelForID(post_id) {
    if (jQuery(window).width() > 1280) {
        jQuery("#post-share-box-" + post_id).show();
    }
}

function hideSharePanelForID(post_id) {
    if (jQuery(window).width() > 1280) {
        jQuery("#post-share-box-" + post_id).hide();
    }
}

function updateShareCountForPost(post_id, share_count) {

    jQuery.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: 'update_share_count',
            post_id: post_id,
            share_count: share_count
        },
        success: function (result) {

        }
    });
}

function responsiveControl() {

    if (jQuery(window).width() < 650) {
        jQuery(".total-share-span-single").hide();
        jQuery(".share-single-pinterest").hide();
        jQuery(".share-single-linkedin").hide();
        jQuery(".share-single-gplus").hide();
    }
    else {
        jQuery(".total-share-span-single").show();
        jQuery(".share-single-pinterest").show();
        jQuery(".share-single-linkedin").show();
        jQuery(".share-single-gplus").show();
    }
}
