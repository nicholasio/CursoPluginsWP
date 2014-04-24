<?php
require_once( SWPE_DIR . 'front/shortcodes.php');

add_action('pre_get_posts', 'swpe_pre_get_posts');

function swpe_pre_get_posts( $query ) {
	if ( ! $query->is_main_query() || is_admin() )
		return;
	if ( is_category() || $query->is_search ) {
		$query->set('post_type', array(SWPE_PREFIX . 'product') );
	}

}



