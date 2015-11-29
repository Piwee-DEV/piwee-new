<?php get_header(); ?>

<?php $recent_posts = wp_get_recent_posts(array('post_status' => 'publish')); ?>

    <div id="site-content" class="clearfix">

        <div class="row">

            <div class="col-md-8">

                <div class="article-mega-featured">

                    <a href="<?php echo get_permalink($recent_posts[0]["post_id"]) ?>">
                        <div class="article-mega-featured-img-container">
                            <?php echo get_the_post_thumbnail($recent_posts[0]["post_id"], "attachment-large") ?>
                            <h2><?php echo $recent_posts[0]["post_title"]; ?></h2>
                        </div>
                    </a>

                </div>

                <hr>

                <h2>DERNIERS ARTICLES</h2>

                <p>Marketing, art, innovation, CM...</p>

                <p>Toutes les idées & concepts créatifs, amusants & inspirants du moment</p>

                <div class="row">

                    <?php foreach ($recent_posts as $post): ?>

                        <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), 'single-post-thumbnail'); ?>

                        <div class="col-md-6 article-vignette">
                            <div class="article-vignette-inside-image"
                                 style="background-image: url('<?php echo $image[0]; ?>')">

                            </div>
                            <div class="article-vignette-inside-text">
                                <h4><?php echo $post["post_title"]; ?></h4>
                            </div>
                        </div>

                    <?php endforeach ?>

                </div>

            </div>

            <div class="col-md-4">

            </div>

        </div>

    </div>

<?php get_footer(); ?>