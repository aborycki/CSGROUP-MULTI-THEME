<?php
/**
 * @subpackage pkt
 * @since pkt 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'pkt_before_post_content' ); ?>
	<div class="entry-content clearfix">
		<?php
			the_content();

			$pkt_tag_list = get_the_tag_list( '', '&nbsp;&nbsp;&nbsp;&nbsp;', '' );
			if( !empty( $pkt_tag_list ) ) {
				?>
				<div class="tags">
					<?php
					_e( 'Tagged on: ', 'pkt' ); echo $pkt_tag_list;
					?>
				</div>
				<?php
			}

			wp_link_pages( array(
			'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'pkt' ),
			'after'             => '</div>',
			'link_before'       => '<span>',
			'link_after'        => '</span>'
      ) );
		?>
	</div>

	<?php pkt_entry_meta(); ?>

	<?php
	do_action( 'pkt_after_post_content' );
   ?>
</article>