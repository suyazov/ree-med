<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .mobile-menu:not(.active) { display: none !important; }
        .mobile-menu.active { display: flex !important; }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container header-container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.png'); ?>" alt="ТриМед" width="140" height="41">
        </a>

        <nav class="main-nav">
            <?php trimed_render_primary_menu('nav-menu'); ?>
        </nav>

        <div class="header-contacts">
            <div class="header-address">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#315046"/>
                </svg>
                <span><?php echo esc_html(trimed_get_contact('address')); ?></span>
            </div>
            <div class="header-phone">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="#315046"/>
                </svg>
                <a href="tel:<?php echo trimed_phone_href(); ?>"><?php echo esc_html(trimed_get_contact('phone')); ?></a>
            </div>
        </div>

        <button class="menu-toggle" aria-label="Открыть меню">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="header-actions">
            <a href="#" class="header-action header-action-compare" aria-label="Сравнение">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="4" width="2" height="17" rx="1" fill="currentColor"/>
                    <rect x="8" y="5" width="2" height="15" rx="1" fill="currentColor"/>
                    <rect x="14" y="6" width="2" height="13" rx="1" fill="currentColor"/>
                    <rect x="20" y="6" width="2" height="13" rx="1" fill="currentColor"/>
                </svg>
                <span class="action-count">1</span>
            </a>
            <a href="#" class="header-action header-action-favorite" aria-label="Избранное">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="m12.1 18.55l-.1.1l-.11-.1C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5c1.54 0 3.04 1 3.57 2.36h1.86C13.46 6 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5c0 2.89-3.14 5.74-7.9 10.05M16.5 3c-1.74 0-3.41.81-4.5 2.08C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.41 2 8.5c0 3.77 3.4 6.86 8.55 11.53L12 21.35l1.45-1.32C18.6 15.36 22 12.27 22 8.5C22 5.41 19.58 3 16.5 3"/>
                </svg>
                <span class="action-count">1</span>
            </a>
            <a href="#" class="header-action header-action-cart" aria-label="Корзина">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" fill-rule="evenodd">
                        <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/>
                        <path fill="currentColor" d="M10.464 3.282a2 2 0 0 1 2.964-.12l.108.12L17.468 8h2.985a1.49 1.49 0 0 1 1.484 1.655l-.092.766l-.1.74l-.082.554l-.095.595l-.108.625l-.122.648l-.136.661q-.108.5-.232.999a21 21 0 0 1-.832 2.583l-.221.54l-.214.488l-.202.434l-.094.194l-.249.49c-.32.61-.924.97-1.563 1.022l-.16.006H6.555a1.93 1.93 0 0 1-1.71-1.008l-.232-.45l-.18-.37l-.095-.205l-.2-.449a21.5 21.5 0 0 1-1.108-3.276a32 32 0 0 1-.156-.654l-.142-.648l-.127-.634l-.112-.613l-.1-.587l-.087-.554l-.074-.513l-.09-.683l-.066-.556l-.017-.153a1.49 1.49 0 0 1 1.348-1.64L3.543 8h2.989zm-.503 9.44a1 1 0 0 0-1.96.326l.013.116l.5 3l.025.114a1 1 0 0 0 1.96-.326l-.013-.116l-.5-3zm5.203-.708a1 1 0 0 0-1.125.708l-.025.114l-.5 3a1 1 0 0 0 1.947.442l.025-.114l.5-3a1 1 0 0 0-.822-1.15M12 4.562L9.135 8h5.73z"/>
                    </g>
                </svg>
                <span class="action-count">3</span>
            </a>
            <a href="#" class="header-action header-action-search search-action" aria-label="Поиск">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M10 4a6 6 0 1 0 0 12a6 6 0 0 0 0-12m-8 6a8 8 0 1 1 14.32 4.906l5.387 5.387a1 1 0 0 1-1.414 1.414l-5.387-5.387A8 8 0 0 1 2 10"/>
                </svg>
            </a>
        </div>
    </div>
</header>

<div class="mobile-menu">
    <?php trimed_render_primary_menu('mobile-nav-menu'); ?>
    <div class="mobile-contacts">
        <a href="tel:<?php echo trimed_phone_href(); ?>"><?php echo esc_html(trimed_get_contact('phone')); ?></a>
        <span><?php echo esc_html(trimed_get_contact('address')); ?></span>
    </div>
</div>
