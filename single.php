<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

get_header();

while ( have_posts() ) {
	the_post();

	shift_cv_get_block_bookmark( array(
			'is_link' => false
	) );

	get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'content', get_post_format() ), get_post_format() );

	// Previous/next post navigation.
	?>
	<div class="nav-links-single">
		<?php
		the_post_navigation(
			array(
				'next_text' => '<span class="nav-arrow"></span>'
					. '<span class="nav-text">' . esc_html__( 'Next post', 'shift-cv' ) . '</span> '
					. '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'shift-cv' ) . '</span> '
					. '<h6 class="post-title">%title</h6>'
					. '<span class="post_date">%date</span>',
				'prev_text' => '<span class="nav-arrow"></span>'
					. '<span class="nav-text">' . esc_html__( 'Previous post', 'shift-cv' ) . '</span> '
					. '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'shift-cv' ) . '</span> '
					. '<h6 class="post-title">%title</h6>'
					. '<span class="post_date">%date</span>',
			)
		);
		?>
	</div>
	<?php

	// Related posts
	if ( shift_cv_get_theme_option( 'related_position' ) == 'below_content' ) {
		do_action( 'shift_cv_action_related_posts' );
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
