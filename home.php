<?php
/**
 * @subpackage pkt
 * @since pkt 1.0
 */
?>

<?php get_header(); ?>

	<?php do_action( 'pkt_before_body_content' ); ?>

	<div id="primary">
		<div id="content" class="clearfix">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php	$format = pkt_posts_listing_display_type_select(); ?>

					<?php get_template_part( 'content', $format ); ?>

				<?php endwhile; ?>

				<?php get_template_part( 'navigation', 'none' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'none' ); ?>

			<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	<?php pkt_sidebar_select(); ?>

	<?php do_action( 'pkt_after_body_content' ); ?>

<?php get_footer(); ?>