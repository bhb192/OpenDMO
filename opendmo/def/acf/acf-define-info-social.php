<?php

$maxsocial = $opendmo_options_meta['opendmo_social_links_total'][0];
if(!$maxsocial > 0) { $maxsocial = $opendmo_default_limit['social_links']; } 

$is = array();
$m = 0;

while(strlen($opendmo_options_meta["opendmo_social_name_$m"][0]) > 0) {

    $social_name = "opendmo_social_name_$m";
    $social_name = $opendmo_options_meta[$social_name][0];

    $social_url = "opendmo_social_url_$m";
    $social_url = $opendmo_options_meta[$social_url][0];

    $social_choice = array( $social_url => $social_name );
    $is = array_merge($is, $social_choice);

    $m++;

}

$social_link_select = array(

    'key' => "",
    'label' => "",
    'name' => '',
    'type' => 'select',
    'choices' => $is,
    'default_value' => '',
    'allow_null' => 1,
    'multiple' => 0,

);

$is = array();
$s = 0;

for($m=0; $m<$maxsocial; $m++) {

    $is[$s] = array (

	    'key' => "field_sociallinkrowo$m",
	    'label' => "f$so",
	    'name' => "f$so",
	    'type' => 'row',
	    'row_type' => 'row_open',
	    'col_num' => 2,

    );

    $s++;
    $is[$s] = $social_link_select;
    $is[$s]['key'] = "field_sociallinkselect$m";
    $is[$s]['label'] = "Social Network (".($m+1).")";
    $is[$s]['name'] = "post_social_domain_$m";

	$is[$s+1] = array (

		'key' => "field_56b3f4a35c1ff$m",
		'label' => ("Profile URL (".($m+1).")"),
		'name' => "post_social_url_$m",
		'type' => 'text',
		'instructions' => '',
		'default_value' => '',
		'placeholder' => 'VisitNewYork',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '99',
	);

    $is[$s+2] = array (

	    'key' => "field_sociallinkrowc$m",
	    'label' => "f$so",
	    'name' => "f$so",
	    'type' => 'row',
	    'row_type' => 'row_close',
	    'col_num' => 2,

    );

    $s = count($is);

}

$social_fields = array(

    array (
        "key" => "field_opendmo_info_social",
        "label" => "Social",
        "name" => "",
        "type" => "tab",
    ),

);

$info_fields['social'] = array_merge($social_fields, $is);

?>
