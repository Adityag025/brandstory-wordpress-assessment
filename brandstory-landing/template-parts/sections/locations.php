<?php

/**
 * Section: Other digital marketing service locations.
 *
 * @package Brandstory_Landing
 */

$brandstory_locations = array(
    'Digital Marketing Agency in Dubai'           => '#dubai',
    'Digital Marketing Agency in Al Ain'          => '#al-ain',
    'Digital Marketing Agency in Qatar'           => '#qatar',
    'Digital Marketing Agency in Sharjah'         => '#sharjah',
    'Digital Marketing Agency in Fujairah'        => '#fujairah',
    'Digital Marketing Agency in Kuwait'          => '#kuwait',
    'Digital Marketing Agency in Abu Dhabi'       => '#abu-dhabi',
    'Digital Marketing Agency in Ras Al Khaimah'  => '#ras-al-khaimah',
    'PR Agency in Dubai'                          => '#pr-dubai',
    'Digital Marketing Agency in Ajman'           => '#ajman',
    'Digital Marketing Agency in Bahrain'         => '#bahrain',
    'Social Media Marketing Agency in Dubai'      => '#smm-dubai',
    'PPC Agency in Dubai'                         => '#ppc-dubai',
    'SEO Dubai'                                   => '#seo-dubai',
    'Content Writers in Dubai'                    => '#content-dubai',
);
?>
<section class="section locations" id="locations" aria-labelledby="locations-title">
    <div class="container">
        <div class="section__header">
            <h2 id="locations-title"><?php esc_html_e('Other Digital Marketing Services Location', 'brandstory-landing'); ?></h2>
        </div>

        <ul class="locations__list">
            <?php foreach ($brandstory_locations as $brandstory_label => $brandstory_url) : ?>
                <li class="locations__item">
                    <img src="<?php echo brandstory_img('icons/icon-pin.svg'); ?>" alt="" width="16" height="20" loading="lazy" decoding="async">
                    <a href="<?php echo esc_url($brandstory_url); ?>"><?php echo esc_html($brandstory_label); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>