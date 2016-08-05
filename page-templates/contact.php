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
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
	<?php pkt_sidebar_select(); ?>
	
	<?php do_action( 'pkt_after_body_content' ); ?>

<?php get_footer(); ?>