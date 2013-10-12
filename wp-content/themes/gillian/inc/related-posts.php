<?php
/**
 * Relatest Posts from the same Category
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/

global $ti_option; 

$categories = get_the_category( $post->ID );
$first_cat = $categories[0]->cat_ID;

$posts_to_show =  $ti_option['single_related_posts_to_show'];
$args = array(
	'category__in' => array( $first_cat ),
	'post__not_in' => array( $post->ID ),
	'posts_per_page' => $posts_to_show
);

$related_posts = get_posts( $args );
if( $related_posts ) {
?>

	<div class="single-box related-posts">
        <h3 class="entry-title">
            <?php echo $ti_option['single_related_title']; ?>
        </h3>
	
        <div class="grids entries">
        	<div class="carousel">
            
			<?php foreach( $related_posts as $post ): setup_postdata( $post ); ?>
    
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
                         <span class="entry-date"><?php the_time('F j, Y'); ?></span>
                      </div>
                      <h2 class="entry-title">
                          <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                      </h2>
                  </header>
                  
              </article>
        
    		<?php endforeach; ?>
			
            </div>
         </div>
         <a class="prev carousel-nav" href="#"><i class="icon-chevron-right"></i></a>
		 <a class="next carousel-nav" href="#"><i class="icon-chevron-left"></i></a>
         
	</div><!-- .single-box .related-posts -->
    
<?php
} else {
	__( '<p class="grid-12 message">Sorry, this category has just one post and you already here</p>', 'themetext' );
}

wp_reset_postdata();
?>