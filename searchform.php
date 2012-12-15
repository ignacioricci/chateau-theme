<form method="get" action="<?php echo get_option('home'); ?>/" >
	<p>
		<label for="s" class="accesible">Search:</label>
		<input type="text" value="Search&hellip;" name="s" id="s" onfocus="this.value=''" />
		<input type="submit" name="search" value="Go" />
	</p>
</form>