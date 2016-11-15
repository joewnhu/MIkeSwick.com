<?php get_header(); ?>
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

					<?php   $GLOBALS['wp_query'] = $result_loop;

					 while ( $result_loop->have_posts() ) : $result_loop->the_post(); ?>
						<div class="vw-post-loop vw-post-loop-classic">	
							<div class="row">
								<div class="col-sm-12 vw-post-looeventp-inner">
									
										<?php get_template_part( 'templates/post-loop/post-masonary-grid-2-col', get_post_format() ); ?>

								</div>
							</div>
						</div>		      

					<?php endwhile;?>

					<?php wp_reset_postdata(); ?>

				<?php endif; ?>

				<?php do_action( 'vw_action_after_single_post' );?>

				<?php vw_the_pagination( vw_get_theme_option( 'blog_default_pagination_style' ) ); ?>

				<?php //vw_the_post_footer_sections(); ?>


			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>
<?php get_footer(); ?>