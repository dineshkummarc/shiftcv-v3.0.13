<?php
/**
 * The Gallery template to display posts
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
$shift_cv_image       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

?><article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item'
										. ' post_layout_portfolio'
										. ' post_layout_gallery'
										. ' post_layout_gallery_' . esc_attr( $shift_cv_columns )
										. ' post_format_' . esc_attr( $shift_cv_post_format )
										. ( ! empty( $shift_cv_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
									);
									echo ( ! shift_cv_is_off( $shift_cv_animation ) && empty( $shift_cv_template_args['slider'] ) ? ' data-animation="' . esc_attr( shift_cv_get_animation_classes( $shift_cv_animation ) ) . '"' : '' );
									?>
	data-size="
	<?php
	if ( ! empty( $shift_cv_image[1] ) && ! empty( $shift_cv_image[2] ) ) {
		echo intval( $shift_cv_image[1] ) . 'x' . intval( $shift_cv_image[2] );}
	?>
	"
	data-src="
	<?php
	if ( ! empty( $shift_cv_image[0] ) ) {
		echo esc_url( $shift_cv_image[0] );}
	?>
	"
>
<?php

	// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>
		<span class="post_label label_sticky"></span>
		<?php
}

	// Featured image
	$shift_cv_image_hover = 'icon';
if ( in_array( $shift_cv_image_hover, array( 'icons', 'zoom' ) ) ) {
	$shift_cv_image_hover = 'dots';
}
$shift_cv_components = shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'meta_parts' ) );
$shift_cv_counters   = shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'counters' ) );
shift_cv_show_post_featured(
	array(
		'hover'         => $shift_cv_image_hover,
		'singular'      => false,
		'no_links'      => ! empty( $shift_cv_template_args['no_links'] ),
		'thumb_size'    => shift_cv_get_thumb_size( strpos( shift_cv_get_theme_option( 'body_style' ), 'full' ) !== false || $shift_cv_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only'    => true,
		'show_no_image' => true,
		'post_info'     => '<div class="post_details">'
						. '<h2 class="post_title">'
							. ( empty( $shift_cv_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>'
								: esc_html( get_the_title() )
								)
						. '</h2>'
						. '<div class="post_description">'
							. ( ! empty( $shift_cv_components )
								? shift_cv_show_post_meta(
									apply_filters(
										'shift_cv_filter_post_meta_args', array(
											'components' => $shift_cv_components,
											'counters' => $shift_cv_counters,
											'seo'      => false,
											'echo'     => false,
										), $shift_cv_blog_style[0], $shift_cv_columns
									)
								)
								: ''
								)
							. ( empty( $shift_cv_template_args['hide_excerpt'] )
								? '<div class="post_description_content">' . get_the_excerpt() . '</div>'
								: ''
								)
							. ( empty( $shift_cv_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__( 'Learn more', 'shift-cv' ) . '</span></a>'
								: ''
								)
						. '</div>'
					. '</div>',
	)
);
?>
</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
