<?php the_post(); $infos = get_fields($post->ID); ?>

<?php if(has_post_thumbnail()): ?>

<div class="fimgcont fillbb">
	
	<div class="fimg fillframe" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');"></div>
		
</div>
			
<?php endif; ?>
	
<?php if (is_singular("stay")) {get_template_part('stay-booking');} ?>
	
<?php if(get_the_ID() == 2731): ?>

	<div class="stayrespost"><div class="container"><div class="page-container">
	
	<h2>Search for hotel rooms</h2>
	
		<?php get_template_part('stay-booking-all'); ?>
	
	</div></div></div>
	
<?php endif; ?>
	
<div class="container"><div class="page-container">

<div class="content the-article">
	<div class="two-thirds column alpha">
       <div class="main"> 
                        
        <article id="post-<?php the_ID(); ?>">
		
			<?php $themainauthor = get_the_author(); ?>
        
			<div class="title<?php if(has_post_thumbnail()) echo(" bigtitle"); ?>">       
			
				<h1>
				
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					
						<?php the_title(); ?>
					
						<?php if(get_field('verified_page')){

							include('gfx.php');
							echo "<span style='height: 1ex; width: 1ex; display: inline-block;'>";
							echo "<abbr class='silent' title='This location has been verified'>".$verifiedcheck."</abbr>";
							echo "</span>";

						} ?>
				
					</a> 
				
				</h1><!--Post titles-->
			
				<?php if (

					!is_page() && 
					!is_singular('stay') && 
					!is_singular('event') && 
					!get_field('hide_author_date') &&
					!get_field('bottom_author')

				): ?>			
			
					<div class="the-date">
			
                		<span class="authordate"><?php the_date(); ?> | <?php echo($themainauthor); ?></span>
                
                		<?php

                   			$rdate = get_the_date();
                    		$mdate = get_the_modified_date();

                    		if ($mdate != $rdate):

                		?>
               
                    		<br />
					
							<span class="authordate italic">Last updated on <?php echo $mdate;?></span>
                
                		<?php endif; ?>
					
					</div>
			
				<?php endif; ?>
			
			</div>

			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sigmatheme' ) ); ?>
		
			<?php


				
				get_template_part('custom-post-meta');
				cpm_getContactInfo($infos);

				if(get_field('verified_page')){

					echo "<p><span style='height: .75em; width: .75em; display: inline-block;'>";
					echo $verifiedcheck;
					echo "</span>  This location's hours and contact information have been verified as of ";
					echo get_the_modified_date();
					echo ".</p>";

				}

				cpm_getLinks($infos);
						
			?>  
		
			<?php if(is_singular('event')): ?>
												
				<?php if( eo_get_venue() ) {
 
					$the_venue = eo_get_venue_name();
					$eadr = eo_get_venue_address();
					$venuedesc = eo_get_venue_description();
					preg_match('/primary:\[([0-9]*)\]/', $venuedesc, $venueprimary);

					echo('<h4>Venue</h4>'); 
					echo('<strong>');
					if(isset($venueprimary[1])) { echo("<a href='".get_permalink($venueprimary[1])."'>"); }
					eo_venue_name();
					if(isset($venueprimary[1])) { echo("</a>"); }
					echo('</strong><br />');
					
					echo('<span>');
					echo($eadr['address']."<br />".$eadr['city'].", ".$eadr['state']." ".$eadr['postcode']);
					echo('</span>');
				
					echo eo_get_venue_map(eo_get_venue(),array('width'=>'100%', 'height'=>'400px', 'scrollwheel'=>false));		
	
				}	?>					
						
			<?php else: ?>
		
				<?php global $addressexists; global $mapaddress; global $parklatlong; global $actlatlong ?>
		
				<?php if($addressexists) : ?>

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
		
				<?php endif; ?>
		
			<?php endif; ?>
		
			<?php if (

				!get_field('hide_author_date') && (
				
					get_field('bottom_author') ||
				    is_page() ||
					is_singular('stay') ||
					is_singular('event')
				
				)

			): ?>			
			
				<div class="the-date bottom-date" style="padding-top: .75em;">
			
                	<span class="authordate italic">Originally posted on <?php echo(get_the_date()); ?> by <?php echo($themainauthor); ?>.</span>
                
                	<?php

                   		$rdate = get_the_date();
                    	$mdate = get_the_modified_date();

                    	if ($mdate != $rdate):

                	?>
  
					<span class="authordate italic">Last updated on <?php echo $mdate;?>.</span>
                
                	<?php endif; ?>
					
				</div>
			
			<?php endif; ?>
             
	   </article>
	   
	   </div>

	</div>
	
</div>
	
</div></div>

<?php
	
	cpm_getGoogleReviews($infos);
    //cpm_getUpcomingEvents();
	cpm_getRelatedPosts($infos);

?>
				   
<div class="bitlysharecont"><div class="container"><div class="page-container">
		  
	<?php  

		if ( function_exists( 'sharing_display' ) ) {
			
    		sharing_display( '', true );
				
		}
 
		if ( class_exists( 'Jetpack_Likes' ) ) {
				
    		$custom_likes = new Jetpack_Likes;
    		echo $custom_likes->post_likes( '' );
				
		} 
		
	?>
		
	<div id='bitlybox'>
			
		<input onclick='copybitly()' style='cursor:pointer;' id='bitlyshortlink' value='<?php echo(get_the_full_shortn_url()); ?>' type='text' readonly />
	
		<div style="color: #00aa00; display:none; font-size: .8em; margin-top: -.8em;" id="bitlycopied">Link copied to clipboard.</div>

	</div> 
		  
	<script type="text/javascript">
  
  		window.onload = document.getElementById('bitlyshortlink').select();  
	
		function copybitly() {
	
	   		var succeed;
	
    		try {
		
    			succeed = document.execCommand("copy");
		
    		} 
	
			catch(e) {
		
        		succeed = false;
		
    		}
		
			if(succeed) {
			
				jQuery("#bitlycopied").show("fast");
			
			}
	
		}
  
	</script>
			
</div></div></div>
