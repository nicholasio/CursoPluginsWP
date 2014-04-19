<?php
/*
Plugin Name: Shortcodes e Widgets
Description: Este plugin exemplifica a criação de shortcodes e Widgets
Author: Nícholas André
Version: 1.0
Author URI: http://nicholasandre.com.br
*/

// Aula 7.1
add_shortcode('stw_twitter', 'stw_fn_twitter');

function stw_fn_twitter( $atts, $content ) {

	$twitter_link = "http://www.twitter.com/";

	$perfil = '';
	if ( ! empty($content) )
		$perfil = $content;
	else if ( isset($atts['name']) && ! empty($atts['name']) )
		$perfil = $atts['name'];

	$perfil = esc_attr($perfil);
	$twitter_link .= $perfil;

	return "<a href='{$twitter_link}' target='_blank'>{$perfil}</a> <br />";

} 

//Aula 7.2

add_action('wp_dashboard_setup', 'stw_add_dashboard_widget');

function stw_add_dashboard_widget() {
	wp_add_dashboard_widget( 
		'stw_dashboard_widget', 
		'Resumo da loja',
		'stw_create_dashboard_widget'
	);
}

function stw_create_dashboard_widget() {
	$user = wp_get_current_user();
	$qr   = new WP_Query( 
				array(
					'posts_per_page' => -1,
					'post_type' => 'product'
				) 
			);
	if ( $qr->have_posts() ) $qr->the_post();  
	?>
	<p>Olá <?php echo $user->user_login; ?>, existem <?php echo $qr->post_count ?> produto(s) cadastrados</p>
	<?php
}

//Aula 7.3
add_action('widgets_init', 'stw_register_widgets');

function stw_register_widgets() {
	/*
		Recebe como parâmetro o nome da classe criada.
	*/
	register_widget('STW_Bio_Widget');
}

class STW_Bio_Widget extends WP_Widget {

	function __construct() {
		$widgets_ops = array(
			'classname' => 'stw_widget_class',
			'description' => 'STW Widget: Exibe a biografia de uma pessoa',
		);

		parent::__construct( 'stw_bio_widget', 'STW Bio Widget', $widgets_ops );
	}

	/*
		$instance contém os dados salvos do Widget
	*/
	public function form( $instance ) {
		$defaults = array(
			'title' => 'Minha Biografia',
			'name'  => '',
			'bio'   => ''
		);

		/*
			Combina 2 arrays, onde é dado "prioridade" aos campos do primeiro array.
			Se $instance = array( 'title' =>  'teste' ) e $defaults = array( 'title' => '', 'qtd' => 10)
			O array resultante será array( 'title' => 'teste', 'qtd' => 10);
		*/
		$instance = wp_parse_args( $instance, $defaults );

		$title    = $instance['title'];
		$name     = $instance['name'];
		$bio      = $instance['bio'];

		?>
		<p>Título: 
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('title'); ?>"
				   value="<?php echo esc_attr($title); ?>" >
		</p>
		<p>Nome: 
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('name'); ?>"
				   value="<?php echo esc_attr($name); ?>" >
		</p>
		<p>Biografia: 
			<textarea name="<?php echo $this->get_field_name('bio'); ?>" id="" cols="30" rows="10" class="widefat"><?php echo esc_textarea( $bio ); ?></textarea>
		</p>
		<?php
	}

	/*
		$new_instance são os dados que o usuário acabou de inserir, $old_instance são os dados antigos
	*/
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['name']  = sanitize_text_field($new_instance['name']);
		$instance['bio']   = sanitize_text_field($new_instance['bio']);

		return $instance;
	}

	/*
		$args são os parâmetros passados no register_sidebar. $instance são os dados salvos do Widget
	*/
	public function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;

		$title = apply_filters('widget_title', $instance['title']);
		$name  = ( empty($instance['name']) ) ? '&nbsp;' : $instance['name'];
		$bio   = ( empty($instance['bio']) ) ? '&nbsp;' : $instance['bio'];

		if ( ! empty($title) ) 
			echo $before_title . esc_html( $title ) . $after_title;
		?>
		<p>Nome: <?php echo esc_html( $name ); ?></p>
		<p>Bio: <?php echo esc_html( $bio ); ?></p>
		<?php
		echo $after_widget;
	}
}