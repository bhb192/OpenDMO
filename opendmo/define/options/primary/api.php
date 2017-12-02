<?php

$opendmo_apireturn = urlencode(get_admin_url()."post.php?post=".$opendmo_global['primaryedit']."&action=edit");
$opendmo_thickbox = '&TB_iframe=true&width=600&height=400';

$opendmo_keygen_gmaps_url = 'https://console.developers.google.com/henhouse/?pb=["hh-1","maps_backend",null,[],"https://developers.google.com",null,["maps_backend","geocoding_backend","directions_backend","distance_matrix_backend","elevation_backend","places_backend"],null]'.$opendmo_thickbox;
$opendmo_keygen_gmaps = "<a href='$opendmo_keygen_gmaps_url' class='thickbox button-primary'>Get Google Maps API Key</a>";

$opendmo_ig_client = "ce7507bdf8f44231bd9989425562990e";
$opendmo_keygen_ig_url = 'https://api.instagram.com/oauth/authorize/?client_id='.$opendmo_ig_client.'&scope=basic+public_content&response_type=code&redirect_uri=http://api.opendmo.org/instagram/?return_url='.$opendmo_apireturn.$opendmo_thickbox;
$opendmo_keygen_ig = "<a href='$opendmo_keygen_ig_url' class='thickbox button-primary'>Get Instagram API Token</a>";

$optfield = array(

    opendmo_field_build_tab("API Keys"),
    opendmo_field_build_text("opt_opendmo_google_maps_key", "Google Maps"),
    opendmo_field_build_message($opendmo_keygen_gmaps),
    opendmo_field_build_text("opt_opendmo_instagram_token", "Instagram"),
    opendmo_field_build_message($opendmo_keygen_ig),
    opendmo_field_build_message(add_thickbox()),

);


