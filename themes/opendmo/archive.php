<?php get_header(); ?>

<div class="container"><div class="page-container">
<div class="content">

	<div class="two-thirds column alpha">
       <div class="main post-archive"> 
                        
		<div class="title">
		
			<h1>		
			<?php 

				if( is_post_type_archive() ){
				  				  
				  $ptype = get_post_type();
				  $ptitle = get_option( 'wpseo_titles' );
				  $ptitle = $ptitle['title-ptarchive-'.$ptype];
				  $ptitle = explode('%%sep%%', $ptitle);
				  $ptitle = $ptitle[0];

				  
				  if(strpos($ptitle, '%') === false) { echo $ptitle; }
				  else { post_type_archive_title( ); }
					
					
				}

				elseif( is_tax() || is_category() || is_tag() ){
					$taxonomy_name = get_queried_object()->taxonomy;
					$taxonomy = get_taxonomy( $taxonomy_name );
					single_term_title( $taxonomy->labels->singular_name . ': ' );
						
				}

				elseif ( is_day() ) {
					printf( __( 'Daily Archives: %s', 'sigmatheme' ), '<span>' . get_the_date() . '</span>' );
					
				}

				elseif ( is_month() ){ 
					printf( __( 'Monthly Archives: %s', 'sigmatheme' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'sigmatheme' ) ) . '</span>' );
			
				}

				elseif ( is_year() ){
					printf( __( 'Yearly Archives: %s', 'sigmatheme' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'sigmatheme' ) ) . '</span>' );
					
				}

				elseif( is_search() ){
					printf( __( 'Search Results for: %s', 'sigmatheme' ), '<span>' . get_search_query() . '</span>' );
				}

				else{
					_e( 'Archives', 'sigmatheme' );
				}
			?>
			</h1>
		</div>
		
		<?php 

			$posts = query_posts($query_string .'&orderby=title&order=asc&posts_per_page=-1'); 
			get_template_part( 'loop', 'index' ); //the Loop 
		 
		 ?>
	
		</div>  <!-- End Main -->
    </div>  <!-- End two-thirds column -->
</div><!-- End Content -->
</div></div>
            
<?php get_footer(); //the Footer  ?>                        
           
