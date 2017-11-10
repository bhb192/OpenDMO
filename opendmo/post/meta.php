<?php

//safeout($opendmo_postmeta);

opendmo_add_meta("<div id='opendmo_postmeta'>",'meta');

foreach (glob($opendmo_global['path']."post/meta/*.php") as $filename) {

    opendmo_add_meta("<div id='opendmo_postmeta_$the_mf'>",'meta');
    include $filename;
    opendmo_add_meta("</div>",'meta');

}

opendmo_add_meta("</div>",'meta');





?>
