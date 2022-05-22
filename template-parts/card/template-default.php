<?php if (!defined('ABSPATH')) exit; ?>

<article class="appCard">

	<a class="appCard-url" href="<?php the_permalink(); ?>"
		title="<?php echo get_the_title(get_the_ID()); ?>"></a>

	<div class="appCard-header">
		<div class="appCard-thumb">
			<div class="appImage inViewJs">
				<?php echo BaseThumb('thumb-md'); ?>
			</div>
		</div>
		<div class="appCard-date">
			<?php echo BaseDate(); ?>
		</div>
	</div>

	<div class="appCard-body">
		<h4 class="appCard-title">
			<?php echo get_the_title( get_the_ID() ); ?>
		</h4>
	</div>

</article>
