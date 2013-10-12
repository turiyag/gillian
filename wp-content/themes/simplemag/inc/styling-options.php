<?php
/**
 * Theme Styling Options
 * Refer to Theme Options
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/
function custom_styling() { 
global $ti_option;
?>
<style>
/* Theme Options Styling */
body {font-family:'<?php echo $ti_option['font_text']; ?>', Arial, Verdana, 'Helvetica Neue', Helvetica, sans-serif;}
h1, h2, h3, h4, h5, h6, .tagline, .sub-title, .menu a, .widget_pages, .widget_categories, .entry-meta, .entry-note, .read-more, #submit, .single .entry-content p:first-child:first-letter, input#s, .widget_ti-about-site p, .comments .vcard, #respond label, .copyright, #wp-calendar tbody, .latest-reviews i, .score-box .total {font-family: '<?php echo $ti_option['font_titles']; ?>', Arial, Verdana, 'Helvetica Neue', Helvetica, sans-serif; font-weight:400;}
<?php $main_site_color = $ti_option['main_site_color']; ?>
.sub-menu ul li a:hover, .secondary-menu a:hover, .secondary-menu .current_page_item > a, .top-strip nav > ul > li:hover > a, .footer-sidebar .widget h3, .footer-sidebar .tweetList li i {color:<?php echo $main_site_color ?> !important;}
#masthead .main-menu > ul > li.sub-hover > a:after{border-color:transparent transparent <?php echo $main_site_color ?>;}
#masthead .main-menu > ul > li{font-size:<?php echo $ti_option['main_menu_links']; ?>;}
#masthead .main-menu .sub-menu{border-top-color:<?php echo $main_site_color ?>;}
.widget_ti_most_commented span i:after{border-top-color:<?php echo $main_site_color ?>;border-left-color:<?php echo $main_site_color ?>;}
<?php if( $ti_option['single_slide_dock_style'] == 1 ) {?>.slide-dock, <?php } ?>.entry-image, .page-numbers .current, .link-pages span, .score-line span, .widget_ti_most_commented span {background-color:<?php echo $main_site_color ?>;}
::selection {background-color:<?php echo $main_site_color ?>;}
::-moz-selection {background-color:<?php echo $main_site_color ?>;}
<?php if ( $ti_option['custom_css'] != '' ) { ?>
/* Custom CSS */
<?php echo $ti_option['custom_css']; ?>
<?php } ?>
</style>
<?php } ?>
<?php add_action( 'wp_head', 'custom_styling' ); ?>