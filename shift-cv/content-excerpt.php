<?php
/**
 * The default template to display the content
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
	if ( ! empty( $shift_cv_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $shift_cv_columns > 1 ) {
		?>
		<div class="column-1_<?php echo esc_attr( $shift_cv_columns ); ?>">
		<?php
	}
}
$shift_cv_expanded    = ! shift_cv_sidebar_present() && shift_cv_is_on( shift_cv_get_theme_option( 'expand_content' ) );
$shift_cv_post_format = get_post_format();
$shift_cv_post_format = empty( $shift_cv_post_format ) ? 'standard' : str_replace( 'post-format-', '', $shift_cv_post_format );
$shift_cv_animation   = shift_cv_get_theme_option( 'blog_animation' );
$post_link  = get_permalink();
$post_author_id   = get_the_author_meta('ID');
$post_author_name = get_the_author_meta('display_name');
$post_author_url  = get_author_posts_url($post_author_id, '');
// Post meta
$shift_cv_components = explode( ',', shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'meta_parts' ) ) );
$shift_cv_counters   = shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'counters' ) );

?>
<article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_' . esc_attr( $shift_cv_post_format ) ); ?>
	<?php echo ( ! shift_cv_is_off( $shift_cv_animation ) && empty( $shift_cv_template_args['slider'] ) ? ' data-animation="' . esc_attr( shift_cv_get_animation_classes( $shift_cv_animation ) ) . '"' : '' ); ?>
	><div class="content-bookmark position-left"></div>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}
	$meta_top = '';
	foreach ( $shift_cv_components as $key => $shift_cv_component ) {
		if ( in_array( $shift_cv_component, array( 'date', 'author', 'counters' ) ) ) {
			$meta_top .= $shift_cv_component . ',';
			unset($shift_cv_components[$key]);
		}
	}
	if ( empty( $meta_top ) ) {
		$meta_top = 'date';
	}
	// Article top info (date, author, comments)
	?><div class="post_subtitle"><?php
			shift_cv_show_post_meta(
				apply_filters(
					'shift_cv_filter_post_meta_args', array(
						'components' => $meta_top,
						'counters'   => $shift_cv_counters,
					)
				)
			);
	?></div><div class="post_inner"><?php

		// Title and post meta
		if ( get_the_title() != '' ) {
			?>
			<div class="post_header entry-header">
				<?php
				do_action( 'shift_cv_action_before_post_title' );

				// Post title
				if ( empty( $shift_cv_template_args['no_links'] ) ) {
					the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				} else {
					the_title( '<h2 class="post_title entry-title">', '</h2>' );
				}
				?>
			</div><!-- .post_header -->
			<?php
		}


		// Featured image
		$shift_cv_hover = ! empty( $shift_cv_template_args['hover'] ) && ! shift_cv_is_inherit( $shift_cv_template_args['hover'] )
							? $shift_cv_template_args['hover']
							: shift_cv_get_theme_option( 'image_hover' );
		shift_cv_show_post_featured(
			array(
				'thumb_ratio'   => '610:407',
				'singular'   => false,
				'no_links'   => ! empty( $shift_cv_template_args['no_links'] ),
				'hover'      => $shift_cv_hover,
				'thumb_size' => shift_cv_get_thumb_size( strpos( shift_cv_get_theme_option( 'body_style' ), 'full' ) !== false ? 'full' : ( $shift_cv_expanded ? 'huge' : 'big' ) ),
			)
		);

		// Post content
		if ( empty( $shift_cv_template_args['hide_excerpt'] ) ) {
			?><div class="post_content entry-content"><?php
			if ( shift_cv_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
					<div class="post_content_inner">
					<?php
					the_content( '' );
					?>
					</div>
					<?php
					// Inner pages
					wp_link_pages(
						array(
							'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'shift-cv' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'shift-cv' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						)
					);
			} else {
				// Post content area
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
					} elseif ( substr( get_the_content(), 0, 4 ) != '[vc_' && ! in_array( $shift_cv_post_format, array( 'audio', 'chat', 'link', 'status' ) ) ) {
						the_excerpt();
					}
					?>
					</div>
					<?php
					// More button
					if ( empty( $shift_cv_template_args['no_links'] ) && ! in_array( $shift_cv_post_format, array( 'link', 'audio', 'aside', 'status', 'quote' ) ) ) {
						?>
						<p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'shift-cv' ); ?></a></p>
						<?php
					}
			}
			?></div><!-- .entry-content --><?php
		}
		do_action( 'shift_cv_action_before_post_meta' );

		if ( ! in_array( $shift_cv_post_format, array( 'audio', 'chat', 'link', 'aside', 'status' ) ) ) {
			if ( ! empty( $shift_cv_components ) && ! in_array( $shift_cv_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
			shift_cv_show_post_meta(
				apply_filters(
					'shift_cv_filter_post_meta_args', array(
						'components' => implode( ',', $shift_cv_components ),
						'counters'   => '',
						'seo'        => false,
					), 'excerpt', 1
				)
			);
		}
	}


	?>
	</div>
</article>
<?php

if ( is_array( $shift_cv_template_args ) ) {
	if ( ! empty( $shift_cv_template_args['slider'] ) || $shift_cv_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
