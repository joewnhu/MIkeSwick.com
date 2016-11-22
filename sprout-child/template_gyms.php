<?php
/*
Template Name: Gyms
*/
get_header(); 

?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div id="vw-page-content" class="vw-page-content" role="main">
				<?php the_content(); ?>

				<?php $perma = get_permalink();
 					if ( have_posts() ) : ?>
				
				<?php global $wp_query;
					$country ='';
					$state = '';
					$first = true;

					if (array_key_exists('country_slug', $wp_query->query_vars)){
						$country = $wp_query->query_vars['country_slug'];
					}
					if (array_key_exists('state_slug', $wp_query->query_vars)){
						$state =  strtoupper($wp_query->query_vars['state_slug']);
					}
					?>

					<?php if($state != '') : ?>
						<?php $us_args = array(
						    'post_type' 		=> 'gym',
						    'orderby'			=> 'title',
							'meta_query'		=> array(
								'relation'		=> 'AND',
								array(
									'key'		=> 'gym_country',
									'value'		=> 'united_states',
									'compare'	=> 'LIKE'
								),
								array(
									'key'		=> 'gym_state',
									'value'		=> $state,
									'compare'	=> 'LIKE'
								)

							),
							'order' => 'ASC',		    
						    'post_status' => 'publish',
						    'posts_per_page' => 15
						);
						$us_loop = new WP_Query( $us_args ); 
  						$GLOBALS['wp_query'] = $us_loop; 
  						?>

						

				<?php do_action( 'vw_action_before_single_post' ); 
			    if($us_loop->have_posts()) : while ( $us_loop->have_posts() ) :  $us_loop->the_post();?>
					 <?php if($first): 
						$gym_state = get_field_object('gym_state');
						$gym_state = $gym_state['choices'][$state];
					?>
					 <div class="vw-page-title-box clearfix">
							<div class="vw-page-title-box-inner">
								<h1 class="entry-title" <?php vw_itemprop('headline'); ?>><?php echo $gym_state; ?></h1>
							</div>
						</div>
						<?php $first = false;?>
					<?php endif; ?>

					 <div class="vw-post-loop vw-post-loop-classic">	
						<div class="row">
							<div class="col-sm-12 vw-post-loop-inner">
								<?php get_template_part( 'templates/post-loop/post-gym-listing-1-col', get_post_format() ); ?>
							</div>
						</div>
					</div>
			    <?php endwhile; else : ?>
					<h1 class="entry-title" <?php vw_itemprop('headline'); ?>No gyms listings for this area</h1>
			    <?php endif;?>

			    <?php wp_reset_postdata(); ?>


					<?php elseif($country != '') : ?>
						<?php $int_args = array(
						    'post_type' 		=> 'gym',
						    'orderby'			=> 'title',
							'meta_query'		=> array(
								'relation'		=> 'AND',
								array(
									'key'		=> 'gym_country',
									'value'		=> $country,
									'compare'	=> 'LIKE'
								)
							),
							'order' => 'ASC',		    
						    'post_status' => 'publish',
						    'posts_per_page' => 15
						);

						$int_loop = new WP_Query( $int_args );
						$GLOBALS['wp_query'] = $int_loop;?>
	 					<?php if($int_loop->have_posts()) :  while ( $int_loop->have_posts() ) :  $int_loop->the_post();
 							$gym_country = get_field_object('gym_country');
							$gym_country = $gym_country['choices'][$country];?>
							<?php if($first): ?>
							 	<div class="vw-page-title-box clearfix">
									<div class="vw-page-title-box-inner">
										<h1 class="entry-title" <?php vw_itemprop('headline'); ?>><?php echo $gym_country; ?></h1>
									</div>
								</div>
								<?php $first = false;?>

							<?php endif; ?>
						

						 <div class="vw-post-loop vw-post-loop-classic">	
							<div class="row">
								<div class="col-sm-12 vw-post-loop-inner">
									<?php get_template_part( 'templates/post-loop/post-gym-listing-1-col', get_post_format() ); ?>
								</div>
							</div>
						</div>
				    <?php endwhile; else : ?>
						<h1 class="entry-title" <?php vw_itemprop('headline'); ?>No gyms listings for this area</h1>
			    <?php endif;?>
				<?php else :?>		
					<div class="vw-page-title-box clearfix">
						<div class="vw-page-title-box-inner">
							<h1 class="entry-title" <?php vw_itemprop('headline'); ?>><?php the_title(); ?></h1>
						</div>
					</div>
					<?php
						$us_args = array(
						    'post_type' 		=> 'gym',
						    'orderby'			=> 'title',
							'meta_query'		=> array(
								'relation'		=> 'AND',
								array(
									'key'		=> 'gym_country',
									'value'		=> 'united_states',
									'compare'	=> 'LIKE'
								)
							),
							'order' => 'DSC',		    
						    'post_status' => 'publish',
						    'posts_per_page' => -1
						);
						$int_args = array(
						    'post_type' 		=> 'gym',
						    'orderby'			=> 'title',
							'meta_query'		=> array(
								'relation'		=> 'AND',
								array(
									'key'		=> 'gym_country',
									'value'		=> 'united_states',
									'compare'	=> 'NOT LIKE'
								)
							),
							'order' => 'DSC',		    
						    'post_status' => 'publish',
						    'posts_per_page' => -1
						);

						$int_loop = new WP_Query( $int_args );
						$int_values = array();
						if ( $int_loop->have_posts() ) {
					        while ( $int_loop->have_posts() ) : $int_loop->the_post(); 
					            $the_field = get_field_object('gym_country');
					            $the_key = $the_field['value']; //gets the underscore value
					            //echo 'key = '.$the_key;
					            if ($the_key && !array_key_exists($the_key, $int_values) ){
					            	$int_values[$the_key] = $the_field['choices'][$the_key];
					            } 
					            //echo $the_key.'='.$the_value;
								//array_push($int_values, $the_key => $the_value);//ADD THE RESULT TO THE EMPTY ARRAY
					        endwhile;
					    }
					    asort($int_values);

						$us_loop = new WP_Query( $us_args );
						$us_values = array('');
						if ( $us_loop->have_posts() ) {
							while ( $us_loop->have_posts() ) : $us_loop->the_post(); 
					            $the_field=get_field_object('gym_state');
					            $the_key = $the_field['value']; //gets the underscore value
					            if ($the_key && !array_key_exists($the_key, $us_values) ){
					            	$us_values[$the_key] = $the_field['choices'][$the_key];
					            } 
					        endwhile;
					    }
					    asort($us_values);
					?>
					
					 <div class="vw-post-loop vw-post-loop-classic">	
						<div class="row">
							<div class="col-sm-12 vw-post-loop-inner">
								<div class="col-sm-5">
									<h2>United States</h2>
									<ul>
									    <?php foreach($us_values as $us_key => $us_val) : setup_postdata( $post );?>
									    	<?php if($us_val): ?>
									    		<li><a href="<?php echo $perma."united_states/".strtolower($us_key)."/" ?>"><?php echo $us_val;  ?></a></li>
									    	 <?php endif; ?>
									    <?php endforeach;?>
								    </ul>
								</div>
							    <?php wp_reset_postdata(); ?>
								<div class="col-sm-7">
								    <h2>International</h2>
								    <ul>
									    <?php foreach($int_values as $int_key => $int_val) : setup_postdata( $post );?>
									    	<li><a href="<?php echo $perma.$int_key."/" ?>"><?php echo $int_val; ?></a></li>
									    <?php endforeach;?>
								    </ul>
								</div>
							    <?php wp_reset_postdata(); ?>

							</div>
						</div>
					</div>
					
					<?php endif ?> 
			
				<?php endif; ?>

				<?php vw_the_pagination( vw_get_theme_option( 'blog_default_pagination_style' ) ); ?>


			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>