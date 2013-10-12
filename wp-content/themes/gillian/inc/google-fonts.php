<?php
/**
 * Google Fonts
 *
 * @package Viewpoint
 * @since 	Viewpoint 1.0
**/
$ti_customfont = '';
$google_fonts = array( $ti_option['font_titles'], $ti_option['font_text'] );
			
foreach( $google_fonts as $google_font ) {
	if( !is_array( $google_font ) ) {
		$ti_customfont = str_replace( ' ', '+', $google_font ) . ':300,300italic,400,400italic,700,700italic,900,900italic|' . $ti_customfont;
	}
}	

if ( $ti_customfont != "" ) {	
	function google_font() {		
		global $ti_customfont;		
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'google-fonts', "$protocol://fonts.googleapis.com/css?family=". substr_replace( $ti_customfont,"",-1 ) . "' rel='stylesheet' type='text/css" );
	}
	add_action( 'wp_enqueue_scripts', 'google_font', 15 );
}
?>