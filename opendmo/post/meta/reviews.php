<?php

/*

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
		
			echo "<div class='tareviews noprint'><div class='container'><div class='page-container'>";
			echo "<h3>Traveler Reviews</h3>";
		echo "<img class='talogo' src='img/powered_by_google_on_white.png' />";
			echo "<div class='tathereviews'>";
		
		}
					
		foreach($the_reviews_dates as $k=>$date){												
					
			echo "<div class='tareview'>";
			echo "<span class='starrating'>&#9733;&#9733;&#9733;&#9733;&#9733;</span>";
			echo "<span class='reviewtext'>".$the_reviews_text[$k]."</span>";
			echo "<span class='reviewdate'>".date("F j, Y", $date)."</span>";
			echo "</div>";
					
		}			
	
		if(count($the_reviews_dates) > 0) {
				
			echo "</div>";
			echo "</div></div></div>";
		
		}
				
	}

*/

