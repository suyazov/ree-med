# Отчёт по рефакторингу и очистке CSS (сайт test1.sy3.ru)

Дата: 2 июля 2026  
Задача: выполнить рефакторинг страниц сайта и проверить CSS на потенциально неиспользуемые классы.

## Что сделано по рефакторингу

- Вынесены общие helper-функции в `functions.php`:
  - `trimed_render_responsive_picture()` — единый рендер `picture` с мобильной версией и fallback.
  - `trimed_render_slider_dots()` — единый рендер групп точек пагинации для слайдеров.
- `page-stomatology.php`:
  - удалена локальная helper-функция `stom_picture()` и переведены все её вызовы на `trimed_render_responsive_picture()`;
  - корректировка иконки плашки в hero-блоке (fill via `currentColor`) в отдельном фиксе уже применена ранее.
- `front-page.php`, `page-laboratory.php`, `page-disinfection.php`:
  - для точек слайдера используется общий helper `trimed_render_slider_dots()`.
- `assets/css/main.css`:
  - удалены `service-container`, `service-section-inner`, `logo-main`, `logo-tagline` (заменены на существующие общие контейнерные классы и не используются в шаблонах).
- `assets/css/home.css`:
  - удалён класс `category-overlay` (все вхождения), т.к. класс не генерируется шаблонами.

## Скрипт аудита мёртвого CSS

Добавлен `scripts/find_dead_css_selectors.py`:

- Пройти по `*.php`, `*.js`, `*.html`, считая все class-атрибуты.
- Вытащить все селекторы из `assets/css/*.css` + `style.css`.
- Исключить базовые системные/WP-сущности и известные runtime-классы.

Запуск:

```bash
python3 -m py_compile scripts/find_dead_css_selectors.py
python3 scripts/find_dead_css_selectors.py
```

Результат сканирования:

```text
Total selectors: 579
Potentially dead selectors: 25
audience-card
default
error
form-field
form-field-phone
gray
has-answer
has-image
home
image
image-overlay
large
light
mc-audience-card
mc-audience-card--gray
mc-audience-card--green
mc-audience-card--image
mc-audience-card--white
mc-process-card--green
mc-process-card--light
mc-why-stat--gray
mc-why-stat--image
mobile-nav-menu
stat
why-plus
```

### Классы, которые могут быть ложноположительными

- `mc-audience-card*`, `mc-process-card*`, `mc-why-stat--*` — вероятно собираются через карту классов в PHP и не всегда попадают в статический scan строками.
- `default`, `gray`, `light`, `large`, `image` — часто используются как значения параметров состояний и собираются динамически.
- `form-field`, `form-field-phone`, `has-answer`, `has-image`, `home`, `stat` — встречаются как служебные/контекстные классы в динамической разметке и JS-логике.
- `mobile-nav-menu`, `error`, `why-plus` — нужно проверить при последующей вёрстке/JS-модулях в следующих итерациях.

## Результирующая проверка

- `python3 -m py_compile scripts/find_dead_css_selectors.py` — без ошибок.
- `php -l` для изменённых php-файлов (`functions.php`, `front-page.php`, `page-stomatology.php`, `page-laboratory.php`, `page-disinfection.php`) — без синтаксических ошибок.
- Быстрый smoke-check live-ссылок вернулся с кодом `200`:
  - `/`
  - `/medcentry/`
  - `/stomatologiya/`
  - `/laboratoriya/`
  - `/dezinfektsiya/`.

## Риски / next step

Текущий анализ — статический. Он показывает "потенциально мёртвые" классы и требует ручной верификации по визуалу/JS runtime перед финальным удалением этих 25 селекторов.
