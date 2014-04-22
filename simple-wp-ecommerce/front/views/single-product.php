<div class="swpe_description">
	<h1><?php the_title(); ?></h1>
	<?php
	 if ( has_post_thumbnail() ) 
	 	the_post_thumbnail( $thumbnail_size ); 
	?>
		<?php the_content(); ?>	
</div>
<div class="swpe_pricebox">
	<?php if ( swpe_get_discount() ) : ?>
		<div class="swpe_normal_price">
			De: R$ <?php swpe_show_price(); ?>	
		</div>
		<div class="swpe_price_with_discount">
			Por: R$ <?php swpe_show_price_with_discount(); ?>	
		</div>
	<?php else: ?>
		<div class="swpe_normal_price">
			R$<?php swpe_show_price(); ?>	
		</div>
	<?php endif; ?>

	<div class="swpe_divided">
		Ou
		<?php swpe_show_p(); ?>x de R$ <?php swpe_show_price_divided(); ?>	
	</div>

	<div class="swpe_buy_button">
		<a href="#">Comprar</a>
	</div>
</div>
<div class="swpe_gallery">
	<h3>Galeria de Imagens</h3>

	<?php $images = swpe_get_gallery_images(); ?>

	<?php foreach ($images as $image) : ?>
		<a href="<?php echo $image; ?>">
			<img src="<?php echo $image; ?>" height="100px">
		</a>
	<?php endforeach;?>
</div>