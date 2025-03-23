<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

$shift_cv_template_args = get_query_var( 'shift_cv_template_args' );
if ( is_array( $shift_cv_template_args ) ) {
	$shift_cv_columns    = empty( $shift_cv_template_args['columns'] ) ? 1 : max( 1, $shift_cv_template_args['columns'] );
	$shift_cv_blog_style = array( $shift_cv_template_args['type'], $shift_cv_columns );
} else {
	$shift_cv_blog_style = explode( '_', shift_cv_get_theme_option( 'blog_style' ) );
	$shift_cv_columns    = empty( $shift_cv_blog_style[1] ) ? 2 : max( 2, $shift_cv_blog_style[1] );
}
$shift_cv_post_format = get_post_format();
$shift_cv_post_format = empty( $shift_cv_post_format ) ? 'standard' : str_replace( 'post-format-', '', $shift_cv_post_format );
$shift_cv_animation   = shift_cv_get_theme_option( 'blog_animation' );

?><article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item'
										. ' post_layout_portfolio'
										. ' post_layout_portfolio_' . esc_attr( $shift_cv_columns )
										. ' post_format_' . esc_attr( $shift_cv_post_format )
										. ( is_sticky() && ! is_paged() ? ' sticky' : '' )
										. ( ! empty( $shift_cv_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
									);
									echo ( ! shift_cv_is_off( $shift_cv_animation ) && empty( $shift_cv_template_args['slider'] ) ? ' data-animation="' . esc_attr( shift_cv_get_animation_classes( $shift_cv_animation ) ) . '"' : '' );
									?>><?php

	// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>
		<span class="post_label label_sticky"></span>
		<?php
}

	$shift_cv_image_hover = 'fade';
	// Featured image
	shift_cv_show_post_featured(
		array(
			'singular'      => false,
			'hover'         => $shift_cv_image_hover,
			'no_links'      => ! empty( $shift_cv_template_args['no_links'] ),
			'thumb_size'    => shift_cv_get_thumb_size(
				strpos( shift_cv_get_theme_option( 'body_style' ), 'boxed' ) !== false || $shift_cv_columns < 4
								? 'extra'
				: 'masonry'
			),
			'show_no_image' => true,
			'class'         => 'dots' == $shift_cv_image_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $shift_cv_image_hover ? '<div class="post_info">' . esc_html( get_the_title() ) . '</div>' : '',
		)
	);
	?>
</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!