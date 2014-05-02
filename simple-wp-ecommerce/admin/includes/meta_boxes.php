<?php

add_action('init', 'swpe_initialize_cmb_meta_boxes', 9999 );

function swpe_initialize_cmb_meta_boxes() {
	if ( ! class_exists('cmb_Meta_Box') )
		require_once( SWPE_DIR . 'admin/includes/cmb/init.php');
}

add_filter('cmb_meta_boxes', 'swpe_product_meta_boxes');

function swpe_product_meta_boxes( array $meta_boxes ) {
	$prefix = '_swpe_product_';

	$meta_boxes['product_info'] = array(
		'id' => SWPE_PREFIX . 'product_info',
		'title' => 'Informações do Produto',
		'pages' => array( SWPE_PREFIX . 'product' ),
		'context' => 'normal',
		'priority' => 'low',
		'show_names' => true,
		'fields' => array(
			array(
				'name' => 'Breve Descrição do Produto',
				'desc' => 'Insira uma breve descrição do produto',
				'id' => $prefix . 'description',
				'type' => 'textarea'
			),
			array(
				'name' => 'Galeria de Imagens',
				'desc' => 'Envie as imagens para a galeria',
				'id' => $prefix . 'gallery',
				'type'  => 'file_list',
				'preview_size' => array(100,100)
			)
		)
	);

	$meta_boxes['product_price'] = array(
		'id' 		=> SWPE_PREFIX . 'product_price',
		'title' 	=> 'Preço do Produto',
		'pages'     => array(SWPE_PREFIX . 'product'),
		'context'   => 'side',
		'priority'  => 'low',
		'show_names' => true,
		'fields'    => array(
			array(
				'name' => 'Preço',
				'desc' => 'Insira o preço do produto',
				'id'   => $prefix . 'price',
				'type' => 'text_small'
			),
			array(
				'name' => 'Desconto à vista',
				'desc' => 'Infome o desconto à vista (%)',
				'id'   => $prefix . 'discount',
				'type' => 'text_small'
			),
			array(
				'name' => 'Número de Parcelas',
				'desc' => 'Informe o número de parcelas',
				'id'   => $prefix . 'number_p',
				'type' => 'text_small'
			)
		)
	);
	
	return $meta_boxes;
}