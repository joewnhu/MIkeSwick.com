<?php

	$args = array(
		'post_type' 		=> 'page',
	    'orderby'			=> 'post_modified',
		'post_parent' 		=> get_the_id(),
		'order' 			=> 'ASC',		    
	    'post_status' 		=> 'publish'

	);

  $result_loop = new WP_Query($args); 
  ?>

  <?php if($result_loop->have_posts()) : ?>
  <div class="vw-post-loop vw-post-loop-classic">	
		<div class="row">
			<div class="col-sm-12 vw-post-loop-inner">
				<?php do_action( 'vw_action_before_single_post' ); 
			    while ( $result_loop->have_posts() ) :  $result_loop->the_post();?>
					<div class="vw-block-grid-item col-sm-6">
						<div class="vw-post-box vw-post-style-block vw-post-style-masonry <?php vw_the_post_format_class(); ?>" <?php vw_itemtype('Article'); ?>>
								<h2 class="entry-title" <?php vw_itemprop('headline'); ?>>
									<a href="<?php the_permalink(); ?>" class="" <?php vw_itemprop('url'); ?>>
										<?php the_title(); ?>
									</a>
								</h2>
								<a href="<?php the_permalink(); ?>" class="" <?php vw_itemprop('url'); ?>>
									<?php echo the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_SINGLE_POST_CLASSIC ); ?>
								</a>
	  					</div>
					</div>

			    <?php endwhile;?>

			    <?php wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>	
<?php do_action( 'vw_action_after_single_post' );?>