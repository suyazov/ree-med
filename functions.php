<?php
if (!defined('ABSPATH')) {
    exit;
}

define('TRIMED_VERSION', '1.3.9');

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

function trimed_enqueue_assets() {
    wp_enqueue_style('trimed-fonts', 'https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700;800&subset=cyrillic&display=swap', array(), null);
    wp_enqueue_style('trimed-style', get_stylesheet_uri(), array('trimed-fonts'), TRIMED_VERSION);
    wp_enqueue_style('trimed-main', get_template_directory_uri() . '/assets/css/main.css', array('trimed-style'), TRIMED_VERSION);

    wp_enqueue_script('trimed-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), TRIMED_VERSION, true);
    wp_localize_script('trimed-main', 'trimed_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('trimed_contact_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'trimed_enqueue_assets');

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

    $to = get_option('admin_email');
    $subject = 'Новая заявка с сайта ТриМед';
    $message = "Имя: $name\nТелефон: $phone\nОрганизация: $org\nКомментарий: $comment";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($to, $subject, $message, $headers);

    wp_send_json_success('Спасибо! Ваша заявка отправлена.');
}
add_action('wp_ajax_trimed_contact', 'trimed_handle_contact_form');
add_action('wp_ajax_nopriv_trimed_contact', 'trimed_handle_contact_form');

function trimed_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'trimed_excerpt_length', 999);

// ACF fields
require_once get_template_directory() . '/inc/acf-fields.php';
