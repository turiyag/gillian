<?php
/*
 * Plugin Name: Latest Reviews Widget
 * Plugin URI: http://www.themesindep.com
 * Description: A widget that show latest posts with reviews
 * Version: 1.0
 * Author: ThemesIndep
 * Author URI: http://www.themesindep.com
 */

class TI_Latest_Reviews extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'ti_latest_reviews', // Base ID
			__( 'TI Latest Reviews', 'themetext' ), // Name
			array( 'description' => __( 'Display the latest posts with reviews', 'themetext' ), ) // Args
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
			 * Latest Reviews
			**/
			global $post;
			$ti_latest_reviews = new WP_Query(
				array(
					'post_type' => 'post',
					'meta_key' => 'enable_rating',
					'meta_value' => 1,
					'posts_per_page' => $items_num,
				)
			);
			?>
            
            <ul class="score-box">
            <?php while ( $ti_latest_reviews->have_posts() ) : $ti_latest_reviews->the_post(); ?>
                
                <?php
					// Loop through the scores 
					// get the scores summ
					// devide the summ of all scores by scores count
					$score_rows = get_field( 'rating_module' );
					$score = array();
					
					if ($score_rows){
						foreach( $score_rows as $key => $row ){
							$score[$key] = $row['score_number'];
						}
					}
					
					$score_items = count( $score ); 
					$score_sum = array_sum( $score );
					$score_total = $score_sum / $score_items;
				?>
                
                <li class="clearfix">

                    <span class="total">
                        <?php echo number_format( $score_total, 1, '.', '' ); ?>
                    </span>
                    
                    <h4 class="entry-meta">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( strlen( $post->post_title ) > 25 ) { echo substr( the_title( $before = '', $after = '', FALSE ), 0, 25 ) . '...'; } else { the_title(); } ?>
                        </a>
                    </h4>
                    
                    <div class="score-outer">
                    	<div class="score-line" style="width:<?php echo number_format( $score_total, 1, '', '' ); ?>%;"><span></span></div>
                    </div>
                    
                </li>
               
            <?php endwhile; ?>
            </ul>

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
			'title' => 'Latest Reviews',
			'items_num' => '5',
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
register_widget( 'TI_Latest_Reviews' );