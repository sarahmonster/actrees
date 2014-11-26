<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?>
<?php foreach( $terms AS & $term ) { ?>
	<?php 
	if ( $link_images ) : ?><a href="<?php 
	echo esc_attr( get_term_link( $term[ 'id' ], $taxonomy ) ); 
	?>"><?php endif; ?>
	
	<?php
	// figure out what sort of page we're on, and size the image accordingly
	if (is_single($post)) {
    $sized_image = get_template_directory_uri()."/library/image.php?width=260&amp;height=400&amp;cropratio=260:400&amp;image=". $term['image'];
	} else {
	 $sized_image = get_template_directory_uri()."/library/image.php?width=260&amp;height=400&amp;cropratio=260:400&amp;image=". $term['image'];
	}
	
	?>
	
	
	<img class="category" src="<?php echo $sized_image; ?>" alt="<?php echo $term[ 'name' ]; ?>" /><?php 
	if ( $link_images ) : ?></a><?php 
	endif; ?>
	<?php if ( $show_description ) : ?>
		<p><?php term_description( $term[ 'id' ], $taxonomy ); ?></p>
		<?php echo $term[ 'image' ]; ?>
		<?php echo is_single($post); ?>
	<?php endif; ?>
<?php } ?>
