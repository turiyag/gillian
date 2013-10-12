<?php
/**
 * Comment item template
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
**/

function comment_item( $comment, $args, $depth ) {
$GLOBALS['comment'] = $comment; ?>

<li id="comment-<?php comment_ID(); ?>" class="<?php if( get_the_author() == get_comment_author() ){ echo 'bypostauthor '; } ?>clearfix">
	
    <figure>
    	<?php echo get_avatar( $comment, 48 ); ?>
    </figure>

    <div class="vcard clearfix">
    	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        <span class="datetime"><?php comment_date('F j, Y'); ?></span>
        <h4 class="comment-author">
			<?php comment_author_link(); ?>
        	<?php edit_comment_link('<i class="icon-pencil"></i>','',''); ?>
        </h4>
    </div>
    
	<div class="comment-text">
		<?php if ($comment->comment_approved == '0') : ?>
			<p class="message info"><i class="icon-info-sign"></i><?php _e( 'Your comment is awaiting moderation.', 'themetext' ); ?></p>
		<?php endif; ?>
		<?php comment_text(); ?>
	</div>

</li>

<?php } ?>