<?php

if(isset($opendmo_postmeta["text_gps_lat_0"]) && isset($opendmo_postmeta["text_gps_long_0"])) {

    $g = 0;

    opendmo_add_meta("<h5>GPS Coordinates</h5>",'meta-after');
    opendmo_add_meta("<ul>",'meta-after');

    while( isset($opendmo_postmeta["text_gps_lat_$g"]) && isset($opendmo_postmeta["text_gps_long_$g"]) ) {

        opendmo_add_meta("<li>",'meta-after');

        if(isset($opendmo_postmeta["text_gps_label_$g"])) {

            opendmo_add_meta("<span>".$opendmo_postmeta["text_gps_label_$g"].": </span>",'meta-after');

        }

        $latlong = $opendmo_postmeta["text_gps_lat_$g"];
        $latlong = $latlong.", ".$opendmo_postmeta["text_gps_long_$g"];
        opendmo_add_meta($latlong,'meta-after');
        opendmo_add_meta("</li>",'meta-after');

        $g++;

    }

    opendmo_add_meta("</ul>",'meta-after');

}

?>
