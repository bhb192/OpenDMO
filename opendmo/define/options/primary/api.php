<?php

$opendmo_keygen_gmaps_url = 'https://console.developers.google.com/henhouse/?pb=["hh-1","maps_backend",null,[],"https://developers.google.com",null,["maps_backend","geocoding_backend","directions_backend","distance_matrix_backend","elevation_backend","places_backend"],null]&TB_iframe=true&width=600&height=400';
$opendmo_keygen_gmaps = "<a href='$opendmo_keygen_gmaps_url' class='thickbox button-primary'>Get Google Maps API Key</a>";

$optfield = array(

    opendmo_field_build_tab("API Keys"),
    opendmo_field_build_text("opt_opendmo_google_maps_key", "Google Maps"),
    opendmo_field_build_message(add_thickbox().$opendmo_keygen_gmaps),
    opendmo_field_build_text("opt_opendmo_instagram_token", "Instagram"),

);


