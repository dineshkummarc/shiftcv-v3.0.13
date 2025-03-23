<?php
/**
 * The template to display the featured image in the single post
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

if ( get_query_var( 'shift_cv_header_image' ) == '' && shift_cv_trx_addons_featured_image_override( is_singular() && has_post_thumbnail() && in_array( get_post_type(), array( 'post', 'page' ) ) ) ) {
	$shift_cv_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if ( ! empty( $shift_cv_src[0] ) ) {
		shift_cv_sc_layouts_showed( 'featured', true );
		?>
		<div class="sc_layouts_featured with_image without_content <?php echo esc_attr( shift_cv_add_inline_css_class( 'background-image:url(' . esc_url( $shift_cv_src[0] ) . ');' ) ); ?>"></div>
		<?php
	}
}
