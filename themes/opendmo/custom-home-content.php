<?php

	$homeintro = get_page_by_title("Home Intro");
	$hiid = $homeintro->ID;
	$hipic = wp_get_attachment_url(get_post_thumbnail_id($hiid));
	$hitext = $homeintro->post_content;

?>

<div class="introcontainer" style="background-image: url('<?php echo($hipic); ?>');"><div class="container"><div class="page-container">

	<?php echo $hitext; ?>

</div></div></div>

<div class="hcslcontainer homehead"><div class="container"><div class="page-container">

<h2>Staff Picks</h2>

</div></div></div>

<div class="hcslmaincont"><div class="container"><div class="page-container">

<nav id="featuredhomecontent">

	<?php

	$args = array(

		'posts_per_page'	=> -1,
		'orderby'		=> 'modified',
		'order'			=> 'DESC',
		'post_type'		=> array( 'post', 'page', 'attractions', 'eat', 'entertainment', 'meet', 'places','shop','sports','stay', 'event' ),
		'meta_key' => 'pin_home',
		'meta_value' => '1',
		'compare' => '==',
	
	);

	$the_query = new WP_Query( $args );
	$numfeats = 0;
	$f = 0;

	?>

	<?php if( $the_query->have_posts()): ?>

		<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
	
			<?php $phe = strtotime(get_field('pin_home_expire')); if($phe > time() || $phe == ''): ?>

				<?php $numfeats++; ?>

			<?php endif; ?>

		<?php endwhile; ?>

	<?php endif; ?>

	<?php wp_reset_query(); ?>

	<?php

	$args = array(

		'posts_per_page'	=> -1,
		'orderby'		=> 'modified',
		'order'			=> 'DESC',
		'post_type'		=> array( 'post', 'page', 'attractions', 'eat', 'entertainment', 'meet', 'places','shop','sports','stay', 'event' ),
		'meta_key' => 'pin_home',
		'meta_value' => '1',
		'compare' => '==',
	
	);

	$the_query = new WP_Query( $args );

	?>

	<?php if( $the_query->have_posts()): ?>

	<ul>
	
		<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
	
			<?php $phe = strtotime(get_field('pin_home_expire')); if($phe > time() || $phe == ''): ?>
	
				<?php

					if($f == 0) {
					
						$featclass = "rowofone";
					
					}

					if($f == 1) {
					
						if($numfeats == 3) {
						
							$featclass = "rowoftwo";
							
						}
					
						else {
					
							$featclass = "rowofone";
						
						}
					
					}

					if($f == 2 || $f == 3) {
					
						if($numfeats == 5) {
					
							$featclass = "rowofthree";
					
						}
					
						else {
					
							$featclass = "rowoftwo";
						
						}
					
					}

					if($f > 3) {
					
						if($numfeats % 2 && $f >= $numfeats-3) {
						
							$featclass = "rowofthree";
						
						}
					
						else {
						
							$featclass = "rowoftwo";
						
						}
					
					}

					$f++;
					
				?>
	
				<li class="hcsl <?php echo($featclass); ?>">
			
					<a href="<?php the_permalink(); ?>">
				
						<div class="hcslimgcont fillbb">
				
							<div class="hcslimg fillframe" style="background-image: url('<?php the_post_thumbnail_url( "full" ); ?>');"></div>
					
						</div>
					
						<div class="hcsltxt">
			
							<h3><?php the_title(); ?></h3>
						
						</div>					
			
					</a>
			
				</li>	
	
			<?php endif; ?>
	
		<?php endwhile; ?>
	
	</ul>

	<div class="container"><div class="page-container"><div class="dots"></div></div></div>

	<?php endif; ?>

	<?php wp_reset_query(); ?>

	<div style="clear:both;"></div>

</nav>

</div></div></div>

<div class="homehead homeres"><div class="container"><div class="page-container">

	<h2>Reserve a Hotel Room</h2>
	<h4>powered by aRes Travel</h4>

</div></div></div>

<div id="homeres"><div class="container"><div class="page-container">

	<?php get_template_part('stay-booking-all'); ?>

</div></div></div>

<div class="homehead popheadcontainer"><div class="container"><div class="page-container">

	<h2>Most Popular Attractions</h2>

</div></div></div>

<div class="popcontainer"><div class="container"><div class="page-container">

	<div style="clear: both;"></div>

	<nav class="popcontents">

		<?php

        global $opendmo_cpt_names;

        $popid = array();
        $popv = array();

        foreach($opendmo_cpt_names as $cpt) {

            $thepops = wp_count_terms($cpt);

            foreach($thepops as $poptart) {

                $theviewc = (get_post_meta($poptart, '_opendmo_viewcount', true))+0;

                if($theviewc > 0) {

                    $p = count($popid);
                    $popid[$p] = $poptart;
                    $popv[$p] = $theviewc;

                }

            }

        }

        arsort($popv);

        foreach($popv as $p=>$poptart) {

            echo get_the_title($popid[$p]);

        }


        ?>
		<div style="clear: both;"></div>

	</nav>

	<p class="noprint">
					
		<a href="/attractions/">
						
			<span>View all Attractions&nbsp;&raquo;</span>
					
		</a>

	</p>
	
</div></div></div>

<div class="videohome homehead"><div class="container"><div class="page-container">
		
			<h2>Tourism Highlights</h2>

</div></div></div>

<div class="videohome"><div class="container"><div class="page-container">
		
				<div class="youtube fillbb">
				
					<div class="ytiframe"></div>				
					<div class="ytbg"></div>				
					<span class="ytarrow"></span>
				
				</div>

				<script type="text/javascript">
				
					jQuery(function(){
					
						jQuery(".youtube").on("click", function(data){
							
						jQuery(".ytbg").css("display", "none");		
						jQuery(".ytarrow").css("display", "none");
						jQuery(".ytiframe").html('<iframe></iframe>');
					
						});

					
					});
				
				</script>
		
			<p>
					
				<a href="https://www.youtube.com/" target="_blank">
						
					<span style='color:#e02a20;' class='socicon socicon-youtube'></span>
					<span>&nbsp; YouTube&nbsp;&raquo;</span>
					
				</a>

			</p>
				
		
</div></div></div>

<div class="ighead homehead"><div class="container"><div class="page-container">

	<h2>Instagram Photos</h2>

</div></div></div>

<div id="igfeed"><div class="container"><div class="page-container">

	<div id="iggallery">

		<?php //get_template_part("ig-feed"); ?>
	
	</div>

	<div style="clear:both;"></div>

	<p>

		<a href="https://www.instagram.com/" target="_blank">
						
			<span class='socicon socicon-instagram'></span>
			<span>&nbsp; on&nbsp;Instagram&nbsp;&raquo;</span>
					
		</a>
	</p>

</div></div></div>

<div class="eohconthead homehead"><div class="container"><div class="page-container">
		
		<h2>Upcoming Events</h2>

</div></div></div>

<div class="eohcont"><div class="container"><div class="page-container">
	
	<div class="eohome">
				
		<?php get_template_part('calendar'); ?> 
				
	</div>	

	<div style="clear:both;"></div>
	
</div></div></div>
