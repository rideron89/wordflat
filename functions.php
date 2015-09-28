<?php
/**
 * wordflat functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wordflat
 */

if ( ! function_exists( 'wordflat_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wordflat_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on wordflat, use a find and replace
     * to change 'wordflat' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'wordflat', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'wordflat' ),
        ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        ) );

    /*
     * Enable support for Post Formats.
     * See https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'wordflat_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
        ) ) );
}
endif; // wordflat_setup
add_action( 'after_setup_theme', 'wordflat_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wordflat_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'wordflat_content_width', 640 );
}
add_action( 'after_setup_theme', 'wordflat_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wordflat_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Login Sidebar', 'wordflat' ),
        'id'            => 'sidebar-login',
        'description'   => 'Sidebar card for allowing user login',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
        ) );
}
add_action( 'widgets_init', 'wordflat_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wordflat_scripts() {
    wp_enqueue_style( 'wordflat-main', get_template_directory_uri() . '/assets/styles.min.css' );
    wp_enqueue_style( 'wordflat-style', get_stylesheet_uri() );

    wp_enqueue_script( 'wordflat-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'wordflat-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    wp_enqueue_script( 'jQuery', '//code.jquery.com/jquery-1.11.3.min.js' );
    wp_enqueue_script( 'FitText', '//cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.js' );

    wp_enqueue_script( 'wordflat-script', get_template_directory_uri() . '/assets/scripts.min.js', array('jQuery', 'FitText') );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'wordflat_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wordflat_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    return $classes;
}
add_filter( 'body_class', 'wordflat_body_classes' );


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wordflat_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'wordflat_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wordflat_customize_preview_js() {
    wp_enqueue_script( 'wordflat_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'wordflat_customize_preview_js' );

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function wordflat_jetpack_setup() {
    add_theme_support( 'infinite-scroll', array(
        'container' => 'main',
        'render'    => 'wordflat_infinite_scroll_render',
        'footer'    => 'page',
    ) );
} // end function wordflat_jetpack_setup
add_action( 'after_setup_theme', 'wordflat_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function wordflat_infinite_scroll_render() {
    while ( have_posts() ) {
        the_post();
        get_template_part( 'template-parts/content', get_post_format() );
    }
} // end function wordflat_infinite_scroll_render

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';