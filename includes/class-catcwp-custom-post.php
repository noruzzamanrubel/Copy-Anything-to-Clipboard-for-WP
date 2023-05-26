<?php
class Catcwp_Custom_Post {
    public function __construct() {
        add_action('init', array($this, 'catcwp_generate_custom_post'));
    }

    public function catcwp_generate_custom_post() {

        $labels = array(
            'name'                  => __('Copy to Clipboard', 'catcwp'),
            'singular_name'         => __('Copy to Clipboard', 'catcwp'),
            'menu_name'             => __('Copy to Clipboard', 'catcwp'),
            'name_admin_bar'        => __('Copy to Clipboard', 'catcwp'),
            'archives'              => __('Copy to Clipboard Archives', 'catcwp'),
            'attributes'            => __('Copy to Clipboard Attributes', 'catcwp'),
            'parent_item_colon'     => __('Parent Item:', 'catcwp'),
            'all_items'             => __('All Items', 'catcwp'),
            'add_new_item'          => __('Add New Item', 'catcwp'),
            'add_new'               => __('Add New', 'catcwp'),
            'new_item'              => __('New Item', 'catcwp'),
            'edit_item'             => __('Edit Item', 'catcwp'),
            'update_item'           => __('Update Item', 'catcwp'),
            'view_item'             => __('View Item', 'catcwp'),
            'view_items'            => __('View Items', 'catcwp'),
            'search_items'          => __('Search Item', 'catcwp'),
            'not_found'             => __('Not found', 'catcwp'),
            'not_found_in_trash'    => __('Not found in Trash', 'catcwp'),
            'featured_image'        => __('Featured Image', 'catcwp'),
            'set_featured_image'    => __('Set featured image', 'catcwp'),
            'remove_featured_image' => __('Remove featured image', 'catcwp'),
            'use_featured_image'    => __('Use as featured image', 'catcwp'),
            'insert_into_item'      => __('Insert into item', 'catcwp'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'catcwp'),
            'items_list'            => __('Items list', 'catcwp'),
            'items_list_navigation' => __('Items list navigation', 'catcwp'),
            'filter_items_list'     => __('Filter items list', 'catcwp'),
        );

        $args = array(
            'label'                 => __('Copy to Clipboard', 'catcwp'),
            'description'           => __('Custom post type for Copy to Clipboard functionality', 'catcwp'),
            'labels'                => $labels,
            'supports'              => array('title'),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );
        
        register_post_type('copy_to_clipboard', $args);
    }
}

$catcwp_custom_post = new Catcwp_Custom_Post();