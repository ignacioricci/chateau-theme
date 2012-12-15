<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<p class="alert">This post is password protected. Enter the password to view comments.</p>
<?php
	return;
}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

<div id="comments">
	<h3><span><?php echo getCommentCount(); ?></span> comments</h3>
	<ol>
		<?php wp_list_comments('callback=chateau_comments&type=comment&avatar_size=20'); ?>
	</ol>
</div>

<?php else : /* this is displayed if there are no comments so far */ ?>

	<?php if ( comments_open() ) : ?>
	<!-- If comments are open, but there are no comments. -->

	<?php else : /* comments are closed */ ?>
	
	 <div id="respond">
	 	<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>
	 </div>
	 
	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond">
	<h3>Leave a reply on "<?php the_title(); ?>"</h3>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	
	<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
	
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( is_user_logged_in() ) : ?>

		<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

		<?php else : ?>
		
		<p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
		
		<p>
			<label for="author"><strong>Name <span>(*)</span></strong></label>
			<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" />
		</p>
		<p>
			<label for="email"><strong>E-mail <span>(*)</span></strong></label>
			<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" />
		</p>
		<p>
			<label for="url">Website</label>
			<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" />
		</p>

		<?php endif; ?>
		
		<p>
			<label for="comment"><strong>Message <span>(*)</span></strong></label>
			<textarea name="comment" id="comment" cols="" rows=""></textarea>
		</p>
		
		<p>
			<button name="submit" type="submit" id="submit"><span>Send</span></button>
		</p>
		
		<?php comment_id_fields(); ?>
		
		<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; /* If registration required and not logged in */ ?>

</div>

<?php endif; /* if you delete this the sky will fall on your head */ ?>