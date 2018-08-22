<?php

register_taxonomy_for_object_type('category', 'Campuses'); // Register Taxonomies for Category
register_taxonomy_for_object_type('post_tag', 'Campuses');
register_post_type('campuses', // Register Custom Post Type
    array(
    'labels' => array(
        'name' => __('Campuses', 'nudev'), // Rename these to suit
        'singular_name' => __('Campuses', 'nudev'),
        'add_new' => __('Add New Campus', 'nudev'),
        'add_new_item' => __('Add New Campus', 'nudev'),
        'edit' => __('Edit Campus', 'nudev'),
        'edit_item' => __('Edit Campus', 'nudev'),
        'new_item' => __('New Campus', 'nudev'),
        'view' => __('View Campus', 'nudev'),
        'view_item' => __('View Campus', 'nudev'),
        'search_items' => __('Search Campuses', 'nudev'),
        'not_found' => __('No Campuses found', 'nudev'),
        'not_found_in_trash' => __('No Campuses found in Trash', 'nudev')
    ),
    'public' => true,
    'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
    'has_archive' => true,
    'rewrite' => array(
        'slug'       => '/',
        'with_front' => false
    ),
    'supports' => array(
        'title',
        'editor',
        'excerpt',
        'thumbnail'
    ), // Go to Dashboard Custom nudev post for supports
    'can_export' => true, // Allows export in Tools > Export
    'taxonomies' => array(
        'post_tag',
        'category'
    ) // Add Category and Post Tags support
));

?>
