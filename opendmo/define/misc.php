<?php

function safeout($s,$d=0) {

    echo "<pre>";print_r($s);echo "</pre>";    
    if($d===1) { die; }

}


?>
