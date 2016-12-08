<?php get_header(); ?>
<!--single fight event template-->
<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main">

				<?php if ( have_posts() ) : ?>

					<?php do_action( 'vw_action_before_single_post' ); ?>

					
					<?php while ( have_posts() ) : the_post(); ?>


						<article <?php post_class( 'vw-main-post clearfix' ); ?> <?php vw_itemtype( 'Article' ); ?>>

							<?php vw_the_category(); ?>
							
							<h1 class="entry-title" <?php vw_itemprop('headline'); ?>><?php the_title(); ?></h1>
							<span class="updated hidden" <?php vw_itemprop('datePublished'); ?>><?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?></span>
							
							<?php vw_the_post_meta_large() ?>

							<?php if ( ! has_post_format() ) vw_the_featured_image(VW_CONST_THUMBNAIL_SIZE_POST_MASONRY); ?>

							<?php vw_the_embeded_media(); ?>

							<?php

							      $event_date = get_field('event_date');

							      $event_location = get_field('event_location');

							      $event_organization = get_field('event_organization');
							      if($event_organization == 'Other'){ $event_organization =  get_field('event_organization_other'); };
							      
							      $event_complete = get_field('event_results_completed');

							      $event_main_card = get_field('fight_card');

							      $event_outcome = '';
							      $event_outcome_method = '';
							      $event_outcome_round = '';
							      $event_outcome_time = '';

							      

							?>
							<h2><?php echo date('F d, Y', strtotime($event_date)); ?>  <?php  echo $event_location;  ?> </h2>
							
							<?php if($event_main_card) : ?>
							<h3 class="vw-about-author-title"><span>Event Card</span></h3>
									<?php while(the_repeater_field('fight_card')): 
										if($event_complete){
									      	$event_outcome = get_sub_field('outcome');
									     	$event_outcome_method = get_sub_field('method');
									     	$event_outcome_round = get_sub_field('round');
									     	$event_outcome_time = get_sub_field('time');
								      	}?>
										<div class="row event-card <?php if($event_outcome){echo "event-outcome-".$event_outcome;}?>">
											<?php if(get_sub_field('weight_class')) : ?><h4><span><?php the_sub_field('weight_class'); ?></span></h4><?php endif; ?>
											<div class="col-sm-5 card-fighter fighter-a"><?php if($event_outcome == 'a'): ?> <span class="event-winner"><i class="icon-iconic-award"></i>Winner</span><?php endif; ?><span><?php the_sub_field('fighter_a') ?></span></div>
											<div class="col-sm-2">vs.</div>
											<div class="col-sm-5 card-fighter fighter-b"><?php if($event_outcome == 'b'): ?> <span class="event-winner"><i class="icon-iconic-award"></i>Winner</span><?php endif; ?><span><?php the_sub_field('fighter_b') ?></span></div>
										</div>
										<?php if($event_outcome_method) :?>	
											<div class="row event-card">
												<div class="col-sm-12"> 
													<?php echo $event_outcome_method; 
													if($event_outcome_time){
														echo ' at '.$event_outcome_time;
														if($event_outcome_round){echo ' in round number '.$event_outcome_round.'.';}
													}else{
														if($event_outcome_round){echo ' after '.$event_outcome_round.' round(s).';}
													}?> 
												</div>
											</div>
										<?php endif;  ?>
									<?php endwhile; ?>
							<?php endif;?>
							<div class="vw-post-content clearfix" <?php vw_itemprop('articleBody'); ?>><?php the_content(); ?></div>

							<?php wp_link_pages( array(
								'before'      => '<div class="vw-page-links"><span class="vw-page-links-title">' . __( 'Pages:', 'envirra' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span class="vw-page-link">',
								'link_after'  => '</span>',
								'separator'   => '',
							) ); ?>

							<?php the_tags( '<div class="vw-tag-links"><span class="vw-tag-links-title">'.__( 'Tags:', 'envirra' ).'</span>', '', '</div>' ); ?>

						</article><!-- #post-## -->

					<?php endwhile; ?>

					<?php do_action( 'vw_action_after_single_post' ); ?>


				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>