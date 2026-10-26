<?php

/**
 * Section: Case studies carousel.
 *
 * @package Brandstory_Landing
 */

$brandstory_cases = array(
    array('file' => 'case-1.webp', 'title' => 'Glass facade manufacturer', 'alt' => 'Glass facade of a commercial building', 'link' => '#case-glass'),
    array('file' => 'case-2.webp', 'title' => 'Industrial engineering firm', 'alt' => 'Engineer reviewing a 3D engine model on a tablet', 'link' => '#case-engineering'),
    array('file' => 'case-3.webp', 'title' => 'Professional services consultancy', 'alt' => 'Two consultants discussing a report', 'link' => '#case-consulting'),
);
?>
<section class="section case-studies" id="case-studies" aria-labelledby="case-studies-title">
    <div class="container">
        <div class="carousel-head">
            <h2 id="case-studies-title"><?php esc_html_e('Proven Digital Marketing Success Our Abu Dhabi Case Studies', 'brandstory-landing'); ?></h2>
            <div class="carousel-nav">
                <button class="carousel-btn" type="button" data-carousel-prev aria-label="<?php esc_attr_e('Previous case study', 'brandstory-landing'); ?>">
                    <img src="<?php echo brandstory_img('icons/left-circle-arrow.png'); ?>" alt="" width="44" height="44">
                </button>
                <button class="carousel-btn" type="button" data-carousel-next aria-label="<?php esc_attr_e('Next case study', 'brandstory-landing'); ?>">
                    <img src="<?php echo brandstory_img('icons/right-circle-arrow.png'); ?>" alt="" width="44" height="44">
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="carousel carousel--cases" data-carousel data-carousel-loop>
            <ul class="carousel__track" data-carousel-track>
                <?php foreach ($brandstory_cases as $brandstory_case) : ?>
                    <li class="carousel__slide" data-carousel-slide>
                        <a class="case-card" href="<?php echo esc_url($brandstory_case['link']); ?>" aria-label="<?php echo esc_attr($brandstory_case['title']); ?>">
                            <img src="<?php echo brandstory_img('case-studies/' . $brandstory_case['file']); ?>" alt="<?php echo esc_attr($brandstory_case['alt']); ?>" width="420" height="620" loading="lazy" decoding="async">
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
</section>