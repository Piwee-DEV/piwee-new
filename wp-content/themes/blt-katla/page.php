<?php get_header(); ?>

	<div class="container post">

		<div class="row">

			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 piwee-mobile-content-wrapper">

				<div class="post-container">

					<?php

					if (have_posts()) {

						while (have_posts()) {
							the_post();

							get_template_part('inc/template-parts/single', get_post_format());

						}

					} ?>

				</div>

			</div>

			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">
				<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
					<aside id="site-content-sidebar">
						<div class="content-sidebar-wrap">
							<?php dynamic_sidebar('katla-right-post'); ?>
						</div>
					</aside>
				</div>
			</div>

		</div>

	</div>

<?php

get_footer();

?>