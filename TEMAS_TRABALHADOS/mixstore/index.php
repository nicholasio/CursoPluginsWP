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
			?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>


<div class="hide">
		<h1 class="entry-title"><?php the_title(); ?></h1><!-- .entry-title -->
		<footer class="entry-meta">
			<?php if ( ! is_sticky() && ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) ) : ?>
				<span class="postcomments"><?php echo get_comments_number(); ?></span><!-- .postcomments -->
			<?php endif; ?>

			<?php if ( ! is_sticky() ) : ?>
				<span class="postdate">
					<?php echo get_the_date(); ?>
				</span><!-- .postdate -->
			<?php endif; ?>

			<?php
				$format = get_post_format();
				if ( false === $format )
					$format = 'standard';
			?>
			<span class="format <?php echo $format; ?>"><?php echo $format; ?></span><!-- .format -->
		</footer><!-- .entry-meta -->
	</div><!-- .hide -->