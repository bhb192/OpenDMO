<?php

global $eo_event_loop,$eo_event_loop_args;

//Date % Time format for events
$date_format = get_option('date_format');
$time_format = get_option('time_format');

//The list ID / classes
$id = $eo_event_loop_args['id'];
$classes = $eo_event_loop_args['class'];

?>

<?php if( $eo_event_loop->have_posts() ): ?>

	<ul id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($classes);?>" > 

		<?php while( $eo_event_loop->have_posts() ): $eo_event_loop->the_post(); ?>

			<?php 
				//Generate HTML classes for this event
				$eo_event_classes = eo_get_event_classes(); 

				//For non-all-day events, include time format
				$format = ( eo_is_all_day() ? $date_format : $date_format.' '.$time_format );
			?>

			
			<li class="<?php echo esc_attr(implode(' ',$eo_event_classes)); ?>" >
				<div class="eo-date-container">
					<span class="eo-date-month" style="background-color: <?php echo eo_get_event_color(); ?>;">
						<?php eo_the_start( 'M'); ?>
					</span>
					<span class="eo-date-day" style="background: <?php echo eo_color_luminance( eo_get_event_color(), 0.2 ); ?>;">
						<?php eo_the_start( 'j'); ?>
					</span>
				</div>
	
				<strong>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a>
				</strong>
				<p>
				<?php echo wp_trim_words( get_the_content(), 20 ); ?>
				</p>
			</li>

		<?php endwhile; ?>

	</ul>

<?php elseif( ! empty($eo_event_loop_args['no_events']) ): ?>

	<ul id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($classes);?>" > 
		<li class="eo-no-events" > <?php echo $eo_event_loop_args['no_events']; ?> </li>
	</ul>

<?php endif; ?>

