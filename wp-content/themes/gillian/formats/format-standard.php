<?php 
/** 
 * Standard post format
 * Image Outputs without a link in single
 * Image Outputs as a link in the archive pages
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 

if ( is_single() ) {
	
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( 'big-size' );
	}
	
} else{

	if ( has_post_thumbnail() ) {
?>

	<a href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( 'big-size' ); ?>
	</a>

<?php
	}
}
?>