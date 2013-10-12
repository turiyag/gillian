<?php 
/**
 * Homepage Slider
 * Page Composer Section
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
?>


<?php
/** 
 * Add posts to slider only if the 'Add To Slider' 
 * custom field checkbox was checked on the Post edit page
**/
$slides_num = get_sub_field( 'slides_to_show' );

$ti_posts_slider = new WP_Query(
	array(
		'post_type' => 'post',
		'meta_key' => 'homepage_slider_add',
		'meta_value' => '1',
		'posts_per_page' => $slides_num
	)
);
?>

<section>
	
    <?php if ( $ti_posts_slider->have_posts() ) : ?>
    
        <div class="flexslider posts-slider loading">
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
            
            </ul>
        </div>
    
    <?php else: ?>
        
        <div class="grids entries">
            <p class="grid-12 message">
                <?php _e( 'Sorrry, there are no posts to the slider', 'themetext' ); ?>
            </p>
        </div>
         
    <?php endif; ?>
	
	<?php wp_reset_query(); ?>

</section><!-- Slider -->