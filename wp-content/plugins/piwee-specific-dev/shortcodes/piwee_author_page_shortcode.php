<?php

function piwee_author_list_handler($atts, $content = null)
{


    $users = get_users();

    ?>

    <div class="">

        <?php

        foreach ($users as $user):

            if (get_the_author_meta('nicename', $user->ID) != 'test-test'
                && get_the_author_meta('nicename', $user->ID) != 'julien-fabro'
                && get_the_author_meta('nicename', $user->ID) != 'alexandre-nguyen'
            ):

                ?>

                <div class="row">
                    <div class="col-md-2">
                        <?php echo get_avatar($user->ID) ?>
                    </div>
                    <div class="col-md-10">
                        <h1 class="author-name"><?php echo $user->display_name ?></h1>
                        <p class="author-description"><?php echo $user->description ?></p>
                        <div class="author-section-footer">
                            <div class="social-links">
                                
                            </div>
                            <div class="articles-count"><?php echo count_user_posts($user->ID); ?> articles</div>
                        </div>
                    </div>
                </div>

                <?php

            endif;

        endforeach;

        ?>

    </div>

    <?php

}

add_shortcode('piwee_author_list', 'piwee_author_list_handler');