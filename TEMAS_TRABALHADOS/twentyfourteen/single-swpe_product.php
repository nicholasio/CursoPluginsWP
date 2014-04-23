<?php
get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
				<?php
					swpe_show_single_product(
						array(
							'container' 		=> 'div',
							'container_class'   => 'twenty_single_product',
							'thumbnail_size'    => 'twenty_swpe_image_size'
						)
					);
				?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
