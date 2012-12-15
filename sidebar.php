<div id="sidebar">
	<ul>
	
		<!-- Widgets Top -->
		<?php if (function_exists('register_sidebar'))
			dynamic_sidebar('Sidebar Top');
		?>

		<li class="sidebar-item" id="subscribeItem">
			<h3>&clubs; Subscribe</h3>
			<ul>
				<li><a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe to Entries (RSS)">Entries (RSS)</a></li>
				<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="Subscribe to Comments (RSS)">Comments (RSS)</a></li>
			</ul>
		</li>
		
		<!-- Widgets Bottom -->
		<?php if (function_exists('register_sidebar'))
			dynamic_sidebar('Sidebar Bottom');
		?>
		
	</ul>
</div>