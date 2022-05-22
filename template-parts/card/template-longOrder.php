<?php if (!defined('ABSPATH')) exit; ?>

<section class="bg-white full-width">
	<div class="container">
		<div class="row align-items-center no-gutters">

			<div class="col-md-6">
				<div class="halfScreen-contnet is-spacing max-md">

					<?php
						if( get_post_type( get_the_ID() ) == 'solution' || get_post_type( get_the_ID() ) == 'specialty' ){

						if( get_post_type( get_the_ID() ) == 'solution' ){
							$icon = carbon_get_post_meta( get_the_ID(), 'solution_icon' );
						}else{
							$icon = carbon_get_post_meta( get_the_ID(), 'specialty_icon' );
						}
					?>
						<div class="appIcon mb-md" data-sal="slide-up" data-sal-delay="100">
							<img src="<?php echo $icon; ?>" alt="<?php echo get_the_title( get_the_ID() ); ?>">
                        </div>
					<?php } ?>

					<h3 class="text-lg mb-md" data-sal="slide-up" data-sal-delay="200">
						<?php echo get_the_title( get_the_ID() ); ?>
					</h3>

					<p class="text-sm" data-sal="slide-up" data-sal-delay="300">
						<?php  echo get_the_excerpt(get_the_ID()); ?>
					</p>

					<div data-sal="slide-up" data-sal-delay="400">
						<a class="btn btn-gradient" href="<?php the_permalink(); ?>" title="<?php echo baseLang('View More', 'عرض المزيد'); ?>">
							<?php echo baseLang('View More', 'عرض المزيد'); ?>
						</a>
					</div>

				</div>
			</div>

			<div class="col-md-6 order-sm" data-sal="fade-in" data-sal-delay="100">
				<div class="halfScreen">
					<div class="appImage inViewJs is-3-2">
						<?php echo BaseThumb('thumb-md'); ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
