<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.10
 */


// Socials
if ( shift_cv_is_on( shift_cv_get_theme_option( 'socials_in_footer' ) ) ) {
	$shift_cv_output = shift_cv_get_socials_links();
	if ( '' != $shift_cv_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php shift_cv_show_layout( $shift_cv_output ); ?>
			</div>
		</div>
		<?php
	}
}
