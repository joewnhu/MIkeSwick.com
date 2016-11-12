<?php
/*
Template Name: Gyms
*/
get_header(); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div id="vw-page-content" class="vw-page-content" role="main">
				<?php if ( have_posts() ) : ?>
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
									'value'		=> 'United States of America (USA)',
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
									'value'		=> 'United States of America (USA)',
									'compare'	=> 'NOT LIKE'
								)
							),
							'order' => 'DSC',		    
						    'post_status' => 'publish',
						    'posts_per_page' => -1
						);

						$int_loop = new WP_Query( $int_args );
						$int_values = array('');
						if ( $int_loop->have_posts() ) {
					        while ( $int_loop->have_posts() ) : $int_loop->the_post(); 
					            $the_answer=get_post_meta(get_the_ID(), 'gym_country' , true);//'TRUE' WILL RETURN ONLY ONE VALUE FOR EACH POST.
					            $the_answer=trim($the_answer);
								array_push($int_values, $the_answer);//ADD THE RESULT TO THE EMPTY ARRAY
					        endwhile;
					       $int_values = array_unique($int_values);
					    }
					    sort($int_values);

						$us_loop = new WP_Query( $us_args );
						$us_values = array('');
						if ( $us_loop->have_posts() ) {
							while ( $us_loop->have_posts() ) : $us_loop->the_post(); 
					            $the_answer=get_post_meta(get_the_ID(), 'gym_state' , true);//'TRUE' WILL RETURN ONLY ONE VALUE FOR EACH POST.
					            $the_answer=trim($the_answer);
						        array_push($us_values, $the_answer);//ADD THE RESULT TO THE EMPTY ARRAY
					        endwhile;
					    }
					    sort($us_values);


					
						//do_action( 'vw_action_before_single_post' ); 
					?> 
			
					<div class="vw-post-loop vw-post-loop-classic">	
						<div class="row">
							<div class="col-sm-12 vw-post-loop-inner">
								<div class="col-sm-5">
									<h2>United States</h2>
									<ul>
									    <?php foreach($us_values as $us_val) : setup_postdata( $post );?>
									    	<?php if($us_val): ?>
									    		<li><?php echo $us_val;  ?></li>
									    	 <?php endif; ?>
									    <?php endforeach;?>
								    </ul>
								</div>
							    <?php wp_reset_postdata(); ?>
								<div class="col-sm-7">
								    <h2>International</h2>
								    <ul>
									    <?php foreach($int_values as $int_val) : setup_postdata( $post );?>
									    	<?php if($int_val): ?>
									    		<li><?php echo $int_val;  ?></li>
									    	<?php endif; ?>
									    <?php endforeach;?>
								    </ul>
								</div>
							    <?php wp_reset_postdata(); ?>

							</div>
						</div>
					</div>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>