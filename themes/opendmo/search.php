<?php get_header(); ?>

<div class="container"><div class="page-container">
<div class="content">

	<div class="two-thirds column alpha">
	
       <div class="main post-archive"> 
                        
		<div class="title">
			<h1>		
				<?php echo ("Search Results for: ".get_search_query()); ?>
			</h1>
		</div>
		
		<?php get_template_part( 'loop', 'index' ); //the Loop ?>
	
		</div>  <!-- End Main -->
		
    </div>  <!-- End two-thirds column -->
    
</div><!-- End Content -->
</div></div>
            
<?php get_footer(); ?>   