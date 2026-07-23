<?php
if (!defined('ABSPATH')) {
    exit;
}

define('TRIMED_VERSION', '1.10.58');

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

/**
 * Контент сайта редактируется через ACF, поэтому блочный редактор не нужен.
 */
function trimed_disable_block_editor($use_block_editor, $post_type) {
    return false;
}
add_filter('use_block_editor_for_post_type', 'trimed_disable_block_editor', 100, 2);
add_filter('use_widgets_block_editor', '__return_false', 100);

function trimed_get_service_pages_config() {
    return array(
        'medcentry' => array(
            'template'   => 'page-medcentry.php',
            'slug'       => 'medcentry',
            'body_class' => 'medcentry-page',
            'style'      => array(
                'handle' => 'trimed-medcentry',
                'file'   => 'assets/css/medcentry.css',
            ),
        ),
        'stomatology' => array(
            'template'   => 'page-stomatology.php',
            'slug'       => 'stomatologiya',
            'body_class' => 'stomatology-page',
            'style'      => array(
                'handle' => 'trimed-stomatology',
                'file'   => 'assets/css/stomatology.css',
            ),
        ),
        'disinfection' => array(
            'template'   => 'page-disinfection.php',
            'slug'       => 'dezinfektsiya',
            'body_class' => 'disinfection-page',
            'style'      => array(
                'handle' => 'trimed-disinfection',
                'file'   => 'assets/css/disinfection.css',
            ),
        ),
        'laboratory' => array(
            'template'   => 'page-laboratory.php',
            'slug'       => 'laboratoriya',
            'body_class' => 'laboratory-page',
            'style'      => array(
                'handle' => 'trimed-laboratory',
                'file'   => 'assets/css/laboratory.css',
            ),
        ),
    );
}

function trimed_is_service_page($config) {
    return is_page_template($config['template']) || is_page($config['slug']);
}

function trimed_body_class($classes) {
    foreach (trimed_get_service_pages_config() as $config) {
        if (trimed_is_service_page($config)) {
            $classes[] = 'trimed-service-page';
            $classes[] = $config['body_class'];
            break;
        }
    }
    return $classes;
}
add_filter('body_class', 'trimed_body_class');

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

function trimed_get_default_contacts() {
    return array(
        'phone'   => '+7 (3022) 31 88 88',
        'email'   => 'treemed16@yandex.ru',
        'address' => 'Чита, ул.Фёдора Гладкова, 8А пом. 8',
    );
}

/**
 * Единый безопасный читатель глобальных настроек («Настройки сайта», ACF options).
 * Пустая опция всегда возвращает $fallback: пока настройка не заполнена,
 * фронтенд показывает текущие live-значения.
 */
function trimed_get_option_value($name, $fallback = '') {
    if (function_exists('get_field')) {
        $value = get_field($name, 'option');
        if ($value !== null && $value !== false && $value !== '' && $value !== array()) {
            return $value;
        }
    }

    return $fallback;
}

function trimed_get_theme_option($name, $fallback = '') {
    return trimed_get_option_value($name, $fallback);
}

/**
 * Чтение legacy-repeater соцсетей напрямую из wp_options (ACF Free не умеет
 * repeater; данные, сохранённые ранее, продолжают работать).
 */
function trimed_get_legacy_social_options() {
    $count = (int) get_option('options_trimed_contact_socials', 0);
    if ($count <= 0) {
        return array();
    }

    $items = array();
    for ($i = 0; $i < $count; $i++) {
        $url = get_option('options_trimed_contact_socials_' . $i . '_url', '');
        $icon = get_option('options_trimed_contact_socials_' . $i . '_icon', '');
        if (is_numeric($icon)) {
            $icon = wp_get_attachment_url((int) $icon);
        }
        if (!is_string($url) || $url === '') {
            continue;
        }
        $items[] = array('url' => $url, 'icon' => is_string($icon) ? $icon : '');
    }

    return $items;
}

/**
 * Ссылки соцсетей для подвала. Приоритет:
 * 1) фиксированные слоты «Настройки сайта» (заполнен хотя бы один URL);
 * 2) legacy-repeater trimed_contact_socials (get_field либо wp_options);
 * 3) стандартные три плейсхолдера из темы.
 * Формат элемента: array('url' => ..., 'icon' => ...).
 */
function trimed_get_social_links() {
    $slots = array();
    for ($i = 1; $i <= 3; $i++) {
        $url = trimed_get_option_value('trimed_social_' . $i . '_url', '');
        if (!is_string($url) || $url === '') {
            continue;
        }
        $icon = trimed_get_option_value('trimed_social_' . $i . '_icon', '');
        if (!is_string($icon) || $icon === '') {
            $icon = get_template_directory_uri() . '/assets/img/footer-social-' . $i . '.svg';
        }
        $slots[] = array('url' => $url, 'icon' => $icon);
    }
    if (!empty($slots)) {
        return $slots;
    }

    $legacy = trimed_get_option_value('trimed_contact_socials', array());
    if (!empty($legacy) && is_array($legacy)) {
        return $legacy;
    }

    $legacy = trimed_get_legacy_social_options();
    if (!empty($legacy)) {
        return $legacy;
    }

    return array(
        array('url' => '#', 'icon' => get_template_directory_uri() . '/assets/img/footer-social-1.svg'),
        array('url' => '#', 'icon' => get_template_directory_uri() . '/assets/img/footer-social-2.svg'),
        array('url' => '#', 'icon' => get_template_directory_uri() . '/assets/img/footer-social-3.svg'),
    );
}

function trimed_get_contact($key, $fallback = '') {
    $field = 'trimed_contact_' . $key;
    // Публичный email — отдельная опция. Legacy-поле trimed_contact_email
    // служебное (получатель заявок): публично не выводится и в фолбэке
    // публичного адреса не участвует — при пустой опции показываем
    // публичный адрес по умолчанию.
    if ($key === 'email') {
        $field = 'trimed_contact_public_email';
    }

    $value = trimed_get_option_value($field, '');

    if ($value !== '') {
        return $value;
    }

    $fallbacks = trimed_get_default_contacts();
    return isset($fallbacks[$key]) && $fallback === '' ? $fallbacks[$key] : $fallback;
}

/**
 * Email получателя заявок из «Настройки сайта». Приоритет:
 * константа TRIMED_FORM_EMAIL (wp-config.php) → опция trimed_contact_email
 * → текущий безопасный fallback (email из контактов по умолчанию) → admin_email.
 * Служебный адрес публично не выводится.
 */
function trimed_get_form_recipient_email() {
    if (defined('TRIMED_FORM_EMAIL') && TRIMED_FORM_EMAIL !== '') {
        return TRIMED_FORM_EMAIL;
    }

    $value = trimed_get_option_value('trimed_contact_email', '');
    if ($value !== '') {
        return $value;
    }

    $defaults = trimed_get_default_contacts();
    if (!empty($defaults['email'])) {
        return $defaults['email'];
    }

    return get_option('admin_email');
}

function trimed_phone_href($phone = '') {
    $value = $phone !== '' ? $phone : trimed_get_contact('phone');
    return esc_attr(preg_replace('/[^0-9+]/', '', $value));
}

function trimed_legal_url($slug) {
    $page = get_page_by_path(sanitize_title($slug));
    return $page instanceof WP_Post ? get_permalink($page) : home_url('/' . trim($slug, '/') . '/');
}

function trimed_asset_version($relative_path) {
    $path = get_template_directory() . '/' . ltrim($relative_path, '/');
    return file_exists($path) ? TRIMED_VERSION . '.' . filemtime($path) : TRIMED_VERSION;
}

function trimed_img_url($relative_path = '') {
    return get_template_directory_uri() . '/assets/img' . ($relative_path ? '/' . ltrim($relative_path, '/') : '');
}

function trimed_get_image_dir($subdir = '') {
    $uri = get_template_directory_uri() . '/assets/img';
    if ($subdir !== '') {
        $uri .= '/' . ltrim($subdir, '/');
    }
    return $uri;
}

function trimed_get_placeholder_url() {
    return trimed_get_image_dir() . '/placeholder.jpg';
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

/**
 * Returns a page-level ACF toggle while keeping legacy pages enabled by default.
 */
function trimed_is_page_section_enabled($field, $default = true, $post_id = 0) {
    $post_id = $post_id ? (int) $post_id : (int) get_queried_object_id();

    if (!$post_id || !metadata_exists('post', $post_id, $field)) {
        return (bool) $default;
    }

    if (function_exists('get_field')) {
        return (bool) get_field($field, $post_id);
    }

    return (bool) get_post_meta($post_id, $field, true);
}

function trimed_image_field($field, $fallback) {
    $value = trimed_get_field_value($field, '');
    return !empty($value) ? $value : $fallback;
}

function trimed_render_responsive_picture($url, $args = array()) {
    $args = wp_parse_args($args, array(
        'class' => '',
        'alt' => '',
        'mobile_url' => '',
        'width' => null,
        'height' => null,
        'style' => '',
    ));

    if (empty($url)) {
        return;
    }

    if (!empty($args['mobile_url'])) {
        $mobile_url = $args['mobile_url'];
    } else {
        $mobile_url = preg_replace('/\.(png|jpe?g|webp)(\?.*)?$/i', '-mobile.$1$2', $url);
        $mobile_path = str_replace(get_template_directory_uri(), get_template_directory(), $mobile_url);
        if (!file_exists($mobile_path)) {
            $mobile_url = $url;
        }
    }

    $class_attr = $args['class'] ? ' class="' . esc_attr($args['class']) . '"' : '';
    $wh_attr = ($args['width'] && $args['height'])
        ? ' width="' . esc_attr((string)$args['width']) . '" height="' . esc_attr((string)$args['height']) . '"'
        : '';
    $style_attr = $args['style'] ? ' style="' . esc_attr($args['style']) . '"' : '';

    echo '<picture>';
    echo '<source media="(max-width: 768px)" srcset="' . esc_url($mobile_url) . '">';
    echo '<img src="' . esc_url($url) . '"' . $class_attr . $wh_attr . $style_attr . ' alt="' . esc_attr($args['alt']) . '">';
    echo '</picture>';
}

function trimed_medcentry_format_hero_title($title) {
    if (strpos($title, 'mc-hero-title-tail') !== false) {
        return $title;
    }

    $patterns = array(
        '<br>в Забайкальском крае',
        '<br>в&nbsp;Забайкальском крае',
        'в Забайкальском крае',
        'в&nbsp;Забайкальском крае',
    );

    foreach ($patterns as $pattern) {
        if (strpos($title, $pattern) !== false) {
            $prefix = substr($pattern, 0, 4) === '<br>' ? '<br>' : '<br>';
            return str_replace($pattern, $prefix . '<span class="mc-hero-title-tail">в Забайкальском крае</span>', $title);
        }
    }

    return $title;
}

function trimed_medcentry_format_audience_summary($summary) {
    $summary = str_replace('<em>уверенно</em> каждый день.', '<em>уверенно каждый день.</em>', $summary);

    if (strpos($summary, 'mc-audience-summary-green') === false) {
        $summary = str_replace(
            'продуманное оснащение,',
            '<span class="mc-audience-summary-green">продуманное оснащение,</span>',
            $summary
        );
    }

    if (strpos($summary, '<em>') === false && strpos($summary, 'уверенно каждый день.') !== false) {
        $summary = str_replace('уверенно каждый день.', '<em>уверенно каждый день.</em>', $summary);
    }

    return $summary;
}

function trimed_medcentry_format_request_title($title) {
    if (strpos($title, '<em>') === false && strpos($title, 'под вашу клинику') !== false) {
        return str_replace('под вашу клинику', '<em>под вашу клинику</em>', $title);
    }

    return $title;
}

function trimed_medcentry_format_projects_desc($desc) {
    $second_sentence = 'Мы понимаем специфику региона, требования врачей и реальные условия работы.';

    if (strpos($desc, 'Мы понимаем специфику региона') === false) {
        $desc = rtrim($desc) . ' ' . $second_sentence;
    }

    return $desc;
}

function trimed_repeater_field($field, $fallback = array()) {
    $value = trimed_get_field_value($field, array());
    return !empty($value) && is_array($value) ? $value : $fallback;
}

function trimed_map_class($value, $map, $fallback = '') {
    return isset($map[$value]) ? $map[$value] : $fallback;
}

function trimed_audience_card_class($scope, $style, $has_image = false) {
    $scope = is_string($scope) ? sanitize_key($scope) : '';
    $style = is_string($style) ? sanitize_key($style) : 'default';
    if ($style === '') {
        $style = 'default';
    }

    $maps = array(
        'medcentry' => array(
            'base'   => 'mc-audience-card',
            'styles' => array(
                'default' => '',
                'image'   => ' mc-audience-card--image',
                'white'   => ' mc-audience-card--white',
                'gray'    => ' mc-audience-card--gray',
                'green'   => ' mc-audience-card--green',
            ),
        ),
        'stomatology' => array(
            'base'   => 'stom-audience-card',
            'styles' => array(
                'default' => '',
                'image'   => ' stom-audience-card--image',
                'white'   => ' stom-audience-card--white',
                'gray'    => ' stom-audience-card--gray',
                'green'   => ' stom-audience-card--green',
            ),
        ),
        'laboratory' => array(
            'base'   => 'lab-audience-card',
            'styles' => array(
                'default'       => ' lab-audience-card--white',
                'white'         => ' lab-audience-card--white',
                'gray'          => ' lab-audience-card--gray',
                'green'         => ' lab-audience-card--green',
                'image'         => ' lab-audience-card--image',
                'image-overlay' => ' lab-audience-card--image',
            ),
        ),
        'disinfection' => array(
            'base'   => 'audience-card',
            'styles' => array(
                'default'       => '',
                'gray'          => ' gray',
                'green'         => ' green',
                'image'         => ' image',
                'image-overlay' => ' image-overlay',
            ),
        ),
    );

    if (!isset($maps[$scope])) {
        $scope = 'disinfection';
    }

    $map = $maps[$scope];
    $class = trimed_sanitize_class_list($map['base']);
    $mapped = isset($map['styles'][$style]) ? $map['styles'][$style] : $map['styles']['default'];
    $class .= ' ' . trim($mapped);

    if ($scope === 'disinfection' && $has_image && in_array($style, array('image', 'image-overlay'), true)) {
        $class .= ' has-image';
    }

    return trim($class);
}

function trimed_render_phone_input($args = array()) {
    $args = wp_parse_args($args, array(
        'class'       => 'phone-input',
        'flag_url'    => trimed_img_url('phone-flag.png'),
        'placeholder' => trimed_get_theme_option('trimed_form_phone_placeholder', '+7 (999) 999-99-99'),
    ));

    echo '<div class="' . esc_attr($args['class']) . '">';
    echo '<img src="' . esc_url($args['flag_url']) . '" alt="" width="20" height="13">';
    echo '<input type="tel" name="phone" placeholder="' . esc_attr($args['placeholder']) . '" required>';
    echo '</div>';
}

function trimed_render_agree_checkbox($args = array()) {
    $args = wp_parse_args($args, array(
        'class' => 'checkbox',
        'text'  => trimed_get_theme_option('trimed_form_agreement_text', 'Оставляя заявку, я соглашаюсь с условиями Политики обработки персональных данных'),
    ));

    echo '<label class="' . esc_attr($args['class']) . '">';
    echo '<input type="checkbox" name="agree" value="1" required>';
    $policy_label = 'Политики обработки персональных данных';
    $safe_text = esc_html($args['text']);
    $policy_link = '<a href="' . esc_url(trimed_legal_url('politika-obrabotki-personalnyh-dannyh')) . '">' . esc_html($policy_label) . '</a>';
    echo '<span>' . str_replace(esc_html($policy_label), $policy_link, $safe_text) . '</span>';
    echo '</label>';
}

function trimed_get_default_form_fields() {
    return array(
        'name' => array(
            'label' => 'Ваше имя',
            'placeholder' => trimed_get_theme_option('trimed_form_name_placeholder', 'Иванов Николай Сергеевич'),
            'required' => true,
        ),
        'phone' => array(
            'label' => 'Телефон',
            'placeholder' => trimed_get_theme_option('trimed_form_phone_placeholder', '+7 (999) 999-99-99'),
            'required' => true,
            'type' => 'tel',
            'is_phone' => true,
        ),
        'organization' => array(
            'label' => 'Организация',
            'placeholder' => trimed_get_theme_option('trimed_form_organization_placeholder', 'Название организации'),
            'required' => false,
        ),
        'comment' => array(
            'label' => 'Комментарий',
            'placeholder' => trimed_get_theme_option('trimed_form_comment_placeholder', 'Ваш комментарий'),
            'required' => false,
            'is_textarea' => true,
        ),
    );
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

    $default_form_fields = trimed_get_default_form_fields();
    $fields = is_array($args['fields']) ? $args['fields'] : array();

    $form_class = trim((string) $args['class']);
    if ($form_class !== '') {
        $form_class .= ' ';
    }
    $form_class .= 'contact-form';

    echo '<form id="' . esc_attr($args['id']) . '" class="' . esc_attr(trim($form_class)) . '">';
    echo '<div class="form-honeypot" aria-hidden="true">';
    echo '<label>Не заполняйте это поле<input type="text" name="company_website" value="" tabindex="-1" autocomplete="off"></label>';
    echo '</div>';
    echo '<input type="hidden" name="form_started_at" value="' . esc_attr((string) time()) . '">';

    foreach ($fields as $field) {
        if (!isset($default_form_fields[$field])) {
            continue;
        }

        $meta = $default_form_fields[$field];
        if ($args['layout'] === 'rows') {
            echo '<div class="form-row">';
            $field_class = $field === 'phone' ? 'form-field form-field-phone' : 'form-field';
            echo '<label class="' . esc_attr($field_class) . '">';
            echo '<span class="form-field-label">' . esc_html($meta['label']) . '</span>';
            if ($field === 'phone') {
                echo '<img src="' . esc_url($args['flag_url']) . '" alt="" class="phone-flag">';
                echo '<input type="tel" name="phone" placeholder="' . esc_attr($meta['placeholder']) . '" required>';
            } elseif ($field === 'comment') {
                echo '<textarea name="comment" rows="3" placeholder="' . esc_attr($meta['placeholder']) . '"></textarea>';
            } else {
                $required = !empty($meta['required']) ? ' required' : '';
                echo '<input type="text" name="' . esc_attr($field) . '" placeholder="' . esc_attr($meta['placeholder']) . '"' . $required . '>';
            }
            echo '</label>';
            echo '</div>';
            continue;
        }

        if ($field === 'phone' && $args['phone_style'] === 'phone-input') {
            trimed_render_phone_input(array('flag_url' => $args['flag_url']));
        } elseif ($field === 'phone') {
            echo '<input type="tel" name="phone" placeholder="' . esc_attr($meta['placeholder']) . '" required>';
        } elseif ($field === 'comment') {
            echo '<textarea name="comment" placeholder="' . esc_attr($meta['placeholder']) . '"></textarea>';
        } else {
            $required = !empty($meta['required']) ? ' required' : '';
            echo '<input type="text" name="' . esc_attr($field) . '" placeholder="' . esc_attr($meta['placeholder']) . '"' . $required . '>';
        }
    }

    if ($args['layout'] === 'rows') {
        echo '<div class="form-row form-agree">';
        echo '<label class="checkbox-label">';
        echo '<input type="checkbox" name="agree" value="1" required>';
        echo '<span>Оставляя заявку, я соглашаюсь с условиями <a href="' . esc_url(trimed_legal_url('politika-obrabotki-personalnyh-dannyh')) . '">Политики обработки персональных данных</a></span>';
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
        'title_mobile' => '',
        'title_class' => '',
        'title_class_copy' => 'request-copy-desktop',
        'title_mobile_class' => 'request-copy-mobile',
        'desc'        => '',
        'desc_mobile' => '',
        'desc_class'  => '',
        'desc_class_copy' => 'request-copy-desktop',
        'desc_mobile_class' => 'request-copy-mobile',
        'note'        => '',
        'note_class'  => '',
        'note_icon'   => '',
        'note_label_class' => '',
    ));

    $tag = in_array($args['content_tag'], array('section', 'article', 'div', 'aside')) ? $args['content_tag'] : 'div';
    $content_class = trimed_sanitize_class_list($args['content_class']);
    $title_class = trimed_sanitize_class_list($args['title_class']);
    $title_class_copy = trimed_sanitize_class_list($args['title_class_copy']);
    $title_mobile_class = trimed_sanitize_class_list($args['title_mobile_class']);
    $desc_class = trimed_sanitize_class_list($args['desc_class']);
    $desc_class_copy = trimed_sanitize_class_list($args['desc_class_copy']);
    $desc_mobile_class = trimed_sanitize_class_list($args['desc_mobile_class']);
    $note_class = trimed_sanitize_class_list($args['note_class']);
    $note_label_class = trimed_sanitize_class_list($args['note_label_class']);

    if (!empty($args['icon'])) {
        echo $args['icon'];
    }

    echo '<' . $tag . (!empty($content_class) ? ' class="' . esc_attr($content_class) . '"' : '') . '>';
    if (!empty($args['title'])) {
        echo '<h2' . (!empty($title_class) ? ' class="' . esc_attr($title_class) . '"' : '') . '>';
        if (!empty($args['title_mobile'])) {
            echo '<span' . (!empty($title_class_copy) ? ' class="' . esc_attr($title_class_copy) . '"' : '') . '>' . wp_kses_post($args['title']) . '</span>';
            echo '<span' . (!empty($title_mobile_class) ? ' class="' . esc_attr($title_mobile_class) . '"' : '') . '>' . wp_kses_post($args['title_mobile']) . '</span>';
        } else {
            echo wp_kses_post($args['title']);
        }
        echo '</h2>';
    }
    if (!empty($args['desc'])) {
        echo '<p' . (!empty($desc_class) ? ' class="' . esc_attr($desc_class) . '"' : '') . '>';
        if (!empty($args['desc_mobile'])) {
            echo '<span' . (!empty($desc_class_copy) ? ' class="' . esc_attr($desc_class_copy) . '"' : '') . '>' . wp_kses_post($args['desc']) . '</span>';
            echo '<span' . (!empty($desc_mobile_class) ? ' class="' . esc_attr($desc_mobile_class) . '"' : '') . '>' . wp_kses_post($args['desc_mobile']) . '</span>';
        } else {
            echo wp_kses_post($args['desc']);
        }
        echo '</p>';
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

function trimed_sanitize_class_list($value) {
    if (!is_string($value)) {
        return '';
    }

    $classes = preg_split('/\s+/', trim($value));
    if (empty($classes) || (count($classes) === 1 && $classes[0] === '')) {
        return '';
    }

    $safe = array_map('sanitize_html_class', $classes);
    $safe = array_filter($safe, 'strlen');

    return trim(implode(' ', $safe));
}

/**
 * Эталонный набор аргументов формы (как на главной странице).
 * Единый источник DOM-разметки формы для всех страниц.
 */
function trimed_get_reference_form_args($overrides = array()) {
    return wp_parse_args($overrides, array(
        'class'         => 'home-request-form',
        'layout'        => 'rows',
        'fields'        => array('name', 'phone', 'organization', 'comment'),
        'flag_url'      => trimed_img_url('main/197-0.png'),
        'button_text'   => 'Получить консультацию',
        'button_class'  => 'btn btn-primary request-submit',
    ));
}

/**
 * Единый renderer полной секции заявки для всех публичных страниц.
 */
function trimed_render_request_callout($args = array()) {
    $args = wp_parse_args($args, array(
        'section_class'      => 'home-request',
        'section_id'         => '',
        'anchor_id'          => 'contacts',
        'container_class'    => 'container',
        'grid_class'         => 'request-grid',
        'icon'               => '<svg class="request-plus" width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M16 4v24M4 16h24" stroke="currentColor" stroke-width="6" stroke-linecap="round"/></svg>',
        'title'              => '',
        'title_mobile'       => '',
        'title_class'        => 'section-title white',
        'title_class_copy'   => 'request-copy-desktop',
        'title_mobile_class'  => 'request-copy-mobile',
        'description'        => '',
        'description_mobile'  => '',
        'description_class'  => '',
        'form_args'          => array(),
    ));

    $form_args = trimed_get_reference_form_args($args['form_args']);

    trimed_render_service_request_section(array(
        'section_class' => $args['section_class'],
        'section_id'    => $args['section_id'],
        'anchor_id'     => $args['anchor_id'],
        'container_class' => $args['container_class'],
        'inner_class'   => $args['grid_class'],
        'summary' => array(
            'icon'              => $args['icon'],
            'content_tag'       => 'div',
            'content_class'     => 'request-text',
            'title'             => $args['title'],
            'title_mobile'      => $args['title_mobile'],
            'title_class'       => $args['title_class'],
            'title_class_copy'  => $args['title_class_copy'],
            'title_mobile_class' => $args['title_mobile_class'],
            'desc'              => $args['description'],
            'desc_mobile'       => $args['description_mobile'],
            'desc_class'        => $args['description_class'],
            'desc_class_copy'   => 'request-copy-desktop',
            'desc_mobile_class' => 'request-copy-mobile',
        ),
        'form' => $form_args,
        'wrap_form' => true,
    ));
}

function trimed_get_default_faq_items($scope = '') {
    if ($scope === 'disinfection') {
        return array(
            array(
                'question' => 'Какие дезсредства выбрать для стоматологии?',
                'answer'   => 'Выбор зависит от зоны применения, обрабатываемой поверхности и требуемого режима дезинфекции. Специалист уточнит задачи клиники и подберёт зарегистрированные средства с подходящей инструкцией по применению.',
                'is_open'  => false,
            ),
            array(
                'question' => 'Как подобрать рециркулятор?',
                'answer'   => 'При подборе учитываются площадь и объём помещения, количество людей, режим работы и требуемая производительность. Мы поможем рассчитать параметры и подобрать подходящую модель.',
                'is_open'  => false,
            ),
            array(
                'question' => 'Какие средства подходят для обработки инструментов?',
                'answer'   => 'Средство выбирают с учётом материала инструмента, вида обработки и рекомендаций производителя. Мы предложим совместимые варианты и объясним порядок их безопасного применения.',
                'is_open'  => false,
            ),
            array(
                'question' => 'Какие документы предоставляются на продукцию?',
                'answer'   => 'Вместе с продукцией предоставляются предусмотренные для конкретного товара документы и инструкции. Перечень можно заранее уточнить у специалиста при оформлении заказа.',
                'is_open'  => false,
            ),
            array(
                'question' => 'Есть ли товары в наличии в Чите?',
                'answer'   => 'Да, в Чите есть склад, и товары имеются в наличии — более 5000 позиций. Осуществляется поставка непосредственно со склада в Чите.',
                'is_open'  => true,
            ),
        );
    }

    return array();
}

/**
 * Show the default disinfection FAQ as editable ACF rows until the page is
 * saved for the first time. Saved values, including an intentionally empty
 * repeater, always take precedence afterwards.
 */
function trimed_load_disinfection_faq_defaults($value, $post_id, $field) {
    if (!is_numeric($post_id) || get_page_template_slug((int) $post_id) !== 'page-disinfection.php') {
        return $value;
    }

    if (metadata_exists('post', (int) $post_id, 'faq_items')) {
        return $value;
    }

    return trimed_get_default_faq_items('disinfection');
}
add_filter('acf/load_value/name=faq_items', 'trimed_load_disinfection_faq_defaults', 10, 3);

function trimed_prepare_faq_items($items = array(), $options = array()) {
    $options = wp_parse_args($options, array(
        'open_first' => true,
    ));

    $raw_items = is_array($items) ? $items : array();
    $prepared = array();
    $opened = false;
    $first_answer_index = null;

    foreach ($raw_items as $item) {
        if (!is_array($item)) {
            continue;
        }

        $question = isset($item['question']) ? sanitize_text_field(wp_strip_all_tags((string)$item['question'])) : '';
        $answer = isset($item['answer']) ? (string)$item['answer'] : '';
        $answer = trim($answer);
        if ($question === '') {
            continue;
        }

        $has_answer = $answer !== '';
        $is_open = false;
        if ($options['open_first']) {
            if (!empty($item['is_open']) && $has_answer && !$opened) {
                $is_open = true;
                $opened = true;
            }
            if ($has_answer && $first_answer_index === null) {
                $first_answer_index = count($prepared);
            }
        }

        $prepared[] = array(
            'question'   => $question,
            'answer'     => $answer,
            'has_answer' => $has_answer,
            'is_open'    => $is_open,
        );
    }

    if ($options['open_first'] && !$opened && $first_answer_index !== null && isset($prepared[$first_answer_index])) {
        $prepared[$first_answer_index]['is_open'] = true;
    }

    return $prepared;
}

function trimed_render_faq_item($item, $icon_svg) {
    $question = isset($item['question']) ? $item['question'] : '';
    $answer = isset($item['answer']) ? $item['answer'] : '';
    $has_answer = !empty($item['has_answer']);
    $active_class = (!empty($item['is_open']) && $has_answer) ? ' active' : '';
    $answer_class = $has_answer ? ' has-answer' : '';

    echo '<div class="faq-item' . esc_attr($active_class) . esc_attr($answer_class) . '">';
    echo '<span>' . esc_html($question) . '</span>';
    echo '<span class="faq-icon">' . $icon_svg . '</span>';
    if ($has_answer) {
        echo '<p>' . wp_kses_post($answer) . '</p>';
    }
    echo '</div>';
}

function trimed_render_faq_section($args = array()) {
    $args = wp_parse_args($args, array(
        'section_class' => 'faq-section',
        'section_id'    => '',
        'container_class' => 'container',
        'header_class'  => 'faq-header',
        'title_class'   => 'section-title',
        'description_class' => 'faq-description',
        'grid_class'    => 'faq-grid',
        'items'         => array(),
        'title'         => '',
        'description'   => '',
        'split_columns' => true,
        'open_first'    => true,
        'icon_svg'      => '<svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.25L5 5.25L9 1.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    ));

    $items = trimed_prepare_faq_items($args['items'], array(
        'open_first' => (bool)$args['open_first'],
    ));

    $section_class = trimed_sanitize_class_list($args['section_class']);
    $section_id = trim(sanitize_html_class($args['section_id']));
    $container_class = trimed_sanitize_class_list($args['container_class']);
    $header_class = trimed_sanitize_class_list($args['header_class']);
    $title_class = trimed_sanitize_class_list($args['title_class']);
    $description_class = trimed_sanitize_class_list($args['description_class']);
    $grid_class = trimed_sanitize_class_list($args['grid_class']);

    echo '<section class="' . esc_attr($section_class) . '"' . (!empty($section_id) ? ' id="' . esc_attr($section_id) . '"' : '') . '>';
    echo '<div class="' . esc_attr($container_class) . '">';
    echo '<div class="' . esc_attr($header_class) . '">';
    if (!empty($args['title'])) {
        echo '<h2 class="' . esc_attr($title_class) . '">' . wp_kses_post($args['title']) . '</h2>';
    }
    if (!empty($args['description'])) {
        echo '<p class="' . esc_attr($description_class) . '">' . wp_kses_post($args['description']) . '</p>';
    }
    echo '</div>';

    echo '<div class="' . esc_attr($grid_class) . '">';
    $count = count($items);

    if ($args['split_columns'] && $count > 1) {
        $left_count = (int) ceil($count / 2);
        $left_items = array_slice($items, 0, $left_count);
        $right_items = array_slice($items, $left_count);

        echo '<div class="faq-column">';
        foreach ($left_items as $item) {
            trimed_render_faq_item($item, $args['icon_svg']);
        }
        echo '</div>';

        echo '<div class="faq-column">';
        foreach ($right_items as $item) {
            trimed_render_faq_item($item, $args['icon_svg']);
        }
        echo '</div>';
    } else {
        foreach ($items as $item) {
            trimed_render_faq_item($item, $args['icon_svg']);
        }
    }
    echo '</div>';
    echo '</div>';
    echo '</section>';
}

function trimed_render_service_request_section($args = array()) {
    $args = wp_parse_args($args, array(
        'section_class' => '',
        'section_id'    => '',
        'anchor_id'     => '',
        'container_class' => '',
        'inner_class'   => '',
        'wrap_form'     => false,
        'summary'       => array(),
        'form'          => array(),
    ));

    $section_class = trimed_sanitize_class_list($args['section_class']);
    $section_id = trim(sanitize_html_class($args['section_id']));
    $anchor_id = trim(sanitize_html_class($args['anchor_id']));
    $container_class = trimed_sanitize_class_list($args['container_class']);
    $inner_class = trimed_sanitize_class_list($args['inner_class']);

    $summary = is_array($args['summary']) ? $args['summary'] : array();
    $form = is_array($args['form']) ? $args['form'] : array();

    echo '<section class="' . esc_attr($section_class) . '"' . (!empty($section_id) ? ' id="' . esc_attr($section_id) . '"' : '') . '>';
    if ($anchor_id && $anchor_id !== $section_id) {
        echo '<span id="' . esc_attr($anchor_id) . '" aria-hidden="true"></span>';
    }

    if ($container_class) {
        echo '<div class="' . esc_attr($container_class) . '">';
    }

    echo '<div class="' . esc_attr($inner_class) . '">';
    trimed_render_request_summary_block($summary);
    if (!empty($args['wrap_form'])) {
        echo '<div class="request-form-wrap">';
        trimed_render_contact_form($form);
        echo '</div>';
    } else {
        trimed_render_contact_form($form);
    }
    echo '</div>';

    if ($container_class) {
        echo '</div>';
    }

    echo '</section>';
}

function trimed_render_plus_svg($class = '', $size = 40, $stroke = '#fff', $stroke_width = 5, $offset = null) {
    $half = $size / 2;
    $offset = $offset === null ? $size * 0.2 : $offset;
    $end = $size - $offset;

    echo '<svg class="' . esc_attr($class) . '" width="' . esc_attr($size) . '" height="' . esc_attr($size) . '" viewBox="0 0 ' . esc_attr($size) . ' ' . esc_attr($size) . '" fill="none">';
    echo '<path d="M' . esc_attr($half) . ' ' . esc_attr($offset) . 'v' . esc_attr($end - $offset) . 'M' . esc_attr($offset) . ' ' . esc_attr($half) . 'H' . esc_attr($end) . '" stroke="' . esc_attr($stroke) . '" stroke-width="' . esc_attr($stroke_width) . '" stroke-linecap="round"/>';
    echo '</svg>';
}

function trimed_get_clover_svg($class = '', $size = 20) {
    return '<svg class="' . esc_attr($class) . '" width="' . esc_attr($size) . '" height="' . esc_attr($size) . '" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M16.8026 6.80286C14.8114 6.80286 13.1967 5.18812 13.1967 3.19681C13.1967 1.4317 11.7657 0 10 0C8.23429 0 6.80264 1.4317 6.80264 3.19681C6.80264 5.18812 5.1886 6.80286 3.19736 6.80286C1.43165 6.80286 0 8.23391 0 10.0003C0 11.7661 1.43165 13.1971 3.19736 13.1971C5.1886 13.1971 6.80264 14.8112 6.80264 16.8025C6.80264 18.569 8.23429 20 10 20C11.7657 20 13.1967 18.569 13.1967 16.8025C13.1967 14.8112 14.8114 13.1971 16.8026 13.1971C18.5683 13.1971 20 11.7661 20 10.0003C20 8.23391 18.5683 6.80286 16.8026 6.80286Z" fill="currentColor"/></svg>';
}

function trimed_get_arrow_svg($class = '', $size = 24, $stroke_width = 2) {
    $class_attr = $class !== '' ? ' class="' . esc_attr($class) . '"' : '';
    if ((int) $size === 18) {
        $path = 'M3 15L15 3M15 3H6M15 3V12';
    } else {
        $path = 'M7 17L17 7M17 7H9M17 7V15';
    }
    return '<svg' . $class_attr . ' width="' . esc_attr($size) . '" height="' . esc_attr($size) . '" viewBox="0 0 ' . esc_attr($size) . ' ' . esc_attr($size) . '" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="' . $path . '" stroke="currentColor" stroke-width="' . esc_attr($stroke_width) . '" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}

/**
 * Render a reusable project/case card.
 *
 * Keeps legacy classes for compatibility and adds the shared .case-card pattern.
 *
 * @param array $args {
 *     @type string $variant          'home', 'medcentry' or 'stomatology'. Defines legacy class map.
 *     @type string $image            Image URL.
 *     @type string $image_alt        Optional image alt text.
 *     @type string $meta             Category/number text.
 *     @type string $title            Card title.
 *     @type string $text             Card description text.
 *     @type bool   $text_allow_html  Whether to allow wp_kses_post in text. Default false.
 *     @type bool   $responsive_image Whether to render image as <picture> with mobile srcset. Default false.
 *     @type string $link             Optional URL. If provided, card is wrapped in <a>.
 *     @type string $arrow            Arrow SVG/html. Defaults to 18px arrow.
 * }
 */
function trimed_render_case_card($args = array()) {
    $args = wp_parse_args($args, array(
        'variant'         => 'home',
        'image'           => '',
        'image_alt'       => '',
        'meta'            => '',
        'title'           => '',
        'text'            => '',
        'text_allow_html'  => false,
        'responsive_image' => false,
        'mobile_image'     => '',
        'link'             => '',
        'arrow'            => '',
    ));

    $variant = sanitize_key($args['variant']);
    $maps    = array(
        'home' => array(
            'card'   => 'project-card',
            'image'  => 'project-image',
            'body'   => 'project-body',
            'meta'   => 'project-cat',
            'title'  => 'project-title',
            'text'   => 'project-desc',
            'arrow'  => 'project-arrow',
        ),
        'medcentry' => array(
            'card'   => 'mc-project-card',
            'image'  => 'mc-project-card-img',
            'body'   => 'mc-project-card-body',
            'top'    => 'mc-project-card-top',
            'meta'   => 'mc-project-card-num',
            'title'  => 'mc-project-card-title',
            'text'   => 'mc-project-card-text',
            'arrow'  => 'mc-project-card-arrow',
        ),
        'stomatology' => array(
            'card'   => 'stom-project-card',
            'image'  => 'stom-project-card-img',
            'body'   => 'stom-project-card-body',
            'top'    => 'stom-project-card-top',
            'meta'   => 'stom-project-card-num',
            'title'  => 'stom-project-card-title',
            'text'   => 'stom-project-card-text',
            'arrow'  => 'stom-project-card-arrow',
        ),
    );

    $map = isset($maps[$variant]) ? $maps[$variant] : $maps['home'];

    $tag       = !empty($args['link']) ? 'a' : 'div';
    $href_attr = $tag === 'a' ? ' href="' . esc_url($args['link']) . '"' : '';
    $arrow     = $args['arrow'] !== '' ? $args['arrow'] : trimed_get_arrow_svg('', 18, 2);

    $image = esc_url($args['image']);
    $meta  = esc_html($args['meta']);
    $title = esc_html($args['title']);
    $text  = $args['text_allow_html'] ? wp_kses_post($args['text']) : esc_html($args['text']);

    $image_alt = esc_attr($args['image_alt']);

    $card_class   = trimed_sanitize_class_list($map['card'] . ' case-card');
    $image_class  = trimed_sanitize_class_list($map['image'] . ' case-card__image');
    $body_class   = trimed_sanitize_class_list($map['body'] . ' case-card__body');
    $meta_class   = trimed_sanitize_class_list($map['meta'] . ' case-card__meta');
    $title_class  = trimed_sanitize_class_list($map['title'] . ' case-card__title');
    $text_class   = trimed_sanitize_class_list($map['text'] . ' case-card__text');
    $arrow_class  = trimed_sanitize_class_list($map['arrow'] . ' case-card__arrow');

    echo '<' . $tag . $href_attr . ' class="' . esc_attr($card_class) . '">';
    echo '<div class="' . esc_attr($image_class) . '">';

    if (!empty($args['responsive_image']) || !empty($args['mobile_image'])) {
        trimed_render_responsive_picture($args['image'], array('alt' => $args['image_alt'], 'mobile_url' => $args['mobile_image']));
    } else {
        echo '<img src="' . $image . '" alt="' . $image_alt . '">';
    }

    echo '</div>';
    echo '<div class="' . esc_attr($body_class) . '">';

    if ($variant === 'medcentry' || $variant === 'stomatology') {
        $top_class = trimed_sanitize_class_list($map['top'] . ' case-card__top');
        echo '<div class="' . esc_attr($top_class) . '">';
        echo '<span class="' . esc_attr($meta_class) . '">' . $meta . '</span>';
        echo '<span class="' . esc_attr($arrow_class) . '">' . $arrow . '</span>';
        echo '</div>';
        echo '<div>';
        echo '<h3 class="' . esc_attr($title_class) . '">' . $title . '</h3>';
        echo '<p class="' . esc_attr($text_class) . '">' . $text . '</p>';
        echo '</div>';
    } else {
        echo '<span class="' . esc_attr($meta_class) . '">' . $meta . '</span>';
        echo '<h3 class="' . esc_attr($title_class) . '">' . $title . '</h3>';
        echo '<p class="' . esc_attr($text_class) . '">' . $text . '</p>';
    }

    echo '</div>';

    if ($variant === 'home') {
        echo '<span class="' . esc_attr($arrow_class) . '">' . $arrow . '</span>';
    }

    echo '</' . $tag . '>';
}

function trimed_enqueue_assets() {
    wp_enqueue_style('trimed-fonts', 'https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700;800&subset=cyrillic&display=swap', array(), null);
    wp_enqueue_style('trimed-style', get_stylesheet_uri(), array('trimed-fonts'), trimed_asset_version('style.css'));
    wp_enqueue_style('trimed-main', get_template_directory_uri() . '/assets/css/main.css', array('trimed-style'), trimed_asset_version('assets/css/main.css'));

    if (is_front_page()) {
        wp_enqueue_style('trimed-home', get_template_directory_uri() . '/assets/css/home.css', array('trimed-main'), trimed_asset_version('assets/css/home.css'));
        wp_enqueue_style('trimed-request-form', get_template_directory_uri() . '/assets/css/request-form.css', array('trimed-home'), trimed_asset_version('assets/css/request-form.css'));
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
    foreach (trimed_get_service_pages_config() as $config) {
        if (!trimed_is_service_page($config)) {
            continue;
        }

        wp_enqueue_style(
            $config['style']['handle'],
            get_template_directory_uri() . '/' . $config['style']['file'],
            array('trimed-main'),
            trimed_asset_version($config['style']['file'])
        );

        wp_enqueue_style(
            'trimed-request-form',
            get_template_directory_uri() . '/assets/css/request-form.css',
            array($config['style']['handle']),
            trimed_asset_version('assets/css/request-form.css')
        );
        break;
    }
}
add_action('wp_enqueue_scripts', 'trimed_enqueue_page_assets');

function trimed_handle_contact_form() {
    check_ajax_referer('trimed_contact_nonce', 'nonce');

    $honeypot = isset($_POST['company_website']) ? trim((string) wp_unslash($_POST['company_website'])) : '';
    if ($honeypot !== '') {
        wp_send_json_success('Спасибо! Ваша заявка отправлена.');
    }

    $started_at = isset($_POST['form_started_at']) ? absint($_POST['form_started_at']) : 0;
    if (!$started_at || (time() - $started_at) < 3) {
        wp_send_json_error('Не удалось отправить заявку. Попробуйте ещё раз через несколько секунд.', 400);
    }

    $remote_addr = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : 'unknown';
    $rate_key = 'trimed_form_rate_' . hash_hmac('sha256', $remote_addr, wp_salt('nonce'));
    $request_count = (int) get_transient($rate_key);
    if ($request_count >= 5) {
        wp_send_json_error('Слишком много заявок. Попробуйте позже или позвоните нам.', 429);
    }

    $name  = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
    $org   = isset($_POST['organization']) ? sanitize_text_field(wp_unslash($_POST['organization'])) : '';
    $comment = isset($_POST['comment']) ? sanitize_textarea_field(wp_unslash($_POST['comment'])) : '';
    $agree = isset($_POST['agree']) ? 1 : 0;

    if (empty($name) || empty($phone)) {
        wp_send_json_error('Пожалуйста, заполните имя и телефон.');
    }

    if (!$agree) {
        wp_send_json_error('Необходимо согласие на обработку персональных данных.');
    }

    if (mb_strlen($name) > 100 || mb_strlen($org) > 150 || mb_strlen($comment) > 2000) {
        wp_send_json_error('Проверьте длину заполненных полей.');
    }

    $phone_digits = preg_replace('/\D+/', '', $phone);
    if (strlen($phone_digits) < 7 || strlen($phone_digits) > 15) {
        wp_send_json_error('Укажите корректный номер телефона.');
    }

    $to = trimed_get_form_recipient_email();

    if (empty($to) || !is_email($to)) {
        wp_send_json_error('Не настроен email получателя. Обратитесь к администратору сайта.');
    }

    $subject = 'Новая заявка с сайта ТриМед';
    $message = "Имя: $name\nТелефон: $phone\nОрганизация: $org\nКомментарий: $comment";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    set_transient($rate_key, $request_count + 1, 15 * MINUTE_IN_SECONDS);
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

// Редактор repeaters для ACF Free (при ACF Pro не активируется)
require_once get_template_directory() . '/inc/acf-free-repeaters.php';
