<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

if ( shift_cv_sidebar_present() ) {
	ob_start();
	$shift_cv_sidebar_name = shift_cv_get_theme_option( 'sidebar_widgets' );
	shift_cv_storage_set( 'current_sidebar', 'sidebar' );
	if ( is_active_sidebar( $shift_cv_sidebar_name ) ) {
		dynamic_sidebar( $shift_cv_sidebar_name );
	}
	$shift_cv_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $shift_cv_out ) ) {
		$shift_cv_sidebar_position = shift_cv_get_theme_option( 'sidebar_position' );
		?>
		<div class="sidebar widget_area
			<?php
			echo esc_attr( $shift_cv_sidebar_position );
			if ( ! shift_cv_is_inherit( shift_cv_get_theme_option( 'sidebar_scheme' ) ) ) {
				echo ' scheme_' . esc_attr( shift_cv_get_theme_option( 'sidebar_scheme' ) );
			}
			?>
		" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'shift_cv_action_before_sidebar' );
				shift_cv_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $shift_cv_out ) );
				do_action( 'shift_cv_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<div class="clearfix"></div>
		<?php
	}
}
