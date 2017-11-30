<?php

$gmapskey = $opendmo_global['options_meta']['opt_opendmo_google_maps_key'][0];     
opendmo_home_css('map');
opendmo_home_meta("<div class='opendmo'><h3>Points of Interest</h3>",'map');
opendmo_home_meta("<div id='opendmo_archive_googlemap'>",'map');
opendmo_home_meta('<div id="googlemap" class="googlemap"></div><div id="capture"></div>','map');
opendmo_home_meta("</div></div>",'map');
opendmo_home_meta('<script src="https://maps.googleapis.com/maps/api/js?key='.$gmapskey.'&callback=initMap" async defer></script>','map');
opendmo_home_meta("<script>".file_get_contents($opendmo_global['path']."js/map.js"),'map');
opendmo_home_meta("function makePins() {", 'map');

$pins = $wpdb->get_results( 'SELECT * FROM wp_postmeta WHERE (meta_key LIKE "postmeta_opendmo%address%" OR meta_key LIKE "postmeta_opendmo_text_gps%") AND post_id IN ("'.$allposts.'") AND meta_value LIKE "_%"',ARRAY_A);

$npins = array();
foreach($pins as $pin) {

    $ikey = $pin['post_id'];
    $mkey = $pin['meta_key'];
    $vkey = $pin['meta_value'];

    if(strpos($mkey,"_select_") > 0 ) {

        $dkey = get_field_object($mkey, $ikey);
        $vkey = $dkey['choices'][$vkey];
        
    }
    
    $mkey = array_slice(explode("_",$mkey),3);        
    if(strlen($vkey) > 0) { $npins[$ikey][$mkey[0]][$mkey[2]][$mkey[1]] = $vkey; }
    
}
$pins = $npins;
unset($npins);

$totalpins = 0;
foreach($pins as $pin) { $totalpins = $totalpins+count($pin); }

foreach($pins as $pin) {
    
    if(isset($pin['address'])) {

        foreach($pin['address'] as $adr) {

            $line = $adr['line'].", ".$adr['city']." ".$adr['zip'];
            if(isset($adr['label'])) { opendmo_home_meta("codeAddress('$line','".$adr['label']."');", 'map'); }
            else { opendmo_home_meta("codeAddress('$line');", 'map'); }

        }

    }

    if(isset($pin['gps'])) {

        foreach($pin['gps'] as $gps) {

            opendmo_home_meta("var gpspin = new google.maps.LatLng(".$gps['lat'].", ".$gps['long'].");", 'map');

            if(isset($gps['label'])) { opendmo_home_meta("addPin(gpspin,'".$gps['label']."');", 'map'); }                    
            else { opendmo_home_meta("addPin(gpspin);", 'map'); }

        }

    }
    
}

opendmo_home_meta("}", 'map');
opendmo_home_meta('</script>','map');

