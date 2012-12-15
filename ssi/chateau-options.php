<?php

add_action( 'admin_menu', 'chateauThemeMenu' );
 
function chateauThemeMenu(){
global $ThemeName;

if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_POST['action'] ) {
                foreach ($_POST as $key => $value):
                    if(isset($key)): 
                    	// If is a multiple choice
                    	if(is_array($value)): $value = serialize($value); endif;
                    	update_option( $key, $value ); 
                    else: 
                    	delete_option($key); 
                    endif;
				endforeach;
				if($_POST['t-social-items']===null): delete_option( 't-social-items' ); endif;

               header("Location: themes.php?page=chateau-options.php&saved=true");
               die;

        }
    }
//add this menu to our theme edit page
add_theme_page( $ThemeName . ' Theme Options', $ThemeName . ' Chateau Options', 'edit_themes',
 basename(__FILE__), 'chateauThemePage' );
 
}
 
function chateauThemePage(){

?>
	<?php if ( $_REQUEST['saved'] ) echo '<div id="message" style="clear:both; margin:20px 0 0;" class="updated fade"><p><strong>Chateau options saved.</strong></p></div>'; ?>
	<div class="wrap">
		<div class="icon-32" id="icon-themes" style="float:left; width:46px; height:50px; margin:10px 0 0;"></div>
		<h2 style="float:left; margin-top:3px;">Chateau Options</h2>
		<form method="post" action="">
		<table class="form-table">
			<tbody>
				<tr><td style="padding:20px 10px 7px; color:#900; font-size:1.3em; border-bottom:3px solid #DDD;" colspan="2">&clubs; General</td></tr>
				<tr valign="top">
					<th style="width:300px; padding:25px 0 20px 10px; border-bottom:1px solid #999;"><strong>&not; Color Style</strong><br /><em style="color:#666">(Default is: White)</em></th>
					<td style="padding:25px 0 20px; border-bottom:1px solid #CCC;">
					<?php $tcstyleArray = array('white' => 'White (Light)', 'black' => 'Black (Dark)');?>
					<?php $tcstyle = get_option( 't-c-style' ); ?>
					<?php foreach($tcstyleArray as $key => $value): ?>
						<p>
							<input type="radio" name="t-c-style" value="<?php echo $key; ?>" id="t-c-style-<?php echo $key; ?>"<?php if($tcstyle==$key) echo ' checked'; ?> />
							<label for="t-c-style-<?php echo $key; ?>"><?php echo $value; ?></label>
						</p>
					<?php endforeach; ?>
					</td>
				</tr>
				<tr valign="top">
					<th style="width:300px; padding:25px 0 20px 10px; border-bottom:1px solid #999;"><strong>&not; Sidebar Position</strong><br /><em style="color:#666">(Default is: Left)</em></th>
					<td style="padding:25px 0 20px; border-bottom:1px solid #CCC;">
						<?php $tsideposArray = array('left' => '(&larr;) Left', 'right' => '(&rarr;) Right');?>
						<?php $tcpos = get_option( 't-side-position' ); ?>
						<?php foreach($tsideposArray as $key => $value): ?>
							<p>
								<input type="radio" name="t-side-position" value="<?php echo $key ;?>" id="t-side-position-<?php echo $key; ?>"<?php if($tcpos==$key) echo ' checked'; ?> />
								<label for="t-side-position-<?php echo $key; ?>"><?php echo $value; ?></label>
							</p>
						<?php endforeach; ?>
					</td>
				</tr>
				<tr valign="top">
					<th style="width:300px; padding:25px 0 20px 10px; border-bottom:1px solid #999;"><strong>&not; Accent Color</strong><br /><em style="color:#666">Link color, header border color, etc.<br />(Default is: #990000)</em></th>
					<td style="padding:25px 0 20px; border-bottom:1px solid #CCC;">
						<p>
							<input type="text" name="t-accent-color" id="t-accent-color" value="<?php echo get_option( 't-accent-color' ); ?>" style="padding:5px; color:#333;" />
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th style="width:300px; padding:25px 0 20px 10px; border-bottom:1px solid #999;"><strong>&not; Previous articles in Homepage</strong><br /><em style="color:#666">How many previous articles to show on the Homepage.<br />(Default is: 2)</em></th>
					<td style="padding:25px 0 20px; border-bottom:1px solid #CCC;">
						<p>
							<input type="text" name="t-articles" id="t-articles" style="padding:5px; color:#333;" value="<?php echo get_option( 't-articles' );?>" />
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th style="width:300px; padding:25px 0 20px 10px; border-bottom:1px solid #FFF;"><strong>&not; Archive Post Columns</strong><br /><em style="color:#666">How many columns to show in archive pages.<br />(Default is: 2)</em></th>
					<td style="padding:25px 0 20px; border-bottom:1px solid #FFF;">
						<?php $tcolumnsArray = array('1' => '1 (One)', '2' => '2 (Two)');?>
						<?php $tcolumns = get_option( 't-columns' ); ?>
						<?php foreach($tcolumnsArray as $key => $value): ?>
							<p>
								<input type="radio" name="t-columns" value="<?php echo $key; ?>" id="t-columns-<?php echo $key; ?>"<?php if($tcolumns==$key) echo ' checked'; ?> />
								<label for="t-columns-<?php echo $key; ?>"><?php echo $value; ?></label>
							</p>
						<?php endforeach; ?>
					</td>
				</tr>
				<tr><td style="padding:30px 10px 7px; color:#900; font-size:1.3em; border-bottom:3px solid #DDD;" colspan="2">&clubs; Social</td></tr>
				<tr valign="top">
					<th style="width:300px; padding:25px 0 20px 10px; border-bottom:1px solid #FFF; border-bottom:3px solid #DDD;"><strong>&not; Social Share Links</strong></th>
					<td style="padding:25px 0 20px; border-bottom:3px solid #DDD;">
						
						<?php $tsocitemsArray = array('tw' => 'Twitter', 'fb' => 'Facebook', 'li' => 'Linked-in', 'gp' => 'Google +');?>
						<?php $tsocitems = unserialize(get_option( 't-social-items' )); ?>
						<?php foreach($tsocitemsArray as $key => $value): ?>
							<p>
								<input type="checkbox" name="t-social-items[]" value="<?php echo $key; ?>" id="t-social-items-<?php $key; ?>"<?php if(is_array($tsocitems)): 
								if( in_array( $key, $tsocitems ) ): echo ' checked'; endif; endif; ?> />
								<label for="t-social-items-<?php echo $key; ?>"><?php echo $value; ?></label>
							</p>
						<?php endforeach; ?>
					</td>
				</tr>
				<tr><td style="padding:40px 20px 40px 10px;" colspan="2"><input class="button-primary" name="save" type="submit" value="Save changes" name="save" /><input type="hidden" name="action" value="save" /></td></tr>
			</tbody>
		</table>
		
		</form>
	</div>

<?php } ?>