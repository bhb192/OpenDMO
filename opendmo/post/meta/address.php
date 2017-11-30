<?php

if(isset($meta["text_address_line_0"]) && isset($meta["select_address_city_0"])) {

    $a = 0;

    opendmo_add_meta("<h4>Address</h4>",'meta');
    opendmo_add_meta("<ul>",'meta');

    while(isset($meta["text_address_line_$a"])) {

        opendmo_add_meta("<li>",'meta');

        if(isset($meta["text_address_label_$a"])) {

            opendmo_add_meta("<h5>".$meta["text_address_label_$a"]."</h5>",'meta');

        }

        $cityzip = $meta["select_address_city_".$a."_display"];
        $cityzip = $cityzip." ".$meta["select_address_zip_".$a."_display"];

        opendmo_add_meta("".$meta["text_address_line_$a"]."<br>".$cityzip,'meta');
        opendmo_add_meta("</li>",'meta');

        $a++;

    }

    opendmo_add_meta("</ul>",'meta');

}

