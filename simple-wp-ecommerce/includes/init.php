<?php
require_once( SWPE_DIR . 'includes/post_types.php');
require_once( SWPE_DIR . 'includes/api.php');
require_once( SWPE_DIR . 'includes/widgets.php');

add_action('init', 'swpe_init');


function swpe_init() {
	/*
		Função definida no arquivo includes/post_types.php
	*/
	swpe_register_post_types();
}
