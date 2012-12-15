<?php
	get_header();
	$sidebarPosition = get_option('t-side-position');
?>

<div id="main" <?php if ($sidebarPosition == 'right'){ echo 'class="invert"'; } ?>>
<div id="content">

<!-- LAST POST -->
<?php query_posts('posts_per_page=1'); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<div class="postTitle">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
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
				<p>
				<?php
					$hastags = get_the_tags();
					if ($hastags) {
				  		the_tags('',', ','');
					}
					else {
						echo 'No tags :(';
					}
				?>
				</p>
				<?php
					$socialItems = unserialize(get_option('t-social-items'));
				?>
				<?php if(is_array($socialItems)): ?>
				<p><strong>Share it</strong></p>
				
				<ul>
					<?php foreach($socialItems as $key => $item): ?>
					<?php if($item == 'gp'){ ?>
						<li class="shareGPlus"><g:plusone size="medium" count="false"></g:plusone></li>
					<?php } elseif($item == 'tw'){ ?>	
					<li class="shareTwitter"><a rel="nofollow" href="http://twitter.com/home?status=<?php the_title(); ?>+<?php the_permalink() ?>" title="Share this post on Twitter" target="_blank">Twitter</a></li>
					<?php }elseif($item == 'li'){ ?>
						<li class="shareLinkedin"><a rel="nofollow" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>&amp;source=<?php bloginfo('name'); ?>" target="_blank">LinkedIn</a></li>
					<?php }elseif($item == 'fb'){ ?>
						<li class="shareFacebook"><a rel="nofollow" href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" title="Share this post on Facebook" target="_blank">Facebook</a></li>
					<?php } ?>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</div>
			<div class="postEntry">
				<?php the_content('Continue reading &raquo;'); ?>
			</div>
		</div>
	</div>
	
<?php endwhile; else: ?>	
<li>Nothing</li>	
<?php endif; ?>
<?php wp_reset_query();?>
	
	<!-- PREVIOUS 2 ENTRIES -->
	<?php
	$count_posts = wp_count_posts();
	$archiveLayout = get_option('t-columns');
	if ($count_posts->publish > 1) {
	?>
	<div class="morePosts">
		<h3>Checkout some previous articles</h3>
		<ul <?php $archiveLayout = get_option('t-columns'); if ($archiveLayout == 1){ echo 'class="simpleArchive"'; } ?>>
			<?php
				$morePostsOnHome = get_option('t-articles');
				if ($morePostsOnHome == ''){
					$morePostsOnHome = 2;
				}
				query_posts('offset=1&posts_per_page=' . $morePostsOnHome); if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			?>
			<li>
				<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
				<span><?php the_time('d M Y'); ?></span>
				<p><?php echo get_the_excerpt(); ?></p>
				<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Continue reading &raquo;</a></p>
			</li>
			<?php endwhile; else: ?>	
			<li>Write some more articles!</li>	
			<?php endif; ?>
			<?php wp_reset_query();?>
		</ul>
	</div>
	<?php }; ?>

</div>

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>