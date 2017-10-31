<?php $ares = get_field('ares_id'); if($ares): ?>

	<div id="stayres"><div class="container"><div class="page-container">

		<h3>Search for available rooms at <?php the_title(); ?></h3>

		<select id="nor">
			<option value="">No. of Rooms</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select>

		<select id="noa">
			<option value="">No. of Adults</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>

		<select id="noc">
			<option value="">No. of Children</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>

		<div class="datep" style="clear: both;">Check in date <input type="text" id="cid" /></div>
		<div class="datep">Check out date <input type="text" id="cod" /></div>

		<a href="javascript:void(0)" onClick="ares()" class="bn">Search &raquo;</a>
	
		<script type="text/javascript">
		
			jQuery(document).ready(function() {
			
    			jQuery('#stayres input').datepicker({
				
        			dateFormat : 'mm-dd-yy'
    			});
			
			});

			function ares() {

				var aresid = <?php echo $ares;?>;

				var cid = jQuery("#cid").val();
				cid = cid.split("-");
				
				var cidm = cid[0];
				var cidd = cid[1];
				var cidy = cid[2];
			
				var cod = jQuery("#cod").val();
				cod = cod.split("-");
			
				var codm = cod[0];
				var codd = cod[1];
				var cody = cod[2];
			
				var nor = jQuery("#nor").val();
				var noa = jQuery("#noa").val();
				var noc = jQuery("#noc").val();

				var aresstr = "http://arestravel.com/77_hotel-rooms.html?hotelID="+aresid+"&checkInDate="+cidm+"%2F"+cidd+"%2F"+cidy+"&checkOutDate="+codm+"%2F"+codd+"%2F"+cody+"&numberOfRooms="+nor+"&numberOfAdults="+noa+"&numberOfChildren="+noc;

				window.open(aresstr, '_blank');

			}

		</script>
	
	</div></div></div>

<?php endif; ?>
