<?php
if (!defined('ABSPATH')) exit;

/**
 * Редактор повторяющихся блоков для ACF Free.
 *
 * ACF Free не имеет класса поля repeater: локально зарегистрированные repeater'ы
 * видны в схеме, но нативный редактор строк недоступен. Этот модуль:
 *  1) добавляет metabox «Повторяющиеся блоки» на edit screen пяти публичных страниц;
 *  2) сохраняет строки в стандартном ACF repeater meta формате
 *     ({name}=count, _{name}=field key, {name}_{i}_{sub}, _{name}_{i}_{sub}=sub key),
 *     полностью совместимом с ACF Pro на будущее;
 *  3) чинит чтение repeaters через фильтр acf/load_value (get_field и
 *     trimed_repeater_field продолжают работать без изменения шаблонов).
 *
 * При активном ACF Pro модуль ничего не подменяет.
 */

function trimed_acf_free_repeaters_active() {
    if (!function_exists('acf_get_setting') || !function_exists('acf_add_local_field_group')) {
        return false;
    }

    return !acf_get_setting('pro');
}

if (!trimed_acf_free_repeaters_active()) {
    return;
}

/**
 * Карта: ACF group key => как определить применимую страницу.
 */
function trimed_free_repeater_group_map() {
    return array(
        'group_main_page'        => 'front_page',
        'group_disinfection_page' => array('template' => 'page-disinfection.php', 'slug' => 'dezinfektsiya'),
        'group_laboratory_page'  => array('template' => 'page-laboratory.php', 'slug' => 'laboratoriya'),
        'group_stomatology_page' => array('template' => 'page-stomatology.php', 'slug' => 'stomatologiya'),
        'group_medcentry_page'   => array('template' => 'page-medcentry.php', 'slug' => 'medcentry'),
    );
}

/**
 * Group keys, применимые к редактируемому посту.
 */
function trimed_free_repeater_groups_for_post($post_id) {
    $post_id = (int) $post_id;
    if ($post_id <= 0) {
        return array();
    }

    $post = get_post($post_id);
    if (!($post instanceof WP_Post) || $post->post_type !== 'page') {
        return array();
    }

    $groups = array();
    foreach (trimed_free_repeater_group_map() as $group_key => $rule) {
        if ($rule === 'front_page') {
            if ((int) get_option('page_on_front') === $post_id) {
                $groups[] = $group_key;
            }
            continue;
        }

        $template = isset($rule['template']) ? $rule['template'] : '';
        $slug = isset($rule['slug']) ? $rule['slug'] : '';
        if (($template !== '' && get_page_template_slug($post_id) === $template)
            || ($slug !== '' && $post->post_name === $slug)) {
            $groups[] = $group_key;
        }
    }

    return $groups;
}

/**
 * Поля группы из локальной регистрации ACF (единый источник схемы).
 */
function trimed_free_repeater_get_group_fields($group_key) {
    if (!function_exists('acf_get_field_group') || !function_exists('acf_get_fields')) {
        return array();
    }

    $group = acf_get_field_group($group_key);
    if (!is_array($group) || empty($group)) {
        return array();
    }

    $fields = acf_get_fields($group);
    return is_array($fields) ? $fields : array();
}

/**
 * Repeater-поля группы, сгруппированные по вкладкам (для секций metabox).
 *
 * @return array список секций: array('tab' => label, 'repeaters' => array(field))
 */
function trimed_free_repeater_collect_sections($group_key) {
    $sections = array();
    $current = null;

    foreach (trimed_free_repeater_get_group_fields($group_key) as $field) {
        if (!is_array($field) || empty($field['type'])) {
            continue;
        }
        if ($field['type'] === 'tab') {
            $current = $field['label'];
            continue;
        }
        if ($field['type'] !== 'repeater') {
            continue;
        }
        $tab = $current !== null ? $current : 'Прочее';
        if (!isset($sections[$tab])) {
            $sections[$tab] = array('tab' => $tab, 'repeaters' => array());
        }
        $sections[$tab]['repeaters'][] = $field;
    }

    return array_values($sections);
}

/**
 * Сырые строки repeater из post meta (без форматирования; image = attachment ID).
 * null — данных нет (страница не сохранялась); array() — сохранён пустой список.
 */
function trimed_free_repeater_get_raw_rows($post_id, $field) {
    $post_id = (int) $post_id;
    $name = isset($field['name']) ? $field['name'] : '';
    if ($post_id <= 0 || $name === '' || !metadata_exists('post', $post_id, $name)) {
        return null;
    }

    $count = (int) get_post_meta($post_id, $name, true);
    $rows = array();
    for ($i = 0; $i < $count; $i++) {
        $row = array();
        foreach ((array) $field['sub_fields'] as $sub) {
            $row[$sub['name']] = get_post_meta($post_id, $name . '_' . $i . '_' . $sub['name'], true);
        }
        $rows[] = $row;
    }

    return $rows;
}

/**
 * Форматирование одного sub-value под ожидания шаблонов (как get_field ACF Pro).
 */
function trimed_free_repeater_format_value($raw, $sub) {
    $type = isset($sub['type']) ? $sub['type'] : 'text';

    if ($type === 'image') {
        if ($raw === '' || $raw === null || $raw === false) {
            return '';
        }
        if (is_numeric($raw)) {
            $format = isset($sub['return_format']) ? $sub['return_format'] : 'url';
            if ($format === 'id') {
                return (int) $raw;
            }
            $url = wp_get_attachment_url((int) $raw);
            return $url ? $url : '';
        }
        return $raw; // уже URL (ручные/старые данные)
    }

    if ($type === 'true_false') {
        return (!empty($raw) && $raw !== '0') ? 1 : 0;
    }

    return is_string($raw) ? $raw : '';
}

/**
 * Строки repeater в формате get_field (image -> URL, true_false -> 1/0).
 * null — данных нет; array() — сохранён пустой список.
 */
function trimed_free_repeater_get_rows($post_id, $field) {
    $raw_rows = trimed_free_repeater_get_raw_rows($post_id, $field);
    if ($raw_rows === null) {
        return null;
    }

    $rows = array();
    foreach ($raw_rows as $raw_row) {
        $row = array();
        foreach ((array) $field['sub_fields'] as $sub) {
            $row[$sub['name']] = trimed_free_repeater_format_value(
                isset($raw_row[$sub['name']]) ? $raw_row[$sub['name']] : '',
                $sub
            );
        }
        $rows[] = $row;
    }

    return $rows;
}

/**
 * Generic reader: при ACF Free превращает сырое значение repeater (счётчик)
 * в массив строк. Срабатывает для всех чтений get_field()/trimed_repeater_field.
 */
function trimed_free_repeater_load_value($value, $post_id, $field) {
    if (!is_array($field) || !isset($field['type']) || $field['type'] !== 'repeater') {
        return $value;
    }
    if (!is_numeric($post_id)) {
        return $value;
    }

    $rows = trimed_free_repeater_get_rows((int) $post_id, $field);
    return $rows === null ? $value : $rows;
}
add_filter('acf/load_value', 'trimed_free_repeater_load_value', 9, 3);

/**
 * Sanitization по типу sub-поля.
 */
function trimed_free_repeater_sanitize($value, $sub) {
    $type = isset($sub['type']) ? $sub['type'] : 'text';

    switch ($type) {
        case 'textarea':
            return sanitize_textarea_field((string) $value);
        case 'url':
            return esc_url_raw((string) $value);
        case 'image':
            $id = absint($value);
            return $id > 0 ? (string) $id : '';
        case 'true_false':
            return (!empty($value) && $value !== '0') ? '1' : '0';
        case 'select':
            $value = sanitize_text_field((string) $value);
            $choices = array_keys((array) (isset($sub['choices']) ? $sub['choices'] : array()));
            if (in_array($value, $choices, true)) {
                return $value;
            }
            return isset($sub['default_value']) && is_string($sub['default_value']) ? $sub['default_value'] : '';
        default:
            return sanitize_text_field((string) $value);
    }
}

/**
 * Перезапись meta repeater в стандартном ACF формате (совместимо с ACF Pro).
 */
function trimed_free_repeater_write_meta($post_id, $field, $rows) {
    $name = $field['name'];

    // Удалить старые дочерние meta этого repeater.
    // Только ключи строк {name}_{i}_{sub} / _{name}_{i}_{sub} с числовым индексом,
    // чтобы не задеть соседние поля с общим префиксом (partners_title и т.п.).
    $all_meta = get_post_meta($post_id);
    if (is_array($all_meta)) {
        $quoted = preg_quote($name, '/');
        foreach (array_keys($all_meta) as $meta_key) {
            if (preg_match('/^' . $quoted . '_[0-9]+_/', $meta_key) || preg_match('/^_' . $quoted . '_[0-9]+_/', $meta_key)) {
                delete_post_meta($post_id, $meta_key);
            }
        }
    }

    update_post_meta($post_id, $name, count($rows));
    if (!empty($field['key'])) {
        update_post_meta($post_id, '_' . $name, $field['key']);
    }

    foreach ($rows as $i => $row) {
        foreach ((array) $field['sub_fields'] as $sub) {
            $sub_name = $sub['name'];
            update_post_meta($post_id, $name . '_' . $i . '_' . $sub_name, isset($row[$sub_name]) ? $row[$sub_name] : '');
            if (!empty($sub['key'])) {
                update_post_meta($post_id, '_' . $name . '_' . $i . '_' . $sub_name, $sub['key']);
            }
        }
    }
}

/**
 * Ядро сохранения (тестируемо отдельно от $_POST).
 */
function trimed_free_repeater_save_post_data($post_id, $input) {
    $post_id = (int) $post_id;
    if ($post_id <= 0 || !is_array($input)) {
        return;
    }

    foreach (trimed_free_repeater_groups_for_post($post_id) as $group_key) {
        foreach (trimed_free_repeater_collect_sections($group_key) as $section) {
            foreach ($section['repeaters'] as $field) {
                $name = $field['name'];
                $rows = (isset($input[$name]) && is_array($input[$name])) ? array_values($input[$name]) : array();

                $max = isset($field['max']) ? (int) $field['max'] : 0;
                if ($max > 0 && count($rows) > $max) {
                    $rows = array_slice($rows, 0, $max);
                }

                $clean = array();
                foreach ($rows as $row) {
                    $clean_row = array();
                    foreach ((array) $field['sub_fields'] as $sub) {
                        $clean_row[$sub['name']] = trimed_free_repeater_sanitize(
                            isset($row[$sub['name']]) ? $row[$sub['name']] : '',
                            $sub
                        );
                    }
                    $clean[] = $clean_row;
                }

                trimed_free_repeater_write_meta($post_id, $field, $clean);
            }
        }
    }
}

/**
 * Обработчик save_post: guards + извлечение входных данных.
 */
function trimed_free_repeater_save($post_id, $post, $update) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (empty($_POST['trimed_repeater_present'])) {
        return;
    }
    if (!isset($_POST['trimed_repeater_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['trimed_repeater_nonce'])), 'trimed_repeater_save')) {
        return;
    }

    $input = isset($_POST['trimed_rpt']) && is_array($_POST['trimed_rpt'])
        ? wp_unslash($_POST['trimed_rpt'])
        : array();

    trimed_free_repeater_save_post_data($post_id, $input);
}
add_action('save_post_page', 'trimed_free_repeater_save', 10, 3);

/**
 * Регистрация metabox на применимых страницах.
 */
function trimed_free_repeater_add_metabox($post_type, $post) {
    if ($post_type !== 'page' || !($post instanceof WP_Post)) {
        return;
    }
    if (empty(trimed_free_repeater_groups_for_post($post->ID))) {
        return;
    }

    add_meta_box(
        'trimed-free-repeaters',
        'Карточки и списки',
        'trimed_free_repeater_render_metabox',
        'page',
        'normal',
        'low'
    );
}
add_action('add_meta_boxes', 'trimed_free_repeater_add_metabox', 10, 2);

/**
 * Поле одного типа внутри строки (render).
 */
function trimed_free_repeater_render_subfield($field_name, $index, $sub, $value) {
    $input_name = 'trimed_rpt[' . $field_name . '][' . $index . '][' . $sub['name'] . ']';
    $label = isset($sub['label']) ? $sub['label'] : $sub['name'];
    $type = isset($sub['type']) ? $sub['type'] : 'text';

    echo '<div class="tr-field tr-field-' . esc_attr($type) . '">';
    echo '<label class="tr-label">' . esc_html($label) . '</label>';

    if ($type === 'textarea') {
        echo '<textarea class="tr-input" rows="3" name="' . esc_attr($input_name) . '">' . esc_textarea($value) . '</textarea>';
    } elseif ($type === 'select') {
        echo '<select class="tr-input" name="' . esc_attr($input_name) . '">';
        foreach ((array) (isset($sub['choices']) ? $sub['choices'] : array()) as $choice_value => $choice_label) {
            echo '<option value="' . esc_attr($choice_value) . '"' . selected($value, $choice_value, false) . '>' . esc_html($choice_label) . '</option>';
        }
        echo '</select>';
    } elseif ($type === 'true_false') {
        $checked = (!empty($value) && $value !== '0') ? ' checked' : '';
        echo '<label class="tr-checkbox"><input type="checkbox" name="' . esc_attr($input_name) . '" value="1"' . esc_attr($checked) . '> <span>' . esc_html($label) . '</span></label>';
    } elseif ($type === 'image') {
        $image_id = absint($value);
        echo '<div class="tr-image' . ($image_id ? ' has-image' : '') . '">';
        echo '<input type="hidden" class="tr-image-id" name="' . esc_attr($input_name) . '" value="' . esc_attr($image_id ? (string) $image_id : '') . '">';
        echo '<div class="tr-image-preview">';
        if ($image_id) {
            echo wp_get_attachment_image($image_id, 'thumbnail');
        }
        echo '</div>';
        echo '<button type="button" class="button tr-image-select">Выбрать</button> ';
        echo '<button type="button" class="button tr-image-clear">Убрать</button>';
        echo '</div>';
    } else {
        $input_type = $type === 'url' ? 'url' : 'text';
        echo '<input type="' . esc_attr($input_type) . '" class="tr-input" name="' . esc_attr($input_name) . '" value="' . esc_attr($value) . '">';
    }

    echo '</div>';
}

/**
 * Строка repeater (render). $index — число или '__INDEX__' для шаблона.
 */
function trimed_free_repeater_render_row($field, $index, $row, $number) {
    echo '<div class="tr-row" data-index="' . esc_attr((string) $index) . '">';
    echo '<div class="tr-row-header">';
    echo '<span class="tr-row-title">Запись <span class="tr-row-num">' . esc_html((string) $number) . '</span></span>';
    echo '<span class="tr-row-controls">';
    echo '<button type="button" class="button button-small tr-up" title="Выше">↑</button> ';
    echo '<button type="button" class="button button-small tr-down" title="Ниже">↓</button> ';
    echo '<button type="button" class="button button-small tr-remove" title="Удалить">✕</button>';
    echo '</span>';
    echo '</div>';
    echo '<div class="tr-row-fields">';
    foreach ((array) $field['sub_fields'] as $sub) {
        $value = isset($row[$sub['name']]) ? $row[$sub['name']] : '';
        trimed_free_repeater_render_subfield($field['name'], $index, $sub, $value);
    }
    echo '</div>';
    echo '</div>';
}

/**
 * Metabox render.
 */
function trimed_free_repeater_render_metabox($post) {
    wp_nonce_field('trimed_repeater_save', 'trimed_repeater_nonce');
    echo '<input type="hidden" name="trimed_repeater_present" value="1">';
    echo '<p class="tr-hint">Карточки, проекты, партнёры, отзывы, FAQ и другие списки. Изменения применяются после «Обновить».</p>';

    $sections = array();
    foreach (trimed_free_repeater_groups_for_post($post->ID) as $group_key) {
        foreach (trimed_free_repeater_collect_sections($group_key) as $section) {
            $sections[] = $section;
        }
    }

    if (empty($sections)) {
        echo '<p>Для этой страницы повторяющиеся блоки не настроены.</p>';
        return;
    }

    echo '<div class="tr-admin-tabs">';
    echo '<div class="tr-tab-nav" role="tablist" aria-label="Разделы карточек и списков">';
    foreach ($sections as $section_index => $section) {
        $tab_id = 'tr-tab-' . $post->ID . '-' . $section_index;
        echo '<button type="button" class="tr-tab-button' . ($section_index === 0 ? ' is-active' : '') . '" role="tab" aria-selected="' . ($section_index === 0 ? 'true' : 'false') . '" aria-controls="' . esc_attr($tab_id) . '" data-tab="' . esc_attr($tab_id) . '">' . esc_html($section['tab']) . '</button>';
    }
    echo '</div>';
    echo '<div class="tr-tab-content">';

    foreach ($sections as $section_index => $section) {
        $tab_id = 'tr-tab-' . $post->ID . '-' . $section_index;
        echo '<section id="' . esc_attr($tab_id) . '" class="tr-tab-panel' . ($section_index === 0 ? ' is-active' : '') . '" role="tabpanel">';

        foreach ($section['repeaters'] as $field) {
                $raw_rows = trimed_free_repeater_get_raw_rows($post->ID, $field);
                if ($raw_rows === null) {
                    // Страница ни разу не сохранялась: показать значения по умолчанию
                    // (те же, что видит фронтенд через acf/load_value фильтры),
                    // чтобы «просто нажать Обновить» не очистило контент.
                    $default_rows = function_exists('get_field') ? get_field($field['name'], $post->ID) : null;
                    $rows = is_array($default_rows) ? $default_rows : array();
                } else {
                    $rows = $raw_rows;
                }
                $max = isset($field['max']) ? (int) $field['max'] : 0;
                $button_label = !empty($field['button_label']) ? $field['button_label'] : 'Добавить строку';

                echo '<div class="tr-repeater" data-field="' . esc_attr($field['name']) . '" data-max="' . esc_attr((string) $max) . '">';
                echo '<div class="tr-repeater-title">' . esc_html($field['label']) . ($max > 0 ? ' <span class="tr-max">(макс. ' . esc_html((string) $max) . ')</span>' : '') . '</div>';
                echo '<div class="tr-rows">';
                foreach ($rows as $i => $row) {
                    trimed_free_repeater_render_row($field, $i, $row, $i + 1);
                }
                echo '</div>';
                echo '<template class="tr-template">';
                trimed_free_repeater_render_row($field, '__INDEX__', array(), '__NUM__');
                echo '</template>';
                echo '<button type="button" class="button tr-add">' . esc_html($button_label) . '</button>';
                echo '</div>';
        }

        echo '</section>';
    }

    echo '</div>';
    echo '</div>';
}

/**
 * Admin assets только на применимых edit screen.
 */
function trimed_free_repeater_admin_assets($hook) {
    // Options page «Настройки сайта»: только CSS, чтобы скрыть legacy-repeater.
    if ($hook === 'toplevel_page_trimed-theme-options') {
        wp_enqueue_style(
            'trimed-admin-repeaters',
            get_template_directory_uri() . '/assets/css/admin-repeaters.css',
            array(),
            trimed_asset_version('assets/css/admin-repeaters.css')
        );
        return;
    }

    if ($hook !== 'post.php' && $hook !== 'post-new.php') {
        return;
    }

    global $post;
    if (!($post instanceof WP_Post) || empty(trimed_free_repeater_groups_for_post($post->ID))) {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_script(
        'trimed-admin-repeaters',
        get_template_directory_uri() . '/assets/js/admin-repeaters.js',
        array('jquery'),
        trimed_asset_version('assets/js/admin-repeaters.js'),
        true
    );
    wp_enqueue_style(
        'trimed-admin-repeaters',
        get_template_directory_uri() . '/assets/css/admin-repeaters.css',
        array(),
        trimed_asset_version('assets/css/admin-repeaters.css')
    );
}
add_action('admin_enqueue_scripts', 'trimed_free_repeater_admin_assets');
