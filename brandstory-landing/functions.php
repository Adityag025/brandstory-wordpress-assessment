<?php

/**
 * Brandstory Landing theme bootstrap.
 *
 * @package Brandstory_Landing
 */

defined('ABSPATH') || exit;

define('BRANDSTORY_VERSION', '1.0.0');
define('BRANDSTORY_DIR', get_template_directory());
define('BRANDSTORY_URI', get_template_directory_uri());

/**
 * Theme setup: supports, menus, image sizes.
 */
function brandstory_setup()
{
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array('search-form', 'gallery', 'caption', 'script', 'style'));
        add_theme_support('responsive-embeds');

        register_nav_menus(
                array(
                        'primary'         => __('Primary Menu', 'brandstory-landing'),
                        'footer-links'    => __('Footer: Our Links', 'brandstory-landing'),
                        'footer-services' => __('Footer: Services', 'brandstory-landing'),
                )
        );

        add_image_size('brandstory-card', 800, 600, true);
}
add_action('after_setup_theme', 'brandstory_setup');

/**
 * Enqueue fonts, styles and scripts.
 */
function brandstory_assets()
{
        wp_enqueue_style(
                'brandstory-fonts',
                'https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap',
                array(),
                null
        );

        wp_enqueue_style(
                'brandstory-main',
                BRANDSTORY_URI . '/assets/css/main.css',
                array('brandstory-fonts'),
                filemtime(BRANDSTORY_DIR . '/assets/css/main.css')
        );

        wp_enqueue_script(
                'brandstory-main',
                BRANDSTORY_URI . '/assets/js/main.js',
                array(),
                filemtime(BRANDSTORY_DIR . '/assets/js/main.js'),
                array(
                        'in_footer' => true,
                        'strategy'  => 'defer',
                )
        );
}
add_action('wp_enqueue_scripts', 'brandstory_assets');

/**
 * Preconnect to Google Fonts for faster font loading.
 */
function brandstory_resource_hints($urls, $relation_type)
{
        if ('preconnect' === $relation_type) {
                $urls[] = array('href' => 'https://fonts.gstatic.com', 'crossorigin');
        }
        return $urls;
}
add_filter('wp_resource_hints', 'brandstory_resource_hints', 10, 2);

/**
 * Return the URL of a file inside assets/images.
 *
 * @param string $file File name, e.g. 'logo-redseer.svg'.
 * @return string
 */
function brandstory_img($file)
{
        return esc_url(BRANDSTORY_URI . '/assets/images/' . ltrim($file, '/'));
}

/**
 * Preload the hero background so the largest paint starts early.
 */
function brandstory_preload_hero() {
        if ( is_front_page() ) {
                printf( '<link rel="preload" as="image" href="%s" fetchpriority="high">' . "
", brandstory_img( 'hero-banner.webp' ) );
        }
}
add_action( 'wp_head', 'brandstory_preload_hero', 1 );

/**
 * Remove clutter WordPress adds to <head> that a landing page does not need.
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

/**
 * Fallback menu shown until a Primary Menu is assigned in wp-admin.
 */
function brandstory_nav_fallback()
{
        $items = array('Digital marketing', 'Design', 'Content', 'Production', 'Technology', 'Resources');
        echo '<ul class="nav-menu">';
        foreach ($items as $item) {
                printf(
                        '<li class="menu-item menu-item-has-children"><a href="#">%s</a></li>',
                        esc_html($item)
                );
        }
        echo '</ul>';
}

/**
 * Append a chevron icon to menu items that have a dropdown.
 */
function brandstory_menu_chevron($title, $item, $args, $depth)
{
        if ('primary' === $args->theme_location && 0 === $depth && in_array('menu-item-has-children', $item->classes, true)) {
                $title .= '<svg class="nav-menu__chevron" width="10" height="6" viewBox="0 0 10 6" aria-hidden="true"><path d="M1 1l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>';
        }
        return $title;
}
add_filter('nav_menu_item_title', 'brandstory_menu_chevron', 10, 4);

/**
 * Render a plain list of links as a fallback for an unassigned footer menu.
 *
 * @param array $links Label => URL.
 */
function brandstory_footer_links($links)
{
        echo '<ul class="footer__links">';
        foreach ($links as $label => $url) {
                printf('<li><a href="%s">%s</a></li>', esc_url($url), esc_html($label));
        }
        echo '</ul>';
}

function brandstory_footer_links_fallback()
{
        brandstory_footer_links(
                array(
                        'Digital Marketing Agency Abu Dhabi' => '#locations',
                        'Digital Marketing Agency Sharjah'   => '#locations',
                        'Digital Marketing Agency in Dubai'  => '#locations',
                        'SEO Agency in Dubai'                => '#locations',
                        'Digital Marketing Agency Ajman'     => '#locations',
                        'PR Agency in Dubai'                 => '#locations',
                        'B2B Company in Dubai'               => '#locations',
                        'Content Writing Company in Dubai'   => '#locations',
                )
        );
}

function brandstory_footer_services_fallback()
{
        brandstory_footer_links(
                array(
                        'Digital Marketing Company Dubai'    => '#services',
                        'UI UX Design Services Dubai'        => '#services',
                        'Web Design Company in Dubai'        => '#services',
                        'SEO Company in Dubai'               => '#services',
                        'Social Media Marketing in Dubai'    => '#services',
                        'Mobile App Marketing Services'      => '#services',
                        'Email Marketing Services in Dubai'  => '#services',
                        'PPC Agency in Dubai'                => '#services',
                )
        );
}
