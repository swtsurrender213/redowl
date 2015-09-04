<?php
/**
 * The template for displaying search forms.
 *
 */
?>
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" class="search" name="s" value="<?php echo esc_attr( get_search_query() , 'nadzhq-minimal' ); ?>" placeholder="<?php echo __( 'Search', 'nadzhq-minimal' ) . ' &hellip;'; ?>" />
		<input type="submit" class="searchsubmit"  value="Search" />
	</form>
