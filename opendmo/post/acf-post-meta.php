<?php

    $the_meta_fields = array('hours', 'phone', 'address', 'gps', 'links', 'social');

    foreach($the_meta_fields as $the_mf) {

        include($opendmo_path.'post/acf-post-meta-'.$the_mf.'.php');

    }

?>
