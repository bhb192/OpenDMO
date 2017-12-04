<?php

$igtoken = $opendmo_global['options_meta']['opt_opendmo_instagram_token'][0];
$poplimit = ($opendmo_global['set_limit']['archive_popular_posts']);
$igapi = "https://api.instagram.com/v1/users/self/media/recent/?access_token=$igtoken&count=$poplimit";
$igapi = file_get_contents($igapi);
$igapi = json_decode($igapi);
$igapi = $igapi->data;
$igpic = array();

foreach($igapi as $i=>$g) {
    
    $igpic[$i] = $g->images->standard_resolution->url;
    
}

if($c>$poplimit) { $c = $poplimit; }

foreach($igpic as $id) {
    
    if($c == 1 || $c == 2 || $pc == 1) { opendmo_putinrow($id,1); }

    else {

        if( !( ($c-3)%3  ) ) {

            if($pc < 4 && $pc > 1) { opendmo_putinrow($id,2); }
            else { opendmo_putinrow($id,3); }    

        }

        elseif( !( ($c-4)%3  ))  {

            if($pc < 3 && $pc > 1) { opendmo_putinrow($id,1); }
            elseif($pc < 5 && $pc > 2) { opendmo_putinrow($id,2); }       
            else { opendmo_putinrow($id,3); }

        }

        else {

            if($pc < 6 && $pc > 1) { opendmo_putinrow($id,2); }       
            else { opendmo_putinrow($id,3); }

        }

    }

    $pc++;
    
    if($pc == ($poplimit+1) ) { break; }

}

opendmo_home_css("instagram");
opendmo_home_meta("<p><div class='opendmo'><div class='opendmo_instagram'>",'instagram');
opendmo_home_meta("<h3>Instagram Posts</h3>","instagram");
opendmo_home_meta(opendmo_putinrow(0),'instagram');
opendmo_home_meta("<div class='clear'></div>",'instagram');
opendmo_home_meta("</div></div></p>",'instagram');

