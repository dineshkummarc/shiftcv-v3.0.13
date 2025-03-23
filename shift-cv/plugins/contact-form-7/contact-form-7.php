<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'shift_cv_cf7_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'shift_cv_cf7_theme_setup9', 9 );
	function shift_cv_cf7_theme_setup9() {

		add_filter( 'shift_cv_filter_merge_scripts', 'shift_cv_cf7_merge_scripts' );
		add_filter( 'shift_cv_filter_merge_styles', 'shift_cv_cf7_merge_styles' );

		if ( shift_cv_exists_cf7() ) {
			add_filter('wpcf7_autop_or_not', '__return_false');
			add_action( 'wp_enqueue_scripts', 'shift_cv_cf7_frontend_scripts', 1100 );
		}

		if ( is_admin() ) {
			add_filter( 'shift_cv_filter_tgmpa_required_plugins', 'shift_cv_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'shift_cv_cf7_tgmpa_required_plugins' ) ) {
	function shift_cv_cf7_tgmpa_required_plugins( $list = array() ) {
		if ( shift_cv_storage_isset( 'required_plugins', 'contact-form-7' ) ) {
			// CF7 plugin
			$list[] = array(
				'name'     => shift_cv_storage_get_array( 'required_plugins', 'contact-form-7' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( ! function_exists( 'shift_cv_exists_cf7' ) ) {
	function shift_cv_exists_cf7() {
		return class_exists( 'WPCF7' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'shift_cv_cf7_frontend_scripts' ) ) {
	function shift_cv_cf7_frontend_scripts() {
		if ( shift_cv_exists_cf7() ) {
			if ( shift_cv_is_on( shift_cv_get_theme_option( 'debug_mode' ) ) ) {
				$shift_cv_url = shift_cv_get_file_url( 'plugins/contact-form-7/contact-form-7.js' );
				if ( '' != $shift_cv_url ) {
					wp_enqueue_script( 'shift-cv-cf7', $shift_cv_url, array( 'jquery' ), null, true );
				}
			}
		}
	}
}

// Merge custom scripts
if ( ! function_exists( 'shift_cv_cf7_merge_scripts' ) ) {
	function shift_cv_cf7_merge_scripts( $list ) {
		if ( shift_cv_exists_cf7() ) {
			$list[] = 'plugins/contact-form-7/contact-form-7.js';
		}
		return $list;
	}
}

// Merge custom styles
if ( ! function_exists( 'shift_cv_cf7_merge_styles' ) ) {
	function shift_cv_cf7_merge_styles( $list ) {
		if ( shift_cv_exists_cf7() ) {
			$list[] = 'plugins/contact-form-7/_contact-form-7.scss';
		}
		return $list;
	}
}

