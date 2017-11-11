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

$opendmo_path = plugin_dir_path( __FILE__ );

foreach (glob($opendmo_path."define/*.php") as $filename) {

    include $filename;

}  

include($opendmo_path.'extends/pcs/pcs.php');
include($opendmo_path.'extends/pts/pts.php');
include($opendmo_path.'extends/acf/acf.php');
include($opendmo_path.'extends/acf-dtp/acf-dtp.php');
include($opendmo_path.'extends/acf-rf/acf-row.php');

?>
