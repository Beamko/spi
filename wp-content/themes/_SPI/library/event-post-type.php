<?php

// let's create the function for the custom type
function create_event_post_type() {
    // creating (registering) the custom type
    register_post_type( 'event',
        array( 'labels' => array(
            'name' => __( 'Events', 'bonestheme' ), /* This is the Title of the Group */
            'singular_name' => __( 'Event', 'bonestheme' ), /* This is the individual type */
            'all_items' => __( 'All Events', 'bonestheme' ), /* the all items menu item */
            'add_new' => __( 'Add New', 'bonestheme' ), /* The add new menu item */
            'add_new_item' => __( 'Add New Event', 'bonestheme' ), /* Add New Display Title */
            'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
            'edit_item' => __( 'Edit Event', 'bonestheme' ), /* Edit Display Title */
            'new_item' => __( 'New Event', 'bonestheme' ), /* New Display Title */
            'view_item' => __( 'View Event', 'bonestheme' ), /* View Display Title */
            'search_items' => __( 'Search Events', 'bonestheme' ), /* Search Custom Type Title */
            'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ), /* This displays if there are no entries yet */
            'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
            ), /* end of arrays */
            'description' => __( 'SPI Events', 'bonestheme' ), /* Custom Type Description */
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'show_ui' => true,
            'query_var' => true,
            'menu_position' => 9, /* this is what order you want it to appear in on the left hand side menu */
            'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
            'rewrite'   => array( 'slug' => 'events', 'with_front' => false ), /* you can specify its url slug */
            'has_archive' => true, /* you can rename the slug here */
            'capability_type' => 'post',
            'hierarchical' => false,
            /* the next one is important, it tells what's enabled in the post editor */
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' , 'revisions', 'sticky', 'trackbacks')
        ) /* end of options */
    ); /* end of register post type */

}

    // adding the function to the Wordpress init
    add_action( 'init', 'create_event_post_type');

    // now let's add custom categories (these act like categories)
    register_taxonomy( 'event_type',
        array('event'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
        array('hierarchical' => true,     /* if this is true, it acts like categories */
            'labels' => array(
                'name' => __( 'Event Categories', 'bonestheme' ), /* name of the custom taxonomy */
                'singular_name' => __( 'Event Category', 'bonestheme' ), /* single taxonomy name */
                'search_items' =>  __( 'Search Event Categories', 'bonestheme' ), /* search title for taxomony */
                'all_items' => __( 'All Event Categories', 'bonestheme' ), /* all title for taxonomies */
                'parent_item' => __( 'Parent Event Category', 'bonestheme' ), /* parent title for taxonomy */
                'parent_item_colon' => __( 'Parent Event Category:', 'bonestheme' ), /* parent taxonomy title */
                'edit_item' => __( 'Edit Event Category', 'bonestheme' ), /* edit custom taxonomy title */
                'update_item' => __( 'Update Event Category', 'bonestheme' ), /* update title for taxonomy */
                'add_new_item' => __( 'Add New Event Category', 'bonestheme' ), /* add new title for taxonomy */
                'new_item_name' => __( 'New Event Category Name', 'bonestheme' ) /* name title for taxonomy */
            ),
            'show_admin_column' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'event-category' ),
        )
    );


?>
