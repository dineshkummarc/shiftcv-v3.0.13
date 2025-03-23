<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.10
 */

// Logo
if ( shift_cv_is_on( shift_cv_get_theme_option( 'logo_in_footer' ) ) ) {
	$shift_cv_logo_image = shift_cv_get_logo_image( 'footer' );
	$shift_cv_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $shift_cv_logo_image ) || ! empty( $shift_cv_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $shift_cv_logo_image ) ) {
					$shift_cv_attr = shift_cv_getimagesize( $shift_cv_logo_image );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $shift_cv_logo_image ) . '"'
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'shift-cv' ) . '"'
								. ( ! empty( $shift_cv_attr[3] ) ? ' ' . wp_kses_data( $shift_cv_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $shift_cv_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $shift_cv_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
