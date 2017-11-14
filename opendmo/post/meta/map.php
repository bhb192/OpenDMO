<?php

/*

	<div id="googlemap" class="googlemap" style="background: black; height: 400px;"></div>
	<div id="capture"></div>

	<script>

		var map;
		var nci = 0;
		
		function newCenter(nc, adr) {
		
			if(adr) {
			
				if(!nci) {
			
					map.setCenter(nc);
				
				}
			
			}
		
			else {
			
				map.setCenter(nc);
			
			}
		
			nci++;
		
		}
		
		function codeAddress() {
		
			var address;
			var latlng;
		
			<?php if($mapaddress) : ?>
		
				address = "<?php echo($mapaddress); ?>";
		
				geocoder.geocode( { 'address': address}, function(results, status) {	
			
					if (status == google.maps.GeocoderStatus.OK) {
				
						var adrmarker = new google.maps.Marker({
					
							map: map,
							position: results[0].geometry.location
					
						});									
													
						var adrinfowindow = new google.maps.InfoWindow({
					
							content: '<strong>Address</strong><br /><?php echo($mapaddress); ?>'
					
						});
				
						adrmarker.addListener('click', function() {
					
							adrinfowindow.open(map, adrmarker);
					
						});
					
					    newCenter(results[0].geometry.location, 1);
						adrinfowindow.open(map, adrmarker);
				
			 		} 
			
				});
		
			<?php endif; ?>
			
			<?php if($parklatlong) : ?>
			
				latlng = "<?php echo($parklatlong); ?>";
				latlng = latlng.split(',', 2);
				latlng = {lat: parseFloat(latlng[0]), lng: parseFloat(latlng[1])};
		
				newCenter(latlng, 0);
				
				var parkmarker = new google.maps.Marker({
					
					map: map,
					position: latlng
					
				});
		
				var parkinfowindow = new google.maps.InfoWindow({
					
					content: '<strong>Parking Area</strong><br /><?php echo($parklatlong); ?>'
					
				});
				
				parkmarker.addListener('click', function() {
					
					parkinfowindow.open(map, parkmarker);
					
				});
		
				parkinfowindow.open(map, parkmarker);
			
			<?php endif; ?>
			
			<?php if($actlatlong) : ?>
			
				latlng = "<?php echo($actlatlong); ?>";
				latlng = latlng.split(',', 2);
				latlng = {lat: parseFloat(latlng[0]), lng: parseFloat(latlng[1])};
				
				newCenter(latlng, 0);
				
				var actinfowindow = new google.maps.InfoWindow({
					
					content: '<strong>Actual Location</strong><br /><?php echo($parklatlong); ?>'
					
				});
				
				var actmarker = new google.maps.Marker({
					
					map: map,
					position: latlng
					
				});
				
				actmarker.addListener('click', function() {
					
					actinfowindow.open(map, actmarker);
					
				});
		
				actinfowindow.open(map, actmarker);
			
			<?php endif; ?>
		
		}

		function initMap() {
		
			geocoder = new google.maps.Geocoder();

			map = new google.maps.Map(document.getElementById('googlemap'), {
			
				center: {lat: 34.690777, lng: -82.834131},
				zoom: 15,
				scrollwheel: false
	
			});
		
			codeAddress();
		
		}

	</script>

	<script src="https://maps.googleapis.com/maps/api/js?key=google_maps_api_key_here&callback=initMap"
	async defer></script>

*/

?>
