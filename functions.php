<?php
// Add a new column to the admin post list
function Catcwp_add_custom_shortcode_column($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['shortcode'] = 'Shortcode';
        }
    }
    return $new_columns;
}
add_filter('manage_copy_to_clipboard_posts_columns', 'Catcwp_add_custom_shortcode_column');

// Populate the custom column with data
function Catcwp_display_custom_shortcode_column($column, $post_id) {
    if ($column === 'shortcode') {
        // Output the shortcode with dynamic post ID
        $meta = get_post_meta( get_the_ID(), 'copy_to_clipboard_options', true );
        $copy_clipboard_selector = strtolower($meta['copy_clipboard_selector']);
        echo '[copy_clipboard tag=' . $copy_clipboard_selector . ']';
    }
}
add_action('manage_copy_to_clipboard_posts_custom_column', 'Catcwp_display_custom_shortcode_column', 10, 2);

// Adjust column order
function Catcwp_move_shortcode_column($columns) {
    $shortcode = $columns['shortcode'];
    unset($columns['shortcode']);
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['shortcode'] = $shortcode;
        }
    }
    return $new_columns;
}
add_filter('manage_copy_to_clipboard_posts_columns', 'Catcwp_move_shortcode_column');

// Make the column sortable
function Catcwp_make_shortcode_column_sortable($columns) {
    $columns['shortcode'] = 'shortcode';
    return $columns;
}
add_filter('manage_edit-copy_to_clipboard_sortable_columns', 'Catcwp_make_shortcode_column_sortable');
