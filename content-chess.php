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
	$shift_cv_columns    = empty( $shift_cv_template_args['columns'] ) ? 1 : max( 1, min( 3, $shift_cv_template_args['columns'] ) );
	$shift_cv_blog_style = array( $shift_cv_template_args['type'], $shift_cv_columns );
} else {
	$shift_cv_blog_style = explode( '_', shift_cv_get_theme_option( 'blog_style' ) );
	$shift_cv_columns    = empty( $shift_cv_blog_style[1] ) ? 1 : max( 1, min( 3, $shift_cv_blog_style[1] ) );
}
$shift_cv_expanded    = ! shift_cv_sidebar_present() && shift_cv_is_on( shift_cv_get_theme_option( 'expand_content' ) );
$shift_cv_post_format = get_post_format();
$shift_cv_post_format = empty( $shift_cv_post_format ) ? 'standard' : str_replace( 'post-format-', '', $shift_cv_post_format );
$shift_cv_animation   = shift_cv_get_theme_option( 'blog_animation' );

?><article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item'
										. ' post_layout_chess'
										. ' post_layout_chess_' . esc_attr( $shift_cv_columns )
										. ' post_format_' . esc_attr( $shift_cv_post_format )
										. ( ! empty( $shift_cv_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
									);
									echo ( ! shift_cv_is_off( $shift_cv_animation ) && empty( $shift_cv_template_args['slider'] ) ? ' data-animation="' . esc_attr( shift_cv_get_animation_classes( $shift_cv_animation ) ) . '"' : '' );
									?>
	>

	<?php
	// Add anchor
	if ( 1 == $shift_cv_columns && ! is_array( $shift_cv_template_args ) && shortcode_exists( 'trx_sc_anchor' ) ) {
		echo do_shortcode( '[trx_sc_anchor id="post_' . esc_attr( get_the_ID() ) . '" title="' . the_title_attribute( array( 'echo' => false ) ) . '" icon="' . esc_attr( shift_cv_get_post_icon() ) . '"]' );
	}

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
			'class'         => 1 == $shift_cv_columns && ! is_array( $shift_cv_template_args ) ? 'shift_cv-full-height' : '',
			'singular'      => false,
			'hover'         => $shift_cv_hover,
			'no_links'      => ! empty( $shift_cv_template_args['no_links'] ),
			'show_no_image' => true,
			'thumb_ratio'   => '1:1',
			'thumb_bg'      => true,
			'thumb_size'    => shift_cv_get_thumb_size(
				strpos( shift_cv_get_theme_option( 'body_style' ), 'full' ) !== false
										? ( 1 < $shift_cv_columns ? 'huge' : 'original' )
										: ( 2 < $shift_cv_columns ? 'big' : 'huge' )
			),
		)
	);

	?>
	<div class="post_inner"><div class="post_inner_content"><div class="post_header entry-header">
		<?php
			do_action( 'shift_cv_action_before_post_title' );

			// Post title
		if ( empty( $shift_cv_template_args['no_links'] ) ) {
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
		} else {
			the_title( '<h3 class="post_title entry-title">', '</h3>' );
		}

			do_action( 'shift_cv_action_before_post_meta' );

			// Post meta
			$shift_cv_components = shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'meta_parts' ) );
			$shift_cv_counters   = shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'counters' ) );
			$shift_cv_post_meta  = empty( $shift_cv_components ) || in_array( $shift_cv_hover, array( 'border', 'pull', 'slide', 'fade' ) )
										? ''
										: shift_cv_show_post_meta(
											apply_filters(
												'shift_cv_filter_post_meta_args', array(
													'components' => $shift_cv_components,
													'counters' => $shift_cv_counters,
													'seo'  => false,
													'echo' => false,
												), $shift_cv_blog_style[0], $shift_cv_columns
											)
										);
			shift_cv_show_layout( $shift_cv_post_meta );
			?>
		</div><!-- .entry-header -->

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
			shift_cv_show_layout( $shift_cv_post_meta );
		}
			// More button
		if ( empty( $shift_cv_template_args['no_links'] ) && ! in_array( $shift_cv_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			?>
				<p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'shift-cv' ); ?></a></p>
				<?php
		}
		?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
