<?php 

	global $etime;

	if(eo_reoccurs()) {
	
		if(is_archive()) { 
	
			$thestart = eo_get_the_start('U'); 
			$theend = eo_get_the_end('U');
	
		}
	
		else {

			$thestart = eo_get_next_occurrence_of();
		
			if($thestart) {
			
				$theend = $thestart['end']->format('U');
				$thestart = $thestart['start']->format('U');
			
			}
		
			else {
			
				$thestart = 0; 
				$theend = 0;
			
			}
		
		}
				
	}

	else {
				
		$thestart = eo_get_the_start('U');
		$theend = eo_get_the_end('U');
	
		if(!$thestart && !$theend) {
		
			$thestart = eo_get_next_occurrence_of();
		
			if($thestart) {
			
				$theend = $thestart['end']->format('U');
				$thestart = $thestart['start']->format('U');
			
			}
		
		}
				
	}

	if(!$thestart) {
	
		$etime = "Date and time to be announced";
	
	}

	else {
				
		if(eo_is_all_day()) {
	
			if($theend-$thestart < 86400) {
				
				$etime = date('l F j, Y', $thestart);
				$etime = $etime.' (Times May Vary)';
						
			}
	
			else {
					
				$etime = date('l F j, Y', $thestart);
				$etime = $etime.date(' \'\t\i\l\ l F j, Y', $theend);
				$etime = $etime.' (Times May Vary)';
		
			}
					
		}
				
		else {
				
			if($theend-$thestart < 86400) {
				
				$etime = date('l F j, Y \f\r\o\m g:ia', $thestart);
				$etime = $etime.date(' \'\t\i\l g:ia', $theend);
						
			}
					
			else {
				
				$etime = date('l F j, Y \f\r\o\m g:ia', $thestart);
				$etime = $etime.date(' \'\t\i\l l F j, Y \a\t g:ia', $theend);
						
			}
					
		}
	
	}
		
?>