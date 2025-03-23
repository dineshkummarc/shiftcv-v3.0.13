<?php
// Add skin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'shift_cv_skin_get_css' ) ) {
	add_filter( 'shift_cv_filter_get_css', 'shift_cv_skin_get_css', 10, 2 );
	function shift_cv_skin_get_css( $css, $args ) {

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS

CSS;
		}

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			$vars         = $args['vars'];
			$css['vars'] .= <<<CSS

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS

.sc_printbuttons.sc_printbuttons_out_content .sc_printbuttons_title,
.sc_printbuttons.sc_printbuttons_out_content .sc_printbuttons_icon {
	background-color: {$colors['text_hover']};
}
.post_featured .mask {
	background-color: {$colors['extra_link2']};
}
.post_featured.hover_dots .icons span {
	background-color: {$colors['text_hover']}!important;
}

/*1*/ 
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+1):before,
.post_inner .post_meta_item.post_categories a:nth-child(5n+1):before,
.widget_contacts .contacts_info:not(.use_labels) span.contacts_address:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+1) .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+1):before,
.widget ul > li:nth-child(5n+1):before {
	background-color: {$colors['text_link']};
}
/*2*/
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+2):before,
.widget_contacts .contacts_info:not(.use_labels) a.contacts_phone:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+2) .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+2):before,
.widget ul > li:nth-child(5n+2):before {
	background-color: {$colors['text_link2']};
}
/*3*/
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+3):before,
.widget_contacts .contacts_info:not(.use_labels) span.contacts_email:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+3) .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+3):before,
.widget ul > li:nth-child(5n+3):before {
	background-color: {$colors['alter_link2']};
}
/*4*/
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+4):before,
.widget_contacts .contacts_info:not(.use_labels) a.contacts_site:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+4) .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+4):before,
.widget ul > li:nth-child(5n+4):before {
	background-color: {$colors['text_hover']};
}
/*5*/
.post_inner .post_meta_item.post_categories ul > li:before,
.widget_contacts .contacts_info:not(.use_labels) span.contacts_bdate:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:before,
.widget ul > li:before {
	background-color: {$colors['extra_link2']};
}

div.wpcf7-validation-errors,
div.wpcf7-acceptance-missing {
	border-color: {$colors['text_hover']};
}
span.wpcf7-not-valid-tip {
	color: {$colors['text_hover']};
}
.trx_addons_message_box_success,
div.wpcf7-mail-sent-ok {
	border-color: {$colors['text_dark']};
}
form .error_field,
.trx_addons_message_box_error,
.trx_addons_field_error,
.wpcf7-not-valid {
	border-color: {$colors['text_hover']} !important;
}

.accent-line-top .style-1 {
	background-color: {$colors['text_link']};
}
.accent-line-top .style-2 {
	background-color: {$colors['text_link2']};
}
.accent-line-top .style-3 {
	background-color: {$colors['alter_link2']};
}
.accent-line-top .style-4 {
	background-color: {$colors['text_hover']};
}
.accent-line-top .style-5 {
	background-color: {$colors['extra_link2']};
}


CSS;
		}

		return $css;
	}
}

