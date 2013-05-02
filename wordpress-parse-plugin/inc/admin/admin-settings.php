<?php

function parse_setup_admin_menus() {  
    add_menu_page('Parse Settings', 'Parse Settings', 'manage_options',   
        'parse_settings', 'parse_settings_page');  
}  
add_action("admin_menu", "parse_setup_admin_menus");  

function parse_settings_page() {
	
	if ( !current_user_can( 'manage_options' ) ) {  
	    wp_die( 'You do not have sufficient permissions to access this page.' );  
	}
	
	if ( isset( $_POST["update_settings"] ) ) {  
		$api_url = esc_attr( $_POST["api_url"] );
		$app_id = esc_attr( $_POST["app_id"] );
		$client_id = esc_attr( $_POST["client_id"] );
		$api_key = esc_attr( $_POST["api_key"] );
		$master_key = esc_attr( $_POST["master_key"] );
		$js_key = esc_attr( $_POST["js_key"] );
		$windows_key = esc_attr( $_POST["windows_key"] );
		
		update_option( "parse_api_url", $api_url );
		update_option( "parse_app_id", $app_id );
		update_option( "parse_client_id", $client_id );
		update_option( "parse_api_key", $api_key );
		update_option( "parse_master_key", $master_key );
		update_option( "parse_js_key", $js_key );
		update_option( "parse_windows_key", $windows_key );
		
		echo '<div id="message" class="updated">Settings saved</div>';
	}
	
	$api_url = get_option( "parse_api_url" );
	$app_id = get_option( "parse_app_id" );
	$client_id = get_option( "parse_client_id" );
	$api_key = get_option( "parse_api_key" );
	$master_key = get_option( "parse_master_key" );
	$js_key = get_option( "parse_js_key" );
	$windows_key = get_option( "parse_windows_key" ); ?>
	
    <div class="wrap">  
        <?php screen_icon('themes'); ?> <h2>Parse Settings</h2>  
  
        <form method="POST" action="">  
            <table class="form-table">  
                <tr valign="top">  
                    <th scope="row">  
                        <label for="api_url">Parse API URL: </label>   
                    </th>  
                    <td>  
						<input type="text" name="api_url" value="<?php echo $api_url;?>" size="70" />
                    </td>  
                </tr>  
                <tr valign="top">  
                    <th scope="row">  
                        <label for="app_id">Parse App ID: </label>   
                    </th>  
                    <td>  
						<input type="text" name="app_id" value="<?php echo $app_id;?>" size="70" />
                    </td>  
                </tr>  
                <tr valign="top">  
                    <th scope="row">  
                        <label for="client_id">Parse Client ID: </label>   
                    </th>  
                    <td>  
						<input type="text" name="client_id" value="<?php echo $client_id;?>" size="70" />
                    </td>  
                </tr>  
                <tr valign="top">  
                    <th scope="row">  
                        <label for="api_key">Parse API Key: </label>   
                    </th>  
                    <td>  
						<input type="text" name="api_key" value="<?php echo $api_key;?>" size="70" />
                    </td>  
                </tr>  
                <tr valign="top">  
                    <th scope="row">  
                        <label for="master_key">Parse Master Key: </label>   
                    </th>  
                    <td>  
						<input type="text" name="master_key" value="<?php echo $master_key;?>" size="70" />
                    </td>  
                </tr>  
                <tr valign="top">  
                    <th scope="row">  
                        <label for="js_key">Parse JavaScript Key: </label>   
                    </th>  
                    <td>  
						<input type="text" name="js_key" value="<?php echo $js_key;?>" size="70" />
                    </td>  
                </tr>  
                <tr valign="top">  
                    <th scope="row">  
                        <label for="windows_key">Parse Windows Key: </label>   
                    </th>  
                    <td>  
						<input type="text" name="windows_key" value="<?php echo $windows_key;?>" size="70" />
                    </td>  
                </tr>  
            </table>
			<p>  
			    <input type="submit" value="Save settings" class="button-primary"/>
			    <input type="hidden" name="update_settings" value="Y" />
			</p>
        </form>  
    </div> <?php
}  
?>