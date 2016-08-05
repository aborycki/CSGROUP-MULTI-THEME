<?php

/**

 * @subpackage pkt

 * @since pkt 1.0

 */



/****************************************************************************************/



// pkt theme options

function pkt_options( $id, $default = false ) {

   // assigning theme name

   $themename = get_option( 'stylesheet' );

   $themename = preg_replace("/\W/", "_", strtolower( $themename ) );



   // getting options value

   $pkt_options = get_option( $themename );

   if ( isset( $pkt_options[ $id ] ) ) {

      return $pkt_options[ $id ];

   } else {

      return $default;

   }

}



/****************************************************************************************/



add_action( 'wp_enqueue_scripts', 'pkt_scripts_styles_method' );

/**

 * Register jquery scripts

 */

function pkt_scripts_styles_method() {

   /**

	* Loads our main stylesheet.

	*/

	wp_enqueue_style( 'pkt_style', get_stylesheet_uri() );



	if( pkt_options( 'pkt_color_skin', 'light' ) == 'dark' ) {

		wp_enqueue_style( 'pkt_dark_style', pkt_CSS_URL. '/dark.css' );

	}



   // Add Genericons, used in the main stylesheet.

   wp_enqueue_style( 'pkt-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );



	/**

	 * Adds JavaScript to pages with the comment form to support

	 * sites with threaded comments (when in use).

	 */

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )

		wp_enqueue_script( 'comment-reply' );



	/**

	 * Register JQuery cycle js file for slider.

	 */

	wp_register_script( 'jquery_cycle', pkt_JS_URL . '/jquery.cycle.all.min.js', array( 'jquery' ), '3.0.3', true );



   wp_register_style( 'google_fonts', '//fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' );



	/**

	 * Enqueue Slider setup js file.

	 */

  

   if( pkt_options( 'pkt_activate_slider', '0' ) == '1' ) {

   	if( is_home() || is_front_page() ){

   				wp_enqueue_script( 'pkt_slider', pkt_JS_URL . '/pkt-slider-setting.js', array( 'jquery_cycle' ), false, true );}elseif(pkt_options( 'pkt_blog_slider', '0' ) == '1'){		wp_enqueue_script( 'pkt_slider', pkt_JS_URL . '/pkt-slider-setting.js', array( 'jquery_cycle' ), false, true );}

   

   }   

   

//	if ( is_home() || is_front_page() && pkt_options( 'pkt_activate_slider', '0' ) == '1' ) {

//		wp_enqueue_script( 'pkt_slider', pkt_JS_URL . '/pkt-slider-setting.js', array( 'jquery_cycle' ), false, true );

//	}

	wp_enqueue_script( 'pkt-navigation', pkt_JS_URL . '/navigation.js', array( 'jquery' ), false, true );

	wp_enqueue_script( 'pkt-custom', pkt_JS_URL. '/pkt-custom.js', array( 'jquery' ) );



	wp_enqueue_style( 'google_fonts' );



   $pkt_user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);

	if(preg_match('/(?i)msie [1-8]/',$pkt_user_agent)) {

		wp_enqueue_script( 'html5', pkt_JS_URL . '/html5shiv.min.js', true );

	}



}



/****************************************************************************************/



add_filter('the_content', 'pkt_add_mod_hatom_data');

// Adding the support for the entry-title tag for Google Rich Snippets

function pkt_add_mod_hatom_data($content) {

   $title = get_the_title();

   if ( is_single() ) {

      $content .= '<div class="extra-hatom-entry-title"><span class="entry-title">' . $title . '</span></div>';

   }

   return $content;

}



/****************************************************************************************/



add_filter( 'excerpt_length', 'pkt_excerpt_length' );

/**

 * Sets the post excerpt length to 40 words.

 *

 * function tied to the excerpt_length filter hook.

 *

 * @uses filter excerpt_length

 */

function pkt_excerpt_length( $length ) {

	return 40;

}



add_filter( 'excerpt_more', 'pkt_continue_reading' );

/**

 * Returns a "Continue Reading" link for excerpts

 */

function pkt_continue_reading() {

	return '';

}



/****************************************************************************************/



/**

 * Removing the default style of wordpress gallery

 */

add_filter( 'use_default_gallery_style', '__return_false' );



/**

 * Filtering the size to be medium from thumbnail to be used in WordPress gallery as a default size

 */

function pkt_gallery_atts( $out, $pairs, $atts ) {

	$atts = shortcode_atts( array(

	'size' => 'thumbnail',

	), $atts );



	$out['size'] = $atts['size'];



	return $out;



}

add_filter( 'shortcode_atts_gallery', 'pkt_gallery_atts', 10, 3 );



/****************************************************************************************/



add_filter( 'body_class', 'pkt_body_class' );

/**

 * Filter the body_class

 *

 * Throwing different body class for the different layouts in the body tag

 */

function pkt_body_class( $classes ) {

	global $post;



	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'pkt_page_layout', true ); }



	if( is_home() ) {

		$queried_id = get_option( 'page_for_posts' );

		$layout_meta = get_post_meta( $queried_id, 'pkt_page_layout', true );

	}



	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }

	$pkt_default_layout = pkt_options( 'pkt_default_layout', 'right_sidebar' );



	$pkt_default_page_layout = pkt_options( 'pkt_pages_default_layout', 'right_sidebar' );

	$pkt_default_post_layout = pkt_options( 'pkt_single_posts_default_layout', 'right_sidebar' );



	if( $layout_meta == 'default_layout' ) {

		if( is_page() ) {

			if( $pkt_default_page_layout == 'right_sidebar' ) { $classes[] = ''; }

			elseif( $pkt_default_page_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }

			elseif( $pkt_default_page_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }

			elseif( $pkt_default_page_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }

		}

		elseif( is_single() ) {

			if( $pkt_default_post_layout == 'right_sidebar' ) { $classes[] = ''; }

			elseif( $pkt_default_post_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }

			elseif( $pkt_default_post_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }

			elseif( $pkt_default_post_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }

		}

		elseif( $pkt_default_layout == 'right_sidebar' ) { $classes[] = ''; }

		elseif( $pkt_default_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }

		elseif( $pkt_default_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }

		elseif( $pkt_default_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }

	}

	elseif( $layout_meta == 'right_sidebar' ) { $classes[] = ''; }

	elseif( $layout_meta == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }

	elseif( $layout_meta == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }

	elseif( $layout_meta == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }





	if( is_page_template( 'page-templates/blog-image-alternate-medium.php' ) ) {

		$classes[] = 'blog-alternate-medium';

	}

	if( is_page_template( 'page-templates/blog-image-medium.php' ) ) {

		$classes[] = 'blog-medium';

	}

	if ( pkt_options( 'pkt_archive_display_type', 'blog_large' ) == 'blog_medium_alternate' ) {

		$classes[] = 'blog-alternate-medium';

	}

	if ( pkt_options( 'pkt_archive_display_type', 'blog_large' ) == 'blog_medium' ) {

		$classes[] = 'blog-medium';

	}

	if( pkt_options( 'pkt_site_layout', 'box_1218px' ) == 'wide_978px' ) {

		$classes[] = 'wide-978';

	}

	elseif( pkt_options( 'pkt_site_layout', 'box_1218px' ) == 'box_978px' ) {

		$classes[] = 'narrow-978';

	}

	elseif( pkt_options( 'pkt_site_layout', 'box_1218px' ) == 'wide_1218px' ) {

		$classes[] = 'wide-1218';

	}

	else {

		$classes[] = '';

	}



	return $classes;

}



/****************************************************************************************/



if ( ! function_exists( 'pkt_sidebar_select' ) ) :

/**

 * Fucntion to select the sidebar

 */

function pkt_sidebar_select() {

	global $post;



	if( $post ) { $layout_meta = get_post_meta( $post->ID, 'pkt_page_layout', true ); }



	if( is_home() ) {

		$queried_id = get_option( 'page_for_posts' );

		$layout_meta = get_post_meta( $queried_id, 'pkt_page_layout', true );

	}



	if( empty( $layout_meta ) || is_archive() || is_search() ) { $layout_meta = 'default_layout'; }

	$pkt_default_layout = pkt_options( 'pkt_default_layout', 'right_sidebar' );



	$pkt_default_page_layout = pkt_options( 'pkt_pages_default_layout', 'right_sidebar' );

	$pkt_default_post_layout = pkt_options( 'pkt_single_posts_default_layout', 'right_sidebar' );



	if( $layout_meta == 'default_layout' ) {

		if( is_page() ) {

			if( $pkt_default_page_layout == 'right_sidebar' ) { get_sidebar(); }

			elseif ( $pkt_default_page_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }

		}

		if( is_single() ) {

			if( $pkt_default_post_layout == 'right_sidebar' ) { get_sidebar(); }

			elseif ( $pkt_default_post_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }

		}

		elseif( $pkt_default_layout == 'right_sidebar' ) { get_sidebar(); }

		elseif ( $pkt_default_layout == 'left_sidebar' ) { get_sidebar( 'left' ); }

	}

	elseif( $layout_meta == 'right_sidebar' ) { get_sidebar(); }

	elseif( $layout_meta == 'left_sidebar' ) { get_sidebar( 'left' ); }

}

endif;



/****************************************************************************************/



add_action( 'admin_head', 'pkt_favicon' );

add_action( 'wp_head', 'pkt_favicon' );

/**

 * Fav icon for the site

 */

function pkt_favicon() {

	if ( pkt_options( 'pkt_activate_favicon', '0' ) == '1' ) {

		$pkt_favicon = pkt_options( 'pkt_favicon', '' );

		$pkt_favicon_output = '';

		if ( !empty( $pkt_favicon ) ) {

			$pkt_favicon_output .= '<link rel="shortcut icon" href="'.esc_url( $pkt_favicon ).'" type="image/x-icon" />';

		}

		echo $pkt_favicon_output;

	}

}



/****************************************************************************************/



add_action('wp_head', 'pkt_custom_css');

/**

 * Hooks the Custom Internal CSS to head section

 */

function pkt_custom_css() {

	$primary_color = pkt_options( 'pkt_primary_color', '#0FBE7C' );

	$pkt_text_color= pkt_options( 'pkt_text_color', '#000000' );

	$pkt_head_color= pkt_options( 'pkt_head_color', '#000000' );

	$pkt_link_color= pkt_options( 'pkt_link_color', '#0FBE7C' );

	$pkt_menu_bg= pkt_options( 'pkt_menu_bg', '#000000' );

	$pkt_menu_bghover= pkt_options( 'pkt_menu_bghover', '#0FBE7C' );

	$pkt_menu_txt= pkt_options( 'pkt_menu_txt', '#ffffff' );

	$pkt_menu_txthover= pkt_options( 'pkt_menu_txthover', '#000000' );

	$pkt_tla_color= pkt_options( 'pkt_tla_color', '#ffffff' );

	$pkt_tloa_head= pkt_options( 'pkt_header_bg_color', '#ffffff' );

	//$pkt_internal_css = '';

	

		$pkt_internal_css = ' body {color: '.$pkt_text_color.';}

				#page{background: '.$pkt_tla_color.';}

				#main{background: '.$pkt_tla_color.';}

				h1,h2,h3,h4{color: '.$pkt_head_color.';}

				a{color: '.$pkt_link_color.';}

				.main-navigation{background: '.$pkt_menu_bg.';}

				.main-navigation ul li ul {background: '.$pkt_menu_bg.';}

				.main-navigation ul li ul li a {color: '.$pkt_menu_txt.';}

				#site-navigation .current-menu-item, #site-navigation menu-item:hover{background: '.$pkt_menu_bghover.';} 

				#site-navigation li.current-menu-item a{color: '.$pkt_menu_txthover.' !important;}

				#site-navigation .menu-item a{color: '.$pkt_menu_txt.';}	

				#site-navigation .menu-item a:hover{color: '.$pkt_menu_txthover.'!important; display:block;}

				#site-navigation .menu-item:hover{background: '.$pkt_menu_bghover.';}

				.main-navigation-right ul {border-top: 1px solid '.$pkt_menu_bg.';}

				.main-navigation-right ul li:hover::before {border-color: '.$pkt_menu_bg.' transparent transparent transparent;}

				.main-navigation-right .current-menu-item::before{border-color: '.$pkt_menu_bg.' transparent transparent transparent;}

				.main-navigation-right li a{color: '.$pkt_menu_txt.'  !important;}	

				.main-navigation-right li a:hover{color: '.$pkt_menu_txthover.'  !important;}

				.main-navigation-right ul li ul::before{border-color: transparent transparent '.$pkt_menu_bg.'  transparent ;}

				.main-navigation-right ul li ul{border: 1px solid '.$pkt_menu_bg.';}

				.small-menu ul li.current-menu-item a{color:'.$pkt_menu_bg.' !important;}

				div#header-text-nav-wrap{background: '.$pkt_tloa_head.';}

				

						';

	



	if( !empty( $pkt_internal_css ) ) {

		?>

		<style type="text/css"><?php echo $pkt_internal_css; ?></style>

		<?php

	}



	$pkt_custom_css = pkt_options( 'pkt_custom_css', '' );

	if( !empty( $pkt_custom_css ) ) {

		?>

		<style type="text/css"><?php echo $pkt_custom_css; ?></style>

		<?php

	}

}



/**************************************************************************************/



if ( ! function_exists( 'pkt_content_nav' ) ) :

/**

 * Display navigation to next/previous pages when applicable

 */

function pkt_content_nav( $nav_id ) {

	global $wp_query, $post;



	// Don't print empty markup on single pages if there's nowhere to navigate.

	if ( is_single() ) {

		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );

		$next = get_adjacent_post( false, '', false );



		if ( ! $next && ! $previous )

			return;

	}



	// Don't print empty markup in archives if there's only one page.

	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )

		return;



	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';



	?>

	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">

		<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'pkt' ); ?></h3>



	<?php if ( is_single() ) : // navigation links for single posts ?>



		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'pkt' ) . '</span> %title' ); ?>

		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'pkt' ) . '</span>' ); ?>



	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>



		<?php if ( get_next_posts_link() ) : ?>

		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'pkt' ) ); ?></div>

		<?php endif; ?>



		<?php if ( get_previous_posts_link() ) : ?>

		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'pkt' ) ); ?></div>

		<?php endif; ?>



	<?php endif; ?>



	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->

	<?php

}

endif; // pkt_content_nav



/**************************************************************************************/



if ( ! function_exists( 'pkt_comment' ) ) :

/**

 * Template for comments and pingbacks.

 *

 * Used as a callback by wp_list_comments() for displaying the comments.

 */

function pkt_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :

		case 'pingback' :

		case 'trackback' :

		// Display trackbacks differently than normal comments.

	?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

		<p><?php _e( 'Pingback:', 'pkt' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'pkt' ), '<span class="edit-link">', '</span>' ); ?></p>

	<?php

			break;

		default :

		// Proceed with normal comments.

		global $post;

	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

		<article id="comment-<?php comment_ID(); ?>" class="comment">

			<header class="comment-meta comment-author vcard">

				<?php

					echo get_avatar( $comment, 74 );

					printf( '<div class="comment-author-link">%1$s%2$s</div>',

						get_comment_author_link(),

						// If current post author is also comment author, make it known visually.

						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'pkt' ) . '</span>' : ''

					);

					printf( '<div class="comment-date-time">%1$s</div>',

						sprintf( __( '%1$s at %2$s', 'pkt' ), get_comment_date(), get_comment_time() )

					);

					printf( __( '<a class="comment-permalink" href="%1$s">Permalink</a>', 'pkt'), esc_url( get_comment_link( $comment->comment_ID ) ) );

					edit_comment_link();

				?>

			</header><!-- .comment-meta -->



			<?php if ( '0' == $comment->comment_approved ) : ?>

				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'pkt' ); ?></p>

			<?php endif; ?>



			<section class="comment-content comment">

				<?php comment_text(); ?>

				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'pkt' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

			</section><!-- .comment-content -->



		</article><!-- #comment-## -->

	<?php

		break;

	endswitch; // end comment_type check

}

endif;



/**************************************************************************************/



add_action( 'pkt_footer_copyright', 'pkt_footer_copyright', 10 );

/**

 * function to show the footer info, copyright information

 */

if ( ! function_exists( 'pkt_footer_copyright' ) ) :

function pkt_footer_copyright() {

	$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';





	$tg_link =  '<a href="'.esc_url( 'http://pkt.pl' ).'" target="_blank" title="'.esc_attr__( 'pkt.pl', 'pkt.pl' ).'" rel="designer"><span>'.__( 'pkt.pl', 'pkt') .'</span></a>';



	$default_footer_value = sprintf( __( 'Copyright &copy; %1$s %2$s.', 'pkt.pl' ), date( 'Y' ), $site_link ).' '.sprintf( __( 'Zaprojektowane przez %2$s.', 'pkt.pl' ), 'pkt.pl', $tg_link );



	$pkt_footer_copyright = '<div class="copyright">'.$default_footer_value.'</div>';

	echo $pkt_footer_copyright;

}

endif;



/**************************************************************************************/



if ( ! function_exists( 'pkt_posts_listing_display_type_select' ) ) :

/**

 * Function to select the posts listing display type

 */

function pkt_posts_listing_display_type_select() {

	if ( pkt_options( 'pkt_archive_display_type', 'blog_large' ) == 'blog_large' ) {

		$format = 'blog-image-large';

	}

	elseif ( pkt_options( 'pkt_archive_display_type', 'blog_large' ) == 'blog_medium' ) {

		$format = 'blog-image-medium';

	}

	elseif ( pkt_options( 'pkt_archive_display_type', 'blog_large' ) == 'blog_medium_alternate' ) {

		$format = 'blog-image-medium';

	}

	elseif ( pkt_options( 'pkt_archive_display_type', 'blog_large' ) == 'blog_full_content' ) {

		$format = 'blog-full-content';

	}

	else {

		$format = get_post_format();

	}



	return $format;

}

endif;



/****************************************************************************************/



add_action('admin_init','pkt_textarea_sanitization_change', 100);

/**

 * Override the default textarea sanitization.

 */

function pkt_textarea_sanitization_change() {

   remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );

   add_filter( 'of_sanitize_textarea', 'pkt_sanitize_textarea_custom',10,2 );

}



/**

 * sanitize the input for custom css

 */

function pkt_sanitize_textarea_custom( $input,$option ) {

   if( $option['id'] == "pkt_custom_css" ) {

      $output = wp_filter_nohtml_kses( $input );

   } else {

      $output = $input;

   }

   return $output;

}



/****************************************************************************************/



if ( ! function_exists( 'pkt_entry_meta' ) ) :

/**

 * Shows meta information of post.

 */

function pkt_entry_meta() {

   if ( 'post' == get_post_type() ) :

      echo '<footer class="entry-meta-bar clearfix">';

      echo '<div class="entry-meta clearfix">';

      ?>



      <span class="by-author author vcard"><a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>



      <?php

      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

      if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {

         $time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';

      }

      $time_string = sprintf( $time_string,

         esc_attr( get_the_date( 'c' ) ),

         esc_html( get_the_date() ),

         esc_attr( get_the_modified_date( 'c' ) ),

         esc_html( get_the_modified_date() )

      );

      printf( __( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>', 'pkt' ),

         esc_url( get_permalink() ),

         esc_attr( get_the_time() ),

         $time_string

      ); ?>



      <?php if( has_category() ) { ?>

         <span class="category"><?php the_category(', '); ?></span>

      <?php } ?>



      <?php if ( comments_open() ) { ?>

         <span class="comments"><?php comments_popup_link( __( 'No Comments', 'pkt' ), __( '1 Comment', 'pkt' ), __( '% Comments', 'pkt' ), '', __( 'Comments Off', 'pkt' ) ); ?></span>

      <?php } ?>



      <?php edit_post_link( __( 'Edit', 'pkt' ), '<span class="edit-link">', '</span>' ); ?>



      <?php if ( ( pkt_options( 'pkt_archive_display_type', 'blog_large' ) != 'blog_full_content' ) && !is_single() ) { ?>

         <span class="read-more-link"><a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'pkt' ); ?></a></span>

      <?php } ?>



      <?php

      echo '</div>';

      echo '</footer>';

   endif;

}

endif;

?>