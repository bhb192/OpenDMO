<?php $skip=0; ?>
<?php if( have_posts() ): ?>

	 <?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->

		<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
		
		<a href="<?php the_permalink(); ?>">
		
			<?php the_post_thumbnail( 'big-thumb' ); ?>               
			<h4><?php the_title(); ?></h4><!--Post titles-->
			
			<?php $tpt = get_post_type(); ?>

			<?php if($tpt == "event") : ?>

				<strong><?php include("event-time.php"); echo($etime); ?></strong>

			<?php endif; ?>
		
           	<?php the_excerpt(); ?> <!--The Content-->				
			<div class="clear"></div>
			
		</a>
		  
        </article>
                        
	<?php endwhile; ?><!--  End the Loop -->

	<?php /* Display navigation to next/previous pages when applicable */ ?>
  
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
		
				<nav id="nav-below" class="nav clearfix">
				
				<h4>
				
					<span class="navprev"><?php previous_posts_link(); 
if(get_adjacent_post(false, '', true) && is_paged()){ echo ' &bull; '; }; ?></span>
					<span lass"navnext"><?php next_posts_link(); ?></span>
				
				</h4>
				
				</nav><!-- #nav-below -->
          
	<?php endif; ?>

<?php else: ?>

        <article id="post-0" <?php post_class();?>>
  
  			<div class="entry-content">
  			
  				<p>
  					<?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'sigmatheme' ); ?>
  				</p>
  				
  				<?php get_search_form(); ?>
  				
        	</div>
			
        </article>

<?php endif; ?>
