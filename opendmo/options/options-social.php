<?php

$opendmo_opt["social"][0] = 

    array(

        "key" => "field_erh38dj39d3",
        "label" => "Social",
        "name" => "opendmo-opt-limits-tab",
        "type" => "tab"

    );

$default_social_media = array("Twitter", "Facebook", "YouTube", "Instagram", "Pinterest", "AirBnB", "TripAdvisor");

$thepo = get_post_meta($po);
$max_social = $thepo['opendmo_social_links_total'][0];
if(!$max_social > 0) { $max_social = $opendmo_default_limit['social_links']; } 
$sm = count($opendmo_opt["social"]);

for($s = 0; $s<$max_social; $s++) {

    $default_nn = '';
    $default_nu = '';

    if(isset($default_social_media[$s])) {

        $default_nn = $default_social_media[$s];
        $default_nu = "https://".strtolower($default_nn).".com/";

    } 

    $opendmo_opt["social"][$sm] = array (

	    'key' => "field_socialrowo$s",
	    'label' => "f$so",
	    'name' => "f$so",
	    'type' => 'row',
	    'row_type' => 'row_open',
	    'col_num' => 2,

    );

    $opendmo_opt["social"][$sm+1] = array (

        "key" => "field_sociallabel$s",
        "label" => "Network ".($s+1),
        "name" => "opendmo_social_name_$s",
		'type' => 'text',
		'default_value' => $default_nn,
		'placeholder' => 'Twitter',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '99',
    );

    $opendmo_opt["social"][$sm+2] = array (

        "key" => "field_socialurl$s",
        "label" => "URL Prefix",
        "name" => "opendmo_social_url_$s",
		'type' => 'text',
		'default_value' => $default_nu,
		'placeholder' => 'https://www.twitter.com/',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '99',
    );

    $opendmo_opt["social"][$sm+3] = array (

	    'key' => "field_socialrowc$s",
	    'label' => "f$sc",
	    'name' => "f$sc",
	    'type' => 'row',
	    'row_type' => 'row_close',
	    'col_num' => 2,

    );

    $sm = count($opendmo_opt["social"]);

}

?>
