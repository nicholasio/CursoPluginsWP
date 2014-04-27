<?php
get_header(); ?>

	<div id="primary" class="full-width">
		<div id="content" role="main">

			<?php
				/**
				 * Welcome Area
				 */
				get_template_part( 'part', 'hero' );
			?>

			<?php 
				if ( function_exists('swpe_show_products') ) {
					swpe_show_products(
						array(
							'title' => '',
							'container' => 'ul',
							'container_class' => 'grid',
							'before_item' 		=> '<li class="wrap four columns">',
							'after_item'  		=> '</li>',
							'more_text'			=> '',
							'thumbnail_size'    => 'mixstore_product',
							'template'			=> get_stylesheet_directory() . '/swpe_product.php'
						),
						array(
							'posts_per_page' => 6
						)
					);
				}
			?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>