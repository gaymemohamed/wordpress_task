<?php
if (!defined('ABSPATH')) exit;
get_header();

while (have_posts()) {
	the_post();
	$place = carbon_get_post_meta( get_the_ID(), 'base_career_place' );
	$duration = carbon_get_post_meta( get_the_ID(), 'base_career_duration' );

	$formTitle      = baseCheck(get_theme_mod( 'careerformTitle' , ''));
	$formTitleAr    = baseCheck(get_theme_mod( 'careerformTitleAr', '' ));

	$formDesc       = baseCheck(get_theme_mod( 'careerformDesc' , ''));
	$formDescAr     = baseCheck(get_theme_mod( 'careerformDescAr', '' ));

	$list = carbon_get_post_meta( get_the_ID(), 'base_career_list' );

?>
<section class="pt-xl full-width">
	<div class="container">

		<div class="max-md">
			<h1 class="text-lg mb-md d-flex justify-content-between align-items-center" data-sal="slide-up"
				data-sal-delay="100">
				<span> <?php echo get_the_title( get_the_ID() ); ?> </span>
				<span class="badge">
					<?php
						$categories = get_the_category();
						if ( ! empty( $categories ) ) {
							echo esc_html( $categories[0]->name );
						}
					?>
				</span>
			</h1>
			<p class="mb-md" data-sal="slide-up" data-sal-delay="200">
            	<?php  echo get_the_excerpt(get_the_ID()); ?>
			</p>
			<p class="mb-0" data-sal="slide-up" data-sal-delay="300">
				<span class="icon-map-marker"></span>
				<span> <?php echo $place; ?> - <?php echo $duration; ?> </span>
			</p>
		</div>

		<div class="mt-xl">
		<?php the_content(); ?>
		</div>

	</div>
</section>

<section class="mt-xl bg-gradient text-white pt-xl pb-xl full-width">
	<div class="container">

		<div class="max-md mx-auto text-center">
			<h3 class="text-lg" data-sal="slide-up" data-sal-delay="100">
				<?php echo baseLang($formTitle, $formTitleAr); ?>
			</h3>
			<p class="text-sm mb-0" data-sal="slide-up" data-sal-delay="200">
				<?php echo baseLang($formDesc, $formDescAr); ?>
			</p>
		</div>

		<div class="max-md mx-auto mt-lg">
			<div id="theForm" class="form--career is-2col" data-sal="slide-up" data-sal-delay="300">
				<?php
					if (class_exists('GFAPI')) {
						echo do_shortcode('[gravityform id="5" title="false" description="false" ajax="true"]');
					}
				?>
			</div>
		</div>

	</div>
</section>
<?php
}
wp_reset_postdata();
get_footer();
