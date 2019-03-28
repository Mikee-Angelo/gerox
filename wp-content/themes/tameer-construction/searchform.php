<?php
/**
 * Template for displaying search forms in Tameer Construction
 */
?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'tameer-construction' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	<button type="submit" class="search-submit"><span><?php echo esc_attr_x( 'Search', 'submit button', 'tameer-construction' ); ?></span></button>
</form>