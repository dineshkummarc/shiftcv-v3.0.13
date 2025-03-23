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

.post_featured.hover_dots .icons span {
	background-color: {$colors['text_hover']}!important;
}

.accent-line-top .style-1 {
	background-color: {$colors['text_hover']};
}
.accent-line-top .style-2 {
	background-color: {$colors['text_link2']};
}
.accent-line-top .style-3 {
	background-color: {$colors['text_hover']};
}
.accent-line-top .style-4 {
	background-color: {$colors['text_link2']};
}
.accent-line-top .style-5 {
	background-color: {$colors['text_hover']};
}

.sc_printbuttons.sc_printbuttons_out_content .sc_printbuttons_title,
.sc_printbuttons.sc_printbuttons_out_content .sc_printbuttons_icon {
	background-color: {$colors['text_link2']};
}

.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item .sc_supertitle_no_icon,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+4) .sc_supertitle_no_icon,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+3) .sc_supertitle_no_icon,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+2) .sc_supertitle_no_icon,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+1) .sc_supertitle_no_icon {
	background-color: {$colors['text_link2']};
}
/*1*/ 
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+1):before,
.post_inner .post_meta_item.post_categories a:nth-child(5n+1):before,
.widget_contacts .contacts_info:not(.use_labels) span.contacts_address:before,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+1):before,
.widget ul > li:nth-child(5n+1):before {
	background-color: {$colors['text_hover']};
}
/*2*/
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+2):before,
.widget_contacts .contacts_info:not(.use_labels) a.contacts_phone:before,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+2):before,
.widget ul > li:nth-child(5n+2):before {
	background-color: {$colors['text_hover']};
}
/*3*/
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+3):before,
.widget_contacts .contacts_info:not(.use_labels) span.contacts_email:before,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+3):before,
.widget ul > li:nth-child(5n+3):before {
	background-color: {$colors['text_hover']};
}
/*4*/
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+4):before,
.widget_contacts .contacts_info:not(.use_labels) a.contacts_site:before,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+4):before,
.widget ul > li:nth-child(5n+4):before {
	background-color: {$colors['text_hover']};
}
/*5*/
.post_inner .post_meta_item.post_categories ul > li:before,
.widget_contacts .contacts_info:not(.use_labels) span.contacts_bdate:before,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:before,
.widget ul > li:before {
	background-color: {$colors['text_hover']};
}

div.esg-filter-wrapper .esg-filterbutton > span:hover,
.mptt-navigation-tabs li a:hover,
.shift_cv_tabs .shift_cv_tabs_titles li a:hover {
	color: {$colors['text_link']};
}
div.esg-filter-wrapper .esg-filterbutton.selected > span,
.mptt-navigation-tabs li.active a,
.shift_cv_tabs .shift_cv_tabs_titles li.ui-state-active a {
	color: {$colors['text_hover']};
}

div.wpcf7-validation-errors,
div.wpcf7-acceptance-missing {
	border-color: {$colors['text_hover']};
}
span.wpcf7-not-valid-tip {
	color: {$colors['text_hover']};
}
form .error_field,
.trx_addons_message_box_error,
.trx_addons_field_error,
.wpcf7-not-valid {
	border-color: {$colors['text_hover']} !important;
}

/* Content bookmark element */
.single .post_subtitle .post_meta_item:first-child,
.post_subtitle .post_meta_item:first-child a,
.content-bookmark {
	background-color: {$colors['text_link2']};
}

.content .post_subtitle .post_meta_item:first-child a,
.page .content .content-bookmark {
	background-color: {$colors['text_link2']};
}
.page .comments_list_wrap .comments_list_title,
.page .comments_list_wrap .content-bookmark,
.single .comments_list_wrap .comments_list_title,
.single .comments_list_wrap .content-bookmark {
	background-color: {$colors['text_link2']};
}
.page .related_wrap .related_wrap_title,
.page .related_wrap .content-bookmark,
.single .related_wrap .related_wrap_title,
.single .related_wrap .content-bookmark {
	background-color: {$colors['text_link2']};
}

.single-format-standard .post_subtitle .post_meta_item:first-child,
.format-standard .post_subtitle .post_meta_item:first-child a,
.single-format-standard .content-bookmark,
.format-standard .content-bookmark,
.post_format_standardpost_format_standard .content-bookmark {
	background-color: {$colors['text_link2']};
}
.single-format-audio .post_subtitle .post_meta_item:first-child,
.format-audio .post_subtitle .post_meta_item:first-child a,
.single-format-audio .content-bookmark,
.format-audio .content-bookmark {
	background-color: {$colors['text_link2']};
}
.single-format-video .post_subtitle .post_meta_item:first-child,
.format-video .post_subtitle .post_meta_item:first-child a,
.single-format-video .content-bookmark,
.format-video .content-bookmark {
	background-color: {$colors['text_link2']};
}
.single-format-link .post_subtitle .post_meta_item:first-child,
.format-link .post_subtitle .post_meta_item:first-child a,
.single-format-link .content-bookmark,
.format-link .content-bookmark {
	background-color: {$colors['text_link2']};
}
.single-format-image .post_subtitle .post_meta_item:first-child,
.format-image .post_subtitle .post_meta_item:first-child a,
.single-format-image .content-bookmark,
.format-image .content-bookmark {
	background-color: {$colors['text_link2']};
}
.single-format-gallery .post_subtitle .post_meta_item:first-child,
.format-gallery .post_subtitle .post_meta_item:first-child a,
.single-format-gallery .content-bookmark,
.format-gallery .content-bookmark {
	background-color: {$colors['text_link2']};
}


/* Standart colors are not enough */
body .single-format-quote .post_subtitle .post_meta_item:first-child,
body .format-quote .post_subtitle .post_meta_item:first-child a,
body .single-format-quote .content-bookmark,
body .format-quote .content-bookmark {
	background-color: {$colors['text_link2']};
}
body .single-format-aside .post_subtitle .post_meta_item:first-child,
body .format-aside .post_subtitle .post_meta_item:first-child a,
body .single-format-aside .content-bookmark,
body .format-aside .content-bookmark {
	background-color: {$colors['text_link2']};
}
body .single-format-status .post_subtitle .post_meta_item:first-child,
body .format-status .post_subtitle .post_meta_item:first-child a,
body .single-format-status .content-bookmark,
body .format-status .content-bookmark {
	background-color: {$colors['text_link2']};
}
body .single-format-chat .post_subtitle .post_meta_item:first-child,
body .format-chat .post_subtitle .post_meta_item:first-child a,
body .single-format-chat .content-bookmark,
body .format-chat .content-bookmark {
	background-color: {$colors['text_link2']};
}

.page  .comments_form_wrap .comments_form_title,
.page  .comments_form_wrap .content-bookmark,
.single .comments_form_wrap .comments_form_title,
.single .comments_form_wrap .content-bookmark {
	background-color: {$colors['text_hover']}!important;
}

.trx_addons_scroll_to_top:hover,
.trx_addons_cv .trx_addons_scroll_to_top:hover {
	border-color: {$colors['text_link2']};
	background-color: {$colors['text_link2']};
}

CSS;
		}

		return $css;
	}
}

