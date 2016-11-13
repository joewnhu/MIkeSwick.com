<?php
add_filter( 'vwspc_filter_init_sections', 'vw_extend_filter_init_sections' );
if ( ! function_exists( 'vw_extend_filter_init_sections' ) ) {
	function vw_extend_filter_init_sections( $available_sections ) {
		$extended_sections = array(
			
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
 * Render Section: Page Box with Sidebar
 * -------------------------------------------------------------------------- */
add_action( 'vwspc_action_render_section_page_box_sidebar', 'vw_render_spc_section_page_box_sidebar' );
if ( ! function_exists( 'vw_render_spc_section_page_box_sidebar' ) ) {
	function vw_render_spc_section_page_box_sidebar( $args ) {
		extract( $args );
		$number_of_post = get_post_meta( $page_id, $field_prefix.'_number', true );
	//	$offset = intval( get_post_meta( $page_id, $field_prefix.'_offset', true ) );
		$layout = get_post_meta( $page_id, $field_prefix.'_layout', true );
		$title = get_post_meta( $page_id, $field_prefix.'_title', true );
	//	$category = get_post_meta( $page_id, $field_prefix.'_category', true );
	//	$exclude_categories = get_post_meta( $page_id, $field_prefix.'_exclude_categories', true );
	//	$posts_order = get_post_meta( $page_id, $field_prefix.'_posts_order', true );
		$pagination = get_post_meta( $page_id, $field_prefix.'_pagination', true );
		$sidebar = get_post_meta( $page_id, $field_prefix.'_sidebar', true );
	//	$paged = vw_get_paged();

		$title_class = '';
		$additional_classes = ' '; // Need a space
		$additional_classes .= 'vwspc-post-box-layout-'.$layout;

		printf( $before_section, esc_attr( 'post-box-sidebar'.$additional_classes ), esc_attr( vwspc_next_section_id() ) );

		$query_args = array(
			'post_type' 		=> 'page',
			'post_parent' 		=> get_the_id(),
			'orderby' 			=> 'post_date',
			'order' 			=> 'DESC',
			'posts_per_page' 	=> $number_of_post,
			'meta_query' 		=> array(),
			'post_status' 		=> 'publish'

		);
		
		
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