<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
global $post;
while (have_posts()) {
    the_post();

    $category = get_queried_object();
    $id = $category->term_id;
    $webinar = baseCheck(get_theme_mod('webinarCat', ''));

    ?>

<section class="pt-xl">
	<div class="container">

		<div class="max-lg mx-auto">
			<div class="text-center">
                <p class="text-muted mb-xs"><?php echo BaseDate(); ?></p>
				<h1 class="text-lg mb-xl" data-sal="slide-up" data-sal-delay="100">
          <?php $show_content = carbon_get_post_meta(get_the_ID(), 're_show_content');
    echo $show_content;
    ?>
          <?php $background_color = carbon_get_post_meta(get_the_ID(), 're_box_background');
    echo $background_color;?>
          <?php $hidden_data = carbon_get_post_meta(get_the_ID(), 're_hidden_data');
    echo $hidden_data;?>
    <?php $available_colors = carbon_get_post_meta(get_the_ID(), 're_available_colors');
    if ($available_colors) {
        foreach ($available_colors as $available_color) {
            echo $available_color;
        }
    }
    ?>
  <?php $radio_options = carbon_get_post_meta(get_the_ID(), 're_radio');
    echo $radio_options;

    ?>
				</h1>
			</div>
		</div>

		<div class="appImage inViewJs is-radius is-2-1" data-sal="slide-up" data-sal-delay="200">
			<?php echo BaseThumb('thumb-single'); ?>
		</div>

		<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-8 col-md-10">
				<div class="content mt-lg">
					<?php the_content();?>

					<?php

    $categories = get_the_category($post->ID);
    if ($categories[0]->cat_ID == $webinar) {
        $register = baseCheck(get_theme_mod('register-link'));
        $registerAr = baseCheck(get_theme_mod('register-link-ar'));
        ?>
					<a class="btn btn-gradient" href="<?php echo baseLang($register, $registerAr); ?>" title="<?php baseLang('Register Now', 'سجل الأن');?>"><?php baseLang('Register Now', 'سجل الأن');?></a>
					<?php }?>

				</div>
			</div>
		</div>

		<div class="mt-xl">

			<div class="d-flex align-items-center justify-content-between flex-wrap">

				<?php
$tags = get_tags(array(
        'hide_empty' => false,
    ));
    $numItems = count($tags);
    $i = 0;
    if (!empty($tags)) {
        ?>
				<div class="mb-lg" data-sal="slide-up" data-sal-delay="200">

					<p class="mb-sm"><?php echo baseLang('Tags', 'وسوم'); ?></p>

					<?php

        foreach ($tags as $key => $tag) {
            $tag_link = get_tag_link($tag->term_id);
            if (++$i === $numItems) {
                echo '<a class="font-weight-bold text-capitalize" href="' . $tag_link . '" title="' . $tag->name . '">' . $tag->name . '</a>';
            } else {
                echo '<a class="font-weight-bold text-capitalize" href="' . $tag_link . '" title="' . $tag->name . '">' . $tag->name . '</a><span class="mr-2">,</span>';
            }
        }

        ?>

				</div>
				<?php }?>

				<div class="mb-lg" data-sal="slide-up" data-sal-delay="200">


					<p class="mb-sm">
						<?php echo baseLang('Share', 'مشاركة '); ?>
					</p>

					<a class="font-weight-bold text-capitalize" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" target="_blank" title="<?php echo baseLang('facebook', 'فيسبوك'); ?>">
						<?php echo baseLang('facebook', 'فيسبوك'); ?>
					</a>

					<span class="mr-2">,</span>

					<a class="font-weight-bold text-capitalize" href="http://twitter.com/share?text=<?php echo get_the_title(get_the_ID()); ?>;url=<?php the_permalink();?>;via=<?php echo get_bloginfo('name'); ?>" target="_blank" title="<?php echo baseLang('twitter', 'تويتر'); ?>">
						<?php echo baseLang('twitter', 'تويتر'); ?>
					</a>

					<span class="mr-2">,</span>

					<a class="font-weight-bold text-capitalize" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=<?php echo get_the_title(get_the_ID()); ?>&summary=<?php BaseExcerpt(20, false);?>" target="_blank" title="<?php echo baseLang('linkedin', 'لينكدان'); ?>">
						<?php echo baseLang('linkedin', 'لينكدان'); ?>
					</a>

				</div>

			</div>
		</div>

	</div>
</section>


<?php

}
wp_reset_postdata();

global $post;

$allCategories = [];
$categories = get_the_category($post->ID);

if (!empty($categories)) {
    foreach ($categories as $categoryOne) {
        $category = (int) ($categoryOne->cat_ID);
        array_push($allCategories, $category);
    }
}

$args = array(
    'post_type' => 'post',
    'category__in' => $allCategories,
    'posts_per_page' => 3,
    'post__not_in' => array($id),
    'ignore_sticky_posts' => 1,
);
$query = new WP_Query($args);

?>
<?php if ($query->have_posts()) {?>


<section class="mt-xl mb-xxl">
	<div class="container">

		<div class="d-flex mb-md" data-sal="slide-up"
			data-sal-delay="100">

			<h3 class="h1 mb-0">
				<?php
echo baseLang('Also View', 'شاهد ايضا');
    ?>
			</h3>

		</div>

		<div class="row" data-sal="slide-up" data-sal-delay="200">
			<?php
while ($query->have_posts()) {
        $query->the_post();
        ?>
				<div class="col-lg-4 col-sm-6 mb-col" data-sal="slide-up">
					<?php
get_template_part('template-parts/card/template', 'default');
        ?>
				</div>
			<?php
}
    wp_reset_query();
    ?>
		</div>

	</div>
</section>

<?php
}
get_footer();
