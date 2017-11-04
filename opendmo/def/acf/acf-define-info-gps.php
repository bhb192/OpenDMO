<?php

$maxgps = $opendmo_options_meta['opendmo_gps_total'][0];
if(!$maxgps > 0) { $maxgps = $opendmo_default_limit['gps_pair']; } 

$info_fields['gps'] = array(

    array (
        "key" => "field_opendmo_info_gps",
        "label" => "GPS",
        "name" => "",
        "type" => "tab",
    ),

);

$gx = array();
$suggestgps = array("Parking Lot", "Scenic Viewpoint", "Picnic Area");
$the_suggestgps = '';

for($gxx = 0; $gxx<$maxgps; $gxx++) {

    $gx[$xg] = array (

	    'key' => "field_gpsrowo$gxx",
	    'label' => "f$gxxo",
	    'name' => "f$gxxo",
	    'type' => 'row',
	    'row_type' => 'row_open',
	    'col_num' => 3,

    );

    if(isset($suggestgps[$xg])) { $the_suggestgps = $suggestgps[$xg]; }
    else { $the_suggestgps = 'Other Landmark'; }

    $gx[$xg+1] = array (

		'key' => "field_578wljwjwe0f4$gxx",
		'label' => 'GPS Label ('.($gxx+1).')',
		'name' => "opendmo_gps_lat_$gxx",
		'type' => 'text',
		'instructions' => '',
		'default_value' => '',
		'placeholder' => $the_suggestgps,
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '99',

	);

    $gx[$xg+2] = 	array (

		'key' => "field_578673873f0f4$gxx",
		'label' => "GPS Latitude (".($gxx+1).")",
		'name' => "opendmo_gps_parking_lat_$gxx",
		'type' => 'text',
		'instructions' => '',
		'default_value' => '',
		'placeholder' => '34.696458',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '99',

	);

	$gx[$xg+3] = array (
		'key' => "field_578673953f0f5$gxx",
		'label' => "GPS Longitude (".($gxx+1).")",
		'name' => "opendmo_gps_parking_long_$gxx",
		'type' => 'text',
		'instructions' => '',
		'default_value' => '',
		'placeholder' => '-82.838723',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '99',
	);

    $gx[$xg+4] = array (

	    'key' => "field_gpsrowc$gxx",
	    'label' => "f$gxxc",
	    'name' => "f$gxxc",
	    'type' => 'row',
	    'row_type' => 'row_close',
	    'col_num' => 3,

    );

    $xg = count($gx);

}

$info_fields['gps'] = array_merge($info_fields['gps'],$gx);

?>
