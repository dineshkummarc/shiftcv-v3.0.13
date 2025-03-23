<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.10
 */

$shift_cv_footer_id = str_replace( 'footer-custom-', '', shift_cv_get_theme_option( 'footer_style' ) );
if ( 0 == (int) $shift_cv_footer_id ) {
	$shift_cv_footer_id = shift_cv_get_post_id(
		array(
			'name'      => $shift_cv_footer_id,
			'post_type' => defined( 'TRX_ADDONS_CPT_LAYOUTS_PT' ) ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts',
		)
	);
} else {
	$shift_cv_footer_id = apply_filters( 'shift_cv_filter_get_translated_layout', $shift_cv_footer_id );
}
$shift_cv_footer_meta = get_post_meta( $shift_cv_footer_id, 'trx_addons_options', true );
if ( ! empty( $shift_cv_footer_meta['margin'] ) != '' ) {
	shift_cv_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( shift_cv_prepare_css_value( $shift_cv_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $shift_cv_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $shift_cv_footer_id ) ) ); ?>
						<?php
						if ( ! shift_cv_is_inherit( shift_cv_get_theme_option( 'footer_scheme' ) ) ) {
							echo ' scheme_' . esc_attr( shift_cv_get_theme_option( 'footer_scheme' ) );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'shift_cv_action_show_layout', $shift_cv_footer_id );
	?>
</footer><!-- /.footer_wrap -->
