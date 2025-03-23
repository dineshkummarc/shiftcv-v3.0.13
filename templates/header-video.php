<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.14
 */
$shift_cv_header_video = shift_cv_get_header_video();
$shift_cv_embed_video  = '';
if ( ! empty( $shift_cv_header_video ) && ! shift_cv_is_from_uploads( $shift_cv_header_video ) ) {
	if ( shift_cv_is_youtube_url( $shift_cv_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $shift_cv_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		global $wp_embed;
		if ( false && is_object( $wp_embed ) ) {
			$shift_cv_embed_video = do_shortcode( $wp_embed->run_shortcode( '[embed]' . trim( $shift_cv_header_video ) . '[/embed]' ) );
			$shift_cv_embed_video = shift_cv_make_video_autoplay( $shift_cv_embed_video );
		} else {
			$shift_cv_header_video = str_replace( '/watch?v=', '/embed/', $shift_cv_header_video );
			$shift_cv_header_video = shift_cv_add_to_url(
				$shift_cv_header_video, array(
					'feature'        => 'oembed',
					'controls'       => 0,
					'autoplay'       => 1,
					'showinfo'       => 0,
					'modestbranding' => 1,
					'wmode'          => 'transparent',
					'enablejsapi'    => 1,
					'origin'         => home_url(),
					'widgetid'       => 1,
				)
			);
			$shift_cv_embed_video  = '<iframe src="' . esc_url( $shift_cv_header_video ) . '" width="1170" height="658"></iframe>';
		}
		?>
		<div id="background_video"><?php shift_cv_show_layout( $shift_cv_embed_video ); ?></div>
		<?php
	}
}
