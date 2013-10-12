<?php 
/**
 * Search Results
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 
?>

<?php get_header(); ?>

	<section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">
        
            <header class="entry-header">
				<?php printf( __( '<small>Search Results for:</small><br />', 'themetext' ) ); ?>
                <h1 class="entry-title page-title">
                	<span><?php echo get_search_query(); ?></span>
                </h1>
            </header><!-- .page-header -->
            
            <?php if ( is_active_sidebar( 'sidebar-1' ) ) : // If the sidebar has widgets ?>
            <div class="grids">
                <div class="grid-8">
			<?php endif; ?>

				<?php if (have_posts()) : ?>
                    
                    <div class="entry-list">
                    
					<?php while ( have_posts() ) : the_post(); ?>
                        
                    <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
                    
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

                        <h2>
                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                        </h2>
                        
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink() ?>"><?php _e( 'Read More', 'themetext' ); ?></a>
                        </div>
                        
                    </article>
                    
                    <?php endwhile; ?>
            
					</div>
                    
				<?php else : ?>
            
					<p class="message"><?php _e( 'Sorry, nothing found', 'themetext' ); ?></p>
            
                <?php endif; ?>

    
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : // If the sidebar has widgets ?>
                </div><!-- .grid-8 -->
            
                <div class="grid-4">
                    <?php get_sidebar(); ?>
                </div>
            </div><!-- .grids -->
            <?php endif; ?>
        
    	</div>
    </section>

<?php get_footer(); ?>