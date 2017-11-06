<?php

global $opendmo_cpt_names;
$build_cpt_fields = array();

$sortoptions = array (

    "az" => "Alphanumerical",
    "mr" => "Most Recent",
);

foreach($opendmo_cpt_names as $o=>$odcpt) {

    $odcptnice = ucfirst($odcpt);
    if(substr($odcptnice, -1) != "s") { $odcptnice = $odcptnice."s"; }

    $itcfrow = field_build_row(array(2,3));

    $itcf = array(
    
        field_build_tab(ucfirst($odcpt)),
        field_build_message("", "cpt_tax_content_$odcpt"),
        field_build_message("<strong>Display Options</strong>"),
        $itcfrow[0]['open'],
        field_build_text("cpt_label_$odcpt","Post Type Label","","Nearby $odcptnice"),
        field_build_number("cpt_priority_$odcpt", "List Priority", 1, count($opendmo_cpt_names), 1, ($o+1)),
        $itcfrow[0]['close'],
        $itcfrow[1]['open'],
        field_build_boolean("cpt_showinline_$odcpt", "Show Inline"),
        field_build_color("cpt_bg_$odcpt","BG Color"),
        field_build_select("cpt_sort_$odcpt", "Sort", 0, $sortoptions, "az"),
        $itcfrow[0]['close'],

    );

    $build_cpt_fields = array_merge($build_cpt_fields, $itcf);

}

register_field_group(array (

    "id" => "acf_opendmo-rp",
    "title" => "OpenDMO Related Post Options",
    "fields" => $build_cpt_fields,
    "location" => (fields_location(0)),
    "options" => array (
        "position" => "normal",
        "layout" => "default",
        "hide_on_screen" => array (),
    ),
    "menu_order" => 0,

));


?>
