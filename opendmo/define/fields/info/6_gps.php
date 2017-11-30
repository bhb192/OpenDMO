<?php

$info_fields = array(opendmo_field_build_tab('GPS'));

$suggestgps = array("Parking Lot", "Scenic Viewpoint", "Picnic Area");
$the_suggestgps = '';

for($gxx = 0; $gxx<$limit['gps_pair']; $gxx++) {

    if(isset($suggestgps[$gxx])) { $the_suggestgps = $suggestgps[$gxx]; }
    else { $the_suggestgps = 'Other Landmark'; }

    $gpsrow = opendmo_field_build_row(3);

    $gx = array(

        $gpsrow[0],
        opendmo_field_build_text("gps_label_$gxx", "GPS Label (".($gxx+1).")", $the_suggestgps),
        opendmo_field_build_text("gps_lat_$gxx", "GPS Latitude (".($gxx+1).")", "42.839292"),
        opendmo_field_build_text("gps_long_$gxx", "GPS Longitude (".($gxx+1).")", "-24.292938"),
        $gpsrow[1],

    );

    $info_fields = array_merge($info_fields, $gx);

}

