<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.06
 */

$shift_cv_header_css   = '';
$shift_cv_header_image = get_header_image();
$shift_cv_header_video = shift_cv_get_header_video();
if ( ! empty( $shift_cv_header_image ) && shift_cv_trx_addons_featured_image_override( is_singular() || shift_cv_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$shift_cv_header_image = shift_cv_get_current_mode_image( $shift_cv_header_image );
}

$shift_cv_header_id = str_replace( 'header-custom-', '', shift_cv_get_theme_option( 'header_style' ) );
if ( 0 == (int) $shift_cv_header_id ) {
	$shift_cv_header_id = shift_cv_get_post_id(
		array(
			'name'      => $shift_cv_header_id,
			'post_type' => defined( 'TRX_ADDONS_CPT_LAYOUTS_PT' ) ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts',
		)
	);
} else {
	$shift_cv_header_id = apply_filters( 'shift_cv_filter_get_translated_layout', $shift_cv_header_id );
}
$shift_cv_header_meta = get_post_meta( $shift_cv_header_id, 'trx_addons_options', true );
if ( ! empty( $shift_cv_header_meta['margin'] ) != '' ) {
	shift_cv_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( shift_cv_prepare_css_value( $shift_cv_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $shift_cv_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $shift_cv_header_id ) ) ); ?>
				<?php
				echo ! empty( $shift_cv_header_image ) || ! empty( $shift_cv_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $shift_cv_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $shift_cv_header_image ) {
					echo ' ' . esc_attr( shift_cv_add_inline_css_class( 'background-image: url(' . esc_url( $shift_cv_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( shift_cv_is_on( shift_cv_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight shift_cv-full-height';
				}
				if ( ! shift_cv_is_inherit( shift_cv_get_theme_option( 'header_scheme' ) ) ) {
					echo ' scheme_' . esc_attr( shift_cv_get_theme_option( 'header_scheme' ) );
				}
				?>
">
	<?php

	// Theme switcher
	shift_cv_show_theme_switcher();

	// Background video
	if ( ! empty( $shift_cv_header_video ) ) {
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'shift_cv_action_show_layout', $shift_cv_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
