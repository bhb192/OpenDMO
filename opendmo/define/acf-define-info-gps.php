<?php

$maxgps = $opendmo_options_meta['opendmo_gps_total'][0];
if(!$maxgps > 0) { $maxgps = $opendmo_default_limit['gps_pair']; } 

$info_fields['gps'] = array(field_build_tab('GPS'));

$suggestgps = array("Parking Lot", "Scenic Viewpoint", "Picnic Area");
$the_suggestgps = '';

for($gxx = 0; $gxx<$maxgps; $gxx++) {

    if(isset($suggestgps[$gxx])) { $the_suggestgps = $suggestgps[$gxx]; }
    else { $the_suggestgps = 'Other Landmark'; }

    $gpsrow = field_build_row(3);

    $gx = array(

        $gpsrow[0],
        field_build_text("gps_label_$gxx", "GPS Label (".($gxx+1).")", $the_suggestgps),
        field_build_text("gps_lat_$gxx", "GPS Latitude (".($gxx+1).")", "42.839292"),
        field_build_text("gps_long_$gxx", "GPS Longitude (".($gxx+1).")", "-24.292938"),
        $gpsrow[1],

    );

    $info_fields['gps'] = array_merge($info_fields['gps'], $gx);

}

?>