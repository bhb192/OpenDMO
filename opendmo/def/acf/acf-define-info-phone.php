<?php

$max_phone = $opendmo_options_meta['opendmo_phone_total'][0];
if(strlen($max_phone) < 1) { $max_phone = $opendmo_default_limit['phone']; } 

$phx = array();
$phxx = 0;

$info_fields['phone'] = array( array(

    "key" => "field_opendmo_info_phone",
    "label" => "Phone",
    "name" => "",
    "type" => "tab",

));

for($xxp = 0; $xxp<$max_phone; $xxp++) {

    $phx[$phxx] = array (

	    'key' => "field_phonerowo$phxx",
	    'label' => "f$phxxo",
	    'name' => "f$phxxo",
	    'type' => 'row',
	    'row_type' => 'row_open',
	    'col_num' => 2,

    );

	$phx[$phxx+1] = array (

		'key' => "field_5wej222ddb$xxp",
		'label' => ('Phone Number Label ('.($xxp+1).')'),
		'name' => 'opendmo_phone_label'.$xxp,
		'type' => 'text',
		'instructions' => '',
		'default_value' => '',
		'placeholder' => 'Phone Number',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '99',
	);

	$phx[$phxx+2] = array (

		'key' => "field_56dweea84ddb$xxp",
		'label' => ('Phone Number ('.($xxp+1).')'),
		'name' => 'phone'.$xxp,
		'type' => 'text',
		'instructions' => '',
		'default_value' => '',
		'placeholder' => '(555) 123-4567',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '99',
	);

    $phx[$phxx+3] = array (

	    'key' => "field_phonerowc$phxx",
	    'label' => "f$phxxo",
	    'name' => "f$phxxo",
	    'type' => 'row',
	    'row_type' => 'row_close',
	    'col_num' => 2,

    );

    $phxx = count($phx);

}

$info_fields['phone'] = array_merge($info_fields['phone'], $phx);

?>
