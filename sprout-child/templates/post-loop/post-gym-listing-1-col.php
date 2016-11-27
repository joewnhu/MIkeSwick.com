	
				
		<?php 
			$gym_address 		= get_field('gym_address_line_1')." ".get_field('gym_address_line_2');
			$gym_city 			= get_field('gym_city');
			$gym_state 			= get_field('gym_state');
			$gym_website		= get_field('gym_website');
			$gym_phone_number	= get_field('gym_phone_number');
			$gym_email			= get_field('gym_email');
			$gym_featured		= get_field('gym_featured');
			$gym_top_ten		= get_field('gym_top_ten'); 
			$colClass = 'col-sm-12';?>
	<div class="vw-post-box col-sm-12 <?php if($gym_featured){ echo 'featured-gym'; } ?> vw-post-style-block vw-block-grid-item vw-post-style-masonry <?php vw_the_post_format_class(); ?>" <?php vw_itemtype('Article'); ?>>

	<?php if ( has_post_thumbnail() && ($gym_featured || $gym_top_ten)) : $colClass="col-sm-8"?>
		<div class="col-sm-4">
			<a class="vw-post-box-thumbnail" href="<?php echo $gym_website ?>" target="<?php echo str_replace(' ', '', the_title()); ?>" itemprop="url" original-title="Website">
				<?php the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_POST_MASONRY ); ?>
				<?php vw_the_post_format_icon(); ?>
				<?php vw_the_review_summary_bar(); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="vw-post-box-inner <?php echo $colClass ?>">

		<h2 class="vw-post-box-title" <?php vw_itemprop('headline'); ?>>
			<a href="<?php echo $gym_website; ?>" target="<?php echo str_replace(' ', '', the_title()); ?>" class="" <?php vw_itemprop('url'); ?>>
				<?php the_title(); ?>
			</a>
		</h2>	

		<p class="vw-post-box-title"> <?php echo $gym_address. ' ' . $gym_city; if($gym_state){ echo ", " . $gym_state;}?></p>
			
			<div class="vw-post-box-excerpt"><?php the_excerpt(); ?></div>
	</div>
	<div class="vw-post-box-inner col-sm-12">

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
	<div class="vw-post-box-inner col-sm-12">
		<div class="vw-post-meta">
			
		</div>
		
	</div>
	
</div>