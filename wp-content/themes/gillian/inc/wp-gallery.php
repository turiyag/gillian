<?php
/**
 * WP Native Gallery
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/

if( !(function_exists( 'sf_post_gallery' ) ) ) { 
	add_filter('post_gallery', 'sf_post_gallery', 10, 2);

	function sf_post_gallery($null, $attr = array()) {
		global $post, $wp_locale;
		static $instance = 0;
		$instance++;
		
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
		}
		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'figure',
			'captiontag' => 'figcaption',
			'columns'    => 3,
			'size'       => 'big-size',
			'include'    => '',
			'exclude'    => ''
		), $attr));
		
		$id = intval($id);
		if ( 'RAND' == $order )
		$orderby = 'none';
		
		if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
		
		if ( empty($attachments) )
		return '';
		
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}
		
		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$float = is_rtl() ? 'right' : 'left';
		
		$output = "<div id='gallery-{$instance}' class='gallery galleryid-{$id} clearfix'>";
		
		if($itemtag != '' && $captiontag != '') {
			$i = 0;
			foreach ( $attachments as $id => $attachment ) {
				$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, false, false);
				
				$output .= "<{$itemtag} class='gallery-item'>";
				$output .= "$link";
				
				if ( $captiontag && trim($attachment->post_excerpt) ) {
					$output .= "
					<{$captiontag} class='gallery-caption'>
					" . wptexturize($attachment->post_excerpt) . "
					</{$captiontag}>";
				}
				$output .= "</{$itemtag}>";
			
			}
		}
		
		$output .= "</div>\n";
		return $output;
	}
}


// Enqueue colorbox script and css only if [gallery] shortcode is ebabled in the editor
function enqueue_gallery_files(){
   global $post;
   if( !$post ) return;
   $matches = array();
   $pattern = get_shortcode_regex();
   preg_match_all( '/' . $pattern . '/s', $post->post_content, $matches );
   foreach( $matches[2] as $value ) {
	   if( $value == 'gallery' ) {
		   wp_enqueue_script( 'imgLiquid', get_template_directory_uri() . '/js/imgLiquid-min.js', 'jquery', '0.9', true );
		   wp_enqueue_script( 'swipebox', get_template_directory_uri() . '/js/jquery.swipebox.min.js', 'jquery', '1.0', true );
		   break;
	   }
   }
}
add_action( 'wp_enqueue_scripts', 'enqueue_gallery_files' );