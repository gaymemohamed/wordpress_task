<?php

/*
	Template Name: Home | الرئيسية
*/

if (!defined('ABSPATH')) exit;
get_header();
while (have_posts()) {
	the_post();?>

<section class="section-team u-text-center u-mb-sm" id="section-team">
            <div class="u-text-center u-mb-sm">
                <h2 class="heading-secondary">
                    OUR AWESOME TEAM
                </h2>
            </div>
            <div class="row">
                <?php
                    $num  = '-1';
                    $args = array (
                        'post_type'           => 'member' ,
                        'post_status'         => 'publish',
                        'order'               => 'ASC',
                        'posts_per_page'      => (int) $num
                    );
                    $query = new wp_Query($args);
                    if($query->have_posts()){
                        while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('template-parts/card/template', 'default');
                                wp_reset_query();
                        ?>
                <?php } }?>
                
            </div>
        </section>



        

<?php
}
get_footer();
wp_reset_postdata();
