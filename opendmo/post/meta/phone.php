<?php

if(isset($meta["text_phone_number_0"])) {

    $p = 0;

    opendmo_add_meta("<h4>Phone Number</h4>",'meta');
    opendmo_add_meta("<ul>",'meta');

    while(isset($meta["text_phone_number_$p"])) {

        opendmo_add_meta("<li>",'meta');

        if(isset($meta["text_phone_label_$p"])) {

            opendmo_add_meta("<span>".$meta["text_phone_label_$p"].": </span>",'meta');

        }

        opendmo_add_meta($meta["text_phone_number_$p"],'meta');

        opendmo_add_meta("</li>",'meta');

        $p++;

    }

    opendmo_add_meta("</ul>",'meta');

}

?>
