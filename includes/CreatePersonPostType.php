<?php
namespace AlfaSoft;

if (!defined('ABSPATH')) {
	exit;
}
class CreatePersonPostType
{
	public function __construct()
	{
		add_action('init', [$this, 'personPostType']);
	}

	public function personPostType()
	{
		$labels = [
			'name'                  => _x('Persons', 'Post type general name', PLUGIN_TEXTDOMAIN),
			'singular_name'         => _x('Person', 'Post type singular name', PLUGIN_TEXTDOMAIN),
			'menu_name'             => _x('Persons', 'Admin Menu text', PLUGIN_TEXTDOMAIN),
			'name_admin_bar'        => _x('Person', 'Add New on Toolbar', PLUGIN_TEXTDOMAIN),
			'add_new'               => __('Add Person', PLUGIN_TEXTDOMAIN),
			'add_new_item'          => __('Add New Person', PLUGIN_TEXTDOMAIN),
			'new_item'              => __('New Person', PLUGIN_TEXTDOMAIN),
			'edit_item'             => __('Edit Person', PLUGIN_TEXTDOMAIN),
			'view_item'             => __('View Person', PLUGIN_TEXTDOMAIN),
			'all_items'             => __('All Persons', PLUGIN_TEXTDOMAIN),
			'search_items'          => __('Search Persons', PLUGIN_TEXTDOMAIN),
			'parent_item_colon'     => __('Parent Persons:', PLUGIN_TEXTDOMAIN),
			'not_found'             => __('No Persons found.', PLUGIN_TEXTDOMAIN),
			'not_found_in_trash'    => __('No Persons found in Trash.', PLUGIN_TEXTDOMAIN),
			'archives'              => _x('Person archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', PLUGIN_TEXTDOMAIN),
			'insert_into_item'      => _x('Insert into Person', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', PLUGIN_TEXTDOMAIN),
			'uploaded_to_this_item' => _x('Uploaded to this Person', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', PLUGIN_TEXTDOMAIN),
			'filter_items_list'     => _x('Filter Persons list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', PLUGIN_TEXTDOMAIN),
			'items_list_navigation' => _x('Persons list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', PLUGIN_TEXTDOMAIN),
			'items_list'            => _x('Persons list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', PLUGIN_TEXTDOMAIN),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => ['slug' => 'person'],
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => ['title'],
		];

		register_post_type('person', $args);
	}
}
