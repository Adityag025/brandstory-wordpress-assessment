<?php
/**
 * Front page template: assembles the landing page from section parts.
 *
 * @package Brandstory_Landing
 */

get_header();

$brandstory_sections = array(
        'hero',
        // 'brands',
        'services',
        'about',
        'difference',
        'partner',
        'stats',
        'team',
        'faq',
        'case-studies',
        // 'locations' is rendered after the footer, see footer.php
);

foreach ( $brandstory_sections as $brandstory_section ) {
        get_template_part( 'template-parts/sections/' . $brandstory_section );
}

get_footer();