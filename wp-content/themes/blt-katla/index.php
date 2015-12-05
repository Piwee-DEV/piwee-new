<?php get_header(); ?>

<?php $recent_posts = wp_get_recent_posts(array('post_status' => 'publish')); ?>
<?php $marketing_posts = query_posts(array('category__in' => array(211), 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish')); ?>
<?php $infographie_posts = query_posts(array('category__in' => array(678), 'posts_per_page' => 4, 'orderby' => 'date', 'order' => 'DESC', 'post_status' => 'publish')); ?>

    <div id="site-content" class="clearfix">

        <div class="row">

            <div class="col-md-8">

                <div class="article-mega-featured">

                    <a href="<?php echo get_permalink($recent_posts[0]["post_id"]) ?>">

                        <div class="article-mega-featured-img-container">
                            <?php echo get_the_post_thumbnail($recent_posts[0]["post_id"], "attachment-large") ?>
                            <div class="article-mega-featured-img">
                                <h2><?php echo $recent_posts[0]["post_title"]; ?></h2>
                            </div>
                        </div>
                    </a>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-12 title-section">
                        <h3>DERNIERS ARTICLES</h3>

                        <p>Marketing, art, innovation, CM...<br>Toutes les idées & concepts créatifs, amusants &
                            inspirants du moment</p>
                    </div>

                </div>

                <div class="row">

                    <?php foreach ($recent_posts as $post): ?>

                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), 'single-post-thumbnail'); ?>

                        <a href="<?php echo get_permalink($post['ID']); ?>">
                            <div class="col-md-6 article-vignette">
                                <div class="article-vignette-inside-image"
                                     style="background-image: url('<?php echo $image[0]; ?>')">

                                </div>
                                <div class="article-vignette-inside-text">
                                    <h4><?php echo $post["post_title"]; ?></h4>
                                </div>
                            </div>
                        </a>

                    <?php endforeach ?>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-12 title-section more-margin">
                        <h3>MARKETING & COM</h3>

                        <p>Un street marketing créatif, un spot viral, une opération digitale amusante...<br>ça se passe
                            ici (et on adore ça !)</p>
                    </div>

                </div>

                <div class="row">

                    <?php foreach ($marketing_posts as $post): ?>

                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>

                        <a href="<?php echo get_permalink($post->ID); ?>">
                            <div class="col-md-6 article-vignette">
                                <div class="article-vignette-inside-image"
                                     style="background-image: url('<?php echo $image[0]; ?>')">

                                </div>
                                <div class="article-vignette-inside-text">
                                    <h4><?php echo $post->post_title; ?></h4>
                                </div>
                            </div>
                        </a>

                    <?php endforeach ?>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-12 title-section more-margin">
                        <h3>INFOGRAPHIES</h3>

                        <p>Plein de petites choses du quotidien expliquées avec des picto</p>
                    </div>

                </div>

                <div class="row">

                    <?php foreach ($infographie_posts as $post): ?>

                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>

                        <a href="<?php echo get_permalink($post->ID); ?>">
                            <div class="col-md-6 article-vignette">
                                <div class="article-vignette-inside-image"
                                     style="background-image: url('<?php echo $image[0]; ?>')">

                                </div>
                                <div class="article-vignette-inside-text">
                                    <h4><?php echo $post->post_title; ?></h4>
                                </div>
                            </div>
                        </a>

                    <?php endforeach ?>

                </div>

            </div>

            <div class="col-md-4">

            </div>

        </div>

    </div>

<?php get_footer(); ?>