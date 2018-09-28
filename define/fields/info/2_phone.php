<?php

$info_fields = array( opendmo_field_build_tab('Phone') );

$suggestphone = array("Phone Number", "Daytime Phone", "Evening Phone");
$phone_row = opendmo_field_build_row(2);

for($xxp = 0; $xxp<$limit['phone']; $xxp++) {

    if(isset($suggestphone[$xxp])) { $the_suggestphone = $suggestphone[$xxp]; }
    else { $the_suggestphone = 'Alternate Phone'; }

    $pri = '('.($xxp+1).')';

    $info_fields = array_merge($info_fields, array (

	    $phone_row[0],
        opendmo_field_build_text("phone_label_$xxp", "Phone Number Label $pri", $the_suggestphone),
        opendmo_field_build_text("phone_number_$xxp", "Phone Number $pri", '(555) 123-4567'),
        $phone_row[1],

    ));

}

