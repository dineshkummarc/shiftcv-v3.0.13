<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js
									<?php
										// Class scheme_xxx need in the <html> as context for the <body>!
										echo ' scheme_' . esc_attr( shift_cv_get_color_scheme() );
									?>
										">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>
    <?php wp_body_open(); ?>

	<?php do_action( 'shift_cv_action_before_body' ); ?>

	<div class="accent-line-top"><span class="style-1"></span><span class="style-2"></span><span class="style-3"></span><span class="style-4"></span><span class="style-5"></span></div>

	<div class="body_wrap">

		<div class="page_wrap">
			<?php
			// Desktop header
			$shift_cv_header_type = shift_cv_get_theme_option( 'header_type' );
			if ( 'custom' == $shift_cv_header_type && ! shift_cv_is_layouts_available() ) {
				$shift_cv_header_type = 'default';
			}
			get_template_part( apply_filters( 'shift_cv_filter_get_template_part', "templates/header-{$shift_cv_header_type}" ) );

			// Side menu
			if ( in_array( shift_cv_get_theme_option( 'menu_style' ), array( 'left', 'right' ) ) ) {
				get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/header-navi-side' ) );
			}

			// Mobile menu
			get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/header-navi-mobile' ) );
			?>

			<div class="page_content_wrap">

				<?php if ( shift_cv_get_theme_option( 'body_style' ) != 'fullscreen' ) { ?>
				<div class="content_wrap">
				<?php } ?>

					<?php
					// Widgets area above page content
					shift_cv_create_widgets_area( 'widgets_above_page' );
					?>

					<div class="content">
						<?php
						// Widgets area inside page content
						shift_cv_create_widgets_area( 'widgets_above_content' );
