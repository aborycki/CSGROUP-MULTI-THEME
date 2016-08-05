<?php
/**
 * @subpackage pkt
 * @since pkt 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
/**
 * This hook is important for wordpress plugins and other many things
 */
wp_head();
if(pkt_options('pkt_header_bg_activ')==1){echo '<style>#page{background:transparent !important; box-shadow: none !important; } div#header-text-nav-wrap{background:transparent !important;}</style>';}
?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/whcookies.js"></script>

</head>

<body <?php body_class(); ?>>
<?php	do_action( 'before' ); ?>
<div id="page" class="hfeed site">
	<?php do_action( 'pkt_before_header' ); ?>
	<header id="masthead" class="site-header clearfix">

		<?php if( pkt_options( 'pkt_header_image_position', 'above' ) == 'above' ) { pkt_render_header_image(); } ?>

		<div id="header-text-nav-container">
			<div class="inner-wrap">

				<div id="header-text-nav-wrap" class="clearfix">
					<div id="header-left-section">
						<?php
						if( ( pkt_options( 'pkt_show_header_logo_text', 'text_only' ) == 'both' || pkt_options( 'pkt_show_header_logo_text', 'text_only' ) == 'logo_only' ) && pkt_options( 'pkt_header_logo_image', '' ) != '' ) {
						?>
							<div id="header-logo-image">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo pkt_options( 'pkt_header_logo_image', '' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
							</div><!-- #header-logo-image -->
						<?php
						}
						$screen_reader = '';
                  if ( ( pkt_options( 'pkt_show_header_logo_text', 'text_only' ) == 'logo_only' || pkt_options( 'pkt_show_header_logo_text', 'text_only' ) == 'none' ) ) {
                     $screen_reader = 'screen-reader-text';
                  }
						?>
						<div id="header-text" class="<?php echo $screen_reader; ?>">
                  <?php if ( is_front_page() || is_home() ) : ?>
							<h1 id="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</h1>
                  <?php else : ?>
                     <h3 id="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                     </h3>
                  <?php endif; ?>
                  <?php
                  $description = get_bloginfo( 'description', 'display' );
                  if ( $description || is_customize_preview() ) : ?>
                     <p id="site-description"><?php echo $description; ?></p>
                  <?php endif; ?><!-- #site-description -->
						</div><!-- #header-text -->
					</div><!-- #header-left-section -->
					<div id="header-right-section">
						<?php
						if(pkt_options('pkt_header_telm_activ')=='1'){
						if(pkt_options('pkt_header_tel')!=='')
							echo "<div id='head_tel'>".pkt_options('pkt_header_tel')."</div>";
						echo "<div id='head_telM'><a href='".pkt_options('pkt_header_tel')."'>".pkt_options('pkt_header_tel')."</a></div>";
							if(pkt_options('pkt_header_tel2')!=='')
								echo "<div id='head_tel2'>".pkt_options('pkt_header_tel2')."</div>";
							echo "<div id='head_tel2M'><a href='".pkt_options('pkt_header_tel2')."'>".pkt_options('pkt_header_tel2')."</a></div>";
						if(pkt_options('pkt_header_mail')!=='')
							echo "<div id='head_mail'><a href='mailto:".pkt_options('pkt_header_mail')."'>".pkt_options('pkt_header_mail')."</a></div>";
						if(pkt_options('pkt_header_other')!=='')
							echo "<div id='head_other'>".pkt_options('pkt_header_other')."</div>";}
							if(pkt_options('pkt_header_text_activ')=='1'){echo "<div id='head_txt'>".pkt_options('pkt_header_text')."</div>";}
							
						if( is_active_sidebar( 'pkt_header_sidebar' ) ) {
						?>
						<div id="header-right-sidebar" class="clearfix">
						<?php
							// Calling the header sidebar if it exists.
							if ( !dynamic_sidebar( 'pkt_header_sidebar' ) ):
							endif;
						?>
						</div>
						<?php
						}
						?>
	<?php if(pkt_options('pkt_menu_layout')=='right'){ ?>			    	
<nav id="site-navigation" class="main-navigation-right" role="navigation">
							<h3 class="menu-toggle"><?php _e( 'Menu', 'pkt' ); ?></h3>
							<?php
								if ( has_nav_menu( 'primary' ) ) {
									wp_nav_menu( array( 'theme_location' => 'primary' ) );
								}
								else {
									wp_page_menu();
								}
							?>
							
						</nav>
					<?php }?>					
			    	</div><!-- #header-right-section -->
<?php if(pkt_options('pkt_menu_layout', 'top')=='top'){ ?>			    	
<nav id="site-navigation" class="main-navigation" role="navigation">
							<h3 class="menu-toggle"><?php _e( 'Menu', 'pkt' ); ?></h3>
							<?php
								if ( has_nav_menu( 'primary' ) ) {
									wp_nav_menu( array( 'theme_location' => 'primary' ) );
								}
								else {
									wp_page_menu();
								}
							?>
							<!-- share social -->
							       <div class="share-me hidden-xs">
           <div class="share-g pull-right">
           <!-- Place this tag where you want the +1 button to render. -->
           <div class="g-plusone" data-size="medium"></div>
           
           <!-- Place this tag after the last +1 button tag. -->
           <script type="text/javascript">
             window.___gcfg = {lang: 'pl'};
             (function() {
               var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
               po.src = 'https://apis.google.com/js/plusone.js';
               var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
             })();
           </script>
           </div> 
           <div class="share-fb pull-right">
           <div id="fb-root"></div>
           <script>(function(d, s, id) {
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) return;
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/pl_PL/all.js#xfbml=1&appId=";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));</script> 
           <div class="fb-like" data-send="false" data-layout="button_count" data-width="140" data-show-faces="false" data-font="lucida grande"></div>
           </div>
           
          </div>
          <!-- end share social -->
						</nav>
					<?php }?>	
			   </div><!-- #header-text-nav-wrap -->
			   
			</div><!-- .inner-wrap -->
			
		</div><!-- #header-text-nav-container -->

		<?php if( pkt_options( 'pkt_header_image_position', 'above' ) == 'below' ) { pkt_render_header_image(); } ?>

		<?php 
   	if( pkt_options( 'pkt_activate_slider', '0' ) == '1' ) {
		if( is_home() || is_front_page() ){
		pkt_featured_image_slider();}elseif(pkt_options( 'pkt_blog_slider', '0' ) == '1'){pkt_featured_image_slider();}
				
		}


 if(pkt_options('pkt_menu_layout')=='bottom'){ if(pkt_options('pkt_site_layout')=='wide_1218px'){echo '<div class="inner-wrap">';}?>			    	
<nav id="site-navigation" class="main-navigation" role="navigation">
							<h3 class="menu-toggle"><?php _e( 'Menu', 'pkt' ); ?></h3>
							<?php
								if ( has_nav_menu( 'primary' ) ) {
									wp_nav_menu( array( 'theme_location' => 'primary' ) );
								}
								else {
									wp_page_menu();
								}
							?>
							<!-- share social -->
							       <div class="share-me hidden-xs">
           <div class="share-g pull-right">
           <!-- Place this tag where you want the +1 button to render. -->
           <div class="g-plusone" data-size="medium"></div>
           
           <!-- Place this tag after the last +1 button tag. -->
           <script type="text/javascript">
             window.___gcfg = {lang: 'pl'};
             (function() {
               var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
               po.src = 'https://apis.google.com/js/plusone.js';
               var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
             })();
           </script>
           </div> 
           <div class="share-fb pull-right">
           <div id="fb-root"></div>
           <script>(function(d, s, id) {
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) return;
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/pl_PL/all.js#xfbml=1&appId=";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));</script> 
           <div class="fb-like" data-send="false" data-layout="button_count" data-width="140" data-show-faces="false" data-font="lucida grande"></div>
           </div>
           
          </div>
          <!-- end share social -->
						</nav>
					<?php if(pkt_options('pkt_site_layout')=='wide_1218px'){echo '</div>';} }?>
	</header>
	<?php do_action( 'pkt_after_header' ); ?>
	<?php do_action( 'pkt_before_main' ); ?>
	
	<div id="main" class="clearfix">
	<?php 		if( ( '' != pkt_header_title() )  && !( is_front_page() ) ) {
			if( !( pkt_options( 'pkt_blog_slider', '0' ) == '0' && is_home( ) ) ){ ?>
				<div class="header-post-title-container clearfix">
					<div class="inner-wrap">
						<div class="post-title-wrapper">
							<?php
							if( '' != pkt_header_title() ) {
							?>
                        <?php if ( is_home() ) : ?>
   						   	<h2 class="header-post-title-class"><?php echo pkt_header_title(); ?></h2>
                        <?php else : ?>
                           <h1 class="header-post-title-class"><?php echo pkt_header_title(); ?></h1>
                        <?php endif; ?>
						   <?php
							}
							?>
						</div>
						<?php if( function_exists( 'pkt_breadcrumb' ) ) { pkt_breadcrumb(); } ?>
					</div>
				</div>
			<?php
			}
	   	} ?>
		<div class="inner-wrap">