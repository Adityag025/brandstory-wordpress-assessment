<?php

/**
 * Section: Our statistics (purple banner with overlapping stat cards).
 *
 * @package Brandstory_Landing
 */

$brandstory_stats = array(
    array('value' => '350', 'suffix' => '+', 'label' => 'Campaigns Executed'),
    array('value' => '180', 'suffix' => '+', 'label' => 'Satisfied Clients'),
    array('value' => '10',  'suffix' => '+', 'label' => 'Years of Experience'),
    array('value' => '600', 'suffix' => '+', 'label' => 'Cups of Coffee'),
);
?>
<section class="section stats" id="stats" aria-labelledby="stats-title">
    <div class="container">
        <div class="stats__banner">
            <h2 class="stats__title" id="stats-title"><?php esc_html_e('Our Statistics', 'brandstory-landing'); ?></h2>
        </div>

        <ul class="stats__grid">
            <?php foreach ($brandstory_stats as $brandstory_stat) : ?>
                <li class="stat-card">
                    <p class="stat-card__value">
                        <span data-counter="<?php echo esc_attr($brandstory_stat['value']); ?>"><?php echo esc_html($brandstory_stat['value']); ?></span><?php echo esc_html($brandstory_stat['suffix']); ?>
                    </p>
                    <p class="stat-card__label"><?php echo esc_html($brandstory_stat['label']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>