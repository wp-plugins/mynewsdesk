<div class="wrap" style="margin:12px 0 0 0;">
    <?php screen_icon(); ?>
	<form action="options.php" method="post" id="<?php echo $plugin_id; ?>_options_form" name="<?php echo $plugin_id; ?>_options_form">
	<?php settings_fields($plugin_id.'_options'); ?>
    <h2>myNewsDesk Plugin Options &raquo; Settings</h2>
    <table class="widefat">
		<tbody>
		   <tr>
			 <td style="padding:25px;font-family:Verdana, Geneva, sans-serif;color:#666;">
                 <label for="kkpo_quote">
                     <p>Unique key? (given by mynewsdesk)</p>
                     <p><input type="text" name="kkpo_quote" style="width:350px;" value="<?php echo get_option('kkpo_quote'); ?>" /></p>
                 </label>
             </td>
		   </tr>
		</tbody>
		<tfoot>
		   <tr>
			 <th><input type="submit" name="submit" value="Save Settings" class="button-primary" style="padding:3px;" /></th>
		   </tr>
		</tfoot>        
	</table>
	</form>
</div>