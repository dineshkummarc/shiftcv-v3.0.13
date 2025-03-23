<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

// Page (category, tag, archive, author) title

if ( shift_cv_need_page_title() ) {
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
}
?>
