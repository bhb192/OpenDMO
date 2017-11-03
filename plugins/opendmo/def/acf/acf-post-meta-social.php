<?php

    $legacysocial = array("facebook", "twitter", "instagram", "youtube", "tripadvisor");

    $lsl = 0;

    foreach($legacysocial as $ls) {

        if(strlen($infos[$ls])) { $lsl++; }

    }

	if( strlen($infos["website"]) || strlen($infos["facebook"]) || strlen($infos["twitter"]) || strlen($infos["instagram"]) || strlen($infos["youtube"]) || strlen($infos["tripadvisor"]) ){

  		$acfoutput = $acfoutput.("<p class='noprint'>");

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


?>
