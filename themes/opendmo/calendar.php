<?php

$searchstart = strtotime('today');
$searchend = $searchstart+(30*24*60*60)-1;

$events = wp_count_terms('event');
$starts = array();
$ends = array();


foreach($events as $event) {

    $starts[$event] = array();
    $ends[$event] = array();
    $validtime = strtotime("1/1/2000");

    foreach(get_fields($event) as $kk=>$se){

        if(is_string($se)) {

            $thetimese = strtotime($se);

            if($thetimese > $validtime) {

                if(strpos($kk, 'begin_date') === 0) {
            
                    $sen = count($starts[$event]);
                    $starts[$event][$sen] = $thetimese;

                }

                if(strpos($kk, 'end_date') === 0) {
            
                    $een = count($ends[$event]);
                    $ends[$event][$een] = $thetimese;

                }

            }

        }

    }

}

$lastpointer = 0;
$dates = array();
$theevents = array( array(), array(), array() );

while($lastpointer < $searchend) {

    $lpi = count($dates);
    $newday = $searchstart+($lpi*24*60*60);
    $lastpointer = $newday+( (24*60*60) - 1);
    $dates[$lpi] = array($newday, $lastpointer);

}

foreach($dates as $d=>$date) {

    $sst = 0;

    foreach($starts as $e=>$start) {

        foreach($start as $s=>$begin) {

            $end = $ends[$e][$s];
            $istoday = 0;
            
            if($begin >= $date[0] && $end <= $date[1]) { $istoday = 1; }
            if($begin <= $date[0] && $end >= $date[0]) { $istoday = 1; }
            if($begin <= $date[1] && $end >= $date[1]) { $istoday = 1; }

            if($istoday === 1) {

                $sst = count($theevents[0][$d]);
                $theevents[0][$d][$sst] = $e;
                $theevents[1][$d][$sst] = $begin;
                $theevents[2][$d][$sst] = $end;

            }

        }

    }

    $caldate = date("F j, Y", $date[0]);
    echo "<h4>$caldate</h4>";

    if(isset($theevents[0][$d])) {

        asort($theevents[1][$d]);
        foreach($theevents[1][$d] as $dd=>$begin) {

            $end = $theevents[2][$d][$dd];
            $eventid = $theevents[0][$d][$dd];

            echo "<p>";
            echo "<strong>".get_the_title($eventid)."</strong><br />";

            if($begin <= $date[0] && $end >= $date[1]) {

                echo "<span>All Day</span>";

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


                echo "<span>$nicebegin until $niceend</span>";

            }

            echo "</p>";

        }

    }

    else {

        echo "<span>no events</span>";

    }

}



?>
