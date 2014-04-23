<?php

function swpe_get_products( $args = array() ) {
	$options = get_option('swpe_general_options');
	$defaults = array(
		'posts_per_page' => (int) $options['qtd_products'],
	);

	$args = wp_parse_args( $args, $defaults );

	$args['post_type'] = SWPE_PREFIX . 'product';
	if ( get_query_var('paged') )
		$paged = max(1,get_query_var('paged') );
	else
		$paged = max(1, get_query_var('page') );

	$args['paged'] = $paged;
	$qr = new WP_Query( $args );

	return $qr; 
}

function swpe_show_products( $display_args = array() , $qr_args = array() ) {
	$products = swpe_get_products( $qr_args );

	$defaults = array(
		'container'       	=> 'div',
		'container_class' 	=> '',
		'before_item'     	=> '<div class="swpe_item">',
		'after_item'      	=> '</div>',
		'thumbnail_size' 	=> 'medium',
		'more_text'		  	=> 'Ver Produto',
		'title'  	  	 	=> '',
		'before_title'		=> '<h1>',
		'after_title'		=> '</h1>',
		'template'			=> SWPE_DIR . 'front/views/product.php'
 	);

 	$display_args = wp_parse_args( $display_args, $defaults );
 	extract($display_args);

 	if ( ! empty($container) )
 		echo '<'. $container .' class="' . $container_class . '">';

 	echo $title;

	if ( $products->have_posts() ) {
		while( $products->have_posts() ) { 
			$products->the_post();
			echo $before_item;
				include( $template );
			echo $after_item;
		}
	} else {
		echo $before_item;
			echo '<p>Não existem produtos cadastrados.</p>';
		echo $after_item;
	}

	

	if ( ! empty($container) )
		echo '</' . $container . '>';

	swpe_base_pagination( $products );
}

function swpe_get_description() {
	return get_post_meta(get_the_ID(), '_swpe_product_description', true);
}

function swpe_show_description() {
	echo swpe_get_description();
}

function swpe_base_pagination( $query ) {

    $big = 999999999; 


    $base   = home_url() . '%_%';
    $format = '?page=%#%';
    $paged  = max(1, get_query_var('page'));
    if ( ! is_front_page() ) {
    	$base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
    	$format = '?paged=%#%';
    	$paged = max(1, get_query_var('paged') );
    }
    	

    $paginate_links = paginate_links( 
    	array(
	        'base' => $base,
	        'format' => $format,
	        'current' => $paged,
	        'total' => $query->max_num_pages,
	        'mid_size' => 5,
	        'prev_text' => '<<',
	        'next_text' => '>>',
	        'type' => 'list'
    	) 
    );

    if ( $paginate_links ) {
        echo '<div class="pagination">';
        echo $paginate_links;
        echo '</div><!--// end .pagination -->';
    }
}

function swpe_get_gallery_images() {
	return get_post_meta(get_the_ID(), '_swpe_product_gallery', true);
}

function swpe_show_single_product( $args ) {
	global $post;
	setup_postdata($post);
	extract($args);

	if ( !empty($container) )
		echo '<' .  $container . ' class="'. $container_class.'">';

		include(SWPE_DIR . 'front/views/single-product.php');

	if ( !empty($container) )
		echo '</' . $container . '>';
	wp_reset_postdata();
}

function swpe_get_price() {
	$price = get_post_meta(get_the_ID(), '_swpe_product_price', true);
	$price = str_replace(',', '.', $price);
	return number_format($price, 2, '.', '');
}

function swpe_show_price() {
	echo swpe_get_price();
}

function swpe_get_discount() {
	$discount = get_post_meta(get_the_ID(), '_swpe_product_discount', true);

	if ( empty($discount) )
		return false;

	return $discount;
}

function swpe_show_discount() {
	if ( swpe_get_discount() ) 
		echo swpe_get_discount();
}

function swpe_get_price_with_discount( $sep = ',') {
	$discount = swpe_get_discount();
	if ( $discount ) {
		$discount = $discount/100;
		$price = str_replace(',','.', swpe_get_price());
		$price = $price - $price*$discount;
		return number_format($price, 2, '.', '');
	} else {
		return  swpe_get_price();
		
	}
}

function swpe_show_price_with_discount() {
	echo swpe_get_price_with_discount();
}

function swpe_get_p() {
	return get_post_meta( get_the_ID(), '_swpe_product_number_p', true);
}

function swpe_show_p() {
	echo swpe_get_p();
}

function swpe_show_price_divided() {
	$p = swpe_get_p();
	$price = str_replace(',','.', swpe_get_price_with_discount());

	$price = $price / $p;
	$price = number_format($price, 2);
	$price = str_replace('.',',',$price);

	echo $price;
}