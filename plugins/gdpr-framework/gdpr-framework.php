<?php
/* The GDPR Framework support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'shift_cv_gdpr_framework_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'shift_cv_gdpr_framework_theme_setup9', 9 );
	function shift_cv_gdpr_framework_theme_setup9() {

		if ( is_admin() ) {
			add_filter( 'shift_cv_filter_tgmpa_required_plugins', 'shift_cv_gdpr_framework_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'shift_cv_gdpr_framework_tgmpa_required_plugins' ) ) {
	function shift_cv_gdpr_framework_tgmpa_required_plugins( $list = array() ) {
		if ( false && shift_cv_storage_isset( 'required_plugins', 'gdpr-framework' ) ) {
			// CF7 plugin
			$list[] = array(
				'name'     => shift_cv_storage_get_array( 'required_plugins', 'gdpr-framework' ),
				'slug'     => 'gdpr-framework',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if cf7 installed and activated
if ( ! function_exists( 'shift_cv_exists_gdpr_framework' ) ) {
	function shift_cv_exists_gdpr_framework() {
		return defined( 'GDPR_FRAMEWORK_VERSION' );
	}
}