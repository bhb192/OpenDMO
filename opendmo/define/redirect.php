<?php

function opendmo_redirect_meta($i,$n) {

    if(is_array($n)) {

        $r = array();

        foreach($n as $ne=>$wn) {

            $r[$ne] = get_post_meta($i,"postmeta_opendmo_text_redirect_$wn");

        }

        return $r;

    }

    else {

        return get_post_meta($i,"postmeta_opendmo_text_redirect_$n");

    }

}
    

function opendmo_redirect_do() {

    global $opendmo_global;
    $rdposts = get_posts(array(

        'post_type' => $opendmo_global['cpt_names'],
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'postmeta_opendmo_text_redirect_0',
                'value' => '^\/*',
                'compare' => "REGEXP",
            ),
            array(
                'key' => 'postmeta_opendmo_text_redirect_ga_url_0',
                'value' => '^\/*',
                'compare' => "REGEXP",
            ),

        ),

    ));

    $capture = array();
    $target = array();

    foreach($rdposts as $newcpt) {

        $n=0;
        $nid = $newcpt->ID;
        $neworm = opendmo_redirect_meta($nid,array($n,"ga_campaign_$n","ga_url_$n"));


        while(strlen($neworm[0][0])>0 || (strlen($neworm[1][0])>0 && strlen($neworm[2][0])>0)) {

            $temptar = parse_url(get_permalink($nid));
            $temptar = "/".get_post_type($nid).$temptar['path'];
            $tempcap = $neworm[0][0];

            if(strlen($neworm[0][0])>0) { 

                $redc = count($target);
                $target[$redc] = $temptar;
                $capture[$redc] = $tempcap;

            }

            if(strlen($neworm[1][0])>0) { 

                $temptar = $temptar.$neworm[1][0]; 
                $tempcap = $neworm[2][0];

                $redc = count($target);
                $target[$redc] = $temptar;
                $capture[$redc] = $tempcap;

            }

            $n++;
            $neworm = opendmo_redirect_meta($nid,array($n,"ga_campaign_$n","ga_url_$n"));

        }

    }

    $nowuri = "$_SERVER[REQUEST_URI]";
    foreach($capture as $tc=>$the_capture) {

        if($the_capture == $nowuri) {

            wp_redirect( $target[$tc], 301 );
            exit;

        }

    }

}



?>
