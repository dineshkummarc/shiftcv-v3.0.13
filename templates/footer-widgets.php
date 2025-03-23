<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.10
 */

// Footer sidebar
$shift_cv_footer_name    = shift_cv_get_theme_option( 'footer_widgets' );
$shift_cv_footer_present = ! shift_cv_is_off( $shift_cv_footer_name ) && is_active_sidebar( $shift_cv_footer_name );
if ( $shift_cv_footer_present ) {
	shift_cv_storage_set( 'current_sidebar', 'footer' );
	$shift_cv_footer_wide = shift_cv_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $shift_cv_footer_name ) ) {
		dynamic_sidebar( $shift_cv_footer_name );
	}
	$shift_cv_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $shift_cv_out ) ) {
		$shift_cv_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $shift_cv_out );
		$shift_cv_need_columns = true;   //or check: strpos($shift_cv_out, 'columns_wrap')===false;
		if ( $shift_cv_need_columns ) {
			$shift_cv_columns = max( 0, (int) shift_cv_get_theme_option( 'footer_columns' ) );
			if ( 0 == $shift_cv_columns ) {
				$shift_cv_columns = min( 3, max( 1, substr_count( $shift_cv_out, '<aside ' ) ) );
			}
			if ( $shift_cv_columns > 1 ) {
				$shift_cv_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $shift_cv_columns ) . ' widget', $shift_cv_out );
			} else {
				$shift_cv_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $shift_cv_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $shift_cv_footer_wide ) {
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
				shift_cv_show_layout( $shift_cv_out );
				do_action( 'shift_cv_action_after_sidebar' );
				if ( $shift_cv_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $shift_cv_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
