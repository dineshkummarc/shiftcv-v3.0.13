<div class="front_page_section front_page_section_contacts<?php
	$shift_cv_scheme = shift_cv_get_theme_option( 'front_page_contacts_scheme' );
	if ( ! shift_cv_is_inherit( $shift_cv_scheme ) ) {
		echo ' scheme_' . esc_attr( $shift_cv_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( shift_cv_get_theme_option( 'front_page_contacts_paddings' ) );
?>"
		<?php
		$shift_cv_css      = '';
		$shift_cv_bg_image = shift_cv_get_theme_option( 'front_page_contacts_bg_image' );
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
	$shift_cv_anchor_icon = shift_cv_get_theme_option( 'front_page_contacts_anchor_icon' );
	$shift_cv_anchor_text = shift_cv_get_theme_option( 'front_page_contacts_anchor_text' );
if ( ( ! empty( $shift_cv_anchor_icon ) || ! empty( $shift_cv_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_contacts"'
									. ( ! empty( $shift_cv_anchor_icon ) ? ' icon="' . esc_attr( $shift_cv_anchor_icon ) . '"' : '' )
									. ( ! empty( $shift_cv_anchor_text ) ? ' title="' . esc_attr( $shift_cv_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_contacts_inner
	<?php
	if ( shift_cv_get_theme_option( 'front_page_contacts_fullheight' ) ) {
		echo ' shift_cv-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$shift_cv_css      = '';
			$shift_cv_bg_mask  = shift_cv_get_theme_option( 'front_page_contacts_bg_mask' );
			$shift_cv_bg_color_type = shift_cv_get_theme_option( 'front_page_contacts_bg_color_type' );
			if ( 'custom' == $shift_cv_bg_color_type ) {
				$shift_cv_bg_color = shift_cv_get_theme_option( 'front_page_contacts_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$shift_cv_caption     = shift_cv_get_theme_option( 'front_page_contacts_caption' );
			$shift_cv_description = shift_cv_get_theme_option( 'front_page_contacts_description' );
			if ( ! empty( $shift_cv_caption ) || ! empty( $shift_cv_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $shift_cv_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo ! empty( $shift_cv_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( $shift_cv_caption, 'shift_cv_kses_content' );
					?>
					</h2>
					<?php
				}

				// Description
				if ( ! empty( $shift_cv_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo ! empty( $shift_cv_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $shift_cv_description ), 'shift_cv_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$shift_cv_content = shift_cv_get_theme_option( 'front_page_contacts_content' );
			$shift_cv_layout  = shift_cv_get_theme_option( 'front_page_contacts_layout' );
			if ( 'columns' == $shift_cv_layout && ( ! empty( $shift_cv_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ( ( ! empty( $shift_cv_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo ! empty( $shift_cv_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $shift_cv_content, 'shift_cv_kses_content' );
				?>
				</div>
				<?php
			}

			if ( 'columns' == $shift_cv_layout && ( ! empty( $shift_cv_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div><div class="column-2_3">
				<?php
			}

			// Shortcode output
			$shift_cv_sc = shift_cv_get_theme_option( 'front_page_contacts_shortcode' );
			if ( ! empty( $shift_cv_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo ! empty( $shift_cv_sc ) ? 'filled' : 'empty'; ?>">
				<?php
					shift_cv_show_layout( do_shortcode( $shift_cv_sc ) );
				?>
				</div>
				<?php
			}

			if ( 'columns' == $shift_cv_layout && ( ! empty( $shift_cv_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>

		</div>
	</div>
</div>
