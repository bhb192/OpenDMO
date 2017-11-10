<?php

if(isset($meta["text_gps_lat_0"]) && isset($meta["text_gps_long_0"])) {

    $g = 0;

    opendmo_add_meta("<h4>GPS Coordinates</h4>",'meta-after');
    opendmo_add_meta("<ul>",'meta-after');

    while( isset($meta["text_gps_lat_$g"]) && isset($meta["text_gps_long_$g"]) ) {

        opendmo_add_meta("<li>",'meta-after');

        if(isset($meta["text_gps_label_$g"])) {

            opendmo_add_meta("<span>".$meta["text_gps_label_$g"].": </span>",'meta-after');

        }

        $latlong = $meta["text_gps_lat_$g"];
        $latlong = $latlong.", ".$meta["text_gps_long_$g"];
        opendmo_add_meta($latlong,'meta-after');
        opendmo_add_meta("</li>",'meta-after');

        $g++;

    }

    opendmo_add_meta("</ul>",'meta-after');

}

?>
