<?php

$redrz = array(field_build_tab("Redirects"));
$rd_suggest = array("/social","/quick","/commercial","/adventures","/social");
$currentp = get_post($_GET['post']);
$shortn = "/".strtolower(substr(str_replace(" ","",$currentp->post_title),0,4));

for($r=0;$r<$opendmo_global['set_limit']['redirect'];$r++) {

    $rdrow = field_build_row(2);
    $the_rds = "";
    $the_default = "";
    if(isset($rd_suggest[$r])) { $the_rds = $rd_suggest[$r]; }
    if($r===0) { $the_default = $shortn; }

    $redrz = array_merge($redrz, array(

        $rdrow[0],
        field_build_text("redirect_$r","Redirect Capture URL",$the_rds,$the_default),
        field_build_message("<strong>Redirect Target URL</strong><br />".get_permalink($currentp->ID)." (this post)"),
        $rdrow[1],

    ));

}

$redrz = array_merge($redrz,array(field_build_tab("Google Analytics")));

for($r=0;$r<$opendmo_global['set_limit']['redirect'];$r++) {

    $rdrow = field_build_row(2);
    $the_rds = "";
    if(isset($rd_suggest[$r])) { $the_rds = $rd_suggest[$r]; }

    $redrz = array_merge($redrz, array(

        $rdrow[0],
        field_build_text("redirect_ga_url_$r","Redirect Capture URL",$the_rds),
        field_build_text("redirect_ga_campaign_$r","GA Campaign String","?campaign=magazinead"),
        $rdrow[1],

    ));

}

fields_register("Redirects", $redrz, 4);

?>
