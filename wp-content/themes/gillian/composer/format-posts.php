<?php 
/**
 * Latest Posts by Format
 * Page Composer Section
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
?>

<section class="home-section format-posts">

    <?php if( get_sub_field( 'format_main_title' ) ): ?>
    <header class="section-header">
        <h2 class="title"><span><?php the_sub_field( 'format_main_title' ); ?></span></h2>
        <?php if ( get_sub_field( 'format_sub_title' ) ): ?>
        <span class="sub-title"><?php the_sub_field( 'format_sub_title' ); ?></span>
        <?php endif; ?>
    </header>
    <?php endif; ?>
    
    
    
    
	<?php
	/**
	 * Get the format name which will filter the section
	 * Check if format is standard or something else
	**/
	$format_name = get_sub_field( 'format_section_name' );
	
	if ( get_sub_field( 'format_section_name' ) == 'standard' ):
		$format_args = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' =>  array( 'post-format-video', 'post-format-gallery', 'post-format-audio' ),
				'operator' => 'NOT IN'
			);
	else:
		$format_args = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => 'post-format-'.$format_name
			);
	endif;
	
	$posts_to_show = get_sub_field( 'format_posts_per_page' );
	
	$paged = 1;
	if ( get_query_var('paged') ) $paged = get_query_var('paged');
	if ( get_query_var('page') ) $paged = get_query_var('page');
	
	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $posts_to_show,
			'paged' => $paged,
			'tax_query' => array( $format_args )
		)
	);
	
	if ( $wp_query->have_posts() ) : 
	?>
            
        <div class="grids masonry-layout entries">
        
            <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
        
                <article <?php post_class("grid-4"); ?>>
                
                    <figure class="entry-image">
                    
                        <a href="<?php the_permalink(); ?>">
                            <?php 
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'medium-size' );
                            } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/default-image.png" alt="<?php the_title(); ?>" />
                            <?php } ?>
                        </a>
                        
                        <?php
                        // Add icon to different post formats
                        if ( 'gallery' == get_post_format() ): // Gallery
                            echo '<i class="icon-camera-retro"></i>';
                        elseif ( 'video' == get_post_format() ): // Video
                            echo '<i class="icon-camera"></i>';
                        elseif ( 'audio' == get_post_format() ): // Audio
                            echo '<i class="icon-music"></i>';
                        endif;
                        ?>
                        
                    </figure>
                    
                    <header class="entry-header">
                        <div class="entry-meta">
                           <span class="entry-date"><?php the_time('F j, Y'); ?></span>
                        </div>
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                    </header>
                    
                    <?php if ( get_sub_field( 'format_excerpt' ) == 'enable' ) { ?>
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>
                    <?php } ?>
                    
                </article>
            
            <?php endwhile; ?>
    
        </div>
        
        <?php if ( get_sub_field ( 'format_pagination' ) == 'pagination_on' ){ // Enable/Disable the pagination ?>
         <div class="pagination">
            <?php ti_pagination(); ?>
         </div>
        <?php } ?>
        
    <?php else: ?>
        
        <div class="grids entries">
        	<p class="grid-12 message">
        		<?php _e( 'There are no posts with this format yet', 'themetext' ); ?>
            </p>
        </div>
        
    <?php endif; ?>
    
    <?php wp_reset_query(); ?>

</section><!-- Latest by Format -->