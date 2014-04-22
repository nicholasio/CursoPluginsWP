<div class="wrap">

	<h2>Configurações</h2>
	<p class="description"> Defina aqui as configurações da loja virtual</p>
	<?php settings_errors(); ?>

	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-2">
			<form method="post" action="options.php" >	
				<!-- main content -->
				<div id="post-body-content">
				
					<div class="meta-box-sortables ui-sortable">
						
						<div class="postbox">
						
							<h3><span>Configurações</span></h3>
							<div class="inside">

								<?php settings_fields( 'swpe_general_options' ); ?>
            					<?php do_settings_sections( 'swpe_general_options' ); ?>       

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
								
								

								<?php submit_button(); ?>
							</div> <!-- .inside -->
							
						</div> <!-- .postbox -->
						
					</div> <!-- .meta-box-sortables -->
					
				</div> <!-- #postbox-container-1 .postbox-container -->
			</form> 

		</div> <!-- #post-body .metabox-holder .columns-2 -->
		
		<br class="clear">
	</div> <!-- #poststuff -->
	
</div> <!-- .wrap -->