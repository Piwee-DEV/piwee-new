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

                <?php

                $attachments = array_values(get_children(array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID')));

                ob_start();
                previous_image_link(null, '<img src="' . get_template_directory_uri() . '/assets/img/piwee-icon/precedent-button.png' . '">');
                $prevLnk = ob_get_contents();
                ob_end_clean();

                if (!$prevLnk) {

                    $attachment_id = $attachments[count($attachments) - 1]->ID;
                    $output = wp_get_attachment_link($attachment_id, null, true, false, '<img src="' . get_template_directory_uri() . '/assets/img/piwee-icon/precedent-button.png' . '">');

                    echo $output;

                } else {
                    echo $prevLnk;
                }

                ob_start();
                next_image_link(null, '<img src="' . get_template_directory_uri() . '/assets/img/piwee-icon/suivant-button.png' . '">');
                $nextLnk = ob_get_contents();
                ob_end_clean();

                if (!$nextLnk) {

                    $attachment_id = $attachments[0]->ID;
                    $output = wp_get_attachment_link($attachment_id, null, true, false, '<img src="' . get_template_directory_uri() . '/assets/img/piwee-icon/suivant-button.png' . '">');

                    echo $output;

                } else {
                    echo $nextLnk;
                }

                ?>
            </div>
            <div class="col-md-2 the-article">
                <a href="<?php echo $link ?>">
                    <img
                        src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/options-icon-gold.png"
                        class="piwee-burger-icon">(Retour l'article)</a>
            </div>
        </div>

        <div class="katla-below-attachment-widget-wrapper">
            <?php dynamic_sidebar('katla-below-attachment') ?>
        </div>

    </div>

</article>