<?php
	if (!defined('ABSPATH')) exit;
	$place = carbon_get_post_meta( get_the_ID(), 'base_career_place' );
	$duration = carbon_get_post_meta( get_the_ID(), 'base_career_duration' );
?>

<div class="col-sm-6 mb-col" data-sal="slide-up">
	<article class="appBox">

		<h4 class="mb-md d-flex justify-content-between align-items-center">
			<span> <?php echo get_the_title( get_the_ID() ); ?> </span>
			<span class="badge">
				<?php
					$categories = get_the_category();
					if ( ! empty( $categories ) ) {
						echo esc_html( $categories[0]->name );
					}
				?>
			</span>
		</h4>

		<p class="mb-xs">
            <?php BaseExcerpt( 30, true ); ?>
		</p>

		<p class="mb-md">
			<span class="icon-map-marker"></span>
			<span> <?php echo $place; ?> - <?php echo $duration; ?> </span>
		</p>

		<a class="btn btn-gradient btn-sm" href="<?php the_permalink(); ?>" title="<?php echo baseLang('Apply Now', 'التقدم للوظيفة'); ?>">
			<?php echo baseLang('Apply Now', 'التقدم للوظيفة'); ?>
		</a>

	</article>
</div>
