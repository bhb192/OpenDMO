<?php

function opendmo_add_cpt_to_menu($cpt) {

    add_submenu_page(

        'opendmo-settings', ucfirst($cpt), ucfirst($cpt), 
        'manage_options', 'edit.php?post_type='.$cpt

    ); 

}

function opendmo_admin_menu() {

    global $opendmo_global;
    $po = "post.php?post=".$opendmo_global['primaryedit']."&action=edit";

    add_menu_page(

        'OpenDMO', 'OpenDMO', 'manage_options', 
        'opendmo-settings', '', 'dashicons-location', 4

    );

    add_submenu_page(

        'options-general.php', 'OpenDMO Options', 'OpenDMO', 
        'manage_options', $po

    ); 

    //remove_submenu_page( 'opendmo-settings', 'opendmo-settings' );
    add_filter('acf/settings/show_admin', 'opendmo_acf_show_admin');

}

function opendmo_admin_head() {

    global $opendmo_global;

    $a = array('css','js');
    $b = array(array("<style type='text/css'>","</style>"),array("<script>","</script>"));

    foreach($a as $c=>$d) {

        $e = file_get_contents($opendmo_global['path'].$d."/admin.".$d);
        echo($b[$c][0].$e.$b[$c][1]);
        
    }

}

function opendmo_acf_show_admin( $show ) {

    //return current_user_can('manage_options');
    return false;

}


