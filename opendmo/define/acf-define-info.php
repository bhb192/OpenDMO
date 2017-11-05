<?php

    global $opendmo_options_meta;
    global $opendmo_options_zip_meta;
    global $opendmo_default_limit;
    global $opendmo_path;

    $the_info_fields = array('post-settings', 'hours', 'phone', 'address', 'gps', 'links', 'social', 'hotels', 'reviews');
    $tif_register = array();

    foreach($the_info_fields as $tif) {

        include($opendmo_path."/define/acf-define-info-$tif.php");
        $tif_register = array_merge($tif_register, $info_fields[$tif]);

    }

	register_field_group(array (
		'id' => 'acf_opendmo-post-info',
		'title' => 'OpenDMO Post Info',
		'fields' => $tif_register,
		'location' => fields_location(0),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (	),
		),
		'menu_order' => 0,
	));


?>
