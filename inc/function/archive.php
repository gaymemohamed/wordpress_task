<?php

if (!defined('ABSPATH')) exit;


// team
if(!function_exists('baseArchiveTeam')){
	function baseArchiveTeam() {

		$labels = array(
			'name'                  => _x( 'Team', 'Post Type General Name', 'base' ),
			'singular_name'         => _x( 'member', 'Post Type Singular Name', 'base' ),
			'menu_name'             => baseLang('Team','الفريق'),
			'name_admin_bar'        => baseLang('Team','الفريق'),
			'archives'              => baseLang('Team Archive','تصنيف الفريق'),
			'attributes'            => baseLang('Team Attribute','خصائص الفريق'),
			'parent_item_colon'     => baseLang('Parent member','عضو الأب'),
			'all_items'             => baseLang('All Team','كل الفريق'),
			'add_new_item'          => baseLang('Add New member','إضافة قصة جديدة'),
			'add_new'               => baseLang('Add New','إضافة جديد'),
			'new_item'              => baseLang('New member','قصة جديدة'),
			'edit_item'             => baseLang('Edit member','تعديل عضو'),
			'update_item'           => baseLang('Update member','تحديث عضو'),
			'view_item'             => baseLang('View member','عرض عضو'),
			'view_items'            => baseLang('View Team','عرض الفريق'),
			'search_items'          => baseLang('Search member','عرض عضو'),
			'not_found'             => baseLang('Not found','لا يوجد'),
			'not_found_in_trash'    => baseLang('Not found in Trash','لا يوجد في سلة المهملات'),
			'featured_image'        => baseLang('Featured Image','الصورة البارزة'),
			'set_featured_image'    => baseLang('Set featured image','إضافة الصورة البارزة'),
			'remove_featured_image' => baseLang('Remove featured image','حذف الصورة بارزة'),
			'use_featured_image'    => baseLang('Use as featured image','إستخدام كصورة بارزة'),
			'insert_into_item'      => baseLang('Insert into member','إدخال إلي عضو'),
			'uploaded_to_this_item' => baseLang('Uploaded to this member','رفع إلي عضو'),
			'items_list'            => baseLang('Team list','قائمة الفريق'),
			'items_list_navigation' => baseLang('Team list navigation','قائمة الفريق'),
			'filter_items_list'     => baseLang('Filter Team list','تصفيه الفريق'),
		);

		$args = array(
			'label'                 => baseLang('member','عضو'),
			'labels'                => $labels,
			'supports'              => array('title', 'editor','thumbnail'),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-networking',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'member', $args );

	}
	add_action( 'init', 'baseArchiveTeam', 0 );
}

