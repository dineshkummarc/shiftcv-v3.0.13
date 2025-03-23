<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

$shift_cv_seo = shift_cv_is_on( shift_cv_get_theme_option( 'seo_snippets' ) );
// Post meta
$shift_cv_components = explode( ',', shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'meta_parts' ) ) );
$shift_cv_counters   = shift_cv_array_get_keys_by_value( shift_cv_get_theme_option( 'counters' ) );
?>

<article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item_single post_type_' . esc_attr( get_post_type() )
												. ' post_format_' . esc_attr( str_replace( 'post-format-', '', get_post_format() ) )
									);
									if ( $shift_cv_seo ) {
										?>
			itemscope="itemscope" 
			itemprop="articleBody" 
			itemtype="//schema.org/<?php echo esc_attr( shift_cv_get_markup_schema() ); ?>"
			itemid="<?php echo esc_url( get_the_permalink() ); ?>"
			content="<?php the_title_attribute(); ?>"
										<?php
									}
									?>
>
<?php

	$meta_top = '';
	foreach ( $shift_cv_components as $key => $shift_cv_component ) {
		if ( in_array( $shift_cv_component, array( 'date', 'author', 'counters' ) ) ) {
			$meta_top .= $shift_cv_component . ',';
			unset($shift_cv_components[$key]);
		}
	}
	if ( empty( $meta_top ) ) {
		$meta_top = 'date';
	}
	// Article top info (date, author, comments)
	?><div class="post_subtitle"><?php
		shift_cv_show_post_meta(
			apply_filters(
				'shift_cv_filter_post_meta_args', array(
					'components' => $meta_top,
					'counters'   => $shift_cv_counters,
				)
			)
		);
	?></div><div class="post_inner"><?php

	do_action( 'shift_cv_action_before_post_data' );

	// Structured data snippets
	if ( $shift_cv_seo ) {
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/seo' ) );
	}
	// Title and post meta
	if ( ( ! shift_cv_sc_layouts_showed( 'title' ) || ! shift_cv_sc_layouts_showed( 'postmeta' ) ) && ! in_array( get_post_format(), array( 'link', 'aside', 'status', 'quote' ) ) ) {
		do_action( 'shift_cv_action_before_post_title' );
		?>
			<div class="post_header post_header_single entry-header">
			<?php
			// Post title
			if ( ! shift_cv_sc_layouts_showed( 'title' ) ) {
				the_title( '<h2 class="post_title entry-title"' . ( $shift_cv_seo ? ' itemprop="headline"' : '' ) . '>', '</h2>' );
			}
			?>
			</div><!-- .post_header -->
			<?php
			do_action( 'shift_cv_action_after_post_title' );
	}


	// Featured image
	if ( shift_cv_is_off( shift_cv_get_theme_option( 'hide_featured_on_single' ) )
		&& ! shift_cv_sc_layouts_showed( 'featured' )
		&& strpos( get_the_content(), '[trx_widget_banner]' ) === false ) {
		do_action( 'shift_cv_action_before_post_featured' );
		$shift_cv_expanded   = ! shift_cv_sidebar_present() && shift_cv_is_on( shift_cv_get_theme_option( 'expand_content' ) );
		shift_cv_show_post_featured(array(
			'thumb_ratio'   => '610:407',
			'thumb_size' => shift_cv_get_thumb_size( strpos( shift_cv_get_theme_option( 'body_style' ), 'full' ) !== false ? 'full' : ( $shift_cv_expanded ? 'huge' : 'big' ) ),
		));
		do_action( 'shift_cv_action_after_post_featured' );
	} elseif ( has_post_thumbnail() ) {
		?>
		<meta itemprop="image" itemtype="//schema.org/ImageObject" content="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>">
		<?php
	}

	do_action( 'shift_cv_action_before_post_content' );

	// Post content
	?><div class="post_content post_content_single entry-content" itemprop="mainEntityOfPage">
		<?php
		the_content();

		do_action( 'shift_cv_action_before_post_pagination' );

		wp_link_pages(
			array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'shift-cv' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'shift-cv' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			)
		);

		// Taxonomies and share
		if ( is_single() && ! is_attachment() ) {

			do_action( 'shift_cv_action_before_post_meta' );

			// Post meta
			if (  ! shift_cv_sc_layouts_showed( 'postmeta' ) && shift_cv_is_on( shift_cv_get_theme_option( 'show_post_meta' ) ) ) {
				shift_cv_show_post_meta(
					apply_filters(
						'shift_cv_filter_post_meta_args', array(
						'components' => implode( ',', $shift_cv_components ),
						'counters'   => '',
						'seo'        =>  shift_cv_is_on( shift_cv_get_theme_option( 'seo_snippets' ) ),
					), 'single', 1
					)
				);
			}


			// Post rating
			do_action(
				'trx_addons_action_post_rating', array(
					'class'                => 'single_post_rating',
					'rating_text_template' => esc_html__( 'Post rating: {{X}} from {{Y}} (according {{V}})', 'shift-cv' ),
				)
			);

            //			---------------
            if ( ! shift_cv_exists_trx_addons() ) {
                $args_ut = array_merge(
                    array(
                        'components' => 'categories,tags'
                    )
                );
                shift_cv_show_post_meta($args_ut);
            }
            //            ---------------

			// Share
			if ( shift_cv_is_on( shift_cv_get_theme_option( 'show_share_links' ) ) ) {
				?><div class="post_meta post_meta_single"><?php
				shift_cv_show_share_links(
					array(
						'type'    => 'list',
						'caption' => '',
						'before'  => '<span class="post_meta_item post_share">',
						'after'   => '</span>',
					)
				);
				?></div><?php

			}
			do_action( 'shift_cv_action_after_post_meta' );
		}
		?>
	</div><!-- .entry-content -->

	<?php
	do_action( 'shift_cv_action_after_post_content' );
	?></div><!-- post_inner --><?php
	// Author bio
	if ( shift_cv_get_theme_option( 'show_author_info' ) == 1 && is_single() && ! is_attachment() && get_the_author_meta( 'description' ) ) {
		do_action( 'shift_cv_action_before_post_author' );
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'templates/author-bio' ) );
		do_action( 'shift_cv_action_after_post_author' );
	}

	do_action( 'shift_cv_action_after_post_data' );
	?>
</article>
