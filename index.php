<?php
	get_header();
	$sidebarPosition = get_option('t-side-position');
?>

<div id="main" <?php if ($sidebarPosition == 'right'){ echo 'class="invert"'; } ?>>
<div id="content">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<div class="postTitle">
			<h2><?php the_title(); ?></h2>
			<p class="postDate">
				<strong><?php the_time('d'); ?></strong>
				<em><?php the_time('l'); ?></em>
				<span><?php the_time('M Y'); ?></span>
			</p>
			<div class="postInfo">
				<p>Written by <?php the_author(); ?> in <?php the_category(', ') ?></p>
				<p class="postComCount">
					<strong>&asymp; <?php comments_popup_link( '0 Comments', '1 Comment', '% Comments', 'comments-link'); ?></strong>
				</p>
			</div>
		</div>
		<div class="postContent">
			<div class="postExtras">
				<p><?php edit_post_link('[Edit this article]', '', ''); ?></p>
				<p><strong>Tags</strong></p>
				<p><?php the_tags('',', ',''); ?></p>
				<p><strong>Share it</strong></p>
				<ul>
					<li class="shareTwitter"><a rel="nofollow" href="http://twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink() ?>" title="Share this post on Twitter" target="_blank">Twitter</a></li>
					<li class="shareFacebook"><a rel="nofollow" href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" title="Share this post on Facebook" target="_blank">Facebook</a></li>
				</ul>
			</div>
			<div class="postEntry">
				<?php the_content('Continue reading &raquo;'); ?>
			</div>
		</div>
	</div>
	
	<?php endwhile; else: ?>
	
	<div class="post">
		<div class="postTitle">
			<h2>Sorry, no posts matched your criteria.</h2>
		</div>
	</div>
	
	<?php endif; ?>

</div>

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>