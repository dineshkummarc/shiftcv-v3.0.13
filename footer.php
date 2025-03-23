<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

						// Widgets area inside page content
						shift_cv_create_widgets_area( 'widgets_below_content' );
						?>
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					$shift_cv_body_style = shift_cv_get_theme_option( 'body_style' );
					if ( 'fullscreen' != $shift_cv_body_style ) {
						shift_cv_trx_addons_add_scroll_to_top();
						?>
						</div><!-- </.content_wrap> -->
						<?php
					}

					// Widgets area below page content and related posts below page content
					$shift_cv_widgets_name = shift_cv_get_theme_option( 'widgets_below_page' );
					$shift_cv_show_widgets = ! shift_cv_is_off( $shift_cv_widgets_name ) && is_active_sidebar( $shift_cv_widgets_name );
					$shift_cv_show_related = is_single() && shift_cv_get_theme_option( 'related_position' ) == 'below_page';
					if ( $shift_cv_show_widgets || $shift_cv_show_related ) {
						if ( 'fullscreen' != $shift_cv_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $shift_cv_show_related ) {
							do_action( 'shift_cv_action_related_posts' );
						}

						// Widgets area below page content
						if ( $shift_cv_show_widgets ) {
							shift_cv_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $shift_cv_body_style ) {
							// Add Scroll to top button into body
							?>
							</div><!-- </.content_wrap> -->
							<?php
						}
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$shift_cv_footer_type = shift_cv_get_theme_option( 'footer_type' );
			if ( 'custom' == $shift_cv_footer_type && ! shift_cv_is_layouts_available() ) {
				$shift_cv_footer_type = 'default';
			}
			get_template_part( apply_filters( 'shift_cv_filter_get_template_part', "templates/footer-{$shift_cv_footer_type}" ) );
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php wp_footer(); ?>

</body>
</html>
