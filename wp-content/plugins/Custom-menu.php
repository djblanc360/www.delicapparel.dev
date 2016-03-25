<?php
/**
 * @package Hello_Dolly
 * @version 1.6
 */
/*
Plugin Name: Custom-menu
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This plugin will create a custom menu are for the currentyl active theme
Version: 1.6
Author URI: http://ma.tt/
*/
function register_delic_menu()
{
	register_nav_menus( array(
	'pluginbuddy_mobile' => 'Custom Menu Area',
	'footer_menu' => 'My Custom Footer Menu',
) );
}



?>
