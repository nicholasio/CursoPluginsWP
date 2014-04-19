<?php
/*
Plugin Name: Settings API
Description: Este plugin exemplifica como criar páginas de opções usando a Settings API
Author: Nícholas André
Version: 1.0
Author URI: http://nicholasandre.com.br
*/

/*
	Leitura Recomendada:
		https://github.com/tommcfarlin/WordPress-Settings-Sandbox
*/

 
// Aula 6.1 
/* ------------------------------------------------------------------------ *
 * Registrando Settings
 * ------------------------------------------------------------------------ */
 
add_action('admin_init', 'stp_initialize_theme_options');
function stp_initialize_theme_options() {
 
    add_settings_section(
        'general_settings_section',         // ID utilizado para identificar esta seção
        'Opções customizadas',                  // Título para ser exibido na página de administração
        'stp_general_options_callback', // Callback usado para renderizar esta seção
        'general'                           // Em qual página adicionar esta seção
    );

    add_settings_field(
        'show_header',                      // IDutilizado para identificar este campo
        'Cabeçalho',                           //Label
        'stp_toggle_header_callback',   // Função de callback
        'general',                          // Em qual página esta opção será exibida
        'general_settings_section',         // Nome da seção a qual este campo pertence
        array(                              // Array de parâmetros paassados para a função de callbacks
            'Ative esta opção para exibir o cabeçalho'
        )
    );

    register_setting(
	    'general',
	    'show_header'
	);
} 
 
/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */
 
function stp_general_options_callback() {
    echo '<p class="description">Esta é uma seção</p>';
}

function stp_toggle_header_callback( $args ) {
    ?>
    <input type="checkbox" id="show_header" name="show_header" value="1" <?php checked(1, get_option('show_header')); ?> />
    <label for="show_header"><?php echo $args[0]; ?></label>
    <?php
}
  
// Aula 6.2

add_action('admin_menu', 'stp_register_menus');

function stp_register_menus() {
	add_theme_page(
        'Opções do tema',            // O Título da página
        'Opções do tema',            // Label do menu
        'administrator',             // Permissão para visualizar esta página
        'stp_theme_options',         // Slug - unique ID
        'stp_theme_display'          // Nome da função para renderizar esta página
    );
}

function stp_theme_display() {
	?>
	<div class="wrap">
		<h2>Opções do tema</h2>
		<p class="description">Existem diversas opções para você customizar este tema</p>

		<?php settings_errors(); ?>

		<form method="post" action="options.php">
            <?php settings_fields( 'stp_theme_display_options' ); ?>
            <?php do_settings_sections( 'stp_theme_display_options' ); ?>        
            <?php submit_button(); ?>
        </form>
	</div>
	<?php
}

add_action('admin_init', 'stp_theme_options');

function stp_theme_options() {

    if( false == get_option( 'stp_theme_display_options' ) ) { 
        add_option( 'stp_theme_display_options' );
    } 

    add_settings_section(
        'general_settings_section',         
        'Opções de Exibição',                  
        'stp_general_display_options_callback', 
        'stp_theme_display_options'     
    );

    add_settings_field(
        'show_header',                      
        'Cabeçaçho',                           
        'stp_header_callback',   
        'stp_theme_display_options',    
        'general_settings_section',         
        array(                              
            'Ative esta opção para exibir o cabeçalho'
        )
    );
     
    add_settings_field(
        'show_content',                    
        'Çonteúdo',             
        'stp_content_callback', 
        'stp_theme_display_options',                   
        'general_settings_section',        
        array(                             
            'Ative esta opção para exibir o conteúdo'
        )
    );
     
    add_settings_field(
        'show_footer',                     
        'Footer',              
        'stp_footer_callback',  
        'stp_theme_display_options',       
        'general_settings_section',        
        array(                             
            'Ative esta opção para exibir o rodapé'
        )
    );
     
    register_setting(
        'stp_theme_display_options',
        'stp_theme_display_options'
    );
}

function stp_general_display_options_callback() {
	?>
	<p>Selecione as áreas que você deseja exibir no tema</p>
	<?php
}

function stp_header_callback( $args ) {
    $options = get_option('stp_theme_display_options');
    ?>
    <input type="checkbox" name="stp_theme_display_options[show_header]" value="1" <?php checked(1, $options['show_header']); ?> >
    <label for="show_header"><?php echo $args[0]; ?></label>
    <?php
}
 
function stp_content_callback( $args ) {
    $options = get_option('stp_theme_display_options');
    ?>
    <input type="checkbox" name="stp_theme_display_options[show_content]" value="1" <?php checked(1, $options['show_content']); ?> >
    <label for="show_header"><?php echo $args[0]; ?></label>
    <?php
}
 
function stp_footer_callback( $args ) {
    $options = get_option('stp_theme_display_options');
    ?>
    <input type="checkbox" name="stp_theme_display_options[show_footer]" value="1" <?php checked(1, $options['show_footer']); ?> >
    <label for="show_header"><?php echo $args[0]; ?></label>
    <?php
}

