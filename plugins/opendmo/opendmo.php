<?php

/*
Plugin Name: OpenDMO
Plugin URI: http://www.opendmo.org
Description: Making WordPress Work for the Travel Industry
Author: Austin Canfield
Version: 1.0
Author URI: http://www.acanf.pub
License: GPL2
*/

$opendmo_path = plugin_dir_path( __DIR__ )."opendmo/";
$opendmo_cpt_names = array('attractions', 'culture', 'eat', 'event', 'meet', 'places', 'shop', 'sports', 'stay');

function opendmonavmake() {

    add_menu_page('OpenDMO Settings', 'OpenDMO', 'manage_options', 'opendmo-settings', '', 'dashicons-location', 5);


}

function opendmoadminhide() {

    remove_submenu_page( 'options-general.php', 'custom-post-type-onomies' );
    remove_submenu_page( 'options-general.php', 'post-content-shortcodes' );
    //remove_menu_page('edit.php?post_type=acf');

}

add_action('init','opendmonavmake');
add_action('admin_init','opendmoadminhide');

include('extends/pcs/pcs.php');
include('def/cpt/cpt-load.php');
include('def/acf/acf-load.php');

?>
