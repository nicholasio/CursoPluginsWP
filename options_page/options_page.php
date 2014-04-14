<?php
/*
Plugin Name: Página de Opções
Description: Este plugin exemplifica como criar páginas de opções
Author: Nícholas André
Version: 1.0
Author URI: http://nicholasandre.com.br
*/

add_action('admin_menu', 'options_add_menu');

/*
add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
*/
function options_add_menu() {
	add_menu_page( 'Página de Opções', 'Opções do Plugin', 'manage_options', 'options_page', 'options_page_layout');
}

function options_page_layout() {
	if ( ! empty($_POST) && isset($_POST['options_page_submit']) ) {
		
		check_admin_referer('options_page_nonce', 'options_page_nonce_field');

		$options = array();

		if ( isset( $_POST['email'] ) ) 
			$options['email'] = sanitize_email( $_POST['email'] );

		if ( isset( $_POST['qtd']) ) {
			$options['qtd'] = intval( $_POST['qtd']);
		}

		if ( isset( $_POST['gateway']) ) {
			$options['gateway'] = esc_attr( $_POST['gateway'] );
		}

		update_option('plugin_options_settings', $options);

	}

	$defaults = array(
			'qtd' => 10,
			'gateway' => 'moip',
			'email' => ''
	);

	$options = get_option('plugin_options_settings');
	$options = wp_parse_args($options, $defaults);

	require_once( plugin_dir_path( __FILE__ ) . '/admin/admin.php' );
}