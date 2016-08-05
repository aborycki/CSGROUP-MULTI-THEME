<?php
/**
 * @subpackage pkt
 * @since pkt 1.0
 */
?>

<?php

if( !is_active_sidebar( 'pkt_footer_sidebar_one' ) &&
	!is_active_sidebar( 'pkt_footer_sidebar_two' ) &&
	!is_active_sidebar( 'pkt_footer_sidebar_three' ) &&
	!is_active_sidebar( 'pkt_footer_sidebar_four' ) ) {
	return;
}
?>
<div class="footer-widgets-wrapper">
	<div class="inner-wrap">
		<div class="footer-widgets-area clearfix">
			<div class="tg-one-fourth tg-column-1">
				<?php
				// Calling the footer sidebar if it exists.
				if ( !dynamic_sidebar( 'pkt_footer_sidebar_one' ) ):
				endif;
				?>
			</div>
			<div class="tg-one-fourth tg-column-2">
				<?php
				// Calling the footer sidebar if it exists.
				if ( !dynamic_sidebar( 'pkt_footer_sidebar_two' ) ):
				endif;
				?>
			</div>
			<div class="tg-one-fourth tg-after-two-blocks-clearfix tg-column-3">
				<?php
				// Calling the footer sidebar if it exists.
				if ( !dynamic_sidebar( 'pkt_footer_sidebar_three' ) ):
				endif;
				?>
			</div>
			<div class="tg-one-fourth tg-one-fourth-last tg-column-4">
				<?php
				// Calling the footer sidebar if it exists.
				if ( !dynamic_sidebar( 'pkt_footer_sidebar_four' ) ):
				endif;
				?>
			</div>
		</div>
	</div>
</div>