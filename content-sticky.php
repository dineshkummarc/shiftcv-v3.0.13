<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

$shift_cv_columns     = max( 1, min( 3, count( get_option( 'sticky_posts' ) ) ) );
$shift_cv_post_format = get_post_format();
$shift_cv_post_format = empty( $shift_cv_post_format ) ? 'standard' : str_replace( 'post-format-', '', $shift_cv_post_format );
$shift_cv_animation   = shift_cv_get_theme_option( 'blog_animation' );

?><div class="column-1_<?php echo esc_attr( $shift_cv_columns ); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_' . esc_attr( $shift_cv_post_format ) ); ?>
	<?php echo ( ! shift_cv_is_off( $shift_cv_animation ) ? ' data-animation="' . esc_attr( shift_cv_get_animation_classes( $shift_cv_animation ) ) . '"' : '' ); ?>
	>

	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	shift_cv_show_post_featured(
		array(
			'thumb_size' => shift_cv_get_thumb_size( 1 == $shift_cv_columns ? 'big' : ( 2 == $shift_cv_columns ? 'med' : 'avatar' ) ),
		)
	);

	if ( ! in_array( $shift_cv_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			shift_cv_show_post_meta( apply_filters( 'shift_cv_filter_post_meta_args', array(), 'sticky', $shift_cv_columns ) );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div><?php

// div.column-1_X is a inline-block and new lines and spaces after it are forbidden
