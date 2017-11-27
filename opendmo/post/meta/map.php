<?php

if(isset($meta["text_address_line_0"]) && isset($meta["select_address_city_0"])) {

    $a = 0;

    while(isset($meta["text_address_line_$a"])) {

        $cityzip = $meta["select_address_city_".$a."_display"];
        $cityzip = $cityzip." ".$meta["select_address_zip_".$a."_display"];

        $pins_adr[$a][0] = $meta["text_address_line_$a"].", ".$cityzip;
        
        if(isset($meta["text_address_label_$a"])) {

            $pins_adr[$a][1] = "<strong>".$meta["text_address_label_$a"]."</strong><br>".$meta["text_address_line_$a"]."<br>".$cityzip;

        }

        $a++;

    }

}

if(isset($meta["text_gps_lat_0"]) && isset($meta["text_gps_long_0"])) {

    $g = 0;

    while(isset($meta["text_gps_lat_$g"]) && isset($meta["text_gps_long_$g"]) ) {

        $pins_gps[$g][0] = $meta["text_gps_lat_$g"];
        $pins_gps[$g][1] = $meta["text_gps_long_$g"];
        
        if(isset($meta["text_gps_label_$g"])) {

            $pins_gps[$g][2] = "<strong>".$meta["text_gps_label_$g"]."</strong><br>".$pins_gps[$g][0].", ".$pins_gps[$g][1];

        }

        $g++;

    }

}

if(isset($pins_adr) || isset($pins_gps)) {
    
    if(isset($opendmo_global['options_meta']['opt_opendmo_google_maps_key'][0])) {
    
        if(strlen($opendmo_global['options_meta']['opt_opendmo_google_maps_key'][0])>30) {
            
            $totalpins = 0;            
            if(isset($pins_adr)) { $totalpins = count($pins_adr); }
            if(isset($pins_gps)) { $totalpins = $totalpins+count($pins_gps);}
            
            $gmapskey = $opendmo_global['options_meta']['opt_opendmo_google_maps_key'][0];      
            opendmo_add_meta("<div id='opendmo_postmeta_googlemap'>",'map');
            opendmo_add_meta('<div id="googlemap" class="googlemap"></div><div id="capture"></div>','map');
            opendmo_add_meta("</div>",'map');

            opendmo_add_meta('<script src="https://maps.googleapis.com/maps/api/js?key='.$gmapskey.'&callback=initMap"
        async defer></script>','map');
            opendmo_add_meta("<script>".file_get_contents($opendmo_global['path']."js/map.js"),'map');
            
            opendmo_add_meta("function makePins() {", 'map');
            
                if(isset($pins_adr)) {

                    foreach($pins_adr as $adr) {

                        if(isset($adr[1])) { opendmo_add_meta("codeAddress('".$adr[0]."','".$adr[1]."');", 'map'); }
                        else { opendmo_add_meta("codeAddress('".$adr[0]."');", 'map'); }


                    }

                }

                if(isset($pins_gps)) {

                    foreach($pins_gps as $gps) {

                        opendmo_add_meta("var gpspin = new google.maps.LatLng(".$gps[0].", ".$gps[1].");", 'map');

                        if(isset($gps[2])) { opendmo_add_meta("addPin(gpspin,'".$gps[2]."');", 'map'); }                    
                        else { opendmo_add_meta("addPin(gpspin)", 'map'); }

                    }

                }
            
            opendmo_add_meta("}",'map');

            opendmo_add_meta("</script>",'map');

        }

    }
    
}

?>