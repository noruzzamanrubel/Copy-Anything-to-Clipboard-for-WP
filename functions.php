<?php
function add_custom_menu() {
    add_options_page(
        'Copy to Clipboard',  
        'Copy to Clipboard',
        'manage_options',
        'copy-to-clipboard',
        'custom_menu_callback'
    );
}
add_action( 'admin_menu', 'add_custom_menu' );

function custom_menu_callback() {
    // Function that outputs the HTML for the custom menu page
    echo '<div class="wrap"><h1>Custom Menu</h1><p>This is a custom menu page.</p></div>';
}