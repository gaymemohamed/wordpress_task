<?php
if (!defined('ABSPATH')) {
    exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Fields
add_action('carbon_fields_register_fields', 'baseThemeOption');
function baseThemeOption()
{
    // init options
    
    Container::make( 'post_meta', __( 'Member Additions' ) )
    ->where( 'post_type', '=', 'member'  )
    ->add_fields( array(
		Field::make( 'text', 'pos_company', __( 'Position In Company' ) ),
        Field::make( 'complex', 'package', __( 'Social Media Links' ) )
			->add_fields( array(
                Field::make( 'select', 'select_social', __( 'Choose Social' ) )
				->set_options( array(
                    ''             => '',
                    'text-secondary' => __( 'Github' ),
                    'text-primary' => __( 'Linkedin' ),
                    'text-warning' => __( 'Facebook' ),
                    
                    ) ),
                    Field::make( 'text', 'social_link', __( 'Social Link' ) ),
		) )
    ) );
    
    Container::make( 'post_meta', __( 'اعدادات المقاطع' ) )
    ->where( 'post_type', 'IN', array('clip' , 'explanation' ))
    ->add_fields( array(
		Field::make( 'text', 'custom_v_link', __( 'لينك الفيديو' )),
    Field::make( 'text', 'custom_v_title', __( 'اسم المقرئ' ) ),
    ));

    Container::make( 'post_meta', __( 'اعدادات السورة' ))
    ->where( 'post_type', '=', 'reader')
    ->add_fields( array(
		// Field::make( 'text', 'custom_s_link', __( 'لينك السورة' )),
    Field::make( 'file', 'custom_s_link', __( 'ارفع السورة' ) )
	    ->set_value_type( 'url' )
    ));

   

}