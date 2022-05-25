<?php if (!defined('ABSPATH')) exit;
	$pos = carbon_get_post_meta( get_the_ID(), 'pos_company');
?>

<a href="#popup" class="col-1-of-3">
	<div class="card">
		<div class="card__side card__side--front">
			<div class="card__pic card__pic--1">
				<?php echo BaseThumb('thumb-full'); ?>                                    
			</div>
			<h4 class="card__heading">
				<span class="card__heading-span card__heading-span--1"><?php echo get_the_title(get_the_ID()); ?></span>
			</h4>
			<div class="card__details u-mt-sm">
				<h3 class="heading-tertiary u-mb-sm"><span class="heading-secondary-span">Position: </span><?php echo $pos; ?></h3>
				<p class="paragraph"><?php the_excerpt(); ?></p>
			</div>
		</div>
	</div>
</a>

<div class="popup" id="popup">
	<div class="popup__content">
		<div class="popup__left">
			<?php echo BaseThumb('thumb-md'); ?> 
		</div>
		<div class="popup__right">
			<a href="#section-team" class="popup__close">&times;</a>
			<h2 class="heading-secondary u-mb-sm">
				<?php echo get_the_title(get_the_ID()); ?>
			</h2>
			<h3 class="heading-tertiary u-mb-sm"><span class="heading-secondary-span">Position: </span><?php echo $pos; ?></h3>
			<p class="popup__text u-mb-sm"><?php the_excerpt(); ?></p>
			<a href="<?php the_permalink( get_the_ID() ) ?>" class="btn btn--green u-mt-sm">See More</a>  
		</div>
	</div>
</div>

