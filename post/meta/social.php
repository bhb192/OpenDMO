<?php

if(isset($meta["select_social_domain_0"]) && isset($meta["text_social_url_0"])) {

    $s = 0;

    opendmo_add_meta("<h4>Social Media</h4>",'meta');
    opendmo_add_meta("<ul>",'meta');

    while(isset($meta["select_social_domain_$s"]) && isset($meta["text_social_url_$s"])) {

        opendmo_add_meta("<li>",'meta');

        $socialprofile = $meta["text_social_url_$s"];
        $socialurl = $meta["select_social_domain_$s"].$socialprofile;
        $socialname = $meta["select_social_domain_".$s."_display"];

        if(strpos($socialprofile, "/")===FALSE && strlen($socialprofile) < 20) {

            $socialname = $socialname." (@".$socialprofile.")";

        }

        opendmo_add_meta("<a href='$socialurl'>$socialname</a>",'meta');
        opendmo_add_meta("</li>",'meta');

        $s++;

    }

    opendmo_add_meta("</ul>",'meta');

}

