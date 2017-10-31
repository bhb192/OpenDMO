<?php

    function fields_location($gn) {

        global $opendmo_cpt_names;

        $fl = array();
        foreach($opendmo_cpt_names as $o=>$odcpt) {

            $fl[$o][0] = array (

                "param" => "post_type",
                "operator" => "==",
                "value" => $odcpt,
                "order_no" => ($gn),
                "group_no" => ($gn),
            );

        }

        return $fl;

    }

    include('acf-filters.php');

    include($opendmo_path.'extends/acf/acf.php');
    include($opendmo_path.'extends/acf-dtp/acf-dtp.php');
    include($opendmo_path.'extends/acf-rf/acf-row-v4.php');

    if(function_exists("register_field_group")) {

        include('acf-define-info.php');
        include('acf-define-cpt.php');
        include('acf-define-event.php');
        include('acf-define-stay.php');

    }

?>
