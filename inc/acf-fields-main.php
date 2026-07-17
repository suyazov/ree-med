<?php
if (!defined('ABSPATH')) exit;

if (!function_exists('acf_add_local_field_group')) {
    return;
}

acf_add_local_field_group(array(
    'key' => 'group_main_page',
    'title' => 'Главная страница (AS2)',
    'fields' => array(
        // Hero
        array(
            'key' => 'tab_main_hero',
            'label' => 'Первый экран',
            'name' => 'tab_main_hero',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array('key' => 'field_main_hero_title', 'label' => 'Заголовок', 'name' => 'main_hero_title', 'type' => 'text', 'default_value' => 'Комплексное оснащение медицинских учреждений в Забайкальском крае'),
        array('key' => 'field_main_hero_desc', 'label' => 'Описание', 'name' => 'main_hero_desc', 'type' => 'textarea', 'default_value' => 'Подбираем оборудование, расходные материалы и готовые решения для клиник, лабораторий, стоматологий и медицинских центров.'),
        array('key' => 'field_main_hero_image', 'label' => 'Изображение', 'name' => 'main_hero_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
        array('key' => 'field_main_hero_btn1', 'label' => 'Кнопка «Получить консультацию»', 'name' => 'main_hero_btn1', 'type' => 'text', 'default_value' => 'Получить консультацию'),
        array('key' => 'field_main_hero_btn2', 'label' => 'Кнопка «В магазин»', 'name' => 'main_hero_btn2', 'type' => 'text', 'default_value' => 'В магазин'),
        array(
            'key' => 'field_main_hero_checks',
            'label' => 'Преимущества (список)',
            'name' => 'main_hero_checks',
            'type' => 'repeater',
            'min' => 0,
            'max' => 4,
            'layout' => 'table',
            'button_label' => 'Добавить пункт',
            'sub_fields' => array(
                array('key' => 'field_main_hero_check_text', 'label' => 'Текст', 'name' => 'text', 'type' => 'text'),
            ),
        ),
        array(
            'key' => 'field_main_hero_badges',
            'label' => 'Бейджи на изображении',
            'name' => 'main_hero_badges',
            'type' => 'repeater',
            'min' => 0,
            'max' => 3,
            'layout' => 'table',
            'button_label' => 'Добавить бейдж',
            'sub_fields' => array(
                array('key' => 'field_main_hero_badge_text', 'label' => 'Текст', 'name' => 'text', 'type' => 'text'),
                array('key' => 'field_main_hero_badge_sub', 'label' => 'Подпись', 'name' => 'sub', 'type' => 'text'),
                array('key' => 'field_main_hero_badge_light', 'label' => 'Светлый фон', 'name' => 'light', 'type' => 'true_false', 'default_value' => 0),
            ),
        ),

        // About
        array(
            'key' => 'tab_main_about',
            'label' => 'О компании',
            'name' => 'tab_main_about',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array('key' => 'field_main_about_title', 'label' => 'Заголовок', 'name' => 'main_about_title', 'type' => 'text', 'default_value' => 'ТриМед — поставщик медицинского оборудования и расходных материалов'),
        array('key' => 'field_main_about_desc', 'label' => 'Описание', 'name' => 'main_about_desc', 'type' => 'textarea', 'default_value' => 'Мы помогаем медицинским учреждениям оснащать кабинеты, отделения и клиники современным оборудованием.'),
        array('key' => 'field_main_about_text', 'label' => 'Дополнительный текст', 'name' => 'main_about_text', 'type' => 'textarea', 'default_value' => 'Берём на себя подбор решений, поставку, консультации и сопровождение проекта на всех этапах'),
        array('key' => 'field_main_about_image', 'label' => 'Изображение', 'name' => 'main_about_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
        array(
            'key' => 'field_main_about_stats',
            'label' => 'Цифры',
            'name' => 'main_about_stats',
            'type' => 'repeater',
            'min' => 0,
            'max' => 6,
            'layout' => 'table',
            'button_label' => 'Добавить цифру',
            'sub_fields' => array(
                array('key' => 'field_main_about_stat_num', 'label' => 'Число', 'name' => 'num', 'type' => 'text'),
                array('key' => 'field_main_about_stat_label', 'label' => 'Подпись', 'name' => 'label', 'type' => 'text'),
            ),
        ),

        // Directions
        array(
            'key' => 'tab_main_directions',
            'label' => 'Направления',
            'name' => 'tab_main_directions',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array('key' => 'field_main_directions_subtitle', 'label' => 'Подзаголовок', 'name' => 'main_directions_subtitle', 'type' => 'text', 'default_value' => 'Направления работы'),
        array('key' => 'field_main_directions_title', 'label' => 'Заголовок', 'name' => 'main_directions_title', 'type' => 'text', 'default_value' => 'Решения для разных направлений медицины'),
        array(
            'key' => 'field_main_directions',
            'label' => 'Карточки направлений',
            'name' => 'main_directions',
            'type' => 'repeater',
            'min' => 0,
            'max' => 6,
            'layout' => 'block',
            'button_label' => 'Добавить направление',
            'sub_fields' => array(
                array('key' => 'field_main_dir_title', 'label' => 'Название', 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_main_dir_image', 'label' => 'Изображение', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
                array('key' => 'field_main_dir_link', 'label' => 'Ссылка', 'name' => 'link', 'type' => 'url'),
                array('key' => 'field_main_dir_large', 'label' => 'Большая карточка', 'name' => 'large', 'type' => 'true_false', 'default_value' => 0),
            ),
        ),

        // Audience
        array(
            'key' => 'tab_main_audience',
            'label' => 'Кому помогаем',
            'name' => 'tab_main_audience',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array('key' => 'field_main_audience_subtitle', 'label' => 'Подзаголовок', 'name' => 'main_audience_subtitle', 'type' => 'text', 'default_value' => 'Кому мы помогаем'),
        array('key' => 'field_main_audience_title', 'label' => 'Заголовок', 'name' => 'main_audience_title', 'type' => 'text', 'default_value' => 'Работаем с медицинскими учреждениями любого масштаба'),
        array(
            'key' => 'field_main_audience_items',
            'label' => 'Пункты',
            'name' => 'main_audience_items',
            'type' => 'repeater',
            'min' => 0,
            'max' => 10,
            'layout' => 'table',
            'button_label' => 'Добавить пункт',
            'sub_fields' => array(
                array('key' => 'field_main_audience_item_icon', 'label' => 'Иконка', 'name' => 'icon', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'thumbnail'),
                array('key' => 'field_main_audience_item_text', 'label' => 'Текст', 'name' => 'text', 'type' => 'text'),
            ),
        ),

        // Tasks / services
        array(
            'key' => 'tab_main_tasks',
            'label' => 'Задачи клиники',
            'name' => 'tab_main_tasks',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array('key' => 'field_main_tasks_title', 'label' => 'Заголовок', 'name' => 'main_tasks_title', 'type' => 'text', 'default_value' => 'Не просто поставляем оборудование, а решаем задачи клиники'),
        array(
            'key' => 'field_main_tasks',
            'label' => 'Карточки',
            'name' => 'main_tasks',
            'type' => 'repeater',
            'min' => 0,
            'max' => 8,
            'layout' => 'block',
            'button_label' => 'Добавить карточку',
            'sub_fields' => array(
                array('key' => 'field_main_task_num', 'label' => 'Номер', 'name' => 'num', 'type' => 'text'),
                array('key' => 'field_main_task_title', 'label' => 'Заголовок', 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_main_task_image', 'label' => 'Изображение', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
                array('key' => 'field_main_task_link', 'label' => 'Ссылка', 'name' => 'link', 'type' => 'url'),
            ),
        ),

        // Projects
        array(
            'key' => 'tab_main_projects',
            'label' => 'Реализованные проекты',
            'name' => 'tab_main_projects',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array('key' => 'field_main_projects_title', 'label' => 'Заголовок', 'name' => 'main_projects_title', 'type' => 'text', 'default_value' => 'Реализованные проекты'),
        array('key' => 'field_main_projects_btn', 'label' => 'Кнопка', 'name' => 'main_projects_btn', 'type' => 'text', 'default_value' => 'Смотреть все проекты'),
        array(
            'key' => 'field_main_projects',
            'label' => 'Проекты',
            'name' => 'main_projects',
            'type' => 'repeater',
            'min' => 0,
            'max' => 8,
            'layout' => 'block',
            'button_label' => 'Добавить проект',
            'sub_fields' => array(
                array('key' => 'field_main_project_cat', 'label' => 'Категория', 'name' => 'cat', 'type' => 'text'),
                array('key' => 'field_main_project_title', 'label' => 'Название', 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_main_project_desc', 'label' => 'Описание', 'name' => 'desc', 'type' => 'textarea'),
                array('key' => 'field_main_project_image', 'label' => 'Изображение', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
                array('key' => 'field_main_project_link', 'label' => 'Ссылка', 'name' => 'link', 'type' => 'url'),
            ),
        ),

        // Categories
        array(
            'key' => 'tab_main_categories',
            'label' => 'Категории оборудования',
            'name' => 'tab_main_categories',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array('key' => 'field_main_categories_title', 'label' => 'Заголовок', 'name' => 'main_categories_title', 'type' => 'text', 'default_value' => 'Основные категории оборудования'),
        array(
            'key' => 'field_main_categories',
            'label' => 'Категории',
            'name' => 'main_categories',
            'type' => 'repeater',
            'min' => 0,
            'max' => 10,
            'layout' => 'block',
            'button_label' => 'Добавить категорию',
            'sub_fields' => array(
                array('key' => 'field_main_cat_num', 'label' => 'Номер', 'name' => 'num', 'type' => 'text'),
                array('key' => 'field_main_cat_title', 'label' => 'Название', 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_main_cat_image', 'label' => 'Изображение', 'name' => 'image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
                array('key' => 'field_main_cat_link', 'label' => 'Ссылка', 'name' => 'link', 'type' => 'url'),
            ),
        ),

        // Steps
        array(
            'key' => 'tab_main_steps',
            'label' => 'Этапы работы',
            'name' => 'tab_main_steps',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array('key' => 'field_main_steps_subtitle', 'label' => 'Подзаголовок', 'name' => 'main_steps_subtitle', 'type' => 'text', 'default_value' => 'Этапы работы'),
        array('key' => 'field_main_steps_title', 'label' => 'Заголовок', 'name' => 'main_steps_title', 'type' => 'text', 'default_value' => 'От запроса до поставки'),
        array('key' => 'field_main_steps_image', 'label' => 'Изображение', 'name' => 'main_steps_image', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
        array(
            'key' => 'field_main_steps',
            'label' => 'Этапы',
            'name' => 'main_steps',
            'type' => 'repeater',
            'min' => 0,
            'max' => 6,
            'layout' => 'table',
            'button_label' => 'Добавить этап',
            'sub_fields' => array(
                array('key' => 'field_main_step_num', 'label' => 'Номер', 'name' => 'num', 'type' => 'text'),
                array('key' => 'field_main_step_title', 'label' => 'Название', 'name' => 'title', 'type' => 'text'),
            ),
        ),

        // Partners
        array(
            'key' => 'tab_main_partners',
            'label' => 'Партнёры',
            'name' => 'tab_main_partners',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array('key' => 'field_main_partners_title', 'label' => 'Заголовок', 'name' => 'main_partners_title', 'type' => 'text', 'default_value' => 'Работаем с ведущими производителями медицинского оборудования'),
        array(
            'key' => 'field_main_partners',
            'label' => 'Партнёры',
            'name' => 'main_partners',
            'type' => 'repeater',
            'min' => 0,
            'max' => 6,
            'layout' => 'block',
            'button_label' => 'Добавить партнёра',
            'sub_fields' => array(
                array('key' => 'field_main_partner_name', 'label' => 'Название', 'name' => 'name', 'type' => 'text'),
                array('key' => 'field_main_partner_desc', 'label' => 'Описание', 'name' => 'desc', 'type' => 'textarea'),
                array('key' => 'field_main_partner_logo', 'label' => 'Логотип', 'name' => 'logo', 'type' => 'image', 'return_format' => 'url', 'preview_size' => 'medium'),
                array('key' => 'field_main_partner_link', 'label' => 'Ссылка', 'name' => 'link', 'type' => 'url'),
            ),
        ),

        // Testimonials
        array(
            'key' => 'tab_main_testimonials',
            'label' => 'Отзывы',
            'name' => 'tab_main_testimonials',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array('key' => 'field_main_testimonials_subtitle', 'label' => 'Подзаголовок', 'name' => 'main_testimonials_subtitle', 'type' => 'text', 'default_value' => 'Что о нас говорят клиенты'),
        array('key' => 'field_main_testimonials_title', 'label' => 'Заголовок', 'name' => 'main_testimonials_title', 'type' => 'text', 'default_value' => 'Отзывы руководителей клиник и врачей'),
        array(
            'key' => 'field_main_testimonials',
            'label' => 'Отзывы',
            'name' => 'main_testimonials',
            'type' => 'repeater',
            'min' => 0,
            'max' => 8,
            'layout' => 'block',
            'button_label' => 'Добавить отзыв',
            'sub_fields' => array(
                array('key' => 'field_main_test_name', 'label' => 'Имя', 'name' => 'name', 'type' => 'text'),
                array('key' => 'field_main_test_position', 'label' => 'Должность', 'name' => 'position', 'type' => 'text'),
                array('key' => 'field_main_test_text', 'label' => 'Текст', 'name' => 'text', 'type' => 'textarea'),
                array('key' => 'field_main_test_color', 'label' => 'Цвет аватара (hex)', 'name' => 'color', 'type' => 'text', 'default_value' => '#315046'),
            ),
        ),

        // Form
        array(
            'key' => 'tab_main_form',
            'label' => 'Форма заявки',
            'name' => 'tab_main_form',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array('key' => 'field_main_form_title', 'label' => 'Заголовок', 'name' => 'main_form_title', 'type' => 'text', 'default_value' => 'Подберём оборудование под задачи вашей клиники'),
        array('key' => 'field_main_form_desc', 'label' => 'Описание', 'name' => 'main_form_desc', 'type' => 'textarea', 'default_value' => 'Оставьте заявку и получите консультацию специалиста'),
        array('key' => 'field_main_form_btn', 'label' => 'Текст кнопки', 'name' => 'main_form_btn', 'type' => 'text', 'default_value' => 'Получить консультацию'),

        // Служебные поля (сейчас не выводятся на сайте)
        array(
            'key' => 'tab_main_stats',
            'label' => 'Плашка преимуществ (не выводится)',
            'name' => 'tab_main_stats',
            'type' => 'tab',
            'placement' => 'left',
        ),
        array(
            'key' => 'field_main_stats',
            'label' => 'Пункты',
            'name' => 'main_stats',
            'type' => 'repeater',
            'instructions' => 'Техническое поле: сейчас не выводится на сайте, оставлено для совместимости.',
            'min' => 0,
            'max' => 4,
            'layout' => 'table',
            'button_label' => 'Добавить пункт',
            'sub_fields' => array(
                array('key' => 'field_main_stats_text', 'label' => 'Текст', 'name' => 'text', 'type' => 'text'),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page_type',
                'operator' => '==',
                'value' => 'front_page',
            ),
        ),
    ),
    'hide_on_screen' => array('the_content', 'featured_image'),
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));
