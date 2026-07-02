<?php
if (!defined('ABSPATH')) {
    exit;
}

define('TRIMED_VERSION', '1.10.46');

// Email для заявок: можно переопределить в wp-config.php через define('TRIMED_FORM_EMAIL', 'email@example.com')
if (!defined('TRIMED_FORM_EMAIL')) {
    define('TRIMED_FORM_EMAIL', '');
}

function trimed_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');

    register_nav_menus(array(
        'primary' => __('Главное меню', 'trimed'),
        'footer'  => __('Меню в подвале', 'trimed'),
    ));
}
add_action('after_setup_theme', 'trimed_setup');

function trimed_body_class($classes) {
    if (is_page_template('page-disinfection.php')) {
        $classes[] = 'disinfection-page';
    }
    if (is_page_template('page-laboratory.php')) {
        $classes[] = 'laboratory-page';
    }
    return $classes;
}
add_filter('body_class', 'trimed_body_class');

function trimed_ensure_medcentry_menu_item($items, $args) {
    if (empty($args->theme_location) || $args->theme_location !== 'primary') {
        return $items;
    }

    if (strpos($items, '/medcentry/') !== false) {
        return $items;
    }

    $items .= '<li class="menu-item menu-item-medcentry"><a href="' . esc_url(home_url('/medcentry/')) . '">Медцентры</a></li>';
    return $items;
}
add_filter('wp_nav_menu_items', 'trimed_ensure_medcentry_menu_item', 10, 2);

function trimed_favicon() {
    echo '<link rel="icon" type="image/png" href="' . esc_url(get_template_directory_uri() . '/assets/img/logo.png') . '">' . "\n";
}
add_action('wp_head', 'trimed_favicon', 1);

function trimed_get_contact($key, $fallback = '') {
    if (function_exists('get_field')) {
        $value = get_field('trimed_contact_' . $key, 'option');
        if (!empty($value)) {
            return $value;
        }
    }
    $fallbacks = array(
        'phone'   => '+7 (3022) 31 88 88',
        'email'   => 'treemed16@yandex.ru',
        'address' => 'Чита, ул.Фёдора Гладкова, 8А пом. 8',
    );
    return isset($fallbacks[$key]) && $fallback === '' ? $fallbacks[$key] : $fallback;
}

function trimed_asset_version($relative_path) {
    $path = get_template_directory() . '/' . ltrim($relative_path, '/');
    return file_exists($path) ? TRIMED_VERSION . '.' . filemtime($path) : TRIMED_VERSION;
}

function trimed_enqueue_assets() {
    wp_enqueue_style('trimed-fonts', 'https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700;800&subset=cyrillic&display=swap', array(), null);
    wp_enqueue_style('trimed-style', get_stylesheet_uri(), array('trimed-fonts'), trimed_asset_version('style.css'));
    wp_enqueue_style('trimed-main', get_template_directory_uri() . '/assets/css/main.css', array('trimed-style'), trimed_asset_version('assets/css/main.css'));

    if (is_front_page()) {
        wp_enqueue_style('trimed-home', get_template_directory_uri() . '/assets/css/home.css', array('trimed-main'), trimed_asset_version('assets/css/home.css'));
    }

    wp_enqueue_script('trimed-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), TRIMED_VERSION, true);
    wp_localize_script('trimed-main', 'trimed_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('trimed_contact_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'trimed_enqueue_assets');

function trimed_document_title($title) {
    if (is_front_page() && !is_admin()) {
        $title['title'] = 'Главная — ТриМед';
        $title['tagline'] = '';
    }
    return $title;
}
add_filter('document_title_parts', 'trimed_document_title');

function trimed_enqueue_page_assets() {
    if (is_page_template('page-stomatology.php')) {
        wp_enqueue_style('trimed-stomatology', get_template_directory_uri() . '/assets/css/stomatology.css', array('trimed-main'), trimed_asset_version('assets/css/stomatology.css'));
    }
    if (is_page_template('page-laboratory.php')) {
        wp_enqueue_style('trimed-laboratory', get_template_directory_uri() . '/assets/css/laboratory.css', array('trimed-main'), trimed_asset_version('assets/css/laboratory.css'));
    }
    if (is_page_template('page-disinfection.php')) {
        wp_enqueue_style('trimed-disinfection', get_template_directory_uri() . '/assets/css/disinfection.css', array('trimed-main'), trimed_asset_version('assets/css/disinfection.css'));
    }
    if (is_page_template('page-medcentry.php') || is_page('medcentry')) {
        wp_enqueue_style('trimed-medcentry', get_template_directory_uri() . '/assets/css/medcentry.css', array('trimed-main'), trimed_asset_version('assets/css/medcentry.css'));
    }
}
add_action('wp_enqueue_scripts', 'trimed_enqueue_page_assets');

function trimed_handle_contact_form() {
    check_ajax_referer('trimed_contact_nonce', 'nonce');

    $name  = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $org   = isset($_POST['organization']) ? sanitize_text_field($_POST['organization']) : '';
    $comment = isset($_POST['comment']) ? sanitize_textarea_field($_POST['comment']) : '';
    $agree = isset($_POST['agree']) ? 1 : 0;

    if (empty($name) || empty($phone)) {
        wp_send_json_error('Пожалуйста, заполните имя и телефон.');
    }

    if (!$agree) {
        wp_send_json_error('Необходимо согласие на обработку персональных данных.');
    }

    $to = TRIMED_FORM_EMAIL;
    if (empty($to) && function_exists('get_field')) {
        $to = get_field('trimed_contact_email', 'option');
    }
    if (empty($to)) {
        $to = get_option('admin_email');
    }

    if (empty($to) || !is_email($to)) {
        wp_send_json_error('Не настроен email получателя. Обратитесь к администратору сайта.');
    }

    $subject = 'Новая заявка с сайта ТриМед';
    $message = "Имя: $name\nТелефон: $phone\nОрганизация: $org\nКомментарий: $comment";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    $sent = wp_mail($to, $subject, $message, $headers);

    if ($sent) {
        wp_send_json_success('Спасибо! Ваша заявка отправлена. Мы свяжемся с вами в ближайшее время.');
    } else {
        wp_send_json_error('Не удалось отправить заявку. Попробуйте позже или свяжитесь с нами по телефону.');
    }
}
add_action('wp_ajax_trimed_contact', 'trimed_handle_contact_form');
add_action('wp_ajax_nopriv_trimed_contact', 'trimed_handle_contact_form');

function trimed_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'trimed_excerpt_length', 999);

// ACF fields
require_once get_template_directory() . '/inc/acf-fields.php';
require_once get_template_directory() . '/inc/acf-fields-medcentry.php';
require_once get_template_directory() . '/inc/acf-fields-main.php';
