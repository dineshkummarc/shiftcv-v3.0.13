<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0.1
 */

$shift_cv_theme_obj = wp_get_theme();
?>
<div class="shift_cv_admin_notice shift_cv_welcome_notice update-nag">
	<?php
	// Theme image
	$shift_cv_theme_img = shift_cv_get_file_url( 'screenshot.jpg' );
	if ( '' != $shift_cv_theme_img ) {
		?>
		<div class="shift_cv_notice_image"><img src="<?php echo esc_url( $shift_cv_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'shift-cv' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="shift_cv_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'shift-cv' ),
				$shift_cv_theme_obj->name . ( SHIFT_CV_THEME_FREE ? ' ' . esc_html__( 'Free', 'shift-cv' ) : '' ),
				$shift_cv_theme_obj->version
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="shift_cv_notice_text">
		<p class="shift_cv_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $shift_cv_theme_obj->description ) );
			?>
		</p>
		<p class="shift_cv_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'shift-cv' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="shift_cv_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=shift_cv_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'shift-cv' );
			?>
		</a>
		<?php		
		// Dismiss this notice
		?>
		<a href="#" class="shift_cv_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="shift_cv_hide_notice_text"><?php esc_html_e( 'Dismiss', 'shift-cv' ); ?></span></a>
	</div>
</div>
