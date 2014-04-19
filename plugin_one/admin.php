<?php

add_action('admin_menu', 'pone_register_menus');

function pone_register_menus() {
	add_options_page('Plugin One',
		    	     'Hello World!',
		    	     'manage_options',
		    	     'pone_hello_page',
		    	     'pone_render_page'
					);
}

function pone_render_page() {
	?>	
		<div class="wrap">
			<h2>Hello World!</h2>
			<p class="description">Seja bem vindo ao Painel do WordPress</p>

			<?php 
				$products = new WP_Query(
								array(
									'post_type' => 'product',
									'posts_per_page' => -1,
									'tax_query' => array(
										array(
											'taxonomy' => 'product_category',
											'field' => 'slug',
											'terms' => 'camisas'
										)
									)
								)
							);
				if ( $products->have_posts() ) :  
					while( $products->have_posts() ) : $products->the_post();
			?>
				<div style="class='float:left; clear:left; '">
					<h3><?php the_title(); ?></h3>
					<p><?php the_content(); ?></p>
				</div>
			<?php endwhile; endif; ?>
			
		</div>
	<?php
}