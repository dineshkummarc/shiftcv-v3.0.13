<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

// Header sidebar
$shift_cv_header_name    = shift_cv_get_theme_option( 'header_widgets' );
$shift_cv_header_present = ! shift_cv_is_off( $shift_cv_header_name ) && is_active_sidebar( $shift_cv_header_name );
if ( $shift_cv_header_present ) {
	shift_cv_storage_set( 'current_sidebar', 'header' );
	$shift_cv_header_wide = shift_cv_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $shift_cv_header_name ) ) {
		dynamic_sidebar( $shift_cv_header_name );
	}
	$shift_cv_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $shift_cv_widgets_output ) ) {
		$shift_cv_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $shift_cv_widgets_output );
		$shift_cv_need_columns   = strpos( $shift_cv_widgets_output, 'columns_wrap' ) === false;
		if ( $shift_cv_need_columns ) {
			$shift_cv_columns = max( 0, (int) shift_cv_get_theme_option( 'header_columns' ) );
			if ( 0 == $shift_cv_columns ) {
				$shift_cv_columns = min( 6, max( 1, substr_count( $shift_cv_widgets_output, '<aside ' ) ) );
			}
			if ( $shift_cv_columns > 1 ) {
				$shift_cv_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $shift_cv_columns ) . ' widget', $shift_cv_widgets_output );
			} else {
				$shift_cv_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $shift_cv_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $shift_cv_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $shift_cv_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'shift_cv_action_before_sidebar' );
				shift_cv_show_layout( $shift_cv_widgets_output );
				do_action( 'shift_cv_action_after_sidebar' );
				if ( $shift_cv_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $shift_cv_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
