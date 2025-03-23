<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

$shift_cv_args = get_query_var( 'shift_cv_logo_args' );

// Site logo
$shift_cv_logo_type   = isset( $shift_cv_args['type'] ) ? $shift_cv_args['type'] : '';
$shift_cv_logo_image  = shift_cv_get_logo_image( $shift_cv_logo_type );
$shift_cv_logo_text   = shift_cv_is_on( shift_cv_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$shift_cv_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $shift_cv_logo_image ) || ! empty( $shift_cv_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $shift_cv_logo_image ) ) {
			if ( empty( $shift_cv_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric( $shift_cv_logo_image ) && (int) $shift_cv_logo_image > 0 ) {
				the_custom_logo();
			} else {
				$shift_cv_attr = shift_cv_getimagesize( $shift_cv_logo_image );
				echo '<img src="' . esc_url( $shift_cv_logo_image ) . '" alt="' . esc_attr( $shift_cv_logo_text ) . '"' . ( ! empty( $shift_cv_attr[3] ) ? ' ' . wp_kses_data( $shift_cv_attr[3] ) : '' ) . '>';
			}
		} else {
			shift_cv_show_layout( shift_cv_prepare_macros( $shift_cv_logo_text ), '<span class="logo_text">', '</span>' );
			shift_cv_show_layout( shift_cv_prepare_macros( $shift_cv_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
