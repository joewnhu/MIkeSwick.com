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
							<span class="author vcard hidden"><span class="fn"><?php echo esc_attr( get_the_author() ); ?></span></span>
							<span class="updated hidden" <?php vw_itemprop('datePublished'); ?>><?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?></span>
							
							<?php vw_the_post_meta_large() ?>

							<?php if ( ! has_post_format() ) vw_the_featured_image(); ?>

							<?php vw_the_embeded_media(); ?>

							<?php


							      $result_date = get_field('event_date');

							      $result_location = get_field('event_location');

							      $fight_poster = get_field('event_poster');

							      $result_organization = get_field('event_organization');

							      $result_main_card = get_field('fight_card');

							      $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

							      $result_image1 = $featured_image[0];

							?>
							<h2><?php echo $result_date; ?>  <?php  echo $result_location;  ?> </h2>

							<?php if($fight_poster): ?>
								<img src="<?php echo $fight_poster['url']; ?>" alt="<?php the_title(); ?>" />
							<?php  endif; ?>
							
							<?php if($result_main_card) : ?>
								<?php while(the_repeater_field('fight_card')): ?>
									<ul>
										<li></li>
									</ul>	
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

					<?php vw_the_post_footer_sections(); ?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>