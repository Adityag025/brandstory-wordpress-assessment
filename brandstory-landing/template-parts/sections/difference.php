<?php

/**
 * Section: What sets us apart (image + accordion).
 *
 * @package Brandstory_Landing
 */

$brandstory_points = array(
    array(
        'title' => 'Human-Driven & AI-Enabled Strategy',
        'text'  => 'We blend cutting-edge AI for data analysis, trend prediction, and optimization with human creativity, storytelling, and Abu Dhabi cultural insight. This ethical, balanced approach delivers innovative, emotionally resonant campaigns that ensure lasting engagement and strong ROI.',
    ),
    array(
        'title' => 'Transparency & Collaboration',
        'text'  => 'You get clear reporting, open communication, and a team that works as an extension of yours, so every decision is shared and every result is visible.',
    ),
    array(
        'title' => 'Tailored, Results-Driven Innovation',
        'text'  => 'No templates. Every strategy is built around your market, your audience, and your growth targets, then measured against real business outcomes.',
    ),
    array(
        'title' => 'Growth Engineering Expertise',
        'text'  => 'We combine marketing, data, and technology to build repeatable growth systems rather than one-off campaigns.',
    ),
);
?>
<section class="section difference" id="difference" aria-labelledby="difference-title">
    <div class="container">
        <div class="section__header">
            <h2 id="difference-title"><?php esc_html_e('What Sets Us Apart as a Leading Digital Marketing Agency in Abu Dhabi', 'brandstory-landing'); ?></h2>
        </div>

        <div class="split split--top">
            <div class="split__media">
                <img src="<?php echo brandstory_img('difference-visual.webp'); ?>" alt="<?php esc_attr_e('Marketing strategist working on a laptop with performance charts', 'brandstory-landing'); ?>" width="535" height="561" loading="lazy" decoding="async">
            </div>

            <div class="accordion" data-accordion>
                <?php foreach ($brandstory_points as $brandstory_index => $brandstory_point) : ?>
                    <?php $brandstory_open = 0 === $brandstory_index; ?>
                    <div class="accordion__item <?php echo $brandstory_open ? 'is-open' : ''; ?>" data-accordion-item>
                        <h3 class="accordion__heading">
                            <button class="accordion__trigger" type="button" data-accordion-trigger aria-expanded="<?php echo $brandstory_open ? 'true' : 'false'; ?>" aria-controls="difference-panel-<?php echo (int) $brandstory_index; ?>">
                                <span><?php echo esc_html($brandstory_point['title']); ?></span>
                                <span class="accordion__chevron">
                                    <img class="accordion__arrow accordion__arrow--closed" src="<?php echo brandstory_img('icons/down-circle-arrow.svg'); ?>" alt="" width="38" height="38" decoding="async">
                                    <img class="accordion__arrow accordion__arrow--open" src="<?php echo brandstory_img('icons/up-circle-arrow.svg'); ?>" alt="" width="38" height="38" decoding="async">
                                </span>
                            </button>
                        </h3>
                        <div class="accordion__panel" id="difference-panel-<?php echo (int) $brandstory_index; ?>">
                            <p><?php echo esc_html($brandstory_point['text']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>