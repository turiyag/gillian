<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'themetext') ?></p>
<?php
	return;
}
?>


<?php

	/* Display the comments */
	if ( have_comments() ) : ?>
	
		<a name="comments"></a>
		<div class="single-box comments">
			<h3 class="entry-title">
				<?php comments_number(__('No Comments', 'themetext'), __('1 Comment', 'themetext'), __( '% Comments', 'themetext') )?>
			</h3>
			<ul class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'comment_item' ) ); // List Comments ?>
			</ul>
            <div class="comments-nav clearfix">
				<span class="alignleft"><?php previous_comments_link(); ?></span>
                <span class="alignright"><?php next_comments_link(); ?></span>
            </div>
		</div>

 	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ( !comments_open() ) : // comments are closed ?>
			<p class="message warning"><i class="icon-warning-sign"></i><?php _e('Comments are closed.', 'themetext'); ?></p>
		<?php endif; ?>
	
	<?php endif; ?>


<?php

	/* Comment Form */
	if ( comments_open() ) : ?>

		<div id="respond" class="single-box">
		
            <h3 class="entry-title">
            
				<?php if (get_option('comment_registration') && !$user_ID) : ?>
					<?php _e('You must be', 'themetext'); ?> 
                    <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'themetext'); ?></a>
                    <?php _e('to post a comment', 'themetext'); ?>
                <?php else : ?>

                <?php if ( !have_comments() ) : ?>
					<?php _e('Be first to comment', 'themetext'); ?>
                <?php else : ?>
                	<?php _e('Leave a Reply', 'themetext'); ?>
                <?php endif; ?>
                
                <span class="cancel_reply">
                    <?php cancel_comment_reply_link(); ?>
                </span>
            
            </h3>
			
            <?php
				$args = array(
					'title_reply' => '',
					'logged_in_as' => '<p class="logged-in-as message info">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( get_permalink() ) ) . '</p>',
					'comment_notes_before' => '',
					'comment_notes_after' => ''
				);
				comment_form( $args ); 
			?>
		
			<?php endif; // If registration required and not logged in ?>
			
		</div>
	<?php endif; ?>