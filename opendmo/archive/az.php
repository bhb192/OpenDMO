<?php

opendmo_archive_meta("<h3>".ucfirst(opendmo_makeplural($cpt))." A-Z</h3>",'az');

$az = get_posts(array(

    'post_type' => $cpt,
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'order' => ASC,
    'orderby' => 'title',

));

$az = wp_list_pluck($az, "ID");

foreach($az as $id) {
    
    opendmo_archive_putinrow($id,3);    
    
}

opendmo_archive_meta("<div class='opendmo_az_grid'>",'az');
opendmo_archive_meta(opendmo_archive_putinrow(0),'az');
opendmo_archive_meta("<div class='clear'></div></div>",'az');