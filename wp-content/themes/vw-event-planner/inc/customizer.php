<?php
/**
 * VW Event Planner Theme Customizer
 *
 * @package VW Event Planner
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_event_planner_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_event_planner_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-event-planner' ),
	) );

	// Layout
	$wp_customize->add_section( 'vw_event_planner_left_right', array(
    	'title'      => __( 'General Settings', 'vw-event-planner' ),
		'panel' => 'vw_event_planner_panel_id'
	) );

	$wp_customize->add_setting('vw_event_planner_theme_options',array(
        'default' => __('Right Sidebar','vw-event-planner'),
        'sanitize_callback' => 'vw_event_planner_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_event_planner_theme_options',array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-event-planner'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-event-planner'),
        'section' => 'vw_event_planner_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-event-planner'),
            'Right Sidebar' => __('Right Sidebar','vw-event-planner'),
            'One Column' => __('One Column','vw-event-planner'),
            'Three Columns' => __('Three Columns','vw-event-planner'),
            'Four Columns' => __('Four Columns','vw-event-planner'),
            'Grid Layout' => __('Grid Layout','vw-event-planner')
        ),
	) );

	$wp_customize->add_setting('vw_event_planner_page_layout',array(
        'default' => __('Right Sidebar','vw-event-planner'),
        'sanitize_callback' => 'vw_event_planner_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_event_planner_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-event-planner'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-event-planner'),
        'section' => 'vw_event_planner_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-event-planner'),
            'Right Sidebar' => __('Right Sidebar','vw-event-planner'),
            'One Column' => __('One Column','vw-event-planner')
        ),
	) );

	//Topbar
	$wp_customize->add_section( 'vw_event_planner_topbar', array(
    	'title'      => __( 'Topbar Settings', 'vw-event-planner' ),
		'panel' => 'vw_event_planner_panel_id'
	) );

	$wp_customize->add_setting('vw_event_planner_call_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_event_planner_call_text',array(
		'label'	=> __('Add Phone Number','vw-event-planner'),
		'input_attrs' => array(
            'placeholder' => __( '+00 987 654 1230', 'vw-event-planner' ),
        ),
		'section'=> 'vw_event_planner_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_event_planner_email_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_event_planner_email_text',array(
		'label'	=> __('Add Email Address','vw-event-planner'),
		'input_attrs' => array(
            'placeholder' => __( 'example@gmail.com', 'vw-event-planner' ),
        ),
		'section'=> 'vw_event_planner_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_event_planner_timming_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_event_planner_timming_text',array(
		'label'	=> __('Add Open Timming','vw-event-planner'),
		'input_attrs' => array(
            'placeholder' => __( 'Mon to Fri 8:00am - 9:00pm ', 'vw-event-planner' ),
        ),
		'section'=> 'vw_event_planner_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_event_planner_buynow_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('vw_event_planner_buynow_url',array(
		'label'	=> __('Add Button URL','vw-event-planner'),
		'input_attrs' => array(
            'placeholder' => __( 'www.example.com', 'vw-event-planner' ),
        ),
		'section'=> 'vw_event_planner_topbar',
		'type'=> 'url'
	));

	$wp_customize->add_setting('vw_event_planner_buynow_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_event_planner_buynow_text',array(
		'label'	=> __('Add Button Text','vw-event-planner'),
		'input_attrs' => array(
            'placeholder' => __( 'Book Now', 'vw-event-planner' ),
        ),
		'section'=> 'vw_event_planner_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_event_planner_header_search',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_event_planner_header_search',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Search','vw-event-planner'),
       'section' => 'vw_event_planner_topbar',
    ));
    
	//Slider
	$wp_customize->add_section( 'vw_event_planner_slidersettings' , array(
    	'title'      => __( 'Slider Section', 'vw-event-planner' ),
		'panel' => 'vw_event_planner_panel_id'
	) );

	$wp_customize->add_setting('vw_event_planner_slider_arrows',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_event_planner_slider_arrows',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide slider','vw-event-planner'),
       'section' => 'vw_event_planner_slidersettings',
    ));

	for ( $count = 1; $count <= 4; $count++ ) {

		$wp_customize->add_setting( 'vw_event_planner_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_event_planner_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_event_planner_slider_page' . $count, array(
			'label'    => __( 'Select Slider Page', 'vw-event-planner' ),
			'description' => __('Slider image size (1500 x 590)','vw-event-planner'),
			'section'  => 'vw_event_planner_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}
    
	//Event Services section
	$wp_customize->add_section( 'vw_event_planner_best_services_section' , array(
    	'title'      => __( 'Best Event Services', 'vw-event-planner' ),
		'priority'   => null,
		'panel' => 'vw_event_planner_panel_id'
	) );

	$wp_customize->add_setting('vw_event_planner_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_event_planner_section_title',array(
		'label'	=> __('Add Section Title','vw-event-planner'),
		'input_attrs' => array(
            'placeholder' => __( 'Best Event Services', 'vw-event-planner' ),
        ),
		'section'=> 'vw_event_planner_best_services_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_event_planner_section_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_event_planner_section_text',array(
		'label'	=> __('Add Section Text','vw-event-planner'),
		'input_attrs' => array(
            'placeholder' => __( 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500s.s', 'vw-event-planner' ),
        ),
		'section'=> 'vw_event_planner_best_services_section',
		'type'=> 'text'
	));

	$categories = get_categories();
	$cat_post = array();
	$cat_post[]= 'select';
	$i = 0;	
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_event_planner_best_services',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_event_planner_sanitize_choices',
	));
	$wp_customize->add_control('vw_event_planner_best_services',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display Event Services','vw-event-planner'),
		'description' => __('Image Size (533 x 333)','vw-event-planner'),
		'section' => 'vw_event_planner_best_services_section',
	));

	//Content Craetion
	$wp_customize->add_section( 'vw_event_planner_content_section' , array(
    	'title' => __( 'Customize Home Page', 'vw-event-planner' ),
		'priority' => null,
		'panel' => 'vw_event_planner_panel_id'
	) );

	$wp_customize->add_setting('vw_event_planner_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new vw_event_planner_Content_Creation( $wp_customize, 'vw_event_planner_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-event-planner' ),
		),
		'section' => 'vw_event_planner_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-event-planner' ),
	) ) );

	//Footer Text
	$wp_customize->add_section('vw_event_planner_footer',array(
		'title'	=> __('Footer','vw-event-planner'),
		'panel' => 'vw_event_planner_panel_id',
	));	
	
	$wp_customize->add_setting('vw_event_planner_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_event_planner_footer_text',array(
		'label'	=> __('Copyright Text','vw-event-planner'),
		'input_attrs' => array(
            'placeholder' => __( 'Copyright 2019, .....', 'vw-event-planner' ),
        ),
		'section'=> 'vw_event_planner_footer',
		'type'=> 'text'
	));	
}

add_action( 'customize_register', 'vw_event_planner_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Event_Planner_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Event_Planner_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new VW_Event_Planner_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'VW Event Planner', 'vw-event-planner' ),
					'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-event-planner' ),
					'pro_url'  => esc_url('https://www.vwthemes.com/themes/event-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-event-planner-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-event-planner-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Event_Planner_Customize::get_instance();