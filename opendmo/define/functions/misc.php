<?php

function safeout($s,$d=0) {

    echo "<pre>";print_r($s);echo "</pre>";    
    if($d===1) { die; }

}

function makeplural($s) {

    if(!(substr($s, -1) == "s")) { return $s."s"; }
    else { return $s; }

}

function makesingular($s) {

    if(substr($s, -1) == "s") { return substr($s,0,(strlen($s)-1)); }
    else { return $s; }

}

?>
