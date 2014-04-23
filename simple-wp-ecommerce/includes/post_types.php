<?php

function swpe_register_post_types() {
	$menu_name = apply_filters( SWPE_PREFIX . 'menu_name', '[SWPE] Produtos' );
	
	register_post_type( 
		SWPE_PREFIX . 'product',
		array(
			'labels' => array(
				'name'               => 'Produtos',
				'singular_name'      => 'Produto',
				'add_new'            => 'Adicionar Novo',
				'add_new_item'       => 'Adicionar Novo Produto',
				'edit_item'          => 'Editar Produto',
				'new_item'           => 'Novo Produto',
				'all_items'          => 'Todos Produtos',
				'view_item'          => 'Visualizar Produto',
				'search_items'       => 'Procurar Produtos',
				'not_found'          => 'Nenhum Produto encontrado',
				'not_found_in_trash' => 'Nenhum Produto encontrado na lixeira', 
				'parent_item_colon'  => '',
				'menu_name'          => $menu_name
			),
			'public'      => true,
			'supports'    => array('title', 'editor', 'thumbnail'),
			'has_archive' => true,
			'menu_icon'   => 'dashicons-cart'
		)
	);

	add_post_type_support( SWPE_PREFIX . 'product', 'thumbnail' );

	$taxonomy = apply_filters('swpe_main_taxonomy', 'category');

	register_taxonomy_for_object_type( $taxonomy, SWPE_PREFIX . 'product' );
}
add_filter( 'post_updated_messages', 'swpe_updated_messages' );

function swpe_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[SWPE_PREFIX . 'product'] = array(
		0 => '', 
		1 => sprintf( 'Produto Atualizado. <a href="%s">Visualizar Produto</a>', esc_url( get_permalink($post_ID) ) ),
		2 => 'Informações adicionais atualizadas',
		3 => 'Informações adicionais removidas',
		4 => 'Produto atualizado',
		5 => isset($_GET['revision']) ? sprintf( 'Produto restaurado para revisão de %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( 'Produto publicado. <a href="%s">Visualizar Produto</a>', esc_url( get_permalink($post_ID) ) ),
		7 => 'Produto salvo.',
		8 => sprintf( 'Produto submetido. <a target="_blank" href="%s">Pré-visualizar Produto</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( 'Produto agendado para: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Pré-visualizar Produto</a>', date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( 'Rascunho de Produto atualizado com sucesso. <a target="_blank" href="%s">Pré-visualizar Produto</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);

	return $messages;
}

/*
 * Definições de Meta Box para este Post Type
 */
require_once( SWPE_DIR . 'admin/includes/meta_boxes.php');

