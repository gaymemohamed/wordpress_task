<?php

if (!defined('ABSPATH')) exit;
get_header();

// Taxonomy template
// @link http://codex.wordpress.org/Class_Reference/WP_Query

$bannerText       = baseCheck(get_theme_mod( 'dBannerText', ''));
$bannerTextAr     = baseCheck(get_theme_mod( 'dBannerTextAr', ''));

$bannerTitle       = baseCheck(get_theme_mod( 'dBannerTitle', ''));
$bannerTitleAr     = baseCheck(get_theme_mod( 'dBannerTitleAr', ''));

$bannerImage       = baseCheck(get_theme_mod( 'dBannerImage', ''));
$bannerImageUrl    = baseGetImageUrl( $bannerImage );

$link              = baseGetLink( 'contactLnk' );


$paged    = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$taxonomy = get_query_var( 'taxonomy' );
$term     = get_query_var( 'term' );

$department = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

$thumbnail_id = get_term_meta ( $department->term_id , 'department_feature_image', true );
$image = wp_get_attachment_url( $thumbnail_id );

/*
    term_id
    name
    slug
    term_group
    term_taxonomy_id
    taxonomy
    description
    parent
    count
*/

// $parent = ( isset( $term->parent ) ) ? get_term_by( 'id', $term->parent, 'types' ) : false;

?>

<section class="theApp-body">
	<div class="container">

        <section class="pt-xl">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-5">
                        <h1 class="text-lg mb-md" data-sal="slide-up" data-sal-delay="100"
                            data-sal-duration="500" data-sal-easing="ease-out-back">
                                <?php echo $department->name; ?>
                            </h1>
                        <p data-sal="slide-up" data-sal-delay="200" data-sal-duration="500"
                            data-sal-easing="ease-out-back">
                            <?php echo $department->description; ?>
                        </p>
                    </div>

                    <?php if ( ! empty( $image ) ){ ?>

                    <div class="col-md-6">
                        <div class="mt-lg d-block d-md-none"></div>
                        <div data-sal="slide-left"  data-sal-delay="300" data-sal-duration="500"
                            data-sal-easing="ease-out-back">
                            <img class="img-fluid" src="<?php echo $image ?>"  draggable="false">
                        </div>
                    </div>

                    <?php } ?>

                </div>
            </div>
        </section>

		<?php


			$parents = get_term_children( $department->term_id , 'department' );

			if( !empty($parents) ){
				foreach ( $parents as $parent ) {

					$term = get_term_by( 'id', absint( $parent ), 'department' );
					if( $term->count <= 0 ) {
						continue;
					}

					?>
						<section class="mt-xl">
							<div class="container">

								<h3 class="h1 mb-md" data-sal="slide-up" data-sal-delay="100" data-sal-duration="500"
									data-sal-easing="ease-out-back">
									<?php echo $term->name; ?>
								</h3>

								<?php
									$args = array(
										'post_status'    => 'publish',
										'post_type'      => 'course',
										'tax_query'      => array(
											array(
												'taxonomy' => 'department',
												'field'    => 'slug',
												'terms'    => $term->slug,
											),
										),
										'posts_per_page' => get_option( 'posts_per_page' ),
										'paged'          => $paged,
									);
									$courses = new WP_Query( $args );
									if ($courses->have_posts()) {
								?>
								<div class="row">
									<?php
										while ($courses->have_posts()) {
											$courses->the_post();
									?>
										<div class="col-md-4 col-sm-6 mb-col" data-sal="slide-up" data-sal-delay="100" data-sal-duration="500" data-sal-easing="ease-out-back">
										<?php get_template_part('template-parts/card/template', 'course'); ?>
										</div>
									<?php } wp_reset_postdata(); ?>
								</div>
								<?php } ?>

							</div>
						</section>
					<?php
				}
			}else{

				$args = array(
					'post_status'    => 'publish',
					'post_type'      => 'course',
					'tax_query'      => array(
						array(
							'taxonomy' => $taxonomy,
							'field'    => 'slug',
							'terms'    => $term,
						),
					),
					'posts_per_page' => get_option( 'posts_per_page' ),
					'paged'          => $paged,
				);

				?>

					<section class="mt-xl">
						<?php
							$courses = new WP_Query( $args );
							if ($courses->have_posts()) {
						?>
							<div class="row">
								<?php
									while ($courses->have_posts()) {
										$courses->the_post();
								?>
									<div class="col-md-4 col-sm-6 mb-col" data-sal="slide-up" data-sal-delay="100" data-sal-duration="500" data-sal-easing="ease-out-back">
									<?php get_template_part('template-parts/card/template', 'course'); ?>
									</div>
								<?php } wp_reset_postdata(); ?>
							</div>
						<?php } ?>
					</section>

				<?php
			}

		?>

		<section class="mt-xl">
			<section class="mb-xl">
				<div class="container">
					<div class="container-out">
						<div style="background-color:#922add;"  class="container-out-content pt-lg pb-lg theme-light">
							<div class="row align-items-center">
								<div class="col-md-6">

									<h3 class="h1 mb-md" data-sal="slide-up" data-sal-delay="100"
										data-sal-duration="500" data-sal-easing="ease-out-back">
										<?php echo baseLang( $bannerTitle,$bannerTitleAr); ?>
									</h3>

									<?php if( !empty( $bannerText || $bannerTextAr ) ){ ?>
									<div data-sal="slide-up" data-sal-delay="200" data-sal-duration="500" data-sal-easing="ease-out-back" class="sal-animate">
										<p>
											<?php echo baseLang( $bannerText,$bannerTextAr); ?>
										</p>
									</div>
									<?php } ?>

									<?php if( $link ){ ?>
									<div data-sal="slide-up" data-sal-delay="300" data-sal-duration="500" data-sal-easing="ease-out-back">

										<a class="btn btn-warning" href="<?php echo $link; ?>" title="<?php echo baseLang('Get in touch','  تواصل معنا'); ?>">
											<?php echo baseLang('Get in touch','  تواصل معنا'); ?>
										</a>

									</div>
									<?php } ?>

								</div>
								<div class="col-md-6 order-sm">

									<div data-sal="slide-left" data-sal-delay="400" data-sal-duration="500"
										data-sal-easing="ease-out-back">
										<img alt="<?php echo baseLang( $bannerTitle,$bannerTitleAr); ?>" class="img-fluid" src="<?php echo $bannerImageUrl; ?>" draggable="false">
									</div>
									<div class="mb-lg d-block d-md-none"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>

    </div>
</section>

<?php
get_footer();
