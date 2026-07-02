# ТриМед — WordPress тема

WordPress-тема для страниц компании ТриМед.

- **Сайт:** https://test1.sy3.ru
- **Шаблоны:** `page-medcentry.php`, `page-laboratory.php`, `page-stomatology.php`, `page-disinfection.php`
- **Редактирование контента:** через ACF-поля соответствующих страниц в админке WordPress

Подробная документация по проекту находится в файле [`PROJECT_CONTEXT.md`](PROJECT_CONTEXT.md).

Регламент совместной работы AI-агентов: [`AI_HANDOFF.md`](AI_HANDOFF.md).

## Быстрый старт

1. Активировать тему `trimed` в админке WordPress.
2. Убедиться, что активирован плагин **Advanced Custom Fields (ACF)**.
3. Открыть нужную страницу и отредактировать содержимое через блоки ACF.

## Структура

- `assets/css/main.css` — основные стили
- `assets/css/home.css` — стили главной страницы
- `assets/css/medcentry.css` — стили страницы медцентров
- `assets/css/laboratory.css` — стили страницы лаборатории
- `assets/css/stomatology.css` — стили страницы стоматологии
- `assets/css/disinfection.css` — стили страницы дезинфекции
- `assets/js/main.js` — FAQ, мобильное меню, AJAX-форма
- `inc/acf-fields*.php` — регистрация ACF-полей
- `page-*.php` — шаблоны страниц
- `functions.php` — подключение ассетов, обработчик формы, общие render/helper-функции

## Разработка

При изменении CSS/JS увеличивайте константу `TRIMED_VERSION` в `functions.php`, чтобы сбросить кэш браузера.

## Регламент рефакторинга

- Повторяемые PHP-атомы выносить в `functions.php` как `trimed_*` helper/render-функции.
- В шаблонах страниц оставлять только данные страницы, порядок секций и уникальную разметку.
- Общую логику ACF/fallback получать через `trimed_get_field_value()`, `trimed_image_field()`, `trimed_repeater_field()`.
- Повторяемые элементы формы использовать через `trimed_render_phone_input()` и `trimed_render_agree_checkbox()`.
- Figma задаёт композицию, контент и визуальное направление, но повторяемые компоненты приводятся к единым стандартам проекта.
- Базовые дизайн-токены и общие компоненты держать в `assets/css/main.css`: радиусы, высоты контролов, карточки, кнопки, формы, общие проектные карточки.
- Ключевые токены: `--radius-control`, `--radius-card`, `--control-height`, `--button-height`, `--project-card-height`, `--project-card-image-width`, `--project-card-gap`.
- Page-specific CSS оставлять только для намеренных исключений конкретной страницы; если исключение не принципиально для смысла макета, приводить его к общему стандарту.
- Перед рефакторингом визуальных секций делать один smoke-check целевых live-страниц, не перепроходить весь сайт без необходимости.
