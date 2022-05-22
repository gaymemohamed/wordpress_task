<?php
	if (!defined('ABSPATH')) exit;
?>


<article class="serviceCard">

	<a class="serviceCard-url" data-sal="slide-up" data-sal-delay="100" href="<?php the_permalink(); ?>" title="<?php echo get_the_title(get_the_ID()); ?>">
	</a>

	<div class="serviceCard-header">
		<div class="appImage inViewJs is-4-5">
			<?php echo BaseThumb('thumb-md'); ?>
		</div>
	</div>

	<div class="serviceCard-body">
		<h4 class="mb-sm">
			<?php echo get_the_title( get_the_ID() ); ?>
		</h4>
		<p class="mb-0">
            <?php BaseExcerpt( 30, true ); ?>
		</p>
	</div>

</article>
