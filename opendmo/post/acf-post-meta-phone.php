<?php

if(isset($opendmo_postmeta["text_phone_number_0"])) {

    $p = 0;

    opendmo_add_meta("<h5>Phone Number</h5>",'meta');
    opendmo_add_meta("<ul>",'meta');

    while(isset($opendmo_postmeta["text_phone_number_$p"])) {

        opendmo_add_meta("<li>",'meta');

        if(isset($opendmo_postmeta["text_phone_label_$p"])) {

            opendmo_add_meta("<span>".$opendmo_postmeta["text_phone_label_$p"].": </span>",'meta');

        }

        opendmo_add_meta($opendmo_postmeta["text_phone_number_$p"],'meta');

        opendmo_add_meta("</li>",'meta');

        $p++;

    }

    opendmo_add_meta("</ul>",'meta');

}

?>
