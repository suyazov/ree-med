<?php
/*
Template Name: Лаборатория
*/
get_header();

$img_dir = get_template_directory_uri() . '/assets/img';
$placeholder = $img_dir . '/placeholder.jpg';

function lab_get_field($key, $fallback = '') {
    if (function_exists('get_field')) {
        $value = get_field($key);
        return ($value !== null && $value !== false && $value !== '') ? $value : $fallback;
    }
    return $fallback;
}

function lab_image_url($key, $placeholder) {
    $url = '';
    if (function_exists('get_field')) {
        $url = get_field($key);
    }
    return (!empty($url)) ? $url : $placeholder;
}

function lab_get_repeater($key, $fallback = array()) {
    if (function_exists('get_field')) {
        $value = get_field($key);
        if (!empty($value) && is_array($value)) {
            return $value;
        }
    }
    return $fallback;
}

function lab_audience_card_class($style) {
    $map = array(
        'default'       => 'lab-audience-card--white',
        'gray'          => 'lab-audience-card--gray',
        'green'         => 'lab-audience-card--green',
        'image'         => 'lab-audience-card--image',
        'image-overlay' => 'lab-audience-card--image',
    );
    return isset($map[$style]) ? $map[$style] : 'lab-audience-card--white';
}

function lab_why_stat_class($style) {
    $map = array(
        'gray'  => 'lab-why-stat--gray',
        'green' => 'lab-why-stat--green',
        'image' => 'lab-why-stat--img',
    );
    return isset($map[$style]) ? $map[$style] : 'lab-why-stat--gray';
}

// Hero
$hero_title = lab_get_field('lab_hero_title', 'Оснащение лабораторий под ключ в Чите и Забайкальском крае');
$hero_desc  = lab_get_field('lab_hero_desc', 'Подбираем и поставляем лабораторное оборудование для медицинских, клинико-диагностических, исследовательских и производственных лабораторий.');
$hero_image = lab_image_url('lab_hero_image', $placeholder);
$hero_button_text = lab_get_field('lab_hero_button_text', 'Получить консультацию');
$hero_bottom_button_text = lab_get_field('lab_hero_bottom_button_text', 'Подобрать оборудование');

$default_hero_features = array(
    array('svg' => '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2h4l2 5h-8z"/><path d="M12 7v13"/><path d="M9 20h6"/></svg>', 'text' => 'Комплексное оснащение лабораторий'),
    array('svg' => '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="8" width="20" height="10" rx="2"/><path d="M8 18v2"/><path d="M16 18v2"/><path d="M6 8V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"/></svg>', 'text' => 'Поставка со склада и под заказ'),
    array('svg' => '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>', 'text' => 'Оборудование ведущих производителей'),
    array('svg' => '<svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a3 3 0 0 0-3 3v3H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-9a2 2 0 0 0-2-2h-3V5a3 3 0 0 0-3-3z"/><path d="M12 18v-3"/></svg>', 'text' => 'Сервисное сопровождение'),
);
$hero_features = lab_get_repeater('lab_hero_features', $default_hero_features);

$default_hero_badges = array(
    array('text' => 'Безопасность лаборатории'),
    array('text' => 'Расчёт под объём исследований'),
    array('text' => 'Учёт бюджета'),
    array('text' => 'Подбор под задачи учреждения'),
);
$hero_badges = lab_get_repeater('lab_hero_badges', $default_hero_badges);

// Audience
$audience_subtitle = lab_get_field('lab_audience_subtitle', 'Для кого мы работаем');
$audience_title = lab_get_field('lab_audience_title', 'Решения <span class="text-green">для разных типов</span> лабораторий');
$default_audience_cards = array(
    array('title' => 'Клинико-диагностические лаборатории', 'image' => '', 'style' => 'image'),
    array('title' => 'Лаборатории медицинских центров', 'image' => '', 'style' => 'default'),
    array('title' => 'Научно-исследовательские лаборатории', 'image' => '', 'style' => 'image'),
    array('title' => 'Ветеринарные лаборатории', 'image' => '', 'style' => 'gray'),
    array('title' => 'Государственные учреждения', 'image' => '', 'style' => 'green'),
    array('title' => 'Производственные лаборатории', 'image' => '', 'style' => 'default'),
);
$audience_cards = lab_get_repeater('lab_audience_cards', $default_audience_cards);

// Supplies
$supplies_subtitle = lab_get_field('lab_supplies_subtitle', 'Комплексное оснащение лабораторий');
$supplies_title = lab_get_field('lab_supplies_title', 'Подберём оборудование <span class="text-green">под&nbsp;задачи вашей лаборатории</span>');
$supplies_center_image = lab_image_url('lab_supplies_center_image', $placeholder);
$default_supplies_items = array(
    array('text' => 'Лабораторная мебель', 'left' => false, 'style' => 'left:66.29%;top:23.02%'),
    array('text' => 'Автоматические анализаторы', 'left' => false, 'style' => 'left:66.00%;top:38.30%'),
    array('text' => 'Холодильное оборудование', 'left' => false, 'style' => 'left:76.41%;top:52.55%'),
    array('text' => 'Лабораторные расходные материалы', 'left' => false, 'style' => 'left:61.31%;top:67.83%'),
    array('text' => 'Микроскопы', 'left' => false, 'style' => 'left:71.95%;top:83.11%'),
    array('text' => 'Аналитическое оборудование', 'left' => true, 'style' => 'left:27.75%;top:28.77%'),
    array('text' => 'Центрифуги', 'left' => true, 'style' => 'left:14.36%;top:44.06%'),
    array('text' => 'Стерилизационное оборудование', 'left' => true, 'style' => 'left:31.70%;top:58.30%'),
    array('text' => 'Инкубаторы и термостаты', 'left' => true, 'style' => 'left:29.98%;top:73.58%'),
    array('text' => 'Системы хранения и подготовки образцов', 'left' => true, 'style' => 'left:33.11%;top:88.87%'),
);
$supplies_items = lab_get_repeater('lab_supplies_items', $default_supplies_items);

// Included
$included_title = lab_get_field('lab_included_title', 'Берём на&nbsp;себя весь процесс оснащения');
$default_included_cards = array(
    array('image' => '', 'number' => '1', 'title' => 'Анализ задач лаборатории'),
    array('image' => '', 'number' => '2', 'title' => 'Подбор оборудования и комплектации'),
    array('image' => '', 'number' => '3', 'title' => 'Подготовка коммерческого предложения'),
    array('image' => '', 'number' => '4', 'title' => 'Поставка оборудования'),
    array('image' => '', 'number' => '5', 'title' => 'Сервисное сопровождение'),
    array('image' => '', 'number' => '6', 'title' => 'Консультации по эксплуатации'),
);
$included_cards = lab_get_repeater('lab_included_cards', $default_included_cards);
$included_result_text = lab_get_field('lab_included_result_text', 'Мы&nbsp;поставляем не&nbsp;отдельные позиции из&nbsp;каталога, а&nbsp;формируем полноценное решение, которое помогает лаборатории работать эффективно и&nbsp;соответствовать современным требованиям');

// Why choose
$why_title = lab_get_field('lab_why_title', 'Почему выбирают ТриМед');
$why_subtitle = lab_get_field('lab_why_subtitle', 'Надежный партнер для лабораторий региона');
$default_why_stats = array(
    array('number' => '20+ лет', 'text' => 'опыта работы в&nbsp;медицинской отрасли', 'style' => 'image'),
    array('number' => '5000+', 'text' => 'позиций оборудования и&nbsp;расходных материалов', 'style' => 'gray'),
);
$why_stats = lab_get_repeater('lab_why_stats', $default_why_stats);
$default_why_features = array(
    array('text' => 'Прямые поставки от производителей'),
    array('text' => 'Консультационная поддержка'),
    array('text' => 'Склад в Чите'),
    array('text' => 'Работа с&nbsp;государственными и&nbsp;частными учреждениями'),
);
$why_features = lab_get_repeater('lab_why_features', $default_why_features);
$why_warehouse_title = lab_get_field('lab_why_warehouse_title', 'Собственный склад в Чите');
$why_warehouse_image = lab_image_url('lab_why_warehouse_image', $placeholder);

// Projects
$projects_title = lab_get_field('lab_projects_title', 'Реализованные проекты');
$projects_subtitle = lab_get_field('lab_projects_subtitle', 'За&nbsp;время работы мы&nbsp;реализовали проекты по&nbsp;оснащению медицинских кабинетов и&nbsp;центров в&nbsp;Забайкальском крае. Мы&nbsp;понимаем специфику региона, требования врачей и&nbsp;реальные условия работы.');
$default_projects = array(
    array(
        'image' => '',
        'number' => '01.',
        'title' => 'Клинико-диагностическая лаборатория (г. Чита)',
        'delivered' => 'Автоматический гематологический анализатор, биохимический анализатор, центрифуга, микроскоп, холодильное оборудование, лабораторная мебель и расходные материалы.',
        'result' => 'Лаборатория запущена в работу в срок. Обеспечена полная комплектация оборудованием для проведения основных видов исследований, персонал обучен работе на анализаторах.',
    ),
    array(
        'image' => '',
        'number' => '02.',
        'title' => 'Стоматология «Дента-Профи» (г. Чита)',
        'delivered' => 'Стоматологические установки (2&nbsp;шт.), компрессорная станция, автоклав, упаковочные материалы для стерилизации, рециркулятор воздуха, дезинфицирующие средства, контейнеры для дезинфекции.',
        'result' => 'Клиника введена в эксплуатацию в запланированные сроки. Все кабинеты укомплектованы, стерилизационная функционирует в полном объёме, соблюдены требования Роспотребнадзора. Персонал обеспечен всем необходимым для безопасной работы.',
    ),
);
$projects = lab_get_repeater('lab_projects', $default_projects);

// Tasks
$tasks_title = lab_get_field('lab_tasks_title', 'С чем к нам обращаются чаще всего');
$tasks_subtitle = lab_get_field('lab_tasks_subtitle', 'Популярные задачи клиентов');
$default_tasks = array(
    array('text' => 'Оснащение новой лаборатории'),
    array('text' => 'Расширение существующей лаборатории'),
    array('text' => 'Замена оборудования'),
    array('text' => 'Подготовка к лицензированию'),
    array('text' => 'Оснащение по техническому заданию'),
    array('text' => 'Подбор оборудования под бюджет'),
);
$tasks_list = lab_get_repeater('lab_tasks_list', $default_tasks);

// Partners
$partners_title = lab_get_field('lab_partners_title', 'Работаем с ведущими производителями');
$default_partners = array(
    array('image' => '', 'name' => 'ДеЗиЛаб', 'text' => 'Российский производитель дезинфицирующих средств широкого спектра. Продукция зарегистрирована и эффективна против вирусов, бактерий и грибов.'),
    array('image' => '', 'name' => 'МедЛаб Системс', 'text' => 'Поставщик лабораторного оборудования: анализаторы, микроскопы, центрифуги и расходные материалы для клинико-диагностических лабораторий.'),
    array('image' => '', 'name' => 'БиоТехно', 'text' => 'Производитель стерилизационного и холодильного оборудования, инкубаторов, термостатов и систем хранения биологических образцов.'),
);
$partners = lab_get_repeater('lab_partners', $default_partners);

// Request
$request_title = lab_get_field('lab_request_title', 'Подберём решение для&nbsp;вашего учреждения');
$request_desc = lab_get_field('lab_request_desc', 'Оставьте заявку, и&nbsp;специалист поможет подобрать оборудование, дезинфицирующие средства и&nbsp;расходные материалы под&nbsp;ваши задачи.');
$request_button_text = lab_get_field('lab_request_button_text', 'Отправить');
?>

<main class="laboratory-page">

<!-- 1. Hero -->
<section class="lab-hero">
    <div class="lab-container">
        <div class="lab-hero-grid">
            <div class="lab-hero-top">
                <h1 class="lab-hero-title"><?php echo wp_kses_post(str_replace('лабораторий', '<span class="text-green">лабораторий</span>', $hero_title)); ?></h1>
                <p class="lab-hero-desc"><?php echo esc_html($hero_desc); ?></p>
            </div>

            <div class="lab-hero-visual">
                <img src="<?php echo esc_url($hero_image); ?>" alt="" class="lab-hero-main-image">
                <div class="lab-hero-badges">
                    <?php
                    $badge_classes = array('safety', 'volume', 'budget', 'tasks');
                    foreach ($hero_badges as $index => $badge) :
                        $badge_class = !empty($badge_classes[$index]) ? $badge_classes[$index] : 'safety';
                    ?>
                        <div class="lab-hero-badge lab-hero-badge--<?php echo esc_attr($badge_class); ?>">
                            <span class="lab-hero-badge-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                            <span><?php echo esc_html(!empty($badge['text']) ? $badge['text'] : ''); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="lab-hero-features">
                <?php foreach ($hero_features as $feature) : ?>
                    <div class="lab-hero-feature-card">
                        <?php if (!empty($feature['icon'])) : ?>
                            <img src="<?php echo esc_url($feature['icon']); ?>" alt="" class="icon">
                        <?php elseif (!empty($feature['svg'])) : ?>
                            <?php echo $feature['svg']; ?>
                        <?php else : ?>
                            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <?php endif; ?>
                        <span><?php echo esc_html(!empty($feature['text']) ? $feature['text'] : ''); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="lab-hero-cta-btn" type="button"><?php echo esc_html($hero_button_text); ?></button>
        </div>
        <button class="lab-hero-bottom-btn" type="button"><?php echo esc_html($hero_bottom_button_text); ?></button>
    </div>
</section>

<!-- 2. Audience -->
<section class="lab-audience">
    <div class="lab-section-inner">
        <div class="lab-audience-header">
            <div class="lab-audience-label"><?php echo esc_html($audience_subtitle); ?></div>
            <h2 class="lab-audience-title"><?php echo wp_kses_post($audience_title); ?></h2>
        </div>

        <div class="lab-audience-grid">
            <?php foreach ($audience_cards as $card) :
                $card_class = lab_audience_card_class(!empty($card['style']) ? $card['style'] : 'default');
                $card_image = !empty($card['image']) ? $card['image'] : '';
                $card_title = !empty($card['title']) ? $card['title'] : '';
                $inline_style = $card_image ? 'background-image:url(' . esc_url($card_image) . ');' : '';
            ?>
                <div class="lab-audience-card <?php echo esc_attr($card_class); ?>" style="<?php echo esc_attr($inline_style); ?>">
                    <span class="arrow"></span>
                    <p class="text"><?php echo esc_html($card_title); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- 3. Supplies -->
<section class="lab-supplies">
    <div class="lab-supplies-diagram">
        <div class="lab-supplies-label"><?php echo esc_html($supplies_subtitle); ?></div>
        <h2 class="lab-supplies-title"><?php echo wp_kses_post($supplies_title); ?></h2>

        <div class="lab-supplies-rings">
            <div class="lab-supplies-ring lab-supplies-ring--outer"></div>
            <div class="lab-supplies-ring lab-supplies-ring--middle"></div>
            <div class="lab-supplies-ring lab-supplies-ring--inner"></div>
        </div>

        <div class="lab-supplies-center">
            <img src="<?php echo esc_url($supplies_center_image); ?>" alt="">
        </div>

        <div class="lab-supplies-items">
            <?php foreach ($supplies_items as $i => $item) :
                $is_left = isset($item['left']) ? $item['left'] : ($i >= 5);
                $position = isset($item['style']) ? $item['style'] : '';
                $item_class = 'lab-supplies-item' . ($is_left ? ' lab-supplies-item--left' : '');
                $item_text = !empty($item['text']) ? $item['text'] : '';
            ?>
                <div class="<?php echo esc_attr($item_class); ?>" style="<?php echo esc_attr($position); ?>">
                    <span class="dot"></span><span class="txt"><?php echo esc_html($item_text); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- 4. Included -->
<section class="lab-included">
    <div class="lab-section-inner">
        <h2 class="lab-included-title"><?php echo wp_kses_post($included_title); ?></h2>

        <div class="lab-included-grid">
            <?php foreach ($included_cards as $card) :
                $card_image = !empty($card['image']) ? $card['image'] : $placeholder;
            ?>
                <div class="lab-included-card">
                    <div class="lab-included-card-img"><img src="<?php echo esc_url($card_image); ?>" alt=""></div>
                    <div class="lab-included-card-body"><span class="lab-included-card-num"><?php echo esc_html(!empty($card['number']) ? $card['number'] : ''); ?></span><p><?php echo esc_html(!empty($card['title']) ? $card['title'] : ''); ?></p></div>
                </div>
            <?php endforeach; ?>
            <div class="lab-included-result">
                <span class="arrow"></span>
                <p><?php echo wp_kses_post($included_result_text); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- 5. Why choose -->
<section class="lab-why">
    <div class="lab-section-inner">
        <div class="lab-why-header">
            <h2 class="lab-why-title"><?php echo wp_kses_post($why_title); ?></h2>
            <p class="lab-why-subtitle"><?php echo esc_html($why_subtitle); ?></p>
        </div>

        <div class="lab-why-grid">
            <div class="lab-why-left">
                <div class="lab-why-stats">
                    <?php foreach ($why_stats as $stat) :
                        $stat_class = lab_why_stat_class(!empty($stat['style']) ? $stat['style'] : 'gray');
                    ?>
                        <div class="lab-why-stat <?php echo esc_attr($stat_class); ?>">
                            <span class="num"><?php echo esc_html(!empty($stat['number']) ? $stat['number'] : ''); ?></span>
                            <span class="txt"><?php echo wp_kses_post(!empty($stat['text']) ? $stat['text'] : ''); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="lab-why-features">
                    <?php foreach ($why_features as $feature) : ?>
                        <div class="lab-why-feature"><span class="plus"></span><span><?php echo esc_html(!empty($feature['text']) ? $feature['text'] : ''); ?></span></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="lab-why-warehouse">
                <h3 class="lab-why-warehouse-title"><?php echo esc_html($why_warehouse_title); ?></h3>
                <img src="<?php echo esc_url($why_warehouse_image); ?>" alt="">
            </div>
        </div>
    </div>
</section>

<!-- 6. Projects -->
<section class="lab-projects">
    <div class="lab-section-inner">
        <div class="lab-projects-header">
            <h2 class="lab-projects-title"><?php echo wp_kses_post($projects_title); ?></h2>
            <p class="lab-projects-desc"><?php echo wp_kses_post($projects_subtitle); ?></p>
        </div>

        <div class="lab-projects-slider">
            <?php foreach ($projects as $index => $project) :
                $project_image = !empty($project['image']) ? $project['image'] : $placeholder;
            ?>
                <div class="lab-project-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="lab-project-card">
                        <div class="lab-project-card-img"><img src="<?php echo esc_url($project_image); ?>" alt=""></div>
                        <div class="lab-project-card-body">
                            <div class="lab-project-card-top">
                                <span class="lab-project-card-num"><?php echo esc_html(!empty($project['number']) ? $project['number'] : ''); ?></span>
                                <span class="lab-project-card-arrow"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg></span>
                            </div>
                            <div>
                                <h3 class="lab-project-card-title"><?php echo esc_html(!empty($project['title']) ? $project['title'] : ''); ?></h3>
                                <div class="lab-project-card-block">
                                    <p class="lab-project-card-label">Что было поставлено</p>
                                    <p class="lab-project-card-text"><?php echo wp_kses_post(!empty($project['delivered']) ? $project['delivered'] : ''); ?></p>
                                </div>
                                <div class="lab-project-card-block">
                                    <p class="lab-project-card-label">Результат</p>
                                    <p class="lab-project-card-text"><?php echo wp_kses_post(!empty($project['result']) ? $project['result'] : ''); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <button class="lab-slider-arrow prev" aria-label="Предыдущий проект"></button>
            <button class="lab-slider-arrow next" aria-label="Следующий проект"></button>
            <div class="lab-slider-dots">
                <?php for ($i = 0; $i < count($projects); $i++) : ?>
                    <button class="lab-slider-dot <?php echo $i === 0 ? 'active' : ''; ?>" data-slide="<?php echo $i; ?>" aria-label="Перейти к проекту <?php echo $i + 1; ?>"></button>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>

<!-- 7. Tasks -->
<section class="lab-tasks">
    <div class="lab-section-inner">
        <div class="lab-tasks-header">
            <h2 class="lab-tasks-title"><?php echo wp_kses_post($tasks_title); ?></h2>
            <p class="lab-tasks-subtitle"><?php echo esc_html($tasks_subtitle); ?></p>
        </div>
        <div class="lab-tasks-grid">
            <?php foreach ($tasks_list as $task) : ?>
                <div class="lab-tasks-item"><span class="lab-tasks-check"></span><span><?php echo esc_html(!empty($task['text']) ? $task['text'] : ''); ?></span></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 8. Partners -->
<section class="lab-partners">
    <div class="lab-section-inner">
        <h2 class="lab-partners-title"><?php echo wp_kses_post($partners_title); ?></h2>
        <div class="lab-partners-grid">
            <?php foreach ($partners as $partner) :
                $partner_image = !empty($partner['image']) ? $partner['image'] : $placeholder;
            ?>
                <div class="lab-partner-card">
                    <img src="<?php echo esc_url($partner_image); ?>" alt="">
                    <h3 class="lab-partner-name"><?php echo esc_html(!empty($partner['name']) ? $partner['name'] : ''); ?></h3>
                    <p class="lab-partner-text"><?php echo wp_kses_post(!empty($partner['text']) ? $partner['text'] : ''); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 9. Request -->
<section class="lab-request">
    <div class="lab-section-inner">
        <div class="lab-request-grid">
            <div class="lab-request-text">
                <h2 class="lab-request-title"><?php echo wp_kses_post($request_title); ?></h2>
                <p class="lab-request-desc"><?php echo wp_kses_post($request_desc); ?></p>
            </div>
            <form id="contact-form" class="lab-request-form">
                <input type="text" name="name" placeholder="Иванов Николай Сергеевич" required>
                <input type="tel" name="phone" placeholder="+7 (999) 999-99-99" required>
                <input type="text" name="organization" placeholder="Название организации">
                <textarea name="comment" placeholder="Ваш комментарий"></textarea>
                <label class="checkbox">
                    <input type="checkbox" name="agree" value="1" required>
                    <span>Оставляя заявку, я соглашаюсь с условиями Политики обработки персональных данных</span>
                </label>
                <div class="form-message"></div>
                <button type="submit"><?php echo esc_html($request_button_text); ?></button>
            </form>
        </div>
    </div>
</section>


</main>

<?php
get_footer();
