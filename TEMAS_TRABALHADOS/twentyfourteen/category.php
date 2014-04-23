<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'twentyfourteen' ), single_cat_title( '', false ) ); ?></h1>

				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .archive-header -->
			
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
					'category_name'  => get_query_var('category_name')
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
