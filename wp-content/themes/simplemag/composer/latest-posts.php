<?php 
/**
 * Latest Posts
 * Page Composer Section
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
?>

<section class="home-section latest-posts">
            		
	<?php if( get_sub_field( 'latest_main_title' ) ): ?>
    <header class="section-header">
        <h2 class="title"><span><?php the_sub_field( 'latest_main_title' ); ?></span></h2>
        <?php if ( get_sub_field( 'latest_sub_title' ) ): ?>
        <span class="sub-title"><?php the_sub_field( 'latest_sub_title' ); ?></span>
        <?php endif; ?>
    </header>
    <?php endif; ?>
    
    
    <?php
    /** 
     * Latest Posts with paging
    **/
	$posts_to_show = get_sub_field( 'latest_posts_per_page' );
	$paged = 1;
	if ( get_query_var('paged') ) $paged = get_query_var('paged');
	if ( get_query_var('page') ) $paged = get_query_var('page');
	$wp_query = new WP_Query(
		array(
			'post_type' => 'post',
			'posts_per_page' => $posts_to_show,
			'paged' => $paged
		)
	);
    ?>

	<?php 
	// Enable/Disable sidebar based on the field selection         
    if ( get_sub_field ( 'latest_posts_sidebar' ) == 'sidebar_on'  &&  is_active_sidebar( 'sidebar-1' )) {
	?>

    <div class="grids">
    
        <div class="grid-8 column">
        
            <div class="grids masonry-layout entries">
                
                <?php
				if ( $wp_query->have_posts() ) :
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                
                    get_template_part( 'content', 'post' );
                    
                endwhile; 
                ?>
                
             </div>
             
             <?php if ( get_sub_field ( 'latest_pagination' ) == 'pagination_on' ){ ?>
             <div class="pagination">
                <?php ti_pagination(); ?>
             </div>
             <?php } ?>
            
             <?php else: ?>
             
                <p class="grid-12 message">
                	<?php _e( 'Sorry, no posts were found', 'themetext' ); ?>
                </p>
                
             <?php endif; ?>
                    
             
         </div>
     	
		<?php wp_reset_query(); ?>
        
        <div class="grid-4 column">
        	<?php get_sidebar(); ?>
        </div>
        
	</div>
    
    <?php } else { ?>

        <div class="grids masonry-layout entries"> 
        
            <?php 
			if ( $wp_query->have_posts() ) :
            while ( $wp_query->have_posts() ) : $wp_query->the_post();
            
                get_template_part( 'content', 'post' );
                
            endwhile; 
            ?>
         </div>  
          
         <?php if ( get_sub_field ( 'latest_pagination' ) == 'pagination_on' ) { ?>
         <div class="pagination">
            <?php ti_pagination(); ?>
         </div>
         <?php } ?>
               
		 <?php else: ?>
         
            <p class="grid-12 message">
            	<?php _e( 'Sorry, no posts were found', 'themetext' ); ?>
            </p>
            
         <?php endif; ?>
            
		<?php wp_reset_query(); ?>
    
    <?php } ?>
    
</section><!-- Latest Posts -->