<?php 
/**
 * Featured Posts
 * Page Composer Section
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
?>


<section class="home-section featured-posts">
            		
	<?php if( get_sub_field( 'featured_main_title' ) ): ?>
    <header class="section-header">
        <h2 class="title"><span><?php the_sub_field( 'featured_main_title' ); ?></span></h2>
        <?php if( get_sub_field( 'featured_sub_title' ) ): ?>
        <span class="sub-title"><?php the_sub_field( 'featured_sub_title' ); ?></span>
        <?php endif; ?>
    </header>
    <?php endif; ?>
    
    <?php
    /** 
     * Add posts to this section only if the 'Make Featured'
     * custom field checkbox was checked on the Post edit page
    **/
    $ti_featured_posts = new WP_Query(
        array(
            'post_type' => 'post',
            'meta_key' => 'featured_post_add',
            'meta_value' => '1',
            'posts_per_page' => 3
        )
    );
    ?>
    <div class="grids entries">

		<?php 
		if ( $ti_featured_posts->have_posts() ) :
		while ( $ti_featured_posts->have_posts() ) : $ti_featured_posts->the_post(); ?>
    
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
            </figure>
            
            <header class="entry-header">
                <div class="entry-meta">
                   <span class="entry-category"><?php the_category(', '); ?></span>
                   <span class="entry-date"><?php the_time('F j, Y'); ?></span>
                </div>
                <h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
            </header>
            
            <?php if( get_sub_field( 'featured_excerpt' ) == 'enable' ) { ?>
            <div class="entry-summary">
				<?php the_excerpt(); ?>
            </div>
            <?php } ?>
                
        </article>
        
    	<?php endwhile; ?>
        
        <?php else: ?>
        
        	<p class="grid-12 message">
            	<?php _e( 'There are no featured posts yet', 'themetext' ); ?>
            </p>
            
        <?php endif; ?>

    </div>
    
    <?php wp_reset_query(); ?>

</section><!-- Featured Posts -->