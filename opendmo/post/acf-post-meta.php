<?php

    $the_meta_fields = array('hours', 'phone', 'address', 'gps', 'links', 'social');

    safeoutput($opendmo_postmeta);

    opendmo_add_meta("<div id='opendmo_postmeta'>",'meta');

    foreach($the_meta_fields as $the_mf) {

        opendmo_add_meta("<div id='opendmo_postmeta_$the_mf'>",'meta');
        include($opendmo_path.'post/acf-post-meta-'.$the_mf.'.php');
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
        include($opendmo_path.'post/acf-post-meta-cpt.php');

    }

    opendmo_add_meta("</div>");



?>
