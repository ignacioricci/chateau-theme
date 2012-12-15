<?php
	// Template Name: Full-Width
	get_header();
?>

<div id="main" class="full-width">
<div id="content">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<div class="postTitle">
			<h2><?php the_title(); ?></h2>
		</div>
		<div class="postContent">
			<div class="postEntry">
				<?php the_content('Continue reading &raquo;'); ?>
			</div>
		</div>
	</div>
	
	<?php endwhile; endif; ?>

</div>

</div>

<?php get_footer(); ?>