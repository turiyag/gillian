<?php 
/**
 * Video post format
 * Display video embed code from custom meta field
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 
?>


<?php

// Output the video by page url
if ( get_field( 'add_video_url' ) ):

	$video_embed = wp_oembed_get( get_field( 'add_video_url' ) );
	echo '<figure class="wrapper video-wrapper">' .$video_embed. '</figure>';

endif; ?>
