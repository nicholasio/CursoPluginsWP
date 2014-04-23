<?php echo $before_title; ?>
	<a href="<?php the_permalink(); ?>"><?php the_title()?> </a>
<?php echo $after_title; ?>
<a href="<?php the_permalink(); ?>"><?php
 if ( has_post_thumbnail() ) 
 	the_post_thumbnail( $thumbnail_size ); 
?>
</a>
<p><?php swpe_show_description(); ?></p>
<a href="<?php the_permalink(); ?>"><?php echo $more_text ?></a>
