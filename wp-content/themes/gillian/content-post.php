<?php
/**
 * Content
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
?>

<article <?php post_class("grid-4"); ?>>
            	
    <figure class="entry-image">
    
        <a href="<?php the_permalink(); ?>">
            <?php 
            if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'masonry-size' );
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
           <span class="entry-category"><?php the_category(', '); ?></span>
           <span class="entry-date"><?php the_time('F j, Y'); ?></span>
        </div>
        <h2 class="entry-title">
            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
        </h2>
    </header>

    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>
    
</article>