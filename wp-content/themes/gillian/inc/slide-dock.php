<?php 
/**
 * Random Posts slide dock. Appears in single.php
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
global $ti_option;
?>

<div class="widget slide-dock">

    <a class="close-dock" href="#" title="Close"><i class="icon-remove-sign"></i></a>
    <h3><?php echo $ti_option['single_slide_dock_title']; ?></h3>
    
    <div class="entries">
    <?php
        $ti_random_post = new WP_Query(
            array(
                'post_type' => 'post',
                'post__not_in' => array( $post->ID ),
                'orderby' => 'rand',
                'posts_per_page' => 1
            )
        );
        
        while ( $ti_random_post->have_posts() ) : $ti_random_post->the_post(); ?>
        
        <article>
        	<figure class="entry-image">
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <?php the_post_thumbnail( 'medium-size' );
                    } else { ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/default-image.png" alt="<?php the_title(); ?>" />
                    <?php } ?>
                </a>
            </figure>
            
            <h4 class="entry-title">
            	<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
                </a>
            </h4>
            
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div>
        </article>
        
    <?php endwhile; ?>
    </div>
    
<?php wp_reset_query(); ?>
</div><!-- .slide-dock -->