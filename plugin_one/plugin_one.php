<?php
/*
Plugin Name: Plugin One
Description: Este é o primeiro plugin
Author: Nícholas André
Version: 1.0
Author URI: http://nicholasandre.com.br
*/

//Determinando caminhos e URLS (Aula 2.1)
/*
	Caminhos:
	plugin_dir_path( __FILE __ );
	
	Urls:
	plugins_url( $relative_path, __FILE__ );
	ou

	define('PONE_URL', plugins_url('', __FILE__) );

*/
define('PONE_REQUIRED_VERSION', '3.8'); 
define('PONE_URL', plugins_url('', __FILE__) );
define('PONE_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook( __FILE__, 'pone_activate');

function pone_activate() {
	global $wp_version;

	if ( version_compare( $wp_version, PONE_REQUIRED_VERSION, '<' ) ) {
		wp_die('Este plugin requer no mínimo a versão' . PONE_REQUIRED_VERSION . ' do WordPress');
	} 

	//Realiza operações na ativação do plugin
}

register_deactivation_hook( __FILE__, 'pone_deactivate');

function pone_deactivate() {
	//Realiza operações na desativação do plugin

	//delete_option('pone_settings');

}

require_once( PONE_DIR . 'admin.php');

// Actions and Filters: hooks ( Aula 2.2 e 2.3)
/*
Através dos ganchos é possível executar funções em pontos específicos no processo de inicialização do WordPress.
Existem dois tipos de ganchos, actions e filters, por exemplo, nós temos uma action sendo "disparada" quando um novo post
é publicado. Filtros são utilizados normalmente para modificar algum conteúdo antes desse conteúdo ser utilizado, por exemplo,
existe um filtro que é aplicado quando o conteúdo de um post ou uma página é exibido (the_content).

O formato para utilizarmos uma action (associar uma função em alguma action existente - daí a idéia de gancho) é o seguinte:
add_action( $action_name, $function_callback );
Ex:
add_action('save_post', 'prefix_save_post');
function prefix_save_post( $post_id ) {
	//Faça alguma coisa antes dos dados serem salvos no banco de dados.
}

O formato para uso de um filtro é semelhante:
add_filter( $filter_name, $function_callback );
ex:
add_filter( 'the_content', 'prefix_alter_the_content');
function prefix_alter_the_content( $content ) {
	return $content . " <br /> <p>Todos os direitos reservados à Ńícholas André</p>"
}

Múltiplas funções podem ser associadas há uma action ou filter. É possível assim definir a prioridade desta função 
frente as outras. Valores menores para a prioridade indicam que esta função terá uma prioridade maior.

add_action('init', 'prefix_init', 5);
A função prefix_init tenderá a executar primeiro, uma vez que a prioridade padrão é 10.
*/

//https://core.trac.wordpress.org/browser/tags/3.8.2/src/wp-includes/post-template.php#L0
add_filter('the_title', 'pone_custom_title');

function pone_custom_title( $title ) {
	return $title . " - By Nícholas André";
}

//Necessário utilizar a função wp_footer();
add_action ('wp_footer', 'pone_google_tracking_code');

function pone_google_tracking_code() {
	?>
		<!-- Código do Google Analytics-->
	<?php
}

//Desenvolvendo plugins extensíveis pelo usuário ( Aula 2.6 )

add_action('after_setup_theme', 'pone_load_plugin');

function pone_load_plugin() {
	require_once( PONE_DIR . 'admin_extensible.php');
}
