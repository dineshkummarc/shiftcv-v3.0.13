<?php
/* ThemeREX Updater support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'shift_cv_trx_updater_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'shift_cv_trx_updater_theme_setup9', 9 );
	function shift_cv_trx_updater_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'shift_cv_filter_tgmpa_required_plugins', 'shift_cv_trx_updater_tgmpa_required_plugins', 8 );
		}
	}
}


// Filter to add in the required plugins list
if ( ! function_exists( 'shift_cv_trx_updater_tgmpa_required_plugins' ) ) {
    
    function shift_cv_trx_updater_tgmpa_required_plugins( $list = array() ) {
        if ( shift_cv_storage_isset( 'required_plugins', 'trx_updater' ) ) {
            $path = shift_cv_get_plugin_source_path( 'plugins/trx_updater/trx_updater.zip' );
            if ( ! empty( $path ) || shift_cv_get_theme_setting( 'tgmpa_upload' ) ) {
                $list[] = array(
                    'name'     => shift_cv_storage_get_array( 'required_plugins', 'trx_updater' ),
                    'slug'     => 'trx_updater',
                    'version'  => '2.1.4',
                    'source'   => ! empty( $path ) ? $path : 'upload://trx_updater.zip',
                    'required' => false,
                );
            }
        }
        return $list;
    }
}


// Check if plugin installed and activated
if ( ! function_exists( 'shift_cv_exists_trx_updater' ) ) {
	function shift_cv_exists_trx_updater() {
		return defined( 'TRX_UPDATER_VERSION' );
	}
}
