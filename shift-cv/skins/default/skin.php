<?php
/**
 * Skins support: Main skin file for the skin 'Default'
 *
 * Setup skin-dependent fonts and colors, load scripts and styles,
 * and other operations that affect the appearance and behavior of the theme
 * when the skin is activated
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.46
 */

 // Theme storage
//-------------------------------------------------------------------------
if(!is_rtl()) {
	shift_cv_storage_set('theme_demo_url', '//shiftcv.dv.themerex.net');
} else {
	shift_cv_storage_set('theme_demo_url', '//rtl.shiftcv.dv.themerex.net');
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'shift_cv_skin_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'shift_cv_skin_theme_setup3', 3 );
	function shift_cv_skin_theme_setup3() {
		// ToDo: Add / Modify theme options, required plugins, etc.
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'shift_cv_skin_tgmpa_required_plugins' ) ) {
	add_filter( 'shift_cv_filter_tgmpa_required_plugins', 'shift_cv_skin_tgmpa_required_plugins' );
	function shift_cv_skin_tgmpa_required_plugins( $list = array() ) {
		// ToDo: Check if plugin is in the 'required_plugins' and add his parameters to the TGMPA-list
		//       Replace 'skin-specific-plugin-slug' to the real slug of the plugin
		if ( shift_cv_storage_isset( 'required_plugins', 'skin-specific-plugin-slug' ) ) {
			$list[] = array(
				'name'     => shift_cv_storage_get_array( 'required_plugins', 'skin-specific-plugin-slug' ),
				'slug'     => 'skin-specific-plugin-slug',
				'required' => false,
			);
		}
		return $list;
	}
}

// Enqueue skin-specific styles and scripts
if ( ! function_exists( 'shift_cv_skin_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'shift_cv_skin_frontend_scripts', 1100 );
	function shift_cv_skin_frontend_scripts() {
		if ( shift_cv_is_on( shift_cv_get_theme_option( 'debug_mode' ) ) ) {
			$shift_cv_url = shift_cv_get_file_url( SHIFT_CV_SKIN_DIR . 'skin.js' );
			if ( '' != $shift_cv_url ) {
				wp_enqueue_script( 'shift-cv-skin-' . esc_attr( SHIFT_CV_SKIN_NAME ), $shift_cv_url, array( 'jquery' ), null, true );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'shift_cv_skin_merge_styles' ) ) {
	add_filter( 'shift_cv_filter_merge_styles', 'shift_cv_skin_merge_styles' );
	function shift_cv_skin_merge_styles( $list ) {
		if ( shift_cv_get_file_dir( SHIFT_CV_SKIN_DIR . '_skin.scss' ) != '' ) {
			$list[] = SHIFT_CV_SKIN_DIR . '_skin.scss';
		}
		return $list;
	}
}


// Merge responsive styles
if ( ! function_exists( 'shift_cv_skin_merge_styles_responsive' ) ) {
	add_filter( 'shift_cv_filter_merge_styles_responsive', 'shift_cv_skin_merge_styles_responsive' );
	function shift_cv_skin_merge_styles_responsive( $list ) {
		if ( shift_cv_get_file_dir( SHIFT_CV_SKIN_DIR . '_skin-responsive.scss' ) != '' ) {
			$list[] = SHIFT_CV_SKIN_DIR . '_skin-responsive.scss';
		}
		return $list;
	}
}

// Merge custom scripts
if ( ! function_exists( 'shift_cv_skin_merge_scripts' ) ) {
	add_filter( 'shift_cv_filter_merge_scripts', 'shift_cv_skin_merge_scripts' );
	function shift_cv_skin_merge_scripts( $list ) {
		if ( shift_cv_get_file_dir( SHIFT_CV_SKIN_DIR . 'skin.js' ) != '' ) {
			$list[] = SHIFT_CV_SKIN_DIR . 'skin.js';
		}
		return $list;
	}
}


// Add slin-specific colors and fonts to the custom CSS
require_once SHIFT_CV_THEME_DIR . SHIFT_CV_SKIN_DIR . 'skin-styles.php';

