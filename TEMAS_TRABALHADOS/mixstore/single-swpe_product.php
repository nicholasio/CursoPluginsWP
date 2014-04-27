<?php

get_header(); ?>


	<div id="primary" class="<?php echo $post_class; ?>">
		<div id="content" role="main">

			<?php 
				if ( function_exists('swpe_show_single_product') ) {
					swpe_show_single_product(
						array(
							'container' => 'div',
							'container_class' => '',
							'thumbnail_size' => 'mixstore_product'
						)
					);
				}
			?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>