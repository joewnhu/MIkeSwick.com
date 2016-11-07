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

			    'post_type' => 'fight_events',

			    'meta_key' => 'event_organization',

			    'meta_value' => '-other',
				
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

			      $result_date = get_field('result_date');

			      $result_name = get_field('result_name');

			      $result_featured = get_field('result_featured');

			      $result_organization = get_field('result_organization');

			      $result_main_card = get_field('result_main_card');

			      $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

			      $result_image1 = $featured_image[0];

			      

			      // Output

			      ?>

			      <div class=”product”>

					<h2><a href="http://localhost/mikeswickcom/fight-results/event?event=<?php echo $id; ?>" ><?php echo $title; ?> - <?php echo $result_date; ?></a></h2>			        

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