<?php
/*
Template Name: Result
*/
get_header(); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" align = "center" role="main">


	
			 <h1> Top 12 Organizations </h1>
			<?php
 


			  $args = array(

			    'post_type' => 'Result',
				
				'orderby' => 'result_date','organization',	

				'order' => ASC,		    

			    'post_status' => 'publish',

			    'posts_per_page' => '10'

			  );

			  $gym_loop = new WP_Query( $args );

			  if ( $gym_loop->have_posts() ) :

				do_action( 'vw_action_before_single_post' ); 

			    while ( $gym_loop->have_posts() ) : $gym_loop->the_post();

			      // Set variables

			      $title = get_the_title();

			      $id = get_field('id');

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

					<p><h2><a href="http://localhost/mikeswickcom/fight-results/event?event=<?php echo $id; ?>" ><?php echo $title; ?> - <?php echo $result_date; ?></a></h2></p>



			        <!-- <img src=”<?php echo $gym_image1;  ?>” alt=”product-detail” class=”product-detail align-right”>  -->


			        

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