<?php

add_action('admin_menu', 'pone_register_menus');

function pone_register_menus() {
	add_options_page('Plugin One', 'Hello World', 'manage_options', 'pone_hello_page', 'pone_render_page');
}

function pone_render_page() {
	?>
	<div class="wrap">
		<h2>Hello World!</h2>
		<p>Seja bem vindo ao Painel do WordPress</p>
	</div>
	<?php
}