<?php get_header(); ?>

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
							

							<?php vw_the_embeded_media(); ?>

							
							<?php wp_link_pages( array(
								'before'      => '<div class="vw-page-links"><span class="vw-page-links-title">' . __( 'Pages:', 'envirra' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span class="vw-page-link">',
								'link_after'  => '</span>',
								'separator'   => '',
							) ); ?>

							<div class="vw-post-box col-sm-12 vw-post-style-block vw-block-grid-item vw-post-style-masonry <?php vw_the_post_format_class(); ?>" <?php vw_itemtype('Article'); ?>>
	
				
							<?php 
								$gym_address 		= get_field('gym_address_line_1')." ".get_field('gym_address_line_2');
								$gym_city 			= get_field('gym_city');
								$gym_state 			= get_field('gym_state');
								$gym_website		= get_field('gym_website');
								$gym_phone_number	= get_field('gym_phone_number');
								$gym_email			= get_field('gym_email');
								$gym_featured		= get_field('gym_featured');
								$gym_top_ten		= get_field('gym_top_ten'); 
								$colClass = 'col-sm-12';
						 if ( has_post_thumbnail() ) : $colClass="col-sm-8"?>
							<div class="col-sm-4">
									<?php the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_POST_MASONRY ); ?>
									<?php vw_the_post_format_icon(); ?>
									<?php vw_the_review_summary_bar(); ?>
							</div>
						<?php endif; ?>

						<div class="vw-post-box-inner <?php echo $colClass ?>">

							<h2> <?php echo $gym_address. ' ' . $gym_city; if($gym_state){ echo ", " . $gym_state;}?></h2>
								
								<div class="vw-post-box-excerpt"><?php the_excerpt(); ?></div>
						</div>
						<div class="vw-post-box-inner col-sm-12 ">
							<div class="vw-post-meta row">

							<h3 class="vw-about-author-title"><span>Contact Info</span></h3>
							<?php if($gym_phone_number || $gym_email || $gym_website) ?>
							
								<?php if($gym_email) : ?>
									<div class="col-sm-6">
										<a class="vw-icon-social " href="mailto:<?php echo $gym_email ?>" target="_blank" itemprop="url" original-title="Email">
											<i class="icon-social-email icon-small"></i>
										</a>
										<?php echo $gym_email ?>
									</div>
								<?php endif; ?>
							 	<?php if($gym_phone_number) : ?>
									<div class="col-sm-6">
										<i class="icon-social-call icon-small"></i>
										<?php echo $gym_phone_number ?>
									</div>
								<?php endif; ?>
								<?php if($gym_website) : ?>
									<div class="col-sm-6">
										<a class="vw-icon-social " href="<?php echo $gym_website ?>" target="<?php echo str_replace(' ', '', the_title()); ?>" itemprop="url" original-title="Website">
											<i class="icon-iconic-home icon-small"></i>
										<?php echo $gym_website ?>
										</a>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="vw-post-box-inner col-sm-12">
								<?php the_content(); ?>

						</div>
					</div>


						</article><!-- #post-## -->

					<?php endwhile; ?>

					<?php do_action( 'vw_action_after_single_post' ); ?>

					<?php vw_the_post_footer_sections(); ?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>