<?php
/**
 * @subpackage pkt
 * @since pkt 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 700;

add_action( 'after_setup_theme', 'pkt_setup' );
/**
 * All setup functionalities.
 *
 * @since 1.0
 */
if( !function_exists( 'pkt_setup' ) ) :
function pkt_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'pkt', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
	add_theme_support( 'post-thumbnails' );

   // Supporting title tag via add_theme_support (since WordPress 4.1)
   add_theme_support( 'title-tag' );

	// Registering navigation menus.
	register_nav_menus( array(
		'primary' 	=> __( 'Primary Menu','pkt' ),
		'footer' 	=> __( 'Footer Menu','pkt' )
	) );

	// Cropping the images to different sizes to be used in the theme
	add_image_size( 'featured-blog-large', 750, 350, true );
	add_image_size( 'featured-blog-medium', 270, 270, true );
	add_image_size( 'featured', 642, 300, true );
	add_image_size( 'featured-blog-medium-small', 230, 230, true );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'pkt_custom_background_args', array(
		'default-color' => 'eaeaea'
	) ) );

	// Adding excerpt option box for pages as well
	add_post_type_support( 'page', 'excerpt' );

   /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
   add_theme_support('html5', array(
       'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
   ));
}
endif;

/**
 * Define Directory Location Constants
 */
define( 'pkt_PARENT_DIR', get_template_directory() );
define( 'pkt_CHILD_DIR', get_stylesheet_directory() );

define( 'pkt_INCLUDES_DIR', pkt_PARENT_DIR. '/inc' );
define( 'pkt_CSS_DIR', pkt_PARENT_DIR . '/css' );
define( 'pkt_JS_DIR', pkt_PARENT_DIR . '/js' );
define( 'pkt_LANGUAGES_DIR', pkt_PARENT_DIR . '/languages' );

define( 'pkt_ADMIN_DIR', pkt_INCLUDES_DIR . '/admin' );
define( 'pkt_WIDGETS_DIR', pkt_INCLUDES_DIR . '/widgets' );

define( 'pkt_ADMIN_IMAGES_DIR', pkt_ADMIN_DIR . '/images' );
define( 'pkt_ADMIN_CSS_DIR', pkt_ADMIN_DIR . '/css' );


/**
 * Define URL Location Constants
 */
define( 'pkt_PARENT_URL', get_template_directory_uri() );
define( 'pkt_CHILD_URL', get_stylesheet_directory_uri() );

define( 'pkt_INCLUDES_URL', pkt_PARENT_URL. '/inc' );
define( 'pkt_CSS_URL', pkt_PARENT_URL . '/css' );
define( 'pkt_JS_URL', pkt_PARENT_URL . '/js' );
define( 'pkt_LANGUAGES_URL', pkt_PARENT_URL . '/languages' );

define( 'pkt_ADMIN_URL', pkt_INCLUDES_URL . '/admin' );
define( 'pkt_WIDGETS_URL', pkt_INCLUDES_URL . '/widgets' );

define( 'pkt_ADMIN_IMAGES_URL', pkt_ADMIN_URL . '/images' );
define( 'pkt_ADMIN_CSS_URL', pkt_ADMIN_URL . '/css' );

/** Load functions */
require_once( pkt_INCLUDES_DIR . '/custom-header.php' );
require_once( pkt_INCLUDES_DIR . '/functions.php' );
require_once( pkt_INCLUDES_DIR . '/customizer.php' );
require_once( pkt_INCLUDES_DIR . '/header-functions.php' );

require_once( pkt_ADMIN_DIR . '/meta-boxes.php' );

/** Load Widgets and Widgetized Area */
require_once( pkt_WIDGETS_DIR . '/widgets.php' );

/*
 * Adding Admin Menu for theme options
 */
add_action( 'admin_menu', 'pkt_theme_options_menu' );
function pkt_theme_options_menu() {
   add_theme_page( 'Theme Options', 'Theme Options', 'manage_options', 'pkt-theme-options', 'pkt_theme_options' );
}

function pkt_theme_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'pkt' ) );
	} ?>
   <h1 class="pkt-theme-options"><?php _e( 'Theme Options', 'pkt' ); ?></h1>
   <?php
   printf( __('<p style="font-size: 16px; max-width: 800px";>Szanowni Państwo<br /> W razie problemów z obsługą strony jesteśmy do dyspozycji. <br />INFOLINIA 801 886 666<br /> CS Group Polska</p>', 'spacious'),
      esc_url(admin_url( 'customize.php' ) ),
      esc_url('http://themegrill.com/contact/')
   );
}

?>