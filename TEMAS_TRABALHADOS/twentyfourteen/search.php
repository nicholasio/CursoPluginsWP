<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyfourteen' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

				<?php 
					swpe_show_products(
						array(
							'title'				=> '<h1>Seja bem vindo a Twenty Store</h1>',
							'container_class'   => 'twenty_products',
							'before_item' 		=> '<div class="twenty_product">',
							'after_item'  		=> '</div>',
							'thumbnail_size'	=>  'twenty_swpe_image_size',
							'more_text'			=> '+ Detalhes'
						),
						array(
							'posts_per_page' => 8,
							's'  => get_query_var('s')
						)
					); 
				?>
			<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();
