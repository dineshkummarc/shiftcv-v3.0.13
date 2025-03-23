<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

if ( function_exists( 'shift_cv_elm_is_preview' ) && shift_cv_elm_is_preview() ) {

	// Redirect to the page
	get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'page' ) );

} else {

	// Store post with blog archive template
	if ( have_posts() ) {
		the_post();
		if ( isset( $GLOBALS['post'] ) && is_object( $GLOBALS['post'] ) ) {
			shift_cv_storage_set( 'blog_archive_template_post', $GLOBALS['post'] );
		}
	}

	// Prepare args for a new query
	$shift_cv_args        = array(
		'post_status' => current_user_can( 'read_private_pages' ) && current_user_can( 'read_private_posts' ) ? array( 'publish', 'private' ) : 'publish',
	);
	$shift_cv_args        = shift_cv_query_add_posts_and_cats( $shift_cv_args, '', shift_cv_get_theme_option( 'post_type' ), shift_cv_get_theme_option( 'parent_cat' ) );
	$shift_cv_page_number = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
	if ( $shift_cv_page_number > 1 ) {
		$shift_cv_args['paged']               = $shift_cv_page_number;
		$shift_cv_args['ignore_sticky_posts'] = true;
	}
	$shift_cv_ppp = shift_cv_get_theme_option( 'posts_per_page' );
	if ( 0 != (int) $shift_cv_ppp ) {
		$shift_cv_args['posts_per_page'] = (int) $shift_cv_ppp;
	}
	// Make a new main query
	$GLOBALS['wp_the_query']->query( $shift_cv_args );

	get_template_part( apply_filters( 'shift_cv_filter_get_template_part', shift_cv_blog_archive_get_template() ) );
}
