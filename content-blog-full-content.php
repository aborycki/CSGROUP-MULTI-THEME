<?php
/**
 * @subpackage pkt
 * @since pkt 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'pkt_before_post_content' ); ?>
	<header class="entry-header">
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
		</h2><!-- .entry-title -->
	</header>

	<div class="entry-content clearfix">
		<?php
			the_content();
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