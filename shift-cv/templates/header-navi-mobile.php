<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr( shift_cv_get_theme_option( 'menu_mobile_fullscreen' ) > 0 ? 'fullscreen' : 'narrow' ); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a>
		<?php

		// Logo
		set_query_var( 'shift_cv_logo_args', array( 'type' => 'mobile' ) );
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/header-logo' ) );
		set_query_var( 'shift_cv_logo_args', array() );

		// Mobile menu
		$shift_cv_menu_mobile = shift_cv_get_nav_menu( 'menu_mobile' );
		if ( empty( $shift_cv_menu_mobile ) ) {
			$shift_cv_menu_mobile = apply_filters( 'shift_cv_filter_get_mobile_menu', '' );
			if ( empty( $shift_cv_menu_mobile ) ) {
				$shift_cv_menu_mobile = shift_cv_get_nav_menu( 'menu_main' );
			}
			if ( empty( $shift_cv_menu_mobile ) ) {
				$shift_cv_menu_mobile = shift_cv_get_nav_menu();
			}
		}
		if ( ! empty( $shift_cv_menu_mobile ) ) {
			if ( ! empty( $shift_cv_menu_mobile ) ) {
				$shift_cv_menu_mobile = str_replace(
					array( 'menu_main',   'id="menu-',        'sc_layouts_menu_nav', 'sc_layouts_menu ', 'sc_layouts_hide_on_mobile', 'hide_on_mobile' ),
					array( 'menu_mobile', 'id="menu_mobile-', '',                    ' ',                '',                          '' ),
					$shift_cv_menu_mobile
				);
			}
			if ( strpos( $shift_cv_menu_mobile, '<nav ' ) === false ) {
				$shift_cv_menu_mobile = sprintf( '<nav class="menu_mobile_nav_area">%s</nav>', $shift_cv_menu_mobile );
			}
			shift_cv_show_layout( apply_filters( 'shift_cv_filter_menu_mobile_layout', $shift_cv_menu_mobile ) );
		}

		// Search field
		do_action( 'shift_cv_action_search', 'normal', 'search_mobile', false );

		// Social icons
		shift_cv_show_layout( shift_cv_get_socials_links(), '<div class="socials_mobile">', '</div>' );
		?>
	</div>
</div>
