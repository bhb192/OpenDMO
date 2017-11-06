<?php

if(isset($opendmo_postmeta["select_social_domain_0"]) && isset($opendmo_postmeta["text_social_url_0"])) {

    $s = 0;

    opendmo_add_meta("<h5>Social Media</h5>",'meta');
    opendmo_add_meta("<ul>",'meta');

    while(isset($opendmo_postmeta["select_social_domain_$s"]) && isset($opendmo_postmeta["text_social_url_$s"])) {

        opendmo_add_meta("<li>",'meta');

        $socialprofile = $opendmo_postmeta["text_social_url_$s"];
        $socialurl = $opendmo_postmeta["select_social_domain_$s"].$socialprofile;
        $socialname = $opendmo_postmeta["select_social_domain_".$s."_display"];

        if(strpos($socialprofile, "/")===FALSE && strlen($socialprofile) < 20) {

            $socialname = $socialname." (@".$socialprofile.")";

        }

        opendmo_add_meta("<a href='$socialurl'>$socialname</a>",'meta');
        opendmo_add_meta("</li>",'meta');

        $s++;

    }

    opendmo_add_meta("</ul>",'meta');

}

?>
