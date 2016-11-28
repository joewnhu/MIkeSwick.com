<?php

require_once(get_stylesheet_directory().'/inc/extend-simple-composer.php');

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
/* -----------------------------------------------------------------------------
 * The Comment Link
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_comment_link' ) ) {
    function vw_the_comment_link() {
        if ( comments_open() ) : 
        ?>
        <a class="vw-post-meta-icon vw-post-comment-count" href="<?php comments_link(); ?>" title="<?php echo esc_attr__( 'Comments', 'envirra' ); ?>">
            <i class="vw-icon icon-iconic-comment-alt2"></i> <span class="vw-post-comment-number"><?php  vw_number_prefixes( comments_number( '0', '1', '%' ) ) ?></span>
        </a>
        <?php
        endif;
    }
}

/* -----------------------------------------------------------------------------
 * The Copyright Text
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_copyright' ) ) {
    function vw_the_copyright() {
        $copyright_text = vw_get_theme_option( 'copyright_text' );
        if ( function_exists( 'icl_t' ) ) {
            $copyright_text = icl_t( VW_THEME_NAME.' Copyright', strtolower(VW_THEME_NAME.'_copyright'), $copyright_text );
        }
        
        echo '<div class="vw-copyright">Copyright &copy;';
        echo date("Y");
        echo do_shortcode( $copyright_text );
        echo '</div>';
    }
}

// Register Custom Post Types
add_action('init', 'register_custom_posts_init');
function register_custom_posts_init() {
    // Register Gym
    $gym_labels = array(
        'name'               => 'Gym',
        'singular_name'      => 'Gym',
        'menu_name'          => 'Gyms'
    );
    $gym_args = array(
        'labels'             => $gym_labels,
        'public'             => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'taxonomies'         => array( 'category' ),
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
        'rewrite'            => array('slug' => 'gym')

    );
    register_post_type('gym', $gym_args);
}
/* Adds country and state columns to gym editor */
add_filter('manage_gym_posts_columns' , 'add_gym_columns');
function add_gym_columns($columns) {
    return array_merge($columns, 
        array('gym_country' => __('Country'),
                'gym_state' => __('State')
        )
    );
}

/* Adds meta data for country and state to the new columns in gym editor */
add_action('manage_gym_posts_custom_column' , 'gym_custom_columns', 10, 2 );
 
function gym_custom_columns( $column, $post_id ) {
    switch ( $column ) {
 
    case 'gym_country' :
        echo get_field('gym_country', $post_id);
        break;
    case 'gym_state' :
        echo get_field('gym_state', $post_id);
        break;
    }
}

add_action( 'init', 'create_location_tax' );

function create_location_tax() {
    register_taxonomy(
        'location',
        'Gym',
        array(
            'label' => __( 'Location' ),
            'rewrite' => false,
            'hierarchical' => true,
        )
    );
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
        'taxonomies'         => array( 'category' ),
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

/* -----------------------------------------------------------------------------
 * Adding extra slug for gym_locator page
 * -------------------------------------------------------------------------- */

// Register the variables that will be used as parameters on the url

add_action('init', 'custom_rewrite_tag', 10, 0);
function custom_rewrite_tag() {
  add_rewrite_tag('%country_slug%', '([^&]+)');
  add_rewrite_tag('%state_slug%', '([^&]+)');
}

// Build the rewrite rules, for the extra parameter
add_action('init', 'custom_rewrite_rules', 10, 0);
function custom_rewrite_rules() {
  //   add_rewrite_rule('^gym-locator/([^/]+)/([^/]+)/page/([^/]d+)/?$','index.php?page_id=431&country_slug=$matches[1]&state_slug=$matches[2]&page=$matches[3]','top');
    add_rewrite_rule('^gym-locator/([^/]+)/([^/]+)/?$','index.php?page_id=431&country_slug=$matches[1]&state_slug=$matches[2]','top');
  //  add_rewrite_rule('^gym-locator/([^/]+)/page/([0-9]{1,})/?','index.php?page_id=431&country_slug=$matches[1]&page=2','top');
    add_rewrite_rule('^gym-locator/([^/]+)/?$','index.php?page_id=431&country_slug=$matches[1]','top');
}


/* -----------------------------------------------------------------------------
 * Adding favicon to admin area
 * -----------------------------------------------------------------------------*/
function add_favicon() {
    $favicon_url = get_stylesheet_directory_uri() . '/admin-favicon.ico';
    echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
}
  
// Now, just make sure that function runs when you're on the login page and admin pages  
add_action('admin_head', 'add_favicon');


/* -----------------------------------------------------------------------------
 * Adjusing login page 
 * -------------------------------------------------------------------------- */

function my_login_logo() { ?>
    <style type="text/css">
        #login{
            width:500px !important;
        }
        #login h1 a, .login h1 a {
            background-image: url(/wp-content/uploads/2016/11/mikeswick-logo-tag-retnia.png);
            padding-bottom: 30px;
            width:500px;
            background-size:500px; 
        }
        body{
            background-color: #fff !important;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
