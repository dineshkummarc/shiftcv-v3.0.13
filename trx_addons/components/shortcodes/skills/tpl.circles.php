<?php
/**
 * The style "circle" of the Skills
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_skills');
$max = max(1, (float) $args['max']);


?><div id="<?php echo esc_attr($args['id']); ?>"
	   	class="sc_skills sc_skills_circles <?php
			echo !empty($args['class']) ? ' '.esc_attr($args['class']) : '';
			if ( (int)$args['columns'] > 0 ) echo ' sc_skills_row';
			?>"
		<?php echo !empty($args['css']) ? ' style="'.esc_attr($args['css']).'"' : ''; ?>
	   data-type="circles"><?php

foreach ($args['values'] as $v) {
	$value = (float) $v['value'];
	$item_color = !empty($v['color']) ? $v['color'] : (!empty($args['color']) ? $args['color'] : '#efa758');
	$bg_color = !empty($args['bg_color']) ? $args['bg_color'] : '#f7f7f7';
	if ((int)$args['columns'] > 0) {
		echo '<div class="sc_skills_column '.esc_attr(trx_addons_get_column_class(1, $args['columns'])).'">';
	}
	?>
	<div class="sc_skills_legend_title"><?php echo esc_html($v['title']); ?></div>
	<div class="sc_skills_item_wrap"
		   data-value="<?php trx_addons_show_layout($value); ?>"
		   data-max="<?php trx_addons_show_layout($max); ?>">
	<?php for ($i=1; $i<=$max; $i++) {
		?><div class="dot<?php if ($i>$value) echo ' empty'; ?>"
				data-value="<?php trx_addons_show_layout($i); ?>"<?php
				echo !empty($v['color']) ? ' style="background-color:'.esc_attr($v['color']).'"' : ''; ?>></div><?php
	}?>
	</div><?php
	if ((int)$args['columns'] > 0) {
		echo '</div>';
	}
}

trx_addons_sc_show_titles('sc_skills', $args);

if ((int)$args['columns'] > 1) {
	?><div class="sc_skills_columns sc_item_columns <?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?> columns_padding_bottom"><?php
}

if ((int)$args['columns'] > 1) {
	?></div><?php
}

trx_addons_sc_show_links('sc_skills', $args);

?></div><?php
if ( ! empty( $icon_present ) ) {
	trx_addons_load_icons( $icon_present );
}
?>