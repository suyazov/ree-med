<?php
if (!defined('ABSPATH')) exit;

if (function_exists('acf_add_local_field_group')) {
    $medcentry_page = get_page_by_path('medcentry');
    $medcentry_location = array(
        array(
            array(
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'page-medcentry.php',
            ),
        ),
    );

    if ($medcentry_page instanceof WP_Post) {
        $medcentry_location[] = array(
            array(
                'param' => 'page',
                'operator' => '==',
                'value' => (string) $medcentry_page->ID,
            ),
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_medcentry_page',
        'title' => 'Страница Медцентры',
        'fields' => array(
            // Hero
            array(
                'key' => 'tab_med_hero',
                'label' => 'Hero',
                'name' => 'tab_med_hero',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array('key' => 'field_med_hero_title', 'label' => 'Заголовок Hero', 'name' => 'med_hero_title', 'type' => 'text', 'default_value' => 'Оснащение <span class="text-green">медицинских центров под ключ</span><br>в Забайкальском крае'),
            array('key' => 'field_med_hero_desc', 'label' => 'Описание Hero', 'name' => 'med_hero_desc', 'type' => 'textarea', 'default_value' => 'Помогаем клиникам запускаться, развиваться и работать на современном оборудовании от подбора до поставки'),
            array('key' => 'field_med_hero_button_text', 'label' => 'Текст кнопки Hero', 'name' => 'med_hero_button_text', 'type' => 'text', 'default_value' => 'Получить консультацию'),
            array('key' => 'field_med_hero_image', 'label' => 'Изображение Hero', 'name' => 'med_hero_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
            array('key' => 'field_med_hero_feature_bg', 'label' => 'Фон feature-карточки', 'name' => 'med_hero_feature_bg', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
            array('key' => 'field_med_hero_feature_text', 'label' => 'Текст feature-карточки', 'name' => 'med_hero_feature_text', 'type' => 'text', 'default_value' => 'Склад в Чите — быстрая поставка'),
            array('key' => 'field_med_hero_warehouse', 'label' => 'Иллюстрация склада', 'name' => 'med_hero_warehouse', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
            array('key' => 'field_med_hero_badge_glass_text', 'label' => 'Текст стеклянного бейджа', 'name' => 'med_hero_badge_glass_text', 'type' => 'text', 'default_value' => 'Работаем с клиниками по всему Забайкальскому краю'),
            array('key' => 'field_med_hero_badge_green_num', 'label' => 'Число зелёного бейджа', 'name' => 'med_hero_badge_green_num', 'type' => 'text', 'default_value' => '5000+'),
            array('key' => 'field_med_hero_badge_green_text', 'label' => 'Текст зелёного бейджа', 'name' => 'med_hero_badge_green_text', 'type' => 'text', 'default_value' => 'позиций оборудования в наличии'),

            // Audience
            array(
                'key' => 'tab_med_audience',
                'label' => 'Кому подходит',
                'name' => 'tab_med_audience',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array('key' => 'field_med_audience_label', 'label' => 'Подпись', 'name' => 'med_audience_label', 'type' => 'text', 'default_value' => 'Кому подходит'),
            array('key' => 'field_med_audience_title', 'label' => 'Заголовок', 'name' => 'med_audience_title', 'type' => 'text', 'default_value' => 'Работаем с медицинскими центрами на разных этапах'),
            array('key' => 'field_med_audience_desc', 'label' => 'Описание', 'name' => 'med_audience_desc', 'type' => 'textarea', 'default_value' => 'Мы понимаем, что у каждой клиники своя задача, поэтому подходим к оснащению индивидуально'),
            array('key' => 'field_med_audience_lead', 'label' => 'Вводный текст', 'name' => 'med_audience_lead', 'type' => 'text', 'default_value' => 'Мы поможем, если вы:'),
            array('key' => 'field_med_audience_summary', 'label' => 'Итоговый текст', 'name' => 'med_audience_summary', 'type' => 'textarea', 'default_value' => 'Мы создаём продуманное оснащение, которое помогает клинике работать <em>уверенно</em> каждый день.'),
            array(
                'key' => 'field_med_audience_cards',
                'label' => 'Карточки аудиторий',
                'name' => 'med_audience_cards',
                'type' => 'repeater',
                'min' => 0,
                'max' => 8,
                'layout' => 'block',
                'button_label' => 'Добавить карточку',
                'sub_fields' => array(
                    array('key' => 'field_med_audience_card_text', 'label' => 'Текст', 'name' => 'text', 'type' => 'text'),
                    array('key' => 'field_med_audience_card_image', 'label' => 'Изображение', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
                    array(
                        'key' => 'field_med_audience_card_style',
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

            // Included
            array(
                'key' => 'tab_med_included',
                'label' => 'Что входит',
                'name' => 'tab_med_included',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array('key' => 'field_med_included_subtitle', 'label' => 'Подпись', 'name' => 'med_included_subtitle', 'type' => 'text', 'default_value' => 'Что входит'),
            array('key' => 'field_med_included_title', 'label' => 'Заголовок', 'name' => 'med_included_title', 'type' => 'text', 'default_value' => '<span class="text-green">Комплексное</span> оснащение клиники'),
            array('key' => 'field_med_included_label', 'label' => 'Подзаголовок', 'name' => 'med_included_label', 'type' => 'text', 'default_value' => 'Мы берём на себя весь процесс:'),
            array('key' => 'field_med_included_desc', 'label' => 'Описание', 'name' => 'med_included_desc', 'type' => 'textarea', 'default_value' => 'Оснащение медицинского центра — это не просто закупка оборудования. Важно подобрать решения, которые будут соответствовать профилю клиники, нагрузке и бюджету.'),
            array('key' => 'field_med_included_result_text', 'label' => 'Текст итоговой карточки', 'name' => 'med_included_result_text', 'type' => 'textarea', 'default_value' => 'В результате, вы получаете не просто оборудование, а продуманную систему для стабильной и комфортной работы клиники'),
            array(
                'key' => 'field_med_included_cards',
                'label' => 'Карточки «Что входит»',
                'name' => 'med_included_cards',
                'type' => 'repeater',
                'min' => 0,
                'max' => 10,
                'layout' => 'block',
                'button_label' => 'Добавить карточку',
                'sub_fields' => array(
                    array('key' => 'field_med_included_card_image', 'label' => 'Изображение', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
                    array('key' => 'field_med_included_card_number', 'label' => 'Номер', 'name' => 'number', 'type' => 'text'),
                    array('key' => 'field_med_included_card_title', 'label' => 'Заголовок', 'name' => 'title', 'type' => 'text'),
                ),
            ),

            // Projects
            array(
                'key' => 'tab_med_projects',
                'label' => 'Проекты',
                'name' => 'tab_med_projects',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array('key' => 'field_med_projects_title', 'label' => 'Заголовок', 'name' => 'med_projects_title', 'type' => 'text', 'default_value' => '<span class="text-green">Реализованные</span> проекты'),
            array('key' => 'field_med_projects_desc', 'label' => 'Описание', 'name' => 'med_projects_desc', 'type' => 'textarea', 'default_value' => 'За время работы мы реализовали проекты по оснащению медицинских кабинетов и центров в Забайкальском крае. Мы понимаем специфику региона, требования врачей и реальные условия работы.'),
            array('key' => 'field_med_projects_desc_mobile', 'label' => 'Описание на мобильных', 'name' => 'med_projects_desc_mobile', 'type' => 'textarea', 'default_value' => 'За время работы мы реализовали проекты по оснащению медицинских кабинетов и центров в Забайкальском крае.'),
            array(
                'key' => 'field_med_projects',
                'label' => 'Проекты',
                'name' => 'med_projects',
                'type' => 'repeater',
                'min' => 0,
                'max' => 8,
                'layout' => 'block',
                'button_label' => 'Добавить проект',
                'sub_fields' => array(
                    array('key' => 'field_med_project_image', 'label' => 'Изображение', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
                    array('key' => 'field_med_project_number', 'label' => 'Номер', 'name' => 'number', 'type' => 'text'),
                    array('key' => 'field_med_project_title', 'label' => 'Название', 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_med_project_text', 'label' => 'Описание', 'name' => 'text', 'type' => 'textarea'),
                ),
            ),

            // Process
            array(
                'key' => 'tab_med_process',
                'label' => 'Как мы работаем',
                'name' => 'tab_med_process',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array('key' => 'field_med_process_title', 'label' => 'Заголовок', 'name' => 'med_process_title', 'type' => 'text', 'default_value' => 'Как <span class="text-green">мы работаем</span>'),
            array('key' => 'field_med_process_subtitle', 'label' => 'Описание', 'name' => 'med_process_subtitle', 'type' => 'textarea', 'default_value' => 'Мы выстроили понятный и прозрачный процесс работы, чтобы клиенту было комфортно на каждом этапе.'),
            array('key' => 'field_med_process_image', 'label' => 'Большое изображение', 'name' => 'med_process_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
            array(
                'key' => 'field_med_process_steps',
                'label' => 'Этапы работы',
                'name' => 'med_process_steps',
                'type' => 'repeater',
                'min' => 0,
                'max' => 8,
                'layout' => 'block',
                'button_label' => 'Добавить этап',
                'sub_fields' => array(
                    array('key' => 'field_med_process_step_number', 'label' => 'Номер', 'name' => 'number', 'type' => 'text'),
                    array('key' => 'field_med_process_step_title', 'label' => 'Заголовок', 'name' => 'title', 'type' => 'text'),
                    array('key' => 'field_med_process_step_text', 'label' => 'Описание', 'name' => 'text', 'type' => 'textarea'),
                ),
            ),

            // Request
            array(
                'key' => 'tab_med_request',
                'label' => 'Форма заявки',
                'name' => 'tab_med_request',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array('key' => 'field_med_request_title', 'label' => 'Заголовок формы', 'name' => 'med_request_title', 'type' => 'text', 'default_value' => 'Подберём оборудование под вашу клинику'),
            array('key' => 'field_med_request_desc', 'label' => 'Описание формы', 'name' => 'med_request_desc', 'type' => 'textarea', 'default_value' => 'Оставьте заявку — свяжемся с вами, разберём задачу и предложим решение'),
            array('key' => 'field_med_request_desc_mobile', 'label' => 'Описание формы на мобильных', 'name' => 'med_request_desc_mobile', 'type' => 'textarea', 'default_value' => 'Оставьте заявку, мы свяжемся с вами и предложим решение'),
            array('key' => 'field_med_request_note', 'label' => 'Примечание', 'name' => 'med_request_note', 'type' => 'text', 'default_value' => 'Консультация бесплатная'),
            array('key' => 'field_med_request_button_text', 'label' => 'Текст кнопки формы', 'name' => 'med_request_button_text', 'type' => 'text', 'default_value' => 'Отправить'),

            // Why
            array(
                'key' => 'tab_med_why',
                'label' => 'Почему выбирают',
                'name' => 'tab_med_why',
                'type' => 'tab',
                'placement' => 'left',
            ),
            array('key' => 'field_med_why_title', 'label' => 'Заголовок', 'name' => 'med_why_title', 'type' => 'text', 'default_value' => 'Почему выбирают <span class="text-green">ТриМед</span>'),
            array('key' => 'field_med_why_warehouse_title', 'label' => 'Заголовок склада', 'name' => 'med_why_warehouse_title', 'type' => 'text', 'default_value' => 'Собственный склад в Чите'),
            array('key' => 'field_med_why_cta_text', 'label' => 'Текст CTA', 'name' => 'med_why_cta_text', 'type' => 'textarea', 'default_value' => 'Нужна консультация по оборудованию?'),
            array('key' => 'field_med_why_cta_button_text', 'label' => 'Текст кнопки CTA', 'name' => 'med_why_cta_button_text', 'type' => 'text', 'default_value' => 'Оставить заявку'),
            array(
                'key' => 'field_med_why_stats',
                'label' => 'Статистика',
                'name' => 'med_why_stats',
                'type' => 'repeater',
                'min' => 0,
                'max' => 6,
                'layout' => 'table',
                'button_label' => 'Добавить показатель',
                'sub_fields' => array(
                    array('key' => 'field_med_why_stat_number', 'label' => 'Число', 'name' => 'number', 'type' => 'text'),
                    array('key' => 'field_med_why_stat_text', 'label' => 'Текст', 'name' => 'text', 'type' => 'text'),
                    array(
                        'key' => 'field_med_why_stat_style',
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
                'key' => 'field_med_why_features',
                'label' => 'Преимущества',
                'name' => 'med_why_features',
                'type' => 'repeater',
                'min' => 0,
                'max' => 8,
                'layout' => 'table',
                'button_label' => 'Добавить преимущество',
                'sub_fields' => array(
                    array('key' => 'field_med_why_feature_text', 'label' => 'Текст', 'name' => 'text', 'type' => 'text'),
                    array(
                        'key' => 'field_med_why_feature_icon',
                        'label' => 'Иконка',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => array(
                            'delivery' => 'Доставка',
                            'warehouse' => 'Склад',
                        ),
                        'default_value' => 'delivery',
                    ),
                ),
            ),
        ),
        'location' => $medcentry_location,
        'hide_on_screen' => array('the_content', 'featured_image'),
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
    ));
}
