<?php

global $opendmo_default_limit;

$opendmo_default_limit = array(

    "address" => 10,
    "phone" => 3,
    "gps_pair" => 10,
    "event_date" => 15,
    "ext_links" => 10,
    "social_links" => 10,
    "zipcode" => 25,

);

$opendmo_opt["limits"] = array(

    array(

        "key" => "field_dij39ej9sk",
        "label" => "Limits",
        "name" => "opendmo-opt-limits-tab",
        "type" => "tab"

    ),

    array (
        "key" => "field_dj3wkerwrr7h37",
        "label" => "Phone",
        "name" => "opendmo_phone_total",
        "type" => "text",
        "default_value" => $opendmo_default_limit['phone'],
        "allow_null" => 0,
        "multiple" => 0,
    ),

    array (
        "key" => "field_djkh27h37",
        "label" => "Address",
        "name" => "opendmo_adr_total",
        "type" => "text",
        "default_value" => $opendmo_default_limit['address'],
        "allow_null" => 0,
        "multiple" => 0,
    ),

    array (
        "key" => "field_3jhd3hu3d",
        "label" => "GPS Coordinate Pairs",
        "name" => "opendmo_gps_total",
        "type" => "text",
        "default_value" => $opendmo_default_limit['gps_pair'],
        "allow_null" => 0,
        "multiple" => 0,
    ),

    array (
        "key" => "field_3dhi43fhd4j3",
        "label" => "Event Dates",
        "name" => "opendmo_event_dates_total",
        "type" => "text",
        "default_value" => $opendmo_default_limit['event_date'],
        "allow_null" => 0,
        "multiple" => 0,
    ),

    array (
        "key" => "field_i4rhj4rh3ir2",
        "label" => "External Links",
        "name" => "opendmo_ext_links_total",
        "type" => "text",
        "default_value" => $opendmo_default_limit['ext_links'],
        "allow_null" => 0,
        "multiple" => 0,
    ),

    array (
        "key" => "field_h43rh3498f4",
        "label" => "Social Links",
        "name" => "opendmo_social_links_total",
        "type" => "text",
        "default_value" => $opendmo_default_limit['social_links'],
        "allow_null" => 0,
        "multiple" => 0,
    ),

    array (
        "key" => "field_dsakdjwlqksj",
        "label" => "Number of Zip Codes",
        "name" => "opendmo_zip_total",
        "type" => "text",
        "default_value" => $opendmo_default_limit['zipcode'],
        "allow_null" => 0,
        "multiple" => 0,
    ),

    array (
        "key" => "field_jdsoaalska",
        "label" => "",
        "name" => "opendmo_zipoptions",
        "type" => "message",
        "message" => "<a href='$zipedit'>Edit Zip Codes &raquo;</a>",

    ),

);

?>
