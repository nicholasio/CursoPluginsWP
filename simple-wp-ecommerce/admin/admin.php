<?php

add_action('admin_menu', 'swpe_register_menus');

function swpe_register_menus() {
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

add_action('admin_init', 'swpe_options_page_settings');

function swpe_options_page_settings() {
	$slug_options = 'swpe_general_options';
	$general_section = 'swpe_general_options_section';
	$pagseguro_section = 'swpe_pagseguro_section';

	if ( false == get_option($slug_options) )
		add_option($slug_options);

	add_settings_section(
		$general_section,
		'Configurações gerais',
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
		$pagseguro_section,
		'Configurações do PagSeguro',
		null,
		$slug_options
	);

	add_settings_field(
		'email_pagseguro',
		'E-mail de cadastro no PagSeguro',
		'swpe_pagseguro_email_callback',
		$slug_options,
		$pagseguro_section,
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
	if ( !isset($options['qtd_products']) )
		$qtd_products = '';
	else 
		$qtd_products = $options['qtd_products'];

	?>
		<input type="text" name="<?php echo $args[0]; ?>[qtd_products]" id="swpe_qtd_products" value="<?php echo esc_attr($qtd_products);?>">
		<label for="swpe_qtd_products">Defina a quantidade de produtos a serem exibidos por padrão</label>
	<?php
}

function swpe_pagseguro_email_callback( $args ) {
	$options = get_option($args[0]);

	if ( !isset($options['email_pagseguro']) )
		$email_pagseguro = '';
	else 
		$email_pagseguro = $options['email_pagseguro'];

	?>
		<input type="text" name="<?php echo $args[0]; ?>[email_pagseguro]" id="swpe_email_pagseguro" value="<?php echo esc_attr($email_pagseguro);?>">
		<label for="swpe_email_pagseguro">Defina o E-mail do PagSeguro</label>
	<?php
}