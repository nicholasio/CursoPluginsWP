<?php

add_action('admin_menu', 'pone_register_menus_ex');

function pone_register_menus_ex() {
	add_options_page('Plugin One (Ex)', 'Hello World (Ex)', 'manage_options', 'pone_hello_page_ex', 'pone_render_page_ex');
}

function pone_render_page_ex() {

	$title = "Hello World!";
	$title = apply_filters('pone_title_page', $title);

	?>
	<div class="wrap">
		<h2><?php echo $title; ?></h2>
		<p>Seja bem vindo ao Painel do WordPress</p>
	</div>
	<?php
}