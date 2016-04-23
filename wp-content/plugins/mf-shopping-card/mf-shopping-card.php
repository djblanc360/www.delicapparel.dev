<?php
/**
* Plugin Name: Mf Shopping Card
* Plugin URI: http://mfshoppingcard.com/
* Description: A custom shopping card plugin
* Version: 1.0
* Author: The Dream Team
* Author URI: http://thedreamteam.com/
**/

register_activation_hook(__FILE__, 'mfsc_install');
register_deactivation_hook(__FILE__, 'mfsc_uninstall');

global $mfsc_db_version;
$mfsc_db_version = '1.0';

session_start();

if (!isset($_SESSION["mfsc_id"])) {
	$_SESSION["mfsc_id"] = create_mfsc();
	$_SESSION["mfsc_content"] = [];
} else {
	$table_name = $wpdb->prefix . 'mf_shopping_card';

	$content = $wpdb->get_row($wpdb->prepare( 
		"
			SELECT *
			FROM $table_name 
			WHERE id = %s
		", 
		$_SESSION["mfsc_id"]
	));

	if ($content == null) {
		$_SESSION["mfsc_id"] = create_mfsc();
		$_SESSION["mfsc_content"] = [];
	} else {
		$_SESSION["mfsc_content"] = explode(";", $content->content);
	}
}

function mfsc_install() {
	global $wpdb;
	global $mfsc_db_version;

	$table_name = $wpdb->prefix . 'mf_shopping_card';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id varchar(250) NOT NULL,
		creation_time DATETIME DEFAULT CURRENT_TIMESTAMP,
		modification_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	    content varchar(250)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

	add_option('mfsc_db_version', $mfsc_db_version);
}

function mfsc_uninstall() {
	global $wpdb;
    $table = $wpdb->prefix . 'mf_shopping_card';

        //Delete any options thats stored also?
	delete_option('mfsc_db_version');

	$wpdb->query("DROP TABLE IF EXISTS $table");
}

function create_mfsc() {
	$id = sha1(microtime(true));
	global $wpdb;

	$table_name = $wpdb->prefix . 'mf_shopping_card';
	$wpdb->insert($table_name, 
	    array(
	      'id'          => $id,
	      'content'       => ''
	    ),
	    array(
	      '%s',
	      '%s'
	    ) 
    ); 
	return $id;
}

function add_to_mfsc($product) {
	$_SESSION["mfsc_content"][] = $product;
	global $wpdb;
	$id = $_SESSION["mfsc_id"];

	$table_name = $wpdb->prefix . 'mf_shopping_card';
	$content = $wpdb->get_var($wpdb->prepare( 
		"
			SELECT content 
			FROM $table_name 
			WHERE id = %s
		", 
		$id
	));
	$wpdb->query($wpdb->prepare("UPDATE $table_name SET content = %s, modification_time = NOW() WHERE id = %s", $content . ";" . $product, $id));
}

function empty_mfsc() {
	global $wpdb;
	$id = $_SESSION["mfsc_id"];
	$_SESSION["mfsc_content"] = [];
	$table_name = $wpdb->prefix . 'mf_shopping_card';
	$wpdb->query($wpdb->prepare("UPDATE $table_name SET content = %s, modification_time = NOW() WHERE id = %s", "", $id));
}

function delete_one_from_mfsc($product) {
	global $wpdb;
	$id = $_SESSION["mfsc_id"];

	$table_name = $wpdb->prefix . 'mf_shopping_card';
	$content = $wpdb->get_var($wpdb->prepare( 
		"
			SELECT content 
			FROM $table_name 
			WHERE id = %s
		", 
		$id
	));
	$mfsc = explode(";", $content);
	$content = "";
	$_SESSION["mfsc_content"] = [];
	$deleted = false;
	for ($i = 0; $i < count($mfsc); $i++) { 
		if ($deleted || $mfsc[$i] != $product) {
			if ($content != "") {
				$content = $content . ";";
			}
			$content = $content . $mfsc[$i];
			$_SESSION["mfsc_content"][] = $mfsc[$i];
		} else {
			$deleted = true;
		}
	}
	$wpdb->query($wpdb->prepare("UPDATE $table_name SET content = %s, modification_time = NOW() WHERE id = %s", $content, $id));
}

function delete_all_from_mfsc($product) {
	global $wpdb;

	$id = $_SESSION["mfsc_id"];

	$table_name = $wpdb->prefix . 'mf_shopping_card';
	$content = $wpdb->get_var($wpdb->prepare( 
		"
			SELECT content 
			FROM $table_name 
			WHERE id = %s
		", 
		$id
	));
	$mfsc = explode(";", $content);
	$content = "";
	for ($i = 0; $i < count($mfsc); $i++) { 
		if ($mfsc[$i] != $product) {
			if ($content != "") {
				$content = $content . ";";
			}
			$content = $content . $mfsc[$i];
		}
	}
	$wpdb->query($wpdb->prepare("UPDATE $table_name SET content = %s, modification_time = NOW() WHERE id = %s", $content, $id));
}

function delete_mfsc($id) {
	global $wpdb;

	$table_name = $wpdb->prefix . 'mf_shopping_card';
	$wpdb->delete($table_name, array('id' => $id), array('%d'));
}

add_action('admin_menu', 'mf_shopping_card_setup_menu');
 
function mf_shopping_card_setup_menu(){
    add_menu_page('MF Shopping Card Page', 'Shopping Card', 'manage_options', 'mf-shopping-card', 'backend_page', plugins_url() . "/mf-shopping-card/shop.png", 5);
}
 
function backend_page(){
	global $wpdb;
	$table_name = $wpdb->prefix . 'mf_shopping_card';
	include("admin-page.php");
}

function add_to_cart_button($product){
    echo '<a href="' . plugins_url() . '/mf-shopping-card/mf-shopping-card-form.php?action=add&id=' . $product . '">
	    <button>Add To Cart</button>
	</a>';
}

function delete_cart_button($id){
	echo '<a href="' . plugins_url() . '/mf-shopping-card/mf-shopping-card-form.php?action=delete&id=' . $id . '">
	    <button>Delete</button>
	</a>';
}

function checkout_cart_button($id){
	echo '<a href="' . plugins_url() . '/mf-shopping-card/checkout.php">
	    <button>Checkout</button>
	</a>';
}