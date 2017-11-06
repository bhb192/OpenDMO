<?php

if(isset($opendmo_postmeta["text_gps_lat_0"]) && isset($opendmo_postmeta["text_gps_long_0"])) {

    $g = 0;

    opendmo_add_meta("<h5>GPS Coordinates</h5>");
    opendmo_add_meta("<ul>");

    while( isset($opendmo_postmeta["text_gps_lat_$g"]) && isset($opendmo_postmeta["text_gps_long_$g"]) ) {

        opendmo_add_meta("<li>");

        if(isset($opendmo_postmeta["text_gps_label_$g"])) {

            opendmo_add_meta("<span>".$opendmo_postmeta["text_gps_label_$g"].": </span>");

        }

        $latlong = $opendmo_postmeta["text_gps_lat_$g"];
        $latlong = $latlong.", ".$opendmo_postmeta["text_gps_long_$g"];
        opendmo_add_meta($latlong);
        opendmo_add_meta("</li>");

        $g++;

    }

    opendmo_add_meta("</ul>");

}

?>
