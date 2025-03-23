<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.10
 */

// Footer menu
$shift_cv_menu_footer = shift_cv_get_nav_menu(
	array(
		'location' => 'menu_footer',
		'class'    => 'sc_layouts_menu sc_layouts_menu_default',
	)
);
if ( ! empty( $shift_cv_menu_footer ) ) {
	?>
	<div class="content_wrap">
		<div class="footer_menu_wrap">
			<div class="footer_menu_inner">
				<?php shift_cv_show_layout( $shift_cv_menu_footer ); ?>
			</div>
		</div>
	</div><!-- /.content_wrap -->
	<?php
}
