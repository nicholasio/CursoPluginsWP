<?php
/*
	Template Name: SWPE Produtos
*/
get_header(); ?>

<div id="main-content" class="main-content">

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
		<!-- Exibindo Produtos -->
	
		<?php 
			swpe_show_products(
				array(
					'title'				=> '<h1>Seja bem vindo a Twenty Store</h1>',
					'container_class'   => 'twenty_products',
					'before_item' 		=> '<div class="twenty_product">',
					'after_item'  		=> '</div>',
					'thumbnail_size'	=>  'twenty_swpe_image_size',
					'more_text'			=> '+ Detalhes',
					'before_title' => '<h3>',
					'after_title'  => '</h3>'
				),
				array(
					'posts_per_page' => 4
				)
			); 
		?>


		

		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
