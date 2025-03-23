<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap<?php
if ( ! shift_cv_is_inherit( shift_cv_get_theme_option( 'copyright_scheme' ) ) ) {
	echo ' scheme_' . esc_attr( shift_cv_get_theme_option( 'copyright_scheme' ) );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$shift_cv_copyright = shift_cv_get_theme_option( 'copyright' );
			if ( ! empty( $shift_cv_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$shift_cv_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $shift_cv_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$shift_cv_copyright = shift_cv_prepare_macros( $shift_cv_copyright );
				// Display copyright
				echo wp_kses( nl2br( $shift_cv_copyright ), 'shift_cv_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
