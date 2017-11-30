<?php

$pinned = $wpdb->get_results( '

    SELECT * FROM wp_postmeta 
        WHERE (
        
            meta_key LIKE "postmeta_opendmo_boolean_pin_home%"
            AND meta_value = 1    
            
        )
        OR (
        
            meta_key LIKE "postmeta_opendmo_datetime_pin_home%"
        
        )
        AND post_id IN ("'.$allposts.'")',
                             
 ARRAY_A);

$npinned = array();

foreach($pinned as $pin) { 
    
    $ikey = $pin['post_id'];
    $vkey = $pin['meta_value']; 
    $mkey = $pin['meta_key'];
    $mkey = array_slice(explode("_",$mkey),2);       
    
    if($mkey[0] == "datetime" ) {
        
        if(time() >= strtotime($vkey) && $vkey > 0) { $npinned[$ikey] = 0; }
        else { $npinned[$ikey] = 1; }
        
    }

}

$pinned = array_keys($npinned,1);
unset($npinned);
$pindatesmod = array();
foreach($pinned as $p=>$in) { $pindatesmod[$p] = get_the_modified_date('U',$in); }
arsort($pindatesmod);
$npinned = array();
foreach($pindatesmod as $pindates=>$mod) { $npinned[count($npinned)] = $pinned[$pindates]; }
$pinned = $npinned;
unset($npinned);
$c = count($pinned);
$pc = 1;

foreach($pinned as $id) {
    
    if(has_post_thumbnail($id)) {
    
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
        
    }

}

opendmo_home_css('pinned');
opendmo_home_meta("<div class='opendmo'><div class='opendmo_pinned'>",'pinned');
opendmo_home_meta("<h3>Featured Content</h3>","pinned");
opendmo_home_meta(opendmo_putinrow(0),'pinned');
opendmo_home_meta("<div class='clear'></div>",'pinned');
opendmo_home_meta("</div></div>",'pinned');
