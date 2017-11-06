<?php

$max_phone = $opendmo_options_meta['opendmo_phone_total'][0];
if(strlen($max_phone) < 1) { $max_phone = $opendmo_default_limit['phone']; } 

$phx = array();
$phxx = 0;

$info_fields['phone'] = array( field_build_tab('Phone') );

$suggestphone = array("Phone Number", "Daytime Phone", "Evening Phone");
$phone_row = field_build_row(2);

for($xxp = 0; $xxp<$max_phone; $xxp++) {

    if(isset($suggestphone[$xxp])) { $the_suggestphone = $suggestphone[$xxp]; }
    else { $the_suggestphone = 'Alternate Phone'; }

    $pri = '('.($xxp+1).')';

    $phx = array (

	    $phone_row[0],
        field_build_text("phone_label_$xxp", "Phone Number Label $pri", $the_suggestphone),
        field_build_text("phone_number_$xxp", "Phone Number $pri", '(555) 123-4567'),
        $phone_row[1],

    );

    $info_fields['phone'] = array_merge($info_fields['phone'], $phx);

}

?>