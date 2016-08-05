<?php
/**
 * @subpackage pkt
 * @since pkt 1.3.4
 */

function pkt_customize_register($wp_customize) {

   // Theme important links started
   class pkt_Important_Links extends WP_Customize_Control {

      public $type = "pkt-important-links";

      public function render_content() {
      echo 'CS Group Polska (dawniej pkt.pl) wspiera małe i średnie przedsiębiorstwa oferując zintegrowane działania marketingowe prowadzone w wyszukiwarkach internetowych, wykorzystując wszystkie dostępne kanały dotarcia i przestrzegając obowiązujących w branży zasad.';
      }

   }

   $wp_customize->add_section('pkt_important_links', array(
      'priority' => 700,
      'title' => __('O pkt.pl', 'pkt'),
   ));

   /**
    * This setting has the dummy Sanitization function as it contains no value to be sanitized
    */
   $wp_customize->add_setting('pkt_important_links', array(
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_links_sanitize'
   ));

   $wp_customize->add_control(new pkt_Important_Links($wp_customize, 'important_links', array(
      'section' => 'pkt_important_links',
      'settings' => 'pkt_important_links'
   )));
   // Theme Important Links Ended

   /*
    * Assigning the theme name
    */
   $pkt_themename = get_option( 'stylesheet' );
   $pkt_themename = preg_replace("/\W/", "_", strtolower( $pkt_themename ) );

   // Start of the Header Options
   // Header Options Area
   $wp_customize->add_panel('pkt_header_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 500,
      'title' => __('Header', 'pkt')
   ));

   // Header Logo upload option
   
   $wp_customize->add_section('pkt_header_logo', array(
      'priority' => 1,
      'title' => __('Header Logo', 'pkt'),
      'panel' => 'pkt_header_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_header_logo_image]', array(
      'default' => '',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esc_url_raw'
   ));

   $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $pkt_themename.'[pkt_header_logo_image]', array(
      'label' => __('Wgraj logo 100 X 100 pixeli :).', 'pkt'),
      'section' => 'pkt_header_logo',
      'setting' => $pkt_themename.'[pkt_header_logo_image]'
   )));

   $wp_customize->add_section( 'mytheme_new_section_name' , array(
   		'title'      => __( 'Visible Section Name', 'mytheme' ),
   		'priority'   => 30,
   ) );
   
   // Header logo and text display type option
   
   $wp_customize->add_section('pkt_show_option', array(
      'priority' => 2,
      'title' => __('Jak pokazać logo?', 'pkt'),
      'panel' => 'pkt_header_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_show_header_logo_text]', array(
      'default' => 'text_only',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_radio_select_sanitize'
   ));

   $wp_customize->add_control($pkt_themename.'[pkt_show_header_logo_text]', array(
      'type' => 'radio',
      'label' => __('Wybierz opcję.', 'pkt'),
      'section' => 'pkt_show_option',
      'choices' => array(
         'logo_only' => __('Tylko logo', 'pkt'),
         'text_only' => __('tylko text', 'pkt'),
         'both' => __('To i to', 'pkt'),
         'none' => __('wyłącz', 'pkt')
      )
   ));

   // Header image position option
   $wp_customize->add_section('pkt_header_image_position_section', array(
      'priority' => 3,
      'title' => __('Pozycja loga', 'pkt'),
      'panel' => 'pkt_header_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_header_image_position]', array(
      'default' => 'above',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_radio_select_sanitize'
   ));

   $wp_customize->add_control($pkt_themename.'[pkt_header_image_position]', array(
      'type' => 'radio',
      'label' => __('Wybierz pozycję loga.','pkt'),
      'section' => 'pkt_header_image_position_section',
      'choices' => array(
         'above' => __( 'Pozycja Przed (domyślnie): Wyświetla obraz nagłówka tuż nad tytułem głównej części strony i menu.', 'pkt' ),
         'below' => __( 'Pozycja Poniżej: Wyświetla obraz nagłówka tuż poniżej tytułu strony i głównej części menu.', 'pkt' )
      )
   ));
   // End of Header Options
   // Header tel & mail
   $wp_customize->add_section('pkt_header_tel_section', array(
   		'priority' => 30,
   		'title' => __('Kontakt w header', 'pkt'),
   		'panel' => 'pkt_header_options'
   ));
   //tel
   $wp_customize->add_setting($pkt_themename.'[pkt_header_tel]', array(
   'default' => '',
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'pkt_text_sanitize'
   ));
    
   $wp_customize->add_control($pkt_themename.'[pkt_header_tel]', array(
   		'type' => 'text',
   		'label' => __('Telefon w headzie.','pkt'),
   		'section' => 'pkt_header_tel_section',
   		
   
   ));
   //tel #2
   $wp_customize->add_setting($pkt_themename.'[pkt_header_tel2]', array(
   		'default' => '',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_text_sanitize'
   ));
   
   $wp_customize->add_control($pkt_themename.'[pkt_header_tel2]', array(
   		'type' => 'text',
   		'label' => __('Telefon #2 w headzie.','pkt'),
   		'section' => 'pkt_header_tel_section',
   		 
   		 
   ));
   //mail
   $wp_customize->add_setting($pkt_themename.'[pkt_header_mail]', array(
   'default' => '',
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'pkt_text_sanitize'
   		
   ));
   
   $wp_customize->add_control($pkt_themename.'[pkt_header_mail]', array(
   		'type' => 'text',
   		'label' => __('Mail w headzie.','pkt'),
   		'section' => 'pkt_header_tel_section',
   		'settings' => $pkt_themename.'[pkt_header_mail]'
  
   ));
   //inne
   $wp_customize->add_setting($pkt_themename.'[pkt_header_other]', array(
    'default' => '',
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'pkt_text_sanitize'
   		
   ));
   
   $wp_customize->add_control($pkt_themename.'[pkt_header_other]', array(
   		'type' => 'text',
   		'label' => __('Inne wiadomości w headzie.','pkt'),
   		'section' => 'pkt_header_tel_section',
   		'settings' => $pkt_themename.'[pkt_header_other]'
  
   ));
   //włączenie
   $wp_customize->add_setting($pkt_themename.'[pkt_header_telm_activ]', array(
   		'default' => 0,
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		
   ));
   
   $wp_customize->add_control($pkt_themename.'[pkt_header_telm_activ]', array(
   		'type' => 'checkbox',
   		'label' => __('Zaznacz by wyświetlić tel i mail w headzie.','pkt'),
   		'section' => 'pkt_header_tel_section',
   		'settings' => $pkt_themename.'[pkt_header_telm_activ]'
   		
   ));
   // Adding Text Area Control For Use In Customizer
   class pkt_HeadText_Area_Control extends WP_Customize_Control {
   
   	public $type = 'text_area';
   
   	public function render_content() {
   		?>
            <label>
               <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
               <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
         <?php
         }
   
      }
   // Header text
   $wp_customize->add_section('pkt_header_text_section', array(
   		'priority' => 30,
   		'title' => __('Pole tekstowe w headzie', 'pkt'),
   		'panel' => 'pkt_header_options'
   ));
   //tel
   $wp_customize->add_setting($pkt_themename.'[pkt_header_text]', array(
   		'default' => '',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_text_sanitize'
   ));
   
   $wp_customize->add_control(new pkt_HeadText_Area_Control($wp_customize, $pkt_themename.'[pkt_header_text]', array(
   		'label' => __('Wpisz dowolny tekst w sekcji head strony.','pkt'),
   		'section' => 'pkt_header_text_section',
   		 
   		 
   )));
   //włączenie
   $wp_customize->add_setting($pkt_themename.'[pkt_header_text_activ]', array(
   		'default' => 0,
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		 
   ));
    
   $wp_customize->add_control($pkt_themename.'[pkt_header_text_activ]', array(
   		'type' => 'checkbox',
   		'label' => __('Zaznacz by wyświetlić text w headzie.','pkt'),
   		'section' => 'pkt_header_text_section',
   		'settings' => $pkt_themename.'[pkt_header_text_activ]'
   
   ));
   // Start of the Design Options
   $wp_customize->add_panel('pkt_design_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 505,
      'title' => __('Wygląd', 'pkt')
   ));

   // site layout setting
   $wp_customize->add_section('pkt_site_layout_setting', array(
      'priority' => 1,
      'title' => __('Layout strony', 'pkt'),
      'panel' => 'pkt_design_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_site_layout]', array(
      'default' => 'box_1218px',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_radio_select_sanitize'
   ));

   $wp_customize->add_control($pkt_themename.'[pkt_site_layout]', array(
      'type' => 'radio',
      'label' => __('Wybierz układ strony.', 'pkt'),
      'choices' => array(
         'box_1218px' => __( 'Ograniczony układ z treścią szerokości 1200px', 'pkt' ),
         'box_978px' => __( 'Ograniczony układ z treścią szerokości 978px', 'pkt' ),
         'wide_1218px' => __( 'Szeroki układ z treścią szerokości 1200px', 'pkt' ),
         'wide_978px' => __( 'Szeroki układ z treścią szerokości 978px', 'pkt' ),
      ),
      'section' => 'pkt_site_layout_setting'
   ));
   //wyłączenie tła
   $wp_customize->add_section('pkt_header_bg', array(
   		'priority' => 30,
   		'title' => __('Tło w headzie', 'pkt'),
   		'panel' => 'pkt_header_options'
   ));
   $wp_customize->add_setting($pkt_themename.'[pkt_header_bg_color]', array(
   		'default' => '#ffffff',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_color_option_hex_sanitize',
   		'sanitize_js_callback' => 'pkt_color_escaping_option_sanitize'
   ));
    
   $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $pkt_themename.'[pkt_header_bg_color]', array(
   		'label' => __('Kolor tła w headzie.', 'pkt'),
   		'section' => 'pkt_header_bg',
   		'settings' => $pkt_themename.'[pkt_header_bg_color]'
   )));
   
   //tel
   $wp_customize->add_setting($pkt_themename.'[pkt_header_bg_activ]', array(
   		'default' => 0,
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		 
   ));
    
   $wp_customize->add_control($pkt_themename.'[pkt_header_bg_activ]', array(
   		'type' => 'checkbox',
   		'label' => __('Zaznacz by włączyć przeźroczyste tło w headzie.','pkt'),
   		'section' => 'pkt_header_bg',
   		'settings' => $pkt_themename.'[pkt_header_bg_activ]'
   
   ));
   
   // pozycja menu
   $wp_customize->add_setting($pkt_themename.'[pkt_menu_layout]', array(
      'default' => 'top',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_radio_select_sanitize'
   ));

   $wp_customize->add_control($pkt_themename.'[pkt_menu_layout]', array(
      'type' => 'radio',
      'label' => __('Wybierz pozycje menu względem bannera.', 'pkt'),
      'choices' => array(
         'top' => __( 'Nad banerem', 'pkt' ),
         'bottom' => __( 'Pod banerem', 'pkt' ),
      	'right' => __( 'Po prawej stronie loga', 'pkt' ),
      ),
      'section' => 'pkt_site_layout_setting'
   ));

   class pkt_Image_Radio_Control extends WP_Customize_Control {

      public function render_content() {

         if ( empty( $this->choices ) )
            return;

         $name = '_customize-radio-' . $this->id;

         ?>
         <style>
            #pkt-img-container .pkt-radio-img-img {
               border: 3px solid #DEDEDE;
               margin: 0 5px 5px 0;
               cursor: pointer;
               border-radius: 3px;
               -moz-border-radius: 3px;
               -webkit-border-radius: 3px;
            }
            #pkt-img-container .pkt-radio-img-selected {
               border: 3px solid #AAA;
               border-radius: 3px;
               -moz-border-radius: 3px;
               -webkit-border-radius: 3px;
            }
            input[type=checkbox]:before {
               content: '';
               margin: -3px 0 0 -4px;
            }
         </style>
         <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <ul class="controls" id='pkt-img-container'>
         <?php
            foreach ( $this->choices as $value => $label ) :
               $class = ($this->value() == $value)?'pkt-radio-img-selected pkt-radio-img-img':'pkt-radio-img-img';
               ?>
               <li style="display: inline;">
               <label>
                  <input <?php $this->link(); ?>style='display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
                  <img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo $class; ?>' />
               </label>
               </li>
               <?php
            endforeach;
         ?>
         </ul>
         <script type="text/javascript">
            jQuery(document).ready(function($) {
               $('.controls#pkt-img-container li img').click(function(){
                  $('.controls#pkt-img-container li').each(function(){
                     $(this).find('img').removeClass ('pkt-radio-img-selected') ;
                  });
                  $(this).addClass ('pkt-radio-img-selected') ;
               });
            });
         </script>
         <?php
      }
   }

   // default layout setting
   $wp_customize->add_section('pkt_default_layout_setting', array(
      'priority' => 2,
      'title' => __('Domyślny układ', 'pkt'),
      'panel'=> 'pkt_design_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_default_layout]', array(
      'default' => 'right_sidebar',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_radio_select_sanitize'
   ));

   $wp_customize->add_control(new pkt_Image_Radio_Control($wp_customize, $pkt_themename.'[pkt_default_layout]', array(
      'type' => 'radio',
      'label' => __('Wybierz domyślny układ stron.', 'pkt'),
      'section' => 'pkt_default_layout_setting',
      'settings' => $pkt_themename.'[pkt_default_layout]',
      'choices' => array(
         'right_sidebar' => pkt_ADMIN_IMAGES_URL . '/right-sidebar.png',
         'left_sidebar' => pkt_ADMIN_IMAGES_URL . '/left-sidebar.png',
         'no_sidebar_full_width' => pkt_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
         'no_sidebar_content_centered' => pkt_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
      )
   )));

   // default layout for pages
   $wp_customize->add_section('pkt_default_page_layout_setting', array(
      'priority' => 3,
      'title' => __('Dmyślny układ dla stron [wyłączny]', 'pkt'),
      'panel'=> 'pkt_design_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_pages_default_layout]', array(
      'default' => 'right_sidebar',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_radio_select_sanitize'
   ));

   $wp_customize->add_control(new pkt_Image_Radio_Control($wp_customize, $pkt_themename.'[pkt_pages_default_layout]', array(
      'type' => 'radio',
      'label' => __('Wybierz domyślny układ dla stron. Układ ten będzie widoczny na wszystkich stronach, chyba że wybrano unikalny układ jest dla konkretnej strony.', 'pkt'),
      'section' => 'pkt_default_page_layout_setting',
      'settings' => $pkt_themename.'[pkt_pages_default_layout]',
      'choices' => array(
         'right_sidebar' => pkt_ADMIN_IMAGES_URL . '/right-sidebar.png',
         'left_sidebar' => pkt_ADMIN_IMAGES_URL . '/left-sidebar.png',
         'no_sidebar_full_width' => pkt_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
         'no_sidebar_content_centered' => pkt_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
      )
   )));

   // default layout for single posts
   $wp_customize->add_section('pkt_default_single_posts_layout_setting', array(
      'priority' => 4,
      'title' => __('Domyślny układ dla postów [wyłączny]', 'pkt'),
      'panel'=> 'pkt_design_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_single_posts_default_layout]', array(
      'default' => 'right_sidebar',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_radio_select_sanitize'
   ));

   $wp_customize->add_control(new pkt_Image_Radio_Control($wp_customize, $pkt_themename.'[pkt_single_posts_default_layout]', array(
      'type' => 'radio',
      'label' => __('Wybierz domyślny układ dla pojedynczych postów. Układ ten zostanie uwzględniony we wszystkich pojedynczych  stronach typu post, chyba że unikalny układ jest ustawiony na określonym poscie.', 'pkt'),
      'section' => 'pkt_default_single_posts_layout_setting',
      'settings' => $pkt_themename.'[pkt_single_posts_default_layout]',
      'choices' => array(
         'right_sidebar' => pkt_ADMIN_IMAGES_URL . '/right-sidebar.png',
         'left_sidebar' => pkt_ADMIN_IMAGES_URL . '/left-sidebar.png',
         'no_sidebar_full_width' => pkt_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
         'no_sidebar_content_centered' => pkt_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
      )
   )));

   // blog posts display type setting
   $wp_customize->add_section('pkt_blog_posts_display_type_setting', array(
      'priority' => 5,
      'title' => __('Typ wyświetlania Blog Posts', 'pkt'),
      'panel' => 'pkt_design_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_archive_display_type]', array(
      'default' => 'blog_large',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_radio_select_sanitize'
   ));

   $wp_customize->add_control($pkt_themename.'[pkt_archive_display_type]', array(
      'type' => 'radio',
      'label' => __('Wybierz typ wyświetlacza dla najowszych postów - zobacz posty lub widoku strony posty (strona statyczna przodu).', 'pkt'),
      'choices' => array(
         'blog_large' => __( 'Blog Image Large', 'pkt' ),
         'blog_medium' => __( 'Blog Image Medium', 'pkt' ),
         'blog_medium_alternate' => __( 'Blog Image Alternate Medium', 'pkt' ),
         'blog_full_content' => __( 'Blog Full Content', 'pkt' ),
      ),
      'section' => 'pkt_blog_posts_display_type_setting'
   ));

   // Site primary color option
   $wp_customize->add_section('pkt_primary_color_setting', array(
      'panel' => 'pkt_design_options',
      'priority' => 6,
      'title' => __('Kolory odnośników i menu', 'pkt')
   ));


//kolor tekstu
   $wp_customize->add_setting($pkt_themename.'[pkt_text_color]', array(
   		'default' => '#000000',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_color_option_hex_sanitize',
   		'sanitize_js_callback' => 'pkt_color_escaping_option_sanitize'
   ));
   
   $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $pkt_themename.'[pkt_text_color]', array(
   		'label' => __('STRONA <br />Kolor tekstu.', 'pkt'),
   		'section' => 'pkt_primary_color_setting',
   		'settings' => $pkt_themename.'[pkt_text_color]'
   )));
//kolor nagłówków
   $wp_customize->add_setting($pkt_themename.'[pkt_head_color]', array(
   		'default' => '#000000',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_color_option_hex_sanitize',
   		'sanitize_js_callback' => 'pkt_color_escaping_option_sanitize'
   ));
    
   $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $pkt_themename.'[pkt_head_color]', array(
   		'label' => __('Kolor nagłówków.', 'pkt'),
   		'section' => 'pkt_primary_color_setting',
   		'settings' => $pkt_themename.'[pkt_head_color]'
   )));
//kolor linków
   $wp_customize->add_setting($pkt_themename.'[pkt_link_color]', array(
   		'default' => '#0FBE7C',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_color_option_hex_sanitize',
   		'sanitize_js_callback' => 'pkt_color_escaping_option_sanitize'
   ));
   
   $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $pkt_themename.'[pkt_link_color]', array(
   		'label' => __('Kolor linków.', 'pkt'),
   		'section' => 'pkt_primary_color_setting',
   		'settings' => $pkt_themename.'[pkt_link_color]'
   )));
   
   //kolor tła strony
   $wp_customize->add_setting($pkt_themename.'[pkt_tla_color]', array(
   		'default' => '#ffffff',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_color_option_hex_sanitize',
   		'sanitize_js_callback' => 'pkt_color_escaping_option_sanitize'
   ));
    
   $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $pkt_themename.'[pkt_tla_color]', array(
   		'label' => __('Kolor tła strony.', 'pkt'),
   		'section' => 'pkt_primary_color_setting',
   		'settings' => $pkt_themename.'[pkt_tla_color]'
   )));
    
       
//kolor menu tła
   $wp_customize->add_setting($pkt_themename.'[pkt_menu_bg]', array(
   		'default' => '#000000',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_color_option_hex_sanitize',
   		'sanitize_js_callback' => 'pkt_color_escaping_option_sanitize'
   ));
    
   $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $pkt_themename.'[pkt_menu_bg]', array(
   		'label' => __('MENU <br /> Kolor tła menu.', 'pkt'),
   		'section' => 'pkt_primary_color_setting',
   		'settings' => $pkt_themename.'[pkt_menu_bg]'
   )));
//kolor menu hover
   $wp_customize->add_setting($pkt_themename.'[pkt_menu_bghover]', array(
   		'default' => '#0FBE7C',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_color_option_hex_sanitize',
   		'sanitize_js_callback' => 'pkt_color_escaping_option_sanitize'
   ));
   
   $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $pkt_themename.'[pkt_menu_bghover]', array(
   		'label' => __('Kolor tła menu [hover].', 'pkt'),
   		'section' => 'pkt_primary_color_setting',
   		'settings' => $pkt_themename.'[pkt_menu_bghover]'
   )));
//kolor menu tekstu
   $wp_customize->add_setting($pkt_themename.'[pkt_menu_txt]', array(
   		'default' => '#ffffff',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_color_option_hex_sanitize',
   		'sanitize_js_callback' => 'pkt_color_escaping_option_sanitize'
   ));
    
   $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $pkt_themename.'[pkt_menu_txt]', array(
   		'label' => __('Kolor tekstu menu.', 'pkt'),
   		'section' => 'pkt_primary_color_setting',
   		'settings' => $pkt_themename.'[pkt_menu_txt]'
   )));
//kolor menu tekstu hover
   $wp_customize->add_setting($pkt_themename.'[pkt_menu_txthover]', array(
   		'default' => '#000000',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_color_option_hex_sanitize',
   		'sanitize_js_callback' => 'pkt_color_escaping_option_sanitize'
   ));
   
   $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $pkt_themename.'[pkt_menu_txthover]', array(
   		'label' => __('Kolor tekstu menu [hover].', 'pkt'),
   		'section' => 'pkt_primary_color_setting',
   		'settings' => $pkt_themename.'[pkt_menu_txthover]'
   )));
/*    // Site dark light skin option
   $wp_customize->add_section('pkt_color_skin_setting', array(
   		'priority' => 7,
   		'title' => __('Color Skin', 'pkt'),
   		'panel'=> 'pkt_design_options'
   ));
   
   $wp_customize->add_setting($pkt_themename.'[pkt_color_skin]', array(
   		'default' => 'light',
   		'type' => 'option',
   		'capability' => 'edit_theme_options',
   		'sanitize_callback' => 'pkt_radio_select_sanitize'
   ));
   
   $wp_customize->add_control(new pkt_Image_Radio_Control($wp_customize, $pkt_themename.'[pkt_color_skin]', array(
   		'type' => 'radio',
   		'label' => __('Choose the light or dark skin. This will be reflected in whole site.', 'pkt'),
   		'section' => 'pkt_color_skin_setting',
   		'settings' => $pkt_themename.'[pkt_color_skin]',
   		'choices' => array(
   				'light' => pkt_ADMIN_IMAGES_URL . '/light-color.jpg',
   				'dark' => pkt_ADMIN_IMAGES_URL . '/dark-color.jpg'
   		)
   ))); */

   // Custom CSS setting
   class pkt_Custom_CSS_Control extends WP_Customize_Control {

      public $type = 'custom_css';

      public function render_content() {
      ?>
         <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
         </label>
      <?php
      }

   }

   $wp_customize->add_section('pkt_custom_css_setting', array(
      'priority' => 8,
      'title' => __('Własny CSS', 'pkt'),
      'panel' => 'pkt_design_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_custom_css]', array(
      'default' => '',
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'wp_filter_nohtml_kses',
      'sanitize_js_callback' => 'wp_filter_nohtml_kses'
   ));

   $wp_customize->add_control(new pkt_Custom_CSS_Control($wp_customize, $pkt_themename.'[pkt_custom_css]', array(
      'label' => __('Napisz własny css.', 'pkt'),
      'section' => 'pkt_custom_css_setting',
      'settings' => $pkt_themename.'[pkt_custom_css]'
   )));
   // End of Design Options

   // Start of the Additional Options
   $wp_customize->add_panel('pkt_additional_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 510,
      'title' => __('Dodatkowe opcje', 'pkt')
   ));

   // Favicon activate option
   $wp_customize->add_section('pkt_additional_activate_section', array(
      'priority' => 1,
      'title' => __('Aktywuj favicon', 'pkt'),
      'panel' => 'pkt_additional_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_activate_favicon]', array(
      'default' => 0,
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_checkbox_sanitize'
   ));

   $wp_customize->add_control($pkt_themename.'[pkt_activate_favicon]', array(
      'type' => 'checkbox',
      'label' => __('Zaznacz by aktywować favicon', 'pkt'),
      'section' => 'pkt_additional_activate_section',
      'settings' => $pkt_themename.'[pkt_activate_favicon]'
   ));

   // Fav icon upload option
   $wp_customize->add_section('pkt_favicon_upload_section',array(
      'priority' => 2,
      'title' => __('Upload favicon', 'pkt'),
      'panel' => 'pkt_additional_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_favicon]', array(
      'default' => 0,
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'esc_url_raw'
   ));

   $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $pkt_themename.'[pkt_favicon]', array(
      'label' => __('Upload favicon na stronę.', 'pkt'),
      'section' => 'pkt_favicon_upload_section',
      'settings' => $pkt_themename.'[pkt_favicon]'
   )));
   // End of Additional Options

   // Adding Text Area Control For Use In Customizer
   class pkt_Text_Area_Control extends WP_Customize_Control {

      public $type = 'text_area';

      public function render_content() {
      ?>
         <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
         </label>
      <?php
      }

   }

   // Start of the Slider Options
   $wp_customize->add_panel('pkt_slider_options', array(
      'capabitity' => 'edit_theme_options',
      'priority' => 515,
      'title' => __('Slider', 'pkt')
   ));

   // Slider activate option
   $wp_customize->add_section('pkt_slider_activate_section', array(
      'priority' => 1,
      'title' => __('Aktywuj slider', 'pkt'),
      'panel' => 'pkt_slider_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_activate_slider]', array(
      'default' => 0,
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_checkbox_sanitize'
   ));

   $wp_customize->add_control($pkt_themename.'[pkt_activate_slider]', array(
      'type' => 'checkbox',
      'label' => __('Zaznacz by aktywować slider.', 'pkt'),
      'section' => 'pkt_slider_activate_section',
      'settings' => $pkt_themename.'[pkt_activate_slider]'
   ));

   // Disable slider in blog page
   $wp_customize->add_section('pkt_disable_slider_blog_page_section', array(
      'priority' => 2,
      'title' => __('Włącz slider na podstronach', 'pkt'),
      'panel' => 'pkt_slider_options'
   ));

   $wp_customize->add_setting($pkt_themename.'[pkt_blog_slider]', array(
      'default' => 0,
      'type' => 'option',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'pkt_checkbox_sanitize'
   ));

   $wp_customize->add_control($pkt_themename.'[pkt_blog_slider]', array(
      'type' => 'checkbox',
      'label' => __('Zaznacz by wyłączyć slider na podstronach', 'pkt'),
      'section' => 'pkt_disable_slider_blog_page_section',
      'settings' => $pkt_themename.'[pkt_blog_slider]'
   ));

   for ( $i = 1; $i <= 5; $i++ ) {
      // adding slider section
      $wp_customize->add_section('pkt_slider_number_section'.$i, array(
         'priority' => 10,
         'title' => sprintf( __( 'Wgraj zdjęcie #%1$s', 'pkt' ), $i ),
         'panel' => 'pkt_slider_options'
      ));

      // adding slider image url
      $wp_customize->add_setting($pkt_themename.'[pkt_slider_image'.$i.']', array(
         'default' => '',
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'esc_url_raw'
      ));

      $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, $pkt_themename.'[pkt_slider_image'.$i.']', array(
         'label' => __( 'Upload slider image.', 'pkt' ),
         'section' => 'pkt_slider_number_section'.$i,
         'setting' => $pkt_themename.'[pkt_slider_image'.$i.']',
      )));

      // adding slider title
      $wp_customize->add_setting($pkt_themename.'[pkt_slider_title'.$i.']', array(
         'default' => '',
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'wp_filter_nohtml_kses'
      ));

      $wp_customize->add_control($pkt_themename.'[pkt_slider_title'.$i.']', array(
         'label' => __( 'Wpisz tytuł slajdu.', 'pkt' ),
         'section' => 'pkt_slider_number_section'.$i,
         'setting' => $pkt_themename.'[pkt_slider_title'.$i.']'
      ));

      // adding slider description
      $wp_customize->add_setting($pkt_themename.'[pkt_slider_text'.$i.']', array(
         'default' => '',
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'pkt_text_sanitize'
      ));

      $wp_customize->add_control(new pkt_Text_Area_Control($wp_customize, $pkt_themename.'[pkt_slider_text'.$i.']', array(
         'label' => __( 'Wpisz opis slajdu.', 'pkt' ),
         'section' => 'pkt_slider_number_section'.$i,
         'setting' => $pkt_themename.'[pkt_slider_text'.$i.']'
      )));

      // adding slider button text
      $wp_customize->add_setting($pkt_themename.'[pkt_slider_button_text'.$i.']', array(
         'default' => __( 'Czytaj dalej', 'pkt' ),
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'wp_filter_nohtml_kses'
      ));

      $wp_customize->add_control($pkt_themename.'[pkt_slider_button_text'.$i.']', array(
         'label' => __( 'Wpisz napis guzika', 'pkt' ),
         'section' => 'pkt_slider_number_section'.$i,
         'setting' => $pkt_themename.'[pkt_slider_button_text'.$i.']'
      ));

      // adding button url
      $wp_customize->add_setting($pkt_themename.'[pkt_slider_link'.$i.']', array(
         'default' => '',
         'type' => 'option',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'esc_url_raw'
      ));

      $wp_customize->add_control($pkt_themename.'[pkt_slider_link'.$i.']', array(
         'label' => __( 'Wpisz link do guzika', 'pkt' ),
         'section' => 'pkt_slider_number_section'.$i,
         'setting' => $pkt_themename.'[pkt_slider_link'.$i.']'
      ));
   }
   // End of Slider Options

   // Start of data sanitization
   // radio/select sanitization
   function pkt_radio_select_sanitize( $input, $setting ) {
      // Ensuring that the input is a slug.
      $input = sanitize_key( $input );
      // Get the list of choices from the control associated with the setting.
      $choices = $setting->manager->get_control( $setting->id )->choices;
      // If the input is a valid key, return it, else, return the default.
      return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
   }

   // checkbox sanitize
   function pkt_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return '';
      }
   }

   // text-area sanitize
   function pkt_text_sanitize($input) {
      return wp_kses_post( force_balance_tags( $input ) );
   }

   // color sanitization
   function pkt_color_option_hex_sanitize($color) {
      if ($unhashed = sanitize_hex_color_no_hash($color))
         return '#' . $unhashed;

      return $color;
   }

   function pkt_color_escaping_option_sanitize($input) {
      $input = esc_attr($input);
      return $input;
   }

   // sanitization of links
   function pkt_links_sanitize() {
      return false;
   }

}
add_action('customize_register', 'pkt_customize_register');

/*****************************************************************************************/

/**
 * Enqueue scripts for customizer
 */
function pkt_customizer_js() {
   wp_enqueue_script( 'pkt_customizer_script', get_template_directory_uri() . '/js/pkt_customizer.js', array("jquery"), 'false', true  );

   wp_localize_script( 'pkt_customizer_script', 'pkt_customizer_obj', array(



   ) );
}
add_action( 'customize_controls_enqueue_scripts', 'pkt_customizer_js' );
?>