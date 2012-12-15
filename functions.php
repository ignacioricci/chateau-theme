<?php
 
	include_once(TEMPLATEPATH . '/ssi/chateau-options.php');
	
	// Remove Gallery CSS
	add_filter('gallery_style', create_function('$a', 'return "<div class=\'gallery\'>";'));
 
 	// ENABLE WIDGETS
 	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => 'Sidebar Top',
    		'before_widget' => '<li class="sidebar-item">',
    		'after_widget' => '</li>',
    		'before_title' => '<h3>',
   			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Sidebar Bottom',
    		'before_widget' => '<li class="sidebar-item">',
    		'after_widget' => '</li>',
    		'before_title' => '<h3>',
   			'after_title' => '</h3>',
		));
		register_sidebar(array(
			'name' => 'Footer Welcome Message',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<strong>',
				'after_title' => '</strong>',
		));
		register_sidebar(array(
			'name' => 'Footer Extras',
			'before_widget' => '<li class="siteMap-item">',
			'after_widget' => '</li>',
			'before_title' => '<h5>',
				'after_title' => '</h5>',
		));
	}
	
 	// ENABLE CUSTOM HEADER	 
    add_action( 'after_setup_theme', 'chateau_setup' );
    if ( ! function_exists('chateau_setup') ):
   		function chateau_setup() {
		    // This theme uses post thumbnails
		    add_theme_support( 'post-thumbnails' );
		    	define( 'HEADER_IMAGE', '%s/images/chateau-default.jpg' );
		    	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'yourtheme_header_image_width', 960 ) );
		    	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'yourtheme_header_image_height', 260 ) );
		    	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
				define( 'NO_HEADER_TEXT', true );
				add_custom_image_header( '', 'chateau_admin_header_style' );
  		}
    endif;   
    if ( ! function_exists( 'chateau_admin_header_style' ) ) :
		function chateau_admin_header_style() {
	        echo '<style type="text/css">
	          #headimg {height:' . HEADER_IMAGE_HEIGHT . 'px; width:' . HEADER_IMAGE_WIDTH . 'px;}
	          #headimg h1, #headimg #desc {display:none;}
	        </style>';
    } endif;
    
    // ENABLE CUSTOM MENUS
    register_nav_menus(array('mainmenu'=>__('Main Menu'),));
 
 	// ENABLE CUSTOM AVATAR	
 	add_filter( 'avatar_defaults', 'newgravatar' );  
	function newgravatar ($avatar_defaults) {  
		$myavatar = get_bloginfo('template_directory') . '/images/custom-avatar.png'; 
		$avatar_defaults[$myavatar] = "Custom Avatar";  
		 return $avatar_defaults;  
	}
 
 	// ENABLE CUSTOM EXCERPT
	function new_excerpt_more($more) {return '&hellip;';}
	function new_excerpt_length($length) { return 20; }
	add_filter('excerpt_length', 'new_excerpt_length');
	add_filter('excerpt_more', 'new_excerpt_more');
    
    // CUSTOM COMMENTS OUTPUT 
	function chateau_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		
		<li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		
			<div class="commentHeading">
				<p class="commentAuthor">
					<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<?php printf(__('<span>%s</span>'), get_comment_author_link()) ?> <em>said:</em>
				</p>
				<p class="commentDate">
					<?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
				</p>
			</div>
			<div class="commentText">
				<?php comment_text() ?>
				<?php if ($comment->comment_approved == '0') : ?>
				<p class="waiting4Mod"><?php _e('Your comment is awaiting moderation.') ?></p>
				<?php endif; ?>
				<p class="replyLink"><?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
				<p class="editComment"><?php edit_comment_link(__('[Edit Comment]'),'','') ?></p>
			</div>
	
<?php } ?>