<?php
/**
 * gogomedia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gogomedia
 */
if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gogomedia_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on gogomedia, use a find and replace
     * to change 'gogomedia' to the name of your theme in all the template files.
     */
    load_theme_textdomain('gogomedia', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'gogomedia'),
            )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
            'custom-background',
            apply_filters(
                    'gogomedia_custom_background_args',
                    array(
                        'default-color' => 'ffffff',
                        'default-image' => '',
                    )
            )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
            'custom-logo',
            array(
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            )
    );
}

add_action('after_setup_theme', 'gogomedia_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gogomedia_content_width() {
    $GLOBALS['content_width'] = apply_filters('gogomedia_content_width', 640);
}

add_action('after_setup_theme', 'gogomedia_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gogomedia_widgets_init() {
    register_sidebar(
            array(
                'name' => esc_html__('Sidebar', 'gogomedia'),
                'id' => 'sidebar-1',
                'description' => esc_html__('Add widgets here.', 'gogomedia'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            )
    );
}

add_action('widgets_init', 'gogomedia_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function gogomedia_scripts() {
    wp_enqueue_style('gogomedia-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('gogomedia-style', 'rtl', 'replace');

    wp_enqueue_script('jquery');
    wp_enqueue_script('gogomedia-slick', get_template_directory_uri() . '/js/slick.min.js', array(), _S_VERSION, true);
    wp_enqueue_script('gogomedia-scripts', get_template_directory_uri() . '/js/scripts.js', array(), _S_VERSION, true);

    wp_localize_script('gogomedia-scripts', 'frontend_object', [
        'template_dir' => get_template_directory_uri()
    ]);
}

add_action('wp_enqueue_scripts', 'gogomedia_scripts');

acf_register_block_type([
    'name' => 'gogogo-slider',
    'title' => 'Gogogo slider',
    'category' => 'embed',
    'icon' => 'book-alt',
    'render_template' => 'blocks/gogo-slider/gogo-slider.php',
    'enqueue_assets' => function () {
        wp_enqueue_style('gogo-slider-block-css', get_template_directory_uri() . '/blocks/gogo-slider/gogo-slider.css');
        wp_enqueue_script('gogo-slider-block-js', get_template_directory_uri() . '/blocks/gogo-slider/gogo-slider.js');
        wp_localize_script('gogo-slider-block-js', 'frontend_object', [
            'template_dir' => get_template_directory_uri()]);
    }
]);

