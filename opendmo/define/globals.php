<?php

//global variables

$opendmo_global = array(

    'path' => $opendmo_path,

    'primaryedit' => 0,
    'zipedit' => 0,
    'options_meta' => array(),
    'zip_meta' => array(),
    'postmeta' => array(),
    'set_limit' => array(),
    'cpt_names' => array(),

    'default_cpt_names' => array(

        'attractions', 
        'culture', 
        'eat', 
        'event', 
        'meet', 
        'places', 
        'shop', 
        'sports', 
        'stay',

    ),

    'default_social_media' => array(

        "Twitter", 
        "Facebook", 
        "YouTube", 
        "Instagram", 
        "Pinterest", 
        "AirBnB", 
        "TripAdvisor",
    
    ),

    'default_limit' => array(

        "address" => 3,
        "phone" => 3,
        "gps_pair" => 5,
        "event_date" => 15,
        "ext_links" => 3,
        "social_links" => 10,
        "zipcode" => 20,
        "post_type" => 10,
        "redirect" => 5,

    ),

    'acfoutput' => array_fill_keys(array(

        'post-before',
        'post-after',
        'meta-before',
        'meta',
        'meta-after',
        'cpt-before',
        'cpt',
        'cpt-after',

    ),''),

);

?>
