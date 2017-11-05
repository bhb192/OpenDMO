<?php


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

?>
