<?php
/**
 * The style "default" of the Supertitle
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.49
 */

$args = get_query_var('trx_addons_args_sc_supertitle');
$has_side = trx_addons_sc_supertitle_has_side_title($args);
$icon_type = !empty($args['image']) ? 'image' : (
	(!empty($args['icon']) && 'none' !== $args['icon']) ? 'icon' : 'no_icon'
);

?><div <?php if (!empty($args['id'])) echo ' id="'.esc_attr($args['id']).'"'; ?>
	class="sc_supertitle sc_supertitle_<?php
	echo esc_attr($args['type']);
	if (!empty($args['class'])) echo ' '.esc_attr($args['class']);
	?>"<?php
	if (!empty($args['css'])) echo ' style="'.esc_attr($args['css']).'"';
?>>
	<div class="sc_supertitle_columns_wrap sc_item_columns <?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?> columns_padding_bottom<?php
	shift_cv_show_layout($icon_type === 'no_icon' ? ' sc_supertitle_icon_empty_column' : '');
	?>"><?php
		if ($icon_type === 'no_icon' ) {
			?><span class="sc_supertitle_no_icon<?php
						if (!empty($args['icon_color'])) echo ' ' . trx_addons_add_inline_css_class('background-color: '.esc_attr($args['icon_color']));
						?>"></span><?php
		}
		// Left column
		if ((int)$args['header_column'] > 0) {
			if ($has_side) {
				?><div class="sc_supertitle_left_column <?php echo esc_attr(trx_addons_get_column_class($args['header_column'], 12)); ?>"><?php
			} else {
				?><div class="sc_supertitle_left_column <?php echo esc_attr(trx_addons_get_column_class(12, 12)); ?>"><?php
			}

			// Icon area
			?><div class="sc_supertitle_icon_wrap">
				<div class="sc_supertitle_media_block"><?php
					if ($icon_type === 'image') {
						$img_src = trx_addons_get_attachment_url($args['image']);
						$img_attr = trx_addons_getimagesize($img_src);
						?><img class="sc_icon_as_image" src="<?php echo esc_url($img_src); ?>" alt="<?php esc_attr_e('Icon', 'shift-cv'); ?>"<?php echo (!empty($img_attr[3]) ? ' '.trim($img_attr[3]) : ''); ?>><?php
					} else if ($icon_type === 'icon') {
						?><span class="sc_icon_type_icons<?php
						echo ' ' . esc_attr($args['icon']);
						$style = (!empty($args['icon_color']) ? 'color:' . esc_attr($args['icon_color']) .';' : '')
							. (!empty($args['icon_bg_color'])
								? 'background-color:' . esc_attr($args['icon_bg_color']).';'
								. 'border-radius:50%;'
								. 'padding: 20%;'
								: '')
							. (!empty($args['icon_size']) ? 'font-size:'.esc_attr($args['icon_size']) .';' : '');
						if (!empty($style)) echo ' ' . trx_addons_add_inline_css_class($style);
						?>"></span><?php
					}
					?></div>
			</div><?php
			// End Icon area

			foreach ($args['items'] as $item) {
				if (empty($item['align']) || $item['align'] == 'left') {
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . "supertitle/tpl.{$item['item_type']}.php",
						'trx_addons_args_sc_supertitle_args',
						$item);
				}
			}
			?></div><?php
		}
		// End Left column

		// Right column
		if ($has_side && (int)$args['header_column'] < 12) {
			?><div class="sc_supertitle_right_column <?php echo esc_attr(trx_addons_get_column_class(12 - $args['header_column'], 12)); ?>"><?php
			foreach ($args['items'] as $item) {
				if (!empty($item['align']) && $item['align'] == 'right') {
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . "supertitle/tpl.{$item['item_type']}.php",
						'trx_addons_args_sc_supertitle_args',
						$item);
				}
			}
			?></div><?php
		}
		// End Right column

	?></div><!-- /.sc_supertitle_columns_wrap --><?php
?></div><!-- /.sc_supertitle -->
