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

include('extends/pcs/pcs.php');
include('def/cpt/cpt-load.php');
include('def/acf/acf-load.php');
include('options/options.php');

?>
