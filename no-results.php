<?php
/**
 * @subpackage pkt
 * @since pkt 1.0
 */
?>

<section class="no-results not-found">

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Gotowy by opublikować pierwszy post? <a href="%1$s">Get started here</a>.', 'pkt' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Nic nie znalezion.', 'pkt' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'Przykro nam ale nie możemy znaleźć czego szukasz. Może dobrym pomysłem jest zobaczenie pomocy?', 'pkt' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
	
</section><!-- .no-results -->