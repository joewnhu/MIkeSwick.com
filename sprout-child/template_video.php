<?php
/*
Template Name: Videos
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
						<?php get_template_part( 'templates/content-child-pages-banners', get_post_format() ); ?>
					<?php //vw_the_post_footer_sections(); ?>

				<?php endif; ?>

			</div>


			<?php get_sidebar(); ?>

		
		</div>
	</div>
</div>
<?php get_footer(); ?>