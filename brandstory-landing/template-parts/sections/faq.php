<?php

/**
 * Section: FAQ accordion.
 *
 * @package Brandstory_Landing
 */

$brandstory_faqs = array(
    array(
        'q' => 'How Does Digital Marketing Support Business Growth In Abu Dhabi?',
        'a' => 'Digital marketing helps businesses in Abu Dhabi build visibility, attract relevant audiences, and convert interest into leads through a mix of search, social, content, and performance channels.',
    ),
    array(
        'q' => 'Which Digital Marketing Channels Work Best For Abu Dhabi Businesses?',
        'a' => 'Search, paid media, and social platforms such as Instagram and LinkedIn perform strongly, but the right mix depends on your audience, sector, and goals.',
    ),
    array(
        'q' => 'How Is Local Market Understanding Important In Digital Marketing?',
        'a' => 'Cultural nuance, language, and regulations shape how audiences respond. Local insight makes campaigns relevant and compliant, which improves results.',
    ),
    array(
        'q' => 'How Long Does It Take To See Results From Digital Marketing?',
        'a' => 'Paid campaigns can deliver leads within weeks, while SEO and content typically build measurable momentum over three to six months.',
    ),
    array(
        'q' => 'Can Digital Marketing Help Reach Both Local And Regional Audiences?',
        'a' => 'Yes. Campaigns can be targeted to Abu Dhabi, the wider UAE, or the GCC with language, location, and interest settings tuned for each market.',
    ),
);
?>
<section class="section faq" id="faq" aria-labelledby="faq-title">
    <div class="container">
        <div class="section__header">
            <h2 id="faq-title"><?php esc_html_e('FAQ\'s', 'brandstory-landing'); ?></h2>
        </div>

        <div class="accordion accordion--faq" data-accordion>
            <?php foreach ($brandstory_faqs as $brandstory_index => $brandstory_faq) : ?>
                <?php $brandstory_open = 0 === $brandstory_index; ?>
                <div class="accordion__item <?php echo $brandstory_open ? 'is-open' : ''; ?>" data-accordion-item>
                    <h3 class="accordion__heading">
                        <button class="accordion__trigger" type="button" data-accordion-trigger aria-expanded="<?php echo $brandstory_open ? 'true' : 'false'; ?>" aria-controls="faq-panel-<?php echo (int) $brandstory_index; ?>">
                            <span><?php echo esc_html($brandstory_faq['q']); ?></span>
                            <span class="accordion__chevron">
                                <img class="accordion__arrow accordion__arrow--closed" src="<?php echo brandstory_img('icons/down-circle-arrow.svg'); ?>" alt="" width="38" height="38" decoding="async">
                                <img class="accordion__arrow accordion__arrow--open" src="<?php echo brandstory_img('icons/up-circle-arrow.svg'); ?>" alt="" width="38" height="38" decoding="async">
                            </span>
                        </button>
                    </h3>
                    <div class="accordion__panel" id="faq-panel-<?php echo (int) $brandstory_index; ?>">
                        <p><?php echo esc_html($brandstory_faq['a']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>