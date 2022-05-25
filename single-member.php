<?php
if (!defined('ABSPATH')) {
    exit;
}
$pos = carbon_get_post_meta( get_the_ID(), 'pos_company');
get_header();
while (have_posts()) {
    the_post();

    ?>
<section class="section-single-team u-text-center u-mb-sm">
            <div class="u-text-center u-width-m u-mb-sm">
                <h4 class="heading-secondary">
                <?php echo get_the_title(get_the_ID()); ?>
                </h4>
                <p class="paragraph"><?php echo get_the_excerpt(get_the_ID()); ?></p>
            </div>
            <div class="row">
                <div class="single-card">
                    <div class="single-card__content">
                        <div class="single-card__left">
                        <?php echo BaseThumb('thumb-md'); ?> 
                        </div>
                        <div class="single-card__right">
                            <h2 class="heading-secondary u-mb-sm">
                              <?php echo get_the_title(get_the_ID()); ?>
                            </h2>
                            <h3 class="heading-tertiary u-mb-sm"><span class="heading-secondary-span">Position: </span><?php echo $pos; ?></h3>
                            </h3>
                            <p class="single-card__text u-mb-sm"> <?php the_content(); ?></p>
                            
                            <ul class="socials">
                            <?php $packages = carbon_get_post_meta( get_the_ID(), 'package');
                              if(is_array($packages) && !empty($packages)){
                                foreach ($packages as $key => $package) {
                            ?>
                                <li>
                                  <a
                                    href="<?php echo getArrVal( $package['social_link'], $package['social_link']);?>" 
                                    target="_blank"
                                    title="<?php echo $package['select_social']  ?>"
                                  ><?php echo BaseGetIconSvg($package['select_social'] , 24, 24); ?></a>
                                </li>
                                <?php }} ?>
                                
                              </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>


<?php
}
get_footer();