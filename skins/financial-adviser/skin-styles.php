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
	background-color: {$colors['extra_bd_color']}!important;
}

/*4*/
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+4):before,
.widget_contacts .contacts_info:not(.use_labels) a.contacts_site:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+4) .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+4):before,
.widget ul > li:nth-child(5n+4):before {
	background-color: {$colors['text_hover']};
}

.page  .comments_form_wrap .comments_form_title,
.page  .comments_form_wrap .content-bookmark,
.single .comments_form_wrap .comments_form_title,
.single .comments_form_wrap .content-bookmark {
	color: #ffffff;
	background-color: {$colors['text_link']}!important;
}
.accent-line-top .style-1 {
	background-color: {$colors['text_link']};
}
.accent-line-top .style-2 {
	background-color: {$colors['text_link']};
}
.accent-line-top .style-3 {
	background-color: {$colors['text_link']};
}
.accent-line-top .style-4 {
	background-color: {$colors['text_link']};
}
.accent-line-top .style-5 {
	background-color: {$colors['text_link']};
}

.single-format-link .post_subtitle .post_meta_item:first-child, 
.format-link .post_subtitle .post_meta_item:first-child a, 
.single-format-link .content-bookmark, 
.format-link .content-bookmark {
	background-color: {$colors['text_link']};
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

.sc_printbuttons.sc_printbuttons_out_content .sc_printbuttons_title,
.sc_printbuttons.sc_printbuttons_out_content .sc_printbuttons_icon {
	background-color: {$colors['text_hover']};
}

CSS;
		}

		return $css;
	}
}

