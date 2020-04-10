<?php
// Register Custom Post Type
#add_action( 'init', 'bs_register_post_type' );
function bs_register_post_type() {
    $labels = array(
        'name'          => 'Projects',
        'singular_name' => 'Project',
        'add_new'       => 'Add New',
        'add_new_item'  => 'Add New Testimonial',
        'edit_item'     => 'Edit Testimonial',
        'new_item'      => 'New Testimonial',
        'view_item'     => 'View Testimonial',
        'search_items'  => 'Search Projects',
        'not_found'     =>  'No Projects found',
        'not_found_in_trash'  => 'No Projects in the trash',
        'parent_item_colon'   => '',
    );
 
    register_post_type( 'projects', array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'exclude_from_search'   => true,
        'query_var'             => true,
        'rewrite'               => true,
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => 10,
        'supports'              => array( 'title','author', 'revisions', 'page-attributes', ),
        //'register_meta_box_cb'  => 'testimonials_meta_boxes', // Callback function for custom metaboxes
    ) );
}