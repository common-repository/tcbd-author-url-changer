<?php

	// Exit if accessed directly
	defined( 'ABSPATH' ) || exit;	

	function tcbd_admin_url_changer_settings() {
		add_plugins_page( 'TCBD Author Url Changer Settings', 'TCBD Author Url Changer', 'update_core', 'tcbd_admin_url_changer_settings', 'tcbd_admin_url_changer_settings_page');
	}
	add_action( 'admin_menu', 'tcbd_admin_url_changer_settings' );
	
	function tcbd_admin_url_settings() {
		register_setting( 'tcbd_admin_url_register_setting', 'tcbd_admin_url_changer_value' );
	}
	add_action( 'admin_init', 'tcbd_admin_url_settings' );
		
	function tcbd_admin_url_changer_settings_page(){ // settings page function
		if( get_option('tcbd_admin_url_changer_value') ){
			$tcbd_admin_url = get_option('tcbd_admin_url_changer_value');
		}else{
			$tcbd_admin_url = 'author';
		}
		
		?>
			<div class="wrap">
				<h2>TCBD Author URL Changer</h2>
                
				<?php if( isset($_GET['settings-updated']) && $_GET['settings-updated'] ){ ?>
					<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
						<p><strong>Settings saved.</strong></p>
                        <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
					</div>
				<?php } ?>
                
            	<form method="post" action="options.php">
                	<?php settings_fields( 'tcbd_admin_url_register_setting' ); ?>
                    
                	<table class="form-table">
                		<tbody>
                        
                    		<tr>
                        		<th scope="row"><label for="tcbd_admin_url_changer_value">Custom Word:</label></th>
                            	<td>
                                    <input class="regular-text" name="tcbd_admin_url_changer_value" type="text" id="tcbd_admin_url_changer_value" value="<?php echo esc_attr( $tcbd_admin_url ); ?>">
                                    <p class="description">Your custom author url: <a target="_blank" href="<?php echo esc_url(home_url());?>/<?php echo esc_attr( $tcbd_admin_url ); ?>/<?php $current_user = wp_get_current_user(); echo $current_user->user_login; ?>"><?php echo esc_url(home_url());?>/<?php echo esc_attr( $tcbd_admin_url ); ?>/<?php $current_user = wp_get_current_user(); echo $current_user->user_login; ?></a></p>
								</td>
                        	</tr>
                            
                    	</tbody>
                    </table>
                    
                    <p class="submit"><input id="submit" class="button button-primary" type="submit" name="submit" value="Save Changes"></p>
                </form>
                
            </div>
        <?php
	} // settings page function

?>