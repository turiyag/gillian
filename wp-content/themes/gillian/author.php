<?php 
/**
 * Author template. Display the author 
 * info and all posts by the author
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 
?>

<?php get_header(); ?>
		
	<section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">
    		
            <?php 
			if ( have_posts() ) :
			
			get_template_part( 'inc/author', 'box' ); 
			?>
            
            <div class="grids masonry-layout entries">
                <?php 
                 
                    while ( have_posts() ) : the_post();
                
                        get_template_part( 'content', 'post' );
            
                    endwhile; 
               
                ?>
            </div>
            
            <?php else: ?>
            
                    <p class="message"><?php _e('This author has no posts yet', 'themetext' ); ?></p>

    		<?php endif; ?>
            
    	</div>
    </section>
		

<?php get_footer(); ?>