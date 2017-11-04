<?php

$maxlinks = $opendmo_options_meta['opendmo_ext_links_total'][0];
if(!$maxlinks > 0) { $maxlinks = $opendmo_default_limit['ext_links']; } 

$info_fields['links'] = array(

    array (
        "key" => "field_opendmo_info_links",
        "label" => "Links",
        "name" => "",
        "type" => "tab",
    ),

);

$ux = array();
$uxx = 0;

$suggest_link_labels = array('Official Website', 'Wikipedia Page');
$the_suggestll = '';

for($xxu = 0; $xxu<$maxlinks; $xxu++) {

    if(isset($suggest_link_labels[$xxu])) { $the_suggestll = $suggest_link_labels[$xxu]; }
    else { $the_suggestll = 'Other External Website'; }

    $ux[$uxx] = array (

	    'key' => "field_extlinkrowo$uxx",
	    'label' => "f$uxxo",
	    'name' => "f$uxxo",
	    'type' => 'row',
	    'row_type' => 'row_open',
	    'col_num' => 2,

    );

	$ux[$uxx+1] = array (

		'key' => "field_56b3f3e45c1fe$xxu",
		'label' => 'External Link Label ('.($xxu+1).')',
		'name' => 'opendmo_ext_link_'.$xxu,
		'type' => 'text',
		'instructions' => '',
		'default_value' => '',
		'placeholder' => $the_suggestll,
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '',
	);

	$ux[$uxx+2] = array (

		'key' => "field_56b3welkej3dc1fe$xxu",
		'label' => 'Website URL ('.($xxu+1).')',
		'name' => 'opendmo_ext_link_url_'.$xxu,
		'type' => 'text',
		'instructions' => '',
		'default_value' => '',
		'placeholder' => 'https://',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '',
	);

    $ux[$uxx+3] = array (

	    'key' => "field_extlinkrowc$uxx",
	    'label' => "f$uxxc",
	    'name' => "f$uxxc",
	    'type' => 'row',
	    'row_type' => 'row_close',
	    'col_num' => 2,

    );

    $uxx = count($ux);

}

$info_fields['links'] = array_merge($info_fields['links'],$ux);

?>
