<div class="vw-post-box vw-post-style-block vw-block-grid-item vw-post-style-masonry <?php vw_the_post_format_class(); ?>" <?php vw_itemtype('Article'); ?>>
	<?php $colClass = 'col-sm-12' ?>
	<?php if ( has_post_thumbnail() ) : $colClass="col-sm-8"?>
		<div class="col-sm-4">
			<a class="vw-post-box-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
				<?php the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_POST_MASONRY ); ?>
				<?php vw_the_post_format_icon(); ?>
				<?php vw_the_review_summary_bar(); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="vw-post-box-inner <?php echo $colClass ?>">
				
		<?php 
			$gym_address 		= get_field('gym_address_line_1')." ".get_field('gym_address_line_2');
			$gym_city 			= get_field('gym_city');
			$gym_country 		= get_field('gym_country');
			$gym_state 			= get_field('gym_state');
			$gym_website		= get_field('gym_website');
			$gym_phone_number	= get_field('gym_phone_number');
			$gym_email			= get_field('gym_email');
			$gym_featured		= get_field('gym_featured');
			$gym_top_ten		= get_field('gym_top_ten'); ?>

		<h3 class="vw-post-box-title" <?php vw_itemprop('headline'); ?>>
			<a href="<?php echo $gym_website; ?>" target="<?php str_replace(' ', '', the_title()); ?>" class="" <?php vw_itemprop('url'); ?>>
				<?php the_title(); ?>
			</a>
		</h3>	

		 <?php if($event_date && $event_location): ?>
		<h4>
			<?php echo date('F d, Y', strtotime($event_date)); ?> <?php echo $event_location;?> 
		</h4>
	<?php endif; ?>
	</div>
	<div class="vw-post-box-inner col-sm-12">
		<div class="vw-post-meta">
			
		</div>
		
	</div>
	
</div>