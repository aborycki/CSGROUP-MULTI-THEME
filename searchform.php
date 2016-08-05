<?php
/**
 * @subpackage pkt
 * @since pkt 1.0
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form searchform clearfix" method="get">
	<div class="search-wrap">
		<input type="text" placeholder="<?php esc_attr_e( 'Search', 'pkt' ); ?>" class="s field" name="s">
		<button class="search-icon" type="submit"></button>
	</div>
</form><!-- .searchform -->