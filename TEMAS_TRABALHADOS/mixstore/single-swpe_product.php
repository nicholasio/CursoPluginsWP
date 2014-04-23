<?php
/**
 *
 * @package MixStore
 */

get_header(); ?>
	<div id="primary" >
		<div id="content" role="main">

			<?php
				swpe_show_single_product(
					array(
						'container' 		=> 'div',
						'container_class'   => '',
						'thumbnail_size'    => ''
					)
				);
			?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>