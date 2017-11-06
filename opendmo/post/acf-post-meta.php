<?php

    $the_meta_fields = array('hours', 'phone', 'address', 'gps', 'links', 'social');

//opendmo_add_meta("<pre>";print_r($opendmo_postmeta);opendmo_add_meta("</pre>";

    opendmo_add_meta("<div id='opendmo_postmeta'>");

    foreach($the_meta_fields as $the_mf) {

        opendmo_add_meta("<div id='opendmo_postmeta_$the_mf'>");
        include($opendmo_path.'post/acf-post-meta-'.$the_mf.'.php');
        opendmo_add_meta("</div>");

    }

    opendmo_add_meta("</div>");

?>
