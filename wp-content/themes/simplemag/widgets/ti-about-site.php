<?php
/*
 * Plugin Name: About The Site Widget
 * Plugin URI: http://www.themesindep.com
 * Description: A widget that show latest posts
 * Version: 1.0
 * Author: ThemesIndep
 * Author URI: http://www.themesindep.com
 */
 
/**
 * Register the Widget
 */
class TI_About_Site extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'ti-about-site', // Base ID
			__( 'TI About The Site', 'themetext' ), // Name
			array( 'description' => __( 'Display info about your magazine. Such as logo, text & social profile links', 'themetext' ), ) // Args
		);
		
	}

	function ti_sp_array( $instance = array() ) {

		return array(
			'rssurl' => array(
				'title' => __('RSS URL', 'themetext'),
				'class' => __('feed', 'themetext'),
			),
			'twitter' => array(
				'title' => __('Twitter', 'themetext'),
				'class' => __('twitter', 'themetext'),
			),
			'facebook' => array(
				'title' => __('Facebook', 'themetext'),
				'class' => __('facebook', 'themetext'),
			),
			'google' => array(
				'title' => __('Google+', 'themetext'),
				'class' => __('google-plus', 'themetext'),
			),
			'linkedin' => array(
				'title' => __('LinkedIn', 'themetext'),
				'class' => __('linkedin', 'themetext'),
			),
			'instagram' => array(
				'title' => __('Instagram', 'themetext'),
				'class' => __('instagram', 'themetext'),
			),
			'pinterest' => array(
				'title' => __('Pinterest', 'themetext'),
				'class' => __('pinterest', 'themetext'),
			),
			'vimeo' => array(
				'title' => __('Vimeo', 'themetext'),
				'class' => __('vimeo', 'themetext'),
			),
			'youtube' => array(
				'title' => __('YouTube', 'themetext'),
				'class' => __('youtube', 'themetext'),
			),
			'flickr' => array(
				'title' => __('Flickr', 'themetext'),
				'class' => __('flickr', 'themetext'),
			),
			'behance' => array(
				'title' => __('Behance', 'themetext'),
				'class' => __('behance', 'themetext'),
			),
			'soundcloud' => array(
				'title' => __('Sound Cloud', 'themetext'),
				'class' => __('soundcloud', 'themetext'),
			),
			'dribble' => array(
				'title' => __('Dribble', 'themetext'),
				'class' => __('dribbble', 'themetext'),
			),
		);
	}
	

	public function widget($args, $instance) {

		extract($args);

		$title = apply_filters('widget_title', $instance['title'] );
		$new_window = isset( $instance['new_window'] ) ? 'target="_blank"' : false;
		$logo_url = $instance['logo_url'];
		$free_text = $instance['free_text'];

		echo $before_widget;
		

			if ( $title ) echo $before_title . $title . $after_title;
			
			// Display the Logo
			if ( !empty ( $instance['logo_url'] ) ) {
				printf( '<img src="%s" alt="%s" />', esc_url( $instance['logo_url'] ), get_bloginfo( 'name' ) );
			}
			
			// Text about the site
			if ( !empty ( $instance['free_text'] ) ) {
				printf( '<p>%s</p>', esc_attr( $instance['free_text'] ) );
			}
			
			// Display the social links
			echo '<ul class="social clearfix">';
			foreach ( $this->ti_sp_array( $instance ) as $key => $data ) {
				if ( !empty ( $instance[$key] ) ) {
					printf( '<li><a href="%s" aria-hidden="true" class="icon-%s" %s></a></li>', esc_url( $instance[$key] ), esc_attr( $data['class'] ), $new_window );
				}
			}
			echo '</ul>';
			

		echo $after_widget;

	}
	

	public function update($new_instance, $old_instance) {
		return $new_instance;
	}
	

	public function form($instance) {
		
		/* Default widget settings. */
		$defaults = array(
			'title' => 'About The Site',
			'logo_url' => '',
			'free_text' => '',
			'rssurl' => '',
			'twitter' => '',
			'facebook' => '',
			'google' => '',
			'linkedin' => '',
			'instagram' => '',
			'pinterest' => '',
			'vimeo' => '',
			'youtube' => '',
			'flickr' => '',
			'behance' => '',
			'soundcloud' => '',
			'dribble' => '',
			'new_window' => false,
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		
	?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'themetext'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
        <p>
        	<label for="<?php echo $this->get_field_id('logo_url'); ?>"><?php _e('Logo URL', 'themetext'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('logo_url'); ?>" name="<?php echo $this->get_field_name('logo_url'); ?>" value="<?php echo $instance['logo_url']; ?>" class="widefat" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id('free_text'); ?>"><?php _e('Short text about the site', 'themetext'); ?>:</label>
			<textarea id="<?php echo $this->get_field_id('free_text'); ?>" name="<?php echo $this->get_field_name('free_text'); ?>" class="widefat" ><?php echo $instance['free_text']; ?></textarea>
        </p>
        <p>
        	<input type="checkbox" id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" <?php if( $instance['new_window'] == true ) echo 'checked'; ?> /> 
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>"><?php _e('Open social links in new window', 'themetext'); ?></label>
        </p>
		
		<?php foreach ( $this->ti_sp_array( $instance ) as $key => $data ) { ?>
		<p>
			<label for="<?php echo $this->get_field_id($key); ?>"><?php echo $data['title']; ?></label>
			<input type="text" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" value="<?php echo esc_url($instance[$key]); ?>" class="widefat" />
		</p>
        <?php }
		
	}
}
register_widget( 'TI_About_Site' );