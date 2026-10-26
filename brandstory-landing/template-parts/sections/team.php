<?php

/**
 * Section: Meet our expert team (photo carousel).
 *
 * @package Brandstory_Landing
 */

$brandstory_team_photos = array(
    array('file' => 'team-img-1.webp', 'alt' => 'BrandStory team collaborating at their desks'),
    array('file' => 'team-img-2.webp', 'alt' => 'Designer working on a desktop computer'),
    array('file' => 'team-img-3.webp', 'alt' => 'Team members reviewing work on laptops'),
    array('file' => 'team-img-1.webp', 'alt' => 'BrandStory office workspace'),
    array('file' => 'team-img-2.webp', 'alt' => 'Marketing team at work'),
);
?>
<section class="section team" id="team" aria-labelledby="team-title">
    <div class="container">
        <div class="carousel-head">
            <h2 id="team-title"><?php esc_html_e('Meet Our Expert Team', 'brandstory-landing'); ?></h2>
            <div class="carousel-nav">
                <button class="carousel-btn" type="button" data-carousel-prev aria-label="<?php esc_attr_e('Previous photo', 'brandstory-landing'); ?>">
                    <img src="<?php echo brandstory_img('icons/left-circle-arrow.png'); ?>" alt="" width="44" height="44">
                </button>
                <button class="carousel-btn" type="button" data-carousel-next aria-label="<?php esc_attr_e('Next photo', 'brandstory-landing'); ?>">
                    <img src="<?php echo brandstory_img('icons/right-circle-arrow.png'); ?>" alt="" width="44" height="44">
                </button>
            </div>
        </div>
    </div>

    <div class="carousel carousel--team" data-carousel data-carousel-loop>
        <ul class="carousel__track" data-carousel-track>
            <?php foreach ($brandstory_team_photos as $brandstory_photo) : ?>
                <li class="carousel__slide" data-carousel-slide>
                    <img src="<?php echo brandstory_img('team/' . $brandstory_photo['file']); ?>" alt="<?php echo esc_attr($brandstory_photo['alt']); ?>" width="340" height="227" loading="lazy" decoding="async">
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>