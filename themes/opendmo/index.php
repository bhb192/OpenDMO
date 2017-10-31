<?php get_header(); ?>

<?php if(is_home() || is_front_page()): ?>

	<?php get_template_part('custom-home-content'); ?>

<?php else: ?>

	<div class="container">
	<div class="page-container">

		<div class="content">

			<div class="two-thirds column alpha">
     			<div class="main"> 

					<?php get_template_part( 'loop', 'index' ); ?>
	
				</div>  <!-- End Main -->
    		</div>  <!-- End two-thirds column -->
    
		</div><!-- End Content -->
	
	</div></div>

<?php endif; ?>
        
<?php get_footer(); //the Footer  ?>     
          