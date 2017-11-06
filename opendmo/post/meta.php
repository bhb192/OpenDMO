<?php

safeoutput($opendmo_postmeta);

opendmo_add_meta("<div id='opendmo_postmeta'>",'meta');

foreach (glob($opendmo_path."post/meta/*.php") as $filename) {

    opendmo_add_meta("<div id='opendmo_postmeta_$the_mf'>",'meta');
    include $filename;
    opendmo_add_meta("</div>",'meta');

}

opendmo_add_meta("</div>",'meta');

opendmo_add_meta("<div id='opendmo_cpt'>",'cpt');

$cpt_order = array();

foreach($opendmo_cpt_names as $c=>$the_cpt) {

    $cpt_order[$c] = $opendmo_postmeta["number_cpt_priority_".$the_cpt];

}

asort($cpt_order);
safeoutput($cpt_order);

foreach($cpt_order as $c=>$cpto) {

    $the_cpt = $opendmo_cpt_names[$c];
    include($opendmo_path.'post/cpt.php');

}

opendmo_add_meta("</div>",'cpt');



?>
