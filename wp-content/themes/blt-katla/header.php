<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head();  ?>
</head>
<body <?php body_class(); ?>>
<div class="what-size"></div>
<main id="site"><?php

// AD SPOT #1
blt_get_ad_spot('spot_above_menu'); ?> 

<header id="site-header" class="navbar">
	<div class="primary-menu">
		<div class="container">
			<div class="navbar-inner row">
				<div class="col-md-12">

					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#katla-pri-navbar"><i class="fa fa-bars"></i></button><?php 

						$logo = blt_get_option('logo');

						if(!empty($logo)){ ?>
							<a class="brand brand-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img class="img-responsive" src="<?php echo esc_attr($logo); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
							</a><?php 
						}else{ 
							if(blt_get_option('show_tagline')){ ?>
								<a class="brand brand-text brand-tagline" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
									<span><?php bloginfo( 'name' ); ?></span>
									<p><?php bloginfo( 'description' ); ?></p>
								</a><?php
							}else{ ?>
								<a class="brand brand-text" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
									<span><?php bloginfo( 'name' ); ?></span>
								</a><?php 
							} 
						} ?>
					</div>


					<div class="collapse navbar-collapse" id="katla-pri-navbar">							

						<div class="navbar-right hidden-xs"><?php

							if(is_single()){ 

								$post_voting = blt_get_option('post_voting', true);

								echo '<div class="header-share hidden-xs'.($post_voting ? ' voting-enabled' : ' voting-disabled').'">';

									// If post voting is enabled in the theme options
									if($post_voting){

										$score 	= get_post_meta( get_the_ID(), 'blt_score', true );

										if(empty($score)){
											$score = 0;
										} ?>
										<div class="post-vote-header">
											<a class="btn btn-default post-vote post-vote-up" data-post-id="<?php echo get_the_ID() ?>" href="#vote-up" title="<?php echo esc_attr(__('Like', 'bluthemes')) ?>"><i class="fa fa-chevron-up"></i></a>
											<span class="vote-count"><?php echo esc_attr($score); ?></span>
											<a class="btn btn-default post-vote post-vote-down" data-post-id="<?php echo get_the_ID() ?>" href="#vote-down" title="<?php echo esc_attr(__('Dislike', 'bluthemes')) ?>"><i class="fa fa-chevron-down"></i></a>
										</div><?php
									}

									get_share_buttons();
								echo '</div>';
							}

							?>
						
						</div>

						<!-- 			 	  -->
						<!-- RESPONSIVE MENUS -->
						<!-- 				  -->
									
								<ul class="user-nav nav navbar-nav visible-xs-block">

								<?php if(is_user_logged_in()){ 

							  		global $current_user;
									?>	
							  		<li class="user-nav-info">
							  			<?php echo get_avatar( get_current_user_id(), '50' ); ?>
							  			<h4><?php echo $current_user->display_name; ?></h4>
							  		</li><?php

									if(blt_get_option('show_search_in_header', true)){ ?>
										<li>
										<form action="<?php echo home_url( '/' ); ?>" class="navbar-form navbar-left" role="search">
											<input type="text" class="form-control" name="s" placeholder="<?php _e('Search...', 'bluthemes') ?>" value="<?php the_search_query(); ?>">
											<button type="submit" class="btn"><i class="fa fa-search"></i></button>
										</form>
										</li>
										<?php
									}							  		

							  		if(has_nav_menu('user_logged_in_menu')){
										
										wp_nav_menu(array( 
											'theme_location' => 'user_logged_in_menu',
											'menu_class' => '',
											'container' => false,
											'depth' => 1,
											'items_wrap'      => '%3$s',
											'walker' => new wp_bootstrap_navwalker(),
										));

									}else{ ?>
						    			<li><a href="<?php echo esc_url($user_posts_page_url) ?>"><i class="fa fa-cloud-upload"></i> <?php _e('Add post', 'bluthemes') ?></a></li><?php
						    		} ?>


							  		<li class="divider"></li>
							    	<li><a role="menuitem" tabindex="-1" href="<?php echo wp_logout_url(home_url()); ?>"><i class="fa fa-sign-out"></i> <?php _e('Logout', 'bluthemes') ?></a></li><?php
							  	
									
								}else{ 

									if(blt_get_option('show_search_in_header', true)){ ?>
										<li>
										<form action="<?php echo home_url( '/' ); ?>" class="navbar-form navbar-left" role="search">
											<input type="text" class="form-control" name="s" placeholder="<?php _e('Search...', 'bluthemes') ?>" value="<?php the_search_query(); ?>">
											<button type="submit" class="btn"><i class="fa fa-search"></i></button>
										</form>
										</li>
										<?php
									} 

									if($show_header_buttons){ ?>
										<li><a href="#blt-login"><i class="fa fa-cloud-upload"></i> <?php _e('Add post', 'bluthemes') ?></a></li>
										<li><a href="#blt-login"><?php _e('Login / Register', 'bluthemes') ?></a></li><?php
									}
								} ?>
							  	</ul><?php

							if(has_nav_menu('primary')){
								wp_nav_menu(array( 
									'theme_location' => 'primary',
									'menu_class' => 'nav navbar-nav',
									'container' => false,
									'depth' => 1,
									'walker' => new wp_bootstrap_navwalker(),
								));
							}

							if(has_nav_menu('secondary')){
								wp_nav_menu(array( 
									'theme_location' => 'secondary',
									'menu_class' => 'nav navbar-nav visible-xs-block',
									'container' => false,
									'depth' => 2,
									'walker' => new wp_bootstrap_navwalker(),
								));
							} ?>

					</div>
				</div>
			</div>				
		</div>
	</div><?php

	if(has_nav_menu('secondary')){ ?>
		<div class="secondary-menu hidden-xs">
			<div class="container">
				<div class="row">

					<div class="collapse navbar-collapse" id="katla-sec-navbar"><?php
						wp_nav_menu(array( 
							'theme_location' => 'secondary',
							'menu_class' => 'nav navbar-nav',
							'container' => false,
							'depth' => 2,
							'walker' => new wp_bootstrap_navwalker(),
						)); ?>
					</div>
				</div>					
			</div>
		</div><?php
	} ?>
</header>
<div id="site-body"><?php

// AD SPOT #3
blt_get_ad_spot('spot_below_menu');