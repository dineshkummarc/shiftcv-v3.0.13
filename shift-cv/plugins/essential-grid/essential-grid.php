<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'shift_cv_essential_grid_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'shift_cv_essential_grid_theme_setup9', 9 );
	function shift_cv_essential_grid_theme_setup9() {

		add_filter( 'shift_cv_filter_merge_styles', 'shift_cv_essential_grid_merge_styles' );

		if ( is_admin() ) {
			add_filter( 'shift_cv_filter_tgmpa_required_plugins', 'shift_cv_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'shift_cv_essential_grid_tgmpa_required_plugins' ) ) {
	function shift_cv_essential_grid_tgmpa_required_plugins( $list = array() ) {
		if ( shift_cv_storage_isset( 'required_plugins', 'essential-grid' ) && shift_cv_is_theme_activated() ) {
			$path = shift_cv_get_plugin_source_path( 'plugins/essential-grid/essential-grid.zip' );
			if ( ! empty( $path ) || shift_cv_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => shift_cv_storage_get_array( 'required_plugins', 'essential-grid' ),
					'slug'     => 'essential-grid',
					'source'   => ! empty( $path ) ? $path : 'upload://essential-grid.zip',
					'version'  => '3.1.5',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'shift_cv_exists_essential_grid' ) ) {
	function shift_cv_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH') || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Merge custom styles
if ( ! function_exists( 'shift_cv_essential_grid_merge_styles' ) ) {
	function shift_cv_essential_grid_merge_styles( $list ) {
		if ( shift_cv_exists_essential_grid() ) {
			$list[] = 'plugins/essential-grid/_essential-grid.scss';
		}
		return $list;
	}
}

