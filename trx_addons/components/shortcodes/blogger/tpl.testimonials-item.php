<?php
/**
 * The style "default" of the Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_blogger');

if ($args['slider']) {
	?><div class="slider-slide swiper-slide"><?php
} else if ((int)$args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}

$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$post_link = empty($args['no_links']) ? get_permalink() : '';
$post_title = get_the_title();

?><div <?php post_class( 'sc_blogger_item post_format_'.esc_attr($post_format) . (empty($post_link) ? ' no_links' : '') ); ?>><?php

	// Title section
	?><div class="sc_supertitle sc_supertitle_default">
		<div class="sc_supertitle_columns_wrap sc_item_columns <?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?> columns_padding_bottom sc_supertitle_icon_empty_column"><?php

			// Icon area
			?><span class="sc_supertitle_no_icon"></span><?php
			// End Icon area

		// Left column
		?><div class="sc_supertitle_left_column <?php echo esc_attr(trx_addons_get_column_class(12, 12)); ?>"><?php


			// Post title
			if ( !in_array($post_format, array('link', 'aside', 'status', 'quote')) ) {
				?><div class="sc_blogger_item_header entry-header"><?php
				// Post title
					the_title( '<h6 class="sc_blogger_item_title entry-title">'
						. (!empty($post_link)
							? sprintf( '<a href="%s" rel="bookmark">', esc_url( $post_link ) )
							: ''),
						(!empty($post_link) ? '</a>' : '') . '</h6>' );
					// Post meta
					$post_meta = trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_show_post_meta', array(
							'components' => 'date',
							'echo' => false
						), 'sc_blogger_default', $args['columns'])
					);
					if (empty($post_link)) $post_meta = trx_addons_links_to_span($post_meta);
					trx_addons_show_layout($post_meta);
				?></div><!-- .entry-header --><?php
			}
			?>
			</div>
		</div><!-- /.sc_supertitle_columns_wrap -->
	</div><!-- /.sc_supertitle --><?php

	// Post content
	?><div class="sc_blogger_item_content entry-content"><?php

		// Featured image
		if ( has_post_thumbnail() ) {
			?>
			<div class="sc_testimonials_item_author_avatar"><?php the_post_thumbnail( apply_filters('trx_addons_filter_thumb_size', trx_addons_get_thumb_size('tiny'), 'testimonials-default'), array('alt' => get_the_title()) ); ?></div>
		<?php } else if( $title_initials = trx_addons_get_initials($post_title) ) { ?>
			<div class="sc_testimonials_item_author_avatar sc_testimonials_avatar_with_initials"><span class="sc_testimonials_item_author_initials"><?php echo esc_html($title_initials)?></span></div>
			<?php
}

		// Post content
		if (!isset($args['hide_excerpt']) || (int)$args['hide_excerpt']==0) {
			?><div class="sc_blogger_item_excerpt">
				<div class="sc_blogger_item_excerpt_text">
					<?php
					$show_more = !in_array($post_format, array('link', 'aside', 'status', 'quote'));
					if (has_excerpt()) {
						the_excerpt();
					} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
						the_content( '' );
					} else if (!$show_more) {
						the_content();
					} else {
						the_excerpt();
					}
					?>
				</div>
			</div><!-- .sc_blogger_item_excerpt --><?php
		}
		
	?></div><!-- .entry-content --><?php
	
?></div><!-- .sc_blogger_item --><?php

if ($args['slider'] || (int)$args['columns'] > 1) {
	?></div><?php
}
?>