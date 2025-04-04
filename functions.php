<?php
function bettingtips_enqueue_assets() {
    $theme_version = wp_get_theme()->get('Version');

    // Enqueue CSS files
    wp_enqueue_style('bettingtips-style', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version);
    wp_enqueue_style('bettingtips-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), $theme_version);
    wp_enqueue_style('bettingtips-all-min', get_template_directory_uri() . '/assets/css/all.min.css', array(), $theme_version);

    // Enqueue JS
    wp_enqueue_script('bettingtips-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), $theme_version, true);
}
add_action('wp_enqueue_scripts', 'bettingtips_enqueue_assets');

// Preload font files (performance)
function bettingtips_resource_hints($hints, $relation_type) {
    if ('preload' === $relation_type) {
        $font_base = get_template_directory_uri() . '/assets/webfonts/';
        $hints[] = $font_base . 'fa-brands-400.woff2';
        $hints[] = $font_base . 'fa-regular-400.woff2';
        $hints[] = $font_base . 'fa-solid-900.woff2';
    }
    return $hints;
}
add_filter('wp_resource_hints', 'bettingtips_resource_hints', 10, 2);

function bettingtips_theme_setup() {
    load_theme_textdomain('bettingtips', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'bettingtips_theme_setup');
// Enable post thumbnails (featured image)
add_theme_support('post-thumbnails');

function register_match_post_type() {
    $labels = array(
        'name' => 'Matches',
        'singular_name' => 'Match',
        'menu_name' => 'Matches',
        'name_admin_bar' => 'Match',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Match',
        'new_item' => 'New Match',
        'edit_item' => 'Edit Match',
        'view_item' => 'View Match',
        'all_items' => 'All Matches',
        'search_items' => 'Search Matches',
        'not_found' => 'No matches found.',
        'not_found_in_trash' => 'No matches found in Trash.'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'has_archive' => true,
        'rewrite' => array('slug' => 'matches'),
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'taxonomies' => array('match_category'), // Our custom taxonomy
        'show_in_rest' => true, // Enables block editor
    );

    register_post_type('match', $args);
}
add_action('init', 'register_match_post_type');

function register_match_taxonomy() {
    $labels = array(
        'name'              => 'Match Categories',
        'singular_name'     => 'Match Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'menu_name'         => 'Categories',
    );

    $args = array(
        'hierarchical'      => true, // Like default categories
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => array('slug' => 'match-category'),
    );

    register_taxonomy('match_category', array('match'), $args);
}
add_action('init', 'register_match_taxonomy');

require get_template_directory() . '/acf-fields.php';
