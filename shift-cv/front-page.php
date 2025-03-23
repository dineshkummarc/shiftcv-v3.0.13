<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.31
 */

get_header();

// If front-page is a static page
if ( get_option( 'show_on_front' ) == 'page' ) {

	// If Front Page Builder is enabled - display sections
	if ( shift_cv_is_on( shift_cv_get_theme_option( 'front_page_enabled' ) ) ) {

		if ( have_posts() ) {
			the_post();
		}

		$shift_cv_sections = shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'front_page_sections' ), 1, false );
		if ( is_array( $shift_cv_sections ) ) {
			foreach ( $shift_cv_sections as $shift_cv_section ) {
				get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'front-page/section', $shift_cv_section ), $shift_cv_section );
			}
		}

		// Else if this page is blog archive
	} elseif ( is_page_template( 'blog.php' ) ) {
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'blog' ) );

		// Else - display native page content
	} else {
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'page' ) );
	}

	// Else get index template to show posts
} else {
	get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'index' ) );
}

get_footer();
