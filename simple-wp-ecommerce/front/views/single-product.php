<div class="swpe_description">
	<h1><?php the_title(); ?></h1>
	<?php
	 if ( has_post_thumbnail() ) 
	 	the_post_thumbnail( $thumbnail_size ); 
	?>
		<?php the_content(); ?>	
</div>
<div class="swpe_pricebox">
	<div class="swpe_price">
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
	</div>

	<div class="swpe_buy_button">
		 
	    <form method="post" target="pagseguro"  
	    action="https://pagseguro.uol.com.br/v2/checkout/payment.html">  
	             <?php $options = get_option('swpe_general_options'); ?> 
	            <!-- Campos obrigatórios -->  
	            <input name="receiverEmail" value="<?php echo sanitize_email($options['email_pagseguro']) ?>" type="hidden">  
	            <input name="currency" value="BRL" type="hidden">  
	      
	            <!-- Itens do pagamento (ao menos um item é obrigatório) -->  
	            <input name="itemId1" value="<?php echo get_the_ID(); ?>" type="hidden">  
	            <input name="itemDescription1" value="<?php echo get_the_title(); ?>" type="hidden">  
	            <input name="itemAmount1" value="<?php echo swpe_get_price_with_discount('.'); ?>" type="hidden">  
	            <input name="itemQuantity1" value="1" type="hidden">  
	          
	            <!-- Código de referência do pagamento no seu sistema (opcional) -->  
	            <input name="reference" value="REF1234" type="hidden">  
	              <input type="hidden" name="encoding" value="UTF-8">
	      
	            <!-- submit do form (obrigatório) -->  
	            <input alt="Pague com PagSeguro" name="submit"  type="image"  
	    		src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/120x53-pagar.gif"/>  
	              
	    </form>  
	</div>
</div>
<?php $images = swpe_get_gallery_images(); ?>
<?php if ( is_array($images) ) : ?>
<div class="swpe_gallery">
	<h3>Galeria de Imagens</h3>

	

	<?php $attr = apply_filters('swpe_gallery_images_attr', ''); ?>

	<?php foreach ($images as $image) : ?>
		<a href="<?php echo $image; ?>" <?php echo $attr; ?>>
			<img src="<?php echo $image; ?>" height="100px">
		</a>
	<?php endforeach; ?>
</div>
<?php endif; ?>