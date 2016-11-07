<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

// Register Custom Post Types
add_action('init', 'register_custom_posts_init');
function register_custom_posts_init() {
    // Register Gym
    $gym_labels = array(
        'name'               => 'Gym',
        'singular_name'      => 'Gym',
        'menu_name'          => 'Gym'
    );
    $gym_args = array(
        'labels'             => $gym_labels,
        'public'             => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' )
    );
    register_post_type('gym', $gym_args);
}

add_action('init', 'register_custom_posts_result');

function register_custom_posts_result() {
    // Register Results
    $result_labels = array(
        'name'               => 'Result',
        'singular_name'      => 'Result',
        'menu_name'          => 'Result'
    );
    $result_args = array(
        'labels'             => $result_labels,
        'public'             => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' )
    );
    register_post_type('result', $result_args);
}

add_action('init', 'register_custom_posts_fight_events');

function register_custom_posts_fight_events() {
    // Register Results
    $fight_event_labels = array(
        'name'               => 'Fight Events',
        'singular_name'      => 'Fight Event',
        'menu_name'          => 'Fight Events'
    );
    $fight_event_args = array(
        'labels'             => $fight_event_labels,
        'public'             => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
        'rewrite'            => array('slug' => 'fight_events'),

    );
    register_post_type('fight_events', $fight_event_args);
}


add_filter('acf/settings/show_admin', '__return_true');

function add_query_vars_filter( $vars ){
  $vars[] = "event";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );