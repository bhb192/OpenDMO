<?php

$eventhook = 'post-after';

if(isset($opendmo_postmeta['postobj_evs'][0])) {

    $thevenue = $opendmo_postmeta['postobj_evs'][0]->ID;
    $venuename = $opendmo_postmeta['postobj_evs'][0]->post_title;
    $venuelink = get_post_permalink($thevenue);

    if(has_excerpt($thevenue)) {

        $venuedesc = get_the_excerpt($thevenue);

    }

    opendmo_add_meta("<div id='opendmo_evs'>", $eventhook);
    opendmo_add_meta("<h5>Event Venue</h5>", $eventhook);
    opendmo_add_meta("<ul><li>",$eventhook);
    opendmo_add_meta("<a href='".$venuelink."'>",$eventhook);
    opendmo_add_meta("<h6>".$venuename."</h6>",$eventhook);
    opendmo_add_meta("</a>",$eventhook);

    if(isset($venuedesc)) {

        opendmo_add_meta($venuedesc, $eventhook);

    }

    opendmo_add_meta("</li></ul>", $eventhook);

}




?>
