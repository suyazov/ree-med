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
    if (is_page_template('page-medcentry.php')) {
        $classes[] = 'medcentry-page';
    }
    if (is_page_template('page-stomatology.php')) {
        $classes[] = 'stomatology-page';
    }
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

    if (preg_match('~(?:/|>)\s*Медцентры\s*<~i', $items) || strpos($items, '/medcentry') !== false || strpos($items, 'Медцентры') !== false) {
        return $items;
    }

    $items .= '<li class="menu-item menu-item-medcentry"><a href="' . esc_url(home_url('/medcentry/')) . '">Медцентры</a></li>';
    return $items;
}
add_filter('wp_nav_menu_items', 'trimed_ensure_medcentry_menu_item', 10, 2);

function trimed_get_default_menu_items() {
    return array(
        'home'       => array('url' => home_url('/'), 'label' => 'Главная'),
        'medcentry'  => array('url' => home_url('/medcentry/'), 'label' => 'Медцентры'),
        'stomatologiya' => array('url' => home_url('/stomatologiya/'), 'label' => 'Стоматология'),
        'laboratory' => array('url' => home_url('/laboratoriya/'), 'label' => 'Лаборатория'),
        'disinfection' => array('url' => home_url('/dezinfektsiya/'), 'label' => 'Дезинфекция'),
    );
}

function trimed_primary_nav_fallback($args) {
    $items = '';
    foreach (trimed_get_default_menu_items() as $key => $item) {
        $class_name = sanitize_html_class('menu-item-' . $key);
        $items .= sprintf(
            '<li class="menu-item %s"><a href="%s">%s</a></li>',
            esc_attr($class_name),
            esc_url($item['url']),
            esc_html($item['label'])
        );
    }

    return sprintf(
        '<ul class="%s">%s</ul>',
        esc_attr($args->menu_class),
        $items
    );
}

function trimed_render_primary_menu($menu_class) {
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_class'     => $menu_class,
        'container'      => false,
        'fallback_cb'    => 'trimed_primary_nav_fallback',
    ));
}

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

function trimed_phone_href($phone = '') {
    $value = $phone !== '' ? $phone : trimed_get_contact('phone');
    return esc_attr(preg_replace('/[^0-9+]/', '', $value));
}

function trimed_asset_version($relative_path) {
    $path = get_template_directory() . '/' . ltrim($relative_path, '/');
    return file_exists($path) ? TRIMED_VERSION . '.' . filemtime($path) : TRIMED_VERSION;
}

function trimed_img_url($relative_path = '') {
    return get_template_directory_uri() . '/assets/img' . ($relative_path ? '/' . ltrim($relative_path, '/') : '');
}

function trimed_get_field_value($field, $fallback = '') {
    if (function_exists('get_field')) {
        $value = get_field($field);
        if ($value !== null && $value !== false && $value !== '') {
            return $value;
        }
    }
    return $fallback;
}

function trimed_image_field($field, $fallback) {
    $value = trimed_get_field_value($field, '');
    return !empty($value) ? $value : $fallback;
}

function trimed_repeater_field($field, $fallback = array()) {
    $value = trimed_get_field_value($field, array());
    return !empty($value) && is_array($value) ? $value : $fallback;
}

function trimed_map_class($value, $map, $fallback = '') {
    return isset($map[$value]) ? $map[$value] : $fallback;
}

function trimed_render_phone_input($args = array()) {
    $args = wp_parse_args($args, array(
        'class'       => 'phone-input',
        'flag_url'    => trimed_img_url('phone-flag.png'),
        'placeholder' => '+7 (999) 999-99-99',
    ));

    echo '<div class="' . esc_attr($args['class']) . '">';
    echo '<img src="' . esc_url($args['flag_url']) . '" alt="" width="20" height="13">';
    echo '<input type="tel" name="phone" placeholder="' . esc_attr($args['placeholder']) . '" required>';
    echo '</div>';
}

function trimed_render_agree_checkbox($args = array()) {
    $args = wp_parse_args($args, array(
        'class' => 'checkbox',
        'text'  => 'Оставляя заявку, я соглашаюсь с условиями Политики обработки персональных данных',
    ));

    echo '<label class="' . esc_attr($args['class']) . '">';
    echo '<input type="checkbox" name="agree" value="1" required>';
    echo '<span>' . esc_html($args['text']) . '</span>';
    echo '</label>';
}

function trimed_render_contact_form($args = array()) {
    $args = wp_parse_args($args, array(
        'id'                 => 'contact-form',
        'class'              => '',
        'layout'             => 'plain',
        'fields'             => array('name', 'phone', 'comment'),
        'phone_style'        => 'plain',
        'flag_url'           => trimed_img_url('phone-flag.png'),
        'button_text'        => 'Получить консультацию',
        'button_class'       => '',
        'button_span'        => false,
        'button_mobile_text' => '',
        'checkbox_class'     => 'checkbox',
        'message_position'   => 'auto',
    ));

    $field_labels = array(
        'name'         => 'Ваше имя',
        'phone'        => 'Телефон',
        'organization' => 'Организация',
        'comment'      => 'Комментарий',
    );
    $field_placeholders = array(
        'name'         => 'Иванов Николай Сергеевич',
        'phone'        => '+7 (999) 999-99-99',
        'organization' => 'Название организации',
        'comment'      => 'Ваш комментарий',
    );

    echo '<form id="' . esc_attr($args['id']) . '" class="' . esc_attr($args['class']) . '">';

    foreach ($args['fields'] as $field) {
        if ($args['layout'] === 'rows') {
            echo '<div class="form-row">';
            $field_class = $field === 'phone' ? 'form-field form-field-phone' : 'form-field';
            echo '<label class="' . esc_attr($field_class) . '">';
            echo '<span class="form-field-label">' . esc_html($field_labels[$field]) . '</span>';
            if ($field === 'phone') {
                echo '<img src="' . esc_url($args['flag_url']) . '" alt="" class="phone-flag">';
                echo '<input type="tel" name="phone" placeholder="' . esc_attr($field_placeholders[$field]) . '" required>';
            } elseif ($field === 'comment') {
                echo '<textarea name="comment" rows="3" placeholder="' . esc_attr($field_placeholders[$field]) . '"></textarea>';
            } else {
                $required = $field === 'name' ? ' required' : '';
                echo '<input type="text" name="' . esc_attr($field) . '" placeholder="' . esc_attr($field_placeholders[$field]) . '"' . $required . '>';
            }
            echo '</label>';
            echo '</div>';
            continue;
        }

        if ($field === 'phone' && $args['phone_style'] === 'phone-input') {
            trimed_render_phone_input(array('flag_url' => $args['flag_url']));
        } elseif ($field === 'phone') {
            echo '<input type="tel" name="phone" placeholder="' . esc_attr($field_placeholders[$field]) . '" required>';
        } elseif ($field === 'comment') {
            echo '<textarea name="comment" placeholder="' . esc_attr($field_placeholders[$field]) . '"></textarea>';
        } else {
            $required = $field === 'name' ? ' required' : '';
            echo '<input type="text" name="' . esc_attr($field) . '" placeholder="' . esc_attr($field_placeholders[$field]) . '"' . $required . '>';
        }
    }

    if ($args['layout'] === 'rows') {
        echo '<div class="form-row form-agree">';
        echo '<label class="checkbox-label">';
        echo '<input type="checkbox" name="agree" value="1" required>';
        echo '<span>Оставляя заявку, я соглашаюсь с условиями <a href="#">Политики обработки персональных данных</a></span>';
        echo '</label>';
        echo '</div>';
    } else {
        trimed_render_agree_checkbox(array('class' => $args['checkbox_class']));
    }

    $message_position = $args['message_position'];
    if ($message_position === 'auto') {
        $message_position = $args['layout'] === 'rows' ? 'after_button' : 'before_button';
    }

    if ($message_position === 'before_button') {
        echo '<div class="form-message"></div>';
    }

    echo '<button type="submit"' . ($args['button_class'] ? ' class="' . esc_attr($args['button_class']) . '"' : '') . '>';
    if ($args['button_mobile_text']) {
        echo '<span class="request-copy-desktop">' . esc_html($args['button_text']) . '</span>';
        echo '<span class="request-copy-mobile">' . esc_html($args['button_mobile_text']) . '</span>';
    } elseif ($args['button_span']) {
        echo '<span>' . esc_html($args['button_text']) . '</span>';
    } else {
        echo esc_html($args['button_text']);
    }
    echo '</button>';

    if ($message_position === 'after_button') {
        echo '<div class="form-message"></div>';
    }

    echo '</form>';
}

function trimed_render_request_summary_block($args = array()) {
    $args = wp_parse_args($args, array(
        'icon'        => '',
        'content_tag' => 'div',
        'content_class' => '',
        'title'       => '',
        'title_class' => '',
        'desc'        => '',
        'desc_class'  => '',
        'note'        => '',
        'note_class'  => '',
        'note_icon'   => '',
        'note_label_class' => '',
    ));

    $tag = in_array($args['content_tag'], array('section', 'article', 'div', 'aside')) ? $args['content_tag'] : 'div';
    $content_class = trim(sanitize_html_class($args['content_class']));
    $title_class = trim(sanitize_html_class($args['title_class']));
    $desc_class = trim(sanitize_html_class($args['desc_class']));
    $note_class = trim(sanitize_html_class($args['note_class']));
    $note_label_class = trim(sanitize_html_class($args['note_label_class']));

    if (!empty($args['icon'])) {
        echo $args['icon'];
    }

    echo '<' . $tag . (!empty($content_class) ? ' class="' . esc_attr($content_class) . '"' : '') . '>';
    if (!empty($args['title'])) {
        echo '<h2' . (!empty($title_class) ? ' class="' . esc_attr($title_class) . '"' : '') . '>' . wp_kses_post($args['title']) . '</h2>';
    }
    if (!empty($args['desc'])) {
        echo '<p' . (!empty($desc_class) ? ' class="' . esc_attr($desc_class) . '"' : '') . '>' . wp_kses_post($args['desc']) . '</p>';
    }
    if (!empty($args['note'])) {
        echo '<div' . (!empty($note_class) ? ' class="' . esc_attr($note_class) . '"' : '') . '>';
        if (!empty($args['note_icon'])) {
            echo '<span' . (!empty($note_label_class) ? ' class="' . esc_attr($note_label_class) . '"' : '') . '>' . wp_kses_post($args['note_icon']) . '</span>';
        }
        echo '<span>' . esc_html($args['note']) . '</span>';
        echo '</div>';
    }
    echo '</' . $tag . '>';
}

function trimed_render_plus_svg($class = '', $size = 40, $stroke = '#fff', $stroke_width = 5, $offset = null) {
    $half = $size / 2;
    $offset = $offset === null ? $size * 0.2 : $offset;
    $end = $size - $offset;

    echo '<svg class="' . esc_attr($class) . '" width="' . esc_attr($size) . '" height="' . esc_attr($size) . '" viewBox="0 0 ' . esc_attr($size) . ' ' . esc_attr($size) . '" fill="none">';
    echo '<path d="M' . esc_attr($half) . ' ' . esc_attr($offset) . 'v' . esc_attr($end - $offset) . 'M' . esc_attr($offset) . ' ' . esc_attr($half) . 'H' . esc_attr($end) . '" stroke="' . esc_attr($stroke) . '" stroke-width="' . esc_attr($stroke_width) . '" stroke-linecap="round"/>';
    echo '</svg>';
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
