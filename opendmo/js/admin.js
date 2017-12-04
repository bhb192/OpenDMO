(function($) { 

    $(window).load(function(){

        $('#titlediv').css('background-image','url()');
        $('#titlediv').css('padding-bottom','0');
        $('#postdivrich').slideDown();
        $('#postbox-container-2').slideDown();

    });

})(jQuery); 

function opendmoiframetest(url) {

    jQuery('#opendmo_api_iframe').attr('src', url);        

}