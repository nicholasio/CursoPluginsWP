<?php
add_action('admin_menu', 'swpe_register_menus');

function swpe_register_menus()  {
	add_submenu_page( 
		'edit.php?post_type='. SWPE_PREFIX . 'product',
		'Configurações', 
		'Configurações',
		'manage_options',
		SWPE_PREFIX . 'options_page',
		'swpe_render_options_page'
	);
}

function swpe_render_options_page() {
	require_once( SWPE_DIR . 'admin/views/options_page.php');
}

/***
	Settings API
 ***/

add_action('admin_init', 'swpe_options_page_settings');
 
function swpe_options_page_settings() {
	$slug_options 		= 'swpe_general_options';
	$general_section    = 'swpe_general_options_section';
	$moip_section       = 'swpe_moip_secttion';



	if ( false == get_option($slug_options) )
		add_option($slug_options);


	add_settings_section(
		$general_section,
		'Configuraçãos gerais',
		null,
		$slug_options
	);

	add_settings_field(
		'qtd_products',
		'Qtd de Produtos',
		'swpe_qtd_products_callback',
		$slug_options,
		$general_section,
		array(
			$slug_options
		)
	);

	add_settings_section(
		$moip_section,
		'Escolha qual o gateway de pagamento',
		null,
		$slug_options
	);

	add_settings_field(
		'gateway',
		'Gateway de Pagamento',
		'swpe_gateway_callback',
		$slug_options,
		$moip_section,
		array(
			$slug_options
		)
	);

	register_setting(
		$slug_options,
		$slug_options
	);
}

function swpe_qtd_products_callback( $args ) {
	$options = get_option($args[0]);

	?>
		<input type="text" name="<?php echo $args[0]; ?>[qtd_products]" id="swpe_qtd_products" value="<?php echo esc_attr($options['qtd_products']);?>">
		<label for="swpe_qtd_products">Defina a quantidade de produtos a serem exibidos por padrão</label>
	<?php
}

function swpe_gateway_callback( $args ) {
	$options = get_option($args[0]);
	?>
	<select name="<?php echo $args[0]; ?>[gateway]" id="">
		<option <?php selected($options['gateway'], 'moip'); ?> value="moip">Moip</option>
		<option <?php selected($options['gateway'], 'pagseguro'); ?>value="pagseguro">PagSeguro</option>
	</select>
	<?php
}



