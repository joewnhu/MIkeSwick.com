<?php
/*
Template Name: Fight Results
*/
get_header(); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" align = "center" role="main">


	
			 <h1> Fight Results </h1>
			<?php
 


			  $args = array(

			    'post_type' 		=> 'fight_events',
			    'meta_sort_key' 	=> 'event_date',
			    'orderby'			=> 'meta_sort_key',
				'meta_query'		=> array(
					'relation'		=> 'AND',
					array(
						'key'		=> 'event_results_completed',
						'value'		=> true,
						'compare'	=> 'LIKE'
					)/*,
					//hides non major orginizations
					array(
						'key'		=> 'event_organization',
						'value'		=> 'other',
						'compare'	=> 'NOT LIKE'
					)*/
				),
				
				'order' => 'ASC',		    
			    'post_status' => 'publish',

			    'posts_per_page' => '10'

			  );

			  $result_loop = new WP_Query( $args );

			  if ( $result_loop->have_posts() ) :

				do_action( 'vw_action_before_single_post' ); 

			    while ( $result_loop->have_posts() ) : $result_loop->the_post();

			      // Set variables

			      $title = get_the_title();

			      $description = get_the_content();

			      $result_date = get_field('event_date');

			      $result_organization = get_field('event_organization');

			      $result_main_card = get_field('fight_card');

			      $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

			      $result_image1 = $featured_image[0];

			      

			      // Output

			      ?>

				<div class="vw-post-loop vw-post-loop-classic">	
					<div class="row">
						<div class="col-sm-12 vw-post-loop-inner">
							
								<?php get_template_part( 'templates/post-loop/post-masonary-grid-2-col', get_post_format() ); ?>

						</div>
					</div>
				</div>		      

			      <?php endwhile;?>

			    <?php wp_reset_postdata(); ?>

			  <?php endif; ?>


					

					<?php do_action( 'vw_action_after_single_post' ); ?>

					<?php vw_the_post_footer_sections(); ?>



			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>