<?php 
/**
 * The template for displaying all pages
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 
?>

<?php get_header(); ?>
	
	<section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">
        	
            <header class="entry-header">
                <h1 class="entry-title page-title">
					<span><?php wp_title( "", true ); ?></span>
                </h1>
            </header>

			<?php
			// Enable/Disable sidebar based on the field selection
			if ( get_field( 'page_sidebar' ) == 'page_sidebar_on'  &&  is_active_sidebar( 'sidebar-2' )):
			?>
            <div class="grids">
                <div class="grid-8">
            <?php endif; ?>
                
                <?php 
                if (have_posts()) :
                    while (have_posts()) : the_post(); 
                ?>
                
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                        <?php if ( has_post_thumbnail() ) { ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'img_big' ); ?>
                            </a>
                        <?php } ?>
        
                        <div class="page-content">
                        <?php
                        	$page_content = get_the_content();
							if( $page_content != '' ) {
                          		the_content();
							} else {
								echo '<p class="message">' . __('Sorry, no content was found', 'themetext') . '</p>';
							}
							?>
                        </div>
                        
                    </article>
                
                <?php endwhile; endif; ?>
        
				<?php
				// Enable/Disable sidebar based on the field selection
				if ( get_field( 'page_sidebar' ) == 'page_sidebar_on'  &&  is_active_sidebar( 'sidebar-2' )):
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