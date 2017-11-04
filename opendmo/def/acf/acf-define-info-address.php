<?php

$maxadr = $opendmo_options_meta['opendmo_adr_total'][0];
if(!$maxadr > 0) { $maxadr = $opendmo_default_limit['address']; } 

$ia_city = array();
$ia_state = array();
$ia_zip = array();
$m = 0;    

while(strlen($opendmo_options_zip_meta["opendmo_zip_code_$m"][0]) > 0) {


    $ia_city[$m] = $opendmo_options_zip_meta["opendmo_zip_city_$m"][0];
    $ia_state[$m] = $opendmo_options_zip_meta["opendmo_zip_state_$m"][0];
    $ia_zip[$m] = $opendmo_options_zip_meta["opendmo_zip_code_$m"][0];

    $m++;

} 

$ia_city_select = array(

	'key' => 'field_select_city_town_',
	'label' => 'Select City/Town ',
	'name' => 'opendmo_post_adr_city_',
	'type' => 'select',
	'choices' => array (),
	'default_value' => 'null',
	'allow_null' => 1,
	'multiple' => 0,

);

$ia_city_unique = array_unique($ia_city); 
$ia_zip_select = array();
$iacc = 0;

foreach($ia_city_unique as $ia=>$c) {

    $ia_citylow = strtolower($c).strtolower($ia_state[$ia]);
    $ia_cityup = $c.", ".$ia_state[$ia];
    $ia_citycomb = array($ia_citylow=>$ia_cityup);
    $ia_city_select['choices'] = array_merge($ia_city_select['choices'], $ia_citycomb);

    $zip_match = array_keys($ia_city, $c);
    $zip_choices = array();
    $zcc = 0;

    foreach ($zip_match as $z=>$zm) {

        $zip_choices[$z] = $ia_zip[$zm];

    }

    $zip_rules = array (

	    'field' => 'field_select_city_town_',
	    'operator' => '==',
	    'value' => $ia_citylow,
			
    );

    $ia_zip_select[$iacc] = array(

	    'key' => 'field_select_zip_',
	    'label' => 'Select City/Town ',
	    'name' => 'opendmo_post_adr_zip_',
	    'type' => 'select',
	    'choices' => $zip_choices,
	    'conditional_logic' => array (
		    'status' => 1,
		    'rules' => array($zip_rules),
		    'allorany' => 'all',
	    ),
	    'default_value' => 0,
	    'allow_null' => 1,
	    'multiple' => 0,

    );

    $iacc++;

}

$af = array(

    array (
        "key" => "field_opendmo_info_address",
        "label" => "Address",
        "name" => "",
        "type" => "tab",
    ),

);
$xa = count($af);

$aflabels = array("Primary Address", "Mailing Address", "Address for GPS");

for($a=0; $a<$maxadr; $a++) {

    $af[$xa] = array (

	    'key' => "field_postziprowo$a",
	    'label' => "f$ao",
	    'name' => "f$ao",
	    'type' => 'row',
	    'row_type' => 'row_open',
	    'col_num' => 4,

    );

    $the_aflabel = '';

    if(isset($aflabels[$a])) {

        $the_aflabel = $aflabels[$a];

    }

    else {

        $the_aflabel = "Other Address";

    }

    $xa++;
    $af[$xa] = array (

		'key' => "field_56berlkewri19b$a",
		'label' => "Address Label (".($a+1).")",
		'name' => "opendmo_post_adr_label_$a",
		'type' => 'text',
		'instructions' => '',
		'default_value' => '',
		'placeholder' => $the_aflabel,
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '99',

	);

    $xa++;
    $af[$xa] = array (

		'key' => "field_56b3fa4a7e19b$a",
		'label' => "Address (".($a+1).")",
		'name' => "opendmo_post_adr_$a",
		'type' => 'text',
		'instructions' => '',
		'default_value' => '',
		'placeholder' => '123 W Main St',
		'prepend' => '',
		'append' => '',
		'formatting' => 'html',
		'maxlength' => '99',

	);

    $xa++;
    $af[$xa] = $ia_city_select;
    $af[$xa]['key'] = "field_select_city_town_$a";
	$af[$xa]['label'] = 'Select City/Town ('.($a+1).')';
	$af[$xa]['name'] = "opendmo_post_adr_city_$a";

    foreach($ia_zip_select as $iazsk=>$iazs) {

        $xa++;
        $af[$xa] = $iazs;
        $af[$xa]['key'] = "field_select_zip_".$a."_".$iazsk;
	    $af[$xa]['label'] = 'Select Zip ('.($a+1).')';
	    $af[$xa]['name'] = "opendmo_post_adr_zip_".$a."_".$iazsk;
        $af[$xa]['conditional_logic']['rules'][0]['field'] = "field_select_city_town_$a";

    }

    $xa++;
    $af[$xa] = array (

	    'key' => "field_postziprowc$a",
	    'label' => "f$ac",
	    'name' => "f$ac",
	    'type' => 'row',
	    'row_type' => 'row_close',
	    'col_num' => 4,

    );

    $xa++;

}
//echo("<pre>");print_r($af);die;

$info_fields['address'] = $af;

?>
