<?php
/*
Plugin Name: Exemplos de uso de Custom Posts e Custom Taxonomies
Description: Este plugin exemplifica como utilizar os custom posts e custom taxonomies
Author: Nícholas André
Version: 1.0
Author URI: http://nicholasandre.com.br
*/

//Módulo 3

//Aula 3.1
/*
	Leitura Recomendada: 
		http://www.smashingmagazine.com/2012/11/08/complete-guide-custom-post-types/ 

	Leitura Complementar (Altamente recomendável):
		http://www.smashingmagazine.com/2013/12/05/modifying-admin-post-lists-in-wordpress-3/
		http://www.smashingmagazine.com/2011/10/04/create-custom-post-meta-boxes-wordpress/

*/
function my_custom_post_product() {
	$labels = array(
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
		'menu_name'          => 'Produtos'
	);
	$args = array(
		'labels'        => $labels,
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
	/*
		Lembre-se de após registrar um post_type, certifique-se que as regras de reescrita da URL (caso ativas) sejam
		reconstruídas após o registro de um novo post_type. Para tanto basta acessar Opções -> Permalinks. Toda vez que 
		esta página é acessada, o WordPress automaticamente recria as regras de reescrita.
	*/
	register_post_type( 'product', $args );	
}

add_action( 'init', 'my_custom_post_product' );

//Aula 3.2
function my_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['product'] = array(
		0 => '', 
		1 => 'Produto Atualizado. <a href="'. esc_url( get_permalink($post_ID) ) .'">Visualizar Produto</a>',
		4 => 'Produto Atualizado',
		6 => 'Produto Publicado. <a href="'. esc_url( get_permalink($post_ID) ) .'">Visualizar Produto</a>',
		7 => 'Produto Salvo'
		// Outras opções, verifique o tutorial: http://www.smashingmagazine.com/2012/11/08/complete-guide-custom-post-types/

	);
	return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages' );

function my_contextual_help( $contextual_help, $screen_id, $screen ) { 
	/* 
		Para descobrir qual o id desta tela execute:
		wp_die( var_dump($screen) ); 
		Após descobrir o id, remove este código
	*/
	if ( 'product' == $screen->id ) {

		$contextual_help = '<h2>Produtos</h2>
		<p>Texto para auxílio. Este texto deverá ajudar o usuário.</p>';

	} elseif ( 'edit-product' == $screen->id ) {

		$contextual_help = '<h2>Editando Produtos</h2>
		<p>Texto para auxílio. Este texto deverá ajudar o usuário.</p>';

	}
	return $contextual_help;
}

/*
	O terceiro parâmetro é a prioridade (o padrão é 10) e o quarto parâmetro é a quantidade de argumentos aceito
	pela função de callback
*/
add_action( 'contextual_help', 'my_contextual_help', 10, 3 );

// Aula 3.3
add_action( 'add_meta_boxes', 'product_price_box' );
function product_price_box() {
    add_meta_box( 
        'product_price_box',
        'Preço do Produto',
        'product_price_box_content',
        'product',
        'side',
        'low' //Tente colocar high
    );
}

function product_price_box_content( $post ) {
	wp_nonce_field( 'product_metabox_form_save', 'product_price_box_content_nonce' );
	$price = get_post_meta( get_the_ID(), 'product_price', true);
	?>
	<label for="product_price"></label>
	<input type="text" id="product_price" name="product_price" placeholder="Insira o preço" value="<?php echo esc_attr($price); ?>" />
	<?php
}

add_action( 'save_post', 'product_price_box_save' );

function product_price_box_save( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	return;
	
	
	if ( 'product' != get_post_type() || ! current_user_can( 'edit_post', $post_id ) )
		return;  
	
	check_admin_referer('product_metabox_form_save', 'product_price_box_content_nonce');

	$product_price = sanitize_text_field($_POST['product_price']);

	update_post_meta( $post_id, 'product_price', $product_price );
}

// Aula 3.4
function my_taxonomies_product() {
	$labels = array(
		'name'              => 'Categorias de Produto',
		'singular_name'     => 'Categoria de Produto',
		'search_items'      => 'Procurar por categorias de produto',
		'all_items'         => 'Todas as categorias de produto',
		'parent_item'       => 'Categoria de Produto Pai',
		'parent_item_colon' => 'Categoria de Produto Pai:',
		'edit_item'         => 'Editar categoria de Produto', 
		'update_item'       => 'Atualizar categoria de Produto',
		'add_new_item'      => 'Adicionar nova categoria de Produto',
		'new_item_name'     => 'Nova Categoria de Produto',
		'menu_name'         => 'Categorias de Produto'
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	
	register_taxonomy( 'product_category', 'product', $args );
}

add_action( 'init', 'my_taxonomies_product');


