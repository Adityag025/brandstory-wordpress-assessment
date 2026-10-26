<!doctype html>
<html <?php language_attributes(); ?>>

<head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
        <?php wp_body_open(); ?>

        <a class="screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'brandstory-landing'); ?></a>

        <header class="site-header" id="site-header">
                <div class="container">
                        <div class="nav-bar">

                                <a class="nav-bar__logo" href="<?php echo esc_url(home_url('/')); ?>">
                                        <img
                                                src="<?php echo brandstory_img('logo.png'); ?>"
                                                alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                                                width="285"
                                                height="40"
                                                decoding="async"
                                                fetchpriority="high">
                                </a>

                                <button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="primary-nav">
                                        <span class="screen-reader-text"><?php esc_html_e('Toggle menu', 'brandstory-landing'); ?></span>
                                        <span class="nav-toggle__bar"></span>
                                        <span class="nav-toggle__bar"></span>
                                        <span class="nav-toggle__bar"></span>
                                </button>

                                <nav class="nav-bar__nav" id="primary-nav" data-nav aria-label="<?php esc_attr_e('Primary', 'brandstory-landing'); ?>">
                                        <?php
                                        wp_nav_menu(
                                                array(
                                                        'theme_location' => 'primary',
                                                        'container'      => false,
                                                        'menu_class'     => 'nav-menu',
                                                        'depth'          => 2,
                                                        'fallback_cb'    => 'brandstory_nav_fallback',
                                                )
                                        );
                                        ?>
                                        <a class="btn btn--light nav-bar__cta nav-bar__cta--mobile" href="#contact"><?php esc_html_e('Get Quote', 'brandstory-landing'); ?></a>
                                </nav>

                                <a class="btn btn--light nav-bar__cta" href="#contact"><?php esc_html_e('Get Quote', 'brandstory-landing'); ?></a>

                        </div>
                </div>
        </header>

        <main id="main" class="site-main">