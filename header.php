<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<title>
			<?php if (function_exists('is_tag') && is_tag()) {
				single_tag_title('Tag Archive for &quot;'); echo '&quot; &ndash; '; 
			} elseif (is_archive()) {
				wp_title(''); echo ' Archive &ndash; '; 
			} elseif (is_search()) {
			  	echo 'Search results for &quot;'.wp_specialchars($s).'&quot; &ndash; ';
			} elseif (!(is_404()) && (is_single()) || (is_page())) {
				wp_title(''); echo ' &ndash; ';
			} elseif (is_404()) {
				echo 'Not Found &ndash; ';
			} if (is_home()) {
				bloginfo('name'); echo ' &ndash; '; bloginfo('description');
			} else {
				bloginfo('name');
			} if ($paged > 1) {
				echo ' &ndash; page '. $paged;
			} ?>
		</title>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<?php
			$colorStyle = get_option('t-c-style');
			if ($colorStyle == 'black'){
				echo '<link rel="stylesheet" href="' . get_bloginfo('template_directory') . '/css/dark.css" type="text/css" media="screen" />';
			}
		?>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/print.css" type="text/css" media="print" />
		<!--[if IE]>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie.css" type="text/css" media="screen" />
		<![endif]-->
		<!-- iPhone Styles -->
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=1;" />
		<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/images/iphone.png" />
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/iphone.css" type="text/css" media="only screen and (max-device-width: 480px)" />
		<!-- End iPhone Styles -->	
		<?php
			$accentColor = get_option('t-accent-color');
			if ($accentColor){
		?>
		<style type="text/css">
			#mainTitle h1 a:hover strong, .postTitle h2, .postTitle h2 a, .morePosts a:hover, .morePosts h3 em, .sidebar-item a:active, .postExtras .post-edit-link, .postEntry a, #comments li a:hover, #respond h3, #respond p a, #respond label span, #menu .current_page_item a, #menu .current_page_parent .current_page_item a, #calendar_wrap table td a, #comments li.byuser .commentAuthor, .postEntry h1 {color:<?php echo $accentColor; ?>;}
			body, #respond button:hover {border-color:<?php echo $accentColor; ?>}
			#respond button:hover {background:<?php echo $accentColor; ?>}
			<?php if($colorStyle == 'black'){ ?>
				#dark .morePosts h4 a, #dark .morePosts p a {color:<?php echo $accentColor; ?>;}
			<?php } ?>
		</style>
		<?php } ?>
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?><?php if($colorStyle == 'black'){ echo ' id="dark"'; } ?>>
	
		<!-- HEADER -->
		<div id="header">
			<div id="menu">
				<?php wp_nav_menu( array( 'theme_location' =>  'mainmenu', 'container' => '', 'depth' => '2') ); ?>
			</div>
			<div id="mainTitle">
				<h1>
					<a href="<?php echo get_option('home'); ?>/" title="&laquo; Return to <?php bloginfo('name'); ?>'s Homepage">
						<strong><?php bloginfo('name'); ?></strong> <span>~ <?php bloginfo('description'); ?></span>
					</a>
				</h1>
			</div>
			<div id="search">
				<?php get_search_form(); ?>
			</div>
			<div id="mainImage">
				<?php
				if (!is_404() && !is_attachment()) {
					if (is_singular() && has_post_thumbnail($post->ID) && ($image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnail') ) && $image[1] >= HEADER_IMAGE_WIDTH) :
						echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					else : ?>
						<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
				<?php endif; } ?>
			</div>
		</div>