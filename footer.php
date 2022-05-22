<?php
	if (!defined('ABSPATH')) exit;
?>


</div>

<footer class="theFooter">
    <div class="container">

        <div class="row align-items-center justify-content-between">

            <div class="col-lg-3 theFooter-col">

                <div class="theFooter-logo mb-md">
                    <?php
							if(is_rtl()){
								echo BaseGetIconSvg('logoAr', 'unset', 'unset');
							}else{
								echo BaseGetIconSvg('logo', 'unset', 'unset');
							}
						?>
				</div>
				<p class="mb-0 text-sm">
                    <?php
							$year = current_time('Y');
							$rights   = 'All Rights Reserved to ' .NAME. ' ©' .$year.'. ';
							$rightsAr =
							'جميع الحقوق محفوظة ل ' .NAME. '  ©' .$year. '.';
							echo baseLang( $rights, $rightsAr );
						?>
					<span>
						<?php  echo baseLang( ' Made by ' ,' صمم فى '); ?>
						<a class="text-primary" rel="noreferrer"
							aria-label="<?php  echo baseLang( 'Baianat' , 'بيانات'); ?>"
							title="<?php  echo baseLang( 'Baianat' , 'بيانات'); ?>"
							href="<?php echo esc_url('https://baianat.com/'); ?>" target="_blank">
							<?php  echo baseLang( 'Baianat' , 'بيانات'); ?>
						</a>
					</span>
                </p>

                
                    
                

            </div>

            <div class="col-lg-5 theFooter-col">

                <?php if (has_nav_menu('siteMap')) { ?>
                <?php
							wp_nav_menu(
								array(
									'theme_location' => 'siteMap',
									'menu_class'     => 'theFooter-nav',
									'container'      => '',
								)
							);
						}
					?>

            </div>

            <div class="col-lg-3 theFooter-col">
				<h5 class="mb-md"><?php echo baseLang('Follow us on', 'تابعنا علي') ?> </h5>
                <ul class="socials">
                    <?php
							$socials = get_theme_mod( 'socials', '');
							if ( is_array($socials) && !empty($socials) ) {
								foreach ( $socials as $social ) {
									?>
                    <li>
                        <a href="<?php echo baseCheck($social['link'],''); ?>" rel="noreferrer" target="_blank"
                            title="<?php echo baseLang( baseCheck($social['name'],''), baseCheck($social['ar'],'')); ?>">
                            <?php echo BaseGetIconSvg( baseCheck( $social['name'],'' ), 30, 30); ?>
                        </a>
                    </li>
                    <?php
								}
							}
						?>
                </ul>
				


            </div>

        </div>

    </div>
</footer>

</section>
</main>

<?php get_template_part('template-parts/layout/template', 'foot'); ?>
