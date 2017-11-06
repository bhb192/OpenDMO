<?php

if(isset($opendmo_postmeta["text_phone_number_0"])) {

    $p = 0;

    opendmo_add_meta("<h5>Phone Number</h5>");
    opendmo_add_meta("<ul>");

    while(isset($opendmo_postmeta["text_phone_number_$p"])) {

        opendmo_add_meta("<li>");

        if(isset($opendmo_postmeta["text_phone_label_$p"])) {

            opendmo_add_meta("<span>".$opendmo_postmeta["text_phone_label_$p"].": </span>");

        }

        opendmo_add_meta($opendmo_postmeta["text_phone_number_$p"]);

        opendmo_add_meta("</li>");

        $p++;

    }

    opendmo_add_meta("</ul>");

}

?>
