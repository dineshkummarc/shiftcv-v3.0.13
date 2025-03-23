<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

$shift_cv_link        = get_permalink();
$shift_cv_post_format = get_post_format();
$shift_cv_post_format = empty( $shift_cv_post_format ) ? 'standard' : str_replace( 'post-format-', '', $shift_cv_post_format );
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_' . esc_attr( $shift_cv_post_format ) ); ?>>
						<?php
						shift_cv_show_post_featured(
							array(
								'thumb_size'    => apply_filters( 'shift_cv_filter_related_thumb_size', shift_cv_get_thumb_size( (int) shift_cv_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
								'show_no_image' => shift_cv_get_theme_setting( 'allow_no_image' ),
								'singular'      => false,
							)
						);
						?>
	<div class="post_header entry-header">
	<?php
	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		?>
			<span class="post_date"><a href="<?php echo esc_url( $shift_cv_link ); ?>"><?php echo wp_kses_data( shift_cv_get_date() ); ?></a></span>
			<?php
	}
	?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url( $shift_cv_link ); ?>"><?php the_title(); ?></a></h6>
	</div>
</div>
