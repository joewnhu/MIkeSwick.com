<?php while ( have_posts() ) :  the_post();?>
	 <div class="vw-post-loop vw-post-loop-classic">	
		<div class="row">
			<div class="col-sm-12 vw-post-loop-inner">
				<?php get_template_part( 'templates/post-loop/post-masonary-grid-2-col', get_post_format() ); ?>
			</div>
		</div>
	</div>
<?php endwhile;?>
