</main>

<?php
$brandstory_socials = array(
    array('icon' => 'social-linkedin.svg',  'label' => 'Linkedin',  'url' => 'https://www.linkedin.com/'),
    array('icon' => 'social-youtube.png',   'label' => 'Youtube',   'url' => 'https://www.youtube.com/'),
    array('icon' => 'social-facebook.svg',  'label' => 'Facebook',  'url' => 'https://www.facebook.com/'),
    array('icon' => 'social-instagram.svg', 'label' => 'Instagram', 'url' => 'https://www.instagram.com/'),
    array('icon' => 'social-twitter.svg',   'label' => 'Twitter',   'url' => 'https://x.com/'),
);
?>
<footer class="site-footer" id="contact">
    <div class="container">
        <div class="footer__grid">

                <div class="footer__brand">
                    <a class="footer__logo" href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo brandstory_img('logo.png'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" width="285" height="40" loading="lazy" decoding="async">
                    </a>
                    <p><?php esc_html_e('The BrandStory team has industry expertise and cutting-edge digital capabilities to help clients connect with their audiences in complex environments. We can\'t wait for you join us on this journey!', 'brandstory-landing'); ?></p>
                    <a class="btn btn--dark footer__cta" href="mailto:info@brandstory.ae"><?php esc_html_e('Contact Sales', 'brandstory-landing'); ?></a>
                    <p class="footer__office">
                        <strong><?php esc_html_e('Head Office:', 'brandstory-landing'); ?></strong><br>
                        <?php esc_html_e('Villa No 1, Westar Les Maisonettes, District 10, Street 5, Jumeirah Village Circle, Dubai, United Arab Emirates.', 'brandstory-landing'); ?>
                    </p>
                </div>

                <nav class="footer__col" aria-labelledby="footer-links-title">
                    <h3 id="footer-links-title"><?php esc_html_e('Our Links', 'brandstory-landing'); ?></h3>
                    <?php wp_nav_menu(array('theme_location' => 'footer-links', 'container' => false, 'menu_class' => 'footer__links', 'depth' => 1, 'fallback_cb' => 'brandstory_footer_links_fallback')); ?>
                </nav>

                <nav class="footer__col" aria-labelledby="footer-services-title">
                    <h3 id="footer-services-title"><?php esc_html_e('Services', 'brandstory-landing'); ?></h3>
                    <?php wp_nav_menu(array('theme_location' => 'footer-services', 'container' => false, 'menu_class' => 'footer__links', 'depth' => 1, 'fallback_cb' => 'brandstory_footer_services_fallback')); ?>
                </nav>

                <div class="footer__col">
                    <h3><?php esc_html_e('Contact', 'brandstory-landing'); ?></h3>
                    <address class="footer__contact">
                        <address class="footer__contact">
                            <p><?php esc_html_e('Phone:', 'brandstory-landing'); ?><br><a href="tel:+971522831655">+971 52 283 1655</a></p>
                            <p><?php esc_html_e('Email:', 'brandstory-landing'); ?><br><a href="mailto:info@brandstory.ae">info@brandstory.ae</a></p>
                            <p><?php esc_html_e('Address:', 'brandstory-landing'); ?><br><?php esc_html_e('G5, Al Moheri Plaza, opp DBC Building, Al Khabaisi Area, Deira Dubai - 81577, United Arab Emirates', 'brandstory-landing'); ?></p>
                        </address>
                </div>

                <div class="footer__col">
                    <h3><?php esc_html_e('Follow us', 'brandstory-landing'); ?></h3>
                    <ul class="footer__social">
                        <?php foreach ($brandstory_socials as $brandstory_social) : ?>
                            <li>
                                <a href="<?php echo esc_url($brandstory_social['url']); ?>" target="_blank" rel="noopener">
                                    <img src="<?php echo brandstory_img('icons/' . $brandstory_social['icon']); ?>" alt="" width="16" height="16" loading="lazy" decoding="async">
                                    <?php echo esc_html($brandstory_social['label']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
        </div>
        <div class="footer__bar">
            <div class="container">
                <p>
                    <?php printf(esc_html__('Copyright © Brandstory, All Rights Reserved %s', 'brandstory-landing'), esc_html(gmdate('Y'))); ?>
                    | <a href="<?php echo esc_url( home_url( '/terms-and-conditions/' ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'brandstory-landing' ); ?></a>
                    | <a href="<?php echo esc_url( get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'brandstory-landing' ); ?></a>
                </p>
            </div>
        </div>

        <div class="footer__partners">
            <img src="<?php echo brandstory_img('partners.png'); ?>" alt="<?php esc_attr_e('Google Partner, Bing Partner, Facebook Marketing Partner and HubSpot Certified Partner badges', 'brandstory-landing'); ?>" width="539" height="45" loading="lazy" decoding="async">
        </div>
</footer>

<?php
// Per the design, the locations block sits below the footer on the front page only.
if ( is_front_page() ) {
	get_template_part( 'template-parts/sections/locations' );
}
?>

<?php wp_footer(); ?>
</body>

</html>