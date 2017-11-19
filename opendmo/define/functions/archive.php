<?php 

function opendmo_archive_load() {

    add_filter('get_the_archive_description', 'opendmo_archive_page') ;
    add_filter('get_the_archive_title', 'opendmo_archive_title');

}

function opendmo_archive_sort($query) {
    
    global $opendmo_global;
    
    if(is_archive() && in_array(get_post_type(),$opendmo_global['cpt_names'])) {
        
        $args = array(
            
            'order' => 'ASC',
            'orderby' => 'title',
            'post_type' => array(get_post_type()),
            'post_status' => 'publish',
            'posts_per_page' => -1,
            
         );

        query_posts($args);
        
    }
    
}

function opendmo_archive_meta($s,$h,$r=0) {

    global $opendmo_global;
    static $am;
    if(!isset($am)) { $am = $opendmo_global['archivelement']; }
    if(strlen($s)>0) { $am[$h] = $am[$h].$s; }
    if($r===1) { $nam = implode($am); $am=''; return $nam; }

}

function opendmo_archive_css($a) {

    global $opendmo_global;

    $css = file_get_contents($opendmo_global['path']."css/$a.css");
    $css = "<style type='text/css'>".$css."</style>";
    opendmo_archive_meta($css,$a);

}

function opendmo_archive_page( $archive_content ) {

    global $opendmo_global;
    $cpt = get_post_type(); 
    $hascal = $opendmo_global['cpt_meta']["opt_opendmo_cpt_archive_calendar_".$cpt][0];     
    opendmo_archive_meta("<div class='opendmo'>",'archive-before');
    opendmo_archive_css('archive');
    
    if(isset($opendmo_global['cpt_meta']["opt_opendmo_cpt_archive_body_".$cpt][0])) {
        
        $desc = $opendmo_global['cpt_meta']["opt_opendmo_cpt_archive_body_".$cpt][0];
        opendmo_archive_meta("<div class='opendmo_archive opendmo_archive_desc'>".$desc."</div>",'description');
        
    }

    if($hascal==1) {
        
        opendmo_archive_css('calendar');        
        opendmo_archive_meta("<div class='opendmo_archive opendmo_calendar'>",'calendar');
        include($opendmo_global['path']."archive/calendar.php");
        opendmo_archive_meta("</div>",'calendar');

    }

    opendmo_archive_css('popular');
    opendmo_archive_meta("<div class='opendmo_archive opendmo_popular'>",'popular');
    include($opendmo_global['path']."archive/popular.php");
    opendmo_archive_meta("</div>",'popular');
    opendmo_archive_meta("</div>",'archive-after');
    opendmo_archive_meta("<h4>".makeplural($cpt)." A-Z</h4>",'archive-after');

    return opendmo_archive_meta('','',1);
    
}

function opendmo_archive_title($at) {

    return makeplural(get_post_type());

}

function opendmo_archive_putinrow($s,$r=0) {
    
    static $p;
    if(!isset($p)) { $p = ''; }
    if($s === 0) { return $p; }
    
    $f = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
    $f = "rowof".$f->format($r);   
    $i = get_the_post_thumbnail_url($s,'large');
    $t = "<div class='pititle'>".get_the_title($s)."</div>";
    $k = get_the_permalink($s);
    $m = "<div class='pitwo' style='background-image:url($i);'>$t</div>";
    $a = "<a href='$k'>$m</a>";
    $p = $p."<div class='pirow $f'><div class='pione'>$a</div></div>";
    
}


?>
