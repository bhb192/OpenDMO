<?php get_header(); ?>

   <div class="content">
     <div class="two-thirds column alpha">
       <div class="main"> 
       	
       	<?php $venue_id = get_queried_object_id(); ?>
       	
       	<div class="title">  
       		<h2>
				<?php printf( __( 'Events at: %s', 'sigmatheme' ), '<span>' .eo_get_venue_name($venue_id). '</span>' );?>
			</h2>
		</div>

		<!-- Display the venue map. If you specify a class, ensure that class has height/width dimensions-->
		<?php echo eo_get_venue_map( $venue_id, array('width'=>"100%") ); ?>
		
		<?php if( $venue_description = eo_get_venue_description( $venue_id ) ){
			 echo '<div class="venue-archive-meta">'.$venue_description.'</div>';
		} ?>
		
		<?php if ( have_posts() ): ?>
	        <?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
                        
    	    <article id="post-<?php the_ID(); ?>" <?php post_class();?>> 
    	    		<?php the_post_thumbnail('thumbnail', array('style'=>'float:left;margin-right:20px;')); ?>
          			<h4> <a href="<?php the_permalink(); ?>"><?php the_title();?></a> </h4>  
            
				<div class="event-entry-meta">
					<!-- Output the date of the occurrence-->
					<?php
 						if( eo_is_all_day() ){
							$format = 'd F Y';
							$microformat = 'Y-m-d';
						}else{
							$format = 'd F Y '.get_option('time_format');
							$microformat = 'c';
						}?>
					<time itemprop="startDate" datetime="<?php eo_the_start($microformat); ?>"><?php eo_the_start($format); ?></time>

					<!-- Display event meta list -->
					<?php echo eo_get_event_meta_list(); ?>

					<!-- Event excerpt -->
					<?php the_excerpt(); ?>
			
				</div><!-- .event-entry-meta -->	
				<div class="clear"></div>
        	</article>

        	<?php endwhile; ?><!--  End the Loop -->

        	<?php /* Display navigation to next/previous pages when applicable */ ?>
  
			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
				<nav id="nav-below" class="nav clearfix">
					<div class="nav-next pull-right sigma"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'sigmatheme' ) ); ?></div>
					<div class="nav-previous pull-left alpha"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'sigmatheme' ) ); ?></div>
				</nav><!-- #nav-below -->
			<?php endif; ?>
			
        <?php else: ?>
        
        	<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h3><?php _e( 'Nothing Found', 'sigmatheme' ); ?></h3>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found for the requested archive', 'sigmatheme' ); ?></p>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
        
        	<hr />
        <?php endif; ?>
   
      </div>  <!-- End Main -->
    </div>  <!-- End two-thirds column -->
  </div><!-- End Content -->
 
<?php get_footer(); ?>