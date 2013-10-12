<?php 
/**
 * Audio format post
 * Display audio embed code from SoundCloud from custom meta field
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 
?>


<?php 
// Output SoundCloud iframe by page url
if ( get_field( 'add_audio_url' ) ):

	$audio_embed = wp_oembed_get( get_field( 'add_audio_url' ) ); 
	echo $audio_embed;

endif; 
?>

