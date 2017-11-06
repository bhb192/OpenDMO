<?php

$optfields = array();

foreach (glob($opendmo_path."define/options/primary/*.php") as $filename) {

    $optfield = array();
    include $filename;
    $optfields = array_merge($optfields, $optfield);

}

register_primary_opt($optfields,0);
register_primary_opt(array(field_build_message("<a href='".$zipediturl."'>Edit Zip Codes &raquo;</a>")),1);

function register_primary_opt($of,$i) {

    global $po;

    register_field_group(array (

        "id" => "acf_opendmo-primary-$i",
        "title" => "OpenDMO Options",
        "fields" => $of,
        "location" => array( array( 

            array(

                "param" => "post",
                "operator" => "==",
                "value" => $po,
                "order_no" => $i,
                "group_no" => $i,

            )

        )),
        "options" => array (
            "position" => "normal",
            "layout" => "no_box",
            "hide_on_screen" => array (),
        ),
        "menu_order" => 0,

    ));

}


?>
