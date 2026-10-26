<?php

/**
 * Section: Services (SEO, SMM, PPC cards).
 *
 * @package Brandstory_Landing
 */

$brandstory_services = array(
    array(
        'icon'  => 'icon-seo.svg',
        'title' => 'Search Engine Optimization (SEO)',
        'text'  => 'Search Engine Optimization (SEO) is crucial for enhancing your website\'s visibility and attracting organic traffic. Our SEO experts in Abu Dhabi implement proven strategies to improve rankings, drive qualified traffic, and secure top positions in search results (SERPs).',
        'link'  => '#seo',
    ),
    array(
        'icon'  => 'icon-smm.png',
        'title' => 'Social Media Marketing (SMM)',
        'text'  => 'Boost your brand\'s presence with targeted social media marketing. We design compelling campaigns that capture attention and connect with audiences across Facebook, Instagram, TikTok, LinkedIn, and Twitter in Abu Dhabi.',
        'link'  => '#smm',
    ),
    array(
        'icon'  => 'icon-ppc.png',
        'title' => 'Pay Per Click (PPC)',
        'text'  => 'We deliver performance-focused PPC campaign management tailored for businesses in Abu Dhabi. As a certified Google Partner and Meta Partner agency, we optimize pay-per-click campaigns to ensure maximum reach, high-quality leads, and the best return on investment.',
        'link'  => '#ppc',
    ),
);
?>
<section class="section services" id="services" aria-labelledby="services-title">
    <div class="container">
        <div class="section__header">
            <h2 id="services-title"><?php esc_html_e('Results-Driven Digital Marketing Services in Abu Dhabi, UAE', 'brandstory-landing'); ?></h2>
        </div>

        <div class="grid grid--3">
            <?php foreach ($brandstory_services as $brandstory_service) : ?>
                <article class="card service-card">
                    <div class="service-card__icon">
                        <img src="<?php echo brandstory_img('icons/' . $brandstory_service['icon']); ?>" alt="" width="28" height="28" loading="lazy" decoding="async">
                    </div>
                    <h3 class="card__title"><?php echo esc_html($brandstory_service['title']); ?></h3>
                    <p class="service-card__text"><?php echo esc_html($brandstory_service['text']); ?></p>
                    <a class="link-arrow" href="<?php echo esc_url($brandstory_service['link']); ?>">
                        <?php esc_html_e('Know more', 'brandstory-landing'); ?>
                        <svg width="20" height="12" viewBox="0 0 20 12" aria-hidden="true">
                            <path d="M0 6h18M13 1l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.5" />
                        </svg>
                        <span class="screen-reader-text"><?php echo esc_html(' ' . $brandstory_service['title']); ?></span>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>