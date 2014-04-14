<div class="wrap">

	<h2>Página de Opções</h2>
	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-2">
			<form method="post" action="" >	
				<!-- main content -->
				<div id="post-body-content">
				
					<div class="meta-box-sortables ui-sortable">
						
						<div class="postbox">
						
							<h3><span>Formulário</span></h3>
							<div class="inside">

								<table class="form-table">
									<tr valign="top">
										<td scope="row"><label for="tablecell">E-mail para recebimento de notificações: </label></td>
										<td><input class="regular-text" name="email" value="<?php echo esc_attr( $options['email'] ); ?>" type="text"></td>
									</tr>
									<tr valign="top" class="alternate">
										<td scope="row"><label for="tablecell">Qtd de Produtos a ser exibido por padrão</label></td>
										<td>
											<input name="qtd" id="" type="text" value="<?php echo esc_attr( $options['qtd'] ); ?>" class="small-text code" />
											<span class="description">O Padrão é 10 produtos</span>
										</td>
									</tr>
									<tr valign="top">
										<td scope="row"><label for="tablecell">Gateway de Pagamento</label></td>
										<td>
											<select name="gateway" id="">
												<option <?php selected($options['gateway'], 'moip'); ?> value="moip">Moip</option>
												<option <?php selected($options['gateway'], 'pagseguro'); ?>value="pagseguro">PagSeguro</option>
											</select>
										</td>
									</tr>
								</table>

							</div> <!-- .inside -->
						
						</div> <!-- .postbox -->
						
					</div> <!-- .meta-box-sortables .ui-sortable -->
					
				</div> <!-- post-body-content -->
				
				<!-- sidebar -->
				<div id="postbox-container-1" class="postbox-container">
					
					<div class="meta-box-sortables">
						
						<div class="postbox">
						
							<h3><span>Salvar Opções</span></h3>
							<div class="inside">
								<p>Clique no botão para salvar</p>
								
								<?php wp_nonce_field('options_page_nonce', 'options_page_nonce_field'); ?>
								<input class="button-primary" type="submit" name="options_page_submit" value="Salvar" /> 
							</div> <!-- .inside -->
							
						</div> <!-- .postbox -->
						
					</div> <!-- .meta-box-sortables -->
					
				</div> <!-- #postbox-container-1 .postbox-container -->
			</form> <!-- Closing Form -->

		</div> <!-- #post-body .metabox-holder .columns-2 -->
		
		<br class="clear">
	</div> <!-- #poststuff -->
	
</div> <!-- .wrap -->