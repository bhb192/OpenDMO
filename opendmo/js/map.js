var map; 
var geocoder; 
var bounds;
var pins = [];
var nci = 0;

function addPin(loc,lbl){
    
    if(loc.lat() > -90 && loc.lat() < 90 && loc.lng() > -180 && loc.lng() < 180) {
            
         pins[nci] = new google.maps.Marker({

            map: map,
            position: loc

        });

        bounds.extend(loc);

        if (lbl !== undefined) {

            var pinfo = new google.maps.InfoWindow({

                content: lbl

            });

            pins[nci].addListener('click', function() {

                pinfo.open(map, this);

            });

        }

        nci++;        
    
    }
            
}

function setMapCenter() {

    if(bounds.getCenter().lat() !==0 && bounds.getCenter().lng() !==0) { map.fitBounds(bounds); }
    else { jQuery('.opendmo_map').css('display','none'); }
    
}

function codeAddress(adr,lbl) {
		
    geocoder.geocode( { 'address': adr}, function(results, status) {	

        if (status == google.maps.GeocoderStatus.OK) {

            addPin(results[0].geometry.location, lbl);

        } 

    });
                    
}

function initMap() {

    map = new google.maps.Map(document.getElementById('googlemap'), {

        center: {lat: 39.027882, lng: -94.737960},
        zoom: 15,
        scrollwheel: false

    });

    geocoder = new google.maps.Geocoder();
    bounds = new google.maps.LatLngBounds();
    pinfo = new google.maps.InfoWindow();
    google.maps.event.addListenerOnce(map, 'tilesloaded', function(){setMapCenter();});
    makePins();
    
}