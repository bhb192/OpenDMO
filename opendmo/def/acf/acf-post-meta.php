<?php

function cpm_getGoogleReviews($infos) {

	if(strlen($infos["google_place_id"])) {
				
		$ta_id = $infos["google_place_id"];
		$ta_key = "google_maps_api_key";
		$ta_api = "https://maps.googleapis.com/maps/api/place/details/json?placeid=".$ta_id."&key=".$ta_key;
		$ta_api = json_decode(file_get_contents($ta_api));		
		$ta_api = $ta_api->result;		
		$ta_reviews = $ta_api->reviews;
				
		$the_reviews_text = [];
		$the_reviews_dates = [];
				
		foreach($ta_reviews as $k=>$review) {
					
			if($review->rating == 5 && $review->text != '') {
						
				$the_reviews_text[$k] = $review->text;
				$the_reviews_dates[$k] = $review->time;
						
			}
					
		}
				
		arsort($the_reviews_dates);
	
		if(count($the_reviews_dates) > 0) {
		
			$acfoutput = $acfoutput."<div class='tareviews noprint'><div class='container'><div class='page-container'>";
			$acfoutput = $acfoutput."<h3>Traveler Reviews</h3>";
		$acfoutput = $acfoutput."<img class='talogo' src='img/powered_by_google_on_white.png' />";
			$acfoutput = $acfoutput."<div class='tathereviews'>";
		
		}
					
		foreach($the_reviews_dates as $k=>$date){												
					
			$acfoutput = $acfoutput."<div class='tareview'>";
			$acfoutput = $acfoutput."<span class='starrating'>&#9733;&#9733;&#9733;&#9733;&#9733;</span>";
			$acfoutput = $acfoutput."<span class='reviewtext'>".$the_reviews_text[$k]."</span>";
			$acfoutput = $acfoutput."<span class='reviewdate'>".date("F j, Y", $date)."</span>";
			$acfoutput = $acfoutput."</div>";
					
		}			
	
		if(count($the_reviews_dates) > 0) {
				
			$acfoutput = $acfoutput."</div>";
			$acfoutput = $acfoutput."</div></div></div>";
		
		}
				
	}

}

function cpm_getContactInfo() {

    global $infos;

    print_r($infos);

    global $addressexists;
	global $mapaddress;
	global $parklatlong;
	global $actlatlong;

	$addressexists = 0;
	$mapaddress = '';
	$parklatlong = '';
	$actlatlong = '';

	if( isset($infos["address"]) && isset($infos["city"]) ){
	
		if( strlen($infos["address"]) && strlen($infos["city"]) ) {
	  
			if(strpos($infos["city"],"/") !== false){

		
	  			$adrpts = explode("/",$infos["city"]);
				$thecity = $adrpts[0];
				$thestate = $adrpts[1]; 
		
				if(isset($adrpts[2])) {
			
					$thezip = $adrpts[2];
			
				}
		
				else {
			
					if( isset($infos["zip"])) {
				
						$thezip = $infos["zip"];
				
					}
			
					else {
			
						$thezip = '';
				
					}
				   
				}
			
			}
		
			$addressexists = 1;		
			$mapaddress = $infos["address"].", ".$thecity.", ".$thestate.", ".$thezip;
		
			$acfoutput = $acfoutput."<p><strong>Address</strong><br /><span>".$infos["address"]."</span><br /><span>".$thecity.", ".$thestate." ".$thezip."</span>";
		
		}
	
	}

	if( isset($infos["mail_address"]) && isset($infos["mail_city"]) ){
	
		if( strlen($infos["mail_address"]) && strlen($infos["mail_city"]) ) {
	  
			if(strpos($infos["mail_city"],"/") !== false){

		
	  			$mailadrpts = explode("/",$infos["mail_city"]);
				$mailthecity = $mailadrpts[0];
				$mailthestate = $mailadrpts[1]; 
		
				if(isset($mailadrpts[2])) {
			
					$mailthezip = $mailadrpts[2];
			
				}
		
				else {
			
					if( isset($infos["mail_zip"])) {
				
						$mailthezip = $infos["mail_zip"];
				
					}
			
					else {
			
						$mailthezip = '';
				
					}
				   
				}
			
			}
		
			$acfoutput = $acfoutput.("<p><strong>Mailing Address</strong><br /><span>".$infos["mail_address"]."</span><br /><span>".$mailthecity.", ".$mailthestate." ".$mailthezip."</span>");
		
		}
	
	}
	
	if( (isset($infos["gps_parking_lat"]) && isset($infos["gps_parking_long"])) || (isset($infos["gps_actual_lat"]) && isset($infos["gps_actual_long"])) ) {
	
		if( (strlen($infos["gps_parking_lat"]) && strlen($infos["gps_parking_long"])) || (strlen($infos["gps_actual_lat"]) && strlen($infos["gps_actual_long"]))  ) {
  
			$acfoutput = $acfoutput.("<p><strong>GPS Coordinates</strong>");
		
			if( (strlen($infos["gps_parking_lat"]) && strlen($infos["gps_parking_long"])) ){
			
				$addressexists = 1;
				$parklatlong = $infos["gps_parking_lat"].", ".$infos["gps_parking_long"]; 
				$acfoutput = $acfoutput.("<br />Parking Area: ".$infos["gps_parking_lat"].", ".$infos["gps_parking_long"]);
			
			}
		
			if( (strlen($infos["gps_actual_lat"]) && strlen($infos["gps_actual_long"])) ){
			
				$addressexists = 1;
				$actlatlong = $infos["gps_actual_lat"].", ".$infos["gps_actual_long"]; 
				$acfoutput = $acfoutput.("<br />Actual Location: ".$infos["gps_actual_lat"].", ".$infos["gps_actual_long"]);
			
			}
		
			$acfoutput = $acfoutput.("</p>");
		
		}
	  
	}

	if( isset($infos["phone"]) ) {
	
		if( strlen($infos["phone"]) ) {
  
  			$acfoutput = $acfoutput.("<p><strong>Phone: </strong>".$infos["phone"]."</p>");
		
		}
  
	}

	if( isset($infos["bizhours"]) ) {
	
		if( strlen($infos["bizhours"]) ) {
  
  			$acfoutput = $acfoutput.("<p><strong>Hours: </strong>".$infos["bizhours"]."</p>");
		
		}
  
	}

}

function cpm_getLinks($infos) {

	global $tripadvisorexists;
	$tripadvisorexists = 0;

	$extlinkicon = '<span style="width: 1em; height: 1em; display: block-inline;"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 12 12" style="enable-background:new 0 0 12 12;" xml:space="preserve"><g d="Icons" style="opacity:0.75;"><g id="external"><polygon id="box" style="fill-rule:evenodd;clip-rule:evenodd;" points="2,2 5,2 5,3 3,3 3,9 9,9 9,7 10,7 10,10 2,10"/><polygon id="arrow_13_" style="fill-rule:evenodd;clip-rule:evenodd;" points="6.211,2 10,2 10,5.789 8.579,4.368 6.447,6.5 5.5,5.553 7.632,3.421"/></g></g><g id="Guides" style="display:none;"></g></svg></span>';

	if( strlen($infos["website"]) || strlen($infos["facebook"]) || strlen($infos["twitter"]) || strlen($infos["instagram"]) || strlen($infos["youtube"]) || strlen($infos["tripadvisor"]) ){
  
  		$acfoutput = $acfoutput.("<p class='noprint'>");
  
  		if(strlen($infos["website"])){
	
			if( (strpos($infos["website"], "http://") === false) && (strpos($infos["website"], "https://") === false) ){
	
				$acfoutput = $acfoutput.("<a class='metalink' href='http://".$infos["website"]."' target='_blank'>Official Website ".$extlinkicon."</a><br />");
	  
			}
	  
			else {
		
				$acfoutput = $acfoutput.("<a class='metalink' href='".$infos["website"]."' target='_blank'>Official Website ".$extlinkicon."</a><br />");
	  
			}
  
  		}

 		if(strlen($infos["facebook"])){
	
			$acfoutput = $acfoutput.("<a class='socicona metalink' target='_blank' href=https://facebook.com/".$infos["facebook"]."><span style='color:#3e5b98;' class='socicon socicon-facebook'></span> Facebook ".$extlinkicon."</a><br />");
  
  		}

  		if(strlen($infos["twitter"])){
	
			$acfoutput = $acfoutput.("<a class='socicona metalink' target='_blank' href=https://twitter.com/".$infos["twitter"]."><span style='color:#4da7de;' class='socicon socicon-twitter'></span> Twitter (@".$infos["twitter"].") ".$extlinkicon."</a><br />");
  
 		}
	
	  	if(strlen($infos["instagram"])){
			
	
			$acfoutput = $acfoutput.("<a class='socicona metalink' target='_blank' href=https://instagram.com/".$infos["instagram"]."><span style='color:#000000;' class='socicon socicon-instagram'></span> Instagram (@".$infos["instagram"].") ".$extlinkicon."</a><br />");
  
 		}
	
	  	if(strlen($infos["youtube"])){
	
			$acfoutput = $acfoutput.("<a class='socicona metalink' target='_blank' href=https://youtube.com/".$infos["youtube"]."><span style='color:#e02a20;' class='socicon socicon-youtube'></span> YouTube ".$extlinkicon."</a><br />");
  
 		}
	
		if(strlen($infos["tripadvisor"])){
		
			$tripadvisorexists = 1;	
			$acfoutput = $acfoutput.("<a class='socicona metalink' target='_blank' href=https://tripadvisor.com/".$infos["tripadvisor"]."><span style='color:#4B7E37;' class='socicon socicon-tripadvisor'></span> TripAdvisor ".$extlinkicon."</a><br />");
  
 		}

  		$acfoutput = $acfoutput.("</p>");
	}

}

function cpm_getRelatedPosts($infos) {

	function grp($cpt, $cptlabel) {
	
		global $post;
	
		$rpout = '';
	
		$terms = wp_get_post_terms( $post->ID, $cpt );

		if ( $terms && ! is_wp_error( $terms ) ) {
		
			if($cptlabel) {
			
				$rpout = $rpout."<h3>".$cptlabel."</h3>";
			
			}
	  
   			$acns = array();
									
			foreach ( $terms as $term ) {
									  
				$acns[] = $term->name;		
		  		$temp = $post;
				$post = get_post($term->term_id);
		  		setup_postdata($post);
				$ipid = $post->ID;

				$rpout = $rpout.'<article><a href="'.get_the_permalink($ipid).'">';
         
		  		if(get_the_post_thumbnail($ipid, 'big-thumb')) {	
		  
					$rpout = $rpout.get_the_post_thumbnail($ipid, 'big-thumb');
				  
				}           
                
                $rpout = $rpout.'<h4>'.get_the_title($ipid).'</h4>';  		
				
				$incexc = 1;
				
				if($cpt == "event") { 
					
					include('event-time.php');
					
					if($thestart) {
						
						$rpout = $rpout."<p><strong>".$etime."</strong></p>"; 
						
					}
					
					else {
					
						$rpout = $rpout."<p><strong>Date and time to be announced</strong></p>"; 
						
					}
					
					if(get_the_excerpt() == $etime) {
						
						$incexc = 0;
						
					}
					
				}
				
				if($incexc) { 
				
					$rpout = $rpout."<p>".get_the_excerpt()."</p>";		
					
				}
				
        		$rpout = $rpout."<div style='clear:both;'></div></a></article>";

				wp_reset_postdata();
		  		$post = $temp;
   			
			}
			
		}
	
		return $rpout;

	}

	$cptList = array("attractions", "eat", "culture", "meet", "places", "shop", "sports", "stay", "event"); 

	$noboxout = '';
	$boxout = '';

	foreach ($cptList as $k=>$cpt) {
	
		$rpout = '';
	
		$cptlabel = "rp_labels_".$cpt;	
		if(isset($infos[$cptlabel])) $cptlabel = $infos[$cptlabel];
		else $cptlabel = '';

		if($cptlabel && $cptlabel != ' ') {
			
			$rpout = grp($cpt, $cptlabel);		
   			if($rpout != '') $boxout = $boxout.$rpout;
			
		}
	
		else {
	
			$rpout = grp($cpt, 0);
		   	if($rpout != '') $noboxout = $noboxout.$rpout;
	
		}
	
	}

	if($noboxout != '') {
	
		$acfoutput = $acfoutput.("<div class='rpcont inline'><div class='container'><div class='page-container'>".$noboxout."</div></div></div>");  
	
	}

   	if($boxout != '') {
   
        $acfoutput = $acfoutput.("<div class='rpcont blue'><div class='container'><div class='page-container'>");        
        $acfoutput = $acfoutput.$boxout;
		$acfoutput = $acfoutput.("</div></div></div>");
        
    }

}

function cpm_getUpcomingEvents() {
    
	global $post;
	$rvenues = wp_get_post_terms($post->ID,'related_venues'); 

	if(isset($rvenues[0]->name)){
	
		$stimes = array();
		$snames = array();
	
		foreach($rvenues as $rvenue) {
	
			$revents = eo_get_events(array('event-venue'=>$rvenue->name, 'event_start_after'=>'yesterday', 'numberposts'=>10));
		
			foreach($revents as $revent) {
		
				$stimes[] = strtotime($revent->StartDate." ".$revent->StartTime);
				$sids[] = $revent->ID;
		
			}
		
		}
	
		$nsids = array_unique($sids);
		$nstimes = array();
	
		foreach($nsids as $nsid) {
	
			$nstime = array_search($nsid, $sids);
			$nstimes[] = $stimes[$nstime];
		
		}
	
		asort($nstimes);
	
		if(isset($nstimes[0])) {
	
	   		$acfoutput = $acfoutput.("<div class='rpcont green'><div class='container'><div class='page-container'><h3>Upcoming Events</h3>");
		
		}
	
		foreach($nstimes as $k=>$stime) {
		
			$rpout = '';
		
		  	$temp = $post;
			$post = get_post($nsids[$k]);
		  	setup_postdata($post);
			$ipid = $post->ID;

			$rpout = $rpout.'<article><a href="'.get_the_permalink($ipid).'">';
         
		  	if(get_the_post_thumbnail($ipid, 'big-thumb')) {	
		  
				$rpout = $rpout.get_the_post_thumbnail($ipid, 'big-thumb');
				  
			}           
                
            $rpout = $rpout.'<h4>'.get_the_title($ipid).'</h4>';  		
				
			$incexc = 1;
					
			include('event-time.php');
					
			if($thestart) {
						
				$rpout = $rpout."<p><strong>".$etime."</strong></p>"; 
						
			}
					
			else {
					
				$rpout = $rpout."<p><strong>Date and time to be announced</strong></p>"; 
						
			}
					
			if(get_the_excerpt() == $etime) {
						
				$incexc = 0;
						
			}
				
			if($incexc) { 
				
				$rpout = $rpout."<p>".get_the_excerpt()."</p>";		
					
			}
				
        	$rpout = $rpout."<div style='clear:both;'></div></a></article>";
		
			$acfoutput = $acfoutput.$rpout;

			wp_reset_postdata();
		  	$post = $temp;   			
		
		}
		   
		if(isset($nstimes[0])) {
	
			$acfoutput = $acfoutput.("</div></div></div>");
	
		}
	
	}
			
}

?>
