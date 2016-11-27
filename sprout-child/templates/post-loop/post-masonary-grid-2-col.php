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
		
		<?php vw_the_category(); ?>
		<h3 class="vw-post-box-title" <?php vw_itemprop('headline'); ?>>
			<a href="<?php the_permalink(); ?>" class="" <?php vw_itemprop('url'); ?>>
				<?php the_title(); ?>
			</a>
		</h3>
		<?php 
			$event_date = get_field('event_date');
			$event_location = get_field('event_location');
		 if($event_date && $event_location): ?>
		<h4>
			<?php echo date('F d, Y', strtotime($event_date)); ?> <?php echo $event_location;?> 
		</h4>
	<?php endif; ?>
	</div>
	<div class="vw-post-box-inner col-sm-12">
		<div class="vw-post-meta">
			<span class="vw-post-author" <?php vw_itemprop('author'); vw_itemtype('Person'); ?>>
				<?php vw_the_author_avatar( null, VW_CONST_AVATAR_SIZE_SMALL ); ?>

				<a class="author-name" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php _e('Posts by', 'envirra'); ?> <?php the_author(); ?>" rel="author" <?php vw_itemprop('name'); ?>><?php the_author(); ?></a>
			</span>

			<span class="vw-post-meta-separator">&middot;</span>

			<?php vw_the_post_date(); ?>
		</div>
		
		<div class="vw-post-box-excerpt"><?php the_excerpt(); ?></div>
	</div>

	<div class="vw-post-box-footer vw-header-font col-sm-12">

		<a href="<?php the_permalink(); ?>" class="vw-post-box-read-more"><span><?php _e( 'Read More', 'envirra' ); ?></span> <i class="vw-icon icon-iconic-right-circle"></i></a>
		
		<?php vw_the_post_share_icons(); ?>

	</div>
	
</div>