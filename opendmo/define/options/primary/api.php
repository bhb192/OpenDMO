<?php

$opendmo_apireturn = urlencode(get_admin_url()."post.php?post=".$opendmo_global['primaryedit']."&action=edit");

$opendmo_keygen_gmaps_url = 'https://console.developers.google.com/henhouse/?pb=["hh-1","maps_backend",null,[],"https://developers.google.com",null,["maps_backend","geocoding_backend","directions_backend","distance_matrix_backend","elevation_backend","places_backend"],null]';
$opendmo_keygen_gmaps = "<a href='$opendmo_keygen_gmaps_url' class='thickbox button-primary'>Get Google Maps API Key</a>";

$opendmo_ig_client = "ce7507bdf8f44231bd9989425562990e";
$opendmo_ig_return = urlencode("http://127.0.0.1");
$opendmo_keygen_ig_url = 'https://api.instagram.com/oauth/authorize/?client_id='.$opendmo_ig_client.'&response_type=token&redirect_uri='.$opendmo_ig_return;
$opendmo_keygen_ig = "<a href='$opendmo_keygen_ig_url' target='_blank' class='button-primary'>Get Instagram API Token</a>";

$optfield = array(

    opendmo_field_build_tab("API Keys"),
    opendmo_field_build_text("opt_opendmo_google_maps_key", "Google Maps"),
    opendmo_field_build_message($opendmo_keygen_gmaps),
    opendmo_field_build_text("opt_opendmo_instagram_token", "Instagram"),
    opendmo_field_build_message($opendmo_keygen_ig),

);


