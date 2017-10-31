<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) );?>">

	<label>
		<span class="screen-reader-text"> <?php echo _x( 'Search for:', 'label', 'sigmatheme' ); ?> </span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'search placeholder', 'sigmatheme' );?> " value="<?php echo get_search_query(); ?>" name="s" title="<?php _x( 'Search for:', 'search title attribute', 'sigmatheme' );?>" />
	</label>
	
	<input type="submit" class="btn btn-primary search-submit" value="<?php echo esc_attr_x( 'Search', 'search submit button', 'sigmatheme' ); ?>" />

</form>