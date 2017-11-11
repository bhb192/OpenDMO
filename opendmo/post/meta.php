<?php

//safeout($opendmo_postmeta);

opendmo_add_meta("<div id='opendmo_postmeta'>",'meta');

foreach (glob($opendmo_global['path']."post/meta/*.php") as $filename) {

    $fname = pathinfo($filename, PATHINFO_FILENAME);
    $mhook = 'meta';
    if($fname == 'gps') { $mhook = 'meta-after'; }

    opendmo_add_meta("<div id='opendmo_postmeta_$fname'>",$mhook);
    include $filename;
    opendmo_add_meta("</div>",$mhook);

}

opendmo_add_meta("</div>",'meta');





?>
