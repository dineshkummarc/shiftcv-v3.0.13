<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.22
 */

// If this theme is a free version of premium theme
if ( ! defined( 'SHIFT_CV_THEME_FREE' ) ) {
	define( 'SHIFT_CV_THEME_FREE', false );
}
if ( ! defined( 'SHIFT_CV_THEME_FREE_WP' ) ) {
	define( 'SHIFT_CV_THEME_FREE_WP', false );
}

// If this theme uses multiple skins
if ( ! defined( 'SHIFT_CV_ALLOW_SKINS' ) ) {
	define( 'SHIFT_CV_ALLOW_SKINS', true );
}
if ( ! defined( 'SHIFT_CV_DEFAULT_SKIN' ) ) {
	define( 'SHIFT_CV_DEFAULT_SKIN', 'default' );
}

// Theme storage
// Attention! Must be in the global namespace to compatibility with WP CLI
$GLOBALS['SHIFT_CV_STORAGE'] = array(

	// Theme required plugin's slugs
	'required_plugins'   => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'         => esc_html__( 'ThemeREX Addons', 'shift-cv' ),

			// Recommended (supported) plugins for both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'elementor'          => esc_html__( 'Elementor', 'shift-cv' ),
			'contact-form-7'     => esc_html__( 'Contact Form 7', 'shift-cv' ),
			'trx_updater'     	=> esc_html__( 'ThemeREX Updater', 'shift-cv' ),
			'gdpr-framework'     => esc_html__( 'The GDPR Framework', 'shift-cv' ),	// not for install
		),
		// List of plugins for the FREE version only
		//-----------------------------------------------------
		SHIFT_CV_THEME_FREE
			? array(
				// Recommended (supported) plugins for the FREE (lite) version
				'siteorigin-panels' => esc_html__( 'SiteOrigin Panels', 'shift-cv' ),
			)

		// List of plugins for the PREMIUM version only
		//-----------------------------------------------------
			: array(
				// Recommended (supported) plugins for the PRO (full) version
				// If plugin not need - comment (or remove) it
				'essential-grid'             => esc_html__( 'Essential Grid', 'shift-cv' ),
			)
	),

	// Theme-specific blog layouts
	'blog_styles'        => array_merge(
		// Layouts for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			'excerpt' => array(
				'title'   => esc_html__( 'Standard', 'shift-cv' ),
				'archive' => 'index-excerpt',
				'item'    => 'content-excerpt',
				'styles'  => 'excerpt',
			),
			'classic' => array(
				'title'   => esc_html__( 'Classic', 'shift-cv' ),
				'archive' => 'index-classic',
				'item'    => 'content-classic',
				'columns' => array( 2, 3 ),
				'styles'  => 'classic',
			),
		),
		// Layouts for the FREE version only
		//-----------------------------------------------------
		SHIFT_CV_THEME_FREE
		? array()

		// Layouts for the PREMIUM version only
		//-----------------------------------------------------
		: array(
			'masonry'   => array(
				'title'   => esc_html__( 'Masonry', 'shift-cv' ),
				'archive' => 'index-classic',
				'item'    => 'content-classic',
				'columns' => array( 2, 3 ),
				'styles'  => 'masonry',
			),
			'portfolio' => array(
				'title'   => esc_html__( 'Portfolio', 'shift-cv' ),
				'archive' => 'index-portfolio',
				'item'    => 'content-portfolio',
				'columns' => array( 2, 3, 4 ),
				'styles'  => 'portfolio',
			),
			'gallery'   => array(
				'title'   => esc_html__( 'Gallery', 'shift-cv' ),
				'archive' => 'index-portfolio',
				'item'    => 'content-portfolio-gallery',
				'columns' => array( 2, 3, 4 ),
				'styles'  => array( 'portfolio', 'gallery' ),
			),
		)
	),

	// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
	'theme_pro_key'      => 'env-themerex',

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'     => '/shift-cv.themerex.net',
	'theme_doc_url'      => 'http://shift-cv.themerex.net/doc',
	'theme_download_url' => 'https://themeforest.net/item/shiftcv-blog-resume-portfolio-wordpress/5150965',

	'theme_support_url'  => 'https://themerex.net/support/',                             // ThemeREX

	'theme_video_url'    => 'https://www.youtube.com/channel/UCnFisBimrK2aIE-hnY70kCA',  // ThemeREX

	// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
	// (i.e. 'children,kindergarten')
	'theme_categories'   => '',

	// Responsive resolutions
	// Parameters to create css media query: min, max
	'responsive'         => array(
		// By device
		'desktop'  => array( 'min' => 1680 ),
		'notebook' => array(
			'min' => 1280,
			'max' => 1679,
		),
		'tablet'   => array(
			'min' => 768,
			'max' => 1279,
		),
		'mobile'   => array( 'max' => 767 ),
		// By size
		'xxl'      => array( 'max' => 1679 ),
		'xl'       => array( 'max' => 1439 ),
		'lg'       => array( 'max' => 1279 ),
		'md'       => array( 'max' => 1023 ),
		'sm'       => array( 'max' => 767 ),
		'sm_wp'    => array( 'max' => 600 ),
		'xs'       => array( 'max' => 480 ),
	),
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( ! function_exists( 'shift_cv_customizer_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'shift_cv_customizer_theme_setup1', 1 );
	function shift_cv_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		shift_cv_storage_set(
			'settings', array(

				'duplicate_options'      => 'child',            // none  - use separate options for the main and the child-theme
																// child - duplicate theme options from the main theme to the child-theme only
																// both  - sinchronize changes in the theme options between main and child themes

				'customize_refresh'      => 'auto',             // Refresh method for preview area in the Appearance - Customize:
																// auto - refresh preview area on change each field with Theme Options
																// manual - refresh only obn press button 'Refresh' at the top of Customize frame

				'max_load_fonts'         => 5,                  // Max fonts number to load from Google fonts or from uploaded fonts

				'comment_after_name'     => true,               // Place 'comment' field after the 'name' and 'email'

				'icons_selector'         => 'internal',         // Icons selector in the shortcodes:
																// standard VC (very slow) or Elementor's icons selector (not support images and svg)
																// internal - internal popup with plugin's or theme's icons list (fast and support images and svg)

				'icons_type'             => 'icons',            // Type of icons (if 'icons_selector' is 'internal'):
																// icons  - use font icons to present icons
																// images - use images from theme's folder trx_addons/css/icons.png
																// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'socials_type'           => 'icons',            // Type of socials icons (if 'icons_selector' is 'internal'):
																// icons  - use font icons to present social networks
																// images - use images from theme's folder trx_addons/css/icons.png
																// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'check_min_version'      => true,               // Check if exists a .min version of .css and .js and return path to it
																// instead the path to the original file
																// (if debug_mode is off and modification time of the original file < time of the .min file)

				'autoselect_menu'        => false,              // Show any menu if no menu selected in the location 'main_menu'
																// (for example, the theme is just activated)

				'disable_jquery_ui'      => false,              // Prevent loading custom jQuery UI libraries in the third-party plugins

				'use_mediaelements'      => true,               // Load script "Media Elements" to play video and audio

				'tgmpa_upload'           => false,              // Allow upload not pre-packaged plugins via TGMPA

				'allow_no_image'         => false,              // Allow use image placeholder if no image present in the blog, related posts, post navigation, etc.

				'separate_schemes'       => true,               // Save color schemes to the separate files __color_xxx.css (true) or append its to the __custom.css (false)

				'allow_fullscreen'       => false,              // Allow cases 'fullscreen' and 'fullwide' for the body style in the Theme Options
																// In the Page Options this styles are present always
																// (can be removed if filter 'shift_cv_filter_allow_fullscreen' return false)

				'attachments_navigation' => false,              // Add arrows on the single attachment page to navigate to the prev/next attachment
				
				'gutenberg_safe_mode'    => array('elementor'), // vc,elementor - Prevent simultaneous editing of posts for Gutenberg and other PageBuilders (VC, Elementor)
			)
		);

		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------

		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
				shift_cv_storage_set(
			'load_fonts', array(
				// Google font
				array(
					'name'   => 'Roboto',
					'family' => 'sans-serif',
					'styles' => '300,300italic,400,400italic,700,700italic',     // Parameter 'style' used only for the Google fonts
				),
				// Font-face packed with theme
				array(
					'name'   => 'Montserrat',
					'family' => 'sans-serif',
				),
				array(
					'name'   => 'Poppins',
					'family' => 'sans-serif',
					'styles' => '300,400,400i,500,600,700',
				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		shift_cv_storage_set( 'load_fonts_subset', 'latin,latin-ext' );

		// Settings of the main tags
		// Attention! Font name in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!
		shift_cv_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'shift-cv' ),
					'description'     => esc_html__( 'Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'shift-cv' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.7857em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '.05px',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.4em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'shift-cv' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '4rem',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-.1px',
					'margin-top'      => '1.234em',
					'margin-bottom'   => '0.9em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'shift-cv' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '2.4rem',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-.1px',
					'margin-top'      => '2.35em',
					'margin-bottom'   => '1.5em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'shift-cv' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '2rem',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-.1px',
					'margin-top'      => '2em',
					'margin-bottom'   => '1.5em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'shift-cv' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1.6rem',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-.1px',
					'margin-top'      => '2.1em',
					'margin-bottom'   => '1.56em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'shift-cv' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1.33333rem',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.4em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '2.7em',
					'margin-bottom'   => '1.85em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'shift-cv' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1.06667rem',
					'font-weight'     => '600',
					'font-style'      => 'normal',
					'line-height'     => '1.65em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '3.2em',
					'margin-bottom'   => '0.9412em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'shift-cv' ),
					'description'     => esc_html__( 'Font settings of the text case of the logo', 'shift-cv' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '1.8em',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '1px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'shift-cv' ),
					'font-family'     => '"Poppins",sans-serif',
					'font-size'       => '16px',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'shift-cv' ),
					'description'     => esc_html__( 'Font settings of the input fields, dropdowns and textareas', 'shift-cv' ),
					'font-family'     => 'inherit',
					'font-size'       => '1em',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em', // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'shift-cv' ),
					'description'     => esc_html__( 'Font settings of the post meta: date, counters, share, etc.', 'shift-cv' ),
					'font-family'     => 'inherit',
					'font-size'       => '13px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0px',
					'margin-bottom'   => '',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'shift-cv' ),
					'description'     => esc_html__( 'Font settings of the main menu items', 'shift-cv' ),
					'font-family'     => '"Montserrat",sans-serif',
					'font-size'       => '1.0714em',
					'font-weight'     => '300',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'shift-cv' ),
					'description'     => esc_html__( 'Font settings of the dropdown menu items', 'shift-cv' ),
					'font-family'     => '"Montserrat",sans-serif',
					'font-size'       => '0.8667em',
					'font-weight'     => '300',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
			)
		);

		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		shift_cv_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'shift-cv' ),
					'description' => esc_html__( 'Colors of the main content area', 'shift-cv' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'shift-cv' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'shift-cv' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'shift-cv' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'shift-cv' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'shift-cv' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'shift-cv' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'shift-cv' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'shift-cv' ),
				),
			)
		);
		shift_cv_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'shift-cv' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'shift-cv' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'shift-cv' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'shift-cv' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'shift-cv' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'shift-cv' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'shift-cv' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'shift-cv' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'shift-cv' ),
					'description' => esc_html__( 'Color of the plain text inside this block', 'shift-cv' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'shift-cv' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'shift-cv' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'shift-cv' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'shift-cv' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'shift-cv' ),
					'description' => esc_html__( 'Color of the links inside this block', 'shift-cv' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'shift-cv' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'shift-cv' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Link 2', 'shift-cv' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'shift-cv' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Link 2 hover', 'shift-cv' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'shift-cv' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Link 3', 'shift-cv' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'shift-cv' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Link 3 hover', 'shift-cv' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'shift-cv' ),
				),
			)
		);
		shift_cv_storage_set(
			'schemes', array(

				// Color scheme: 'default'
				'default' => array(
					'title'    => esc_html__( 'Default', 'shift-cv' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#ffffff', // ok
						'bd_color'         => '#f3f3f5', // ok

						// Text and links colors
						'text'             => '#86888f', // ok
						'text_light'       => '#9a9ea7', // ok
						'text_dark'        => '#1d1d1d', // ok
						'text_link'        => '#ff754a', // ok
						'text_hover'       => '#3a66e6', // ok
						'text_link2'       => '#1bc9e4', // ok
						'text_hover2'      => '#8be77c',
						'text_link3'       => '#ffffff', // ok/
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#ffffff', // ok
						'alter_bg_hover'   => '#e3e4e6', // ok
						'alter_bd_color'   => '#f3f3f5', // ok
						'alter_bd_hover'   => '#e3e4e6', // ok/
						'alter_text'       => '#333333',
						'alter_light'      => '#9a9ea7', // ok
						'alter_dark'       => '#1d1d1d',
						'alter_link'       => '#3a66e6', // ok
						'alter_hover'      => '#ff754a', // ok
						'alter_link2'      => '#ffc455', // ok
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#ddb837',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#1f2021', // ok
						'extra_bg_hover'   => '#28272e',
						'extra_bd_color'   => '#3c3d40', // ok
						'extra_bd_hover'   => '#3d3d3d',
						'extra_text'       => '#bfbfbf',
						'extra_light'      => '#9a9ea7', // ok
						'extra_dark'       => '#ffffff',
						'extra_link'       => '#ff754a', // ok
						'extra_hover'      => '#fe7259',
						'extra_link2'      => '#f95656', // ok
						'extra_hover2'     => '#8be77c',
						'extra_link3'      => '#ddb837',
						'extra_hover3'     => '#1f2021', // ok/

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#f3f3f5', // ok
						'input_bg_hover'   => '#f3f3f5', // ok/
						'input_bd_color'   => '#f3f3f5',
						'input_bd_hover'   => '#ff4a4a', // ok
						'input_text'       => '#888888',
						'input_light'      => '#a7a7a7',
						'input_dark'       => '#1d1d1d',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#f3f3f5', // ok
						'inverse_bd_hover' => '#5aa4a9',
						'inverse_text'     => '#ffffff', // ok
						'inverse_light'    => '#ffffff', // ok/
						'inverse_dark'     => '#000000',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#1d1d1d',
					),
				),

				// Color scheme: 'dark'
				'dark'    => array(
					'title'    => esc_html__( 'Dark', 'shift-cv' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#1f2021', // ok
						'bd_color'         => '#3c3d40', // ok/

						// Text and links colors
						'text'             => '#67696e', // ok
						'text_light'       => '#a3a5ad', // ok
						'text_dark'        => '#ffffff', // ok
						'text_link'        => '#ff754a', // ok
						'text_hover'       => '#3a66e6', // ok
						'text_link2'       => '#1bc9e4', // ok
						'text_hover2'      => '#8be77c',
						'text_link3'       => '#3c3d40', // ok/
						'text_hover3'      => '#eec432',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#1f2021', // ok
						'alter_bg_hover'   => '#161617', // ok
						'alter_bd_color'   => '#1f2021', // ok
						'alter_bd_hover'   => '#3c3d40', // ok/
						'alter_text'       => '#67696e', // ok
						'alter_light'      => '#a3a5ad', // ok
						'alter_dark'       => '#ffffff', // ok
						'alter_link'       => '#3a66e6', // ok
						'alter_hover'      => '#ff754a', // ok
						'alter_link2'      => '#ffc455', // ok
						'alter_hover2'     => '#80d572',
						'alter_link3'      => '#eec432',
						'alter_hover3'     => '#ddb837',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#ffffff', // ok
						'extra_bg_hover'   => '#f3f5f7', // ok
						'extra_bd_color'   => '#e5e5e5', // ok
						'extra_bd_hover'   => '#f3f5f7',
						'extra_text'       => '#1f2021', // ok
						'extra_light'      => '#a3a5ad', // ok
						'extra_dark'       => '#ffffff',
						'extra_link'       => '#3a66e6', // ok
						'extra_hover'      => '#fe7259',
						'extra_link2'      => '#ff4b4b', // ok
						'extra_hover2'     => '#8be77c',
						'extra_link3'      => '#ddb837',
						'extra_hover3'     => '#3c3d40',

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#161617', // ok/
						'input_bg_hover'   => '#3c3d40', // ok/
						'input_bd_color'   => '#161617', // ok/
						'input_bd_hover'   => '#ff4a4a', // ok
						'input_text'       => '#ffffff', // ok
						'input_light'      => '#6f6f6f',
						'input_dark'       => '#a3a5ad', // ok

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#161617', // ok
						'inverse_bd_hover' => '#cb5b47',
						'inverse_text'     => '#ffffff', // ok
						'inverse_light'    => '#3c3d40', // ok/
						'inverse_dark'     => '#1f2021', // ok
						'inverse_link'     => '#ffffff', // ok
						'inverse_hover'    => '#ffffff', // ok
					),
				),

			)
		);

		// Simple schemes substitution
		shift_cv_storage_set(
			'schemes_simple', array(
				// Main color	// Slave elements and it's darkness koef.
				'text_link'   => array(),
				'text_hover'  => array(),
				'text_link2'  => array(),
				'alter_link2'  => array(),
				'extra_link2'  => array(),
			)
		);

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		shift_cv_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.7,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
				'text_link_07'      => array(
					'color' => 'text_link',
					'alpha' => 0.7,
				),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Parameters to set order of schemes in the css
		shift_cv_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		shift_cv_storage_set(
			'theme_thumbs', apply_filters(
				'shift_cv_filter_add_thumb_sizes', array(
					// Width of the image is equal to the content area width (without sidebar)
					// Height is fixed
					'shift_cv-thumb-huge'        => array(
						'size'  => array( 1030, 658, true ),
						'title' => esc_html__( 'Huge image', 'shift-cv' ),
						'subst' => 'trx_addons-thumb-huge',
					),
					// Width of the image is equal to the content area width (with sidebar)
					// Height is fixed
					'shift_cv-thumb-big'         => array(
						'size'  => array( 610, 407, true ),
						'title' => esc_html__( 'Large image', 'shift-cv' ),
						'subst' => 'trx_addons-thumb-big',
					),

					// Width of the image is equal to the 1/3 of the content area width (without sidebar)
					// Height is fixed
					'shift_cv-thumb-med'         => array(
						'size'  => array( 300, 200, true ),
						'title' => esc_html__( 'Medium image', 'shift-cv' ),
						'subst' => 'trx_addons-thumb-medium',
					),

					// Small square image (for avatars in comments, etc.)
					'shift_cv-thumb-tiny'        => array(
						'size'  => array( 100, 100, true ),
						'title' => esc_html__( 'Small square avatar', 'shift-cv' ),
						'subst' => 'trx_addons-thumb-tiny',
					),

					// Width of the image is equal to the content area width (with sidebar)
					// Height is proportional (only downscale, not crop)
					'shift_cv-thumb-masonry-big' => array(
						'size'  => array( 760, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry Large (scaled)', 'shift-cv' ),
						'subst' => 'trx_addons-thumb-masonry-big',
					),

					// Width of the image is equal to the 1/3 of the full content area width (without sidebar)
					// Height is proportional (only downscale, not crop)
					'shift_cv-thumb-masonry'     => array(
						'size'  => array( 370, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry (scaled)', 'shift-cv' ),
						'subst' => 'trx_addons-thumb-masonry',
					),

					// Width of the image is equal to the 1/3 of the content area width (without sidebar)
					// Height is fixed
					'shift_cv-thumb-extra' => array(
						'size'  => array( 295, 295, true ),     // Only downscale, not crop
						'title' => esc_html__( 'Extra', 'shift-cv' ),
						'subst' => 'trx_addons-thumb-extra',
					),
				)
			)
		);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'shift_cv_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'shift_cv_importer_set_options', 9 );
	function shift_cv_importer_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
            $rtl_slug = is_rtl() ? '-rtl' : '';
            $rtl_url = is_rtl() ? 'rtl.' : '';
            // Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Allow import/export functionality
			$options['allow_import'] = true;
			$options['allow_export'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url( shift_cv_get_protocol() . '://demofiles.themerex.net/shift-cv'. $rtl_slug .'/' );
			// Required plugins
			$options['required_plugins'] = array_keys( shift_cv_storage_get( 'required_plugins' ) );
			// Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 3;
			// Default demo
			$options['files']['default']['title']       = esc_html__( 'Shift CV Demo', 'shift-cv' );
			$options['files']['default']['domain_dev']  = esc_url( shift_cv_get_protocol() . '://shiftcv.dv.themerex.net' );       // Developers domain
			$options['files']['default']['domain_demo'] = esc_url( shift_cv_get_protocol() . '://'. $rtl_url .'shift-cv.themerex.net' ); 								// Demo-site domain

			// Banners
			$options['banners'] = array(
				array(
					'image'        => shift_cv_get_file_url( 'theme-specific/theme-about/images/frontpage.png' ),
					'title'        => esc_html__( 'Front Page Builder', 'shift-cv' ),
					'content'      => wp_kses_data( __( "Create your front page right in the WordPress Customizer. There's no need in any page builder. Simply enable/disable sections, fill them out with content, and customize to your liking.", 'shift-cv' ) ),
					'link_url'     => esc_url( '//www.youtube.com/watch?v=VT0AUbMl_KA' ),
					'link_caption' => esc_html__( 'Watch Video Introduction', 'shift-cv' ),
					'duration'     => 20,
				),
				array(
					'image'        => shift_cv_get_file_url( 'theme-specific/theme-about/images/layouts.png' ),
					'title'        => esc_html__( 'Layouts Builder', 'shift-cv' ),
					'content'      => wp_kses_data( __( 'Use Layouts Builder to create and customize header and footer styles for your website. With a flexible page builder interface and custom shortcodes, you can create as many header and footer layouts as you want with ease.', 'shift-cv' ) ),
					'link_url'     => esc_url( '//www.youtube.com/watch?v=pYhdFVLd7y4' ),
					'link_caption' => esc_html__( 'Learn More', 'shift-cv' ),
					'duration'     => 20,
				),
				array(
					'image'        => shift_cv_get_file_url( 'theme-specific/theme-about/images/documentation.png' ),
					'title'        => esc_html__( 'Read Full Documentation', 'shift-cv' ),
					'content'      => wp_kses_data( __( 'Need more details? Please check our full online documentation for detailed information on how to use Shift CV.', 'shift-cv' ) ),
					'link_url'     => esc_url( shift_cv_storage_get( 'theme_doc_url' ) ),
					'link_caption' => esc_html__( 'Online Documentation', 'shift-cv' ),
					'duration'     => 15,
				),
				array(
					'image'        => shift_cv_get_file_url( 'theme-specific/theme-about/images/video-tutorials.png' ),
					'title'        => esc_html__( 'Video Tutorials', 'shift-cv' ),
					'content'      => wp_kses_data( __( 'No time for reading documentation? Check out our video tutorials and learn how to customize Shift CV in detail.', 'shift-cv' ) ),
					'link_url'     => esc_url( shift_cv_storage_get( 'theme_video_url' ) ),
					'link_caption' => esc_html__( 'Video Tutorials', 'shift-cv' ),
					'duration'     => 15,
				),
				array(
					'image'        => shift_cv_get_file_url( 'theme-specific/theme-about/images/studio.png' ),
					'title'        => esc_html__( 'Website Customization', 'shift-cv' ),
					'content'      => wp_kses_data( __( "Need a website fast? Order our custom service, and we'll build a website based on this theme for a very fair price. We can also implement additional functionality such as website translation, setting up WPML, and much more.", 'shift-cv' ) ),
					'link_url'     => esc_url( '//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themedash/' ),
					'link_caption' => esc_html__( 'Contact Us', 'shift-cv' ),
					'duration'     => 25,
				),
			);
		}
		return $options;
	}
}


//------------------------------------------------------------------------
// OCDI support
//------------------------------------------------------------------------

// Set theme specific OCDI options
if ( ! function_exists( 'shift_cv_ocdi_set_options' ) ) {
	add_filter( 'trx_addons_filter_ocdi_options', 'shift_cv_ocdi_set_options', 9 );
	function shift_cv_ocdi_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Prepare demo data
			$options['demo_url'] = esc_url( shift_cv_get_protocol() . '://demofiles.themerex.net/shift_cv/' );
			// Required plugins
			$options['required_plugins'] = array_keys( shift_cv_storage_get( 'required_plugins' ) );
			// Demo-site domain
			$options['files']['ocdi']['title']       = esc_html__( 'Shift CV OCDI Demo', 'shift-cv' );
			$options['files']['ocdi']['domain_demo'] = esc_url( shift_cv_get_protocol() . '://shift-cv.themerex.net/' );
		}
		return $options;
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if ( ! function_exists( 'shift_cv_create_theme_options' ) ) {

	function shift_cv_create_theme_options() {

		// Message about options override.
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = esc_html__( 'Attention! Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages. If you changed such parameter and nothing happened on the page, this option may be overridden in the corresponding section or in the Page Options of this page. These options are marked with an asterisk (*) in the title.', 'shift-cv' );

		// Color schemes number: if < 2 - hide fields with selectors
		$hide_schemes = count( shift_cv_storage_get( 'schemes' ) ) < 2;

		shift_cv_storage_set(
			'options', array(

				// 'Logo & Site Identity'
				'title_tagline'                 => array(
					'title'    => esc_html__( 'Logo & Site Identity', 'shift-cv' ),
					'desc'     => '',
					'priority' => 10,
					'type'     => 'section',
				),
				'logo_info'                     => array(
					'title'    => esc_html__( 'Logo Settings', 'shift-cv' ),
					'desc'     => '',
					'priority' => 20,
					'qsetup'   => esc_html__( 'General', 'shift-cv' ),
					'type'     => 'info',
				),
				'logo_text'                     => array(
					'title'    => esc_html__( 'Use Site Name as Logo', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Use the site title and tagline as a text logo if no image is selected', 'shift-cv' ) ),
					'class'    => 'shift_cv_column-1_2 shift_cv_new_row',
					'priority' => 30,
					'std'      => 1,
					'qsetup'   => esc_html__( 'General', 'shift-cv' ),
					'type'     => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_retina_enabled'           => array(
					'title'    => esc_html__( 'Allow retina display logo', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Show fields to select logo images for Retina display', 'shift-cv' ) ),
					'class'    => 'shift_cv_column-1_2',
					'priority' => 40,
					'refresh'  => false,
					'std'      => 0,
					'type'     => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_zoom'                     => array(
					'title'   => esc_html__( 'Logo zoom', 'shift-cv' ),
					'desc'    => wp_kses_data( __( 'Zoom the logo. 1 - original size. Maximum size of logo depends on the actual size of the picture', 'shift-cv' ) ),
					'std'     => 1,
					'min'     => 0.2,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'slider',
				),
				// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
				'logo_retina'                   => array(
					'title'      => esc_html__( 'Logo for Retina', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'shift-cv' ) ),
					'class'      => 'shift_cv_column-1_2',
					'priority'   => 70,
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile_header'            => array(
					'title' => esc_html__( 'Logo for the mobile header', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'shift-cv' ) ),
					'class' => 'shift_cv_column-1_2 shift_cv_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_header_retina'     => array(
					'title'      => esc_html__( 'Logo for the mobile header on Retina', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'shift-cv' ) ),
					'class'      => 'shift_cv_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile'                   => array(
					'title' => esc_html__( 'Logo for the mobile menu', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile menu', 'shift-cv' ) ),
					'class' => 'shift_cv_column-1_2 shift_cv_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_retina'            => array(
					'title'      => esc_html__( 'Logo mobile on Retina', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'shift-cv' ) ),
					'class'      => 'shift_cv_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_side'                     => array(
					'title' => esc_html__( 'Logo for the side menu', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu', 'shift-cv' ) ),
					'class' => 'shift_cv_column-1_2 shift_cv_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_side_retina'              => array(
					'title'      => esc_html__( 'Logo for the side menu on Retina', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'shift-cv' ) ),
					'class'      => 'shift_cv_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'image',
				),

				// 'General settings'
				'general'                       => array(
					'title'    => esc_html__( 'General Settings', 'shift-cv' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 20,
					'type'     => 'section',
				),

				'general_layout_info'           => array(
					'title'  => esc_html__( 'Layout', 'shift-cv' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'shift-cv' ),
					'type'   => 'info',
				),
				'body_style'                    => array(
					'title'    => esc_html__( 'Body style', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Select width of the body content', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'qsetup'   => esc_html__( 'General', 'shift-cv' ),
					'refresh'  => false,
					'std'      => 'boxed',
					'options'  => shift_cv_get_list_body_styles( false ),
					'type'     => 'hidden',
				),
				'page_width'                    => array(
					'title'      => esc_html__( 'Page width', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Total width of the site content and sidebar (in pixels). If empty - use default width', 'shift-cv' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed', 'wide' ),
					),
					'std'        => 1030,
					'min'        => 1000,
					'max'        => 1400,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'page',         // SASS variable's name to preview changes 'on fly'
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'slider',
				),
				'boxed_bg_image'                => array(
					'title'      => esc_html__( 'Boxed bg image', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'shift-cv' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed' ),
					),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'std'        => '',
					'qsetup'     => esc_html__( 'General', 'shift-cv' ),
					'hidden'     => true,
					'type'       => 'image',
				),
				'remove_margins'                => array(
					'title'    => esc_html__( 'Remove margins', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Remove margins above and below the content area', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'refresh'  => false,
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'theme_style_switcher'                => array(
					'title'    => esc_html__( 'Show Theme style switcher', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Show theme style switcher', 'shift-cv' ) ),
					'std'      => 0,
					'type'     => 'checkbox',
				),

				'general_sidebar_info'          => array(
					'title' => esc_html__( 'Sidebar', 'shift-cv' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position'              => array(
					'title'    => esc_html__( 'Sidebar position', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'shift-cv' ),
					),
					'std'      => 'right',
					'qsetup'   => esc_html__( 'General', 'shift-cv' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets'               => array(
					'title'      => esc_html__( 'Sidebar widgets', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'shift-cv' ),
					),
					'dependency' => array(
						'sidebar_position' => array( 'left', 'right' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'shift-cv' ),
					'type'       => 'select',
				),
				'sidebar_width'                 => array(
					'title'      => esc_html__( 'Sidebar width', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Width of the sidebar (in pixels). If empty - use default width', 'shift-cv' ) ),
					'std'        => 300,
					'min'        => 150,
					'max'        => 500,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'sidebar',      // SASS variable's name to preview changes 'on fly'
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'slider',
				),
				'sidebar_gap'                   => array(
					'title'      => esc_html__( 'Sidebar gap', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Gap between content and sidebar (in pixels). If empty - use default gap', 'shift-cv' ) ),
					'std'        => 5,
					'min'        => 0,
					'max'        => 100,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'gap',          // SASS variable's name to preview changes 'on fly'
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'slider',
				),
				'expand_content'                => array(
					'title'   => esc_html__( 'Expand content', 'shift-cv' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'shift-cv' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'general_widgets_info'          => array(
					'title' => esc_html__( 'Additional widgets', 'shift-cv' ),
					'desc'  => '',
					'type'  => SHIFT_CV_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page'            => array(
					'title'    => esc_html__( 'Widgets at the top of the page', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'shift-cv' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content'         => array(
					'title'    => esc_html__( 'Widgets above the content', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'shift-cv' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content'         => array(
					'title'    => esc_html__( 'Widgets below the content', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'shift-cv' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page'            => array(
					'title'    => esc_html__( 'Widgets at the bottom of the page', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'shift-cv' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),

				'general_effects_info'          => array(
					'title' => esc_html__( 'Design & Effects', 'shift-cv' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'border_radius'                 => array(
					'title'      => esc_html__( 'Border radius', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Specify the border radius of the form fields and buttons in pixels', 'shift-cv' ) ),
					'std'        => 0,
					'min'        => 0,
					'max'        => 20,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'rad',      // SASS name to preview changes 'on fly'
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'slider',
				),

				'general_misc_info'             => array(
					'title' => esc_html__( 'Miscellaneous', 'shift-cv' ),
					'desc'  => '',
					'type'  => SHIFT_CV_THEME_FREE ? 'hidden' : 'info',
				),
				'seo_snippets'                  => array(
					'title' => esc_html__( 'SEO snippets', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Add structured data markup to the single posts and pages', 'shift-cv' ) ),
					'std'   => 0,
					'type'  => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'privacy_text' => array(
					"title" => esc_html__("Text with Privacy Policy link", 'shift-cv'),
					"desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'shift-cv') ),
					"std"   => wp_kses_data( __( 'I agree that my submitted data is being collected and stored.', 'shift-cv') ),
					"type"  => "text"
				),

				// 'Header'
				'header'                        => array(
					'title'    => esc_html__( 'Header', 'shift-cv' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 30,
					'type'     => 'section',
				),

				'header_style_info'             => array(
					'title' => esc_html__( 'Header style', 'shift-cv' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type'                   => array(
					'title'    => esc_html__( 'Header style', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'shift-cv' ),
					),
					'std'      => 'default',
					'options'  => shift_cv_get_list_header_footer_types(),
					'type'     => SHIFT_CV_THEME_FREE || ! shift_cv_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select custom header from Layouts Builder', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'shift-cv' ),
					),
					'dependency' => array(
						'header_type' => array( 'custom' ),
					),
					'std'        => SHIFT_CV_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position'               => array(
					'title'    => esc_html__( 'Header position', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'shift-cv' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'type'     => SHIFT_CV_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight'             => array(
					'title'    => esc_html__( 'Header fullheight', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'shift-cv' ),
					),
					'std'      => 0,
					'type'     => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_zoom'                   => array(
					'title'   => esc_html__( 'Header zoom', 'shift-cv' ),
					'desc'    => wp_kses_data( __( 'Zoom the header title. 1 - original size', 'shift-cv' ) ),
					'std'     => 1,
					'min'     => 0.3,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'slider',
				),
				'header_wide'                   => array(
					'title'      => esc_html__( 'Header fullwidth', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'shift-cv' ),
					),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 1,
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_widgets_info'           => array(
					'title' => esc_html__( 'Header widgets', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Here you can place a widget slider, advertising banners, etc.', 'shift-cv' ) ),
					'type'  => 'info',
				),
				'header_widgets'                => array(
					'title'    => esc_html__( 'Header widgets', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Select set of widgets to show in the header on each page', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'shift-cv' ),
						'desc'    => wp_kses_data( __( 'Select set of widgets to show in the header on this page', 'shift-cv' ) ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => 'select',
				),
				'header_columns'                => array(
					'title'      => esc_html__( 'Header columns', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'shift-cv' ),
					),
					'dependency' => array(
						'header_type'    => array( 'default' ),
						'header_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => shift_cv_get_list_range( 0, 6 ),
					'type'       => 'select',
				),

				'menu_info'                     => array(
					'title' => esc_html__( 'Main menu', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Select main menu style, position and other parameters', 'shift-cv' ) ),
					'type'  => SHIFT_CV_THEME_FREE ? 'hidden' : 'info',
				),
				'menu_style'                    => array(
					'title'    => esc_html__( 'Menu position', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Select position of the main menu', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'shift-cv' ),
					),
					'std'      => 'top',
					'options'  => array(
						'top'   => esc_html__( 'Top', 'shift-cv' ),
						'left'  => esc_html__( 'Left', 'shift-cv' ),
						'right' => esc_html__( 'Right', 'shift-cv' ),
					),
					'type'     => SHIFT_CV_THEME_FREE || ! shift_cv_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'menu_side_stretch'             => array(
					'title'      => esc_html__( 'Stretch sidemenu', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Stretch sidemenu to window height (if menu items number >= 5)', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'shift-cv' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 0,
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_side_icons'               => array(
					'title'      => esc_html__( 'Iconed sidemenu', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'shift-cv' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 1,
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_mobile_fullscreen'        => array(
					'title' => esc_html__( 'Mobile menu fullscreen', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'shift-cv' ) ),
					'std'   => 1,
					'type'  => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_image_info'             => array(
					'title' => esc_html__( 'Header image', 'shift-cv' ),
					'desc'  => '',
					'type'  => SHIFT_CV_THEME_FREE ? 'hidden' : 'info',
				),
				'header_image_override'         => array(
					'title'    => esc_html__( 'Header image override', 'shift-cv' ),
					'desc'     => wp_kses_data( __( "Allow override the header image with the page's/post's/product's/etc. featured image", 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'shift-cv' ),
					),
					'std'      => 0,
					'type'     => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_mobile_info'            => array(
					'title'      => esc_html__( 'Mobile header', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Configure the mobile version of the header', 'shift-cv' ) ),
					'priority'   => 500,
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'info',
				),
				'header_mobile_enabled'         => array(
					'title'      => esc_html__( 'Enable the mobile header', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Use the mobile version of the header (if checked) or relayout the current header on mobile devices', 'shift-cv' ) ),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_additional_info' => array(
					'title'      => esc_html__( 'Additional info', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Additional info to show at the top of the mobile header', 'shift-cv' ) ),
					'std'        => '',
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'refresh'    => false,
					'teeny'      => false,
					'rows'       => 20,
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'text_editor',
				),
				'header_mobile_hide_info'       => array(
					'title'      => esc_html__( 'Hide additional info', 'shift-cv' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_logo'       => array(
					'title'      => esc_html__( 'Hide logo', 'shift-cv' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_login'      => array(
					'title'      => esc_html__( 'Hide login/logout', 'shift-cv' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_search'     => array(
					'title'      => esc_html__( 'Hide search', 'shift-cv' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_cart'       => array(
					'title'      => esc_html__( 'Hide cart', 'shift-cv' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),

				// 'Footer'
				'footer'                        => array(
					'title'    => esc_html__( 'Footer', 'shift-cv' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 50,
					'type'     => 'section',
				),
				'footer_type'                   => array(
					'title'    => esc_html__( 'Footer style', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'shift-cv' ),
					),
					'std'      => 'default',
					'options'  => shift_cv_get_list_header_footer_types(),
					'type'     => SHIFT_CV_THEME_FREE || ! shift_cv_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'footer_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select custom footer from Layouts Builder', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'shift-cv' ),
					),
					'dependency' => array(
						'footer_type' => array( 'custom' ),
					),
					'std'        => SHIFT_CV_THEME_FREE ? 'footer-custom-elementor-footer-default' : 'footer-custom-footer-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_widgets'                => array(
					'title'      => esc_html__( 'Footer widgets', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'shift-cv' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 'footer_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_columns'                => array(
					'title'      => esc_html__( 'Footer columns', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'shift-cv' ),
					),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'footer_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => shift_cv_get_list_range( 0, 6 ),
					'type'       => 'select',
				),
				'footer_wide'                   => array(
					'title'      => esc_html__( 'Footer fullwidth', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'shift-cv' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_in_footer'                => array(
					'title'      => esc_html__( 'Show logo', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Show logo in the footer', 'shift-cv' ) ),
					'refresh'    => false,
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_footer'                   => array(
					'title'      => esc_html__( 'Logo for footer', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo to display it in the footer', 'shift-cv' ) ),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'logo_in_footer' => array( 1 ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'logo_footer_retina'            => array(
					'title'      => esc_html__( 'Logo for footer (Retina)', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'shift-cv' ) ),
					'dependency' => array(
						'footer_type'         => array( 'default' ),
						'logo_in_footer'      => array( 1 ),
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'image',
				),
				'socials_in_footer'             => array(
					'title'      => esc_html__( 'Show social icons', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Show social icons in the footer (under logo or footer widgets)', 'shift-cv' ) ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => ! shift_cv_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'copyright'                     => array(
					'title'      => esc_html__( 'Copyright', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'shift-cv' ) ),
					'translate'  => true,
					'std'        => esc_html__( 'Copyright &copy; {Y} by ThemeREX. All rights reserved.', 'shift-cv' ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'refresh'    => false,
					'type'       => 'textarea',
				),

				// 'Blog'
				'blog'                          => array(
					'title'    => esc_html__( 'Blog', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Options of the the blog archive', 'shift-cv' ) ),
					'priority' => 70,
					'type'     => 'panel',
				),

				// Blog - Posts page
				'blog_general'                  => array(
					'title' => esc_html__( 'Posts page', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Style and components of the blog archive', 'shift-cv' ) ),
					'type'  => 'section',
				),
				'blog_general_info'             => array(
					'title'  => esc_html__( 'Posts page settings', 'shift-cv' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'shift-cv' ),
					'type'   => 'info',
				),
				'blog_style'                    => array(
					'title'      => esc_html__( 'Blog style', 'shift-cv' ),
					'desc'       => '',
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'dependency' => array(
						'#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'excerpt',
					'qsetup'     => esc_html__( 'General', 'shift-cv' ),
					'options'    => array(),
					'type'       => 'select',
				),
				'first_post_large'              => array(
					'title'      => esc_html__( 'First post large', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Make your first post stand out by making it bigger', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'dependency' => array(
						'#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style'     => array( 'classic', 'masonry' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'blog_content'                  => array(
					'title'      => esc_html__( 'Posts content', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Display either post excerpts or the full post content', 'shift-cv' ) ),
					'std'        => 'excerpt',
					'dependency' => array(
						'blog_style' => array( 'excerpt' ),
					),
					'options'    => array(
						'excerpt'  => esc_html__( 'Excerpt', 'shift-cv' ),
						'fullpost' => esc_html__( 'Full post', 'shift-cv' ),
					),
					'type'       => 'switch',
				),
				'excerpt_length'                => array(
					'title'      => esc_html__( 'Excerpt length', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged', 'shift-cv' ) ),
					'dependency' => array(
						'blog_style'   => array( 'excerpt' ),
						'blog_content' => array( 'excerpt' ),
					),
					'std'        => 32,
					'type'       => 'text',
				),
				'blog_columns'                  => array(
					'title'   => esc_html__( 'Blog columns', 'shift-cv' ),
					'desc'    => wp_kses_data( __( 'How many columns should be used in the blog archive (from 2 to 4)?', 'shift-cv' ) ),
					'std'     => 2,
					'options' => shift_cv_get_list_range( 2, 4 ),
					'type'    => 'hidden',      // This options is available and must be overriden only for some modes (for example, 'shop')
				),
				'post_type'                     => array(
					'title'      => esc_html__( 'Post type', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select post type to show in the blog archive', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'dependency' => array(
						'#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'linked'     => 'parent_cat',
					'refresh'    => false,
					'hidden'     => true,
					'std'        => 'post',
					'options'    => array(),
					'type'       => 'select',
				),
				'parent_cat'                    => array(
					'title'      => esc_html__( 'Category to show', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select category to show in the blog archive', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'dependency' => array(
						'#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'refresh'    => false,
					'hidden'     => true,
					'std'        => '0',
					'options'    => array(),
					'type'       => 'select',
				),
				'posts_per_page'                => array(
					'title'      => esc_html__( 'Posts per page', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'How many posts will be displayed on this page', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'dependency' => array(
						'#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'hidden'     => true,
					'std'        => '',
					'type'       => 'text',
				),
				'blog_pagination'               => array(
					'title'      => esc_html__( 'Pagination style', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Show Older/Newest posts or Page numbers below the posts list', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'std'        => 'pages',
					'qsetup'     => esc_html__( 'General', 'shift-cv' ),
					'dependency' => array(
						'#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'options'    => array(
						'pages'    => esc_html__( 'Page numbers', 'shift-cv' ),
						'links'    => esc_html__( 'Older/Newest', 'shift-cv' ),
						'more'     => esc_html__( 'Load more', 'shift-cv' ),
						'infinite' => esc_html__( 'Infinite scroll', 'shift-cv' ),
					),
					'type'       => 'select',
				),
				'blog_animation'                => array(
					'title'      => esc_html__( 'Animation for the posts', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'dependency' => array(
						'#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'none',
					'options'    => array(),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),
				'show_filters'                  => array(
					'title'      => esc_html__( 'Show filters', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Show categories as tabs to filter posts', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'dependency' => array(
						'#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style'     => array( 'portfolio', 'gallery' ),
					),
					'hidden'     => true,
					'std'        => 0,
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_sidebar_info'             => array(
					'title' => esc_html__( 'Sidebar', 'shift-cv' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_blog'         => array(
					'title'   => esc_html__( 'Sidebar position', 'shift-cv' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar', 'shift-cv' ) ),
					'std'     => 'right',
					'options' => array(),
					'qsetup'     => esc_html__( 'General', 'shift-cv' ),
					'type'    => 'switch',
				),
				'sidebar_widgets_blog'          => array(
					'title'      => esc_html__( 'Sidebar widgets', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'shift-cv' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( 'left', 'right' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'shift-cv' ),
					'type'       => 'select',
				),
				'expand_content_blog'           => array(
					'title'   => esc_html__( 'Expand content', 'shift-cv' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'shift-cv' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'blog_widgets_info'             => array(
					'title' => esc_html__( 'Additional widgets', 'shift-cv' ),
					'desc'  => '',
					'type'  => SHIFT_CV_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the top of the page', 'shift-cv' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'shift-cv' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content_blog'    => array(
					'title'   => esc_html__( 'Widgets above the content', 'shift-cv' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'shift-cv' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content_blog'    => array(
					'title'   => esc_html__( 'Widgets below the content', 'shift-cv' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'shift-cv' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the bottom of the page', 'shift-cv' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'shift-cv' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),

				'blog_advanced_info'            => array(
					'title' => esc_html__( 'Advanced settings', 'shift-cv' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'no_image'                      => array(
					'title' => esc_html__( 'Image placeholder', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Select or upload an image used as placeholder for posts without a featured image', 'shift-cv' ) ),
					'std'   => '',
					'type'  => 'image',
				),
				'time_diff_before'              => array(
					'title' => esc_html__( 'Easy Readable Date Format', 'shift-cv' ),
					'desc'  => wp_kses_data( __( "For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'shift-cv' ) ),
					'std'   => 5,
					'type'  => 'text',
				),
				'sticky_style'                  => array(
					'title'   => esc_html__( 'Sticky posts style', 'shift-cv' ),
					'desc'    => wp_kses_data( __( 'Select style of the sticky posts output', 'shift-cv' ) ),
					'std'     => 'inherit',
					'options' => array(
						'inherit' => esc_html__( 'Decorated posts', 'shift-cv' ),
						'columns' => esc_html__( 'Mini-cards', 'shift-cv' ),
					),
					'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),
				'meta_parts'                    => array(
					'title'      => esc_html__( 'Post meta', 'shift-cv' ),
					'desc'       => wp_kses_data( __( "If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'shift-cv' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'dependency' => array(
						'#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=1|tags=1|date=1|counters=1|author=1|share=0|edit=1',
					'options'    => shift_cv_get_list_meta_parts(),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checklist',
				),
				'counters'                      => array(
					'title'      => esc_html__( 'Post counters', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Show only selected counters. Attention! Likes and Views are available only if ThemeREX Addons is active', 'shift-cv' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'dependency' => array(
						'#page_template' => array( 'blog.php' ),
                        '.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'views=0|likes=0|comments=1',
					'options'    => shift_cv_get_list_counters(),
					'type'       => SHIFT_CV_THEME_FREE || ! shift_cv_exists_trx_addons() ? 'hidden' : 'checklist',
				),

				// Blog - Single posts
				'blog_single'                   => array(
					'title' => esc_html__( 'Single posts', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Settings of the single post', 'shift-cv' ) ),
					'type'  => 'section',
				),
				'hide_featured_on_single'       => array(
					'title'    => esc_html__( 'Hide featured image on the single post', 'shift-cv' ),
					'desc'     => wp_kses_data( __( "Hide featured image on the single post's pages", 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'hide_sidebar_on_single'        => array(
					'title' => esc_html__( 'Hide sidebar on the single post', 'shift-cv' ),
					'desc'  => wp_kses_data( __( "Hide sidebar on the single post's pages", 'shift-cv' ) ),
					'std'   => 0,
					'type'  => 'checkbox',
				),
				'show_post_meta'                => array(
					'title' => esc_html__( 'Show post meta', 'shift-cv' ),
					'desc'  => wp_kses_data( __( "Display block with post's meta: date, categories, counters, etc.", 'shift-cv' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),
				'meta_parts_post'               => array(
					'title'      => esc_html__( 'Post meta', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Meta parts for single posts. Post counters and Share Links are available only if plugin ThemeREX Addons is active', 'shift-cv' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'shift-cv' ) ),
					'dependency' => array(
						'show_post_meta' => array( 1 ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
					'options'    => shift_cv_get_list_meta_parts(),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checklist',
				),
				'counters_post'                 => array(
					'title'      => esc_html__( 'Post counters', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Show only selected counters. Attention! Likes and Views are available only if plugin ThemeREX Addons is active', 'shift-cv' ) ),
					'dependency' => array(
						'show_post_meta' => array( 1 ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'views=1|likes=1|comments=1',
					'options'    => shift_cv_get_list_counters(),
					'type'       => SHIFT_CV_THEME_FREE || ! shift_cv_exists_trx_addons() ? 'hidden' : 'checklist',
				),
				'show_share_links'              => array(
					'title' => esc_html__( 'Show share links', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Display share links on the single post', 'shift-cv' ) ),
					'std'   => 1,
					'type'  => ! shift_cv_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'show_author_info'              => array(
					'title' => esc_html__( 'Show author info', 'shift-cv' ),
					'desc'  => wp_kses_data( __( "Display block with information about post's author", 'shift-cv' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),
				'blog_single_related_info'      => array(
					'title' => esc_html__( 'Related posts', 'shift-cv' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'show_related_posts'            => array(
					'title'    => esc_html__( 'Show related posts', 'shift-cv' ),
					'desc'     => wp_kses_data( __( "Show section 'Related posts' on the single post's pages", 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Content', 'shift-cv' ),
					),
					'std'      => 1,
					'type'     => 'checkbox',
				),
				'related_posts'                 => array(
					'title'      => esc_html__( 'Related posts', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'How many related posts should be displayed in the single post? If 0 - no related posts are shown.', 'shift-cv' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => shift_cv_get_list_range( 1, 9 ),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),
				'related_columns'               => array(
					'title'      => esc_html__( 'Related columns', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'How many columns should be used to output related posts in the single page (from 2 to 4)?', 'shift-cv' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => shift_cv_get_list_range( 1, 4 ),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_style'                 => array(
					'title'      => esc_html__( 'Related posts style', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select style of the related posts output', 'shift-cv' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => shift_cv_get_list_styles( 1, 3 ),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider'                => array(
					'title'      => esc_html__( 'Use slider layout', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Use slider layout in case related posts count is more than columns count', 'shift-cv' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 0,
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'related_slider_controls'       => array(
					'title'      => esc_html__( 'Slider controls', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Show arrows in the slider', 'shift-cv' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'none',
					'options'    => array(
						'none'    => esc_html__('None', 'shift-cv'),
						'side'    => esc_html__('Side', 'shift-cv'),
						'outside' => esc_html__('Outside', 'shift-cv'),
						'top'     => esc_html__('Top', 'shift-cv'),
						'bottom'  => esc_html__('Bottom', 'shift-cv')
					),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
				),
				'related_slider_pagination'       => array(
					'title'      => esc_html__( 'Slider pagination', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Show bullets after the slider', 'shift-cv' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'bottom',
					'options'    => array(
						'none'    => esc_html__('None', 'shift-cv'),
						'bottom'  => esc_html__('Bottom', 'shift-cv')
					),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider_space'          => array(
					'title'      => esc_html__( 'Space', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Space between slides', 'shift-cv' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 30,
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'text',
				),
				'related_position'              => array(
					'title'      => esc_html__( 'Related posts position', 'shift-cv' ),
					'desc'       => wp_kses_data( __( 'Select position to display the related posts', 'shift-cv' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 'below_content',
					'options'    => array (
						'below_content' => esc_html__( 'After content', 'shift-cv' ),
						'below_page'    => esc_html__( 'After content & sidebar', 'shift-cv' ),
					),
					'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'switch',
				),
				'blog_end'                      => array(
					'type' => 'panel_end',
				),

				// 'Colors'
				'panel_colors'                  => array(
					'title'    => esc_html__( 'Colors', 'shift-cv' ),
					'desc'     => '',
					'priority' => 300,
					'type'     => 'section',
				),

				'color_schemes_info'            => array(
					'title'  => esc_html__( 'Color schemes', 'shift-cv' ),
					'desc'   => wp_kses_data( __( 'Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'shift-cv' ) ),
					'hidden' => $hide_schemes,
					'type'   => 'info',
				),
				'color_scheme'                  => array(
					'title'    => esc_html__( 'Site Color Scheme', 'shift-cv' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'shift-cv' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'header_scheme'                 => array(
					'title'    => esc_html__( 'Header Color Scheme', 'shift-cv' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'shift-cv' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'menu_scheme'                   => array(
					'title'    => esc_html__( 'Sidemenu Color Scheme', 'shift-cv' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'shift-cv' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes || SHIFT_CV_THEME_FREE ? 'hidden' : 'switch',
				),
				'sidebar_scheme'                => array(
					'title'    => esc_html__( 'Sidebar Color Scheme', 'shift-cv' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'shift-cv' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'footer_scheme'                 => array(
					'title'    => esc_html__( 'Footer Color Scheme', 'shift-cv' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'shift-cv' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),

				'color_scheme_editor_info'      => array(
					'title' => esc_html__( 'Color scheme editor', 'shift-cv' ),
					'desc'  => wp_kses_data( __( 'Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'shift-cv' ) ),
					'type'  => 'info',
				),
				'scheme_storage'                => array(
					'title'       => esc_html__( 'Color scheme editor', 'shift-cv' ),
					'desc'        => '',
					'std'         => '$shift_cv_get_scheme_storage',
					'refresh'     => false,
					'colorpicker' => 'tiny',
					'type'        => 'scheme_editor',
				),

				// Internal options.
				// Attention! Don't change any options in the section below!
				// Use huge priority to call render this elements after all options!
				'reset_options'                 => array(
					'title'    => '',
					'desc'     => '',
					'std'      => '0',
					'priority' => 10000,
					'type'     => 'hidden',
				),

				'last_option'                   => array(     // Need to manually call action to include Tiny MCE scripts
					'title' => '',
					'desc'  => '',
					'std'   => 1,
					'type'  => 'hidden',
				),

			)
		);

		// Prepare panel 'Fonts'
		// -------------------------------------------------------------
		$fonts = array(

			// 'Fonts'
			'fonts'             => array(
				'title'    => esc_html__( 'Typography', 'shift-cv' ),
				'desc'     => '',
				'priority' => 200,
				'type'     => 'panel',
			),

			// Fonts - Load_fonts
			'load_fonts'        => array(
				'title' => esc_html__( 'Load fonts', 'shift-cv' ),
				'desc'  => wp_kses_data( __( 'Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'shift-cv' ) )
						. '<br>'
						. wp_kses_data( __( 'Attention! Press "Refresh" button to reload preview area after the all fonts are changed', 'shift-cv' ) ),
				'type'  => 'section',
			),
			'load_fonts_subset' => array(
				'title'   => esc_html__( 'Google fonts subsets', 'shift-cv' ),
				'desc'    => wp_kses_data( __( 'Specify comma separated list of the subsets which will be load from Google fonts', 'shift-cv' ) )
						. '<br>'
						. wp_kses_data( __( 'Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'shift-cv' ) ),
				'class'   => 'shift_cv_column-1_3 shift_cv_new_row',
				'refresh' => false,
				'std'     => '$shift_cv_get_load_fonts_subset',
				'type'    => 'text',
			),
		);

		for ( $i = 1; $i <= shift_cv_get_theme_setting( 'max_load_fonts' ); $i++ ) {
			if ( shift_cv_get_value_gp( 'page' ) != 'theme_options' ) {
				$fonts[ "load_fonts-{$i}-info" ] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					'title' => esc_html( sprintf( __( 'Font %s', 'shift-cv' ), $i ) ),
					'desc'  => '',
					'type'  => 'info',
				);
			}
			$fonts[ "load_fonts-{$i}-name" ]   = array(
				'title'   => esc_html__( 'Font name', 'shift-cv' ),
				'desc'    => '',
				'class'   => 'shift_cv_column-1_3 shift_cv_new_row',
				'refresh' => false,
				'std'     => '$shift_cv_get_load_fonts_option',
				'type'    => 'text',
			);
			$fonts[ "load_fonts-{$i}-family" ] = array(
				'title'   => esc_html__( 'Font family', 'shift-cv' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Select font family to use it if font above is not available', 'shift-cv' ) )
							: '',
				'class'   => 'shift_cv_column-1_3',
				'refresh' => false,
				'std'     => '$shift_cv_get_load_fonts_option',
				'options' => array(
					'inherit'    => esc_html__( 'Inherit', 'shift-cv' ),
					'serif'      => esc_html__( 'serif', 'shift-cv' ),
					'sans-serif' => esc_html__( 'sans-serif', 'shift-cv' ),
					'monospace'  => esc_html__( 'monospace', 'shift-cv' ),
					'cursive'    => esc_html__( 'cursive', 'shift-cv' ),
					'fantasy'    => esc_html__( 'fantasy', 'shift-cv' ),
				),
				'type'    => 'select',
			);
			$fonts[ "load_fonts-{$i}-styles" ] = array(
				'title'   => esc_html__( 'Font styles', 'shift-cv' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'shift-cv' ) )
								. '<br>'
								. wp_kses_data( __( 'Attention! Each weight and style increase download size! Specify only used weights and styles.', 'shift-cv' ) )
							: '',
				'class'   => 'shift_cv_column-1_3',
				'refresh' => false,
				'std'     => '$shift_cv_get_load_fonts_option',
				'type'    => 'text',
			);
		}
		$fonts['load_fonts_end'] = array(
			'type' => 'section_end',
		);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = shift_cv_get_theme_fonts();
		foreach ( $theme_fonts as $tag => $v ) {
			$fonts[ "{$tag}_section" ] = array(
				'title' => ! empty( $v['title'] )
								? $v['title']
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html( sprintf( __( '%s settings', 'shift-cv' ), $tag ) ),
				'desc'  => ! empty( $v['description'] )
								? $v['description']
								// Translators: Add tag's name to make description
								: wp_kses( sprintf( __( 'Font settings of the "%s" tag.', 'shift-cv' ), $tag ), 'shift_cv_kses_content' ),
				'type'  => 'section',
			);

			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				$options    = '';
				$type       = 'text';
				$load_order = 1;
				$title      = ucfirst( str_replace( '-', ' ', $css_prop ) );
				if ( 'font-family' == $css_prop ) {
					$type       = 'select';
					$options    = array();
					$load_order = 2;        // Load this option's value after all options are loaded (use option 'load_fonts' to build fonts list)
				} elseif ( 'font-weight' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'shift-cv' ),
						'100'     => esc_html__( '100 (Light)', 'shift-cv' ),
						'200'     => esc_html__( '200 (Light)', 'shift-cv' ),
						'300'     => esc_html__( '300 (Thin)', 'shift-cv' ),
						'400'     => esc_html__( '400 (Normal)', 'shift-cv' ),
						'500'     => esc_html__( '500 (Semibold)', 'shift-cv' ),
						'600'     => esc_html__( '600 (Semibold)', 'shift-cv' ),
						'700'     => esc_html__( '700 (Bold)', 'shift-cv' ),
						'800'     => esc_html__( '800 (Black)', 'shift-cv' ),
						'900'     => esc_html__( '900 (Black)', 'shift-cv' ),
					);
				} elseif ( 'font-style' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'shift-cv' ),
						'normal'  => esc_html__( 'Normal', 'shift-cv' ),
						'italic'  => esc_html__( 'Italic', 'shift-cv' ),
					);
				} elseif ( 'text-decoration' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'      => esc_html__( 'Inherit', 'shift-cv' ),
						'none'         => esc_html__( 'None', 'shift-cv' ),
						'underline'    => esc_html__( 'Underline', 'shift-cv' ),
						'overline'     => esc_html__( 'Overline', 'shift-cv' ),
						'line-through' => esc_html__( 'Line-through', 'shift-cv' ),
					);
				} elseif ( 'text-transform' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'    => esc_html__( 'Inherit', 'shift-cv' ),
						'none'       => esc_html__( 'None', 'shift-cv' ),
						'uppercase'  => esc_html__( 'Uppercase', 'shift-cv' ),
						'lowercase'  => esc_html__( 'Lowercase', 'shift-cv' ),
						'capitalize' => esc_html__( 'Capitalize', 'shift-cv' ),
					);
				}
				$fonts[ "{$tag}_{$css_prop}" ] = array(
					'title'      => $title,
					'desc'       => '',
					'class'      => 'shift_cv_column-1_5',
					'refresh'    => false,
					'load_order' => $load_order,
					'std'        => '$shift_cv_get_theme_fonts_option',
					'options'    => $options,
					'type'       => $type,
				);
			}

			$fonts[ "{$tag}_section_end" ] = array(
				'type' => 'section_end',
			);
		}

		$fonts['fonts_end'] = array(
			'type' => 'panel_end',
		);

		// Add fonts parameters to Theme Options
		shift_cv_storage_set_array_before( 'options', 'panel_colors', $fonts );

		// Add Header Video if WP version < 4.7
		// -----------------------------------------------------
		if ( ! function_exists( 'get_header_video_url' ) ) {
			shift_cv_storage_set_array_after(
				'options', 'header_image_override', 'header_video', array(
					'title'    => esc_html__( 'Header video', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Select video to use it as background for the header', 'shift-cv' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'shift-cv' ),
					),
					'std'      => '',
					'type'     => 'video',
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is 'Theme Options'
		// ------------------------------------------------------
		if ( ! function_exists( 'the_custom_logo' ) || ( isset( $_REQUEST['page'] ) && in_array( $_REQUEST['page'], array( 'theme_options', 'trx_addons_theme_panel' ) ) ) ) {
			shift_cv_storage_set_array_before(
				'options', 'logo_retina', function_exists( 'the_custom_logo' ) ? 'custom_logo' : 'logo', array(
					'title'    => esc_html__( 'Logo', 'shift-cv' ),
					'desc'     => wp_kses_data( __( 'Select or upload the site logo', 'shift-cv' ) ),
					'class'    => 'shift_cv_column-1_2 shift_cv_new_row',
					'priority' => 60,
					'std'      => '',
					'qsetup'   => esc_html__( 'General', 'shift-cv' ),
					'type'     => 'image',
				)
			);
		}

	}
}


// Returns a list of options that can be overridden for CPT
if ( ! function_exists( 'shift_cv_options_get_list_cpt_options' ) ) {
	function shift_cv_options_get_list_cpt_options( $cpt, $title = '' ) {
		if ( empty( $title ) ) {
			$title = ucfirst( $cpt );
		}
		return array(
			"header_info_{$cpt}"            => array(
				'title' => esc_html__( 'Header', 'shift-cv' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"header_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Header style', 'shift-cv' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'shift-cv' ) ),
				'std'     => 'inherit',
				'options' => shift_cv_get_list_header_footer_types( true ),
				'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'shift-cv' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select custom layout to display the site header on the %s pages', 'shift-cv' ), $title ) ),
				'dependency' => array(
					"header_type_{$cpt}" => array( 'custom' ),
				),
				'std'        => 'inherit',
				'options'    => array(),
				'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
			),
			"header_position_{$cpt}"        => array(
				'title'   => esc_html__( 'Header position', 'shift-cv' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to display the site header on the %s pages', 'shift-cv' ), $title ) ),
				'std'     => 'inherit',
				'options' => array(),
				'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_image_override_{$cpt}"  => array(
				'title'   => esc_html__( 'Header image override', 'shift-cv' ),
				'desc'    => wp_kses_data( __( "Allow override the header image with the post's featured image", 'shift-cv' ) ),
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'shift-cv' ),
					1         => esc_html__( 'Yes', 'shift-cv' ),
					0         => esc_html__( 'No', 'shift-cv' ),
				),
				'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_widgets_{$cpt}"         => array(
				'title'   => esc_html__( 'Header widgets', 'shift-cv' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select set of widgets to show in the header on the %s pages', 'shift-cv' ), $title ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => 'select',
			),

			"sidebar_info_{$cpt}"           => array(
				'title' => esc_html__( 'Sidebar', 'shift-cv' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"sidebar_position_{$cpt}"       => array(
				'title'   => esc_html__( 'Sidebar position', 'shift-cv' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to show sidebar on the %s pages', 'shift-cv' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_widgets_{$cpt}"        => array(
				'title'      => esc_html__( 'Sidebar widgets', 'shift-cv' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select sidebar to show on the %s pages', 'shift-cv' ), $title ) ),
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( 'left', 'right' ),
				),
				'std'        => 'hide',
				'options'    => array(),
				'type'       => 'select',
			),
			"hide_sidebar_on_single_{$cpt}" => array(
				'title'   => esc_html__( 'Hide sidebar on the single pages', 'shift-cv' ),
				'desc'    => wp_kses_data( __( 'Hide sidebar on the single page', 'shift-cv' ) ),
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'shift-cv' ),
					1         => esc_html__( 'Hide', 'shift-cv' ),
					0         => esc_html__( 'Show', 'shift-cv' ),
				),
				'type'    => 'switch',
			),

			"footer_info_{$cpt}"            => array(
				'title' => esc_html__( 'Footer', 'shift-cv' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"footer_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Footer style', 'shift-cv' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'shift-cv' ) ),
				'std'     => 'inherit',
				'options' => shift_cv_get_list_header_footer_types( true ),
				'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'switch',
			),
			"footer_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'shift-cv' ),
				'desc'       => wp_kses_data( __( 'Select custom layout to display the site footer', 'shift-cv' ) ),
				'std'        => 'inherit',
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'custom' ),
				),
				'options'    => array(),
				'type'       => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
			),
			"footer_widgets_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer widgets', 'shift-cv' ),
				'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'shift-cv' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 'footer_widgets',
				'options'    => array(),
				'type'       => 'select',
			),
			"footer_columns_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer columns', 'shift-cv' ),
				'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'shift-cv' ) ),
				'dependency' => array(
					"footer_type_{$cpt}"    => array( 'default' ),
					"footer_widgets_{$cpt}" => array( '^hide' ),
				),
				'std'        => 0,
				'options'    => shift_cv_get_list_range( 0, 6 ),
				'type'       => 'select',
			),
			"footer_wide_{$cpt}"            => array(
				'title'      => esc_html__( 'Footer fullwidth', 'shift-cv' ),
				'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'shift-cv' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 0,
				'type'       => 'checkbox',
			),

			"widgets_info_{$cpt}"           => array(
				'title' => esc_html__( 'Additional panels', 'shift-cv' ),
				'desc'  => '',
				'type'  => SHIFT_CV_THEME_FREE ? 'hidden' : 'info',
			),
			"widgets_above_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the top of the page', 'shift-cv' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'shift-cv' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_above_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets above the content', 'shift-cv' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'shift-cv' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets below the content', 'shift-cv' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'shift-cv' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the bottom of the page', 'shift-cv' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'shift-cv' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => SHIFT_CV_THEME_FREE ? 'hidden' : 'select',
			),
		);
	}
}


// Return lists with choises when its need in the admin mode
if ( ! function_exists( 'shift_cv_options_get_list_choises' ) ) {
	add_filter( 'shift_cv_filter_options_get_list_choises', 'shift_cv_options_get_list_choises', 10, 2 );
	function shift_cv_options_get_list_choises( $list, $id ) {
		if ( is_array( $list ) && count( $list ) == 0 ) {
			if ( strpos( $id, 'header_style' ) === 0 ) {
				$list = shift_cv_get_list_header_styles( strpos( $id, 'header_style_' ) === 0 );
			} elseif ( strpos( $id, 'header_position' ) === 0 ) {
				$list = shift_cv_get_list_header_positions( strpos( $id, 'header_position_' ) === 0 );
			} elseif ( strpos( $id, 'header_widgets' ) === 0 ) {
				$list = shift_cv_get_list_sidebars( strpos( $id, 'header_widgets_' ) === 0, true );
			} elseif ( strpos( $id, '_scheme' ) > 0 ) {
				$list = shift_cv_get_list_schemes( 'color_scheme' != $id );
			} elseif ( strpos( $id, 'sidebar_widgets' ) === 0 ) {
				$list = shift_cv_get_list_sidebars( strpos( $id, 'sidebar_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'sidebar_position' ) === 0 ) {
				$list = shift_cv_get_list_sidebars_positions( strpos( $id, 'sidebar_position_' ) === 0 );
			} elseif ( strpos( $id, 'widgets_above_page' ) === 0 ) {
				$list = shift_cv_get_list_sidebars( strpos( $id, 'widgets_above_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_above_content' ) === 0 ) {
				$list = shift_cv_get_list_sidebars( strpos( $id, 'widgets_above_content_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_page' ) === 0 ) {
				$list = shift_cv_get_list_sidebars( strpos( $id, 'widgets_below_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_content' ) === 0 ) {
				$list = shift_cv_get_list_sidebars( strpos( $id, 'widgets_below_content_' ) === 0, true );
			} elseif ( strpos( $id, 'footer_style' ) === 0 ) {
				$list = shift_cv_get_list_footer_styles( strpos( $id, 'footer_style_' ) === 0 );
			} elseif ( strpos( $id, 'footer_widgets' ) === 0 ) {
				$list = shift_cv_get_list_sidebars( strpos( $id, 'footer_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'blog_style' ) === 0 ) {
				$list = shift_cv_get_list_blog_styles( strpos( $id, 'blog_style_' ) === 0 );
			} elseif ( strpos( $id, 'post_type' ) === 0 ) {
				$list = shift_cv_get_list_posts_types();
			} elseif ( strpos( $id, 'parent_cat' ) === 0 ) {
				$list = shift_cv_array_merge( array( 0 => esc_html__( '- Select category -', 'shift-cv' ) ), shift_cv_get_list_categories() );
			} elseif ( strpos( $id, 'blog_animation' ) === 0 ) {
				$list = shift_cv_get_list_animations_in();
			} elseif ( 'color_scheme_editor' == $id ) {
				$list = shift_cv_get_list_schemes();
			} elseif ( strpos( $id, '_font-family' ) > 0 ) {
				$list = shift_cv_get_list_load_fonts( true );
			}
		}
		return $list;
	}
}
