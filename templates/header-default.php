<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

$shift_cv_header_css   = '';
$shift_cv_header_image = get_header_image();
$shift_cv_header_video = shift_cv_get_header_video();
if ( ! empty( $shift_cv_header_image ) && shift_cv_trx_addons_featured_image_override( is_singular() || shift_cv_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$shift_cv_header_image = shift_cv_get_current_mode_image( $shift_cv_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $shift_cv_header_image ) || ! empty( $shift_cv_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $shift_cv_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $shift_cv_header_image ) {
		echo ' ' . esc_attr( shift_cv_add_inline_css_class( 'background-image: url(' . esc_url( $shift_cv_header_image ) . ');' ) );
	}
	if ( is_single() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( shift_cv_is_on( shift_cv_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight shift_cv-full-height';
	}
	if ( ! shift_cv_is_inherit( shift_cv_get_theme_option( 'header_scheme' ) ) ) {
		echo ' scheme_' . esc_attr( shift_cv_get_theme_option( 'header_scheme' ) );
	}
	?>
">
	<div class="space_wrap_large"></div><?php

	// Theme switcher
	shift_cv_show_theme_switcher();

	?><div class="header-default-content-wrap"><?php

	// Background video
	if ( ! empty( $shift_cv_header_video ) ) {
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	if ( shift_cv_get_theme_option( 'menu_style' ) == 'top' ) {
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/header-navi' ) );
	}

	// Mobile header
	if ( shift_cv_is_on( shift_cv_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/header-mobile' ) );
	}


	?></div><!-- /.header-default-content-wrap --><?php
	// Page title and breadcrumbs area
	if ( shift_cv_need_page_title() ) {
		?><div class="header-default-content-wrap"><?php

			shift_cv_sc_layouts_showed( 'title', true );
			shift_cv_sc_layouts_showed( 'postmeta', true );
			?>
			<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
			<div class="content_wrap">
				<div class="sc_layouts_column sc_layouts_column_align_center">
					<div class="sc_layouts_item">
						<div class="sc_layouts_title sc_align_center">
							<?php

							// Blog/Post title
							?>
							<div class="sc_layouts_title_title">
								<?php
								$shift_cv_blog_title           = shift_cv_get_blog_title();
								$shift_cv_blog_title_text      = '';
								$shift_cv_blog_title_class     = '';
								$shift_cv_blog_title_link      = '';
								$shift_cv_blog_title_link_text = '';
								if ( is_array( $shift_cv_blog_title ) ) {
									$shift_cv_blog_title_text      = $shift_cv_blog_title['text'];
									$shift_cv_blog_title_class     = ! empty( $shift_cv_blog_title['class'] ) ? ' ' . $shift_cv_blog_title['class'] : '';
									$shift_cv_blog_title_link      = ! empty( $shift_cv_blog_title['link'] ) ? $shift_cv_blog_title['link'] : '';
									$shift_cv_blog_title_link_text = ! empty( $shift_cv_blog_title['link_text'] ) ? $shift_cv_blog_title['link_text'] : '';
								} else {
									$shift_cv_blog_title_text = $shift_cv_blog_title;
								}
								?><h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $shift_cv_blog_title_class ); ?>"><?php
									$shift_cv_top_icon = shift_cv_get_category_icon();
									if ( ! empty( $shift_cv_top_icon ) ) {
										$shift_cv_attr = shift_cv_getimagesize( $shift_cv_top_icon );
										?><img src="<?php echo esc_url( $shift_cv_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'shift-cv' ); ?>"<?php
										if ( ! empty( $shift_cv_attr[3] ) ) {
											shift_cv_show_layout( $shift_cv_attr[3] );
										}
										?>><?php
									}
									echo wp_kses( $shift_cv_blog_title_text, 'shift_cv_kses_content' );
									?></h1><?php
								if ( ! empty( $shift_cv_blog_title_link ) && ! empty( $shift_cv_blog_title_link_text ) ) {
									?><a href="<?php echo esc_url( $shift_cv_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $shift_cv_blog_title_link_text ); ?></a><?php
								}
								?></div>
						</div><!-- Breadcrumbs -->
						<div class="sc_layouts_title">
							<div class="sc_layouts_title_breadcrumbs"><?php
								do_action( 'shift_cv_action_breadcrumbs' );
								?></div>
						</div>
					</div>
				</div>
			</div>
			</div><?php

		// Header widgets area
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/header-widgets' ) );

		// Display featured image in the header on the single posts
		// Comment next line to prevent show featured image in the header area
		// and display it in the post's content
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/header-single' ) );

		?></div><!-- /.header-default-content-wrap --><?php
	}
	?>
</header>
