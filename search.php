<?php
	get_header();
	$sidebarPosition = get_option('t-side-position');
?>

<div id="main" <?php if ($sidebarPosition == 'right'){ echo 'class="invert"'; } ?>>
<div id="content">

	<?php if (have_posts()) : ?>
		
	<div class="morePosts">
		
		<h3>Search results for: <em><?php the_search_query(); ?></em></h3>
		
		<ul <?php $archiveLayout = get_option('t-columns'); if ($archiveLayout == 1){ echo 'class="simpleArchive"'; } ?>>
		
			<?php while (have_posts()) : the_post(); ?>

			<li <?php post_class() ?>>
				<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
				<span><?php the_time('d M Y'); ?></span>
				<p><?php echo get_the_excerpt(); ?></p>
				<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Continue reading &raquo;</a></p>
			</li>

			<?php endwhile; ?>

		</ul>
	</div>
	
	<div id="pageNavigation">
		<p id="prevPosts"><?php next_posts_link('&laquo; Older Articles') ?></p>
		<p id="nextPosts"><?php previous_posts_link('Newer Articles &raquo;') ?></p>
	</div>

	<?php else : ?>
	
	<div class="morePosts">
		<h3>No posts found. Please try a different search.</h3>
	</div>

	<?php endif; ?>
	
</div>

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>