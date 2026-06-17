<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container header-container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo.png" alt="<?php bloginfo('name'); ?>">
        </a>

        <nav class="main-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'nav-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </nav>

        <div class="header-contacts">
            <div class="header-address">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#315046"/>
                </svg>
                <span>Чита, ул.Фёдора Гладкова, 8А пом. 8</span>
            </div>
            <div class="header-phone">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="#315046"/>
                </svg>
                <a href="tel:+73022318888">+7 (3022) 31 88 88</a>
            </div>
        </div>

        <button class="menu-toggle" aria-label="Открыть меню">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="header-actions">
            <a href="#" class="header-action">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" stroke="#315046" stroke-width="2" fill="none"/>
                </svg>
                <span class="action-count">1</span>
            </a>
            <a href="#" class="header-action">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 6h18l-1.5 13h-15L3 6zm4-3h10v3H7V3zm-2 6h14v-2H5v2z" fill="#315046"/>
                </svg>
                <span class="action-count">3</span>
            </a>
            <a href="#" class="header-action search-action">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" fill="#315046"/>
                </svg>
            </a>
        </div>
    </div>
</header>

<div class="mobile-menu">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_class'     => 'mobile-nav-menu',
        'container'      => false,
        'fallback_cb'    => false,
    ));
    ?>
    <div class="mobile-contacts">
        <a href="tel:+73022318888">+7 (3022) 31 88 88</a>
        <span>Чита, ул.Фёдора Гладкова, 8А пом. 8</span>
    </div>
</div>
