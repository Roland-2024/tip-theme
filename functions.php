<?php
function bettingtips_enqueue_assets() {
    $theme_version = wp_get_theme()->get('Version');

    // Enqueue CSS files
    wp_enqueue_style('bettingtips-style', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version);
    wp_enqueue_style('bettingtips-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), $theme_version);
    wp_enqueue_style('bettingtips-match-template', get_template_directory_uri() . '/assets/css/match-template.css', array(), $theme_version);
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

// Register 'match' Custom Post Type
add_action('init', 'register_match_post_type');
function register_match_post_type() {
    register_post_type('match', [
        'labels' => [
            'name'               => __('Matches', 'bettingtips'),
            'singular_name'      => __('Match', 'bettingtips'),
            'add_new_item'       => __('Add New Match', 'bettingtips'),
            'edit_item'          => __('Edit Match', 'bettingtips'),
            'all_items'          => __('All Matches', 'bettingtips'),
            'view_item'          => __('View Match', 'bettingtips'),
            'search_items'       => __('Search Matches', 'bettingtips'),
            'not_found'          => __('No matches found', 'bettingtips'),
        ],
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'matches'],
        'menu_icon'          => 'dashicons-chart-bar',
        'supports'           => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'taxonomies'         => ['category'], // Use WP categories as leagues
        'show_in_rest'       => true, // For block editor compatibility
    ]);
}

// Enable post thumbnails (featured image)
add_theme_support('post-thumbnails');
