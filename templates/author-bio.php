<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */
?>

<div class="author_info author vcard" itemprop="author" itemscope itemtype="//schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php
		$shift_cv_mult = shift_cv_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 120 * $shift_cv_mult );
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
		<h2 class="author_title" itemprop="name">
		<?php
			// Translators: Add the author's name in the <span>
			echo wp_kses_data('<span class="fn">' . get_the_author() . '</span>' );
		?>
		</h2>

		<div class="author_bio" itemprop="description">
			<?php
			echo wp_kses( wpautop( get_the_author_meta( 'description' ) ), 'shift_cv_kses_content' );
			do_action( 'shift_cv_action_user_meta' ); ?>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
