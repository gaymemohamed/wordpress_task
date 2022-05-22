<?php
if (!defined('ABSPATH')) exit;
get_header();

    $category   = get_queried_object();
	$id         = $category->term_id;
	$news       = baseCheck(get_theme_mod( 'newsCat' ));;

	$title      = carbon_get_term_meta( $id, 'base_category_title' );
	$pageTitle  = '<h1 class="text-xl mb-sm" data-sal="slide-up" data-sal-delay="100"> ' . ( (!empty( $title) ) ? $title : get_the_archive_title() ). ' </h1>';

	$desc       = get_the_archive_description();
	$pageDesc   = ( (!empty( $desc) ) ? '<p class="mb-0" data-sal="slide-up" data-sal-delay="200"> '.wp_kses_post($desc).' </p>' : '' );

	$url        = carbon_get_term_meta( $id, 'base_category_image' );
	$pageBg     = ( (!empty( $url) ) ? 'style="background-image:url('.$url.');"' : '' );

	if( $id == $news ){
		$class = "col-sm-6 mb-col";
	}else{
		$class = "col-lg-4 col-sm-6 mb-col";
	}

?>

	<section class="pageHeader full-width">
		<div class="pageHeader-bg" <?php echo $pageBg; ?>></div>
		<?php echo wp_kses_post($pageTitle) . wp_kses_post($pageDesc); ?>
	</section>

	<section class="pt-xl pb-xl">
		<div class="row">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					?>
					<div class="<?php echo $class; ?>" data-sal="slide-up">
						<?php
							get_template_part( 'template-parts/card/template', 'default' );
						?>
					</div>
					<?php
				}
			}
			?>
		</div>
		<?php get_template_part( 'template-parts/pagination' ); ?>
	</section>

<?php
get_footer();

