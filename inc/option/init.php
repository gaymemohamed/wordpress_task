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
    
    Container::make( 'term_meta', __( 'Readers Properties' ) )
    ->where( 'term_taxonomy', '=', 'readers-department' )
    ->add_fields( array(
		Field::make( 'image', 'custom_tax_thumb', __( 'Thumbnail' ) ),
    ));

    Container::make( 'post_meta', __( 'Properties' ) )
    ->where( 'post_type', 'IN', array('nader' , 'ramadan' , 'elsala' , 'telawa') )
    ->add_fields( array(
		Field::make( 'text', 'custom_link', __( 'لينك السورة أو الفيديو' ) ),
		Field::make( 'text', 'custom_title', __( 'اسم المقرئ' ) ),
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