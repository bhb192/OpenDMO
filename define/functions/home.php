<?php

function opendmo_home_meta($m,$h) {

    global $opendmo_global;
    $opendmo_global['homelement'][$h] = $opendmo_global['homelement'][$h].$m;

}

function opendmo_home_css($a) {

    global $opendmo_global;

    $css = file_get_contents($opendmo_global['path']."css/$a.css");
    $css = "<style type='text/css'>".$css."</style>";
    opendmo_home_meta($css,$a);

}

function opendmo_home_content( $content ) {
    
    global $opendmo_global;
    global $wpdb;
    
    $allposts = get_posts(array(

    'post_type' => $opendmo_global['cpt_names'],
    'post_status' => 'publish',
    'posts_per_page' => -1,

    ));
    $allposts = wp_list_pluck($allposts,'ID');
    $allposts = implode('","',$allposts);

    foreach (glob($opendmo_global['path']."home/*.php") as $f) { 
        
        $the_f = pathinfo($f, PATHINFO_FILENAME);
        
        if(isset($opendmo_global['options_meta']['opt_opendmo_home_show_'.$the_f])) { 
            
            $show_the_f = $opendmo_global['options_meta']['opt_opendmo_home_show_'.$the_f][0]; 
        
        }
        
        else {
            
            $show_the_f = true;
            
        }
        
        if($show_the_f) {
            
            include $f; 
            
        }
    
    }       
    
    $allafter = implode(array_slice($opendmo_global['homelement'], 1));
    $fullpost = $opendmo_global['homelement']['home-before'].$content.$allafter;
    
    return $fullpost;
    
}

function opendmo_home_load() {
    
    if ( is_front_page() && get_the_ID() == get_option( 'page_on_front' )) {
        
        add_filter( 'the_content', 'opendmo_home_content' );
        
    }

}

