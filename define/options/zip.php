<?php

$primaryedit = "post.php?post=$po&action=edit";
$theiz = array();

for($mz=0; $mz<$opendmo_global['set_limit']['zipcode']; $mz++) {

    $izrow = opendmo_field_build_row(3);
    $izdx = "(".($mz+1).")";

    $theiz = array_merge($theiz, array(

        $izrow[0],
        opendmo_field_build_text("opt_opendmo_city_$mz","City/Town $izdx","Schenectady"),
        opendmo_field_build_text("opt_opendmo_state_$mz","State $izdx","NY",'','',2),
        opendmo_field_build_text("opt_opendmo_zip_$mz","Zip Code $izdx","12345(6)",'','',6),
        $izrow[1],

    ));

}

$zipreturn = opendmo_field_build_message("<a href='$primaryedit'><h3>&laquo; Return to Primary Options</h3></a>");
$theiz = array_merge($theiz, array($zipreturn));

opendmo_opt_fields_register($theiz, $zo);     


