<?php 
/**
 * Featured Posts
 * Page Composer Section
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
global $ti_option;
?>


<section class="home-section latest-reviews">
            		
	<?php if( get_sub_field( 'reviews_main_title' ) ): ?>
    <header class="section-header">
        <h2 class="title"><span><?php the_sub_field( 'reviews_main_title' ); ?></span></h2>
        <?php if( get_sub_field( 'reviews_sub_title' ) ): ?>
        <span class="sub-title"><?php the_sub_field( 'reviews_sub_title' ); ?></span>
        <?php endif; ?>
    </header>
    <?php endif; ?>
    
    
    <?php
    /** 
     * Posts with reviews.
	 * Display posts only if Rating is enabled
    **/
	$posts_to_show = get_sub_field( 'reviews_posts_per_page' );
	$paged = 1;
	if ( get_query_var('paged') ) $paged = get_query_var('paged');
	if ( get_query_var('page') ) $paged = get_query_var('page');
	
	$wp_query = new WP_Query(
        array(
            'post_type' => 'post',
            'meta_key' => 'enable_rating',
            'meta_value' => '1',
            'posts_per_page' => $posts_to_show,
			'paged' => $paged
        )
    );
    
    if ( $wp_query->have_posts() ) :
		
	?> 
    
        <div class="grids masonry-layout entries">
    
            <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
        
        		<?php 	
					// Loop through the scores 
					// get the scores summ
					// devide the summ of all scores by scores count
					$score_rows = get_field( 'rating_module' );
					$score = array();
					
					if ( $score_rows ){
						foreach( $score_rows as $key => $row ){
							$score[$key] = $row['score_number'];
						}
					}
					
					$score_items = count( $score ); 
					$score_sum = array_sum( $score );
					$score_total = $score_sum / $score_items; 
				?>
                
                <article <?php post_class("grid-4 score-box"); ?>>
                
                    <figure class="entry-image">
                    
                        <a href="<?php the_permalink(); ?>">
                            <?php 
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'medium-size' );
                            } else { ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/default-image.png" alt="<?php the_title(); ?>" />
                            <?php } ?>
                        </a>
                        
                        <div class="score-line" style="width:<?php echo number_format( $score_total, 1, '', '' ); ?>%;">
                            <span><i><?php echo number_format( $score_total, 1, '.', '' ); ?></i></span>
                        </div>
                        
                    </figure>
                    
                    <header class="entry-header">
                        <div class="entry-meta">
                           <span class="entry-category"><?php the_category(', '); ?></span>
                           <span><?php the_time('F j, Y'); ?></span>
                        </div>
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                    </header>
                    
                    <?php if ( get_sub_field( 'reviews_excerpt' ) == 'enable' ) { ?>
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>
                    <?php } ?>
                        
                </article>
            
            <?php endwhile; ?>
            
         </div> 
       
		<?php 
		if ( get_sub_field ( 'reviews_pagination' ) == 'pagination_on' ){ // Enable/Disable the pagination
        	ti_pagination();
        } ?>
        
    <?php else: ?>
        
        <div class="grids entries">
        	<p class="grid-12 message">
        		<?php _e( 'There are no reviews yet', 'themetext' ); ?>
            </p>
        </div>
        
    <?php endif; ?>
    
    <?php wp_reset_query(); ?>

</section><!-- Featured Posts -->