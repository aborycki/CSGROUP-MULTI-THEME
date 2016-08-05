<?php
/**
 * @subpackage pkt
 * @since pkt 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'pkt_before_post_content' ); ?>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array( 
			'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'pkt' ),
			'after'             => '</div>',
			'link_before'       => '<span>',
			'link_after'        => '</span>'
      ) );
		?>
	</div>
	<?php
	do_action( 'pkt_after_post_content' );
   ?>
</article>