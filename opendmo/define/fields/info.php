<?php

$tif_register = array();

foreach (glob($opendmo_path."define/fields/info/*.php") as $filename) {

    $info_fields = array();
    include $filename;
    $tif_register = array_merge($tif_register, $info_fields);

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
