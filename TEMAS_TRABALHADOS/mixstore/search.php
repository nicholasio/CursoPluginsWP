<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package MixStore
 */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">


				<header class="page-header">
					<h1 class="page-title">
						<?php echo 'Resultados de busca por: <span>' . get_search_query() . '</span>'; ?>
					</h1><!-- .page-title -->
				</header><!-- .page-header -->


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
							'posts_per_page' => 4,
							's' => get_query_var('s')
						)
					); 
				}
			?>


			

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>