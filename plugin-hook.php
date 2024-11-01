<?php
/*
Plugin Name: TCBD Author URL Changer
Plugin URI: http://demos.tcoderbd.com/wordpress_plugins/
Description: This plugin will enable change author url in your Wordpress theme.
Author: Md Touhidul Sadeek
Version: 1.0
Author URI: http://tcoderbd.com
*/

/*  Copyright 2015 tCoderBD (email: info@tcoderbd.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Add settings page link in before activate/deactivate links.
function tcbd_google_map_plugin_action_links( $actions, $plugin_file ){
	
	static $plugin;

	if ( !isset($plugin) ){
		$plugin = plugin_basename(__FILE__);
	}
		
	if ($plugin == $plugin_file) {
		
		if ( is_ssl() ) {
			$settings_link = '<a href="'.admin_url( 'plugins.php?page=tcbd_admin_url_changer_settings', 'https' ).'">Settings</a>';
		}else{
			$settings_link = '<a href="'.admin_url( 'plugins.php?page=tcbd_admin_url_changer_settings', 'http' ).'">Settings</a>';
		}
		
		$settings = array($settings_link);
		
		$actions = array_merge($settings, $actions);
			
	}
	
	return $actions;
	
}
add_filter( 'plugin_action_links', 'tcbd_google_map_plugin_action_links', 10, 5 );


// Include Settings page
include( plugin_dir_path(__FILE__).'settings.php' );


function tcbd_change_author_base_in_permalink() {
	
	if( get_option('tcbd_admin_url_changer_value') ){
		$tcbd_admin_url = get_option('tcbd_admin_url_changer_value');
	}else{
		$tcbd_admin_url = 'author';
	}	
	
    global $wp_rewrite;
    $wp_rewrite->author_base = "$tcbd_admin_url";
    $wp_rewrite->flush_rules();
	
}
add_action("init","tcbd_change_author_base_in_permalink");