<div class="front_page_section front_page_section_about<?php
	$shift_cv_scheme = shift_cv_get_theme_option( 'front_page_about_scheme' );
	if ( ! shift_cv_is_inherit( $shift_cv_scheme ) ) {
		echo ' scheme_' . esc_attr( $shift_cv_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( shift_cv_get_theme_option( 'front_page_about_paddings' ) );
?>"
		<?php
		$shift_cv_css      = '';
		$shift_cv_bg_image = shift_cv_get_theme_option( 'front_page_about_bg_image' );
		if ( ! empty( $shift_cv_bg_image ) ) {
			$shift_cv_css .= 'background-image: url(' . esc_url( shift_cv_get_attachment_url( $shift_cv_bg_image ) ) . ');';
		}
		if ( ! empty( $shift_cv_css ) ) {
			echo ' style="' . esc_attr( $shift_cv_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$shift_cv_anchor_icon = shift_cv_get_theme_option( 'front_page_about_anchor_icon' );
	$shift_cv_anchor_text = shift_cv_get_theme_option( 'front_page_about_anchor_text' );
if ( ( ! empty( $shift_cv_anchor_icon ) || ! empty( $shift_cv_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_about"'
									. ( ! empty( $shift_cv_anchor_icon ) ? ' icon="' . esc_attr( $shift_cv_anchor_icon ) . '"' : '' )
									. ( ! empty( $shift_cv_anchor_text ) ? ' title="' . esc_attr( $shift_cv_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_about_inner
	<?php
	if ( shift_cv_get_theme_option( 'front_page_about_fullheight' ) ) {
		echo ' shift_cv-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$shift_cv_css           = '';
			$shift_cv_bg_mask       = shift_cv_get_theme_option( 'front_page_about_bg_mask' );
			$shift_cv_bg_color_type = shift_cv_get_theme_option( 'front_page_about_bg_color_type' );
			if ( 'custom' == $shift_cv_bg_color_type ) {
				$shift_cv_bg_color = shift_cv_get_theme_option( 'front_page_about_bg_color' );
			} elseif ( 'scheme_bg_color' == $shift_cv_bg_color_type ) {
				$shift_cv_bg_color = shift_cv_get_scheme_color( 'bg_color', $shift_cv_scheme );
			} else {
				$shift_cv_bg_color = '';
			}
			if ( ! empty( $shift_cv_bg_color ) && $shift_cv_bg_mask > 0 ) {
				$shift_cv_css .= 'background-color: ' . esc_attr(
					1 == $shift_cv_bg_mask ? $shift_cv_bg_color : shift_cv_hex2rgba( $shift_cv_bg_color, $shift_cv_bg_mask )
				) . ';';
			}
			if ( ! empty( $shift_cv_css ) ) {
				echo ' style="' . esc_attr( $shift_cv_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$shift_cv_caption = shift_cv_get_theme_option( 'front_page_about_caption' );
			if ( ! empty( $shift_cv_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo ! empty( $shift_cv_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $shift_cv_caption, 'shift_cv_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$shift_cv_description = shift_cv_get_theme_option( 'front_page_about_description' );
			if ( ! empty( $shift_cv_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo ! empty( $shift_cv_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $shift_cv_description ), 'shift_cv_kses_content' ); ?></div>
				<?php
			}

			// Content
			$shift_cv_content = shift_cv_get_theme_option( 'front_page_about_content' );
			if ( ! empty( $shift_cv_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo ! empty( $shift_cv_content ) ? 'filled' : 'empty'; ?>">
				<?php
					$shift_cv_page_content_mask = '%%CONTENT%%';
				if ( strpos( $shift_cv_content, $shift_cv_page_content_mask ) !== false ) {
					$shift_cv_content = preg_replace(
						'/(\<p\>\s*)?' . $shift_cv_page_content_mask . '(\s*\<\/p\>)/i',
						sprintf(
							'<div class="front_page_section_about_source">%s</div>',
							apply_filters( 'the_content', get_the_content() )
						),
						$shift_cv_content
					);
				}
					shift_cv_show_layout( $shift_cv_content );
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
