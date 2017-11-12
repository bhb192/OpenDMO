<?php

$eventhook = 'post-after';
$thevenue = '';

if(isset($meta['postobj_evs'])) {

    opendmo_add_meta("<div id='opendmo_event'>", $eventhook);

    $thevenue = $meta['postobj_evs']->ID;

    if($thevenue != get_the_ID()) {

        $venuename = $meta['postobj_evs']->post_title;
        $venuelink = get_post_permalink($thevenue);
        $venueinfo = opendmo_clean_meta($thevenue);

        if(has_excerpt($thevenue)) {

            $venuedesc = get_the_excerpt($thevenue);

        }

        opendmo_add_meta("<h4>Event Venue</h4>", $eventhook);
        opendmo_add_meta("<ul><li>",$eventhook);
        opendmo_add_meta("<a href='".$venuelink."'>",$eventhook);
        opendmo_add_meta("<h5>".$venuename."</h5>",$eventhook);
        opendmo_add_meta("</a>",$eventhook);
        
        $iv=0;

        if(isset($venueinfo["text_address_line_0"])) {

            $cityzip = $venueinfo["select_address_city_0_display"];
            $cityzip = $cityzip." ".$venueinfo["select_address_zip_0_display"];

            $vi[$iv] = $venueinfo["text_address_line_0"]."$cityzip";
            $iv++;

        }

        if(isset($venueinfo["text_phone_number_0"])) {

            $vi[$iv] = $venueinfo["text_phone_number_0"];

        }

        if(isset($venuedesc)) {

            $vi[$iv] = $venuedesc;

        }

        opendmo_add_meta(implode("<br>",$vi)."</li></ul>", $eventhook);

    }

}

if($thevenue != get_the_ID()) {

    $w=0;
    while( isset($meta["datetime_begin_date_$w"]) && isset($meta["datetime_end_date_$w"]) ) { 

        if($w===0) { opendmo_add_meta("<h4>Upcoming Event Dates</h4><ul>", $eventhook); }

        $oamlabel = '';
        if(isset($meta["text_date_label_$w"])) { $oamlabel = "<em>".$meta["text_date_label_$w"]."</em><br />"; }

        $datebegin = "<li>".$oamlabel.$meta["datetime_begin_date_$w"];
        $dateend = $meta["datetime_end_date_$w"]."</li>";
        opendmo_add_meta($datebegin." until ".$dateend, $eventhook);

        $w++;

    }

    if($w>0) { opendmo_add_meta("</ul>", $eventhook); }

}

$eventsearch = get_posts( array(
	'numberposts'	=> -1,
	'post_type'		=> $opendmo_global['cpt_names'],

));

foreach($eventsearch as $es) {

    $v = get_field('postmeta_opendmo_postobj_evs',$es->ID,false);
    
    if($v==get_the_ID()){

        opendmo_add_meta("<h4>Upcoming Events Here</h4><ul>", $eventhook);

        $w=0;
        while(

            strlen(get_field("postmeta_opendmo_datetime_begin_date_$w",$es->ID)) > 0 &&
            strlen(get_field("postmeta_opendmo_datetime_end_date_$w",$es->ID)) > 0

        ){

            $b = get_field("postmeta_opendmo_datetime_begin_date_$w",$es->ID); 
            $e = get_field("postmeta_opendmo_datetime_end_date_$w",$es->ID); 
            $l = get_field("postmeta_opendmo_text_date_label_$w",$es->ID);


            if($es->ID != get_the_ID()) { 

                if(strlen($l)===0) { $l = $es->post_title; }
                else { $l = $es->post_title." (".$l.")"; }

                $u = get_post_permalink($es->ID);
                $l = "<a href='$u'>$l</a>";        

            }

            opendmo_add_meta("<li>", $eventhook);

            if(strlen($l)>0) {
            
                opendmo_add_meta("<em>$l</em><br />", $eventhook);

            }

            opendmo_add_meta("$b until $e</li>", $eventhook);
            $w++;

        }

    }

}

opendmo_add_meta("</ul></div>", $eventhook);

//safeout($meta);

?>
