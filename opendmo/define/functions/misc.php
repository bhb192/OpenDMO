<?php

function opendmo_safeout($s,$d=0) {

    echo "<pre>";print_r($s);echo "</pre>";    
    if($d===1) { die; }

}

function opendmo_makeplural($s) {

    if(!(substr($s, -1) == "s")) { return $s."s"; }
    else { return $s; }

}

function opendmo_makesingular($s) {

    if(substr($s, -1) == "s") { return substr($s,0,(strlen($s)-1)); }
    else { return $s; }

}

function opendmo_putinrow($s,$r=0) {
    
    static $p;
    if(!isset($p)) { $p = ''; }
    if($s === 0) { $np = $p; $p=''; return $np; }
    
    $f = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
    $f = "rowof".$f->format($r);   
    
    if(strpos($s,'http') === 0) { $i = $s; }
    else { $i = get_the_post_thumbnail_url($s,'large'); }
    $t = "<div class='pititle'>".get_the_title($s)."</div>";
    $k = get_the_permalink($s);
    $m = "<div class='pitwo' style='background-image:url($i);'>$t</div>";
    $a = "<a href='$k'>$m</a>";
    $p = $p."<div class='pirow $f'><div class='pione'>$a</div></div>";
    
}

