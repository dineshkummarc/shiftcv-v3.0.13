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

.contacts_wrap_icons a:hover {
	color: {$colors['text_hover']};
}
.contacts_wrap_icons a {
	color: {$colors['text_link']};
}
.post_featured.hover_dots .icons span {
	background-color: {$colors['inverse_dark']}!important;
}
.post_featured .mask {
	background-color: {$colors['text_light']};
}

.page  .comments_form_wrap .comments_form_title,
.page  .comments_form_wrap .content-bookmark,
.single .comments_form_wrap .comments_form_title,
.single .comments_form_wrap .content-bookmark {
	color: #ffffff;
	background-color: {$colors['text_link']}!important;
}
.accent-line-top .style-1 {
	background-color: {$colors['alter_link3']};
}
.accent-line-top .style-2 {
	background-color: {$colors['alter_link3']};
}
.accent-line-top .style-3 {
	background-color: {$colors['alter_link3']};
}
.accent-line-top .style-4 {
	background-color: {$colors['alter_link3']};
}
.accent-line-top .style-5 {
	background-color: {$colors['alter_link3']};
}

/*1*/ 
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+1):before,
.post_inner .post_meta_item.post_categories a:nth-child(5n+1):before,
.widget_contacts .contacts_info:not(.use_labels) span.contacts_address:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+1) .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+1):before,
.widget ul > li:nth-child(5n+1):before {
	background-color: {$colors['alter_link3']};
}
/*2*/
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+2):before,
.widget_contacts .contacts_info:not(.use_labels) a.contacts_phone:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+2) .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+2):before,
.widget ul > li:nth-child(5n+2):before {
	background-color: {$colors['alter_link3']};
}
/*3*/
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+3):before,
.widget_contacts .contacts_info:not(.use_labels) span.contacts_email:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+3) .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+3):before,
.widget ul > li:nth-child(5n+3):before {
	background-color: {$colors['alter_link3']};
}
/*4*/
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+4):before,
.widget_contacts .contacts_info:not(.use_labels) a.contacts_site:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+4) .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+4):before,
.widget ul > li:nth-child(5n+4):before {
	background-color: {$colors['alter_link3']};
}
/*5*/
.post_inner .post_meta_item.post_categories ul > li:before,
.widget_contacts .contacts_info:not(.use_labels) span.contacts_bdate:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:before,
.widget ul > li:before {
	background-color: {$colors['alter_link3']};
}

.trx_addons_message_box_success,
div.wpcf7-mail-sent-ok {
	border-color: {$colors['text_link']};
}

div.wpcf7-validation-errors,
div.wpcf7-acceptance-missing {
	border-color: {$colors['text_hover']};
}
form .error_field,
.trx_addons_message_box_error,
.trx_addons_field_error,
.wpcf7-not-valid {
	border-color: {$colors['text_hover']} !important;
}
span.wpcf7-not-valid-tip {
	color: {$colors['text_hover']};
}
.single-format-link .post_subtitle .post_meta_item:first-child, 
.format-link .post_subtitle .post_meta_item:first-child a, 
.single-format-link .content-bookmark, 
.format-link .content-bookmark {
	background-color: {$colors['text_hover']};
}


/* Standart colors are not enough */
body .single-format-quote .post_subtitle .post_meta_item:first-child,
body .format-quote .post_subtitle .post_meta_item:first-child a,
body .single-format-quote .content-bookmark,
body .format-quote .content-bookmark {
	background-color: {$colors['text_link']};
}
body .single-format-aside .post_subtitle .post_meta_item:first-child,
body .format-aside .post_subtitle .post_meta_item:first-child a,
body .single-format-aside .content-bookmark,
body .format-aside .content-bookmark {
	background-color: {$colors['text_link']};
}
body .single-format-status .post_subtitle .post_meta_item:first-child,
body .format-status .post_subtitle .post_meta_item:first-child a,
body .single-format-status .content-bookmark,
body .format-status .content-bookmark {
	background-color: {$colors['text_link']};
}
body .single-format-chat .post_subtitle .post_meta_item:first-child,
body .format-chat .post_subtitle .post_meta_item:first-child a,
body .single-format-chat .content-bookmark,
body .format-chat .content-bookmark {
	background-color: {$colors['text_link']};
}

input[type="text"]:focus,
input[type="text"].filled,
input[type="url"]:focus,
input[type="url"].filled,
input[type="number"]:focus,
input[type="number"].filled,
input[type="email"]:focus,
input[type="email"].filled,
input[type="tel"]:focus,
input[type="search"]:focus,
input[type="search"].filled,
input[type="password"]:focus,
input[type="password"].filled,
.select_container:hover,
select option:hover,
select option:focus,
.select2-container.select2-container--default span.select2-choice:hover,
.select2-container.select2-container--focus span.select2-choice,
.select2-container.select2-container--open span.select2-choice,
.select2-container.select2-container--focus span.select2-selection--single .select2-selection__rendered,
.select2-container.select2-container--open span.select2-selection--single .select2-selection__rendered,
.select2-container.select2-container--default span.select2-selection--single:hover .select2-selection__rendered,
.select2-container.select2-container--default span.select2-selection--multiple:hover,
.select2-container.select2-container--focus span.select2-selection--multiple,
.select2-container.select2-container--open span.select2-selection--multiple,
textarea:focus,
textarea.filled,
textarea.wp-editor-area:focus,
textarea.wp-editor-area.filled,
/* Tour Master */
.tourmaster-form-field input[type="text"]:focus,
.tourmaster-form-field input[type="text"].filled,
.tourmaster-form-field input[type="email"]:focus,
.tourmaster-form-field input[type="email"].filled,
.tourmaster-form-field input[type="password"]:focus,
.tourmaster-form-field input[type="password"].filled,
.tourmaster-form-field textarea:focus,
.tourmaster-form-field textarea.filled,
.tourmaster-form-field select:focus,
.tourmaster-form-field select.filled,
.tourmaster-form-field.tourmaster-with-border input[type="text"]:focus,
.tourmaster-form-field.tourmaster-with-border input[type="text"].filled,
.tourmaster-form-field.tourmaster-with-border input[type="email"]:focus,
.tourmaster-form-field.tourmaster-with-border input[type="email"].filled,
.tourmaster-form-field.tourmaster-with-border input[type="password"]:focus,
.tourmaster-form-field.tourmaster-with-border input[type="password"].filled,
.tourmaster-form-field.tourmaster-with-border textarea:focus,
.tourmaster-form-field.tourmaster-with-border textarea.filled,
.tourmaster-form-field.tourmaster-with-border select:focus,
.tourmaster-form-field.tourmaster-with-border select.filled,
/* BB Press */
#buddypress .dir-search input[type="search"]:focus,
#buddypress .dir-search input[type="search"].filled,
#buddypress .dir-search input[type="text"]:focus,
#buddypress .dir-search input[type="text"].filled,
#buddypress .groups-members-search input[type="search"]:focus,
#buddypress .groups-members-search input[type="search"].filled,
#buddypress .groups-members-search input[type="text"]:focus,
#buddypress .groups-members-search input[type="text"].filled,
#buddypress .standard-form input[type="color"]:focus,
#buddypress .standard-form input[type="color"].filled,
#buddypress .standard-form input[type="date"]:focus,
#buddypress .standard-form input[type="date"].filled,
#buddypress .standard-form input[type="datetime-local"]:focus,
#buddypress .standard-form input[type="datetime-local"].filled,
#buddypress .standard-form input[type="datetime"]:focus,
#buddypress .standard-form input[type="datetime"].filled,
#buddypress .standard-form input[type="email"]:focus,
#buddypress .standard-form input[type="email"].filled,
#buddypress .standard-form input[type="month"]:focus,
#buddypress .standard-form input[type="month"].filled,
#buddypress .standard-form input[type="number"]:focus,
#buddypress .standard-form input[type="number"].filled,
#buddypress .standard-form input[type="password"]:focus,
#buddypress .standard-form input[type="password"].filled,
#buddypress .standard-form input[type="range"]:focus,
#buddypress .standard-form input[type="range"].filled,
#buddypress .standard-form input[type="search"]:focus,
#buddypress .standard-form input[type="search"].filled,
#buddypress .standard-form input[type="tel"]:focus,
#buddypress .standard-form input[type="tel"].filled,
#buddypress .standard-form input[type="text"]:focus,
#buddypress .standard-form input[type="text"].filled,
#buddypress .standard-form input[type="time"]:focus,
#buddypress .standard-form input[type="time"].filled,
#buddypress .standard-form input[type="url"]:focus,
#buddypress .standard-form input[type="url"].filled,
#buddypress .standard-form input[type="week"]:focus,
#buddypress .standard-form input[type="week"].filled,
#buddypress .standard-form select:focus,
#buddypress .standard-form select.filled,
#buddypress .standard-form textarea:focus,
#buddypress .standard-form textarea.filled,
#buddypress form#whats-new-form textarea:focus,
#buddypress form#whats-new-form textarea.filled,
/* Booked */
#booked-page-form input[type="email"]:focus,
#booked-page-form input[type="email"].filled,
#booked-page-form input[type="text"]:focus,
#booked-page-form input[type="text"].filled,
#booked-page-form input[type="password"]:focus,
#booked-page-form input[type="password"].filled,
#booked-page-form textarea:focus,
#booked-page-form textarea.filled,
.booked-upload-wrap:hover,
.booked-upload-wrap input:focus,
.booked-upload-wrap input.filled,
/* MailChimp */
form.mc4wp-form input[type="email"]:focus,
form.mc4wp-form input[type="email"].filled {
	border-color: {$colors['text_link']};
}

/* Content bookmark element */
.single .post_subtitle .post_meta_item:first-child,
.post_subtitle .post_meta_item:first-child a,
.content-bookmark {
	background-color: {$colors['alter_link3']};
}

.content .post_subtitle .post_meta_item:first-child a,
.page .content .content-bookmark {
	background-color: {$colors['alter_link3']};
}
.page .comments_list_wrap .comments_list_title,
.page .comments_list_wrap .content-bookmark,
.single .comments_list_wrap .comments_list_title,
.single .comments_list_wrap .content-bookmark {
	background-color: {$colors['alter_link3']};
}
.page .related_wrap .related_wrap_title,
.page .related_wrap .content-bookmark,
.single .related_wrap .related_wrap_title,
.single .related_wrap .content-bookmark {
	background-color: {$colors['alter_link3']};
}

.single-format-standard .post_subtitle .post_meta_item:first-child,
.format-standard .post_subtitle .post_meta_item:first-child a,
.single-format-standard .content-bookmark,
.format-standard .content-bookmark,
.post_format_standardpost_format_standard .content-bookmark {
	background-color: {$colors['alter_link3']};
}
.single-format-audio .post_subtitle .post_meta_item:first-child,
.format-audio .post_subtitle .post_meta_item:first-child a,
.single-format-audio .content-bookmark,
.format-audio .content-bookmark {
	background-color: {$colors['alter_link3']};
}
.single-format-video .post_subtitle .post_meta_item:first-child,
.format-video .post_subtitle .post_meta_item:first-child a,
.single-format-video .content-bookmark,
.format-video .content-bookmark {
	background-color: {$colors['alter_link3']};
}
.single-format-link .post_subtitle .post_meta_item:first-child,
.format-link .post_subtitle .post_meta_item:first-child a,
.single-format-link .content-bookmark,
.format-link .content-bookmark {
	background-color: {$colors['alter_link3']};
}
.single-format-image .post_subtitle .post_meta_item:first-child,
.format-image .post_subtitle .post_meta_item:first-child a,
.single-format-image .content-bookmark,
.format-image .content-bookmark {
	background-color: {$colors['alter_link3']};
}
.single-format-gallery .post_subtitle .post_meta_item:first-child,
.format-gallery .post_subtitle .post_meta_item:first-child a,
.single-format-gallery .content-bookmark,
.format-gallery .content-bookmark {
	background-color: {$colors['alter_link3']};
}


/* Standart colors are not enough */
body .single-format-quote .post_subtitle .post_meta_item:first-child,
body .format-quote .post_subtitle .post_meta_item:first-child a,
body .single-format-quote .content-bookmark,
body .format-quote .content-bookmark {
	background-color: {$colors['alter_link3']};
}
body .single-format-aside .post_subtitle .post_meta_item:first-child,
body .format-aside .post_subtitle .post_meta_item:first-child a,
body .single-format-aside .content-bookmark,
body .format-aside .content-bookmark {
	background-color: {$colors['alter_link3']};
}
body .single-format-status .post_subtitle .post_meta_item:first-child,
body .format-status .post_subtitle .post_meta_item:first-child a,
body .single-format-status .content-bookmark,
body .format-status .content-bookmark {
	background-color: {$colors['alter_link3']};
}
body .single-format-chat .post_subtitle .post_meta_item:first-child,
body .format-chat .post_subtitle .post_meta_item:first-child a,
body .single-format-chat .content-bookmark,
body .format-chat .content-bookmark {
	background-color: {$colors['alter_link3']};
}

.trx_addons_scroll_to_top:hover,
.trx_addons_cv .trx_addons_scroll_to_top:hover {
	color: {$colors['inverse_text']};
}

CSS;
		}

		return $css;
	}
}

