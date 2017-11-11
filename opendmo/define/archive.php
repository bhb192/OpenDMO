<?php 
function opendmo_archive_page( $archive_content ) {

    global $opendmo_global;
    $pt = get_post_type();
    $hascal = $opendmo_global['cpt_meta']["opt_opendmo_cpt_archive_calendar_$pt"][0];

    if($hascal==1) {

        safeout("Future Calendar Code Here");

    }
    //global $post;

     /*if ( is_post_type_archive ( 'event' ) ) {
          $archive_template = dirname( __FILE__ ) . '/post-type-template.php';
     }*/
    return $archive_content;
}

add_filter( 'get_the_archive_description', 'opendmo_archive_page' ) ;
?>
