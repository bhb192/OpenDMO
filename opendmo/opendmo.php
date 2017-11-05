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

include($opendmo_path.'extends/pcs/pcs.php');
include($opendmo_path.'extends/pts/pts.php');
include($opendmo_path.'extends/cpt/cpt-onomies.php');
include($opendmo_path.'define/cpt-define.php');
include($opendmo_path.'define/acf-define-filters.php');
include($opendmo_path.'extends/acf/acf.php');
include($opendmo_path.'extends/acf-dtp/acf-dtp.php');
include($opendmo_path.'extends/acf-rf/acf-row-v4.php');
include($opendmo_path.'define/acf-define-fields.php');
include($opendmo_path.'options/options.php');

?>
