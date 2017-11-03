<?php

function my_acf_admin_head() {

    global $opendmo_cpt_names;
    global $move_these_cpt_boxes;

    foreach($opendmo_cpt_names as $odod=>$odcpt) {

        $fieldkey = $move_these_cpt_boxes[$odod];
    
        ?>

        <style type="text/css">

            #custom-post-type-onomies-<?php echo $odcpt; ?> {

                display: none;

            }

        </style>
        <script>
        (function($) {
            
            $(document).ready(function(){
                
                $('.field_key-<?php echo $fieldkey; ?>').append( $('#taxonomy-<?php echo $odcpt; ?>') );
                
            });
            
        })(jQuery);    
        </script>

        <?php    

    }
    
}

add_action('acf/input/admin_head', 'my_acf_admin_head');

$insert_these_cpt_fields = array();
$move_these_cpt_boxes = array();
$itcf = 0;
$mtcb = 0;

global $opendmo_cpt_names;

foreach($opendmo_cpt_names as $o=>$odcpt) {

    $odcptnice = ucfirst($odcpt);

    if(substr($odcptnice, -1) != "s") {

        $odcptnice = $odcptnice."s";

    }

    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "field_59f68d5f8e31f_$odcpt",
	    "label" => ucfirst($odcpt),
	    "name" => "",
	    "type" => "tab",
    ); $itcf++;
    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "cpt_tax_content_$odcpt",
	    "label" => "",
	    "name" => "",
	    "type" => "message",
	    "message" => "",
    ); 
    $move_these_cpt_boxes[$mtcb] = "cpt_tax_content_$odcpt";
    $mtcb++;
    $itcf++; 
    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "field_59f68f7023d71_$odcpt",
	    "label" => "cpt_tax_do_$odcpt",
	    "name" => "",
	    "type" => "message",
	    "message" => "<strong>Display Options</strong>",
    ); $itcf++;
    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "field_59f68d8c5b970_$odcpt",
	    "label" => "",
	    "name" => "cpt_tax_r1o_$odcpt",
	    "type" => "row",
	    "row_type" => "row_open",
	    "col_num" => 2,
    ); $itcf++;
    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "field_59f68ae90ded5_$odcpt",
	    "label" => "Label",
	    "name" => "rp_labels_$odcpt",
	    "type" => "text",
	    "default_value" => "Nearby $odcptnice",
	    "placeholder" => "",
	    "prepend" => "",
	    "append" => "",
	    "formatting" => "html",
	    "maxlength" => "",
    ); $itcf++;
    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "field_59f68b4ff6cd5_$odcpt",
	    "label" => "List Priority",
	    "name" => "cpt_tax_priority_$odcpt",
	    "type" => "number",
	    "default_value" => ($o+1),
	    "placeholder" => "",
	    "prepend" => "",
	    "append" => "",
	    "min" => "",
	    "max" => "",
	    "step" => 1,
    ); $itcf++;
    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "field_59f68e075b971_$odcpt",
	    "label" => "",
	    "name" => "cpt_tax_r1c_$odcpt",
	    "type" => "row",
	    "row_type" => "row_close",
	    "col_num" => 2,
    ); $itcf++;
    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "field_59f68e305b972_$odcpt",
	    "label" => "",
	    "name" => "cpt_tax_r2o_$odcpt",
	    "type" => "row",
	    "row_type" => "row_open",
	    "col_num" => 3,
    ); $itcf++;
    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "field_59f68bca20106_$odcpt",
	    "label" => "Show Inline",
	    "name" => "cpt_tax_showinline_$odcpt",
	    "type" => "true_false",
	    "required" => 0,
	    "message" => "",
	    "default_value" => 0,
    ); $itcf++;
    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "field_59f68c00874a1_$odcpt",
	    "label" => "BG Color",
	    "name" => "cpt_tax_bgcolor_$odcpt",
	    "type" => "color_picker",
	    "default_value" => "transparent",
    ); $itcf++;
    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "field_59f68c500a33b_$odcpt",
	    "label" => "Sort",
	    "name" => "cpt_tax_sortby_$odcpt",
	    "type" => "select",
	    "choices" => array (
		    "az" => "Alphanumerical",
		    "mr" => "Most Recent",
	    ),
	    "default_value" => "az",
	    "allow_null" => 0,
	    "multiple" => 0,
    ); $itcf++;
    $insert_these_cpt_fields[$itcf] = array (
	    "key" => "field_59f68e395b973_$odcpt",
	    "label" => "",
	    "name" => "cpt_tax_r2c_$odcpt",
	    "type" => "row",
	    "row_type" => "row_close",
	    "col_num" => 3,
    ); $itcf++;

}

register_field_group(array (

    "id" => "acf_opendmo-rp",
    "title" => "OpenDMO Related Post Options",
    "fields" => $insert_these_cpt_fields,
    "location" => (fields_location(0)),
    "options" => array (
        "position" => "normal",
        "layout" => "default",
        "hide_on_screen" => array (),
    ),
    "menu_order" => 0,

));


?>
