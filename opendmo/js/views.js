(function($) {
    
    $(document).ready(function($){

        $.post( ViewsAjax.ajaxurl, {puv: ViewsAjax.uvid, action: ViewsAjax.uvact}, function() {});
        
    });
    
})(jQuery);  
