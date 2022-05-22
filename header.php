<?php
	if (!defined('ABSPATH')) exit;
    get_template_part('template-parts/layout/template', 'head');
    $fixed_header = carbon_get_post_meta(get_the_ID(), 'base_fixed_header');
	if($fixed_header === true){
		$class ='is-fixedHeader';
	}else{
		$class =' ';
	}
?>

<main class="theApp <?php echo $class; ?>" id="theApp">

    <header>

        <nav class="theHeader" id="theHeader">
            <div class="container">
                <div class="theHeader-container">

                    <a class="theHeader-logo" href="<?php echo DOMAIN; ?>" title="<?php echo NAME; ?>">
                        <?php
							if(is_rtl()){
								echo BaseGetIconSvg('logoAr', 'unset' , 'unset');
							}else{
								echo BaseGetIconSvg('logo', 'unset' , 'unset');
							}
						?>
                    </a>

                    <div class="d-flex align-items-center u-full-height">

                        <?php
							if (has_nav_menu('mainMain')) {
								wp_nav_menu(
									array(
										'theme_location' => 'mainMain',
										'menu_class'     => 'theHeader-nav list-unstyled d-none d-md-flex',
										'container'      => '',
									)
								);
							}
						?>

                        <ul class="theHeader-nav list-unstyled menu-left">

							<?php echo BaseLangSwitcher(); ?>
							
                            <li class="d-lg-none">
                                <a class="icon navOverlay-open" href="javascript:void(0);">
                                    <span class="icon-bars"></span>
                                </a>
                            </li>

                        </ul>

                    </div>

                </div>
            </div>
        </nav>

        <!-- Mobile Nav -->
        <?php get_sidebar(); ?>

    </header>

    <section class="theApp-body">
        <div class="container">
