<?php

$googlehelp = 'Find the ID of a Place through the <a href="https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder" target="_blank">Google PlaceID Finder Tool</a>.';

$info_fields = array(

      opendmo_field_build_tab('Reviews'),
      opendmo_field_build_text('google_place_id', 'Google Place ID', 'ChIJgzjVcgxeWIgR_HSag0BYocs', '', $googlehelp),
      opendmo_field_build_boolean('google_private', 'Make Google Reviews Private', 'Check this box to only allow admins to see Google reviews'),

);

