<?php

$extlinkicon = '<span style="width: 1em; height: 1em; display: block-inline;"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 12 12" style="enable-background:new 0 0 12 12;" xml:space="preserve"><g d="Icons" style="opacity:0.75;"><g id="external"><polygon id="box" style="fill-rule:evenodd;clip-rule:evenodd;" points="2,2 5,2 5,3 3,3 3,9 9,9 9,7 10,7 10,10 2,10"/><polygon id="arrow_13_" style="fill-rule:evenodd;clip-rule:evenodd;" points="6.211,2 10,2 10,5.789 8.579,4.368 6.447,6.5 5.5,5.553 7.632,3.421"/></g></g><g id="Guides" style="display:none;"></g></svg></span>';

	if( strlen($infos["website"])  ){
  
  		$acfoutput = $acfoutput.("<p class='noprint'>");
  
  		if(strlen($infos["website"])){
	
			if( (strpos($infos["website"], "http://") === false) && (strpos($infos["website"], "https://") === false) ){
	
				$acfoutput = $acfoutput.("<a class='metalink' href='http://".$infos["website"]."' target='_blank'>Official Website ".$extlinkicon."</a><br />");
	  
			}
	  
			else {
		
				$acfoutput = $acfoutput.("<a class='metalink' href='".$infos["website"]."' target='_blank'>Official Website ".$extlinkicon."</a><br />");
	  
			}
  
  		}

    }

?>
