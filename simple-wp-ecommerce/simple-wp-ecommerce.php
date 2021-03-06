<?php

/*
Plugin Name: Simple WP E-Commerce
Description: Plugins simples e leve para criação de pequenas lojas virtuais em qualquer site ou blog
Author: Nícholas André
Version: 1.0
Author URI: http://nicholasandre.com.br
*/

define('SWPE_PREFIX', 'swpe_');
define('SWPE_VERSION', '1.0.0');
define('SWPE_DIR', plugin_dir_path( __FILE__ ) );
define('SWPE_URL', plugins_url('', __FILE__) );

register_activation_hook( __FILE__, 'swpe_install' );

function swpe_install( ) {
	global $wp_version;

	if ( version_compare($wp_version, '3.8', '<') ) {
		wp_die('Este plugin requer no mínimo a versão 3.8 do WordPress');
	}

	add_option('swpe_plugin_version', SWPE_VERSION);
}

add_action('after_setup_theme', 'swpe_init_plugin');

function swpe_init_plugin() {
	require_once( SWPE_DIR . 'includes/init.php');

	if ( is_admin() ) {
		require_once( SWPE_DIR . 'admin/admin.php');
	} else {
		require_once( SWPE_DIR . 'front/front.php');
	}
} 