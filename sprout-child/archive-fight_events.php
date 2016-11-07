<?php get_header(); ?>
<!--fight events archive template-->
<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div id="vw-page-content" class="vw-page-content" role="main">
					<div class="vw-page-title-box clearfix">
							
							<div class="vw-page-title-box-inner">
								<h1 class="vw-page-title">Fight Events</h1>
							</div>

					</div>

				<?php if ( have_posts() ) : ?>

					<?php do_action( 'vw_action_before_archive_posts' ); ?>

					<?php get_template_part( 'templates/post-loop/loop', 'classic-masonary' ); ?>

					<?php do_action( 'vw_action_after_archive_posts' ); ?>

					<?php vw_the_pagination( vw_get_theme_option( 'blog_default_pagination_style' ) ); ?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>