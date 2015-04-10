<div class="wrap" style="margin:12px 0 0 0;">
    <?php screen_icon(); ?>
	<form action="options.php" method="post" id="<?php echo $plugin_id; ?>_options_form" name="<?php echo $plugin_id; ?>_options_form">
	<?php settings_fields($plugin_id.'_options'); ?>
    <h2>myNewsDesk Plugin Options &raquo; Settings</h2>
    <table class="widefat">
		<tbody>
		   <tr>
			 <td>
                <b>Unique key? (given by mynewsdesk)</b><br />
                <input type="text" name="kkpo_quote" style="width:350px;" value="<?php echo get_option('kkpo_quote'); ?>" />
             </td>
		   </tr>
		   <tr>
			 <td>
             	<?php $type_of_media = array('news','pressrelease','blog_post','event','image','video','document','contact_person'); ?>
                <b>Type of media to be displayed</b><br />
				<?php
                $kkpo_media_type = array();
                $kkpo_media_option = get_option('kkpo_media');
                if(!empty($kkpo_media_option) && is_array($kkpo_media_option))
                    $kkpo_media_type = $kkpo_media_option;
                ?>                
                <?php foreach($type_of_media as $key => $value): ?>
                	<?php
						$checked = '';
						if( in_array( $value, $kkpo_media_type ) )
							$checked = 'checked';					
					?>
	                <input type="checkbox" id="kkpo_media_<?php echo $key; ?>" <?php echo $checked;?> name="kkpo_media[]" value="<?php echo $value;?>"><?php echo $value;?><br/>
                <?php endforeach;?>
             </td>
		   </tr>
		   <tr>
			 <td>
					<p>For more information please read <a href='http://www.mynewsdesk.com/docs/webservice_pressroom' target='_blank'>www.mynewsdesk.com/docs/webservice_pressroom</a></p>
             </td>
		   </tr>
           

                      
		</tbody>
		<tfoot>
		   <tr>
			 <th><input type="submit" name="submit" value="Save Settings" class="button-primary" /></th>
		   </tr>
		</tfoot>        
	</table>
	</form>
</div>