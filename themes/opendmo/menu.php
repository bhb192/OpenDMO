 <div class="header">  
    
    <div id="brand-header" class="container container-sixteen"> 

		<div class="container"><div class="page-container"><div class="logocontainer">

			<div class="logo"><div class="svgcont">
		
			    <a href="<?php echo esc_url( home_url('/') ); ?>">
				
                    <div class="theinnerlogoadiv">OpenDMO</div>
				
				</a>
		
			</div></div>
	
		</div></div></div>
	
 	</div>
 
</div>

<div class="clear"></div>
	
<div class="menucont"><div class="container"><div class="page-container"><ul class="menulabel"><li>
	
	<div id="ddmenubutton">&nbsp;</div>
	
	<ul class="actualmenu"><li>
	
    <?php 

        wp_nav_menu( array( 
		
    		'fallback_cb'     => 'false',
    		'theme_location'  => 'primary',
    		'menu_class'      => 'dropdown',
    		'container'       => 'div',
    		'container_class' => 'top-menu-container',
		
    	)); 
    ?>

	</li></ul>
	
</li></ul></div></div></div>

<script type="text/javascript">

var ival = 400;
var width = 0;

function whichMenu() {

	jQuery("#menu-top-navigation a").each(function(data){
		
		if(jQuery(this).attr("href") == "#"){
			
			jQuery(this).attr("href","javascript:void(0);");
			
		}
		
	});

	if(jQuery("#ddmenubutton").css("display") == "block") {
	
		jQuery(".menucont").find("ul, li").off("click");
		jQuery(".menucont .actualmenu").css("display","block");
		jQuery("#menu-top-navigation").css("display","none");
		jQuery("#menu-top-navigation > li > ul").css("display","none");
		jQuery("#menu-top-navigation > li > ul").find("li, ul").css("display","block");
		mobileMenuReady();
	
	}

	else {

		jQuery(".menucont").find("ul, li").off("click");
		jQuery("#menu-top-navigation").removeAttr("style");
		jQuery("#menu-top-navigation > li > ul").removeAttr("style");
		jQuery("#menu-top-navigation > li > ul").find("li, ul").removeAttr("style");
		stdMenuReady();

	}
	


}

function stdMenuReady() {

	jQuery("#menu-top-navigation > li").off("click");		
	jQuery("#menu-top-navigation > li").on("click", function(data) {
	
		jQuery(this).off("click");		
		stdMenuReady();
		jQuery(this).off("click");	
		jQuery("#menu-top-navigation > li > ul").slideUp(ival);
		jQuery(this).children("ul").slideDown(ival);
	
		jQuery(this).on("click", function(data) {	

			jQuery(this).children("ul").slideUp(ival);
			stdMenuReady();
			
		});
	
	});

}

function mobileMenuReady() {

	jQuery("#ddmenubutton").off("click");	
	
	jQuery("#ddmenubutton").on("click",	function(data) {
	
		jQuery(this).off("click");	
	
		jQuery("#menu-top-navigation > li").each(function(data) {
		
			jQuery(this).off("click");	
	
			function raiseSub(m) {
		
				jQuery(m).on("click", function(data) {
	
					jQuery(m).off("click");	
	
					jQuery(m).on("click", function(data) {
	
						jQuery(m).off("click");
						jQuery(m).children("ul").slideUp(ival);
						raiseSub(m);
				
					});
	
					jQuery(m).children("ul").slideDown(ival);
				
				});
		
			}
	
			raiseSub(this);
	
		});

		jQuery(this).on("click", function(data) {
			
			jQuery(this).off("click");
			jQuery("#menu-top-navigation > li").off("click");
			jQuery("#menu-top-navigation > li").children("ul").slideUp(ival);
			jQuery("#menu-top-navigation").slideUp(ival);
			mobileMenuReady();
			
		});
	
		jQuery("#menu-top-navigation").slideDown(ival);	
		
	});
		
}

jQuery(function(){

	whichMenu();
	width = jQuery(window).width();

	jQuery(".header, .fimgcont, article").on("click", function() {

		whichMenu();
	
	});

});

jQuery(window).resize(function(){

	if(jQuery(this).width() != width) {
	
		width = jQuery(this).width();
		whichMenu();
	
	}

});


</script>
    
<!--  End blog header -->
