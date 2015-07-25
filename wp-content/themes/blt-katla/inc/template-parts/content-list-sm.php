<article <?php post_class('post list-sm-item'. (!has_post_thumbnail() ? ' list-sm-item-no-image' : '')); ?>><?php
	
	#  
	#  GET SCORE
	#  ========================================================================================
	#   

		$score = get_post_meta( get_the_ID(), 'blt_score', true );

		if(empty($score)){
			$score = 0;
		} 

	#  
	#  DISPLAY POST STATUS
	#  ========================================================================================
	#   

		if(get_post_status() != 'publish'){

			if(get_post_status() == 'trash'){ ?>

				<div class="label post-status post-status-declined"><?php _e('Removed'); ?></div><?php

			}else{ ?> 
			
				<div class="label post-status"><?php echo get_post_status(); ?></div><?php

			}

		}

	if( has_post_thumbnail(get_the_ID()) ){ ?>
		
		<div class="list-sm-image">

			<?php the_post_thumbnail('thumbnail', array('alt' => get_the_title())); ?>

		</div><?php

	} ?>

	<div class="list-sm-meta">

		<h4 class="list-sm-title"><?php

			if(get_post_status() == 'publish'){ ?>
			
				<a href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title() ?></a><?php
			
			}else{ 
				
				the_title();

			} ?>

		</h4>

		<div class="content-meta">

			<?php blt_get_post_meta() ?>

			<span class="list-sm-score"><?php echo $score; ?></span>

		</div>

	</div>

</article>