<?php
/**
 * The template for homepage posts with "Chess" style
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

shift_cv_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	shift_cv_blog_archive_start();

	$shift_cv_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$shift_cv_sticky_out = shift_cv_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $shift_cv_stickies ) && count( $shift_cv_stickies ) > 0 && get_query_var( 'paged' ) < 1;
	if ( $shift_cv_sticky_out ) {
		?>
		<div class="sticky_wrap columns_wrap">
		<?php
	}
	if ( ! $shift_cv_sticky_out ) {
		?>
		<div class="chess_wrap posts_container">
		<?php
	}
	while ( have_posts() ) {
		the_post();
		if ( $shift_cv_sticky_out && ! is_sticky() ) {
			$shift_cv_sticky_out = false;
			?>
			</div><div class="chess_wrap posts_container">
			<?php
		}
		$shift_cv_part = $shift_cv_sticky_out && is_sticky() ? 'sticky' : 'chess';
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'content', $shift_cv_part ), $shift_cv_part );
	}

	?>
	</div>
	<?php

	shift_cv_show_pagination();

	shift_cv_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
