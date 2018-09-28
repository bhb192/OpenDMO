<?php

if(isset($meta['text_redirect_0'])) {

    opendmo_add_meta("<div class='opendmo_sharebox'>", 'shortlink');
    opendmo_add_meta("<h4>Share</h4>",'shortlink');
    opendmo_add_meta("<input type='text' id='opendmo_shortlink' value='".site_url().$meta['text_redirect_0']."'>",'shortlink');
    opendmo_add_meta("</div>", 'shortlink');
    opendmo_add_meta("<script>window.onload = document.getElementById('opendmo_shortlink').select();</script>", 'shortlink');

}
