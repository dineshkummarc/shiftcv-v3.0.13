<?php
/**
 * Generate custom CSS
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

// Return CSS with custom colors and fonts
if ( ! function_exists( 'shift_cv_customizer_get_css' ) ) {

	function shift_cv_customizer_get_css( $args = array() ) {

		$colors        = isset( $args['colors'] ) ? $args['colors'] : null;
		$scheme        = isset( $args['scheme'] ) ? $args['scheme'] : null;
		$fonts         = isset( $args['fonts'] ) ? $args['fonts'] : null;
		$vars          = isset( $args['vars'] ) ? $args['vars'] : null;
		$remove_spaces = isset( $args['remove_spaces'] ) ? $args['remove_spaces'] : true;

		$css = array(
			'vars'   => '',
			'fonts'  => '',
			'colors' => '',
		);

		// Theme fonts
		//---------------------------------------------
		if ( null === $fonts ) {
			$fonts = shift_cv_get_theme_fonts();
		}

		if ( $fonts ) {

			// Make theme-specific fonts rules
			$fonts = shift_cv_customizer_add_theme_fonts( $fonts );

			$rez          = array();
			$rez['fonts'] = <<<CSS

body {
	{$fonts['p_font-family']}
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['p_font-style']}
	{$fonts['p_line-height']}
	{$fonts['p_text-decoration']}
	{$fonts['p_text-transform']}
	{$fonts['p_letter-spacing']}
}
p, ul, ol, dl, blockquote, address,
.post_item_single .wp-block-post-author,
.post_item_single .wp-block-avatar,
.post_item_single .wp-block-button, 
.post_item_single .wp-block-cover, 
.post_item_single .wp-block-image, 
.post_item_single .wp-block-video, 
.post_item_single .wp-block-search, 
.post_item_single .wp-block-archives, 
.post_item_single .wp-block-categories, 
.post_item_single .wp-block-calendar, 
.post_item_single .wp-block-media-text,
.post_item_single figure.wp-block-gallery,
.post_item_single .wp-block-group,
.wp-block-group.has-background .wp-block-group__inner-container > *,
.post_item_single .post_content > figure {
	{$fonts['p_margin-top']}
	{$fonts['p_margin-bottom']}
}

h1, .front_page_section_caption {
	{$fonts['h1_font-family']}
	{$fonts['h1_font-size']}
	{$fonts['h1_font-weight']}
	{$fonts['h1_font-style']}
	{$fonts['h1_line-height']}
	{$fonts['h1_text-decoration']}
	{$fonts['h1_text-transform']}
	{$fonts['h1_letter-spacing']}
	{$fonts['h1_margin-top']}
	{$fonts['h1_margin-bottom']}
}
h2 {
	{$fonts['h2_font-family']}
	{$fonts['h2_font-size']}
	{$fonts['h2_font-weight']}
	{$fonts['h2_font-style']}
	{$fonts['h2_line-height']}
	{$fonts['h2_text-decoration']}
	{$fonts['h2_text-transform']}
	{$fonts['h2_letter-spacing']}
	{$fonts['h2_margin-top']}
	{$fonts['h2_margin-bottom']}
}
h3 {
	{$fonts['h3_font-family']}
	{$fonts['h3_font-size']}
	{$fonts['h3_font-weight']}
	{$fonts['h3_font-style']}
	{$fonts['h3_line-height']}
	{$fonts['h3_text-decoration']}
	{$fonts['h3_text-transform']}
	{$fonts['h3_letter-spacing']}
	{$fonts['h3_margin-top']}
	{$fonts['h3_margin-bottom']}
}
h4 {
	{$fonts['h4_font-family']}
	{$fonts['h4_font-size']}
	{$fonts['h4_font-weight']}
	{$fonts['h4_font-style']}
	{$fonts['h4_line-height']}
	{$fonts['h4_text-decoration']}
	{$fonts['h4_text-transform']}
	{$fonts['h4_letter-spacing']}
	{$fonts['h4_margin-top']}
	{$fonts['h4_margin-bottom']}
}
h5 {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-size']}
	{$fonts['h5_font-weight']}
	{$fonts['h5_font-style']}
	{$fonts['h5_line-height']}
	{$fonts['h5_text-decoration']}
	{$fonts['h5_text-transform']}
	{$fonts['h5_letter-spacing']}
	{$fonts['h5_margin-top']}
	{$fonts['h5_margin-bottom']}
}
h6 {
	{$fonts['h6_font-family']}
	{$fonts['h6_font-size']}
	{$fonts['h6_font-weight']}
	{$fonts['h6_font-style']}
	{$fonts['h6_line-height']}
	{$fonts['h6_text-decoration']}
	{$fonts['h6_text-transform']}
	{$fonts['h6_letter-spacing']}
	{$fonts['h6_margin-top']}
	{$fonts['h6_margin-bottom']}
}

input[type="text"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="tel"],
input[type="search"],
input[type="password"],
textarea,
textarea.wp-editor-area,
.select_container,
select,
.select_container select {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}

button,
.wp-block-button .wp-block-button__link,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.sc_layouts_row .sc_button,
.gallery_preview_show .post_readmore,
.post_item .more-link,
div.esg-filter-wrapper .esg-filterbutton > span,
.mptt-navigation-tabs li a,
.shift_cv_tabs .shift_cv_tabs_titles li a,
.cc-compliance .cc-btn {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

.top_panel .slider_engine_revo .slide_title {
	{$fonts['h1_font-family']}
}

blockquote,
mark, ins,
.logo_text,
.post_price.price,
.theme_scroll_down {
	{$fonts['h5_font-family']}
}

.post_meta {
	{$fonts['info_font-family']}
	{$fonts['info_font-size']}
	{$fonts['info_font-weight']}
	{$fonts['info_font-style']}
	{$fonts['info_line-height']}
	{$fonts['info_text-decoration']}
	{$fonts['info_text-transform']}
	{$fonts['info_letter-spacing']}
	{$fonts['info_margin-top']}
	{$fonts['info_margin-bottom']}
}

.post_subtitle .post_meta_item:first-child {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-size']}
	{$fonts['h5_font-weight']}
	{$fonts['h5_font-style']}
}

em, i,
.post-date, .rss-date .post_date,
.post_meta_item, .post_counters_item,
.post_meta .vc_inline-link,
.comments_list_wrap .comment_date,
.comments_list_wrap .comment_time,
.comments_list_wrap .comment_counters,
.top_panel .slider_engine_revo .slide_subtitle,
.logo_slogan,
fieldset legend,
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd,
.format-audio .post_featured .post_audio_author,
.trx_addons_audio_player .audio_author,
.post_item_single .post_content .post_meta,
.author_bio .author_link,
.comments_list_wrap .comment_posted,
.comments_list_wrap .comment_reply {
	{$fonts['info_font-family']}
}
.search_wrap .search_results .post_meta_item,
.search_wrap .search_results .post_counters_item {
	{$fonts['p_font-family']}
}

.logo_text {
	{$fonts['logo_font-family']}
	{$fonts['logo_font-size']}
	{$fonts['logo_font-weight']}
	{$fonts['logo_font-style']}
	{$fonts['logo_line-height']}
	{$fonts['logo_text-decoration']}
	{$fonts['logo_text-transform']}
	{$fonts['logo_letter-spacing']}
}
.logo_footer_text {
	{$fonts['logo_font-family']}
}

.menu_main_nav_area,
.top_panel .sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_nav,
.sc_layouts_menu_dir_vertical .sc_layouts_menu_nav {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-size']}
	{$fonts['menu_line-height']}
}
.menu_main_nav > li > a,
.top_panel .sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_nav > li > a {
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.menu_main_nav > li[class*="current-menu-"] > a .sc_layouts_menu_item_description,
.sc_layouts_menu_nav > li[class*="current-menu-"] > a .sc_layouts_menu_item_description {
	{$fonts['menu_font-weight']}
}
.menu_main_nav > li > ul,
.top_panel .sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_nav > li > ul,
.top_panel .sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_popup .sc_layouts_menu_nav {
	{$fonts['submenu_font-family']}
	{$fonts['submenu_font-size']}
	{$fonts['submenu_line-height']}
}
.menu_main_nav > li ul > li > a,
.top_panel .sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_nav > li ul > li > a,
.top_panel .sc_layouts_row:not(.sc_layouts_row_type_narrow) .sc_layouts_menu_popup .sc_layouts_menu_nav > li > a {
	{$fonts['submenu_font-weight']}
	{$fonts['submenu_font-style']}
	{$fonts['submenu_text-decoration']}
	{$fonts['submenu_text-transform']}
	{$fonts['submenu_letter-spacing']}
}

.menu_mobile .menu_mobile_nav_area > ul {
	{$fonts['menu_font-family']}
}
.menu_mobile .menu_mobile_nav_area > ul > li ul {
	{$fonts['submenu_font-family']}
}
.widget_calendar caption {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-size']}
	{$fonts['h5_font-weight']}
}
.widget_calendar tfoot {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-weight']}
}
.esg-filters div.esg-navigationbutton,
.page_links > a,
.page_links > span:not(.page_links_title),
.comments_pagination .page-numbers,
.nav-links .page-numbers {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-size']}
	{$fonts['h5_font-weight']}
}
nav .page-count {
	{$fonts['h6_font-family']}
	{$fonts['h6_font-weight']}
}
.post_featured.hover_fade .post_info .post_title,
.post_featured.hover_slide .post_info .post_title,
.post_featured.hover_pull .post_info .post_title,
.post_featured.hover_border .post_info .post_title {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-size']}
	{$fonts['h5_font-weight']}
}

CSS;
			$rez          = apply_filters( 'shift_cv_filter_get_css', $rez, array( 'fonts' => $fonts ) );
			$css['fonts'] = $rez['fonts'];
		}

		// Theme vars
		//---------------------------------------------
		if ( null === $vars ) {
			$vars = shift_cv_get_theme_vars();
		}

		if ( $vars ) {

			// Make theme-specific fonts rules
			$vars = shift_cv_customizer_add_theme_vars( $vars );
			extract( $vars );

			// Border radius
			//--------------------------------------
			$rez         = array();
			$rez['vars'] = <<<CSS

/* Buttons */
button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.post_item .more-link,
.gallery_preview_show .post_readmore,

/* Fields */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="tel"],
input[type="password"],
input[type="search"],
select,
.select_container,
textarea,

/* Search fields */
.widget_search .search-field,
.widget_display_search #bbp_search,
#bbpress-forums #bbp-search-form #bbp_search,

/* Comment fields */
.comments_wrap .comments_field input,
.comments_wrap .comments_field textarea,

/* Select 2 */
.select2-container.select2-container--default span.select2-choice,
.select2-container.select2-container--default span.select2-selection,

/* Images in widgets */
.widget_area .post_item .post_thumb img,
aside .post_item .post_thumb img,

/* Tags cloud */
.sc_edd_details .downloads_page_tags .downloads_page_data > a,
.widget_product_tag_cloud a,
.widget_tag_cloud a,
.cc-compliance .cc-btn {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}
.select_container:before {
	-webkit-border-radius: 0 {$rad} {$rad} 0;
	    -ms-border-radius: 0 {$rad} {$rad} 0;
			border-radius: 0 {$rad} {$rad} 0;
}
textarea.wp-editor-area {
	-webkit-border-radius: 0 0 {$rad} {$rad};
	    -ms-border-radius: 0 0 {$rad} {$rad};
			border-radius: 0 0 {$rad} {$rad};
}

/* Radius 50% or 0 */
.widget li a > img,
.widget li span > img {
	-webkit-border-radius: {$rad50};
	    -ms-border-radius: {$rad50};
			border-radius: {$rad50};
}

CSS;

			// Content and sidebar
			//--------------------------------------
			$rez['vars'] .= <<<CSS
.body_style_boxed .page_wrap {
	width: $page_boxed;
}
.content_wrap,
.content_container {
	width: $page;
}

body.body_style_wide:not(.expand_content) [class*="content_wrap"] > .content,
body.body_style_boxed:not(.expand_content) [class*="content_wrap"] > .content {	width: $content; }
[class*="content_wrap"] > .sidebar { 											width: $sidebar; }

.body_style_fullwide.sidebar_right [class*="content_wrap"] > .content,
.body_style_fullscreen.sidebar_right [class*="content_wrap"] > .content { padding-right: $sidebar_gap; }
.body_style_fullwide.sidebar_right [class*="content_wrap"] > .sidebar,
.body_style_fullscreen.sidebar_right [class*="content_wrap"] > .sidebar { margin-left: -$sidebar; }
.body_style_fullwide.sidebar_left [class*="content_wrap"] > .content,
.body_style_fullscreen.sidebar_left [class*="content_wrap"] > .content { padding-left:  $sidebar_gap; }
.body_style_fullwide.sidebar_left [class*="content_wrap"] > .sidebar,
.body_style_fullscreen.sidebar_left [class*="content_wrap"] > .sidebar { margin-right:-$sidebar; }

CSS;
			$rez          = apply_filters( 'shift_cv_filter_get_css', $rez, array( 'vars' => $vars ) );
			$css['vars']  = $rez['vars'];
		}

		// Theme colors
		//--------------------------------------
		if ( false !== $colors ) {
			$schemes = empty( $scheme ) ? array_keys( shift_cv_get_sorted_schemes() ) : array( $scheme );

			if ( count( $schemes ) > 0 ) {
				$rez = array();
				foreach ( $schemes as $s ) {
					// Prepare colors
					if ( empty( $scheme ) ) {
						$colors = shift_cv_get_scheme_colors( $s );
					}

					// Make theme-specific colors and tints
					$colors = shift_cv_customizer_add_theme_colors( $colors );

					// Make styles
					$rez['colors'] = <<<CSS

/* Common tags 
------------------------------------------ */
body{
	background-color: {$colors['inverse_bd_color']};
}
.body_style_boxed .page_wrap {
	background-color: {$colors['inverse_bd_color']};
}
.header-default-content-wrap,
.body_style_boxed .content article {
	background-color: {$colors['bg_color']};
}
div.esg-filters,
.comments_pagination, .nav-links, nav.pagination, .page_links {
	background-color: {$colors['bg_color']};
}
.scheme_self {
	color: {$colors['text']};
}
h1, h2, h3, h4, h5, h6,.post_layout_excerpt + .post_layout_excerpt
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
li a,
[class*="color_style_"] h1 a, [class*="color_style_"] h2 a, [class*="color_style_"] h3 a, [class*="color_style_"] h4 a, [class*="color_style_"] h5 a, [class*="color_style_"] h6 a, [class*="color_style_"] li a {
	color: {$colors['text_dark']};
}
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
li a:hover {
	color: {$colors['text_link']};
}
.color_style_link2 h1 a:hover, .color_style_link2 h2 a:hover, .color_style_link2 h3 a:hover, .color_style_link2 h4 a:hover, .color_style_link2 h5 a:hover, .color_style_link2 h6 a:hover, .color_style_link2 li a:hover {
	color: {$colors['text_link2']};
}
.color_style_link3 h1 a:hover, .color_style_link3 h2 a:hover, .color_style_link3 h3 a:hover, .color_style_link3 h4 a:hover, .color_style_link3 h5 a:hover, .color_style_link3 h6 a:hover, .color_style_link3 li a:hover {
	color: {$colors['text_link3']};
}
.color_style_dark h1 a:hover, .color_style_dark h2 a:hover, .color_style_dark h3 a:hover, .color_style_dark h4 a:hover, .color_style_dark h5 a:hover, .color_style_dark h6 a:hover, .color_style_dark li a:hover {
	color: {$colors['text_link']};
}
.post_format_link .post_content a {
	color: {$colors['text_hover']};
}
.post_format_link .post_content a:hover {
	color: {$colors['text_link']};
}

dt, b, strong, em, mark, ins {
	color: {$colors['text_dark']};
}
s, strike, del {	
	color: {$colors['text_light']};
}

code {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
code a {
	color: {$colors['alter_link']};
}
code a:hover {
	color: {$colors['alter_hover']};
}

a {
	color: {$colors['text_link']};
}
a:hover {
	color: {$colors['text_hover']};
}
.color_style_link2 a {
	color: {$colors['text_link2']};
}
.color_style_link2 a:hover {
	color: {$colors['text_hover2']};
}
.color_style_link3 a {
	color: {$colors['text_link3']};
}
.color_style_link3 a:hover {
	color: {$colors['text_hover3']};
}
.color_style_dark a {
	color: {$colors['text_dark']};
}
.color_style_dark a:hover {
	color: {$colors['text_link']};
}

blockquote:before {
	color: {$colors['text_dark']};
}

table th, table th + th, table td + th  {
	border-color: {$colors['extra_bd_color']};
}
table td, table th + td, table td + td {
	color: {$colors['alter_dark']};
	border-color: {$colors['bg_color']};
}
table th {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
table th b, table th strong {
	color: {$colors['text_dark']};
}
table > tbody > tr:nth-child(2n+1) > td {
	background-color: {$colors['alter_bg_color_02']};
}
table > tbody > tr:nth-child(2n) > td {
	background-color: {$colors['bd_color']};
}

hr {
	border-color: {$colors['bd_color']};
}
figure figcaption,
.wp-block-image figcaption,
.wp-block-audio figcaption,
.wp-block-video figcaption,
.wp-block-embed figcaption,
.wp-block-gallery .blocks-gallery-image figcaption,
.wp-block-gallery .blocks-gallery-item figcaption,
.wp-block-gallery.has-nested-images figure.wp-block-image figcaption,
.wp-block-gallery:not(.has-nested-images) .blocks-gallery-item figcaption,
.blocks-gallery-grid:not(.has-nested-images) .blocks-gallery-item figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd {
	color: {$colors['text']};
	background: {$colors['bg_color_09']};
}
ul > li:before {
	color: {$colors['text_link']};
}

.post_featured .mask {
	background-color: {$colors['alter_link2']};
}


#theme_switcher {
	background-color: {$colors['text_link3']};
}

/* Form fields
-------------------------------------------------- */


.widget_search form:after,
.widget_display_search form:after,
#bbpress-forums #bbp-search-form:after {
	color: {$colors['input_text']};
}
.widget_search form:hover:after,
.widget_display_search form:hover:after,
#bbpress-forums #bbp-search-form:hover:after {
	color: {$colors['input_dark']};
}

.wp-block-search .wp-block-search__inside-wrapper .wp-block-search__button {
	color: {$colors['inverse_text']};
	background: {$colors['alter_link']};	
}

.wp-block-search .wp-block-search__inside-wrapper .wp-block-search__button:hover {
	background: {$colors['alter_hover']};	
}

/* Field set */
fieldset {
	border-color: {$colors['bd_color']};
}
fieldset legend {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}

/* Text fields */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="tel"],
input[type="search"],
input[type="password"],
.select_container,
.select2-container.select2-container--default span.select2-choice,
.select2-container.select2-container--default span.select2-selection,
.select2-container.select2-container--default .select2-selection--single .select2-selection__rendered,
.select2-container.select2-container--default .select2-selection--multiple,
textarea,
textarea.wp-editor-area,
/* Tour Master */
.tourmaster-form-field input[type="text"],
.tourmaster-form-field input[type="email"],
.tourmaster-form-field input[type="password"],
.tourmaster-form-field textarea,
.tourmaster-form-field select,
.tourmaster-form-field.tourmaster-with-border input[type="text"],
.tourmaster-form-field.tourmaster-with-border input[type="email"],
.tourmaster-form-field.tourmaster-with-border input[type="password"],
.tourmaster-form-field.tourmaster-with-border textarea,
.tourmaster-form-field.tourmaster-with-border select,
/* BB Press */
#buddypress .dir-search input[type="search"],
#buddypress .dir-search input[type="text"],
#buddypress .groups-members-search input[type="search"],
#buddypress .groups-members-search input[type="text"],
#buddypress .standard-form input[type="color"],
#buddypress .standard-form input[type="date"],
#buddypress .standard-form input[type="datetime-local"],
#buddypress .standard-form input[type="datetime"],
#buddypress .standard-form input[type="email"],
#buddypress .standard-form input[type="month"],
#buddypress .standard-form input[type="number"],
#buddypress .standard-form input[type="password"],
#buddypress .standard-form input[type="range"],
#buddypress .standard-form input[type="search"],
#buddypress .standard-form input[type="tel"],
#buddypress .standard-form input[type="text"],
#buddypress .standard-form input[type="time"],
#buddypress .standard-form input[type="url"],
#buddypress .standard-form input[type="week"],
#buddypress .standard-form select,
#buddypress .standard-form textarea,
#buddypress form#whats-new-form textarea,
/* Booked */
#booked-page-form input[type="email"],
#booked-page-form input[type="text"],
#booked-page-form input[type="password"],
#booked-page-form textarea,
.booked-upload-wrap,
.booked-upload-wrap input,
/* MailChimp */
form.mc4wp-form input[type="email"] {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
.wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper {
	border-color: {$colors['input_bd_color']};
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
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
	background-color: {$colors['input_bg_hover']};
}

input[placeholder]::-webkit-input-placeholder,
textarea[placeholder]::-webkit-input-placeholder	{ color: {$colors['input_light']}; }
input[placeholder]::-moz-placeholder,
textarea[placeholder]::-moz-placeholder				{ color: {$colors['input_light']}; }
input[placeholder]:-ms-input-placeholder,
textarea[placeholder]:-ms-input-placeholder			{ color: {$colors['input_light']}; }
input[placeholder]::placeholder,
textarea[placeholder]::placeholder					{ color: {$colors['input_light']}; }

/* Select containers */
.select_container:before {
	color: {$colors['input_text']};
	background-color: {$colors['input_bg_color']};
}
.select_container:focus:before,
.select_container:hover:before {
	color: {$colors['input_dark']};
	background-color: {$colors['input_bg_hover']};
}
.select_container:after {
	color: {$colors['input_text']};
}
.select_container:focus:after,
.select_container:hover:after {
	color: {$colors['input_dark']};
}
.select_container select {
	color: {$colors['input_text']};
	background: {$colors['input_bg_color']} !important;
}
.select_container select:focus {
	color: {$colors['input_dark']};
	background-color: {$colors['input_bg_hover']} !important;
}

.select2-dropdown,
.select2-container.select2-container--focus span.select2-selection,
.select2-container.select2-container--open span.select2-selection {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
	background: {$colors['input_bg_hover']};
}
.select2-container .select2-results__option {
	color: {$colors['input_dark']};
	background: {$colors['input_bg_hover']};
}
.select2-dropdown .select2-highlighted,
.select2-container .select2-results__option--highlighted[aria-selected] {
	color: {$colors['inverse_link']};
	background: {$colors['text_link']};
}

input[type="radio"] + label:before,
input[type="checkbox"] + label:before,
input[type="radio"]+.wpcf7-list-item-label:before,
input[type="checkbox"]+.wpcf7-list-item-label:before,
.wpcf7-list-item-label.wpcf7-list-item-right:before,
.edd_price_options ul > li > label > input[type="radio"] + span:before,
.edd_price_options ul > li > label > input[type="checkbox"] + span:before,
.gdpr-terms-container input[type="checkbox"]:before {
	color: {$colors['input_text']};
	border-color: {$colors['bd_color']};
	background: {$colors['bg_color']};
}
div.wpcf7-validation-errors,
div.wpcf7-acceptance-missing {
	border-color: {$colors['text_link']};
}
span.wpcf7-not-valid-tip {
	color: {$colors['text_link']};
}
.trx_addons_message_box_success,
div.wpcf7-mail-sent-ok {
	border-color: {$colors['text_link2']};
}
form .error_field,
.trx_addons_message_box_error,
.trx_addons_field_error,
.wpcf7-not-valid {
	border-color: {$colors['text_link']} !important;
}
.trx_addons_message_box,
.trx_addons_message_box_error {
	color:{$colors['text']};
	background-color: {$colors['bg_color']};
}

/* Simple button */
.sc_button_simple:not(.sc_button_bg_image),
.sc_button_simple:not(.sc_button_bg_image):before,
.sc_button_simple:not(.sc_button_bg_image):after {
	color:{$colors['text_link']};
}
.sc_button_simple:not(.sc_button_bg_image):hover,
.sc_button_simple:not(.sc_button_bg_image):hover:before,
.sc_button_simple:not(.sc_button_bg_image):hover:after {
	color:{$colors['text_hover']} !important;
}
.sc_button_simple.color_style_link2:not(.sc_button_bg_image),
.sc_button_simple.color_style_link2:not(.sc_button_bg_image):before,
.sc_button_simple.color_style_link2:not(.sc_button_bg_image):after,
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image),
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image):before,
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image):after {
	color:{$colors['text_link2']};
}
.sc_button_simple.color_style_link2:not(.sc_button_bg_image):hover,
.sc_button_simple.color_style_link2:not(.sc_button_bg_image):hover:before,
.sc_button_simple.color_style_link2:not(.sc_button_bg_image):hover:after,
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image):hover,
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image):hover:before,
.color_style_link2 .sc_button_simple:not(.sc_button_bg_image):hover:after {
	color:{$colors['text_hover2']};
}

.sc_button_simple.color_style_link3:not(.sc_button_bg_image),
.sc_button_simple.color_style_link3:not(.sc_button_bg_image):before,
.sc_button_simple.color_style_link3:not(.sc_button_bg_image):after,
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image),
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image):before,
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image):after {
	color:{$colors['text_link3']};
}
.sc_button_simple.color_style_link3:not(.sc_button_bg_image):hover,
.sc_button_simple.color_style_link3:not(.sc_button_bg_image):hover:before,
.sc_button_simple.color_style_link3:not(.sc_button_bg_image):hover:after,
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image):hover,
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image):hover:before,
.color_style_link3 .sc_button_simple:not(.sc_button_bg_image):hover:after {
	color:{$colors['text_hover3']};
}

.sc_button_simple.color_style_dark:not(.sc_button_bg_image),
.sc_button_simple.color_style_dark:not(.sc_button_bg_image):before,
.sc_button_simple.color_style_dark:not(.sc_button_bg_image):after,
.color_style_dark .sc_button_simple:not(.sc_button_bg_image),
.color_style_dark .sc_button_simple:not(.sc_button_bg_image):before,
.color_style_dark .sc_button_simple:not(.sc_button_bg_image):after {
	color:{$colors['text_dark']};
}
.sc_button_simple.color_style_dark:not(.sc_button_bg_image):hover,
.sc_button_simple.color_style_dark:not(.sc_button_bg_image):hover:before,
.sc_button_simple.color_style_dark:not(.sc_button_bg_image):hover:after,
.color_style_dark .sc_button_simple:not(.sc_button_bg_image):hover,
.color_style_dark .sc_button_simple:not(.sc_button_bg_image):hover:before,
.color_style_dark .sc_button_simple:not(.sc_button_bg_image):hover:after {
	color:{$colors['text_link']};
}


/* Bordered button */
.sc_button_bordered:not(.sc_button_bg_image) {
	color:{$colors['text_link']};
	border-color:{$colors['text_link']};
}
.sc_button_bordered:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover']} !important;
	border-color:{$colors['text_hover']} !important;
}
.sc_button_bordered.color_style_link2:not(.sc_button_bg_image) {
	color:{$colors['text_link2']};
	border-color:{$colors['text_link2']};
}
.sc_button_bordered.color_style_link2:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover2']} !important;
	border-color:{$colors['text_hover2']} !important;
}
.sc_button_bordered.color_style_link3:not(.sc_button_bg_image) {
	color:{$colors['text_link3']};
	border-color:{$colors['text_link3']};
}
.sc_button_bordered.color_style_link3:not(.sc_button_bg_image):hover {
	color:{$colors['text_hover3']} !important;
	border-color:{$colors['text_hover3']} !important;
}
.sc_button_bordered.color_style_dark:not(.sc_button_bg_image) {
	color:{$colors['text_dark']};
	border-color:{$colors['text_dark']};
}
.sc_button_bordered.color_style_dark:not(.sc_button_bg_image):hover {
	color:{$colors['text_link']} !important;
	border-color:{$colors['text_link']} !important;
}

/* Normal button */
button,
.wp-block-button:not(.is-style-outline) .wp-block-button__link,
input[type="reset"],
input[type="submit"],
input[type="button"],
.comments_wrap .form-submit input[type="submit"],
/* BB & Buddy Press */
#buddypress .comment-reply-link,
#buddypress .generic-button a,
#buddypress a.button,
#buddypress button,
#buddypress input[type="button"],
#buddypress input[type="reset"],
#buddypress input[type="submit"],
#buddypress ul.button-nav li a,
a.bp-title-button,
/* Booked */
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button,
#booked-profile-page .booked-profile-appt-list .appt-block .booked-cal-buttons .google-cal-button > a,
#booked-profile-page input[type="submit"],
#booked-profile-page button,
.booked-list-view input[type="submit"],
.booked-list-view button,
table.booked-calendar input[type="submit"],
table.booked-calendar button,
.booked-modal input[type="submit"],
.booked-modal button,
/* ThemeREX Addons */
.sc_button_default,
.sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image),
.socials_share:not(.socials_type_drop) .social_icon,
/* Tour Master */
.tourmaster-tour-search-wrap input.tourmaster-tour-search-submit[type="submit"],
/* Tribe Events */
#tribe-bar-form .tribe-bar-submit input[type="submit"],
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"],
#tribe-bar-views li.tribe-bar-views-option a,
#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a,
#tribe-events .tribe-events-button,
.tribe-events-button,
.tribe-events-cal-links a,
.tribe-events-sub-nav li a,
/* EDD buttons */
.edd_download_purchase_form .button,
#edd-purchase-button,
.edd-submit.button,
.widget_edd_cart_widget .edd_checkout a,
.sc_edd_details .downloads_page_tags .downloads_page_data > a,
/* MailChimp */
.mc4wp-form input[type="submit"] {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.cc-compliance .cc-btn {
	color: {$colors['inverse_link']} !important;
	border-color: {$colors['text_link']} !important;
	background-color: {$colors['text_link']} !important;
}
.wp-block-button.is-style-outline .wp-block-button__link{
	color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}
.post_item .more-link,
.gallery_preview_show .post_readmore {
	color: {$colors['inverse_text']};
	background-color: {$colors['extra_hover3']};
}

.theme_button {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']} !important;
}
.theme_button.color_style_link2 {
	background-color: {$colors['text_link2']} !important;
}
.theme_button.color_style_link3 {
	background-color: {$colors['text_link3']} !important;
}
.theme_button.color_style_dark {
	color: {$colors['bg_color']} !important;
	background-color: {$colors['text_dark']} !important;
}
.sc_price_item_link {
	color: {$colors['inverse_link']};
	background-color: {$colors['extra_link']};
}
.sc_button_default.color_style_link2,
.sc_button.color_style_link2:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image) {
	background-color: {$colors['text_link2']};
}
.sc_button_default.color_style_link3,
.sc_button.color_style_link3:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image) {
	background-color: {$colors['text_link3']};
}
.sc_button_default.color_style_dark,
.sc_button.color_style_dark:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image) {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}
.search_wrap .search_submit:before {
	color: {$colors['input_text']};
}

button[disabled],
input[type="submit"][disabled],
input[type="button"][disabled] {
	background-color: {$colors['text']} !important;
	color: {$colors['inverse_text']} !important;
}

button:hover,
button:focus,
.wp-block-button:not(.is-style-outline) .wp-block-button__link:hover,
input[type="submit"]:hover,
input[type="submit"]:focus,
input[type="reset"]:hover,
input[type="reset"]:focus,
input[type="button"]:hover,
input[type="button"]:focus,
.post_item .more-link:hover,
.comments_wrap .form-submit input[type="submit"]:hover,
.comments_wrap .form-submit input[type="submit"]:focus,
/* BB & Buddy Press */
#buddypress .comment-reply-link:hover,
#buddypress .generic-button a:hover,
#buddypress a.button:hover,
#buddypress button:hover,
#buddypress input[type="button"]:hover,
#buddypress input[type="reset"]:hover,
#buddypress input[type="submit"]:hover,
#buddypress ul.button-nav li a:hover,
a.bp-title-button:hover,
/* Booked */
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button:hover,
body #booked-profile-page .booked-profile-appt-list .appt-block .booked-cal-buttons .google-cal-button > a:hover,
body #booked-profile-page input[type="submit"]:hover,
body #booked-profile-page button:hover,
body .booked-list-view input[type="submit"]:hover,
body .booked-list-view button:hover,
body table.booked-calendar input[type="submit"]:hover,
body table.booked-calendar button:hover,
body .booked-modal input[type="submit"]:hover,
body .booked-modal button:hover,
/* ThemeREX Addons */
.sc_button_default:hover,
.sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover,
.socials_share:not(.socials_type_drop) .social_icon:hover,
/* Tour Master */
.tourmaster-tour-search-wrap input.tourmaster-tour-search-submit[type="submit"]:hover,
/* Tribe Events */
#tribe-bar-form .tribe-bar-submit input[type="submit"]:hover,
#tribe-bar-form .tribe-bar-submit input[type="submit"]:focus,
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"]:hover,
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"]:focus,
#tribe-bar-views li.tribe-bar-views-option a:hover,
#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover,
#tribe-events .tribe-events-button:hover,
.tribe-events-button:hover,
.tribe-events-cal-links a:hover,
.tribe-events-sub-nav li a:hover,
/* EDD buttons */
.edd_download_purchase_form .button:hover, .edd_download_purchase_form .button:active, .edd_download_purchase_form .button:focus,
#edd-purchase-button:hover, #edd-purchase-button:active, #edd-purchase-button:focus,
.edd-submit.button:hover, .edd-submit.button:active, .edd-submit.button:focus,
.widget_edd_cart_widget .edd_checkout a:hover,
.sc_edd_details .downloads_page_tags .downloads_page_data > a:hover,
/* MailChimp */
.mc4wp-form input[type="submit"]:hover,
.mc4wp-form input[type="submit"]:focus,
/* Essential Grid */
.esgbox-close-small:hover:after {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_hover']};
}
.cc-compliance .cc-btn:hover,
.cc-compliance .cc-btn:focus {
	color: {$colors['inverse_text']} !important;
	border-color: {$colors['text_hover']} !important;
	background-color: {$colors['text_hover']} !important;
}
.wp-block-button.is-style-outline .wp-block-button__link:hover{
	color: {$colors['text_hover']};
	border-color: {$colors['text_hover']};
}
.theme_button:hover,
.theme_button:focus {
	color: {$colors['inverse_hover']} !important;
	background-color: {$colors['text_link_blend']} !important;
}
.theme_button.color_style_link2:hover {
	background-color: {$colors['text_hover2']} !important;
}
.theme_button.color_style_link3:hover {
	background-color: {$colors['text_hover3']} !important;
}
.theme_button.color_style_dark:hover {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_link']} !important;
}
.sc_price_item:hover .sc_price_item_link,
.sc_price_item_link:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['extra_hover']};
}
.sc_button_default.color_style_link2:hover,
.sc_button.color_style_link2:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover {
	background-color: {$colors['text_hover2']};
}
.sc_button_default.color_style_link3:hover,
.sc_button.color_style_link3:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover {
	background-color: {$colors['text_hover3']};
}
.sc_button_default.color_style_dark:hover,
.sc_button.color_style_dark:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover {
	color: {$colors['inverse_text']};
	background-color: {$colors['text_link']};
}
.search_wrap .search_submit:hover:before {
	color: {$colors['input_dark']};
}



/* Buttons in sidebars 
------------------------------------- */

/* Simple button */
.scheme_self.sidebar .sc_button_simple:not(.sc_button_bg_image),
.scheme_self.sidebar .sc_button_simple:not(.sc_button_bg_image):before,
.scheme_self.sidebar .sc_button_simple:not(.sc_button_bg_image):after {
	color:{$colors['alter_link']};
}
.scheme_self.sidebar .sc_button_simple:not(.sc_button_bg_image):hover,
.scheme_self.sidebar .sc_button_simple:not(.sc_button_bg_image):hover:before,
.scheme_self.sidebar .sc_button_simple:not(.sc_button_bg_image):hover:after {
	color:{$colors['alter_hover']} !important;
}

/* Bordered button */
.scheme_self.sidebar .sc_button_bordered:not(.sc_button_bg_image) {
	color:{$colors['alter_link']};
	border-color:{$colors['alter_link']};
}
.scheme_self.sidebar .sc_button_bordered:not(.sc_button_bg_image):hover {
	color:{$colors['alter_hover']} !important;
	border-color:{$colors['alter_hover']} !important;
}

/* All other buttons */
.scheme_self.sidebar button,
.scheme_self.sidebar input[type="reset"],
.scheme_self.sidebar input[type="submit"],
.scheme_self.sidebar input[type="button"],
/* ThemeREX Addons */
.scheme_self.sidebar .sc_button_default,
.scheme_self.sidebar .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image),
.scheme_self.sidebar .socials_share:not(.socials_type_drop) .social_icon,
/* EDD buttons */
.scheme_self.sidebar .edd_download_purchase_form .button,
.scheme_self.sidebar #edd-purchase-button,
.scheme_self.sidebar .edd-submit.button,
.scheme_self.sidebar .widget_edd_cart_widget .edd_checkout a,
.scheme_self.sidebar .sc_edd_details .downloads_page_tags .downloads_page_data > a {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_link']};
}

/* All other buttons hovered */
.scheme_self.sidebar button:hover,
.scheme_self.sidebar button:focus,
.scheme_self.sidebar input[type="reset"]:hover,
.scheme_self.sidebar input[type="reset"]:focus,
.scheme_self.sidebar input[type="submit"]:hover,
.scheme_self.sidebar input[type="submit"]:focus,
.scheme_self.sidebar input[type="button"]:hover,
.scheme_self.sidebar input[type="button"]:focus,
/* ThemeREX Addons */
.scheme_self.sidebar .sc_button_default:hover,
.scheme_self.sidebar .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover,
.scheme_self.sidebar .socials_share:not(.socials_type_drop) .social_icon:hover,
/* EDD buttons */
.scheme_self.sidebar .edd_download_purchase_form .button:hover,
.scheme_self.sidebar #edd-purchase-button:hover,
.scheme_self.sidebar .edd-submit.button:hover,
.scheme_self.sidebar .widget_edd_cart_widget .edd_checkout a:hover,
.scheme_self.sidebar .sc_edd_details .downloads_page_tags .downloads_page_data > a:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['alter_hover']};
}

/* Buttons in WP Editor */
.wp-editor-container input[type="button"] {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_dark']};
	-webkit-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
	    -ms-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
			box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};	
}
.wp-editor-container input[type="button"]:hover,
.wp-editor-container input[type="button"]:focus {
	background-color: {$colors['alter_bg_hover']};
	border-color: {$colors['alter_bd_hover']};
	color: {$colors['alter_link']};
}


/* WP Standard classes 
-------------------------------------------- */
.sticky {
	border-color: {$colors['bd_color']};
}
.sticky .label_sticky {
	border-top-color: {$colors['extra_link2']};
}

.body_style_boxed .content article.label_sticky {
	background-color: {$colors['extra_bg_color']};
}

/* Custom layouts
--------------------------------- */

.scheme_self.top_panel {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}

.scheme_self.sc_layouts_row {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}

.footer_wrap .scheme_self.vc_row .sc_layouts_row_delimiter,
.footer_wrap .scheme_self.sc_layouts_row_delimiter,
.scheme_self.footer_wrap .sc_layouts_row_delimiter {
	border-color: {$colors['alter_bd_color']};
}

.sc_layouts_item_icon {
	color: {$colors['text_light']};
}
.sc_layouts_item_details_line1 {
	color: {$colors['text_link']};
}
.sc_layouts_item_details_line2 {
	color: {$colors['text_dark']};
}

span.trx_addons_login_menu,
span.trx_addons_login_menu:after {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
span.trx_addons_login_menu .trx_addons_login_menu_delimiter {
	border-color: {$colors['alter_bd_color']};
}
span.trx_addons_login_menu .trx_addons_login_menu_item {
	color: {$colors['alter_text']};
}
span.trx_addons_login_menu .trx_addons_login_menu_item:hover {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_hover']};
}

.sc_layouts_row_fixed_on {
	background-color: {$colors['bg_color']};
}

/* Row type: Narrow */
.sc_layouts_row.sc_layouts_row_type_narrow,
.scheme_self.sc_layouts_row.sc_layouts_row_type_narrow {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.sc_layouts_row_type_narrow .sc_layouts_item,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button),
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button) {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button):hover,
.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button):hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button):hover,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item a:not(.sc_button):not(.button):hover .sc_layouts_item_icon {
	color: {$colors['alter_dark']};
}
.sc_layouts_row_type_narrow .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_icon {
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .sc_layouts_item_details_line1,
.sc_layouts_row_type_narrow .sc_layouts_item_details_line2,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_details_line1,
.scheme_self.sc_layouts_row_type_narrow .sc_layouts_item_details_line2 {
	color: {$colors['alter_text']};
}

.sc_layouts_row_type_narrow .socials_wrap .social_item .social_icon,
.scheme_self.sc_layouts_row_type_narrow .socials_wrap .social_item .social_icon {
	background-color: transparent;
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .socials_wrap .social_item:hover .social_icon,
.scheme_self.sc_layouts_row_type_narrow .socials_wrap .social_item:hover .social_icon {
	background-color: transparent;
	color: {$colors['alter_hover']};
}

.sc_layouts_row_type_narrow .sc_button_default,
.sc_layouts_row_type_narrow .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image),
.scheme_self.sc_layouts_row_type_narrow .sc_button_default,
.scheme_self.sc_layouts_row_type_narrow .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image) {
	background-color: {$colors['alter_link']};
	color: {$colors['inverse_link']};
}
.sc_layouts_row_type_narrow .sc_button_default:hover,
.sc_layouts_row_type_narrow .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button_default:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover {
	background-color: {$colors['alter_link']};
	color: {$colors['inverse_link']};
}
.sc_layouts_row_type_narrow .sc_button.color_style_link2,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link2 {
	background-color: {$colors['alter_link2']};
	color: {$colors['inverse_link']};
}
.sc_layouts_row_type_narrow .sc_button.color_style_link2:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link2:hover {
	background-color: {$colors['alter_hover2']};
	color: {$colors['inverse_link']} !important;
}
.sc_layouts_row_type_narrow .sc_button.color_style_link3,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link3 {
	background-color: {$colors['alter_link3']};
	color: {$colors['inverse_link']};
}
.sc_layouts_row_type_narrow .sc_button.color_style_link3:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_link2:hover {
	background-color: {$colors['alter_hover3']};
	color: {$colors['inverse_link']} !important;
}
.sc_layouts_row_type_narrow .sc_button.color_style_dark,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_dark {
	background-color: {$colors['alter_dark']};
	color: {$colors['inverse_link']};
}
.sc_layouts_row_type_narrow .sc_button.color_style_dark:hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button.color_style_dark:hover {
	background-color: {$colors['alter_link']};
	color: {$colors['inverse_link']} !important;
}

.sc_layouts_row_type_narrow .sc_button_bordered:not(.sc_button_bg_image),
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered:not(.sc_button_bg_image) {
	color:{$colors['alter_link']};
	border-color:{$colors['alter_link']};
}
.sc_layouts_row_type_narrow .sc_button_bordered:not(.sc_button_bg_image):hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered:not(.sc_button_bg_image):hover {
	color:{$colors['alter_hover']} !important;
	border-color:{$colors['alter_hover']} !important;
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link2:not(.sc_button_bg_image),
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link2:not(.sc_button_bg_image) {
	color:{$colors['alter_link2']};
	border-color:{$colors['alter_link2']};
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link2:not(.sc_button_bg_image):hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link2:not(.sc_button_bg_image):hover {
	color:{$colors['alter_hover2']} !important;
	border-color:{$colors['alter_hover2']} !important;
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link3:not(.sc_button_bg_image),
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link3:not(.sc_button_bg_image) {
	color:{$colors['alter_link3']};
	border-color:{$colors['alter_link3']};
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link3:not(.sc_button_bg_image):hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_link3:not(.sc_button_bg_image):hover {
	color:{$colors['alter_hover3']} !important;
	border-color:{$colors['alter_hover3']} !important;
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_dark:not(.sc_button_bg_image),
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_dark:not(.sc_button_bg_image) {
	color:{$colors['alter_dark']};
	border-color:{$colors['alter_dark']};
}
.sc_layouts_row_type_narrow .sc_button_bordered.color_style_dark:not(.sc_button_bg_image):hover,
.scheme_self.sc_layouts_row_type_narrow .sc_button_bordered.color_style_dark:not(.sc_button_bg_image):hover {
	color:{$colors['alter_link']} !important;
	border-color:{$colors['alter_link']} !important;
}

.sc_layouts_row_type_narrow .search_wrap .search_submit,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['alter_link']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field::-webkit-input-placeholder,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field::-webkit-input-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field::-moz-placeholder,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field::-moz-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field:-ms-input-placeholder,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field:-ms-input-placeholder {
	color: {$colors['alter_text']};
}
.sc_layouts_row_type_narrow .search_wrap .search_field:focus,
.scheme_self.sc_layouts_row_type_narrow .search_wrap .search_field:focus {
	color: {$colors['alter_dark']};
}


/* Row type: Compact */
.sc_layouts_row_type_compact .sc_layouts_item,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item {
	color: {$colors['text']};
}

.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button),
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button) {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button):hover,
.sc_layouts_row_type_compact .sc_layouts_item a:hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button):hover,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['text_dark']};
}

.sc_layouts_row_type_compact .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_icon {
	color: {$colors['text_link']};
}

.sc_layouts_row_type_compact .sc_layouts_item_details_line1,
.sc_layouts_row_type_compact .sc_layouts_item_details_line2,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_details_line1,
.scheme_self.sc_layouts_row_type_compact .sc_layouts_item_details_line2 {
	color: {$colors['text']};
}

.sc_layouts_row_type_compact .socials_wrap .social_item .social_icon,
.scheme_self.sc_layouts_row_type_compact .socials_wrap .social_item .social_icon {
	background-color: transparent;
	color: {$colors['text_dark']};
}
.sc_layouts_row_type_compact .socials_wrap .social_item:hover .social_icon,
.scheme_self.sc_layouts_row_type_compact .socials_wrap .social_item:hover .social_icon {
	background-color: transparent;
	color: {$colors['text_hover']};
}

.sc_layouts_row_type_compact .search_wrap .search_submit,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['text_dark']};
}
.sc_layouts_row_type_compact .search_wrap .search_submit:hover,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_submit:hover {
	background-color: transparent;
	color: {$colors['text_hover']};
}
.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit,
.scheme_self.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit {
	color: {$colors['text_link']};
}
.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit:hover,
.scheme_self.sc_layouts_row_type_compact .search_wrap.search_style_normal .search_submit:hover {
	color: {$colors['text_hover']};
}

.sc_layouts_row_type_compact .search_wrap .search_field::-webkit-input-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field::-webkit-input-placeholder {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .search_wrap .search_field::-moz-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field::-moz-placeholder {
	color: {$colors['text']};
}
.sc_layouts_row_type_compact .search_wrap .search_field:-ms-input-placeholder,
.scheme_self.sc_layouts_row_type_compact .search_wrap .search_field:-ms-input-placeholder {
	color: {$colors['text']};
}


/* Row type: Normal */
.sc_layouts_row_type_normal .sc_layouts_item,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item {
	color: {$colors['text']};
}
.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button),
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button) {
	color: {$colors['text']};
}
.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button):hover,
.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button):hover .sc_layouts_item_icon,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button):hover,
.scheme_self.sc_layouts_row_type_normal .sc_layouts_item a:not(.sc_button):not(.button):hover .sc_layouts_item_icon {
	color: {$colors['text_dark']};
}

.sc_layouts_row_type_normal .search_wrap .search_submit,
.scheme_self.sc_layouts_row_type_normal .search_wrap .search_submit {
	background-color: transparent;
	color: {$colors['input_text']};
}
.sc_layouts_row_type_normal .search_wrap .search_submit:hover,
.scheme_self.sc_layouts_row_type_normal .search_wrap .search_submit:hover {
	background-color: transparent;
	color: {$colors['input_dark']};
}


/* Logo */
.sc_layouts_logo b {
	color: {$colors['text_dark']};
}
.sc_layouts_logo i {
	color: {$colors['text_link']};
}
.sc_layouts_logo_text {
	color: {$colors['text_link']};
}
.sc_layouts_logo:hover .logo_text {
	color: {$colors['alter_link']};
}
.logo_slogan {
	color: {$colors['text']};
}


/* Search style 'Expand' */
.search_style_expand.search_opened {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.search_style_expand.search_opened .search_submit {
	color: {$colors['text']};
}
.search_style_expand .search_submit:hover,
.search_style_expand .search_submit:focus {
	color: {$colors['text_dark']};
}


/* Search style 'Fullscreen' */
.search_style_fullscreen.search_opened .search_form_wrap {
	background-color: {$colors['bg_color_09']};
}
.search_style_fullscreen.search_opened .search_form {
	border-color: {$colors['text_dark']};
}
.search_style_fullscreen.search_opened .search_close,
.search_style_fullscreen.search_opened .search_field,
.search_style_fullscreen.search_opened .search_submit {
	color: {$colors['text_dark']};
}
.search_style_fullscreen.search_opened .search_close:hover,
.search_style_fullscreen.search_opened .search_field:hover,
.search_style_fullscreen.search_opened .search_field:focus,
.search_style_fullscreen.search_opened .search_submit:hover,
.search_style_fullscreen.search_opened .search_submit:focus {
	color: {$colors['text']};
}
.search_style_fullscreen.search_opened .search_field::-webkit-input-placeholder {color:{$colors['text_light']}; opacity: 1;}
.search_style_fullscreen.search_opened .search_field::-moz-placeholder          {color:{$colors['text_light']}; opacity: 1;}/* Firefox 19+ */
.search_style_fullscreen.search_opened .search_field:-moz-placeholder           {color:{$colors['text_light']}; opacity: 1;}/* Firefox 18- */
.search_style_fullscreen.search_opened .search_field:-ms-input-placeholder      {color:{$colors['text_light']}; opacity: 1;}


/* Search results */
.search_wrap .search_results {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.search_wrap .search_results:after {
	background-color: {$colors['bg_color']};
	border-left-color: {$colors['bd_color']};
	border-top-color: {$colors['bd_color']};
}
.search_wrap .search_results .search_results_close {
	color: {$colors['text_light']};
}
.search_wrap .search_results .search_results_close:hover {
	color: {$colors['text_dark']};
}
.search_results.widget_area .post_item + .post_item {
	border-top-color: {$colors['bd_color']};
}


/* Page title and breadcrumbs */
.sc_layouts_title .sc_layouts_title_meta,
.sc_layouts_title .post_meta,
.sc_layouts_title .post_meta_item,
.sc_layouts_title .post_meta .vc_inline-link,
.sc_layouts_title .post_meta_item a,
.sc_layouts_title .post_meta_item:after,
.sc_layouts_title .post_meta_item:hover:after,
.sc_layouts_title .post_meta_item.post_categories,
.sc_layouts_title .post_meta_item.post_categories a,
.sc_layouts_title .post_info .post_info_item,
.sc_layouts_title .post_info .post_info_item a,
.sc_layouts_title .post_info_counters .post_counters_item,
.sc_layouts_title .post_counters .socials_share .socials_caption:before,
.sc_layouts_title .post_counters .socials_share .socials_caption:hover:before {
	color: {$colors['text_dark']};
}
.sc_layouts_title .post_meta_item a:hover,
.sc_layouts_title .post_meta .vc_inline-link:hover,
.sc_layouts_title a.post_meta_item:hover,
.sc_layouts_title .post_info .post_info_item a:hover,
.sc_layouts_title .post_info_counters .post_counters_item:hover {
	color: {$colors['text_light']};
}

.sc_layouts_title .sc_layouts_title_description {
	color: {$colors['text_dark']};
}
.sc_layouts_title_breadcrumbs {
	color: {$colors['text_dark']};
}
.sc_layouts_title_breadcrumbs a {
	color: {$colors['text_dark']} !important;
}
.sc_layouts_title_breadcrumbs a:hover {
	color: {$colors['text_light']} !important;
}


/* Menu */
.sc_layouts_menu_nav > li > a {
	color: {$colors['text_dark']};
}
.sc_layouts_menu_nav > li > a:hover,
.sc_layouts_menu_nav > li.sfHover > a {
	color: {$colors['text_link']} !important;
}
.sc_layouts_menu_nav > li.current-menu-item > a,
.sc_layouts_menu_nav > li.current-menu-parent > a,
.sc_layouts_menu_nav > li.current-menu-ancestor > a {
	color: {$colors['text_dark']} !important;
}
.sc_layouts_menu_nav .menu-collapse > a:before {
	color: {$colors['alter_text']};
}
.sc_layouts_menu_nav .menu-collapse > a:after {
	background-color: {$colors['alter_bg_color']};
}
.sc_layouts_menu_nav .menu-collapse > a:hover:before {
	color: {$colors['alter_link']};
}
.sc_layouts_menu_nav .menu-collapse > a:hover:after {
	background-color: {$colors['alter_bg_hover']};
}

/* Submenu */
.sc_layouts_menu_popup .sc_layouts_menu_nav,
.sc_layouts_menu_nav > li ul {
	background-color: {$colors['extra_bg_color']};
}
.widget_nav_menu li.menu-delimiter,
.sc_layouts_menu_nav > li li.menu-delimiter {
	border-color: {$colors['extra_bd_color']};
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a,
.sc_layouts_menu_nav > li li > a {
	color: {$colors['extra_text']} !important;
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a:hover,
.sc_layouts_menu_popup .sc_layouts_menu_nav > li.sfHover > a,
.sc_layouts_menu_nav > li li > a:hover,
.sc_layouts_menu_nav > li li.sfHover > a {
	color: {$colors['extra_hover']} !important;
	background-color: {$colors['extra_bg_hover']};
}
.sc_layouts_menu_nav > li li > a:hover:after {
	color: {$colors['extra_hover']} !important;
}
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children > a:hover,
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children.sfHover > a {
	color: {$colors['extra_text']} !important;
	background-color: transparent;
}
.post_share [class^="icon-"]:before, .post_share [class*=" icon-"]:before,
.post_share [class^="trx_addons_icon-"]:before, .post_share [class*=" trx_addons_icon-"]:before,
.post_share .sc_layouts_menu_nav > li li[class*="icon-"]:before {
	color: {$colors['extra_hover']};
}
.sc_layouts_menu_nav > li li[class*="icon-"]:hover:before,
.sc_layouts_menu_nav > li li[class*="icon-"].shHover:before {
	color: {$colors['extra_hover']};
}
.sc_layouts_menu_nav > li li.current-menu-item > a,
.sc_layouts_menu_nav > li li.current-menu-parent > a,
.sc_layouts_menu_nav > li li.current-menu-ancestor > a {
	color: {$colors['extra_hover']} !important;
}
.sc_layouts_menu_nav > li li.current-menu-item:before,
.sc_layouts_menu_nav > li li.current-menu-parent:before,
.sc_layouts_menu_nav > li li.current-menu-ancestor:before {
	color: {$colors['extra_hover']} !important;
}

/* Description in the menu */
.sc_layouts_menu_item_description {
	color: {$colors['extra_light']};
}
.menu_main_nav > li ul [class*="current-menu-"] > a .sc_layouts_menu_item_description,
.sc_layouts_menu_nav > li ul li[class*="current-menu-"] > a .sc_layouts_menu_item_description,
.menu_main_nav > li ul a:hover .sc_layouts_menu_item_description,
.sc_layouts_menu_nav > li ul a:hover .sc_layouts_menu_item_description {
	color: {$colors['text_light']};
}
.menu_main_nav > li[class*="current-menu-"] > a .sc_layouts_menu_item_description,
.sc_layouts_menu_nav > li[class*="current-menu-"] > a .sc_layouts_menu_item_description,
.menu_main_nav > li > a:hover .sc_layouts_menu_item_description,
.sc_layouts_menu_nav > li > a:hover .sc_layouts_menu_item_description {
	color: {$colors['text']};
}

/* Layouts as submenu */
.sc_layouts_menu li > ul.sc_layouts_submenu .vc_row,
.sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item,
.sc_layouts_menu li > ul.sc_layouts_submenu .post_item{
	color: {$colors['extra_text']};
}

.sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:not(.sc_button):not(.button),
.sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:not(.sc_button):not(.button) {
	color: {$colors['extra_dark']};
}
.sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:not(.sc_button):not(.button):hover,
.sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:not(.sc_button):not(.button):hover,
.sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:hover .sc_layouts_item_icon,
.sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['extra_link']};
}
ul.sc_layouts_submenu h1,
ul.sc_layouts_submenu h2,
ul.sc_layouts_submenu h3,
ul.sc_layouts_submenu h4,
ul.sc_layouts_submenu h5,
ul.sc_layouts_submenu h6,
ul.sc_layouts_submenu h1 a,
ul.sc_layouts_submenu h2 a,
ul.sc_layouts_submenu h3 a,
ul.sc_layouts_submenu h4 a,
ul.sc_layouts_submenu h5 a,
ul.sc_layouts_submenu h6 a,
ul.sc_layouts_submenu [class*="color_style_"] h1 a,
ul.sc_layouts_submenu [class*="color_style_"] h2 a,
ul.sc_layouts_submenu [class*="color_style_"] h3 a,
ul.sc_layouts_submenu [class*="color_style_"] h4 a,
ul.sc_layouts_submenu [class*="color_style_"] h5 a,
ul.sc_layouts_submenu [class*="color_style_"] h6 a {
	color: {$colors['extra_dark']};
}
ul.sc_layouts_submenu h1 a:hover,
ul.sc_layouts_submenu h2 a:hover,
ul.sc_layouts_submenu h3 a:hover,
ul.sc_layouts_submenu h4 a:hover,
ul.sc_layouts_submenu h5 a:hover,
ul.sc_layouts_submenu h6 a:hover {
	color: {$colors['extra_link']};
}
ul.sc_layouts_submenu .color_style_link2 h1 a:hover,
ul.sc_layouts_submenu .color_style_link2 h2 a:hover,
ul.sc_layouts_submenu .color_style_link2 h3 a:hover,
ul.sc_layouts_submenu .color_style_link2 h4 a:hover,
ul.sc_layouts_submenu .color_style_link2 h5 a:hover,
ul.sc_layouts_submenu .color_style_link2 h6 a:hover {
	color: {$colors['extra_link2']};
}
ul.sc_layouts_submenu .color_style_link3 h1 a:hover,
ul.sc_layouts_submenu .color_style_link3 h2 a:hover,
ul.sc_layouts_submenu .color_style_link3 h3 a:hover,
ul.sc_layouts_submenu .color_style_link3 h4 a:hover,
ul.sc_layouts_submenu .color_style_link3 h5 a:hover,
ul.sc_layouts_submenu .color_style_link3 h6 a:hover {
	color: {$colors['extra_link3']};
}
ul.sc_layouts_submenu .color_style_dark h1 a:hover,
ul.sc_layouts_submenu .color_style_dark h2 a:hover,
ul.sc_layouts_submenu .color_style_dark h3 a:hover,
ul.sc_layouts_submenu .color_style_dark h4 a:hover,
ul.sc_layouts_submenu .color_style_dark h5 a:hover,
ul.sc_layouts_submenu .color_style_dark h6 a:hover {
	color: {$colors['extra_link']};
}

ul.sc_layouts_submenu dt,
ul.sc_layouts_submenu b,
ul.sc_layouts_submenu strong,
ul.sc_layouts_submenu i,
ul.sc_layouts_submenu em,
ul.sc_layouts_submenu mark,
ul.sc_layouts_submenu ins {	
	color: {$colors['extra_dark']};
}
ul.sc_layouts_submenu s,
ul.sc_layouts_submenu strike,
ul.sc_layouts_submenu del,
ul.sc_layouts_submenu .post_meta{	
	color: {$colors['extra_light']};
}

ul.sc_layouts_submenu .sc_recent_news_header {
	border-color: {$colors['extra_bd_color']};
}

/* Layouts submenu in the Custom Menu */
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .vc_row,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .post_item{
	color: {$colors['text']};
}

.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:not(.sc_button):not(.button),
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:not(.sc_button):not(.button) {
	color: {$colors['text_link']};
}
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:not(.sc_button):not(.button):hover,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .vc_row a:hover .sc_layouts_item_icon,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:not(.sc_button):not(.button):hover,
.widget_nav_menu .sc_layouts_menu li > ul.sc_layouts_submenu .sc_layouts_item a:hover .sc_layouts_item_icon {
	color: {$colors['text_hover']};
}
.widget_nav_menu ul.sc_layouts_submenu h1,
.widget_nav_menu ul.sc_layouts_submenu h2,
.widget_nav_menu ul.sc_layouts_submenu h3,
.widget_nav_menu ul.sc_layouts_submenu h4,
.widget_nav_menu ul.sc_layouts_submenu h5,
.widget_nav_menu ul.sc_layouts_submenu h6,
.widget_nav_menu ul.sc_layouts_submenu h1 a,
.widget_nav_menu ul.sc_layouts_submenu h2 a,
.widget_nav_menu ul.sc_layouts_submenu h3 a,
.widget_nav_menu ul.sc_layouts_submenu h4 a,
.widget_nav_menu ul.sc_layouts_submenu h5 a,
.widget_nav_menu ul.sc_layouts_submenu h6 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h1 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h2 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h3 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h4 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h5 a,
.widget_nav_menu ul.sc_layouts_submenu [class*="color_style_"] h6 a {
	color: {$colors['text_dark']};
}
.widget_nav_menu ul.sc_layouts_submenu h1 a:hover,
.widget_nav_menu ul.sc_layouts_submenu h2 a:hover,
.widget_nav_menu ul.sc_layouts_submenu h3 a:hover,
.widget_nav_menu ul.sc_layouts_submenu h4 a:hover,
.widget_nav_menu ul.sc_layouts_submenu h5 a:hover,
.widget_nav_menu ul.sc_layouts_submenu h6 a:hover {
	color: {$colors['text_link']};
}
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h1 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h2 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h3 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h4 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h5 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link2 h6 a:hover {
	color: {$colors['text_link2']};
}
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h1 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h2 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h3 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h4 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h5 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_link3 h6 a:hover {
	color: {$colors['text_link3']};
}
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h1 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h2 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h3 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h4 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h5 a:hover,
.widget_nav_menu ul.sc_layouts_submenu .color_style_dark h6 a:hover {
	color: {$colors['text_link']};
}

.widget_nav_menu ul.sc_layouts_submenu dt,
.widget_nav_menu ul.sc_layouts_submenu b,
.widget_nav_menu ul.sc_layouts_submenu strong,
.widget_nav_menu ul.sc_layouts_submenu i,
.widget_nav_menu ul.sc_layouts_submenu em,
.widget_nav_menu ul.sc_layouts_submenu mark,
.widget_nav_menu ul.sc_layouts_submenu ins {	
	color: {$colors['text_dark']};
}
.widget_nav_menu ul.sc_layouts_submenu s,
.widget_nav_menu ul.sc_layouts_submenu strike,
.widget_nav_menu ul.sc_layouts_submenu del,
.widget_nav_menu ul.sc_layouts_submenu .post_meta{	
	color: {$colors['text_light']};
}

.widget_nav_menu ul.sc_layouts_submenu .sc_recent_news_header {
	border-color: {$colors['bd_color']};
}


/* Side menu */
.scheme_self.menu_side_wrap .menu_side_button {
	color: {$colors['alter_dark']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color_07']};
}
.scheme_self.menu_side_wrap .menu_side_button:hover {
	color: {$colors['inverse_hover']};
	border-color: {$colors['alter_hover']};
	background-color: {$colors['alter_link']};
}
.menu_side_inner {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.menu_side_inner .sc_layouts_logo {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.menu_side_icons .sc_layouts_logo {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}

.scheme_self.menu_side_icons .toc_menu_item .toc_menu_icon,
.menu_side_inner > .toc_menu_item .toc_menu_icon {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_link']};
}
.scheme_self.menu_side_icons .toc_menu_item:hover .toc_menu_icon,
.scheme_self.menu_side_icons .toc_menu_item_active .toc_menu_icon,
.menu_side_inner > .toc_menu_item:hover .toc_menu_icon,
.menu_side_inner > .toc_menu_item_active .toc_menu_icon {
	background-color: {$colors['text_link']};
	color: {$colors['inverse_link']};
}
.scheme_self.menu_side_icons .toc_menu_icon_default:before,
.menu_side_inner > .toc_menu_icon_default:before {
	background-color: {$colors['text_link']};
}
.scheme_self.menu_side_icons .toc_menu_item:hover .toc_menu_icon_default:before,
.scheme_self.menu_side_icons .toc_menu_item_active .toc_menu_icon_default:before,
.menu_side_inner > .toc_menu_item:hover .toc_menu_icon_default:before,
.menu_side_inner > .toc_menu_item_active .toc_menu_icon_default:before {
	background-color: {$colors['text_dark']};
}
.scheme_self.menu_side_icons .toc_menu_item .toc_menu_description,
.menu_side_inner > .toc_menu_item .toc_menu_description {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}

.scheme_self.menu_side_dots #toc_menu .toc_menu_item .toc_menu_icon {
	background-color: {$colors['alter_bg_color']};
	color: {$colors['alter_text']};
}
.scheme_self.menu_side_dots #toc_menu .toc_menu_item:hover .toc_menu_icon,
.scheme_self.menu_side_dots #toc_menu .toc_menu_item_active .toc_menu_icon {
	color: {$colors['alter_link']};
}
.scheme_self.menu_side_dots #toc_menu .toc_menu_item .toc_menu_icon:before {
	background-color: {$colors['alter_link']};
}
.scheme_self.menu_side_dots #toc_menu .toc_menu_item:hover .toc_menu_icon:before {
	background-color: {$colors['alter_hover']};
}

/* Mobile menu */
.menu_mobile_inner {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.menu_mobile_button {
	color: {$colors['text_dark']};
}
.menu_mobile_button:hover {
	color: {$colors['text_link']};
}
.menu_mobile_close:before,
.menu_mobile_close:after {
	border-color: {$colors['alter_dark']};
}
.menu_mobile_close:hover:before,
.menu_mobile_close:hover:after {
	border-color: {$colors['alter_link']};
}
.menu_mobile .menu_mobile_nav_area > ul > li li.menu-delimiter > a {
	border-color: {$colors['alter_bd_color']};
}
.menu_mobile_inner a,
.menu_mobile_inner .menu_mobile_nav_area li:before {
	color: {$colors['alter_dark']};
}
.menu_mobile_inner a:hover,
.menu_mobile_inner .current-menu-ancestor > a,
.menu_mobile_inner .current-menu-item > a,
.menu_mobile_inner .menu_mobile_nav_area li:hover:before,
.menu_mobile_inner .menu_mobile_nav_area li.current-menu-ancestor:before,
.menu_mobile_inner .menu_mobile_nav_area li.current-menu-item:before {
	color: {$colors['alter_link']};
}
.menu_mobile_inner .search_mobile .search_submit {
	color: {$colors['input_light']};
}
.menu_mobile_inner .search_mobile .search_submit:focus,
.menu_mobile_inner .search_mobile .search_submit:hover {
	color: {$colors['input_dark']};
}

.menu_mobile_inner .social_item .social_icon {
	color: {$colors['alter_link']};
}
.menu_mobile_inner .social_item:hover .social_icon {
	color: {$colors['alter_dark']};
}


/* Menu hovers */

/* fade box */
.menu_hover_fade_box .sc_layouts_menu_nav > a:hover,
.menu_hover_fade_box .sc_layouts_menu_nav > li > a:hover,
.menu_hover_fade_box .sc_layouts_menu_nav > li.sfHover > a {
	color: {$colors['alter_link']};
	background-color: {$colors['alter_bg_color']};
}

/* slide_line */
.menu_hover_slide_line .sc_layouts_menu_nav > li#blob {
	background-color: {$colors['text_link']};
}

/* slide_box */
.menu_hover_slide_box .sc_layouts_menu_nav > li#blob {
	background-color: {$colors['alter_bg_color']};
}

/* zoom_line */
.menu_hover_zoom_line .sc_layouts_menu_nav > li > a:before {
	background-color: {$colors['text_link']};
}

/* path_line */
.menu_hover_path_line .sc_layouts_menu_nav > li:before,
.menu_hover_path_line .sc_layouts_menu_nav > li:after,
.menu_hover_path_line .sc_layouts_menu_nav > li > a:before,
.menu_hover_path_line .sc_layouts_menu_nav > li > a:after {
	background-color: {$colors['text_link']};
}

/* roll_down */
.menu_hover_roll_down .sc_layouts_menu_nav > li > a:before {
	background-color: {$colors['text_link']};
}

/* color_line */
.menu_hover_color_line .sc_layouts_menu_nav > li > a:before {
	background-color: {$colors['text_dark']};
}
.menu_hover_color_line .sc_layouts_menu_nav > li > a:after,
.menu_hover_color_line .sc_layouts_menu_nav > li.menu-item-has-children > a:after {
	background-color: {$colors['text_link']};
}
.menu_hover_color_line .sc_layouts_menu_nav > li.sfHover > a,
.menu_hover_color_line .sc_layouts_menu_nav > li > a:hover,
.menu_hover_color_line .sc_layouts_menu_nav > li > a:focus {
	color: {$colors['text_link']};
}


/* VC Separator */
.scheme_self.sc_layouts_row .vc_separator.vc_sep_color_grey .vc_sep_line,
.sc_layouts_row .vc_separator.vc_sep_color_grey .vc_sep_line {
	border-color: {$colors['alter_bd_color']};
}

/* Cart */
.sc_layouts_cart_items_short {
	background-color: {$colors['text_dark']};
	color: {$colors['bg_color']};
}
.sc_layouts_cart_widget {
	border-color: {$colors['bd_color']};
	background-color: {$colors['bg_color']};
	color: {$colors['text']};
}
.sc_layouts_cart_widget:after {
	border-color: {$colors['bd_color']};
	background-color: {$colors['bg_color']};
}
.sc_layouts_cart_widget .sc_layouts_cart_widget_close {
	color: {$colors['text_light']};
}
.sc_layouts_cart_widget .sc_layouts_cart_widget_close:hover {
	color: {$colors['text_dark']};
}

.sc_layouts_currency .chosen-container .chosen-results {
	background: {$colors['alter_bg_color']};
	color: {$colors['alter_dark']};
}
.sc_layouts_currency .chosen-container .chosen-results li {
	color: {$colors['alter_dark']};
}
.sc_layouts_currency .chosen-container .active-result.highlighted,
.sc_layouts_currency .chosen-container .active-result.result-selected {
	color: {$colors['alter_link']} !important;
}

/* Page 
-------------------------------------------- */
#page_preloader,
.page_content_wrap {
	background-color: {$colors['inverse_bd_color']};
}
.preloader_wrap > div {
	background-color: {$colors['text_link']};
}

.accent-line-top .style-1 {
	background-color: {$colors['extra_link2']};
}
.accent-line-top .style-2 {
	background-color: {$colors['text_hover']};
}
.accent-line-top .style-3 {
	background-color: {$colors['text_link2']};
}
.accent-line-top .style-4 {
	background-color: {$colors['alter_link2']};
}
.accent-line-top .style-5 {
	background-color: {$colors['text_link']};
}

/* Header */
.top_panel,
.scheme_self.top_panel {
	background-color: {$colors['inverse_bd_color']};
}
.scheme_self.top_panel.with_bg_image:before {
	background-color: {$colors['bg_color_07']};
}
.scheme_self.top_panel .slider_engine_revo .slide_subtitle,
.top_panel .slider_engine_revo .slide_subtitle {
	color: {$colors['text_link']};
}


/* Tabs */
.mptt-navigation-tabs li a,
.shift_cv_tabs .shift_cv_tabs_titles li a {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}
.mptt-navigation-tabs li a:hover,
.shift_cv_tabs .shift_cv_tabs_titles li a:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.mptt-navigation-tabs li.active a,
.shift_cv_tabs .shift_cv_tabs_titles li.ui-state-active a {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}

.sheme_self.sidebar div.esg-filter-wrapper .esg-filterbutton > span,
.sheme_self.sidebar .mptt-navigation-tabs li a,
.sheme_self.sidebar .shift_cv_tabs .shift_cv_tabs_titles li a {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_hover']};
}
.sheme_self.sidebar div.esg-filter-wrapper .esg-filterbutton > span:hover,
.sheme_self.sidebar .mptt-navigation-tabs li a:hover,
.sheme_self.sidebar .shift_cv_tabs .shift_cv_tabs_titles li a:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_link']};
}
.sheme_self.sidebar div.esg-filter-wrapper .esg-filterbutton.selected > span,
.sheme_self.sidebar .mptt-navigation-tabs li.active a,
.sheme_self.sidebar .shift_cv_tabs .shift_cv_tabs_titles li.ui-state-active a {
	color: {$colors['alter_bg_color']};
	background-color: {$colors['alter_dark']};
}
.esgbox-share__links a,
.esgbox-close-small:after {
	color: {$colors['inverse_text']};
}
div.esg-filter-wrapper .esg-filterbutton > span, .mptt-navigation-tabs li a, .shift_cv_tabs .shift_cv_tabs_titles li a {
	color: {$colors['text_dark']};
}

div.esg-filter-wrapper .esg-filterbutton > span:hover,
.mptt-navigation-tabs li a:hover,
.shift_cv_tabs .shift_cv_tabs_titles li a:hover {
	color: {$colors['text_hover']};
}
div.esg-filter-wrapper .esg-filterbutton.selected > span,
.mptt-navigation-tabs li.active a,
.shift_cv_tabs .shift_cv_tabs_titles li.ui-state-active a {
	color: {$colors['text_link']};
}

/* Post layouts */
.post_item {
	color: {$colors['text']};
}
.post_meta,
.post_meta_item,
.post_meta_item:after,
.post_meta_item:hover:after,
.post_meta .vc_inline-link,
.post_meta .vc_inline-link:after,
.post_meta .vc_inline-link:hover:after,
.post_meta_item a,
.post_info .post_info_item,
.post_info .post_info_item a,
.post_info_counters .post_counters_item,
.post_counters .socials_share .socials_caption:before,
.post_counters .socials_share .socials_caption:hover:before {
	color: {$colors['text_light']};
}
.post_featured.hover_fade .post_meta,
.post_featured.hover_fade .post_meta_item,
.post_featured.hover_fade .post_meta_item:after,
.post_featured.hover_fade .post_meta_item:hover:after,
.post_featured.hover_fade .post_meta .vc_inline-link,
.post_featured.hover_fade .post_meta .vc_inline-link:after,
.post_featured.hover_fade .post_meta .vc_inline-link:hover:after {
	color: {$colors['extra_hover3']};
}
.post_date a:hover,
a.post_meta_item:hover,
.post_meta_item a:hover,
.post_meta .vc_inline-link:hover,
.post_info .post_info_item a:hover,
.post_info_counters .post_counters_item:hover {
	color: {$colors['text_hover']};
}
.post_item .post_title a:hover {
	color: {$colors['text_link']};
}

.post_meta_item .post_meta_label {
	color: {$colors['text_dark']};
}
.post_meta_item.post_categories,
.post_meta_item.post_categories a {
	color: {$colors['text_link']};
}
.post_meta_item.post_categories a:hover {
	color: {$colors['text_hover']};
}

.post_inner .post_meta_item.post_categories,
.post_inner .post_meta_item.post_categories a {
	color: {$colors['text_light']};
}
.post_inner .post_meta_item.post_categories a:hover {
	color: {$colors['text_hover']};
}

.post_meta_item .socials_share .social_items {
	background-color: {$colors['bg_color']};
}
.post_meta_item .social_items,
.post_meta_item .social_items:before {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_light']};
}

.post_layout_classic {
	border-color: {$colors['bd_color']};
}

.scheme_self.gallery_preview:before {
	background-color: {$colors['bg_color']};
}
.scheme_self.gallery_preview {
	color: {$colors['text']};
}


/* Post Formats
------------------------------------------ */

/* Audio with cover image */
.trx_addons_audio_player.with_cover .audio_author,
.format-audio .post_featured.with_thumb .post_audio_author {
	color: {$colors['extra_link']};
}

.mejs-container .mejs-controls,
.wp-playlist .mejs-container .mejs-controls {
	background: {$colors['inverse_bd_color']};
}
.trx_addons_audio_player.without_cover .mejs-controls,
.format-audio .post_featured.without_thumb .mejs-controls {
	background: {$colors['inverse_bd_color']};
}
.mejs-controls .mejs-button {
	background: {$colors['extra_hover3']};
}
.mejs-controls .mejs-button > button:hover,
.mejs-controls .mejs-button > button:focus {
	color: {$colors['text_link2']};
}

.mejs-controls .mejs-time {
	color: {$colors['text_light']};
}
.mejs-controls .mejs-time-rail .mejs-time-total,
.mejs-controls .mejs-time-rail .mejs-time-loaded,
.mejs-controls .mejs-time-rail .mejs-time-hovered,
.mejs-controls .mejs-volume-slider .mejs-volume-total,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
	background: {$colors['inverse_light']};
}
.mejs-controls .mejs-time-rail .mejs-time-current,
.mejs-controls .mejs-volume-slider .mejs-volume-current,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
	background: {$colors['text_link2']};
}
.mejs-controls .mejs-time-rail .mejs-time-handle-content {
	border-color: {$colors['text_link2']};
}
.mejs-controls .mejs-volume-slider .mejs-volume-handle,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-handle {
	background: {$colors['extra_link']};
}

/* Audio without cover image */
.trx_addons_audio_player.without_cover,
.format-audio .post_featured.without_thumb .post_audio {
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color']};
}
.trx_addons_audio_player.without_cover .audio_author,
.format-audio .post_featured.without_thumb .post_audio_author {
	color: {$colors['alter_link']};
}
.trx_addons_audio_player.without_cover .audio_caption,
.format-audio .post_featured.without_thumb .post_audio_title {
	color: {$colors['alter_dark']};
}
.trx_addons_audio_player.without_cover .audio_description,
.format-audio .post_featured.without_thumb .post_audio_description {
	color: {$colors['alter_text']};
}

/* WordPress Playlist */
.wp-playlist-light {
	background: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text']};
}
.wp-playlist-light .wp-playlist-caption {
	color: {$colors['text_dark']};
}
.wp-playlist-light .wp-playlist-playing {
	background: {$colors['alter_bg_color']};
	color: {$colors['alter_dark']};
}
.wp-playlist-item {
	border-color: {$colors['bd_color']};
}

/* Aside */
.format-aside .post_content_inner {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}

/* Link and Status */
.format-link .post_content_inner,
.format-status .post_content_inner {
	color: {$colors['text_dark']};
}

/* Chat */
.format-chat p > b,
.format-chat p > strong {
	color: {$colors['text_dark']};
}

/* Video */
.trx_addons_video_player.with_cover .video_hover,
.format-video .post_featured.with_thumb .post_video_hover {
	color: {$colors['extra_hover3']};
}
.trx_addons_video_player.with_cover .video_hover:hover,
.format-video .post_featured.with_thumb .post_video_hover:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .trx_addons_video_player.with_cover .video_hover {
	color: {$colors['alter_link']};
}
.scheme_self.sidebar .trx_addons_video_player.with_cover .video_hover:hover {
	color: {$colors['inverse_hover']};
	background-color: {$colors['alter_link']};
}

/* Chess */
.post_layout_chess .post_content_inner:after {
	background: linear-gradient(to top, {$colors['bg_color']} 0%, {$colors['bg_color_0']} 100%) no-repeat scroll right top / 100% 100% {$colors['bg_color_0']};
}
.post_layout_chess_1 .post_meta:before {
	background-color: {$colors['bd_color']};
}

/* Pagination */
.nav-links-old {
	color: {$colors['text_dark']};
}
.nav-links-old a:hover {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
}

.esg-filters div.esg-navigationbutton,
.esg-filters div.esg-navigationbutton.selected,
.page_links > a,
.page_links > span:not(.page_links_title),
.comments_pagination .page-numbers,
.page-numbers.page-count,
.nav-links .page-numbers {
	color: {$colors['text_light']};
	background-color: {$colors['input_bg_hover']};
}
.esg-filters div.esg-navigationbutton:hover,
.esg-filters div.esg-navigationbutton.selected,
.page_links > a:hover,
.page_links > span:not(.page_links_title),
.comments_pagination a.page-numbers:hover,
.comments_pagination .page-numbers.current,
.nav-links a.page-numbers:hover,
.nav-links .page-numbers.current {
	color: {$colors['text_dark']};
}


/* Single post */
.post_item_single .post_header .post_date {
	color: {$colors['text_light']};
}
.post_item_single .post_header .post_categories,
.post_item_single .post_header .post_categories a {
	color: {$colors['text_link']};
}
.post_item_single .post_header .post_meta_item,
.post_item_single .post_header .post_meta .vc_inline-link,

.post_item_single .post_header .post_meta_item a,
.post_item_single .post_header .post_meta_item .socials_caption {
	color: {$colors['text_light']};
}
.post_item_single a.post_meta_item:hover,
.post_item_single .post_header .post_meta .vc_inline-link:hover,
.post_item_single .post_meta_item > a:hover,
.post_item_single .post_meta_item .socials_caption:hover,
.post_item_single .post_edit a:hover {
	color: {$colors['text_hover']};
}
.post_item_single .post_content .post_meta_label,
.post_item_single .post_content .post_meta_item:hover .post_meta_label {
	color: {$colors['text_dark']};
}
.post_meta .post_share .social_item, .post_meta .post_share .social_item a,
.post_meta .post_share .social_item .social_icon {
	color: {$colors['inverse_link']} !important;
}
.post_meta .post_share .social_item, .post_meta .post_share .social_item a {
	background-color: {$colors['text_link']};
}
.post_inner .post_meta .post_share .social_item, .post_inner .post_meta .post_share .social_item a.social_icon,
 .post_inner .post_meta .post_share .social_item, .post_inner .post_meta .post_share .social_item a span {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']};
}

.post-password-form input[type="submit"] {
	border-color: {$colors['text_dark']};
}
.post-password-form input[type="submit"]:hover,
.post-password-form input[type="submit"]:focus {
	color: {$colors['bg_color']};
}

/* Single post navi */
.nav-links-single .nav-links .nav-next a .nav-text,
.nav-links-single .nav-links .nav-previous a .nav-text {
	color: {$colors['text_light']};
	background-color: {$colors['bd_color']};
}
.nav-links-single .nav-links .nav-next a:hover .nav-text,
.nav-links-single .nav-links .nav-previous a:hover .nav-text {
	color: {$colors['text_hover']};
}
.single-attachment .content .nav-links-single a > h5,
.nav-links-single .nav-links a .meta-nav {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a .post_date {
	color: {$colors['text_light']};
}
.single-attachment .content .nav-links-single a:hover > h5,
.nav-links-single .nav-links a:hover .meta-nav,
.nav-links-single .nav-links a:hover .post_date {
	color: {$colors['text_dark']};
}
.nav-links-single .nav-links a:hover .post-title {
	color: {$colors['text_link']};
}

/* Author info */
.scheme_self.author_info {
	color: {$colors['text']};
	background-color: {$colors['bg_color']};
}
.scheme_self.author_info .author_title {
	color: {$colors['text_link']};
}
.scheme_self.author_info a {
	color: {$colors['text_dark']};
}
.scheme_self.author_info a:hover {
	color: {$colors['text_link']};
}
.scheme_self.author_info .socials_wrap .social_item .social_icon {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.scheme_self.author_info .socials_wrap .social_item:hover .social_icon {
	color: {$colors['inverse_hover']};
	background-color: {$colors['text_hover']};
}
.comments_list_wrap .comment_posted {
	color: {$colors['text_light']};
}
.author_info {
	border-color: {$colors['inverse_bd_color']};
}

/* Related posts */
.related_wrap {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.related_wrap .related_item_style_1 .post_header {
	background-color: {$colors['bg_color_07']};
}
.related_wrap .related_item_style_1:hover .post_header {
	background-color: {$colors['bg_color']};
}
.related_wrap .related_item_style_1 .post_date a {
	color: {$colors['text']};
}
.related_wrap .related_item_style_1:hover .post_date a {
	color: {$colors['text_light']};
}
.related_wrap .related_item_style_1:hover .post_date a:hover {
	color: {$colors['text_dark']};
}

/* Contact form */
.page_contact_form {
	border-color: {$colors['bd_color']};
}

/* Comments */
.comments_form_wrap,
.comments_list_wrap,
.comments_list_wrap > ul {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
.comments_list_wrap li + li,
.comments_list_wrap li ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap .comment_info {
	color: {$colors['text_dark']};
}
.comments_list_wrap .comment_counters a {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:hover {
	color: {$colors['text_hover']};
}
.comments_list_wrap .comment_text {
	color: {$colors['text']};
}
.comments_list_wrap .comment_reply a {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_reply a:hover {
	color: {$colors['text_hover']};
}
.comments_form_wrap {
	border-color: {$colors['bd_color']};
}
.comments_wrap .comments_notes {
	color: {$colors['text_light']};
}


/* Page 404 */
.post_item_404 .page_title {
	color: {$colors['text_light']};
}
.post_item_404 .page_description {
	color: {$colors['text_link']};
}
.post_item_404 .go_home {
	border-color: {$colors['text_dark']};
}



/* Sidebar
---------------------------------------------- */
.scheme_self.sidebar .sidebar_inner {
	color: {$colors['alter_text']};
	background-color: {$colors['bg_color']};
}
.sidebar .widget {
	background-color: {$colors['bg_color']};
}
.scheme_self.sidebar a {
	color: {$colors['alter_link']};
}
.scheme_self.sidebar a:hover {
	color: {$colors['alter_hover']};
}
.scheme_self.sidebar h1, .scheme_self.sidebar h2, .scheme_self.sidebar h3, .scheme_self.sidebar h4, .scheme_self.sidebar h5, .scheme_self.sidebar h6,
.scheme_self.sidebar h1 a, .scheme_self.sidebar h2 a, .scheme_self.sidebar h3 a, .scheme_self.sidebar h4 a, .scheme_self.sidebar h5 a, .scheme_self.sidebar h6 a {
	color: {$colors['alter_dark']};
}
.scheme_self.sidebar h1 a:hover, .scheme_self.sidebar h2 a:hover, .scheme_self.sidebar h3 a:hover, .scheme_self.sidebar h4 a:hover, .scheme_self.sidebar h5 a:hover, .scheme_self.sidebar h6 a:hover {
	color: {$colors['alter_link']};
}

/* Lists in widgets */
ul.wp-block-page-list li a,
ul.wp-block-archives-list li a,
ul.wp-block-categories-list li a,
ul.wp-block-categories__list li a,
.widget ul > li a {
	color: {$colors['text_light']};
}
ul.wp-block-page-list li a:hover,
ul.wp-block-archives-list li a:hover,
ul.wp-block-categories-list li a:hover,
ul.wp-block-categories__list li a:hover,
.widget ul > li a:hover {
	color: {$colors['text_hover']};
}
ul.wp-block-page-list li:before,
ul.wp-block-archives-list li:before,
ul.wp-block-categories-list li:before,
ul.wp-block-categories__list li:before,
.post_inner .post_meta_item.post_categories li:before,
.widget ul > li:before {
	background-color: {$colors['text_hover']};
}

.scheme_self.sidebar ul > li:nth-child(5n+0):before {
	background-color: {$colors['text_hover']};
}
/*1*/ 
.post_inner .post_meta_item.post_categories ul > li:nth-child(5n+1):before,
.post_inner .post_meta_item.post_categories a:nth-child(5n+1):before,
.widget_contacts .contacts_info:not(.use_labels) span.contacts_address:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item:nth-child(5n+1) .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:nth-child(5n+1):before,
.widget ul > li:nth-child(5n+1):before {
	background-color: {$colors['text_hover']};
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
	background-color: {$colors['text_link']};
}
/*5*/
.post_inner .post_meta_item.post_categories ul > li:before,
.widget_contacts .contacts_info:not(.use_labels) span.contacts_bdate:before,
.sc_blogger_testimonials .sc_blogger_content .sc_blogger_item .sc_supertitle_no_icon,
.sc_price_item.sc_price_item_default .sc_price_item_info .sc_price_item_details ul li:before,
.widget ul > li:before {
	background-color: {$colors['extra_link2']};
}

.scheme_self.sidebar li > a,
.scheme_self.sidebar .post_title > a {
	color: {$colors['alter_dark']};
}
.scheme_self.sidebar li > a:hover,
.scheme_self.sidebar .post_title > a:hover {
	color: {$colors['alter_link']};
}


/* Posts in widgets */
.scheme_self.sidebar .post_meta,
.scheme_self.sidebar .post_meta_item,
.scheme_self.sidebar .post_meta_item:after,
.scheme_self.sidebar .post_meta_item:hover:after,
.scheme_self.sidebar .post_meta .vc_inline-link,
.scheme_self.sidebar .post_meta .vc_inline-link:after,
.scheme_self.sidebar .post_meta .vc_inline-link:hover:after,
.scheme_self.sidebar .post_meta_item a,
.scheme_self.sidebar .post_info .post_info_item,
.scheme_self.sidebar .post_info .post_info_item a,
.scheme_self.sidebar .post_info_counters .post_counters_item,
.scheme_self.sidebar .post_counters .socials_share .socials_caption:before,
.scheme_self.sidebar .post_counters .socials_share .socials_caption:hover:before {
	color: {$colors['alter_light']};
}
.scheme_self.sidebar .post_date a:hover,
.scheme_self.sidebar a.post_meta_item:hover,
.scheme_self.sidebar .post_meta_item a:hover,
.scheme_self.sidebar .post_meta .vc_inline-link:hover,
.scheme_self.sidebar .post_info .post_info_item a:hover,
.scheme_self.sidebar .post_info_counters .post_counters_item:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .post_item .post_title a:hover {
	color: {$colors['alter_link']};
}

.scheme_self.sidebar .post_meta_item.post_categories,
.scheme_self.sidebar .post_meta_item.post_categories a {
	color: {$colors['alter_link']};
}
.scheme_self.sidebar .post_meta_item.post_categories a:hover {
	color: {$colors['alter_hover']};
}

.scheme_self.sidebar .post_meta_item .socials_share .social_items {
	background-color: {$colors['alter_bg_color']};
}
.scheme_self.sidebar .post_meta_item .social_items,
.scheme_self.sidebar .post_meta_item .social_items:before {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_light']};
}

/* Archive */
.scheme_self.sidebar .widget_archive li {
	color: {$colors['alter_dark']};
}

/* Calendar */
.wp-block-calendar th, 
.widget_calendar th {
	color: {$colors['text_link']};
}
.wp-block-calendar caption,
.wp-block-calendar tbody td a,
.widget_calendar caption,
.widget_calendar tbody td a {
	color: {$colors['text_dark']};
}
.scheme_self.sidebar .widget_calendar caption,
.scheme_self.sidebar .widget_calendar tbody td a,
.scheme_self.sidebar .widget_calendar th {
	color: {$colors['alter_dark']};
}
.wp-block-calendar tbody td,
.widget_calendar tbody td {
	color: {$colors['text']} !important;
}
.scheme_self.sidebar .widget_calendar tbody td {
	color: {$colors['alter_text']} !important;
}
.wp-block-calendar tbody td a:hover,
.widget_calendar tbody td a:hover {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar tbody td a:hover {
	color: {$colors['alter_link']};
}
.wp-block-calendar tbody td a:after,
.widget_calendar tbody td a:after {
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar tbody td a:after {
	background-color: {$colors['alter_link']};
}
.wp-block-calendar td#today,
.widget_calendar td#today {
	color: {$colors['bg_color']} !important;
}
.wp-block-calendar td#today a,
.widget_calendar td#today a {
	color: {$colors['inverse_link']};
}
.wp-block-calendar td#today a:hover,
.widget_calendar td#today a:hover {
	color: {$colors['inverse_hover']};
}
.wp-block-calendar td#today:before,
.widget_calendar td#today:before {
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar td#today:before {
	background-color: {$colors['alter_link']};
}
.wp-block-calendar td#today a:after,
.widget_calendar td#today a:after {
	background-color: {$colors['inverse_link']};
}
.widget_calendar td#today a:hover:after,
.widget_calendar td#today a:hover:after {
	background-color: {$colors['inverse_hover']};
}
.wp-calendar-nav .wp-calendar-nav-prev a,
.wp-calendar-nav .wp-calendar-nav-next a,
.widget_calendar #prev a,
.widget_calendar #next a {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar #prev a,
.scheme_self.sidebar .widget_calendar #next a {
	color: {$colors['alter_link']};
}
.wp-calendar-nav .wp-calendar-nav-prev a:hover,
.wp-calendar-nav .wp-calendar-nav-next a:hover,
.widget_calendar #prev a:hover,
.widget_calendar #next a:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_calendar #prev a:hover,
.scheme_self.sidebar .widget_calendar #next a:hover {
	color: {$colors['alter_hover']};
}
.wp-calendar-nav .wp-calendar-nav-prev a,
.wp-calendar-nav .wp-calendar-nav-next a,
.widget_calendar td#prev a,
.widget_calendar td#next a {
	color: {$colors['text']};
}
.wp-calendar-nav .wp-calendar-nav-prev a:before,
.wp-calendar-nav .wp-calendar-nav-next a:before,
.widget_calendar td#prev a:before,
.widget_calendar td#next a:before {
	background-color: {$colors['bg_color']};
}

.rtl .wp-calendar-nav .wp-calendar-nav-prev a:after,
.rtl .wp-calendar-nav .wp-calendar-nav-next a:after{
    background-color: {$colors['bg_color']};
	color: {$colors['text_light']};      
}

.scheme_self.sidebar .widget_calendar td#prev a:before,
.scheme_self.sidebar .widget_calendar td#next a:before {
	background-color: {$colors['alter_bg_color']};
}
.widget_calendar thead {
	border-color: {$colors['bd_color']};
}

/* Categories */
.widget_categories li {
	color: {$colors['text_light']};
}
.scheme_self.sidebar .widget_categories li {
	color: {$colors['alter_dark']};
}

/* Recent posts */
.widget_recent_entries .post-date {
	color: {$colors['text_light']};
}
.scheme_self.widget_recent_entries .post-date {
	color: {$colors['alter_light']};
}

/* Recent comments */
.widget_recent_comments ul > li a {
	color: {$colors['text_hover']};
}
.widget_recent_comments ul > li a:hover {
	color: {$colors['text_link']};
}

/* RSS */
.widget_rss .widget_title a:first-child {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child {
	color: {$colors['alter_link']};
}
.widget_rss .widget_title a:first-child:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child:hover {
	color: {$colors['alter_hover']};
}
.widget_rss .rss-date {
	color: {$colors['text_light']};
}
.scheme_self.sidebar .widget_rss .rss-date {
	color: {$colors['alter_light']};
}

/* Tag cloud */
.sc_edd_details .downloads_page_tags .downloads_page_data > a,
.widget_product_tag_cloud a,
.widget_tag_cloud a,
.post_meta .post_tags a,
.wp-block-tag-cloud a {
	color: {$colors['text_light']};
	background-color: {$colors['bd_color']};
}
.scheme_self.sidebar .sc_edd_details .downloads_page_tags .downloads_page_data > a,
.scheme_self.sidebar .widget_product_tag_cloud a,
.scheme_self.sidebar .widget_tag_cloud a {
	color: {$colors['text_light']};
	background-color: {$colors['bd_color']};
}

.post_meta .post_tags a:hover,
.post_item_single .post_content .post_tags a:hover,
.sc_edd_details .downloads_page_tags .downloads_page_data > a:hover,
.widget_product_tag_cloud a:hover,
.widget_tag_cloud a:hover,
.wp-block-tag-cloud a:hover {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .sc_edd_details .downloads_page_tags .downloads_page_data > a:hover,
.scheme_self.sidebar .widget_product_tag_cloud a:hover,
.scheme_self.sidebar .widget_tag_cloud a:hover {
	background-color: {$colors['alter_link']};
}



/* Footer
--------------------------------- */
.scheme_self.footer_wrap .footer_menu_wrap,
.footer_wrap .scheme_self.vc_row {
	background-color: {$colors['alter_bg_color']};
	color: {$colors['alter_text']};
}
.scheme_self.footer_wrap .widget,
.scheme_self.footer_wrap .sc_content .wpb_column,
.footer_wrap .scheme_self.vc_row .widget,
.footer_wrap .scheme_self.vc_row .sc_content .wpb_column {
	background-color: {$colors['alter_bg_color']};
}
.scheme_self.footer_wrap h1, .scheme_self.footer_wrap h2, .scheme_self.footer_wrap h3,
.scheme_self.footer_wrap h4, .scheme_self.footer_wrap h5, .scheme_self.footer_wrap h6,
.scheme_self.footer_wrap h1 a, .scheme_self.footer_wrap h2 a, .scheme_self.footer_wrap h3 a,
.scheme_self.footer_wrap h4 a, .scheme_self.footer_wrap h5 a, .scheme_self.footer_wrap h6 a,
.footer_wrap .scheme_self.vc_row h1, .footer_wrap .scheme_self.vc_row h2, .footer_wrap .scheme_self.vc_row h3,
.footer_wrap .scheme_self.vc_row h4, .footer_wrap .scheme_self.vc_row h5, .footer_wrap .scheme_self.vc_row h6,
.footer_wrap .scheme_self.vc_row h1 a, .footer_wrap .scheme_self.vc_row h2 a, .footer_wrap .scheme_self.vc_row h3 a,
.footer_wrap .scheme_self.vc_row h4 a, .footer_wrap .scheme_self.vc_row h5 a, .footer_wrap .scheme_self.vc_row h6 a {
	color: {$colors['alter_dark']};
}
.scheme_self.footer_wrap h1 a:hover, .scheme_self.footer_wrap h2 a:hover, .scheme_self.footer_wrap h3 a:hover,
.scheme_self.footer_wrap h4 a:hover, .scheme_self.footer_wrap h5 a:hover, .scheme_self.footer_wrap h6 a:hover,
.footer_wrap .scheme_self.vc_row h1 a:hover, .footer_wrap .scheme_self.vc_row h2 a:hover, .footer_wrap .scheme_self.vc_row h3 a:hover,
.footer_wrap .scheme_self.vc_row h4 a:hover, .footer_wrap .scheme_self.vc_row h5 a:hover, .footer_wrap .scheme_self.vc_row h6 a:hover {
	color: {$colors['alter_link']};
}
.scheme_self.footer_wrap .widget li:before,
.footer_wrap .scheme_self.vc_row .widget li:before {
	background-color: {$colors['alter_link']};
}

/* Posts in widgets */
.scheme_self.footer_wrap .post_meta,
.scheme_self.footer_wrap .post_meta_item,
.scheme_self.footer_wrap .post_meta_item:after,
.scheme_self.footer_wrap .post_meta_item:hover:after,
.scheme_self.footer_wrap .post_meta .vc_inline-link,
.scheme_self.footer_wrap .post_meta .vc_inline-link:after,
.scheme_self.footer_wrap .post_meta .vc_inline-link:hover:after,
.scheme_self.footer_wrap .post_meta_item a,
.scheme_self.footer_wrap .post_info .post_info_item,
.scheme_self.footer_wrap .post_info .post_info_item a,
.scheme_self.footer_wrap .post_info_counters .post_counters_item,
.scheme_self.footer_wrap .post_counters .socials_share .socials_caption:before,
.scheme_self.footer_wrap .post_counters .socials_share .socials_caption:hover:before {
	color: {$colors['alter_light']};
}
.scheme_self.footer_wrap .post_date a:hover,
.scheme_self.footer_wrap a.post_meta_item:hover,
.scheme_self.footer_wrap .post_meta_item a:hover,
.scheme_self.footer_wrap .post_meta .vc_inline-link:hover,
.scheme_self.footer_wrap .post_info .post_info_item a:hover,
.scheme_self.footer_wrap .post_info_counters .post_counters_item:hover {
	color: {$colors['alter_dark']};
}
.scheme_self.footer_wrap .post_item .post_title a:hover {
	color: {$colors['alter_link']};
}

.scheme_self.footer_wrap .post_meta_item.post_categories,
.scheme_self.footer_wrap .post_meta_item.post_categories a {
	color: {$colors['alter_link']};
}
.scheme_self.footer_wrap .post_meta_item.post_categories a:hover {
	color: {$colors['alter_hover']};
}

.scheme_self.footer_wrap .post_meta_item .socials_share .social_items {
	background-color: {$colors['alter_bg_color']};
}
.scheme_self.footer_wrap .post_meta_item .social_items,
.scheme_self.footer_wrap .post_meta_item .social_items:before {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_light']};
}


.footer_logo_inner {
	border-color: {$colors['alter_bd_color']};
}
.footer_logo_inner:after {
	background-color: {$colors['alter_text']};
}
.footer_socials_inner .social_item .social_icon {
	color: {$colors['alter_text']};
}
.footer_socials_inner .social_item:hover .social_icon {
	color: {$colors['alter_dark']};
}
.menu_footer_nav_area ul li a {
	color: {$colors['alter_dark']};
}
.menu_footer_nav_area ul li a:hover {
	color: {$colors['alter_link']};
}
.menu_footer_nav_area ul li+li:before {
	border-color: {$colors['alter_light']};
}
.menu_footer_nav_area > ul > li ul,
.footer_wrap .sc_layouts_menu > ul > li ul {
	border-color: {$colors['extra_bd_color']};
}

.footer_wrap .widget[class*="column-"],
.footer_widgets_wrap .widget {
	border-color:{$colors['inverse_bd_color']};
}

.footer_copyright_inner {
	background-color: {$colors['inverse_bd_color']};
	color: {$colors['text_dark']};
}
.footer_copyright_inner .copyright_text {
	color: {$colors['text']};
}


/* Content bookmark element */
.single .post_subtitle .post_meta_item:first-child,
.post_subtitle .post_meta_item:first-child a,
.content-bookmark {
	color: {$colors['inverse_text']};
	background-color: {$colors['extra_hover3']};
}
.single .post_subtitle .post_meta_item:first-child,
.post_subtitle .post_meta_item:first-child a {
	color: {$colors['inverse_text']};
}

a.content-bookmark:hover{
	color: {$colors['text_link']};
}
.content .post_subtitle .post_meta_item:first-child a,
.page .content .content-bookmark {
	background-color: {$colors['text_link2']};
}
.page .comments_list_wrap .comments_list_title,
.page .comments_list_wrap .content-bookmark,
.single .comments_list_wrap .comments_list_title,
.single .comments_list_wrap .content-bookmark {
	color: {$colors['inverse_text']};
	background-color: {$colors['alter_link2']};
}
.page .related_wrap .related_wrap_title,
.page .related_wrap .content-bookmark,
.single .related_wrap .related_wrap_title,
.single .related_wrap .content-bookmark {
	color: {$colors['inverse_text']};
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
	background-color: {$colors['extra_link']};
}
.single-format-video .post_subtitle .post_meta_item:first-child,
.format-video .post_subtitle .post_meta_item:first-child a,
.single-format-video .content-bookmark,
.format-video .content-bookmark {
	background-color: {$colors['extra_link2']};
}
.single-format-link .post_subtitle .post_meta_item:first-child,
.format-link .post_subtitle .post_meta_item:first-child a,
.single-format-link .content-bookmark,
.format-link .content-bookmark {
	background-color: {$colors['text_hover']};
}
.single-format-image .post_subtitle .post_meta_item:first-child,
.format-image .post_subtitle .post_meta_item:first-child a,
.single-format-image .content-bookmark,
.format-image .content-bookmark {
	background-color: {$colors['alter_link2']};
}
.single-format-gallery .post_subtitle .post_meta_item:first-child,
.format-gallery .post_subtitle .post_meta_item:first-child a,
.single-format-gallery .content-bookmark,
.format-gallery .content-bookmark {
	background-color: {$colors['input_bd_hover']};
}

/* Third-party plugins */

/* Lightboxes */
.mfp-bg,
.elementor-lightbox {
	background-color: {$colors['bg_color_07']};
}
.mfp-image-holder .mfp-close,
.mfp-iframe-holder .mfp-close,
.mfp-wrap .mfp-close {
	color: {$colors['text_link']};
	background-color: transparent;
}
.elementor-lightbox .dialog-lightbox-close-button,
.elementor-lightbox .elementor-swiper-button {
	color: {$colors['text_dark']};
	background-color: transparent;
}
.mfp-image-holder .mfp-close:hover,
.mfp-iframe-holder .mfp-close:hover,
.mfp-close-btn-in .mfp-close:hover {
	color: {$colors['text_hover']};
}
.elementor-lightbox .dialog-lightbox-close-button:hover,
.elementor-lightbox .elementor-swiper-button:hover {
	color: {$colors['text_link']};
}



.wp-block-cover p:not(.has-text-color) > strong,
.wp-block-cover p:not(.has-text-color) > a,
.wp-block-cover p:not(.has-text-color) {
	color: {$colors['inverse_text']};
}
.wp-block-cover p:not(.has-text-color) > a:hover{
	color: {$colors['text_hover3']};
}

.sidebar_inner .widget_contacts .socials_wrap.contacts_socials .social_item:hover .social_icon{
	color: {$colors['text_hover']};
}

CSS;

					$rez            = apply_filters(
						'shift_cv_filter_get_css', $rez, array(
							'colors' => $colors,
							'scheme' => $s,
						)
					);
					$css['colors'] .= $rez['colors'];
				}
			}
		}

		$css_str = ( ! empty( $css['vars'] ) ? $css['vars'] : '' )
				. ( ! empty( $css['fonts'] ) ? $css['fonts'] : '' )
				. ( ! empty( $css['colors'] ) ? $css['colors'] : '' );

		return apply_filters( 'shift_cv_filter_prepare_css', $css_str, $remove_spaces );
	}
}
