<?php

if ( ! defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') ) 
	exit();

delete_option('swpe_general_options');
delete_option('swpe_plugin_version');