<?php get_header();

	$sidebarPosition = get_option('t-side-position');

?>

<div id="main" <?php if ($sidebarPosition == 'right'){ echo 'class="invert"'; } ?>>
<div id="content">

	<div class="morePosts">
		
		<?php if (have_posts()) : ?>
		
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
		<h3>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h3>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h3>Posts Tagged with &#8216;<?php single_tag_title(); ?>&#8217;</h3>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h3>Archive for <?php the_time('F jS, Y'); ?></h3>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3>Archive for <?php the_time('F, Y'); ?></h3>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h3>Archive for <?php the_time('Y'); ?></h3>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h3>Author Archive</h3>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h3>Blog Archives</h3>
		<?php } ?>
		
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
		
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h3>Sorry, but there aren't any articles in the %s category yet.</h3>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h3>Sorry, but there aren't any articles with this date.</h3>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h3>Sorry, but there aren't any articles by %s yet.</h3>", $userdata->display_name);
		} else {
			echo("<h3>No articles found.</h3>");
		}

	endif;
?>

</div>

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>