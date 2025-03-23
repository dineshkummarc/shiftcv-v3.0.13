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
<div class="shift_cv_admin_notice shift_cv_rate_notice update-nag">
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
	<h3 class="shift_cv_notice_title"><a href="<?php echo esc_url( shift_cv_storage_get( 'theme_download_url' ) ); ?>" target="_blank">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Rate our theme "%s", please', 'shift-cv' ),
				$shift_cv_theme_obj->name . ( SHIFT_CV_THEME_FREE ? ' ' . esc_html__( 'Free', 'shift-cv' ) : '' )
			)
		);
		?>
	</a></h3>
	<?php

	// Description
	?>
	<div class="shift_cv_notice_text">
		<p><?php echo wp_kses_data( __( "We are glad you chose our WP theme for your website. You've done well customizing your website and we hope that you've enjoyed working with our theme.", 'shift-cv' ) ); ?></p>
		<p><?php echo wp_kses_data( __( "It would be just awesome if you spend just a minute of your time to rate our theme or the customer service you've received from us.", 'shift-cv' ) ); ?></p>
		<p class="shift_cv_notice_text_info"><?php echo wp_kses_data( __( '* We love receiving your reviews! Every time you leave a review, our CEO Henry Rise gives $5 to homeless dog shelter! Save the planet with us!', 'shift-cv' ) ); ?></p>
	</div>
	<?php

	// Buttons
	?>
	<div class="shift_cv_notice_buttons">
		<?php
		// Link to the theme download page
		?>
		<a href="<?php echo esc_url( shift_cv_storage_get( 'theme_download_url' ) ); ?>" class="button button-primary" target="_blank"><i class="dashicons dashicons-star-filled"></i> 
			<?php
			// Translators: Add theme name
			echo esc_html( sprintf( esc_html__( 'Rate theme %s', 'shift-cv' ), $shift_cv_theme_obj->name ) );
			?>
		</a>
		<?php
		// Link to the theme support
		?>
		<a href="<?php echo esc_url( shift_cv_storage_get( 'theme_support_url' ) ); ?>" class="button" target="_blank"><i class="dashicons dashicons-sos"></i> 
			<?php
			esc_html_e( 'Support', 'shift-cv' );
			?>
		</a>
		<?php
		// Link to the theme documentation
		?>
		<a href="<?php echo esc_url( shift_cv_storage_get( 'theme_doc_url' ) ); ?>" class="button" target="_blank"><i class="dashicons dashicons-book"></i> 
			<?php
			esc_html_e( 'Documentation', 'shift-cv' );
			?>
		</a>
		<?php
		// Dismiss
		?>
		<a href="#" class="shift_cv_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="shift_cv_hide_notice_text"><?php esc_html_e( 'Dismiss', 'shift-cv' ); ?></span></a>
	</div>
</div>
