<?php

$theiz = array();

for($mz=0; $mz<$opendmo_set_limit['zipcode']; $mz++) {

    $izrow = field_build_row(3);
    $izdx = "(".($mz+1).")";

    $iz[0] = $izrow[0];
    $iz[1] = field_build_text("","City/Town $izdx","Schenectady");
    $iz[1]['name'] = "opt_opendmo_city_$mz";
    $iz[2] = field_build_text("","State $izdx","NY",'','',2);
    $iz[2]['name'] = "opt_opendmo_state_$mz";
    $iz[3] = field_build_text("","Zip Code $izdx","12345",'','',5);
    $iz[3]['name'] = "opt_opendmo_zip_$mz";
    $iz[4] = $izrow[1];

    $theiz = array_merge($theiz, $iz);

}

$zipreturn = field_build_message("<a href='$primaryediturl'><h3>&laquo; Return to Primary Options</h3></a>");
$theiz = array_merge($theiz, array($zipreturn));

register_field_group(array (

    "id" => "acf_opendmo-zip",
    "title" => "OpenDMO Zip Codes",
    "fields" => $theiz,
    "location" => array( array( 

        array(

            "param" => "post",
            "operator" => "==",
            "value" => $zo,
            "order_no" => 1,
            "group_no" => 1,

        ),

    )),
    "options" => array (
        "position" => "normal",
        "layout" => "no_box",
        "hide_on_screen" => array (),
    ),
    "menu_order" => 1,

));        


?>
