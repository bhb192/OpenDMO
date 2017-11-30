<?php

opendmo_home_css('calendar');
date_default_timezone_set('UTC');
$searchstart = strtotime('today');
$startdate = date("w",$searchstart);
$searchend = strtotime("+31 days", $searchstart)-1;
$validtime = strtotime("1/1/2000");
$lastpointer = 0;
$newday = 0;
$lpi = 0;
$dates = array();

while($lastpointer < $searchend) {

    if($newday === 0) { $newday = $searchstart; }
    else { $newday = strtotime("+1 day",$newday); }
    $lastpointer = strtotime("+1 day",$newday);
    $dates[$lpi] = array(($newday+1), ($lastpointer-1));
    $lpi++;

}

$maxdates = $opendmo_global['set_limit']['event_date'];

$events = $wpdb->get_results( '

    SELECT * FROM wp_postmeta 
        WHERE (
        
            meta_key LIKE "postmeta_opendmo_text_date_label%"
            OR meta_key LIKE "postmeta_opendmo_datetime_begin_date%"
            OR meta_key LIKE "postmeta_opendmo_datetime_end_date%"
        ) 
        AND post_id IN ("'.$allposts.'") 
        AND meta_value LIKE "_%"',
                             
 ARRAY_A);

$nevents = array();

foreach($events as $event) { 
    
    $ikey = $event['post_id'];
    $vkey = $event['meta_value']; 
    $mkey = $event['meta_key'];
    $mkey = array_slice(explode("_",$mkey),3);       
    
    if($mkey[0] == "date") { $mkey[0] = "label"; }
    else { $vkey = strtotime($vkey); }
    
    if($mkey[0] == "label" || $vkey>$checkdate) { $nevents[$ikey][$mkey[2]][$mkey[0]] = $vkey; }

}

$events = $nevents;
unset($nevents);
$theevents = array_fill(0,4,array());
$daterows = array(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'));
$thedr = 1;
opendmo_home_meta('<div class="opendmo"><h3>Upcoming Events</h3><div id="opendmo_home_calendar">', 'calendar');

foreach($dates as $d=>$date) {

    foreach($events as $eve=>$nts) { 

        foreach($nts as $da=>$te) {

            $begin = $te['begin'];
            $end = $te['end'];
            $label = $te['label'];
            $istoday = 0;
            
            if($begin >= $date[0] && $end <= $date[1]) { $istoday = 1; }
            if($begin <= $date[0] && $end >= $date[0]) { $istoday = 1; }
            if($begin <= $date[1] && $end >= $date[1]) { $istoday = 1; }

            if($istoday === 1) {

                $sst = count($theevents[0][$d]);
                $theevents[0][$d][$sst] = $eve;
                $theevents[1][$d][$sst] = $begin;
                $theevents[2][$d][$sst] = $end;
                $theevents[3][$d][$sst] = $label;

            }

        }

    }

    $thedw = date("w",$date[0]);
    $caldate = date("M j, Y", $date[0]);
    $drout = "<ul><li><h4>$caldate</h4></li>";

    if(isset($theevents[0][$d])) {

        asort($theevents[1][$d]);
        foreach($theevents[1][$d] as $dd=>$begin) {

            $end = $theevents[2][$d][$dd];
            $eventid = $theevents[0][$d][$dd];
            $label = $theevents[3][$d][$dd];

            $drout = $drout."<li><span><strong><a href='".get_the_permalink($eventid)."'>".get_the_title($eventid)."</a></strong></span><span><strong><small>".$label."</small></strong></span>";

            if($begin <= $date[0] && $end >= $date[1]) {

                $drout = $drout."<span>All Day</span></li>";

            }

            else {

                if($begin < $date[0]) {

                    $nicebegin = date("g:i a", $date[0]);

                }

                else {

                    $nicebegin = date("g:i a", $begin);

                }

                if($end > $date[1]) {

                    $niceend = date("g:i a", $date[1]);

                }

                else {

                    $niceend = date("g:i a", $end);

                }

                $drout = $drout."<span>$nicebegin</span><span><small>until</small></span><span>$niceend</span></li>";

            }

        }

    }

    else {

        $drout = $drout."<li><span>no events</li>";

    }

    $drout = $drout."</ul>";
    $daterows[$thedr][$thedw] = $drout;
    if($thedw == 6) { $thedr++; }

} 

$colclass = "opendmo_cal_col";

foreach($daterows as $dri=>$dr) {

    $dateheadclass = '';
    if($dri===0) { $dateheadclass = 'opendmo_cal_head'; }
    opendmo_home_meta('<div class="opendmo_cal_row '.$dateheadclass.'">','calendar');
    $i=0;
    while($i<7) {

        $colclass = "opendmo_cal_col";
        if($dri==1 && $i==$startdate) { $colclass =  $colclass." opendmo_cal_today"; }
        opendmo_home_meta("<div class='$colclass'>",'calendar');

        if(isset($dr[$i])) { opendmo_home_meta($dr[$i],'calendar'); }
        else { opendmo_home_meta("&nbsp",'calendar'); }

        opendmo_home_meta('</div>','calendar');

        $i++;

    }

    opendmo_home_meta('</div>','calendar');

}

opendmo_home_meta('<div class="opendmo_cal_row"></div></div></div>', 'calendar');

