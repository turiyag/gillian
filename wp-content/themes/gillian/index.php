<?php
/**
 * The main template file
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
?>

<?php get_header(); ?>
	
    <section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">
		
			<?php	
            $ti_posts_slider = new WP_Query(
                array(
                    'post_type' => 'post',
                    'meta_key' => 'homepage_slider_add',
                    'meta_value' => '1',
                    'posts_per_page' => 7
                )
            );
            ?>
            
            <section class="flexslider posts-slider loading animated">
                
                <ul class="slides">
                
                <?php while ( $ti_posts_slider->have_posts() ) : $ti_posts_slider->the_post(); ?>
                
                    <li>
                    
                        <?php if ( has_post_thumbnail() ) { ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'big-size' ); ?>
                            </a>
                        <?php } else { ?>
                            <img class="alter" src="<?php echo get_template_directory_uri(); ?>/images/pixel.gif" alt="<?php the_title(); ?>" />
                        <?php } ?>
                        
                        <header class="entry-header">
                            <div class="entry-meta">
                               <span class="entry-category"><?php the_category(', '); ?></span>
                               <span class="entry-date"><?php the_time('F j, Y'); ?></span>
                            </div>
                            <h2 class="entry-title">
                                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                            </h2>
                            <a class="read-more" href="<?php the_permalink() ?>"><?php _e( 'Read More', 'themetext' ); ?></a>
                        </header>
                        
                    </li>
                    
                <?php endwhile; ?>
                
                <?php wp_reset_query(); ?>
                
                </ul>
            
            </section><!-- Slider -->
            
			<?php
            // Enable/Disable sidebar based on the field selection
            if ( get_field( 'page_sidebar' ) == 'page_sidebar_on' && is_active_sidebar( 'sidebar-1' )):
            ?>
            <div class="grids">
                <div class="grid-8">
                <?php endif; ?>
                
                    <div class="grids masonry-layout entries">
                    <?php 
                    if ( have_posts() ) :
                    while ( have_posts()) : the_post();
                    
                        get_template_part( 'content', 'post' );
                    
                    endwhile; ?>
                    </div>
                    
                    	<?php ti_pagination(); ?>
                        
                    <?php else : ?>
                    
                    	<p class="grid-12 message"><?php _e( 'Sorry, no posts were found', 'themetext' ); ?></p>
                    
                    <?php endif;?>
                
                <?php
                // Enable/Disable sidebar based on the field selection
                if ( get_field( 'page_sidebar' ) == 'page_sidebar_on' && is_active_sidebar( 'sidebar-1' )):
                ?>
                </div><!-- .grid-8 -->
            
                <div class="grid-4">
                    <?php get_sidebar(); ?>
                </div>
            </div><!-- .grids -->
            <?php endif; ?>
    
		</div>
    </section><!-- #content -->
    
<?php get_footer(); ?>