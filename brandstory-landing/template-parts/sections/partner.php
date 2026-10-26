<?php

/**
 * Section: Trusted digital marketing partner (3 illustrated cards).
 *
 * @package Brandstory_Landing
 */

$brandstory_reasons = array(
    array(
        'image' => 'landscape.png',
        'title' => 'We Understand The Landscape',
        'text'  => 'With deep local digital marketing expertise in Abu Dhabi, we provide sharp Abu Dhabi market insights into cultural nuances, affluent consumer behaviors, multilingual demands, and regulatory challenges. This insider knowledge helps us navigate the emirate\'s dynamic ecosystem from Hub71 startups to ADGM enterprises for authentic, impactful brand connections.',
    ),
    array(
        'image' => 'success.png',
        'title' => 'Tailored Strategies for Success',
        'text'  => 'We craft fully customized digital strategies that address Abu Dhabi\'s unique digital marketing challenges, including intense competition, cultural diversity, and evolving trends. Blending global best practices with hyper-local insights, our approach delivers sustainable visibility, higher engagement, and measurable growth turning your brand into a preferred choice across the UAE.',
    ),
    array(
        'image' => 'challenges.png',
        'title' => 'Overcoming Market Challenges',
        'text'  => 'Our team excels in tackling Abu Dhabi\'s specific digital marketing challenges, from multilingual audience targeting and rapid trend shifts to strict regulations and high expectations. Through data-driven, culturally attuned solutions, we create robust, adaptable strategies that ensure long-term success, strong ROI, and lasting brand preference in the competitive UAE landscape.',
    ),
);
?>
<section class="section partner" id="partner" aria-labelledby="partner-title">
    <div class="container">
        <div class="section__header">
            <h2 id="partner-title"><?php esc_html_e('Your Trusted Digital Marketing Partner in Abu Dhabi', 'brandstory-landing'); ?></h2>
            <p><?php esc_html_e('Selecting the right digital marketing partner in Abu Dhabi is essential to ensure your brand connects with the right audience, maximizes ROI, and achieves sustainable growth in a competitive market.', 'brandstory-landing'); ?></p>
        </div>

        <div class="grid grid--3">
            <?php foreach ($brandstory_reasons as $brandstory_reason) : ?>
                <article class="card reason-card">
                    <div class="reason-card__media">
                        <img src="<?php echo brandstory_img($brandstory_reason['image']); ?>" alt="" width="195" height="195" loading="lazy" decoding="async">
                    </div>
                    <h3 class="card__title"><?php echo esc_html($brandstory_reason['title']); ?></h3>
                    <p class="reason-card__text"><?php echo esc_html($brandstory_reason['text']); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>