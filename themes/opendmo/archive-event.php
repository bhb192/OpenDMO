<?php get_header(); ?>

<div class="container"><div class="page-container">
   <div class="content">
     <div class="two-thirds column alpha">
       <div class="main event-archive"> 
	   
	   	<?php 

		$year = strtotime(date("Y").'-01-01');
		$month = strtotime(date("Y").'-'.date("m").'-01');
		$day = strtotime(date("Y").'-'.date("m").'-'.date("d"));
		$yday = strtotime('-1 day', $day);

		$eday = eo_get_event_archive_date('U');

		if(
			
			(eo_is_event_archive('year') && $eday < $year) ||
			(eo_is_event_archive('month') && $eday < $month) ||
			(eo_is_event_archive('day') && $eday < $day)
			
		) $expiredevents = true;

		?>
	   
	   	<?php if($expiredevents): ?>
			
        	<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h3>Nothing Found</h3>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p>Apologies, but no results were found for the requested event date.</p>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
	   
	   <?php else: ?>
       	
       	<div class="title">  
		
       		<h1>
			
				<?php

					if( eo_is_event_archive('day') ){
					
						echo('Upcoming Events on '.eo_get_event_archive_date('F j, Y'));
						$when = 'ondate';
					
					}

					elseif( eo_is_event_archive('month') ){

						echo('Upcoming Events in '.eo_get_event_archive_date('F Y'));
						$when = 'event_start_after';
					
					}

					elseif( eo_is_event_archive('year') ){

						echo('Upcoming Events in '.eo_get_event_archive_date('Y'));
						$when = 'event_start_after';
					
					}

					else{
					
						echo('Upcoming Events');
					
					}

				?>
			
			</h1>
		
		</div>
	   
		<?php
			
			if($eday > $yday) $thedate = $eday;
			else $thedate = $yday;
			$thedate = date('Y-m-d', $thedate);

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			$events = new WP_Query( 
			
				array(
				
					'post_type' => 'event', 
					'suppress_filters' => false, 
					'posts_per_page' => 10,
					'paged' => $paged,				
					$when => $thedate
					
				) 
			
			);
	   
	   ?>

		<?php if($events->have_posts()): ?>
	   
	  		<?php while($events->have_posts()): ?>
	   		<?php $events->the_post(); ?>

	   			<article id="post-<?php the_ID(); ?>" <?php post_class();?>> 
				
				<a href="<?php the_permalink(); ?>">
				
    	    		<?php the_post_thumbnail('big-thumb'); ?>
				
          			<h4><?php the_title();?></h4>  
            
					<div class="event-entry-meta">
					
						<strong><?php include('event-time.php'); echo $etime; ?></strong>
						<?php the_excerpt(); ?>
			
					</div>
				
					<div class="clear"></div>
				
				</a>
				
        		</article>

        	<?php endwhile; ?>

        	<?php /* Display navigation to next/previous pages when applicable */ ?>
  
			<?php if ( $events->max_num_pages > 1 ) : ?>
	   
				<nav id="nav-below" class="nav clearfix">
				
				<h4>
				
					<span class="navprev"><?php previous_posts_link(); 
if(get_adjacent_post(false, '', true) && is_paged()){ echo ' &bull; '; }; ?></span>
					<span lass"navnext"><?php next_posts_link(); ?></span>
				
				</h4>
				
				</nav><!-- #nav-below -->
	   
			<?php endif; ?>
			
        <?php else: ?>
        
        	<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h3>Nothing Found</h3>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p>Apologies, but no results were found for the requested event date.</p>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

        <?php endif; ?>
	   
	   <?php endif; ?>
   
      </div>  <!-- End Main -->
    </div>  <!-- End two-thirds column -->
  </div><!-- End Content -->
</div></div>
 
<?php get_footer(); ?>