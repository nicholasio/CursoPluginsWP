<?php


get_header(); ?>

	<section id="primary" class="full-width">
		<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php printf( __( 'Categoria %s', 'mixfolio' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
					</h1><!-- .page-title -->

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
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
								'thumbnail_size'	=>  'mixstore_product',
								'more_text'			=>  '',	
								'template'			=>  get_stylesheet_directory() . '/swpe_product.php'
							),
							array(
								'posts_per_page' => 6,
								'category_name'  => get_query_var('category_name')	
							)
						); 
					}
				?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title">
							<?php _e( 'Nada foi encontrado', 'mixfolio' ); ?>
						</h1><!-- .entry-title -->
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Aparentemente nada foi encontrado.', 'mixfolio' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>