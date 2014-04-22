<?php

add_shortcode('swpe_product', 'swpe_product_shortcode');

function swpe_product_shortcode() {

	/*
		Exercício para o aluno: processar parâmetros e passar 
		os parâmetros para a função swpe_show_products()
	*/

	ob_start();

	swpe_show_products();

	$content = ob_get_clean();

	return $content;
}