<?php

$extlinkicon = '<span style="width: 1em; height: 1em; display: block-inline;"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 12 12" style="enable-background:new 0 0 12 12;" xml:space="preserve"><g d="Icons" style="opacity:0.75;"><g id="external"><polygon id="box" style="fill-rule:evenodd;clip-rule:evenodd;" points="2,2 5,2 5,3 3,3 3,9 9,9 9,7 10,7 10,10 2,10"/><polygon id="arrow_13_" style="fill-rule:evenodd;clip-rule:evenodd;" points="6.211,2 10,2 10,5.789 8.579,4.368 6.447,6.5 5.5,5.553 7.632,3.421"/></g></g><g id="Guides" style="display:none;"></g></svg></span>';

if(isset($opendmo_postmeta["text_ext_link_url_0"])) {

    $g = 0;

    opendmo_add_meta("<h5>External Links</h5>");
    opendmo_add_meta("<ul>");

    while(isset($opendmo_postmeta["text_ext_link_url_$g"])) {

        opendmo_add_meta("<li>");

        $theurl = $opendmo_postmeta["text_ext_link_url_$g"];

        if(isset($opendmo_postmeta["text_ext_link_label_$g"])) {

            $theurltext = $opendmo_postmeta["text_ext_link_label_$g"];

        }

        else {

            $theurltext = parse_url($theurl, PHP_URL_HOST);
            $theurltext = "Learn more at $theurltext";

        }

        opendmo_add_meta("<a href='$theurl'>$theurltext $extlinkicon</a>");
        opendmo_add_meta("</li>");

        $g++;

    }

    opendmo_add_meta("</ul>");

}

?>
