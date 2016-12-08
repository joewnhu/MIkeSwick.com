<?php
add_filter( 'vwspc_filter_init_sections', 'vw_extend_filter_init_sections' );
if ( ! function_exists( 'vw_extend_filter_init_sections' ) ) {
	function vw_extend_filter_init_sections( $available_sections ) {
		$extended_sections = array(

			'post_w_events_box_sidebar' => array(
				'title' =>'Post / Event Post Box with Sidebar',
				'options' => array(
					'title' => array(
						'title' => 'Title',
						'description' => 'Enter the title',
						'field' => 'text',
						'default' => '',
					),
					'number' => array(
						'title' => 'Number of post',
						'description' => 'Enter the number',
						'field' => 'number',
						'default' => 5,
					),
					'offset' => array(
						'title' => 'Post Offset',
						'description' => 'Enter the number of the first posts to be skipped',
						'field' => 'number',
						'default' => 0,
					),
					'category' => array(
						'title' => 'Category',
						'description' => 'Choose a post category to be shown up',
						'field' => 'category_with_all_option',
						'default' => '0',
					),
					'exclude_categories' => array(
						'title' => 'Exclude Categories',
						'description' => 'Choose the post categories to be excluded',
						'field' => 'categories',
						'default' => '',
					),
					'posts_order' => array(
						'title' => 'Posts Order',
						'description' => 'Choose the post s ordering',
						'field' => 'select',
						'default' => 'latest_posts',
						'options' => array(
							'latest_posts' => 'Latest Posts',
							'latest_gallery_posts' => 'Latest Gallery Posts',
							'latest_video_posts' => 'Latest Video Posts',
							'latest_audio_posts' => 'Latest Audio Posts',
							'latest_featured' => 'Latest Featured Posts',
							'latest_reviews' => 'Latest Reviews',
							'most_viewed' => 'Most Viewed',
							'most_review_scores' => 'Most Review Scores',
						),
					),
					'layout' => array(
						'title' => 'Layout',
						'description' => 'Choose the post box layout',
						'field' => 'select',
						'default' => 'classic',
						'options' => array(
							'classic' => 'Classic',
							'slider-carousel' => 'Carousel',
							'box-grid-3-col' => 'Box grid - 3 columns',
							'block-grid-2-col' => 'Block grid - 2 columns',
							'block-2-grid-3-col' => 'Block grid (2) - 3 Columns',
							'masonry-grid-2-col' => 'Masonry grid - 2 columns',
							'custom-1' => 'Custom 1',
							'custom-2' => 'Custom 2',
							'custom-3' => 'Custom 3',
							'custom-4' => 'Custom 4',
						),
					),
					'pagination' => array(
						'title' => 'Pagination',
						'description' => 'Show pagination',
						'field' => 'select',
						'default' => 'hide',
						'options' => array(
							'hide' => 'Hide',
							'show' => 'Numeric pagination',
							'infinite' => 'Infinite scrolling (Auto loading)',
							'infinite-load-more' => 'Infinite scrolling (Manual loading)',
						),
					),
					'sidebar' => array(
						'title' => 'Sidebar',
						'description' => 'Choose a sidebar to be shown up',
						'field' => 'sidebar',
						'default' => '0',
					),
				),
			),
			
			'page_box_sidebar' => array(
				'title' =>'Page Box with Sidebar',
				'options' => array(
					'title' => array(
						'title' => 'Title',
						'description' => 'Enter the title',
						'field' => 'text',
						'default' => '',
					),
					'number' => array(
						'title' => 'Number of pages',
						'description' => 'Enter the number',
						'field' => 'number',
						'default' => 5,
					),
					'layout' => array(
						'title' => 'Layout',
						'description' => 'Choose the post box layout',
						'field' => 'select',
						'default' => 'classic',
						'options' => array(
							'classic' => 'Classic',
							'slider-carousel' => 'Carousel',
							'box-grid-3-col' => 'Box grid - 3 columns',
							'block-grid-2-col' => 'Block grid - 2 columns',
							'block-2-grid-3-col' => 'Block grid (2) - 3 Columns',
							'masonry-grid-2-col' => 'Masonry grid - 2 columns',
							'custom-1' => 'Custom 1',
							'custom-2' => 'Custom 2',
							'custom-3' => 'Custom 3',
							'custom-4' => 'Custom 4',
						),
					),
					'pagination' => array(
						'title' => 'Pagination',
						'description' => 'Show pagination',
						'field' => 'select',
						'default' => 'hide',
						'options' => array(
							'hide' => 'Hide',
							'show' => 'Numeric pagination',
							'infinite' => 'Infinite scrolling (Auto loading)',
							'infinite-load-more' => 'Infinite scrolling (Manual loading)',
						),
					),
					'sidebar' => array(
						'title' => 'Sidebar',
						'description' => 'Choose a sidebar to be shown up',
						'field' => 'sidebar',
						'default' => '0',
					),
				),
			),

		);

		return array_merge( $extended_sections, $available_sections);
	}
}

/* -----------------------------------------------------------------------------
 * Render Section: Post Box with Sidebar
 * -------------------------------------------------------------------------- */
add_action( 'vwspc_action_render_section_post_w_events_box_sidebar', 'vw_render_spc_section_post_w_events_box_sidebar' );
if ( ! function_exists( 'vw_render_spc_section_post_w_events_box_sidebar' ) ) {
	function vw_render_spc_section_post_w_events_box_sidebar( $args ) {
		extract( $args );
		$number_of_post = get_post_meta( $page_id, $field_prefix.'_number', true );
		$offset = intval( get_post_meta( $page_id, $field_prefix.'_offset', true ) );
		$layout = get_post_meta( $page_id, $field_prefix.'_layout', true );
		$title = get_post_meta( $page_id, $field_prefix.'_title', true );
		$category = get_post_meta( $page_id, $field_prefix.'_category', true );
		$exclude_categories = get_post_meta( $page_id, $field_prefix.'_exclude_categories', true );
		$posts_order = get_post_meta( $page_id, $field_prefix.'_posts_order', true );
		$pagination = get_post_meta( $page_id, $field_prefix.'_pagination', true );
		$sidebar = get_post_meta( $page_id, $field_prefix.'_sidebar', true );
		$paged = vw_get_paged();

		$title_class = '';
		$additional_classes = ' '; // Need a space
		$additional_classes .= 'vwspc-post-box-layout-'.$layout;

		printf( $before_section, esc_attr( 'post-box-sidebar'.$additional_classes ), esc_attr( vwspc_next_section_id() ) );

		$query_args = array(
			'post_type' => array('post','fight_events'),
			'paged' => $paged,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'ignore_sticky_posts' => true,
			'posts_per_page' => $number_of_post,
			'meta_query' => array(),
		);

		if ( $offset > 0 ) {
			$query_args['offset'] = $offset;

			if ( $paged > 1 ) {
				// Wordpress is not support Offset on Pagination. This is a hack.
				$query_args['offset'] += ( $paged - 1 ) * $number_of_post;
			}
		}

		if ( ! empty( $category ) ) {
			$query_args['cat'] = $category;
			
			if ( ! empty( $title ) ) {
				$title_class .= ' '.vw_get_the_category_class( $category );
			}
		}

		if ( ! empty( $exclude_categories ) ) {
			$query_args['category__not_in'] = explode( ',', $exclude_categories );
		}

		if ( $posts_order == 'latest_posts' ) {
			// do nothing, it's a default ordering

		} elseif ( $posts_order == 'latest_gallery_posts' ) {
			$query_args['tax_query'] =  array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-gallery' )
				)
			);

		} elseif ( $posts_order == 'latest_video_posts' ) {
			$query_args['tax_query'] =  array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-video' )
				)
			);

		} elseif ( $posts_order == 'latest_audio_posts' ) {
			$query_args['tax_query'] =  array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-audio' )
				)
			);

		} elseif ( $posts_order == 'latest_featured' ) {
			$query_args['meta_query'][] = array(
				'key' => 'vw_post_featured',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( $posts_order == 'latest_reviews' ) {
			$query_args['meta_query'][] = array(
				'key' => 'vw_enable_review',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( $posts_order == 'most_review_scores' ) {
			$query_args['orderby'] = 'meta_value_num';
			$query_args['meta_key'] = 'vw_review_average_score';
			$query_args['meta_query'][] = array(
				'key' => 'vw_enable_review',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( $posts_order == 'most_viewed' ) {
			$query_args['orderby'] = 'meta_value_num';
			$query_args['meta_key'] = 'vw_post_views_all';

		}

		// ==== Begin temp query =====================================
		// $query_args['p'] = 1292;
		// $query_args['post__in'] = array( 1292, 1304 );
		// $query_args['meta_query'][] = array(
		// 	'key' => '_thumbnail_id',
		// 	'compare' => 'EXISTS'
		// );
		// ==== End temp query =====================================
		
		query_posts( $query_args );

		$template_file = sprintf( 'templates/post-loop/loop-%s.php', $layout );

		?>
		<div class="container">

			<div class="row">
				<div class="col-md-8 vwspc-section-content">
					<?php if ( ! empty ( $title ) ) : ?>
					<h2 class="vwspc-section-title"><?php printf( '<span class="%2$s">%1$s</span>', esc_attr( $title ), esc_attr( $title_class ) ); ?></h2>
					<?php endif; ?>

					<?php include( locate_template( $template_file, false, false ) ); ?>

					<?php if ( 'hide' != $pagination ) vw_the_pagination( $pagination ); ?>
				</div>
				<div class="col-md-4 vwspc-section-sidebar">
					<?php dynamic_sidebar( $sidebar ); ?>
				</div>
			</div>
			
		</div>
		<?php
		echo $after_section;
		wp_reset_query();
	}
}


?>