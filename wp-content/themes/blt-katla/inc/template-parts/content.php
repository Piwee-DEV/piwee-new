<?php $post_thumbnail_size = blt_has_sidebar() == 'none' ? 'hg' : 'lg'; ?>

<article <?php post_class('content-post'); ?>><?php

    #
    #  DISPLAY POST STATUS
    #  ========================================================================================
    #

    if (get_post_status() != 'publish') { ?>
        <div class="label post-status"><?php echo get_post_status(); ?></div><?php
    }

    $image_location = blt_get_option('image_location_on_blog_page', 'above');

    if ($image_location == 'above' and has_post_thumbnail()) { ?>
    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true"> <?php
        the_post_thumbnail($post_thumbnail_size, array('alt' => get_the_title())); ?>
        </a><?php
    } ?>

    <div class="content-body"><?php

        if (is_sticky()) {
            echo '<p class="label-wrap"><span class="label label-blt label-sticky"><i class="fa fa-star"></i>' . __('Featured Post', 'bluthemes') . '</span></p>';
        } ?>

        <h2 class="content-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        <div class="content-meta">
            <?php blt_get_post_meta() ?>
        </div>

        <div class="content-text"><?php

            if ($image_location == 'below' and has_post_thumbnail()) { ?>

                <p>
                <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true"> <?php
                    the_post_thumbnail($post_thumbnail_size, array('alt' => get_the_title())); ?>
                </a>
                </p><?php

            }

            switch (blt_get_option('show_content_or_excerpt', 'excerpt')) {

                case 'title':
                    // don't render anything
                    break;

                case 'content':
                    the_content(__('Continue reading...', 'bluthemes'));
                    break;

                case 'excerpt':
                default:
                    the_excerpt();
                    break;
            } ?>

        </div>

    </div>

</article>