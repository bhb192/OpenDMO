<?php

opendmo_archive_meta("<h4>Most Popular ".makeplural($cpt)."</h4>","popular");
$pops = array(

    'post_type' => $cpt,
    'post_status' => 'publish',
    'posts_per_page' => -1,

);
$pops = wp_list_pluck(get_posts($pops),"ID");
$popct = array();

foreach($pops as $pop) {

    $popc = get_post_meta($pop,'_opendmo_viewcount');
    if(isset($popc[0])) { $popct[$pop] = $popc[0]; }
    else { $popct[$pop] = 0; }

}

arsort($popct);
$pops = '';
$c = 0;
$pc = 1;

foreach($popct as $id=>$pop) {
    
    if(has_post_thumbnail($id)) {
        
        $c++;
        
    }
    
}

foreach($popct as $id=>$pop) {
    
    if(has_post_thumbnail($id)) {
    
        if($c == 1 || $c == 2 || $pc == 1) { opendmo_archive_putinrow($id,1); }

        else {

            if( !( ($c-3)%3  ) ) {

                if($pc < 4 && $pc > 1) { opendmo_archive_putinrow($id,2); }
                else { opendmo_archive_putinrow($id,3); }    

            }

            elseif( !( ($c-4)%3  ))  {

                if($pc < 3 && $pc > 1) { opendmo_archive_putinrow($id,1); }
                elseif($pc < 5 && $pc > 2) { opendmo_archive_putinrow($id,2); }       
                else { opendmo_archive_putinrow($id,3); }

            }

            else {

                if($pc < 6 && $pc > 1) { opendmo_archive_putinrow($id,2); }       
                else { opendmo_archive_putinrow($id,3); }

            }

        }

        $pc++;
        
    }

}

opendmo_archive_meta(opendmo_archive_putinrow(0),'popular');
opendmo_archive_meta("<div class='clear'></div>",'popular');

?>
