<?php 

function opendmo_archive_load() {

    add_filter('get_the_archive_description', 'opendmo_archive_page') ;
    add_filter('get_the_archive_title', 'opendmo_archive_title');

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

    foreach($opendmo_global['archivelement'] as $arel=>$kjhrw) {

        $hascal = $opendmo_global['cpt_meta']["opt_opendmo_cpt_archive_".$arel."_".$cpt][0];

        if($hascal==1) {

            opendmo_archive_css($arel);
            opendmo_archive_meta("<div class='opendmo'>",$arel);
            include($opendmo_global['path']."archive/$arel.php");
            opendmo_archive_meta("</div>",$arel);

        }

    }

    return opendmo_archive_meta('','',1);
}

function opendmo_archive_title($at) {

    return makeplural(get_post_type());

}


?>
