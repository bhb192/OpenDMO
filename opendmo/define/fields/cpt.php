<?php

$itcf = array();
$cpt = $opendmo_global['cpt_names'];

$sortoptions = array (

    "az" => "Alphanumerical",
    "mr" => "Most Recent",
);

$listpriority = range(1,count($opendmo_global['cpt_names']),1);

foreach($cpt as $o=>$odcpt) {

    $odcptnice = ucfirst($odcpt);
    if(substr($odcptnice, -1) != "s") { $odcptnice = $odcptnice."s"; }
    $itcfrow = opendmo_field_build_row(array(2,3));

    $itcf = array_merge($itcf, array(
    
        opendmo_field_build_tab(ucfirst($odcpt)),
        $itcfrow[0]['open'],
        opendmo_field_build_text("cpt_label_$odcpt","Post Type Label","","Nearby $odcptnice"),
        opendmo_field_build_select("cpt_priority_$odcpt", "List Priority", 0, $listpriority, $o),
        $itcfrow[0]['close'],
        $itcfrow[1]['open'],
        opendmo_field_build_boolean("cpt_showinline_$odcpt", "Show Inline"),
        opendmo_field_build_color("cpt_bg_$odcpt","BG Color"),
        opendmo_field_build_select("cpt_sort_$odcpt", "Sort", 0, $sortoptions, "az"),
        $itcfrow[0]['close'],
        opendmo_field_build_postobj("cpt_related_$odcpt","Choose Related $odcptnice", array($odcpt), 1),

    ));

}

opendmo_fields_register("Related Post Options", $itcf, 3);

