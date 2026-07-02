<?php
if (!defined('ABSPATH')) {
    exit;
}

define('TRIMED_VERSION', '1.10.48');

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
            $classes[] = $config['body_class'];
        }
    }
    return $classes;
}
add_filter('body_class', 'trimed_body_class');

function trimed_ensure_medcentry_menu_item($items, $args) {
    if (!empty($args->theme_location) && $args->theme_location !== 'primary') {
        return $items;
    }

    if (empty($args->theme_location) && !in_array($args->menu_class, array('nav-menu', 'mobile-nav-menu'), true)) {
        return $items;
    }

    $items_text = wp_strip_all_tags($items);
    if (
        stripos($items, 'Медцентры') !== false ||
        stripos($items_text, 'Медцентр') !== false ||
        stripos($items, '/medcentry') !== false
    ) {
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

function trimed_render_responsive_picture($url, $args = array()) {
    $args = wp_parse_args($args, array(
        'class' => '',
        'alt' => '',
        'width' => null,
        'height' => null,
        'style' => '',
    ));

    if (empty($url)) {
        return;
    }

    $mobile_url = preg_replace('/\.(png|jpe?g|webp)(\?.*)?$/i', '-mobile.$1$2', $url);
    $mobile_path = str_replace(get_template_directory_uri(), get_template_directory(), $mobile_url);
    if (!file_exists($mobile_path)) {
        $mobile_url = $url;
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

function trimed_get_default_form_fields() {
    return array(
        'name' => array(
            'label' => 'Ваше имя',
            'placeholder' => 'Иванов Николай Сергеевич',
            'required' => true,
        ),
        'phone' => array(
            'label' => 'Телефон',
            'placeholder' => '+7 (999) 999-99-99',
            'required' => true,
            'type' => 'tel',
            'is_phone' => true,
        ),
        'organization' => array(
            'label' => 'Организация',
            'placeholder' => 'Название организации',
            'required' => false,
        ),
        'comment' => array(
            'label' => 'Комментарий',
            'placeholder' => 'Ваш комментарий',
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
        echo '<h2' . (!empty($title_class) ? ' class="' . esc_attr($title_class) . '"' : '') . '>';
        if (!empty($args['title_mobile'])) {
            echo '<span class="' . esc_attr(sanitize_html_class($args['title_class_copy'])) . '">' . wp_kses_post($args['title']) . '</span>';
            echo '<span class="' . esc_attr(sanitize_html_class($args['title_mobile_class'])) . '">' . wp_kses_post($args['title_mobile']) . '</span>';
        } else {
            echo wp_kses_post($args['title']);
        }
        echo '</h2>';
    }
    if (!empty($args['desc'])) {
        echo '<p' . (!empty($desc_class) ? ' class="' . esc_attr($desc_class) . '"' : '') . '>';
        if (!empty($args['desc_mobile'])) {
            echo '<span class="' . esc_attr(sanitize_html_class($args['desc_class_copy'])) . '">' . wp_kses_post($args['desc']) . '</span>';
            echo '<span class="' . esc_attr(sanitize_html_class($args['desc_mobile_class'])) . '">' . wp_kses_post($args['desc_mobile']) . '</span>';
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

function trimed_render_request_callout($args = array()) {
    $args = wp_parse_args($args, array(
        'section_class'      => 'home-request',
        'section_id'         => '',
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

    $form_args = wp_parse_args($args['form_args'], array(
        'class'         => 'home-request-form',
        'layout'        => 'rows',
        'fields'        => array('name', 'phone', 'organization', 'comment'),
        'flag_url'      => trimed_img_url('main/197-0.png'),
        'button_text'   => 'Получить консультацию',
        'button_class'  => 'btn btn-primary request-submit',
    ));

    trimed_render_service_request_section(array(
        'section_class' => $args['section_class'],
        'section_id'    => $args['section_id'],
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
                'answer'   => '',
                'is_open'  => false,
            ),
            array(
                'question' => 'Как подобрать рециркулятор?',
                'answer'   => '',
                'is_open'  => false,
            ),
            array(
                'question' => 'Какие средства подходят для обработки инструментов?',
                'answer'   => '',
                'is_open'  => false,
            ),
            array(
                'question' => 'Какие документы предоставляются на продукцию?',
                'answer'   => '',
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

    echo '<section class="' . esc_attr(sanitize_html_class($args['section_class'])) . '"' . (!empty($args['section_id']) ? ' id="' . esc_attr(sanitize_html_class($args['section_id'])) . '"' : '') . '>';
    echo '<div class="' . esc_attr(sanitize_html_class($args['container_class'])) . '">';
    echo '<div class="' . esc_attr(sanitize_html_class($args['header_class'])) . '">';
    if (!empty($args['title'])) {
        echo '<h2 class="' . esc_attr(sanitize_html_class($args['title_class'])) . '">' . wp_kses_post($args['title']) . '</h2>';
    }
    if (!empty($args['description'])) {
        echo '<p class="' . esc_attr(sanitize_html_class($args['description_class'])) . '">' . wp_kses_post($args['description']) . '</p>';
    }
    echo '</div>';

    echo '<div class="' . esc_attr(sanitize_html_class($args['grid_class'])) . '">';
    $count = count($items);

    if ($args['split_columns'] && $count > 1) {
        $left_count = (int) ceil($count / 2);
        $left_items = array_slice($items, 0, $left_count);
        $right_items = array_slice($items, $left_count);

        echo '<div class="faq-column">';
        foreach ($left_items as $item) {
            $question = $item['question'];
            $answer = $item['answer'];
            $has_answer = $item['has_answer'];

            $active_class = (!empty($item['is_open']) && $has_answer) ? ' active' : '';
            $answer_class = $has_answer ? ' has-answer' : '';
            echo '<div class="faq-item' . esc_attr($active_class) . esc_attr($answer_class) . '">';
            echo '<span>' . esc_html($question) . '</span>';
            echo '<span class="faq-icon">' . $args['icon_svg'] . '</span>';
            if ($has_answer) {
                echo '<p>' . wp_kses_post($answer) . '</p>';
            }
            echo '</div>';
        }
        echo '</div>';

        echo '<div class="faq-column">';
        foreach ($right_items as $item) {
            $question = $item['question'];
            $answer = $item['answer'];
            $has_answer = $item['has_answer'];

            $active_class = (!empty($item['is_open']) && $has_answer) ? ' active' : '';
            $answer_class = $has_answer ? ' has-answer' : '';
            echo '<div class="faq-item' . esc_attr($active_class) . esc_attr($answer_class) . '">';
            echo '<span>' . esc_html($question) . '</span>';
            echo '<span class="faq-icon">' . $args['icon_svg'] . '</span>';
            if ($has_answer) {
                echo '<p>' . wp_kses_post($answer) . '</p>';
            }
            echo '</div>';
        }
        echo '</div>';
    } else {
        foreach ($items as $item) {
            $question = $item['question'];
            $answer   = $item['answer'];
            $has_answer = $item['has_answer'];

        $active_class = (!empty($item['is_open']) && $has_answer) ? ' active' : '';
        $answer_class = $has_answer ? ' has-answer' : '';
            echo '<div class="faq-item' . esc_attr($active_class) . esc_attr($answer_class) . '">';
        echo '<span>' . esc_html($question) . '</span>';
        echo '<span class="faq-icon">' . $args['icon_svg'] . '</span>';
        if ($has_answer) {
            echo '<p>' . wp_kses_post($answer) . '</p>';
        }
        echo '</div>';
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
        'container_class' => '',
        'inner_class'   => '',
        'wrap_form'     => false,
        'summary'       => array(),
        'form'          => array(),
    ));

    $section_class = trimed_sanitize_class_list($args['section_class']);
    $section_id = trim(sanitize_html_class($args['section_id']));
    $container_class = trimed_sanitize_class_list($args['container_class']);
    $inner_class = trimed_sanitize_class_list($args['inner_class']);

    $summary = is_array($args['summary']) ? $args['summary'] : array();
    $form = is_array($args['form']) ? $args['form'] : array();

    echo '<section class="' . esc_attr($section_class) . '"' . (!empty($section_id) ? ' id="' . esc_attr($section_id) . '"' : '') . '>';

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
