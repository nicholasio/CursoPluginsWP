<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mixstore
 */

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
							'title'				=> '',
							'container'			=> 'ul',
							'container_class'   => 'grid',
							'before_item' 		=> '<li class="wrap four columns">',
							'after_item'  		=> '</li>',
							'thumbnail_size'	=>  '',
							'more_text'			=>  '',	
							'template'			=>  get_stylesheet_directory() . '/swpe_product.php'
						),
						array(
							'posts_per_page' => 4
						)
					); 
				}
			?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>