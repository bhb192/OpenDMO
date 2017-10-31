<?php get_header(); ?>

<div class="content">

	<div class="two-thirds column alpha">
		<div class="main"> 
       
			<?php the_post(); ?>
			
			<div class="title">
				<h2>
					<?php printf( __( 'Author Archives: <span class="vcard">%s</span>', 'sigmatheme' ), "<a class='author' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?>
				</h2>
			</div>

			<?php rewind_posts(); ?>

			<?php get_template_part( 'loop', 'author' ); ?>

	
		</div>  <!-- End Main -->
    </div>  <!-- End two-thirds column -->
</div><!-- End Content -->
                
<?php get_footer(); ?>