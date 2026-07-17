<?php
if (!defined('ABSPATH')) exit;

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Настройки сайта',
        'menu_title' => 'Настройки сайта',
        'menu_slug'  => 'trimed-theme-options',
        'capability' => 'manage_options',
        'redirect'   => false,
        'icon_url'   => 'dashicons-admin-generic',
    ));
} elseif (is_admin()) {
    /**
     * ACF Free не содержит Options Page. Регистрируем совместимую страницу
     * вручную, а поля и значения оставляем в стандартном ACF options storage.
     */
    function trimed_register_free_options_page() {
        $hook = add_menu_page(
            'Настройки сайта',
            'Настройки сайта',
            'manage_options',
            'trimed-theme-options',
            'trimed_render_free_options_page',
            'dashicons-admin-generic',
            58
        );

        add_action('load-' . $hook, 'trimed_prepare_free_options_page');
    }
    add_action('admin_menu', 'trimed_register_free_options_page');

    function trimed_prepare_free_options_page() {
        if (function_exists('acf_form_head')) {
            acf_form_head();
        }
    }

    function trimed_render_free_options_page() {
        if (!current_user_can('manage_options')) {
            wp_die(esc_html__('У вас недостаточно прав для просмотра этой страницы.'));
        }

        echo '<div class="wrap trimed-options-page">';
        echo '<h1>Настройки сайта</h1>';

        if (!function_exists('acf_form')) {
            echo '<div class="notice notice-error"><p>Для редактирования настроек требуется активный плагин ACF.</p></div>';
            echo '</div>';
            return;
        }

        acf_form(array(
            'post_id' => 'options',
            'field_groups' => array('group_trimed_contacts'),
            'form' => true,
            'submit_value' => 'Сохранить настройки',
            'updated_message' => 'Настройки сайта сохранены.',
            'return' => admin_url('admin.php?page=trimed-theme-options&updated=true'),
            'uploader' => 'wp',
        ));

        echo '</div>';
    }
}

if (function_exists('acf_add_local_field_group')) {

    // Глобальные настройки сайта (options). Вкладки placement=top, без endpoint.
    acf_add_local_field_group(array(
        'key' => 'group_trimed_contacts',
        'title' => 'Настройки сайта',
        'fields' => array(
            // Контакты
            array('key' => 'tab_trimed_contacts', 'label' => 'Контакты', 'name' => 'tab_trimed_contacts', 'type' => 'tab', 'placement' => 'left'),
            array(
                'key' => 'field_trimed_contact_phone',
                'label' => 'Основной телефон',
                'name' => 'trimed_contact_phone',
                'type' => 'text',
                'default_value' => trimed_get_default_contacts()['phone'],
            ),
            array(
                'key' => 'field_trimed_contact_public_email',
                'label' => 'Публичный email',
                'name' => 'trimed_contact_public_email',
                'type' => 'email',
                'default_value' => trimed_get_default_contacts()['email'],
                'instructions' => 'Отображается на сайте (в подвале). Если не заполнен, показывается публичный адрес по умолчанию.',
            ),
            array(
                'key' => 'field_trimed_contact_address',
                'label' => 'Адрес',
                'name' => 'trimed_contact_address',
                'type' => 'text',
                'default_value' => trimed_get_default_contacts()['address'],
            ),

            // Заявки
            array('key' => 'tab_trimed_form', 'label' => 'Заявки', 'name' => 'tab_trimed_form', 'type' => 'tab', 'placement' => 'left'),
            array(
                'key' => 'field_trimed_contact_email',
                'label' => 'Email получателя заявок',
                'name' => 'trimed_contact_email',
                'type' => 'email',
                'default_value' => trimed_get_default_contacts()['email'],
                'instructions' => 'Служебный адрес: сюда приходят заявки с форм. На сайте не выводится. Можно переопределить константой TRIMED_FORM_EMAIL в wp-config.php.',
            ),
            array('key' => 'field_trimed_form_name_placeholder', 'label' => 'Подсказка поля «Имя»', 'name' => 'trimed_form_name_placeholder', 'type' => 'text', 'default_value' => 'Иванов Николай Сергеевич'),
            array('key' => 'field_trimed_form_phone_placeholder', 'label' => 'Подсказка поля «Телефон»', 'name' => 'trimed_form_phone_placeholder', 'type' => 'text', 'default_value' => '+7 (999) 999-99-99'),
            array('key' => 'field_trimed_form_organization_placeholder', 'label' => 'Подсказка поля «Организация»', 'name' => 'trimed_form_organization_placeholder', 'type' => 'text', 'default_value' => 'Название организации'),
            array('key' => 'field_trimed_form_comment_placeholder', 'label' => 'Подсказка поля «Комментарий»', 'name' => 'trimed_form_comment_placeholder', 'type' => 'text', 'default_value' => 'Ваш комментарий'),
            array('key' => 'field_trimed_form_agreement_text', 'label' => 'Текст согласия', 'name' => 'trimed_form_agreement_text', 'type' => 'textarea', 'default_value' => 'Оставляя заявку, я соглашаюсь с условиями Политики обработки персональных данных'),

            // Социальные сети
            array('key' => 'tab_trimed_socials', 'label' => 'Социальные сети', 'name' => 'tab_trimed_socials', 'type' => 'tab', 'placement' => 'left'),
            array('key' => 'field_trimed_social_1_url', 'label' => 'Соцсеть 1 — ссылка', 'name' => 'trimed_social_1_url', 'type' => 'url'),
            array('key' => 'field_trimed_social_1_icon', 'label' => 'Соцсеть 1 — иконка', 'name' => 'trimed_social_1_icon', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail', 'instructions' => 'Если иконка не выбрана, используется стандартная из темы.'),
            array('key' => 'field_trimed_social_2_url', 'label' => 'Соцсеть 2 — ссылка', 'name' => 'trimed_social_2_url', 'type' => 'url'),
            array('key' => 'field_trimed_social_2_icon', 'label' => 'Соцсеть 2 — иконка', 'name' => 'trimed_social_2_icon', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail', 'instructions' => 'Если иконка не выбрана, используется стандартная из темы.'),
            array('key' => 'field_trimed_social_3_url', 'label' => 'Соцсеть 3 — ссылка', 'name' => 'trimed_social_3_url', 'type' => 'url'),
            array('key' => 'field_trimed_social_3_icon', 'label' => 'Соцсеть 3 — иконка', 'name' => 'trimed_social_3_icon', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail', 'instructions' => 'Если иконка не выбрана, используется стандартная из темы.'),
            array(
                'key' => 'field_trimed_contact_socials',
                'label' => 'Социальные сети (legacy, не редактируется)',
                'name' => 'trimed_contact_socials',
                'type' => 'repeater',
                'instructions' => 'Устаревшее поле-repeater: в ACF Free не редактируется. Редактируйте слоты выше. Ранее сохранённые значения продолжают выводиться, пока не заполнен ни один слот.',
                'wrapper' => array('class' => 'trimed-legacy-field'),
                'min' => 0,
                'max' => 5,
                'layout' => 'table',
                'button_label' => 'Добавить соцсеть',
                'sub_fields' => array(
                    array(
                        'key' => 'field_trimed_social_url',
                        'label' => 'Ссылка',
                        'name' => 'url',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_trimed_social_icon',
                        'label' => 'Иконка',
                        'name' => 'icon',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'thumbnail',
                    ),
                ),
            ),

            // Реквизиты
            array('key' => 'tab_trimed_footer', 'label' => 'Реквизиты', 'name' => 'tab_trimed_footer', 'type' => 'tab', 'placement' => 'left'),
            array('key' => 'field_trimed_footer_inn', 'label' => 'ИНН', 'name' => 'trimed_footer_inn', 'type' => 'text', 'default_value' => 'ИНН 7500009501'),
            array('key' => 'field_trimed_footer_ogrn', 'label' => 'ОГРН', 'name' => 'trimed_footer_ogrn', 'type' => 'text', 'default_value' => 'ОГРН 1237500001859'),
            array('key' => 'field_trimed_footer_copyright', 'label' => 'Копирайт', 'name' => 'trimed_footer_copyright', 'type' => 'text', 'default_value' => '© 2026, «ТриМед». Все права защищены.'),

            // Ссылки
            array('key' => 'tab_trimed_links', 'label' => 'Ссылки', 'name' => 'tab_trimed_links', 'type' => 'tab', 'placement' => 'left'),
            array(
                'key' => 'field_trimed_shop_url',
                'label' => 'Ссылка «В магазин» (каталог)',
                'name' => 'trimed_shop_url',
                'type' => 'url',
                'instructions' => 'Глобальная ссылка на магазин/каталог. Пока не заполнена, кнопка «В магазин» ведёт на #.',
            ),
            array('key' => 'field_trimed_footer_consent_text', 'label' => 'Название ссылки «Согласие»', 'name' => 'trimed_footer_consent_text', 'type' => 'text', 'default_value' => 'Согласие на обработку персональных данных'),
            array('key' => 'field_trimed_footer_policy_text', 'label' => 'Название ссылки «Политика»', 'name' => 'trimed_footer_policy_text', 'type' => 'text', 'default_value' => 'Политика об обработке персональных данных'),
            array('key' => 'field_trimed_footer_agreement_text', 'label' => 'Название ссылки «Соглашение»', 'name' => 'trimed_footer_agreement_text', 'type' => 'text', 'default_value' => 'Пользовательское соглашение'),

            // Карта
            array('key' => 'tab_trimed_map', 'label' => 'Карта', 'name' => 'tab_trimed_map', 'type' => 'tab', 'placement' => 'left'),
            array('key' => 'field_trimed_footer_map_image', 'label' => 'Изображение карты', 'name' => 'trimed_footer_map_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
            array('key' => 'field_trimed_footer_map_url', 'label' => 'Ссылка на карту', 'name' => 'trimed_footer_map_url', 'type' => 'url', 'default_value' => 'https://yandex.ru/maps/-/CTqTRF5S'),

            // Шапка и подвал
            array('key' => 'tab_trimed_header', 'label' => 'Шапка и подвал', 'name' => 'tab_trimed_header', 'type' => 'tab', 'placement' => 'left'),
            array('key' => 'field_trimed_header_logo', 'label' => 'Логотип', 'name' => 'trimed_header_logo', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
            array('key' => 'field_trimed_header_compare_url', 'label' => 'Ссылка «Сравнение»', 'name' => 'trimed_header_compare_url', 'type' => 'url'),
            array('key' => 'field_trimed_header_compare_count', 'label' => 'Счётчик «Сравнение»', 'name' => 'trimed_header_compare_count', 'type' => 'text', 'default_value' => '1'),
            array('key' => 'field_trimed_header_favorite_url', 'label' => 'Ссылка «Избранное»', 'name' => 'trimed_header_favorite_url', 'type' => 'url'),
            array('key' => 'field_trimed_header_favorite_count', 'label' => 'Счётчик «Избранное»', 'name' => 'trimed_header_favorite_count', 'type' => 'text', 'default_value' => '1'),
            array('key' => 'field_trimed_header_cart_url', 'label' => 'Ссылка «Корзина»', 'name' => 'trimed_header_cart_url', 'type' => 'url'),
            array('key' => 'field_trimed_header_cart_count', 'label' => 'Счётчик «Корзина»', 'name' => 'trimed_header_cart_count', 'type' => 'text', 'default_value' => '3'),
            array('key' => 'field_trimed_footer_logo', 'label' => 'Белый логотип', 'name' => 'trimed_footer_logo', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
            array('key' => 'field_trimed_footer_callback_text', 'label' => 'Текст кнопки звонка', 'name' => 'trimed_footer_callback_text', 'type' => 'text', 'default_value' => 'Заказать звонок'),
            array('key' => 'field_trimed_footer_callback_url', 'label' => 'Ссылка кнопки звонка', 'name' => 'trimed_footer_callback_url', 'type' => 'text', 'default_value' => '#application'),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'trimed-theme-options',
                ),
            ),
        ),
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_disinfection_page',
        'title' => 'Страница Дезинфекция',
        'fields' => array(
            // Hero
            array(
                'key' => 'tab_hero',
                'label' => 'Первый экран',
                'name' => 'tab_hero',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_hero_title',
                'label' => 'Заголовок Hero',
                'name' => 'hero_title',
                'type' => 'text',
                'default_value' => 'Комплексные решения для дезинфекции и инфекционного контроля',
            ),
            array(
                'key' => 'field_hero_desc',
                'label' => 'Описание Hero',
                'name' => 'hero_desc',
                'type' => 'textarea',
                'default_value' => 'Подбираем дезинфицирующие средства, оборудование и расходные материалы для медицинских учреждений, стоматологий, лабораторий и организаций различных сфер деятельности',
            ),
            array(
                'key' => 'field_hero_button_text',
                'label' => 'Текст кнопки Hero',
                'name' => 'hero_button_text',
                'type' => 'text',
                'default_value' => 'Подобрать решение',
            ),
            array(
                'key' => 'field_hero_image',
                'label' => 'Изображение Hero',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_hero_badges',
                'label' => 'Бейджи Hero',
                'name' => 'hero_badges',
                'type' => 'repeater',
                'min' => 0,
                'max' => 5,
                'layout' => 'table',
                'button_label' => 'Добавить бейдж',
                'sub_fields' => array(
                    array(
                        'key' => 'field_hero_badge_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_hero_features',
                'label' => 'Преимущества Hero',
                'name' => 'hero_features',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'table',
                'button_label' => 'Добавить преимущество',
                'sub_fields' => array(
                    array(
                        'key' => 'field_hero_feature_icon',
                        'label' => 'Иконка',
                        'name' => 'icon',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'thumbnail',
                    ),
                    array(
                        'key' => 'field_hero_feature_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
            ),

            // Audience
            array(
                'key' => 'tab_audience',
                'label' => 'Кому подходит',
                'name' => 'tab_audience',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_audience_subtitle',
                'label' => 'Подзаголовок',
                'name' => 'audience_subtitle',
                'type' => 'text',
                'default_value' => 'Кому подходит',
            ),
            array(
                'key' => 'field_audience_title',
                'label' => 'Заголовок',
                'name' => 'audience_title',
                'type' => 'text',
                'default_value' => 'Работаем с учреждениями разных направлений',
            ),
            array(
                'key' => 'field_audience_cards',
                'label' => 'Карточки аудиторий',
                'name' => 'audience_cards',
                'type' => 'repeater',
                'min' => 0,
                'max' => 12,
                'layout' => 'block',
                'button_label' => 'Добавить карточку',
                'sub_fields' => array(
                    array(
                        'key' => 'field_audience_card_title',
                        'label' => 'Название',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_audience_card_image',
                        'label' => 'Фоновое изображение',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_audience_card_style',
                        'label' => 'Стиль',
                        'name' => 'style',
                        'type' => 'select',
                        'choices' => array(
                            'default' => 'По умолчанию',
                            'gray' => 'Серая',
                            'green' => 'Зелёная',
                            'image' => 'С изображением',
                            'image-overlay' => 'С изображением + затемнение',
                        ),
                        'default_value' => 'default',
                    ),
                ),
            ),

            // Supplies
            array(
                'key' => 'tab_supplies',
                'label' => 'Что мы поставляем',
                'name' => 'tab_supplies',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_supplies_subtitle',
                'label' => 'Подзаголовок',
                'name' => 'supplies_subtitle',
                'type' => 'text',
                'default_value' => 'Что мы поставляем',
            ),
            array(
                'key' => 'field_supplies_title',
                'label' => 'Заголовок',
                'name' => 'supplies_title',
                'type' => 'text',
                'default_value' => 'Все для организации инфекционного контроля',
            ),
            array(
                'key' => 'field_supplies_center_image',
                'label' => 'Центральное изображение',
                'name' => 'supplies_center_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_supplies_items',
                'label' => 'Позиции поставок',
                'name' => 'supplies_items',
                'type' => 'repeater',
                'instructions' => 'Если позиций меньше 11, на сайте выводится стандартный список из 11 позиций.',
                'min' => 0,
                'max' => 15,
                'layout' => 'table',
                'button_label' => 'Добавить позицию',
                'sub_fields' => array(
                    array(
                        'key' => 'field_supplies_item_text',
                        'label' => 'Название',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
            ),

            // Included
            array(
                'key' => 'tab_included',
                'label' => 'Что входит',
                'name' => 'tab_included',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_included_subtitle',
                'label' => 'Подзаголовок',
                'name' => 'included_subtitle',
                'type' => 'text',
                'default_value' => 'Что входит',
            ),
            array(
                'key' => 'field_included_title',
                'label' => 'Заголовок',
                'name' => 'included_title',
                'type' => 'text',
                'default_value' => 'Помогаем выстроить систему инфекционного контроля',
            ),
            array(
                'key' => 'field_included_card_text',
                'label' => 'Текст зеленой карточки',
                'name' => 'included_card_text',
                'type' => 'textarea',
                'default_value' => 'Мы помогаем подобрать решения, которые обеспечивают безопасность, удобство использования и соответствие действующим санитарным требованиям',
            ),
            array(
                'key' => 'field_included_cards',
                'label' => 'Карточки "Что входит"',
                'name' => 'included_cards',
                'type' => 'repeater',
                'min' => 0,
                'max' => 10,
                'layout' => 'block',
                'button_label' => 'Добавить карточку',
                'sub_fields' => array(
                    array(
                        'key' => 'field_included_card_image',
                        'label' => 'Изображение',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_included_card_number',
                        'label' => 'Номер',
                        'name' => 'number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_included_card_title',
                        'label' => 'Заголовок',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_included_card_green',
                        'label' => 'Зелёная карточка',
                        'name' => 'is_green',
                        'type' => 'true_false',
                        'default_value' => 0,
                    ),
                ),
            ),

            // Tasks
            array(
                'key' => 'tab_tasks',
                'label' => 'Задачи клиентов',
                'name' => 'tab_tasks',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_tasks_subtitle',
                'label' => 'Подзаголовок',
                'name' => 'tasks_subtitle',
                'type' => 'text',
                'default_value' => 'Популярные задачи клиентов',
            ),
            array(
                'key' => 'field_tasks_title',
                'label' => 'Заголовок',
                'name' => 'tasks_title',
                'type' => 'text',
                'default_value' => 'С чем к нам обращаются чаще всего',
            ),
            array(
                'key' => 'field_tasks_list',
                'label' => 'Список задач',
                'name' => 'tasks_list',
                'type' => 'repeater',
                'min' => 0,
                'max' => 10,
                'layout' => 'table',
                'button_label' => 'Добавить задачу',
                'sub_fields' => array(
                    array(
                        'key' => 'field_task_icon',
                        'label' => 'Иконка',
                        'name' => 'icon',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'thumbnail',
                    ),
                    array(
                        'key' => 'field_task_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
            ),

            // Why choose
            array(
                'key' => 'tab_why',
                'label' => 'Почему выбирают',
                'name' => 'tab_why',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_why_subtitle',
                'label' => 'Подзаголовок',
                'name' => 'why_subtitle',
                'type' => 'text',
                'default_value' => 'Почему выбирают ТриМед',
            ),
            array(
                'key' => 'field_why_title',
                'label' => 'Заголовок',
                'name' => 'why_title',
                'type' => 'text',
                'default_value' => 'Надёжный поставщик для медицинских учреждений региона',
            ),
            array('key' => 'field_why_main_image', 'label' => 'Основное изображение', 'name' => 'why_main_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
            array('key' => 'field_why_warehouse_image', 'label' => 'Изображение склада', 'name' => 'why_warehouse_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
            array(
                'key' => 'field_why_features',
                'label' => 'Преимущества',
                'name' => 'why_features',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'table',
                'button_label' => 'Добавить преимущество',
                'sub_fields' => array(
                    array(
                        'key' => 'field_why_feature_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
            ),

            // Projects
            array(
                'key' => 'tab_projects',
                'label' => 'Реализованные проекты',
                'name' => 'tab_projects',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_projects_title',
                'label' => 'Заголовок',
                'name' => 'projects_title',
                'type' => 'text',
                'default_value' => 'Реализованные проекты',
            ),
            array(
                'key' => 'field_projects_desc',
                'label' => 'Описание',
                'name' => 'projects_desc',
                'type' => 'textarea',
                'default_value' => 'За время работы мы реализовали проекты по оснащению медицинских кабинетов и центров в Забайкальском крае. Мы понимаем специфику региона, требования врачей и реальные условия работы.',
            ),
            array(
                'key' => 'field_projects_slides',
                'label' => 'Слайды проектов',
                'name' => 'projects_slides',
                'type' => 'repeater',
                'min' => 0,
                'max' => 12,
                'layout' => 'block',
                'button_label' => 'Добавить проект',
                'sub_fields' => array(
                    array('key' => 'field_projects_slide_num', 'label' => 'Номер', 'name' => 'num', 'type' => 'text'),
                    array('key' => 'field_projects_slide_title', 'label' => 'Название', 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_projects_slide_task', 'label' => 'Задача клиента', 'name' => 'task', 'type' => 'textarea'),
                    array('key' => 'field_projects_slide_equipment', 'label' => 'Поставленное оборудование', 'name' => 'equipment', 'type' => 'textarea'),
                    array('key' => 'field_projects_slide_result', 'label' => 'Результат', 'name' => 'result', 'type' => 'textarea'),
                    array('key' => 'field_projects_slide_image', 'label' => 'Изображение', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
                ),
            ),

            // Partners
            array(
                'key' => 'tab_partners',
                'label' => 'Партнёры',
                'name' => 'tab_partners',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_partners_title',
                'label' => 'Заголовок',
                'name' => 'partners_title',
                'type' => 'text',
                'default_value' => 'Работаем с ведущими производителями',
            ),
            array(
                'key' => 'field_partners',
                'label' => 'Партнёры',
                'name' => 'partners',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'block',
                'button_label' => 'Добавить партнёра',
                'sub_fields' => array(
                    array(
                        'key' => 'field_partner_logo',
                        'label' => 'Логотип',
                        'name' => 'logo',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_partner_name',
                        'label' => 'Название',
                        'name' => 'name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_partner_desc',
                        'label' => 'Описание',
                        'name' => 'desc',
                        'type' => 'textarea',
                    ),
                ),
            ),

            // FAQ
            array(
                'key' => 'tab_faq',
                'label' => 'Вопросы и ответы',
                'name' => 'tab_faq',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_faq_title',
                'label' => 'Заголовок',
                'name' => 'faq_title',
                'type' => 'text',
                'default_value' => 'Часто задаваемые вопросы',
            ),
            array(
                'key' => 'field_faq_description',
                'label' => 'Описание справа от заголовка',
                'name' => 'faq_description',
                'type' => 'textarea',
                'rows' => 2,
                'default_value' => 'Ответы на популярные вопросы о дезинфекции, подборе оборудования и организации инфекционного контроля',
            ),
            array(
                'key' => 'field_faq_items',
                'label' => 'Вопросы и ответы',
                'name' => 'faq_items',
                'type' => 'repeater',
                'instructions' => 'На компьютере автоматически раскрывается первый вопрос с ответом, на телефоне все вопросы свернуты — независимо от флага «Открыт по умолчанию».',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Добавить вопрос',
                'sub_fields' => array(
                    array(
                        'key' => 'field_faq_question',
                        'label' => 'Вопрос',
                        'name' => 'question',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_faq_answer',
                        'label' => 'Ответ',
                        'name' => 'answer',
                        'type' => 'textarea',
                    ),
                    array(
                        'key' => 'field_faq_open',
                        'label' => 'Открыт по умолчанию',
                        'name' => 'is_open',
                        'type' => 'true_false',
                        'default_value' => 0,
                    ),
                ),
            ),

            // Application
            array(
                'key' => 'tab_application',
                'label' => 'Форма заявки',
                'name' => 'tab_application',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_application_title',
                'label' => 'Заголовок формы',
                'name' => 'application_title',
                'type' => 'text',
                'default_value' => 'Подберём решение для вашего учреждения',
            ),
            array(
                'key' => 'field_application_desc',
                'label' => 'Описание формы',
                'name' => 'application_desc',
                'type' => 'textarea',
                'default_value' => 'Оставьте заявку, и специалист поможет подобрать оборудование, дезинфицирующие средства и расходные материалы под ваши задачи.',
            ),
            array('key' => 'field_application_button_text', 'label' => 'Текст кнопки', 'name' => 'application_button_text', 'type' => 'text', 'default_value' => 'Получить консультацию'),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-disinfection.php',
                ),
            ),
        ),
        'hide_on_screen' => array('the_content', 'featured_image'),
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_laboratory_page',
        'title' => 'Страница Лаборатория',
        'fields' => array(
            // Hero
            array(
                'key' => 'tab_lab_hero',
                'label' => 'Первый экран',
                'name' => 'tab_lab_hero',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_lab_hero_title',
                'label' => 'Заголовок Hero',
                'name' => 'lab_hero_title',
                'type' => 'text',
                'default_value' => 'Оснащение лабораторий под ключ в Чите и Забайкальском крае',
            ),
            array(
                'key' => 'field_lab_hero_desc',
                'label' => 'Описание Hero',
                'name' => 'lab_hero_desc',
                'type' => 'textarea',
                'default_value' => 'Подбираем и поставляем лабораторное оборудование для медицинских, клинико-диагностических, исследовательских и производственных лабораторий.',
            ),
            array(
                'key' => 'field_lab_hero_image',
                'label' => 'Изображение Hero',
                'name' => 'lab_hero_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_lab_hero_button_text',
                'label' => 'Текст кнопки Hero',
                'name' => 'lab_hero_button_text',
                'type' => 'text',
                'default_value' => 'Получить консультацию',
            ),
            array(
                'key' => 'field_lab_hero_bottom_button_text',
                'label' => 'Текст нижней кнопки Hero',
                'name' => 'lab_hero_bottom_button_text',
                'type' => 'text',
                'default_value' => 'Подобрать оборудование',
            ),
            array(
                'key' => 'field_lab_hero_features',
                'label' => 'Преимущества Hero',
                'name' => 'lab_hero_features',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'table',
                'button_label' => 'Добавить преимущество',
                'sub_fields' => array(
                    array(
                        'key' => 'field_lab_hero_feature_icon',
                        'label' => 'Иконка',
                        'name' => 'icon',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'thumbnail',
                    ),
                    array(
                        'key' => 'field_lab_hero_feature_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                        'default_value' => 'Преимущество',
                    ),
                ),
            ),
            array(
                'key' => 'field_lab_hero_badges',
                'label' => 'Бейджи Hero',
                'name' => 'lab_hero_badges',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'table',
                'button_label' => 'Добавить бейдж',
                'sub_fields' => array(
                    array(
                        'key' => 'field_lab_hero_badge_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                        'default_value' => 'Бейдж',
                    ),
                ),
            ),

            // Audience
            array(
                'key' => 'tab_lab_audience',
                'label' => 'Для кого мы работаем',
                'name' => 'tab_lab_audience',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_lab_audience_subtitle',
                'label' => 'Подзаголовок',
                'name' => 'lab_audience_subtitle',
                'type' => 'text',
                'default_value' => 'Для кого мы работаем',
            ),
            array(
                'key' => 'field_lab_audience_title',
                'label' => 'Заголовок',
                'name' => 'lab_audience_title',
                'type' => 'text',
                'default_value' => 'Решения для разных типов лабораторий',
            ),
            array(
                'key' => 'field_lab_audience_cards',
                'label' => 'Карточки аудиторий',
                'name' => 'lab_audience_cards',
                'type' => 'repeater',
                'min' => 0,
                'max' => 12,
                'layout' => 'block',
                'button_label' => 'Добавить карточку',
                'sub_fields' => array(
                    array(
                        'key' => 'field_lab_audience_card_title',
                        'label' => 'Название',
                        'name' => 'title',
                        'type' => 'text',
                        'default_value' => 'Лаборатория',
                    ),
                    array(
                        'key' => 'field_lab_audience_card_image',
                        'label' => 'Фоновое изображение',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_lab_audience_card_style',
                        'label' => 'Стиль',
                        'name' => 'style',
                        'type' => 'select',
                        'choices' => array(
                            'default' => 'По умолчанию',
                            'gray' => 'Серая',
                            'green' => 'Зелёная',
                            'image' => 'С изображением',
                            'image-overlay' => 'С изображением + затемнение',
                        ),
                        'default_value' => 'default',
                    ),
                ),
            ),

            // Supplies
            array(
                'key' => 'tab_lab_supplies',
                'label' => 'Что мы поставляем',
                'name' => 'tab_lab_supplies',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_lab_supplies_subtitle',
                'label' => 'Подзаголовок',
                'name' => 'lab_supplies_subtitle',
                'type' => 'text',
                'default_value' => 'Комплексное оснащение лабораторий',
            ),
            array(
                'key' => 'field_lab_supplies_title',
                'label' => 'Заголовок',
                'name' => 'lab_supplies_title',
                'type' => 'text',
                'default_value' => 'Подберём оборудование под задачи вашей лаборатории',
            ),
            array(
                'key' => 'field_lab_supplies_items',
                'label' => 'Позиции поставок',
                'name' => 'lab_supplies_items',
                'type' => 'repeater',
                'instructions' => 'Пункты выводятся на круговой диаграмме в фиксированном порядке макета.',
                'min' => 0,
                'max' => 15,
                'layout' => 'table',
                'button_label' => 'Добавить позицию',
                'sub_fields' => array(
                    array(
                        'key' => 'field_lab_supplies_item_text',
                        'label' => 'Название',
                        'name' => 'text',
                        'type' => 'text',
                        'default_value' => 'Оборудование',
                    ),
                ),
            ),
            array(
                'key' => 'field_lab_supplies_center_image',
                'label' => 'Центральное изображение',
                'name' => 'lab_supplies_center_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),

            // Included
            array(
                'key' => 'tab_lab_included',
                'label' => 'Что входит',
                'name' => 'tab_lab_included',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_lab_included_title',
                'label' => 'Заголовок',
                'name' => 'lab_included_title',
                'type' => 'text',
                'default_value' => 'Берём на себя весь процесс оснащения',
            ),
            array(
                'key' => 'field_lab_included_cards',
                'label' => 'Карточки "Что входит"',
                'name' => 'lab_included_cards',
                'type' => 'repeater',
                'min' => 0,
                'max' => 10,
                'layout' => 'block',
                'button_label' => 'Добавить карточку',
                'sub_fields' => array(
                    array(
                        'key' => 'field_lab_included_card_image',
                        'label' => 'Изображение',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_lab_included_card_number',
                        'label' => 'Номер',
                        'name' => 'number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_lab_included_card_title',
                        'label' => 'Заголовок',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_lab_included_result_text',
                'label' => 'Текст итоговой карточки',
                'name' => 'lab_included_result_text',
                'type' => 'textarea',
                'default_value' => 'Мы поставляем не отдельные позиции из каталога, а формируем полноценное решение, которое помогает лаборатории работать эффективно и соответствовать современным требованиям',
            ),

            // Why choose
            array(
                'key' => 'tab_lab_why',
                'label' => 'Почему выбирают',
                'name' => 'tab_lab_why',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_lab_why_title',
                'label' => 'Заголовок',
                'name' => 'lab_why_title',
                'type' => 'text',
                'default_value' => 'Почему выбирают ТриМед',
            ),
            array(
                'key' => 'field_lab_why_subtitle',
                'label' => 'Подзаголовок',
                'name' => 'lab_why_subtitle',
                'type' => 'text',
                'default_value' => 'Надежный партнер для лабораторий региона',
            ),
            array(
                'key' => 'field_lab_why_stats',
                'label' => 'Статистика',
                'name' => 'lab_why_stats',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'table',
                'button_label' => 'Добавить показатель',
                'sub_fields' => array(
                    array(
                        'key' => 'field_lab_why_stat_number',
                        'label' => 'Число',
                        'name' => 'number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_lab_why_stat_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_lab_why_stat_style',
                        'label' => 'Стиль',
                        'name' => 'style',
                        'type' => 'select',
                        'choices' => array(
                            'gray' => 'Серый',
                            'green' => 'Зелёный',
                            'image' => 'С изображением',
                        ),
                        'default_value' => 'gray',
                    ),
                ),
            ),
            array(
                'key' => 'field_lab_why_features',
                'label' => 'Преимущества',
                'name' => 'lab_why_features',
                'type' => 'repeater',
                'min' => 0,
                'max' => 8,
                'layout' => 'table',
                'button_label' => 'Добавить преимущество',
                'sub_fields' => array(
                    array(
                        'key' => 'field_lab_why_feature_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                        'default_value' => 'Преимущество',
                    ),
                ),
            ),
            array(
                'key' => 'field_lab_why_warehouse_title',
                'label' => 'Заголовок склада',
                'name' => 'lab_why_warehouse_title',
                'type' => 'text',
                'default_value' => 'Собственный склад в Чите',
            ),
            array(
                'key' => 'field_lab_why_warehouse_image',
                'label' => 'Изображение склада',
                'name' => 'lab_why_warehouse_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),

            // Projects
            array(
                'key' => 'tab_lab_projects',
                'label' => 'Реализованные проекты',
                'name' => 'tab_lab_projects',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_lab_projects_title',
                'label' => 'Заголовок',
                'name' => 'lab_projects_title',
                'type' => 'text',
                'default_value' => 'Реализованные проекты',
            ),
            array(
                'key' => 'field_lab_projects_subtitle',
                'label' => 'Описание',
                'name' => 'lab_projects_subtitle',
                'type' => 'textarea',
                'default_value' => 'За время работы мы реализовали проекты по оснащению медицинских кабинетов и центров в Забайкальском крае. Мы понимаем специфику региона, требования врачей и реальные условия работы.',
            ),
            array(
                'key' => 'field_lab_projects',
                'label' => 'Проекты',
                'name' => 'lab_projects',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'block',
                'button_label' => 'Добавить проект',
                'sub_fields' => array(
                    array(
                        'key' => 'field_lab_project_image',
                        'label' => 'Изображение',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_lab_project_number',
                        'label' => 'Номер',
                        'name' => 'number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_lab_project_title',
                        'label' => 'Название',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_lab_project_delivered',
                        'label' => 'Что было поставлено',
                        'name' => 'delivered',
                        'type' => 'textarea',
                    ),
                    array(
                        'key' => 'field_lab_project_result',
                        'label' => 'Результат',
                        'name' => 'result',
                        'type' => 'textarea',
                    ),
                ),
            ),

            // Tasks
            array(
                'key' => 'tab_lab_tasks',
                'label' => 'Задачи клиентов',
                'name' => 'tab_lab_tasks',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_lab_tasks_title',
                'label' => 'Заголовок',
                'name' => 'lab_tasks_title',
                'type' => 'text',
                'default_value' => 'С чем к нам обращаются чаще всего',
            ),
            array(
                'key' => 'field_lab_tasks_subtitle',
                'label' => 'Подзаголовок',
                'name' => 'lab_tasks_subtitle',
                'type' => 'text',
                'default_value' => 'Популярные задачи клиентов',
            ),
            array(
                'key' => 'field_lab_tasks_list',
                'label' => 'Список задач',
                'name' => 'lab_tasks_list',
                'type' => 'repeater',
                'min' => 0,
                'max' => 10,
                'layout' => 'table',
                'button_label' => 'Добавить задачу',
                'sub_fields' => array(
                    array(
                        'key' => 'field_lab_task_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                        'default_value' => 'Задача',
                    ),
                ),
            ),

            // Partners
            array(
                'key' => 'tab_lab_partners',
                'label' => 'Партнёры',
                'name' => 'tab_lab_partners',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_lab_partners_title',
                'label' => 'Заголовок',
                'name' => 'lab_partners_title',
                'type' => 'text',
                'default_value' => 'Работаем с ведущими производителями',
            ),
            array(
                'key' => 'field_lab_partners',
                'label' => 'Партнёры',
                'name' => 'lab_partners',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'block',
                'button_label' => 'Добавить партнёра',
                'sub_fields' => array(
                    array(
                        'key' => 'field_lab_partner_image',
                        'label' => 'Изображение',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_lab_partner_name',
                        'label' => 'Название',
                        'name' => 'name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_lab_partner_text',
                        'label' => 'Описание',
                        'name' => 'text',
                        'type' => 'textarea',
                    ),
                ),
            ),

            // Request
            array(
                'key' => 'tab_lab_request',
                'label' => 'Форма заявки',
                'name' => 'tab_lab_request',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_lab_request_title',
                'label' => 'Заголовок формы',
                'name' => 'lab_request_title',
                'type' => 'text',
                'default_value' => 'Подберём решение для вашего учреждения',
            ),
            array(
                'key' => 'field_lab_request_desc',
                'label' => 'Описание формы',
                'name' => 'lab_request_desc',
                'type' => 'textarea',
                'default_value' => 'Оставьте заявку, и специалист поможет подобрать оборудование, дезинфицирующие средства и расходные материалы под ваши задачи.',
            ),
            array(
                'key' => 'field_lab_request_button_text',
                'label' => 'Текст кнопки формы',
                'name' => 'lab_request_button_text',
                'type' => 'text',
                'default_value' => 'Отправить',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-laboratory.php',
                ),
            ),
        ),
        'hide_on_screen' => array('the_content', 'featured_image'),
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_stomatology_page',
        'title' => 'Страница Стоматология',
        'fields' => array(
            // Hero
            array(
                'key' => 'tab_stom_hero',
                'label' => 'Первый экран',
                'name' => 'tab_stom_hero',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_stom_hero_title',
                'label' => 'Заголовок Hero',
                'name' => 'stom_hero_title',
                'type' => 'text',
                'default_value' => 'Оснащение стоматологии под ключ в Забайкальском крае',
            ),
            array(
                'key' => 'field_stom_hero_desc',
                'label' => 'Описание Hero',
                'name' => 'stom_hero_desc',
                'type' => 'textarea',
                'default_value' => 'Подберём оборудование, поставим и поможем запустить кабинет без лишних затрат и ошибок',
            ),
            array(
                'key' => 'field_stom_hero_button_text',
                'label' => 'Текст кнопки Hero',
                'name' => 'stom_hero_button_text',
                'type' => 'text',
                'default_value' => 'Получить консультацию',
            ),
            array(
                'key' => 'field_stom_hero_image',
                'label' => 'Изображение Hero',
                'name' => 'stom_hero_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_stom_hero_feature_image',
                'label' => 'Изображение преимуществ Hero',
                'name' => 'stom_hero_feature_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_stom_hero_features',
                'label' => 'Преимущества Hero',
                'name' => 'stom_hero_features',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'table',
                'button_label' => 'Добавить преимущество',
                'sub_fields' => array(
                    array(
                        'key' => 'field_stom_hero_feature_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_stom_hero_badge_glass_text',
                'label' => 'Текст стеклянного бейджа',
                'name' => 'stom_hero_badge_glass_text',
                'type' => 'text',
                'default_value' => 'Работаем с частными и государственными клиниками',
            ),
            array(
                'key' => 'field_stom_hero_badge_green_num',
                'label' => 'Число зелёного бейджа',
                'name' => 'stom_hero_badge_green_num',
                'type' => 'text',
                'default_value' => '5000+',
            ),
            array(
                'key' => 'field_stom_hero_badge_green_text',
                'label' => 'Текст зелёного бейджа',
                'name' => 'stom_hero_badge_green_text',
                'type' => 'text',
                'default_value' => 'позиций в наличии',
            ),

            // Audience
            array(
                'key' => 'tab_stom_audience',
                'label' => 'Кому подходит',
                'name' => 'tab_stom_audience',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_stom_audience_label',
                'label' => 'Подпись',
                'name' => 'stom_audience_label',
                'type' => 'text',
                'default_value' => 'Кому подходит',
            ),
            array(
                'key' => 'field_stom_audience_title',
                'label' => 'Заголовок',
                'name' => 'stom_audience_title',
                'type' => 'text',
                'default_value' => 'Работаем со стоматологиями на разных этапах',
            ),
            array(
                'key' => 'field_stom_audience_desc',
                'label' => 'Описание',
                'name' => 'stom_audience_desc',
                'type' => 'textarea',
                'default_value' => 'Мы понимаем, что задачи у всех разные: кто-то открывается с нуля, кто-то расширяется, а кто-то просто хочет обновить оборудование.',
            ),
            array(
                'key' => 'field_stom_audience_lead',
                'label' => 'Вводный текст',
                'name' => 'stom_audience_lead',
                'type' => 'text',
                'default_value' => 'Мы будем полезны, если вы:',
            ),
            array(
                'key' => 'field_stom_audience_cards',
                'label' => 'Карточки аудиторий',
                'name' => 'stom_audience_cards',
                'type' => 'repeater',
                'min' => 0,
                'max' => 8,
                'layout' => 'block',
                'button_label' => 'Добавить карточку',
                'sub_fields' => array(
                    array(
                        'key' => 'field_stom_audience_card_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_stom_audience_card_image',
                        'label' => 'Фоновое изображение',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_stom_audience_card_style',
                        'label' => 'Стиль',
                        'name' => 'style',
                        'type' => 'select',
                        'choices' => array(
                            'default' => 'По умолчанию',
                            'white' => 'Белая',
                            'gray' => 'Серая',
                            'green' => 'Зелёная',
                            'image' => 'С изображением',
                        ),
                        'default_value' => 'default',
                    ),
                ),
            ),
            array(
                'key' => 'field_stom_audience_summary',
                'label' => 'Итоговый текст',
                'name' => 'stom_audience_summary',
                'type' => 'textarea',
                'default_value' => 'Мы помогаем не просто купить оборудование, а сделать так, чтобы кабинет начал работать максимально эффективно за короткие сроки.',
            ),

            // Included
            array(
                'key' => 'tab_stom_included',
                'label' => 'Что входит',
                'name' => 'tab_stom_included',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_stom_included_title',
                'label' => 'Заголовок',
                'name' => 'stom_included_title',
                'type' => 'text',
                'default_value' => 'Что входит в оснащение стоматологии',
            ),
            array(
                'key' => 'field_stom_included_label',
                'label' => 'Подпись',
                'name' => 'stom_included_label',
                'type' => 'text',
                'default_value' => 'Мы берём на себя весь процесс:',
            ),
            array(
                'key' => 'field_stom_included_desc',
                'label' => 'Описание',
                'name' => 'stom_included_desc',
                'type' => 'textarea',
                'default_value' => 'Оснащение стоматологического кабинета — это не только установка кресла. Важно учесть всё: от компрессоров до удобства работы врача.',
            ),
            array(
                'key' => 'field_stom_included_cards',
                'label' => 'Карточки «Что входит»',
                'name' => 'stom_included_cards',
                'type' => 'repeater',
                'min' => 0,
                'max' => 10,
                'layout' => 'block',
                'button_label' => 'Добавить карточку',
                'sub_fields' => array(
                    array(
                        'key' => 'field_stom_included_card_image',
                        'label' => 'Изображение',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_stom_included_card_number',
                        'label' => 'Номер',
                        'name' => 'number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_stom_included_card_title',
                        'label' => 'Заголовок',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_stom_included_result_text',
                'label' => 'Текст итоговой карточки',
                'name' => 'stom_included_result_text',
                'type' => 'textarea',
                'default_value' => 'В результате вы получаете полностью готовый к работе кабинет в одном месте',
            ),

            // Projects
            array(
                'key' => 'tab_stom_projects',
                'label' => 'Реализованные проекты',
                'name' => 'tab_stom_projects',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_stom_projects_title',
                'label' => 'Заголовок',
                'name' => 'stom_projects_title',
                'type' => 'text',
                'default_value' => 'Реализованные проекты',
            ),
            array(
                'key' => 'field_stom_projects_desc',
                'label' => 'Описание',
                'name' => 'stom_projects_desc',
                'type' => 'textarea',
                'default_value' => 'Мы уже помогли оснастить стоматологические кабинеты в Забайкальском крае, как частные, так и государственные. Понимаем, какие решения подходят для региона и какие задачи стоят перед врачами.',
            ),
            array(
                'key' => 'field_stom_projects',
                'label' => 'Проекты',
                'name' => 'stom_projects',
                'type' => 'repeater',
                'min' => 0,
                'max' => 8,
                'layout' => 'block',
                'button_label' => 'Добавить проект',
                'sub_fields' => array(
                    array(
                        'key' => 'field_stom_project_image',
                        'label' => 'Изображение',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_stom_project_number',
                        'label' => 'Номер',
                        'name' => 'number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_stom_project_title',
                        'label' => 'Название',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_stom_project_text',
                        'label' => 'Описание',
                        'name' => 'text',
                        'type' => 'textarea',
                    ),
                ),
            ),

            // How we work
            array(
                'key' => 'tab_stom_process',
                'label' => 'Как проходит работа',
                'name' => 'tab_stom_process',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_stom_process_title',
                'label' => 'Заголовок',
                'name' => 'stom_process_title',
                'type' => 'text',
                'default_value' => 'Как проходит работа',
            ),
            array(
                'key' => 'field_stom_process_subtitle',
                'label' => 'Подзаголовок',
                'name' => 'stom_process_subtitle',
                'type' => 'textarea',
                'default_value' => 'Мы выстроили простой и понятный процесс, чтобы вы не тратили время на разбор оборудования.',
            ),
            array(
                'key' => 'field_stom_process_steps',
                'label' => 'Этапы работы',
                'name' => 'stom_process_steps',
                'type' => 'repeater',
                'min' => 0,
                'max' => 8,
                'layout' => 'block',
                'button_label' => 'Добавить этап',
                'sub_fields' => array(
                    array(
                        'key' => 'field_stom_process_step_number',
                        'label' => 'Номер',
                        'name' => 'number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_stom_process_step_title',
                        'label' => 'Заголовок',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_stom_process_step_text',
                        'label' => 'Описание',
                        'name' => 'text',
                        'type' => 'textarea',
                    ),
                    array(
                        'key' => 'field_stom_process_step_image',
                        'label' => 'Изображение (опционально)',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                    ),
                ),
            ),
            array(
                'key' => 'field_stom_process_image',
                'label' => 'Большое изображение рядом с этапами',
                'name' => 'stom_process_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),

            // Request
            array(
                'key' => 'tab_stom_request',
                'label' => 'Форма заявки',
                'name' => 'tab_stom_request',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_stom_request_title',
                'label' => 'Заголовок формы',
                'name' => 'stom_request_title',
                'type' => 'text',
                'default_value' => 'Подберём оборудование под вашу стоматологию',
            ),
            array(
                'key' => 'field_stom_request_desc',
                'label' => 'Описание формы',
                'name' => 'stom_request_desc',
                'type' => 'textarea',
                'default_value' => 'Оставьте заявку — свяжемся с вами и предложим решение',
            ),
            array(
                'key' => 'field_stom_request_note',
                'label' => 'Примечание',
                'name' => 'stom_request_note',
                'type' => 'text',
                'default_value' => 'Консультация бесплатная',
            ),
            array(
                'key' => 'field_stom_request_button_text',
                'label' => 'Текст кнопки формы',
                'name' => 'stom_request_button_text',
                'type' => 'text',
                'default_value' => 'Получить консультацию',
            ),

            // Why choose
            array(
                'key' => 'tab_stom_why',
                'label' => 'Почему выбирают',
                'name' => 'tab_stom_why',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_stom_why_title',
                'label' => 'Заголовок',
                'name' => 'stom_why_title',
                'type' => 'text',
                'default_value' => 'Почему выбирают ТриМед',
            ),
            array(
                'key' => 'field_stom_why_stats',
                'label' => 'Статистика',
                'name' => 'stom_why_stats',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'table',
                'button_label' => 'Добавить показатель',
                'sub_fields' => array(
                    array(
                        'key' => 'field_stom_why_stat_number',
                        'label' => 'Число',
                        'name' => 'number',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_stom_why_stat_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_stom_why_stat_style',
                        'label' => 'Стиль',
                        'name' => 'style',
                        'type' => 'select',
                        'choices' => array(
                            'image' => 'С изображением',
                            'gray' => 'Серый',
                            'green' => 'Зелёный',
                        ),
                        'default_value' => 'gray',
                    ),
                ),
            ),
            array(
                'key' => 'field_stom_why_features',
                'label' => 'Преимущества',
                'name' => 'stom_why_features',
                'type' => 'repeater',
                'min' => 0,
                'max' => 8,
                'layout' => 'table',
                'button_label' => 'Добавить преимущество',
                'sub_fields' => array(
                    array(
                        'key' => 'field_stom_why_feature_text',
                        'label' => 'Текст',
                        'name' => 'text',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_stom_why_warehouse_title',
                'label' => 'Заголовок склада',
                'name' => 'stom_why_warehouse_title',
                'type' => 'text',
                'default_value' => 'Собственный склад в Чите',
            ),
            array(
                'key' => 'field_stom_why_warehouse_image',
                'label' => 'Изображение склада',
                'name' => 'stom_why_warehouse_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),

            // CTA
            array(
                'key' => 'tab_stom_cta',
                'label' => 'Призыв к действию',
                'name' => 'tab_stom_cta',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array(
                'key' => 'field_stom_cta_text',
                'label' => 'Текст CTA',
                'name' => 'stom_cta_text',
                'type' => 'textarea',
                'default_value' => 'Если вы планируете открыть стоматологию или обновить оборудование — мы поможем подобрать решения под вашу задачу и бюджет',
            ),
            array(
                'key' => 'field_stom_cta_button_text',
                'label' => 'Текст кнопки CTA',
                'name' => 'stom_cta_button_text',
                'type' => 'text',
                'default_value' => 'Получить консультацию',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-stomatology.php',
                ),
            ),
        ),
        'hide_on_screen' => array('the_content', 'featured_image'),
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));
}
