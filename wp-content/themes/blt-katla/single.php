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

?>

<?php get_header(); ?>

    <div class="container post" <?php if($isCampain) {echo ' style="background-color: #ebecec;"';} ?>>

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                <div class="post-container">

                    <?php

                    if (have_posts()) {

                        while (have_posts()) {
                            the_post();

                            get_template_part('inc/template-parts/single', get_post_format());

                        }

                    } ?>

                </div>

                <div class="row">

                    <div class="post-below-widget-container col-md-12">
                        <?php
                        dynamic_sidebar('katla-below-post')
                        ?>
                    </div>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">
                <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                    <aside id="site-content-sidebar">
                        <div class="content-sidebar-wrap">
                            <?php dynamic_sidebar('katla-right-post'); ?>
                        </div>
                    </aside>
                </div>
            </div>

        </div>

    </div>

<?php

get_footer();

?>