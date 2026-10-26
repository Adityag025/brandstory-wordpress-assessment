<?php

/**
 * Section: About / We are digital marketing experts.
 *
 * @package Brandstory_Landing
 */

$brandstory_about_points = array(
    'BrandStory has been delivering digital marketing and growth engineering services to clients across Dubai and the UAE since 2014. With an expert team of digital marketers, we power up global brands through search engine optimization, Google Ads and Bing Ads, Social Media, influencer marketing, website design and development services.',
    'Our expertise spans SEO, PPC, social media marketing, online reputation management, content strategy, email marketing, branding, and website development. Our goal is improving your business visibility, increasing qualified traffic, and converting engagement into real business value. At BrandStory, we skip shortcuts and deeply study Abu Dhabi\'s industry landscape, audience behavior, and competition to create digital campaigns that resonate locally.',
);
?>
<section class="section about" id="about" aria-labelledby="about-title">
    <div class="container split">
        <div class="split__media">
            <img src="<?php echo brandstory_img('about-visual.webp'); ?>" alt="<?php esc_attr_e('Digital marketer holding a laptop surrounded by analytics charts', 'brandstory-landing'); ?>" width="718" height="656" loading="lazy" decoding="async">
        </div>

        <div class="split__content">
            <h2 id="about-title"><?php esc_html_e('We are Digital Marketing Experts in Abu Dhabi', 'brandstory-landing'); ?></h2>
            <ul class="bullet-list">
                <?php foreach ($brandstory_about_points as $brandstory_point) : ?>
                    <li><?php echo esc_html($brandstory_point); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>