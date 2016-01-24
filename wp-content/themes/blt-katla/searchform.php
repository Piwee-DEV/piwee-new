<form action="<?php echo home_url('/'); ?>" role="search">
    <div class="input-group">
        <input type="text" class="form-control custom-search-headband" name="s"
               placeholder="" value="<?php the_search_query(); ?>" style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/piwee-icon/loupe-barre-de-recherche.png'); background-repeat: no-repeat; background-position: 96% 0;">
    </div>
</form>
