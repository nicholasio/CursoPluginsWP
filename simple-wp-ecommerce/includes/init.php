<?php
require_once( SWPE_DIR . 'includes/post_types.php');
require_once( SWPE_DIR . 'includes/api.php');
require_once( SWPE_DIR . 'includes/widgets.php');


add_action('init', 'swpe_init');

function swpe_init() {
	swpe_register_post_types();
}
