<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage SHIFT_CV
 * @since SHIFT_CV 1.0
 */

shift_cv_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	shift_cv_blog_archive_start();

	$shift_cv_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$shift_cv_sticky_out = shift_cv_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $shift_cv_stickies ) && count( $shift_cv_stickies ) > 0 && get_query_var( 'paged' ) < 1;

	// Show filters
	$shift_cv_cat          = shift_cv_get_theme_option( 'parent_cat' );
	$shift_cv_post_type    = shift_cv_get_theme_option( 'post_type' );
	$shift_cv_taxonomy     = shift_cv_get_post_type_taxonomy( $shift_cv_post_type );
	$shift_cv_show_filters = shift_cv_get_theme_option( 'show_filters' );
	$shift_cv_tabs         = array();
	if ( ! shift_cv_is_off( $shift_cv_show_filters ) ) {
		$shift_cv_args           = array(
			'type'         => $shift_cv_post_type,
			'child_of'     => $shift_cv_cat,
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 1,
			'hierarchical' => 0,
			'taxonomy'     => $shift_cv_taxonomy,
			'pad_counts'   => false,
		);
		$shift_cv_portfolio_list = get_terms( $shift_cv_args );
		if ( is_array( $shift_cv_portfolio_list ) && count( $shift_cv_portfolio_list ) > 0 ) {
			$shift_cv_tabs[ $shift_cv_cat ] = esc_html__( 'All', 'shift-cv' );
			foreach ( $shift_cv_portfolio_list as $shift_cv_term ) {
				if ( isset( $shift_cv_term->term_id ) ) {
					$shift_cv_tabs[ $shift_cv_term->term_id ] = $shift_cv_term->name;
				}
			}
		}
	}
	if ( count( $shift_cv_tabs ) > 0 ) {
		$shift_cv_portfolio_filters_ajax   = true;
		$shift_cv_portfolio_filters_active = $shift_cv_cat;
		$shift_cv_portfolio_filters_id     = 'portfolio_filters';
		?>
		<div class="portfolio_filters shift_cv_tabs shift_cv_tabs_ajax">
			<ul class="portfolio_titles shift_cv_tabs_titles">
				<?php
				foreach ( $shift_cv_tabs as $shift_cv_id => $shift_cv_title ) {
					?>
					<li><a href="<?php echo esc_url( shift_cv_get_hash_link( sprintf( '#%s_%s_content', $shift_cv_portfolio_filters_id, $shift_cv_id ) ) ); ?>" data-tab="<?php echo esc_attr( $shift_cv_id ); ?>"><?php echo esc_html( $shift_cv_title ); ?></a></li>
					<?php
				}
				?>
			</ul>
			<?php
			$shift_cv_ppp = shift_cv_get_theme_option( 'posts_per_page' );
			if ( shift_cv_is_inherit( $shift_cv_ppp ) ) {
				$shift_cv_ppp = '';
			}
			foreach ( $shift_cv_tabs as $shift_cv_id => $shift_cv_title ) {
				$shift_cv_portfolio_need_content = $shift_cv_id == $shift_cv_portfolio_filters_active || ! $shift_cv_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr( sprintf( '%s_%s_content', $shift_cv_portfolio_filters_id, $shift_cv_id ) ); ?>"
					class="portfolio_content shift_cv_tabs_content"
					data-blog-template="<?php echo esc_attr( shift_cv_storage_get( 'blog_template' ) ); ?>"
					data-blog-style="<?php echo esc_attr( shift_cv_get_theme_option( 'blog_style' ) ); ?>"
					data-posts-per-page="<?php echo esc_attr( $shift_cv_ppp ); ?>"
					data-post-type="<?php echo esc_attr( $shift_cv_post_type ); ?>"
					data-taxonomy="<?php echo esc_attr( $shift_cv_taxonomy ); ?>"
					data-cat="<?php echo esc_attr( $shift_cv_id ); ?>"
					data-parent-cat="<?php echo esc_attr( $shift_cv_cat ); ?>"
					data-need-content="<?php echo ( false === $shift_cv_portfolio_need_content ? 'true' : 'false' ); ?>"
				>
					<?php
					if ( $shift_cv_portfolio_need_content ) {
						shift_cv_show_portfolio_posts(
							array(
								'cat'        => $shift_cv_id,
								'parent_cat' => $shift_cv_cat,
								'taxonomy'   => $shift_cv_taxonomy,
								'post_type'  => $shift_cv_post_type,
								'page'       => 1,
								'sticky'     => $shift_cv_sticky_out,
							)
						);
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		shift_cv_show_portfolio_posts(
			array(
				'cat'        => $shift_cv_cat,
				'parent_cat' => $shift_cv_cat,
				'taxonomy'   => $shift_cv_taxonomy,
				'post_type'  => $shift_cv_post_type,
				'page'       => 1,
				'sticky'     => $shift_cv_sticky_out,
			)
		);
	}

	shift_cv_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'shift_cv_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
