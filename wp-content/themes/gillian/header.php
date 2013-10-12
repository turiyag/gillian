<?php
/**
 * The Header for the theme
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
global $ti_option; // Fetch options stored in $ti_option;
?><!DOCTYPE html>
<!--[if lt IE 9]><html <?php language_attributes(); ?> class="oldie"><![endif]-->
<!--[if !(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php
	if( ! is_home() ):
	  wp_title( '|', true, 'right' );
	endif;
	bloginfo( 'name' );
  ?></title>

<!-- Meta Viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php 
// Get the favicon
if ( $ti_option['site_favicon'] != '' ) { 
	$site_favicon = $ti_option['site_favicon'];
} else { 
	$site_favicon = get_template_directory_uri() . '/images/favicon.ico';
}
?>
<link rel="shortcut icon" href="<?php echo $site_favicon; ?>" />
<?php 
// Get the retina favicon
if ( $ti_option['site_retina_favicon'] != '' ) { 
	$retina_favicon = $ti_option['site_retina_favicon'];
} else { 
	$retina_favicon = get_template_directory_uri() . '/images/retina-favicon.png';
}
?>
<link rel="apple-touch-icon-precomposed" href="<?php echo $retina_favicon; ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="outer-wrap">
    <div id="inner-wrap">

    <div id="pageslide">
        <a id="close-pageslide" href="#top"><i class="icon-remove-sign"></i></a>
    </div><!-- Sidebar in Mobile View -->

    <header id="masthead" role="banner" class="clearfix">
            
        <div class="top-strip">
            <div class="wrapper clearfix">
            
                <?php get_search_form(); ?>
                
                <a id="open-pageslide" href="#pageslide"><i class="icon-menu"></i></a>
                
                <?php
                // Pages Menu
				if ( has_nav_menu( 'secondary_menu' ) ) :
					wp_nav_menu( array (
						'theme_location' => 'secondary_menu',
						'container' => 'nav',
						'container_class' => 'secondary-menu',
						'menu_id' => 'secondary-nav',
						'depth' => 2,
						'fallback_cb' => false
					 ));
				 else:
					echo '<div class="alignleft no-margin message warning"><i class="icon-warning-sign"></i>' . __( 'Define your site secondary menu', 'themetext' ) . '</div>';
				 endif;
                ?>
            </div><!-- .wrapper -->
        </div><!-- .top-strip -->
            
        <div class="wrapper">
        
            <div id="branding" class="animated">
                <!-- Logo -->
				<?php 
                // Get the logo
                if ( $ti_option['site_logo'] != '' ) { 
                    $site_logo = $ti_option['site_logo'];
                } else { 
                    $site_logo = get_template_directory_uri() . '/images/logo.png';
                }
                ?>
                <a class="logo" href="<?php echo home_url( '/' ); ?>">
                    <img src="<?php echo $site_logo; ?>" alt="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>" />
                </a>
                <!-- End Logo -->
                
                <?php 
                // Show or Hide site tagline under the logo based on Theme Options
                if( $ti_option['site_tagline'] == 1 ) {
                ?>
                <span class="tagline">
                    <?php bloginfo( 'description' ); ?>
                </span>
                <?php } ?>
            </div>
            
            <?php
            // Main Menu
			if ( has_nav_menu( 'main_menu' ) ) :
				wp_nav_menu( array (
					'theme_location' => 'main_menu',
					'container' => 'nav',
					'container_class' => 'animated main-menu',
					'menu_id' => 'main-nav',
					'depth' => 2,
					'fallback_cb' => false,
					'walker' => new TI_Menu()
				 ));
			 else:
			 	echo '<div class="message warning"><i class="icon-warning-sign"></i>' . __( 'Define your site main menu', 'themetext' ) . '</div>';
			 endif;
            ?>
    
        </div><!-- .wrapper -->     
    </header><!-- #masthead -->