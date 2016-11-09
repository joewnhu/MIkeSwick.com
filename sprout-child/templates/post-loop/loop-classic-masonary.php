<div class="vw-post-loop vw-post-loop-classic">	
	<div class="row">
		<div class="col-sm-12 vw-post-loop-inner">
			
			<?php while( have_posts() ) : the_post(); $eventOrg = get_field('event_organization'); echo $eventOrg; ?>
				<?php if(get_field('event_organization') != 'Other' ) : ?>
					<?php get_template_part( 'templates/post-loop/post-masonary-grid-2-col', get_post_format() ); ?>
				<?php endif; ?>
			<?php endwhile; ?>

		</div>
	</div>
</div>