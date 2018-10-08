<?php

$redrz = array(opendmo_field_build_tab("Redirects"));
$rd_suggest = array(
    
    "(this will be auto generated)",
    "/quick",
    "/commercial",
    "/adventures",
    "/social",
    
);

if(isset($_GET['post'])) {
    
    $currentp = get_post($_GET['post']);
    $firstshort = get_post_meta($currentp->ID,"postmeta_opendmo_text_redirect_0",true);

    for($r=0;$r<$opendmo_global['set_limit']['redirect'];$r++) {

        $rdrow = opendmo_field_build_row(2);
        $the_rds = "";
        if(isset($rd_suggest[$r])) { $the_rds = $rd_suggest[$r]; }

        $redrz = array_merge($redrz, array(

            $rdrow[0],
            opendmo_field_build_text("redirect_$r","Redirect Capture URL",$the_rds),
            opendmo_field_build_message("<strong>Redirect Target URL</strong><br />".get_permalink($currentp->ID)." (this post)"),
            $rdrow[1],

        ));

    }

    $redrz = array_merge($redrz,array(opendmo_field_build_tab("Google Analytics")));

    for($r=0;$r<$opendmo_global['set_limit']['redirect'];$r++) {

        $rdrow = opendmo_field_build_row(2);
        $the_rds = "";
        if(isset($rd_suggest[$r])) { $the_rds = $rd_suggest[$r]; }

        $redrz = array_merge($redrz, array(

            $rdrow[0],
            opendmo_field_build_text("redirect_ga_url_$r","Redirect Capture URL",$the_rds),
            opendmo_field_build_text("redirect_ga_campaign_$r","GA Campaign String","?campaign=magazinead"),
            $rdrow[1],

        ));

    }
    
}

opendmo_fields_register("Redirects", $redrz, 4);

