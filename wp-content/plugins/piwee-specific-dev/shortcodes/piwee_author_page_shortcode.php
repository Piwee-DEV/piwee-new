<?php

function piwee_author_list_handler($atts, $content = null)
{

    ?>

    <?php $user = get_user_by('login', 'julien.fabro') ?>

    <div class="author-shortcode-container">

    <h1 class="section-title">Le fondateur <span>Cet homme est le papa de Piwee</span></h1>

    <div class="row author-shortcode-row">
        <div class="col-md-2">
            <div class="author-avatar">
                <a href="<?php echo get_home_url() . '/author/' . get_the_author_meta('user_nicename', $user->ID) ?>">
                    <?php echo get_avatar($user->ID) ?>
                </a>
            </div>
        </div>
        <div class="col-md-10">
            <a href="<?php echo get_home_url() . '/author/' . get_the_author_meta('user_nicename', $user->ID) ?>">
                <h1 class="author-name"><?php echo $user->display_name ?></h1>
            </a>
            <p class="author-description"><?php echo $user->description ?></p>
            <div class="author-section-footer">
                <div class="social-links">
                    <a href="https://twitter.com/<?php echo get_the_author_meta('twitter', $user->ID) ?>"
                       target="_blank">
                        <img
                            src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/twitter.png">
                    </a>
                </div>
                <div class="articles-count">
                    <a href="<?php echo get_home_url() . '/author/' . get_the_author_meta('user_nicename', $user->ID) ?>">
                        <?php echo count_user_posts($user->ID); ?> articles
                    </a>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <h1 class="section-title">Nos rédacteurs <span>Ceux qui racontent tout plein d'histoires créatives</span></h1>

    <?php

    $users = get_users();

    foreach ($users as $user):

        if (get_the_author_meta('nicename', $user->ID) != 'test-test'
            && get_the_author_meta('nicename', $user->ID) != 'julien-fabro'
            && get_the_author_meta('nicename', $user->ID) != 'alexandre-nguyen'
        ):

            ?>

            <div class="row author-shortcode-row">
                <div class="col-md-2">
                    <div class="author-avatar">
                        <a href="<?php echo get_home_url() . '/author/' . get_the_author_meta('user_nicename', $user->ID) ?>">
                            <?php echo get_avatar($user->ID) ?>
                        </a>
                    </div>
                </div>
                <div class="col-md-10">
                    <a href="<?php echo get_home_url() . '/author/' . get_the_author_meta('user_nicename', $user->ID) ?>">
                        <h1 class="author-name"><?php echo $user->display_name ?></h1>
                    </a>
                    <p class="author-description"><?php echo $user->description ?></p>
                    <div class="author-section-footer">
                        <div class="social-links">
                            <a href="https://twitter.com/<?php echo get_the_author_meta('twitter', $user->ID) ?>"
                               target="_blank">
                                <img
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/twitter.png">
                            </a>
                        </div>
                        <div class="articles-count">
                            <a href="<?php echo get_home_url() . '/author/' . get_the_author_meta('user_nicename', $user->ID) ?>">
                                <?php echo count_user_posts($user->ID); ?> articles
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <?php

        endif;

    endforeach;

    ?>

    <?php $user = get_user_by('login', 'alexandre.nguyen') ?>

    <div class="author-shortcode-container">

        <h1 class="section-title">Notre développeur <span>Du code, du système, de l'infra...</span></h1>

        <div class="row author-shortcode-row">
            <div class="col-md-2">
                <div class="author-avatar">
                    <a href="<?php echo get_home_url() . '/author/' . get_the_author_meta('user_nicename', $user->ID) ?>">
                        <?php echo get_avatar($user->ID) ?>
                    </a>
                </div>
            </div>
            <div class="col-md-10">
                <a href="<?php echo get_home_url() . '/author/' . get_the_author_meta('user_nicename', $user->ID) ?>">
                    <h1 class="author-name"><?php echo $user->display_name ?></h1>
                </a>
                <p class="author-description"><?php echo $user->description ?></p>
                <div class="author-section-footer">
                    <div class="social-links">
                        <a href="https://twitter.com/<?php echo get_the_author_meta('twitter', $user->ID) ?>"
                           target="_blank">
                            <img
                                src="<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/twitter.png">
                        </a>
                    </div>
                    <div class="articles-count">
                        <a href="<?php echo get_home_url() . '/author/' . get_the_author_meta('user_nicename', $user->ID) ?>">
                            <?php echo count_user_posts($user->ID); ?> articles
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php

}

add_shortcode('piwee_author_list', 'piwee_author_list_handler');