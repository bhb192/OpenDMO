<?php

$fprows = opendmo_field_build_row(array(2,2,2,1,1));

$optfield = array(

    opendmo_field_build_tab("Front Page"),
    opendmo_field_build_message("<h3>Pinned Content</h3>"),
    $fprows[0]['open'],
    opendmo_field_build_boolean("opt_opendmo_home_show_pinned","Show Pinned Content",'',1),
    $fprows[0]['close'],
    opendmo_field_build_message("<h3>Popular Content</h3>"),
    $fprows[1]['open'],
    opendmo_field_build_boolean("opt_opendmo_home_show_popular","Show Popular Content",'',1),
    opendmo_field_build_number("opt_opendmo_home_max_popular","Max Popular Posts to Show",1,30,1,14),
    $fprows[1]['close'],
    opendmo_field_build_message("<h3>Instagram Posts</h3>"),
    $fprows[2]['open'],
    opendmo_field_build_boolean("opt_opendmo_home_show_instagram","Show Instagram Photos",'',1),
    opendmo_field_build_number("opt_opendmo_home_max_instagram","Max Instagram Photos to Show",1,20,1,10),
    $fprows[2]['close'],
    opendmo_field_build_message("<h3>Event Calendar</h3>"),
    $fprows[3]['open'],
    opendmo_field_build_boolean("opt_opendmo_home_show_calendar","Show Event Calendar",'',1),
    $fprows[3]['close'],
    opendmo_field_build_message("<h3>Map</h3>"),
    $fprows[4]['open'],
    opendmo_field_build_boolean("opt_opendmo_home_show_map","Show Points of Interest Map",'',1),
    $fprows[4]['close'],

);


