<div class="entry-link">
	<a href="<?php the_permalink(); ?>" title="Veja Mais Detalhe do Produto" rel="bookmark"></a>
</div><!-- .entry-link -->

<?php
	if ( '' != get_the_post_thumbnail () ) {
		the_post_thumbnail();
	}
?>

<div class="hide">
	<h1 class="entry-title"><?php the_title(); ?></h1><!-- .entry-title -->
	<footer class="entry-meta">

		<?php 
			if ( !is_search() )
				the_excerpt();	
		?>
		<span class="postdate">
			<?php echo get_the_date(); ?>
		</span><!-- .postdate -->
		
	</footer><!-- .entry-meta -->
</div><!-- .hide -->