<article <?php post_class(); ?>>

    <h1 class="single-title"><?php the_title(); ?></h1>

    <div class="header-article">

        <div class="row">
            <div class="col-md-4 col-sm-8 col-xs-8">
                <div class="author-container">

                    <?php
                    echo get_avatar(get_the_author_meta('ID'));
                    the_author_posts_link();
                    echo '<br>';
                    the_date();
                    ?>

                </div>
            </div>
            <div class="col-md-8 col-sm-4 col-xs-4">
                <div class="share-container">
                    <div class="share-count">
                        <span
                            class="share-count-views"><?php echo shorten_number_k(get_total_share_count(get_the_ID())['total_share_count']) ?></span>
                        <br>
                        Partages
                    </div>
                    <div class="share-buttons">
                        <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>"
                           target="_blank">
                            <img class="hidden-xs hidden-sm"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-fb-btn.png">
                        </a>
                        <a href="https://twitter.com/home?status=<?php echo get_the_title() . ' ' . get_permalink() ?>"
                           target="_blank">
                            <img class="hidden-xs hidden-sm"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-twitter-btn.png">
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink() ?>&title=<?php echo get_the_title() . ' ' . get_permalink() ?>&summary=&source=Piwee.net"
                           target="_blank">
                            <img class="hidden-xs hidden-sm"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-linkedin.png">
                        </a>
                        <a href="https://pinterest.com/pin/create/button/?url=<?php echo get_permalink() ?>&description=<?php echo get_the_title() . ' ' . get_permalink() ?>"
                           target="_blank">
                            <img class="hidden-xs hidden-sm"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-pinterest.png">
                        </a>
                        <a href="mailto:?subject=<?php echo rawurlencode(get_the_title() . ' | Piwee.net') ?>&body=<?php echo rawurlencode(get_the_title() . ' ' . get_permalink()) ?>">
                            <img class="hidden-xs hidden-sm"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-mail.png">
                        </a>
                        <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink() ?>"
                           target="_blank">
                            <img class="hidden-md hidden-lg"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-fb.png">
                        </a>
                        <a href="https://twitter.com/home?status=<?php echo get_the_title() . ' ' . get_permalink() ?>"
                           target="_blank">
                            <img class="hidden-md hidden-lg"
                                 src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/flat-icon-piwee-twitter.png">
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php $brand = get_brand_for_post_or_category(get_the_ID()); ?>

    <?php if ($brand): ?>

        <div class="brand-header-container">

            <div class="row">

                <div class="col-md-1 col-xs-2 col-sm-2 logo">
                    <img src="<?php echo $brand['brandLogo'] ?>" class="brand-logo">
                </div>

                <div class="col-md-11 col-xs-10 col-sm-10 text">
                    <p class="brandName">Présenté par : <a href="<?php echo $brand['brandUrl'] ?>"><?php echo $brand['brandName'] ?></a></p>
                    <p class="brandDescription"><?php echo stripslashes($brand['brandDescription']); ?></p>
                </div>

            </div>

        </div>

    <?php endif; ?>

    <div class="post">
        <?php the_content(); ?>

        <hr>

        <div class="content-category-footer">

            <?php
            $post_category = get_the_category();

            $parent_categories = get_ancestors($post_category[0]->term_id, 'category');

            $all_categories = array();

            foreach ($parent_categories as $categoryID) {
                $all_categories[] = get_category($categoryID);
            }

            $all_categories[] = $post_category[0];

            ?>

            <p><span class="title">Plus d'articles sur la catégorie :</span> <span
                    class="categories"><?php foreach ($all_categories as $key => $category) {

                        if (function_exists('z_taxonomy_image_url')) $icon = z_taxonomy_image_url($category->term_id);

                        echo '<a href="/category/' . $category->slug . '">';
                        if ($icon) {
                            echo '<img src="' . $icon . '">';
                        }
                        echo $category->name . '</a>';

                        if ($key != count($all_categories) - 1) {
                            echo ', ';
                        }
                    } ?></span>
            </p>

        </div>

    </div>

</article>