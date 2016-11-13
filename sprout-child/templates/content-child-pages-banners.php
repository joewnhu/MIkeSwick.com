<?php

	$args = array(
		'post_type' 		=> 'page',
	    'orderby'			=> 'title',
		'post_parent' 		=> get_the_id(),
		'order' 			=> 'ASC',		    
	    'post_status' 		=> 'publish'

	);

  $result_loop = new WP_Query($args); 
  $GLOBALS['wp_query'] = $result_loop;

  ?>

  <?php if($result_loop->have_posts()) : ?>
				<?php do_action( 'vw_action_before_single_post' ); 
			    while ( $result_loop->have_posts() ) :  $result_loop->the_post();?>
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
<?php do_action( 'vw_action_after_single_post' );?>