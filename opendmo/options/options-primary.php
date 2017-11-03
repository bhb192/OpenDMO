<?php

$opt_primary_list = array("limits", "social", "api");
$primary_opt_fields = array();

foreach($opt_primary_list as $odo) {

    include("options-$odo.php");
    $primary_opt_fields = array_merge($primary_opt_fields,$opendmo_opt[$odo]);

}    

register_field_group(array (

    "id" => "acf_opendmo-primary",
    "title" => "OpenDMO Options",
    "fields" => $primary_opt_fields,
    "location" => array( array( 

        array(

            "param" => "post_type",
            "operator" => "==",
            "value" => "opendmo-options",
            "order_no" => 1,
            "group_no" => 1,

        ),

        array(

            "param" => "post",
            "operator" => "==",
            "value" => $po,
            "order_no" => 1,
            "group_no" => 1,

        )


    )),
    "options" => array (
        "position" => "normal",
        "layout" => "no_box",
        "hide_on_screen" => array (),
    ),
    "menu_order" => 0,

));


?>
