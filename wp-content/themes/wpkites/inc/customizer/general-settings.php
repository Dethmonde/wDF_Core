<?php
/**
 * General Settings Customizer
 *
 * @package wpkites
 */
function wpkites_general_settings_customizer ( $wp_customize )
{
	        
	$wp_customize->add_panel('wpkites_general_settings',
		array(
			'priority' => 112,
			'capability' => 'edit_theme_options',
			'title' => esc_html__('General Settings','wpkites' )
		)
	);
	
	// Preloader
	$wp_customize->add_section(
        'preloader_section',
        array(
            'title' =>esc_html__('Preloader','wpkites' ),
			'panel'  => 'wpkites_general_settings',
			'priority'   => 1,
			
			)
    );

     $wp_customize->add_setting('preloader_enable',
		array(
			'default' => false,
			'sanitize_callback' => 'wpkites_sanitize_checkbox'
			)
	);

	$wp_customize->add_control(new WPKites_Toggle_Control( $wp_customize, 'preloader_enable',
		array(
			'label'    => esc_html__( 'Enable/Disable Preloader', 'wpkites'  ),
			'section'  => 'preloader_section',
			'type'     => 'toggle',
			'priority' => 1,
		)
	));

	// Sticky Header 
	$wp_customize->add_section(
        'sticky_header_section',
        array(
            'title' =>esc_html__('Sticky Header','wpkites' ),
			'panel'  => 'wpkites_general_settings',
			'priority'   => 1,
			
			)
    );

     $wp_customize->add_setting('sticky_header_enable',
		array(
			'default' => false,
			'sanitize_callback' => 'wpkites_sanitize_checkbox'
			)
	);

	$wp_customize->add_control(new WPKites_Toggle_Control( $wp_customize, 'sticky_header_enable',
		array(
			'label'    => esc_html__( 'Enable/Disable Sticky Header', 'wpkites'  ),
			'section'  => 'sticky_header_section',
			'type'     => 'toggle',
			'priority' => 1,
		)
	));


	// Scroll to top
	$wp_customize->add_section(
        'scrolltotop_setting_section',
        array(
            'title' =>esc_html__('Scroll to Top','wpkites' ),
			'panel'  => 'wpkites_general_settings',
			'priority'   => 3,
			
			)
    );
	
    $wp_customize->add_setting('scrolltotop_setting_enable',
		array(
			'default' => true,
			'sanitize_callback' => 'wpkites_sanitize_checkbox'
			)
	);

	$wp_customize->add_control(new WPKites_Toggle_Control( $wp_customize, 'scrolltotop_setting_enable',
		array(
			'label'    => esc_html__( 'Enable/Disable Scroll to Top', 'wpkites'  ),
			'section'  => 'scrolltotop_setting_section',
			'type'     => 'toggle',
			'priority' => 1,
		)
	));

	// After Menu
	$wp_customize->add_section(
        'after_menu_setting_section',
        array(
            'title' =>esc_html__('After Menu','wpkites' ),
			'panel'  => 'wpkites_general_settings',
			'priority'   => 3,
			)
    );

	//Dropdown button or html option
	$wp_customize->add_setting(
    'after_menu_multiple_option',
    array(
        'default'           =>  'none',
		'capability'        =>  'edit_theme_options',
		'sanitize_callback' =>  'wpkites_sanitize_select',
    ));
	$wp_customize->add_control('after_menu_multiple_option', array(
		'label' => esc_html__('After Menu','wpkites' ),
        'section' => 'after_menu_setting_section',
		'setting' => 'after_menu_multiple_option',
		'type'    =>  'select',
		'choices' =>  array(
			'none'		=>	esc_html__('None', 'wpkites' ),
			'menu_btn' 	=> esc_html__('Button', 'wpkites' ),
			'html' 		=> esc_html__('HTML', 'wpkites' ),
			)
	));

	//After Menu Button Text
	$wp_customize->add_setting(
    'after_menu_btn_txt',
    array(
        'default'           =>  '',
		'capability'        =>  'edit_theme_options',
		'sanitize_callback' =>  'wpkites_sanitize_text',
    ));
	$wp_customize->add_control('after_menu_btn_txt', array(
		'label' => esc_html__('Button Text','wpkites' ),
        'section' => 'after_menu_setting_section',
		'setting' => 'after_menu_btn_txt',
		'type' => 'text',
	));

	//After Menu Button Link
	$wp_customize->add_setting(
    'after_menu_btn_link',
    array(
        'default'           =>  '',
		'capability'        =>  'edit_theme_options',
		'sanitize_callback' =>  'esc_url_raw',
    ));
	$wp_customize->add_control('after_menu_btn_link', array(
		'label' => esc_html__('Button Link','wpkites' ),
        'section' => 'after_menu_setting_section',
		'setting' => 'after_menu_btn_link',
		'type' => 'text',
	));

	//Open in new tab
	$wp_customize->add_setting(
    'after_menu_btn_new_tabl',
    array(
        'default'           =>  false,
		'capability'        =>  'edit_theme_options',
		'sanitize_callback' =>  'wpkites_sanitize_checkbox',
    ) );
	
	$wp_customize->add_control('after_menu_btn_new_tabl', array(
		'label' => esc_html__('Open link in a new tab','wpkites' ),
        'section' => 'after_menu_setting_section',
		'setting' => 'after_menu_btn_new_tabl',
		'type'    =>  'checkbox'
	));	

	//Border Radius
	$wp_customize->add_setting( 'after_menu_btn_border',
			array(
				'default' => 0,
				'transport' => 'postMessage',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( new WPKites_Slider_Custom_Control( $wp_customize, 'after_menu_btn_border',
			array(
				'label' => esc_html__( 'Button Border Radius', 'wpkites'  ),
				'section' => 'after_menu_setting_section',
				'input_attrs' => array(
					'min' => 0,
					'max' => 30,
					'step' => 1,),)
		));

	//After Menu HTML section
	$wp_customize->add_setting('after_menu_html', 
		array(
		'default'=>	'',
			'capability'        =>  'edit_theme_options',
			'sanitize_callback'=> 'wpkites_sanitize_text',
		)
	);

	$wp_customize->add_control('after_menu_html', 
		array(
			'label'=> esc_html__('HTML','wpkites' ),
			'section'=> 'after_menu_setting_section',
			'type'=> 'textarea',
		)
	);

	//Enable/Disable Search Icon
    $wp_customize->add_setting('search_btn_enable',
		array(
			'default' => false,
			'sanitize_callback' => 'wpkites_sanitize_checkbox'
			)
	);

	$wp_customize->add_control(new WPKites_Toggle_Control( $wp_customize, 'search_btn_enable',
		array(
			'label'    => esc_html__( 'Enable/Disable Search Icon', 'wpkites'  ),
			'section'  => 'after_menu_setting_section',
			'type'     => 'toggle',
		)
	));

	//Enable/Disable Cart Icon
    $wp_customize->add_setting('cart_btn_enable',
		array(
			'default' => false,
			'sanitize_callback' => 'wpkites_sanitize_checkbox'
			)
	);

	$wp_customize->add_control(new WPKites_Toggle_Control( $wp_customize, 'cart_btn_enable',
		array(
			'label'    => esc_html__( 'Enable/Disable Cart Icon', 'wpkites'  ),
			'section'  => 'after_menu_setting_section',
			'type'     => 'toggle',
		)
	));	

	// Container, Content and Sidebar Width
	$wp_customize->add_section(
        'container_width_section',
        array(
            'title' =>esc_html__('Container Width','wpkites' ),
			'panel'  => 'wpkites_general_settings',
			'priority'   => 5,
			
			)
    );

	// Container Width
    $wp_customize->add_setting( 'container_width',
		array(
			'default' => 1140,
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		)
	);
	$wp_customize->add_control( new WPKites_Slider_Custom_Control( $wp_customize, 'container_width',
		array(
			'label' => esc_html__( 'Container Width (In px)', 'wpkites'  ),
			'description'   =>  esc_html__( 'Note: Container Width will not work with stretched sidebar layout.', 'wpkites'  ),
			'section' => 'container_width_section',
			'priority'      =>  1,
			'input_attrs' => array(
				'min' => 600,
				'max' => 1920,
				'step' => 1,
			),
		)
	));

	// Content Width
	$wp_customize->add_setting( 'content_width',
		array(
			'default' => 66.6,
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		)
	);
	$wp_customize->add_control( new WPKites_Slider_Custom_Control( $wp_customize, 'content_width',
		array(
			'label' => esc_html__( 'Content Width (In %)', 'wpkites'  ),
			'description'   =>  esc_html__( 'Note: Content Width will work only with sidebar layout.', 'wpkites'  ),
			'section' => 'container_width_section',
			'priority'      =>  2,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
		)
	));

	// Sidebar Width
	$wp_customize->add_setting( 'sidebar_width',
		array(
			'default' => 33.3,
			'transport' => 'postMessage',
			'sanitize_callback' => 'absint'
		)
	);
	$wp_customize->add_control( new WPKites_Slider_Custom_Control( $wp_customize, 'sidebar_width',
		array(
			'label' => esc_html__( 'Sidebar Width (In %)', 'wpkites'  ),
			'description'   =>  esc_html__( 'Note: Sidebar Width will work only with sidebar layout.', 'wpkites'  ),
			'section' => 'container_width_section',
			'priority'      =>  3,
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
		)
	));


	/******************** Sidebar Layouts *******************************/
	$wp_customize->add_section('sidebar_layout_setting_section',
        array(
            'title' =>esc_html__('Sidebar Layout','wpkites' ),
			'panel'  => 'wpkites_general_settings',
		)
    );
    // Blog/Archive sidebar layout
    $wp_customize->add_setting( 'blog_sidebar_layout',
		array(
			'default'           => 'right',
	        'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wpkites_sanitize_select'
		)
	);
	$wp_customize->add_control( new WPKites_Image_Radio_Button_Custom_Control( $wp_customize, 'blog_sidebar_layout',
		array(
			'label' => esc_html__( 'Blog/Archives', 'wpkites'  ),
			'section' => 'sidebar_layout_setting_section',
			'priority'  => 1,
			'choices' => array(
				'right' => array( 
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/right.jpg',
				),
				'left' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/left.jpg',
				),
				'full' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/full.jpg',
				),
				'stretched' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/stretched.jpg',
				)
			)
		)
	) );


	// Single post sidebar layout
    $wp_customize->add_setting( 'single_post_sidebar_layout',
		array(
			'default'           => 'right',
	        'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wpkites_sanitize_select'
		)
	);
	$wp_customize->add_control( new WPKites_Image_Radio_Button_Custom_Control( $wp_customize, 'single_post_sidebar_layout',
		array(
			'label' => esc_html__( 'Single Post', 'wpkites'  ),
			'section' => 'sidebar_layout_setting_section',
			'priority'  => 2,
			'choices' => array(
				'right' => array( 
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/right.jpg',
				),
				'left' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/left.jpg',
				),
				'full' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/full.jpg',
				),
				'stretched' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/stretched.jpg',
				)
			)
		)
	) );

	// Page sidebar layout
    $wp_customize->add_setting( 'page_sidebar_layout',
		array(
			'default'           => 'right',
	        'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wpkites_sanitize_select'
		)
	);
	$wp_customize->add_control( new WPKites_Image_Radio_Button_Custom_Control( $wp_customize, 'page_sidebar_layout',
		array(
			'label' => esc_html__( 'Page', 'wpkites'  ),
			'section' => 'sidebar_layout_setting_section',
			'priority'  => 3,
			'choices' => array(
				'right' => array( 
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/right.jpg',
				),
				'left' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/left.jpg',
				),
				'full' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/full.jpg',
				),
				'stretched' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/stretched.jpg',
				)
			)
		)
	) );


	/******************** Footer Widgets *******************************/
	$wp_customize->add_section(
        'fwidgets_setting_section',
        array(
            'title' =>esc_html__('Footer Widgets','wpkites' ),
			'panel'  => 'wpkites_general_settings',
			)
    );

	$wp_customize->add_setting( 'footer_widgets_section',
	array(
		'default' => 3,
		'capability'        =>  'edit_theme_options',
		'sanitize_callback' => 'wpkites_sanitize_select'
	));
	$wp_customize->add_control( new WPKites_Image_Radio_Button_Custom_Control( $wp_customize, 'footer_widgets_section',
	array(
		'label' => esc_html__( 'Widgets Layout', 'wpkites'  ),
		'section' => 'fwidgets_setting_section',
		'choices' => array(
			2 => array( 
				'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/2-col.png',
			),
			3 => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/3-col.png',
			),
			4 => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'assets/images/4-col.png',
			)
		)
	)
) );

	}
add_action( 'customize_register', 'wpkites_general_settings_customizer' );