<?php
/*
 * Plugin Name: Featured Posts Widget
 * Plugin URI: http://www.themesindep.com
 * Description: A widget that show latest posts
 * Version: 1.0
 * Author: ThemesIndep
 * Author URI: http://www.themesindep.com
 */

class TI_Featured_Posts extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'ti_featured_posts', // Base ID
			__( 'TI Featured Posts', 'themetext' ), // Name
			array( 'description' => __( 'Show featured posts, defined in post edit page', 'themetext' ), ) // Args
		);
		
	}

	
	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {
				
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$items_num = $instance['items_num'];
		
		echo $before_widget;
			
			
			if ( $title ) echo $before_title . $title . $after_title;
            ?>
            
            <?php
			/** 
			 * Latest Posts
			**/
			global $post;
			$ti_featured_posts = new WP_Query(
				array(
					'post_type' => 'post',
					'meta_key' => 'featured_post_add',
            		'meta_value' => '1',
					'posts_per_page' => $items_num
				)
			);
			?>
			<div class="flexslider">
            
				<ul class="slides">
				<?php while ( $ti_featured_posts->have_posts() ) : $ti_featured_posts->the_post(); ?>
				
					<li <?php post_class(); ?>>
                                                       
                        <figure class="entry-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php 
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'medium-size' );
                                } else { ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/default-image.png" alt="<?php the_title(); ?>" />
                                <?php } ?>
                            </a>
                        </figure>
						
						<h2 class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						
					</li>
					
				<?php endwhile; ?>
				</ul>
                
			</div>
			
			<?php wp_reset_query(); ?>

	    <?php 
		echo $after_widget;
		
	}
	
	
	/**
	 * Sanitize widget form values as they are saved
	**/
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();

		/* Strip tags to remove HTML. For text inputs and textarea. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items_num'] = strip_tags( $new_instance['items_num'] );
		
		return $instance;
		
	}
	
	
	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {
		
		/* Default widget settings. */
		$defaults = array(
			'title' => 'Featured Posts',
			'items_num' => '3',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'themeText'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'items_num' ); ?>"><?php _e('Maximum posts to show:', 'themetext'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'items_num' ); ?>" name="<?php echo $this->get_field_name( 'items_num' ); ?>" value="<?php echo $instance['items_num']; ?>" size="1" />
		</p>
	<?php
	}

}
register_widget( 'TI_Featured_Posts' );