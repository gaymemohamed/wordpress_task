<?php
	if (!defined('ABSPATH')) exit;
	$icon = carbon_get_post_meta( get_the_ID(), 'specialty_icon' );
?>


<a class="homeSolutions-item" data-sal="slide-up" data-sal-delay="100" href="<?php the_permalink(); ?>" title="<?php echo get_the_title(get_the_ID()); ?>">

	<div class="appIcon is-center inViewJs">

		<img data-src="<?php echo $icon; ?>" alt="<?php echo get_the_title( get_the_ID() ); ?>">

	</div>
	<p class="text-sm mb-0 mt-md">
		<?php echo get_the_title( get_the_ID() ); ?>
	</p>

</a>
