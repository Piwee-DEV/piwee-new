<?php

    $share_url = rawurlencode(esc_url(get_permalink()));
    $share_title = rawurlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));

?>
<div class="post-share-wrapper">


    <div class="row">
        
        <div class="col-md-6">
            <a class="btn btn-block btn-lg social-sharing share-facebook" onclick="blt_social_share(event, 'http://www.facebook.com/sharer.php?u=<?php echo $share_url; ?>&amp;t=<?php echo esc_attr($share_title); ?>')">
                <i class="fa fa-facebook"></i> Partager sur Facebook
            </a>
        </div>    
        <div class="col-md-6">
            <a class="btn btn-block btn-lg social-sharing share-twitter" onclick="blt_social_share(event, 'http://twitter.com/intent/tweet?url=<?php echo $share_url; ?>&amp;text=<?php echo esc_attr($share_title); ?>')">
                <i class="fa fa-twitter"></i> Partager sur Twitter
            </a>
        </div>
    </div>

</div>