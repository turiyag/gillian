<?php 
/**
 * 404 error page
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/ 
?>

<?php get_header(); ?>
	
    <section id="content" role="main" class="clearfix animated">
    
    	<div class="wrapper">
    
            <article id="post-0" class="post error404 not-found">
            
            	<?php if( $ti_option['error_image'] !='' ){ ?>
                    <img src="<?php echo $ti_option['error_image']; ?>" alt="<?php echo $ti_option['error_text']; ?>" width="400" height="400" />
                <?php } ?>
                <h1><?php echo $ti_option['error_title']; ?></h1>
                
            </article><!-- #post-0 .post .error404 .not-found -->
        
    	</div>
        
    </section><!-- #content -->
	
<?php get_footer(); ?>