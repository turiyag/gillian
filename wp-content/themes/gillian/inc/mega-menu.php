<?php
/**
 * Walker class for for dropdown menu with latest posts
 * Add posts if 'latest_posts' field is set to 'Add' 
 * and only for parent category.
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 


/* Start Menu Walker */
class TI_Menu extends Walker_Nav_Menu {
		
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-links\">\n";
    }
	
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
	
    function start_el( &$output, $item, $depth, $args ) {
		
        global $wp_query;
		$cat = $item->object_id;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		if ( ! empty( $children ) || get_field( 'menu_latest_posts', 'category_' . $cat ) == 'latest_posts_on' ) {
			if ( $depth == 0 && $item->object == 'category' || $item->object == 'page' ) {
				$item_output  .= '<div class="sub-menu">';
			}
		}
        $item_output .= $args->after;
		
		
		/* Add Mega menu only for: 
		 * Parent category && For categories
		 */
		if ( $depth == 0 && $item->object == 'category' ) { 
			
			$cat = $item->object_id;
			
			if ( get_field( 'menu_latest_posts', 'category_' . $cat ) == 'latest_posts_on' ){ // Add Posts to menu if 'latest_posts' field is set to 'Add'
				
				$item_output .= '<ul class="sub-posts">';
					
					//$item_output .= '<li class="first"><h3 class="entry-title">' . __( 'Latest Additions', 'themetext' ) . '</h3></li>';
				
					global $post;
					$post_args = array( 'numberposts' => 3, 'offset'=> 0, 'category' => $cat );
					$menuposts = get_posts( $post_args );
					
					foreach( $menuposts as $post ) : setup_postdata( $post );
					
						$post_title = get_the_title();
						$post_link = get_permalink();
						$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "medium-size" );
						
						if ( $post_image ){
							$menu_post_image = '<img src="' . $post_image[0]. '" alt="' . $post_title . '" width="' . $post_image[1]. '" height="' . $post_image[2]. '" />';
						} else {
							$menu_post_image = '<img src="' . get_template_directory_uri() . '/images/default-image.png" alt="' . $post_title . '" />';
						}
						
						$item_output .= '
								<li>
									<figure>
										<a href="'  .$post_link . '">' . $menu_post_image . '</a>
										<figcaption><a href="' . $post_link . '">' . $post_title . '</a></figcaption>
									</figure>
								</li>';
						
					endforeach;
					wp_reset_query();
					
				$item_output .= '</ul>';
				
			}
			
		}
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
	
	
    function end_el( &$output, $item, $depth ) {
		$cat = $item->object_id;
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		if ( ! empty( $children ) || get_field( 'menu_latest_posts', 'category_' . $cat ) == 'latest_posts_on' ) {
			if ( $depth == 0 && $item->object == 'category' || $item->object == 'page' ) {
				$output .= "</div>\n";
			}
		}
		$output .= "</li>\n";
    }
	
}