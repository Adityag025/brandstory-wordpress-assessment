<?php

/**
 * Section: Hero with trusted-brands strip.
 *
 * @package Brandstory_Landing
 */

$brandstory_logos = array(
    'logo-adarsh.png'      => 'Adarsh',
    'logo-clarks.png'      => 'Clarks',
    'logo-ferns.png'       => 'Ferns',
    'logo-han-digital.png' => 'Han Digital',
    'logo-indus.png'       => 'Indus',
    'logo-origin.png'      => 'Origin',
    'logo-prema.png'       => 'Prema',
    'logo-shreemeera.png'  => 'Shreemeera',
    'logo-sisa.png'        => 'Sisa',
    'logo-wesure.png'      => 'Wesure',
    'logo-wintrust.png'    => 'Wintrust',
    'logo-bluedove.png'    => 'Bluedove Bangalore',
);
?>
<section class="hero" aria-labelledby="hero-title">
    <div class="container hero__inner">
        <h1 class="hero__title" id="hero-title"><?php esc_html_e('Digital Marketing Agency In Abu Dhabi', 'brandstory-landing'); ?></h1>
        <p class="hero__text"><?php esc_html_e('Looking for a digital marketing agency in Abu Dhabi? With 12+ years of expertise, BrandStory delivers culturally intelligent, data-driven strategies that connect your brand with high-intent UAE audiences.', 'brandstory-landing'); ?></p>
        <a class="btn btn--dark hero__cta" href="#contact">
            <svg class="btn__icon" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true">
                <path d="M6 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" />
            </svg>
            <?php esc_html_e('Get in Touch', 'brandstory-landing'); ?>
        </a>
    </div>

    <?php
    $brandstory_rows = array_chunk($brandstory_logos, (int) ceil(count($brandstory_logos) / 2), true);
    ?>
    <div class="brands">
        <h2 class="brands__title container"><?php esc_html_e('Trusted by Top Brands Across Industries', 'brandstory-landing'); ?></h2>

        <?php foreach ($brandstory_rows as $brandstory_row_index => $brandstory_row) : ?>
            <div class="marquee <?php echo $brandstory_row_index ? 'marquee--reverse' : ''; ?>" aria-label="<?php esc_attr_e('Client logos', 'brandstory-landing'); ?>">
                <div class="marquee__track">
                    <?php for ($brandstory_pass = 0; $brandstory_pass < 3; $brandstory_pass++) : ?>
                        <ul class="marquee__list" <?php echo $brandstory_pass ? 'aria-hidden="true"' : ''; ?>>
                            <?php foreach ($brandstory_row as $brandstory_file => $brandstory_name) : ?>
                                <li class="marquee__item">
                                    <img src="<?php echo brandstory_img('logo-carousel/' . $brandstory_file); ?>" alt="<?php echo $brandstory_pass ? '' : esc_attr($brandstory_name); ?>" loading="lazy" decoding="async">
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>