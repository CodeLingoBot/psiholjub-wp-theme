<?php

// add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
add_action( 'wp_enqueue_scripts', 'remove_css_and_js', 20 );
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );
add_action('init', 'remove_thickbox');

add_action( 'wp_print_styles', 'deregister_my_styles', 100 );
 
function deregister_my_styles() {
  wp_dequeue_style( 'jetpack_css' );
  wp_deregister_style( 'jetpack_css' );
}


function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function remove_css_and_js() {
    wp_dequeue_style( 'mh-google-fonts' );
    wp_deregister_style( 'mh-google-fonts' );

    wp_dequeue_script( 'mh-scripts' );
    wp_deregister_script( 'mh-scripts' );

    // latter load async
    wp_dequeue_style( 'mh-font-awesome' );
    wp_deregister_style( 'mh-font-awesome' );
}

function remove_jquery_migrate( &$scripts) {
    if(!is_admin()) {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
    }
}

function remove_thickbox() {
    if (!is_admin()) {
        wp_deregister_style('thickbox');
        wp_deregister_script('thickbox');
    }
}
