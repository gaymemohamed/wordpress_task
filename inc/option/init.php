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
		// Field::make( 'text', 'pos_company', __( 'Position In Company' ) ),
    Field::make( 'select', 'pos_company', __( 'Choose Position' ) )
      ->set_options( array(
        ''             => '',
          'CEO' => __( 'CEO' ),
          'Project Manager' => __( 'Project Manager' ),
          'Developer' => __( 'Developer' ),
      ) ),
        Field::make( 'complex', 'package', __( 'Social Media Links' ) )
			->add_fields( array(
                Field::make( 'select', 'select_social', __( 'Choose Social' ) )
				->set_options( array(
                    ''             => '',
                    'github' => 'Github' ,
                    'linkedin' => 'Linkedin' ,
                    'facebook' => 'Facebook' ,
                    ) ),
                    Field::make( 'text', 'social_link', __( 'Social Link' ) ),
		) )
    ) );
    
   

}