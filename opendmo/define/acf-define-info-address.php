<?php

$ia_city = array();
$ia_state = array();
$ia_zip = array();
$ia_zip_select = array();
$m = 0;    

$maxadr = $opendmo_options_meta['opendmo_adr_total'][0];
if(!$maxadr > 0) { $maxadr = $opendmo_default_limit['address']; } 

while(strlen($opendmo_options_zip_meta["opendmo_zip_code_$m"][0]) > 0) {

    $ia_city[$m] = $opendmo_options_zip_meta["opendmo_zip_city_$m"][0];
    $ia_state[$m] = $opendmo_options_zip_meta["opendmo_zip_state_$m"][0];
    $ia_zip[$m] = $opendmo_options_zip_meta["opendmo_zip_code_$m"][0];

    $m++;

} 

$ia_city_unique = array_unique($ia_city); 
$ia_cs = field_build_select('address_city_', "Select City ", 1, array(), '', 1);
$ia_city_select_key = $ia_cs[0];
$ia_city_select = $ia_cs[1];

foreach($ia_city_unique as $ia=>$c) {

    $ia_citylow = strtolower($c).strtolower($ia_state[$ia]);
    $ia_cityup = $c.", ".$ia_state[$ia];
    $ia_citycomb = array($ia_citylow=>$ia_cityup);
    $ia_city_select['choices'] = array_merge($ia_city_select['choices'], $ia_citycomb);

    $zip_match = array_keys($ia_city, $c);
    $zip_choices = array();
    foreach ($zip_match as $z=>$zm) { $zip_choices = array_merge($zip_choices,array($ia_zip[$zm]=>$ia_zip[$zm])); }
    $zip_select = field_build_select("address_zip_", "Select Zip ", 0, $zip_choices, 0);

    $zip_select['conditional_logic'] = array (

	    'status' => 1,
	    'rules' => array(

            array(

	            'field' => $ia_city_select_key."_",
	            'operator' => '==',
	            'value' => $ia_citylow,

            ),

        ),
	    'allorany' => 'all',

	 );

    $ia_zip_select = array_merge($ia_zip_select, array($zip_select));

}

$af = array(field_build_tab("Address"));
$aflabels = array("Primary Address", "Mailing Address", "Address for GPS");

for($a=0; $a<$maxadr; $a++) {

    $af_row = field_build_row(4);

    if(isset($aflabels[$a])) { $the_aflabel = $aflabels[$a]; }
    else { $the_aflabel = "Other Address"; }

    $af_city = $ia_city_select;
    $af_city['key'] = $af_city['key']."_$a";
	$af_city['label'] = $af_city['label']."(".($a+1).")";
	$af_city['name'] = $af_city['name']."$a";

    $af = array_merge($af, array(

        $af_row['open'],
        field_build_text("address_label_$a", "Address Label (".($a+1).")", $the_aflabel),
        field_build_text("address_line_$a", "Address (".($a+1).")", "123 W Main St"),
        $af_city,

    ));

    foreach($ia_zip_select as $iazsk=>$iazs) {

        $af_zip = $iazs;
        $af_cond = $af_zip['conditional_logic']['rules'][0]['field'];

        $af_zip['key'] = $af_zip['key']."_".$a."_".$iazsk;
	    $af_zip['label'] = $af_zip['label']."(".($a+1).")";
	    $af_zip['name'] = $af_zip['name'].$a;
        $af_zip['conditional_logic']['rules'][0]['field'] = $af_cond.$a;

        $af = array_merge($af, array($af_zip));

    }

    $af = array_merge($af, array($af_row['close']));

}
//echo("<pre>");print_r($af);die;

$info_fields['address'] = $af;

?>
