<?php
/*
Template Name: Gym
*/
get_header(); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main">
			<?php
				$url = home_url(add_query_arg(array(),$wp->request));


				$country = substr ( $url , 35	  );

				if ($country == "UNITED-ARAB-EMIRATES-UAE") : {
					$country = 'UNITED ARAB EMIRATES (UAE)';
				}
				endif;
			?>	

	
			<h1> Gyms in <?php echo $country; ?> </h1>

			<?php
 


			  $args = array(

			    'post_type' => 'Gym',

			    'meta_key' => gym_country,

			    'meta_value' => $country,
				
				'orderby' => 'gym_preferred','title',	

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

			      $description = get_the_content();

			      $gym_address_line_1 = get_field('gym_address_line_1');

			      $gym_address_line_2 = get_field('gym_address_line_2');

			      $gym_city = get_field('gym_city');

			      $gym_country = get_field('gym_country');

			      $gym_state = get_field('gym_state');

			      $gym_website = get_field('gym_website');

			      $gym_phone_number = get_field('gym_phone_number');

			      $gym_email = get_field('gym_email');

			      $gym_featured = get_field('gym_featured');



			      $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

			      $gym_image1 = $featured_image[0];

			      

			      // Output

			      ?>

			      <div class=”product”>

					<p><a href="<?php echo $gym_website; ?>"  target=”_blank”><h2><?php echo $title; ?></h2></a> </p>
			        <div><?php echo $gym_address_line_1; ?></div>
			        <div><?php echo $gym_address_line_2; ?></div>
			        <div><?php echo $gym_city; ?></div>
			        <div><?php echo $gym_phone_number; ?></div>
			        <div><?php echo $gym_email; ?></div>

					<!-- <div><?php echo $country; ?></div>	-->		        

			        <!-- <div><?php echo $url; ?></div>	-->


			        <!-- <img src=”<?php echo $gym_image1;  ?>” alt=”product-detail” class=”product-detail align-right”>  -->

			        <?php echo $description; ?>

			        

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