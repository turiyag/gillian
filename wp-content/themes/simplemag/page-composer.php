<?php 
/**
 * Template Name: Page Composer
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
?>

<?php get_header(); ?>
	
    
    <section id="content" role="main" class="clearfix animated">
    	<div class="wrapper">
        
        <?php 
		
		/* Homepage Builder */ 
		while( has_sub_field( "page_composer" ) ):
		
			
            /* Posts Slider */ 
            if( get_row_layout() == "hp_posts_slider" ):
				
				get_template_part ( 'composer/posts', 'slider' );
				
			
				
			/* Featured Posts */ 
			elseif( get_row_layout() == "hp_featured_posts" ):
				
				get_template_part ( 'composer/featured', 'posts' );



            /* Latest posts by Category */ 
            elseif( get_row_layout() == "latest_by_category" ):
			
				get_template_part ( 'composer/category', 'posts' );
				
			
			
			/* Latest posts by Format */ 
			elseif( get_row_layout() == "latest_by_format" ):
			
				get_template_part ( 'composer/format', 'posts' );
			
			
			
			/* Latest Reviews */ 
			elseif( get_row_layout() == "latest_reviews" ):
			
				get_template_part ( 'composer/latest', 'reviews' );
				

			
			/* Latest Posts */ 
            elseif( get_row_layout() == "latest_posts" ):
				
				get_template_part ( 'composer/latest', 'posts' );
				
			
			endif;
            
			
		endwhile;
		?>
        
		</div>
    </section>
    
<?php get_footer(); ?>