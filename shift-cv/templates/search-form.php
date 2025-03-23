<?php
$shift_cv_args = array_merge(
	array(
		'style' => 'normal',
		'class' => '',
		'ajax'  => false,
		'role'  => 'search',
	), (array) get_query_var( 'shift_cv_search_args' )
);
?><div class="search_wrap search_style_<?php echo esc_attr( $shift_cv_args['style'] ) . ( ! empty( $shift_cv_args['class'] ) ? ' ' . esc_attr( $shift_cv_args['class'] ) : '' ); ?>">
	<div class="search_form_wrap">
		<form role="<?php echo esc_attr( $shift_cv_args['role'] ); ?>" method="get" class="search_form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="text" class="search_field" placeholder="<?php esc_attr_e( 'Search', 'shift-cv' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
			<button type="submit" class="search_submit icon-search"></button>
		</form>
	</div>
</div>
