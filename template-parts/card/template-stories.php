<?php
	if (!defined('ABSPATH')) exit;
?>

<article class="successCard mb-lg" data-sal="slide-up">
	<div class="successCard-thumb inViewJs">
		<?php echo BaseThumb('full'); ?>
	</div>
	<div class="successCard-body">
		<h3 class="h2 mb-0">M
			<?php echo get_the_title( get_the_ID() ); ?>
		</h3>
		<?php the_content(); ?>
	</div>
</article>
