<?php
$parent = get_post_field('post_parent', get_the_ID());
$link = get_permalink($parent);
$title = get_the_title($parent);
?>


<article <?php post_class(); ?>>

    <h1 class="single-title">
        <a href="<?php echo $link ?>">
            <?php echo $title; ?>
        </a>
    </h1>

    <div class="post attachment">
        <?php $image = wp_get_attachment_image_src(get_the_ID(), 'full') ?>
        <img src="<?php echo $image[0] ?>">

        <div class="row nextprev">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <?php previous_image_link(null, '<img src="' . get_template_directory_uri() . '/assets/img/piwee-icon/precedent-button.png' . '">'); ?>
                <?php next_image_link(null, '<img src="' . get_template_directory_uri() . '/assets/img/piwee-icon/suivant-button.png' . '">'); ?>
            </div>
            <div class="col-md-2 the-article">
                <a href="<?php echo $link ?>">
                    <img
                        src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/options-icon-gold.png"
                        class="piwee-burger-icon">(Retour l'article)</a>
            </div>
        </div>
    </div>

</article>