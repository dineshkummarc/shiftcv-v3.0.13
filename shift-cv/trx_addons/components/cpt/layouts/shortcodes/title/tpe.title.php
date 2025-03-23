<?php
/**
 * Template to represent shortcode as a widget in the Elementor preview area
 *
 * Written as a Backbone JavaScript template and using to generate the live preview in the Elementor's Editor
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.41
 */

extract(get_query_var('trx_addons_args_sc_layouts_title'));
?><#
var id = settings._element_id ? settings._element_id + '_sc' : 'sc_layouts_title_' + (''+Math.random()).replace('.', '');

var need_content = settings.meta > 0 || settings.title > 0 || settings.breadcrumbs > 0;
var need_image = settings.image.url != '';

if ( need_content || need_image )  {
	#><div id="{{ id }}" class="sc_layouts_title<?php $element->sc_add_common_classes('sc_layouts_title'); ?><#
								print((need_content ? ' with' : ' without') + '_content');
								print((need_image ? ' fixed_height with' : ' without') + '_image');
								print((need_image ? ' with' : ' without') + '_tint');
								if (settings.height.size > 0 && !need_image) print(' fixed_height');
								#>"><#
		if ( need_content )  {
			#><div class="sc_layouts_title_content"><#
				// Post meta on the single post
				if (settings.meta > 0)  {
					#><div class="sc_layouts_title_meta"><?php
						trx_addons_sc_show_post_meta('sc_layouts', apply_filters('trx_addons_filter_show_post_meta', array(
										'components' => 'categories,date,counters',
										'counters' => 'views,comments,likes',
										'seo' => true
										), 'sc_layouts', 1)
									);
					?></div><#
				}

				// Blog/Post title
				if (settings.title > 0)  {
					#><div class="sc_layouts_title_title">
						<h1 class="sc_layouts_title_caption"><?php esc_html_e('Post (page) title', 'shift-cv'); ?></h1>
						<div class="sc_layouts_title_description"><?php esc_html_e('Category (tag) description (if not empty for current category)', 'shift-cv'); ?></div>
					</div><#
				}
				
				// Breadcrumbs
				if (settings.breadcrumbs > 0)  {
					#><div class="sc_layouts_title_breadcrumbs"><?php do_action( 'trx_addons_action_breadcrumbs'); ?></div><#
				}

			#></div><!-- .sc_layouts_title_content --><#
		}#><?php shift_cv_get_block_bookmark( array(
				'echo' => true,
				'position' => 'right'
				) );?></div><!-- /.sc_layouts_title --><#
}
#>