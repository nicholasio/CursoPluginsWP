<?php

add_action('widgets_init', 'swpe_register_widgets');

function swpe_register_widgets() {
	register_widget('swpe_Featured_Product'); 
}

class swpe_Featured_Product extends WP_Widget {

	function __construct() {
		$widgets_ops = array(
			'classname' => 'swpe_featured_product',
			'description' => '[SWPE] Produto em Destaque: Exibe um produto em destaque'
		);

		parent::__construct('swpe_featured_product', '[SWPE] Produto em Destaque', $widgets_ops);
	}

	public function form( $instance ) {
		$defaults = array(
			'title' => 'Produto em Destaque',
			'more_text' => 'Ver detalhes',
			'product' => -1
		);

		$instance = wp_parse_args( $instance , $defaults );

		$title 		= $instance['title'];
		$more_text 	= $instance['more_text'];
		$selected	 = $instance['product'];

		?>
		<p>Título: 
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('title'); ?>"
				   value="<?php echo esc_attr($title); ?>" >
		</p>
		<p>More Link Text 
			<input type="text" class="widefat" name="<?php echo $this->get_field_name('more_text'); ?>"
				   value="<?php echo esc_attr($more_text); ?>" >
		</p>
		<p>
			Produto: 
			<select name="<?php echo $this->get_field_name('product'); ?>" class="widefat">
				<?php 
					$products = swpe_get_products( array('posts_per_page' => '-1') );
					while( $products->have_posts() ) : 
						$products->the_post();
				?>
					<option class="widefat" value="<?php echo get_the_ID(); ?>" <?php selected(get_the_ID(), $selected) ?>><?php the_title();?></option>
				<?php endwhile; wp_reset_postdata(); ?>
			</select>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title']);
		$instance['more_text'] = sanitize_text_field( $new_instance['more_text']);
		$instance['product'] = (int) $new_instance['product'];

		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;

		$title = apply_filters('widget_title', $instance['title']);

		if ( ! empty($title) ) 
			echo $before_title . esc_html( $title ) . $after_title;

		global $post;
		$post = get_post( $instance['product'] );
		setup_postdata($post);
		$more_text = $instance['more_text'];
		$thumbnail_size = '';
		include( SWPE_DIR . 'front/views/product.php');
		wp_reset_postdata();
		

		echo $after_widget;
	}
}