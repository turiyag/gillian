<?php 
/**
 * Author Box for single.php and author.php
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 
?>

<div id="author-box" class="single-box">
    <div class="clearfix inner">
    
        <div class="avatar">
            <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta( 'email' ), '96' ); } ?>
        </div><!-- .avatar -->
        
        
        <div class="author-info">
        
            <h2>
            	<?php if( is_single() ){ ?>
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                    <?php printf( __( '%s', 'themetext' ), get_the_author() ); ?>
                </a>
                <?php } else{
                	printf( __( '%s', 'themetext' ), get_the_author() );
                } ?>
            </h2>
            <p><?php the_author_meta( 'description' ); ?></p>
        
        </div><!-- .info -->
        
        
        <ul class="author-social">
        	
            <?php if ( get_the_author_meta( 'user_url' ) != '' ) { ?>
                <li>
                    <a class="user-url" href="<?php echo wp_kses( get_the_author_meta( 'user_url' ), null ); ?>">
                        <?php printf( esc_attr__( 'Website', 'themetext'), get_the_author() ); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if ( get_the_author_meta( 'sptwitter' ) != '' ) { ?>
                <li>
                    <a class="twitter-link" href="https://twitter.com/<?php echo wp_kses( get_the_author_meta( 'sptwitter' ), null ); ?>">
                        <?php printf( esc_attr__( 'Twitter', 'themetext'), get_the_author() ); ?>
                    </a>
                </li>
            <?php } ?>
    
            <?php if ( get_the_author_meta( 'spfacebook' ) != '' ) { ?>
                <li>
                    <a class="facebook-link" href="http://facebook.com/<?php echo wp_kses( get_the_author_meta( 'spfacebook' ), null ); ?>">
                        <?php printf( esc_attr__( 'Facebook', 'themetext'), get_the_author() ); ?>
                    </a>
                </li>
            <?php } ?>
            
            <?php if ( get_the_author_meta( 'spgoogle' ) != '' ) { ?>
                <li>
                    <a class="google-link" href="http://plus.google.com/<?php echo wp_kses( get_the_author_meta( 'spgoogle' ), null ); ?>">
                        <?php printf( esc_attr__( 'Google+', 'themetext'), get_the_author() ); ?>
                    </a>
                </li>
            <?php } ?>
    
            <?php if ( get_the_author_meta( 'sppinterest' ) != '' ) { ?>
                <li>
                    <a class="pinterest-link" href="http://pinterest.com/<?php echo wp_kses( get_the_author_meta( 'sppinterest' ), null ); ?>">
                        <?php printf( esc_attr__( 'Pinterest', 'themetext'), get_the_author() ); ?>
                    </a>
                 </li>
            <?php } ?>
    
        </ul>
     
    </div>  
</div><!-- #author-box -->