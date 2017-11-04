<?php

$info_fields['reviews'] = array(

      array (
        "key" => "field_opendmo_info_reviews",
        "label" => "Reviews",
        "name" => "",
        "type" => "tab",
    ),
	array (
		'key' => 'field_57b71122bd902',
		'label' => 'Google Place ID',
		'name' => 'google_place_id',
		'type' => 'text',
		'instructions' => 'Find the ID of a Place through the <a href="https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder" target="_blank">Google PlaceID Finder Tool</a>. Example: ChIJgzjVcgxeWIgR_HSag0BYocs',
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '',
	),
	array (
		'key' => 'field_57d2f3dc28577',
		'label' => 'Make Google Reviews Private',
		'name' => 'google_private',
		'type' => 'true_false',
		'message' => 'Check this box to only allow admins to see Google reviews',
		'default_value' => 0,
	),

);

?>
