<?php

if(isset($opendmo_postmeta["text_address_line_0"]) && isset($opendmo_postmeta["select_address_city_0"])) {

    $a = 0;

    opendmo_add_meta("<h5>Address</h5>",'meta');
    opendmo_add_meta("<ul>",'meta');

    while(isset($opendmo_postmeta["text_address_line_$a"])) {

        opendmo_add_meta("<li>",'meta');

        if(isset($opendmo_postmeta["text_address_label_$a"])) {

            opendmo_add_meta("<em>".$opendmo_postmeta["text_address_label_$a"]."</em><br />",'meta');

        }

        $cityzip = $opendmo_postmeta["select_address_city_".$a."_display"];
        $cityzip = $cityzip." ".$opendmo_postmeta["select_address_zip_".$a."_display"];

        opendmo_add_meta("".$opendmo_postmeta["text_address_line_$a"]."<br />$cityzip",'meta');
        opendmo_add_meta("</li>",'meta');

        $a++;

    }

    opendmo_add_meta("</ul>",'meta');

}

?>
