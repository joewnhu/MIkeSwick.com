<?php
/*
Template Name: Event
*/
get_header(); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main">
			<?php
				$url = home_url(add_query_arg(array(),$wp->request));
			?>	

			<?php  $event = get_query_var( 'event', 1 );  
 
			  $args = array(

			    'post_type' => 'fight_events',

			    'meta_key' => 'id',

			    'meta_value' => $event,

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

			      $result_location = get_field('result_location');

			      $fight_poster = get_field('fight_poster');

			      $result_organization = get_field('result_organization');

			      $result_main_card = get_field('result_main_card');

			      $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

			      $result_image1 = $featured_image[0];


			  ?>    


			      

			      <div class=”product”>

					<h2><?php echo $title; ?></h2>
			        <h2><?php echo $result_location; ?></h2>
			        <h2><?php echo $result_date; ?></h2>

			        <?php 

						$fight_poster = get_field('fight_poster');

						if( !empty($fight_poster) ): ?>

							<img src="<?php echo $fight_poster['url']; ?>" alt="<?php echo $fight_poster['alt']; ?>" />

					<?php endif; ?>
			        			       
			      <?php if( have_rows('fight_results') ): ?>

					<ul class="slides">

	<?php while( have_rows('fight_results') ): the_row(); 

		// vars
		$winner = get_sub_field('fighter_a');
		$loser = get_sub_field('fighter_b');
		$method = get_sub_field('method');
		$round = get_sub_field('round');
		$time = get_sub_field('time');

		?>

		<li class="slide">

		<div> <?php echo $winner ; ?> defeats  <?php echo $loser ; ?> via <?php echo $method ; ?> - Round <?php echo $round ; ?>, <?php echo $time ; ?></div>

			<?php if( $link ): ?>
				<a href="<?php echo $link; ?>">
			<?php endif; ?>

				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />

			<?php if( $link ): ?>
				</a>
			<?php endif; ?>

		    <?php echo $content; ?>

		</li>

	<?php endwhile; ?>

	</ul>

<?php endif; ?>


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