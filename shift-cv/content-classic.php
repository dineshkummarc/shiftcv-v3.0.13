<?php
/**
 * The Classic template to display the content
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
$shift_cv_expanded   = ! shift_cv_sidebar_present() && shift_cv_is_on( shift_cv_get_theme_option( 'expand_content' ) );
$shift_cv_animation  = shift_cv_get_theme_option( 'blog_animation' );
$shift_cv_components = shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'meta_parts' ) );
$shift_cv_counters   = shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'counters' ) );

$shift_cv_post_format = get_post_format();
$shift_cv_post_format = empty( $shift_cv_post_format ) ? 'standard' : str_replace( 'post-format-', '', $shift_cv_post_format );
// Post meta
$shift_cv_components = explode( ',', shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'meta_parts' ) ) );
$shift_cv_counters   = shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'counters' ) );

?><div class="
<?php
if ( ! empty( $shift_cv_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( 'classic' == $shift_cv_blog_style[0] ? 'column' : 'masonry_item masonry_item' ) . '-1_' . esc_attr( $shift_cv_columns );
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
		post_class(
			'post_item post_format_' . esc_attr( $shift_cv_post_format )
					. ' post_layout_classic post_layout_classic_' . esc_attr( $shift_cv_columns )
					. ' post_layout_' . esc_attr( $shift_cv_blog_style[0] )
					. ' post_layout_' . esc_attr( $shift_cv_blog_style[0] ) . '_' . esc_attr( $shift_cv_columns )
		);
		echo ( ! shift_cv_is_off( $shift_cv_animation ) && empty( $shift_cv_template_args['slider'] ) ? ' data-animation="' . esc_attr( shift_cv_get_animation_classes( $shift_cv_animation ) ) . '"' : '' );
		?>
	>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$shift_cv_hover = ! empty( $shift_cv_template_args['hover'] ) && ! shift_cv_is_inherit( $shift_cv_template_args['hover'] )
						? $shift_cv_template_args['hover']
						: shift_cv_get_theme_option( 'image_hover' );
	shift_cv_show_post_featured(
		array(
			'thumb_size' => shift_cv_get_thumb_size(
				'classic' == $shift_cv_blog_style[0]
						? ( strpos( shift_cv_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $shift_cv_columns > 2 ? 'big' : 'huge' )
								: ( $shift_cv_columns > 2
									? ( $shift_cv_expanded ? 'med' : 'small' )
									: ( $shift_cv_expanded ? 'big' : 'med' )
									)
							)
						: ( strpos( shift_cv_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $shift_cv_columns > 2 ? 'masonry-big' : 'full' )
								: ( $shift_cv_columns <= 2 && $shift_cv_expanded ? 'masonry-big' : 'masonry' )
							)
			),
			'hover'      => $shift_cv_hover,
			'no_links'   => ! empty( $shift_cv_template_args['no_links'] ),
			'singular'   => false,
		)
	);

	if ( ! in_array( $shift_cv_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			do_action( 'shift_cv_action_before_post_title' );

			// Post title
			if ( empty( $shift_cv_template_args['no_links'] ) ) {
				the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			} else {
				the_title( '<h4 class="post_title entry-title">', '</h4>' );
			}

			do_action( 'shift_cv_action_before_post_meta' );

			// Post meta
			if ( ! empty( $shift_cv_components ) && ! in_array( $shift_cv_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
				shift_cv_show_post_meta(
					apply_filters(
						'shift_cv_filter_post_meta_args', array(
							'components' => $shift_cv_components,
							'counters'   => $shift_cv_counters,
							'seo'        => false,
						), $shift_cv_blog_style[0], $shift_cv_columns
					)
				);
			}

			do_action( 'shift_cv_action_after_post_meta' );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>

	<div class="post_content entry-content">
	<?php
	if ( empty( $shift_cv_template_args['hide_excerpt'] ) ) {
		?>
			<div class="post_content_inner">
			<?php
			if ( has_excerpt() ) {
				the_excerpt();
			} elseif ( strpos( get_the_content( '!--more' ), '!--more' ) !== false ) {
				the_content( '' );
			} elseif ( in_array( $shift_cv_post_format, array( 'link', 'aside', 'status' ) ) ) {
				the_content();
			} elseif ( 'quote' == $shift_cv_post_format ) {
				$quote = shift_cv_get_tag( get_the_content(), '<blockquote>', '</blockquote>' );
				if ( ! empty( $quote ) ) {
					shift_cv_show_layout( wpautop( $quote ) );
				} else {
					the_excerpt();
				}
			} elseif ( substr( get_the_content(), 0, 4 ) != '[vc_' ) {
				the_excerpt();
			}
			?>
			</div>
			<?php
	}
		// Post meta
	if ( in_array( $shift_cv_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		if ( ! empty( $shift_cv_components ) ) {
			shift_cv_show_post_meta(
				apply_filters(
					'shift_cv_filter_post_meta_args', array(
						'components' => $shift_cv_components,
						'counters'   => $shift_cv_counters,
					), $shift_cv_blog_style[0], $shift_cv_columns
				)
			);
		}
	}
		// More button
	if ( false && empty( $shift_cv_template_args['no_links'] ) && ! in_array( $shift_cv_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
			<p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'shift-cv' ); ?></a></p>
			<?php
	}
	?>
	</div><!-- .entry-content -->

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
