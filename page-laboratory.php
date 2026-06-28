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
$hero_image = lab_image_url('lab_hero_image', $img_dir . '/laboratory-hero-main.png');
$hero_button_text = lab_get_field('lab_hero_button_text', 'Получить консультацию');
$hero_bottom_button_text = lab_get_field('lab_hero_bottom_button_text', 'Подобрать оборудование');

$default_hero_features = array(
    array('icon' => $img_dir . '/lab-hero-icon-1.png', 'text' => 'Комплексное оснащение лабораторий'),
    array('icon' => $img_dir . '/lab-hero-icon-2.png', 'text' => 'Поставка со склада и под заказ'),
    array('icon' => $img_dir . '/lab-hero-icon-3.png', 'text' => 'Оборудование ведущих производителей'),
    array('icon' => $img_dir . '/lab-hero-icon-4.png', 'text' => 'Сервисное сопровождение'),
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
    array('title' => 'Клинико-диагностические лаборатории', 'image' => $img_dir . '/laboratory-audience-1.png', 'style' => 'image'),
    array('title' => 'Лаборатории медицинских центров', 'image' => '', 'style' => 'default'),
    array('title' => 'Ветеринарные лаборатории', 'image' => '', 'style' => 'gray'),
    array('title' => 'Научно-исследовательские лаборатории', 'image' => $img_dir . '/laboratory-audience-2.png', 'style' => 'image'),
    array('title' => 'Государственные учреждения', 'image' => '', 'style' => 'green'),
    array('title' => 'Производственные лаборатории', 'image' => '', 'style' => 'default'),
);
$audience_cards = lab_get_repeater('lab_audience_cards', $default_audience_cards);

// Supplies
$supplies_subtitle = lab_get_field('lab_supplies_subtitle', 'Комплексное оснащение лабораторий');
$supplies_title = lab_get_field('lab_supplies_title', 'Подберём оборудование <span class="text-green">под&nbsp;задачи вашей лаборатории</span>');
$supplies_center_image = lab_image_url('lab_supplies_center_image', $img_dir . '/laboratory-supplies-center.png');
$default_supplies_items = array(
    array('text' => 'Лабораторная мебель', 'left' => false, 'style' => 'left:67.63%;top:23.11%'),
    array('text' => 'Автоматические анализаторы', 'left' => false, 'style' => 'left:67.34%;top:38.40%'),
    array('text' => 'Холодильное оборудование', 'left' => false, 'style' => 'left:77.75%;top:53.68%'),
    array('text' => 'Лабораторные расходные материалы', 'left' => false, 'style' => 'left:62.65%;top:68.96%'),
    array('text' => 'Микроскопы', 'left' => false, 'style' => 'left:73.29%;top:84.25%'),
    array('text' => 'Аналитическое оборудование', 'left' => true, 'style' => 'left:8.78%;top:28.87%'),
    array('text' => 'Центрифуги', 'left' => true, 'style' => 'left:5.36%;top:44.15%'),
    array('text' => 'Стерилизационное оборудование', 'left' => true, 'style' => 'left:10.57%;top:59.43%'),
    array('text' => 'Инкубаторы и термостаты', 'left' => true, 'style' => 'left:12.95%;top:74.72%'),
    array('text' => 'Системы хранения и подготовки образцов', 'left' => true, 'style' => 'left:7.07%;top:90.00%'),
);
$supplies_items = lab_get_repeater('lab_supplies_items', $default_supplies_items);

// Included
$included_title = lab_get_field('lab_included_title', 'Берём на&nbsp;себя весь процесс оснащения');
$default_included_cards = array(
    array('image' => $img_dir . '/laboratory-included-4.png', 'number' => '1', 'title' => 'Анализ задач лаборатории'),
    array('image' => $img_dir . '/laboratory-included-5.png', 'number' => '2', 'title' => 'Подбор оборудования и комплектации'),
    array('image' => $img_dir . '/laboratory-included-6.png', 'number' => '3', 'title' => 'Подготовка коммерческого предложения'),
    array('image' => $img_dir . '/laboratory-included-1.png', 'number' => '4', 'title' => 'Поставка оборудования'),
    array('image' => $img_dir . '/laboratory-included-2.png', 'number' => '5', 'title' => 'Консультации по эксплуатации'),
    array('image' => $img_dir . '/laboratory-included-3.png', 'number' => '6', 'title' => 'Сервисное сопровождение'),
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
$why_warehouse_title = lab_get_field('lab_why_warehouse_title', 'Склад в Чите');
$why_warehouse_image = lab_image_url('lab_why_warehouse_image', $img_dir . '/laboratory-warehouse.png');

// Projects
$projects_title = lab_get_field('lab_projects_title', 'Реализованные проекты');
$projects_subtitle = lab_get_field('lab_projects_subtitle', 'За время работы мы реализовали проекты по оснащению медицинских кабинетов и центров в Забайкальском крае. Мы понимаем специфику региона, требования врачей и реальные условия работы.');
$default_projects = array(
    array(
        'image' => $img_dir . '/laboratory-project.png',
        'number' => '01.',
        'title' => 'Клинико-диагностическая лаборатория (г. Чита)',
        'delivered' => 'Автоматический гематологический анализатор, биохимический анализатор, центрифуга, микроскоп, холодильное оборудование, лабораторная мебель и расходные материалы.',
        'result' => 'Лаборатория запущена в работу в срок. Обеспечена полная комплектация оборудованием для проведения основных видов исследований, персонал обучен работе на анализаторах.',
    ),
    array(
        'image' => $img_dir . '/laboratory-project.png',
        'number' => '02.',
        'title' => 'Стоматология «Дента-Профи» (г. Чита)',
        'delivered' => 'Полное оснащение двух стоматологических кабинетов и стерилизационной комнаты под ключ для запуска новой клиники. Требовалось обеспечить соответствие санитарным нормам, организовать централизованную подачу воздуха и эффективную систему инфекционного контроля.',
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
    array('image' => $img_dir . '/laboratory-partner-1.png', 'name' => 'ДеЗиЛаб', 'text' => 'Российский производитель дезинфицирующих средств широкого спектра. Продукция зарегистрирована и эффективна против вирусов, бактерий и грибов.'),
    array('image' => $img_dir . '/laboratory-partner-2.png', 'name' => 'МедЛаб Системс', 'text' => 'Поставщик лабораторного оборудования: анализаторы, микроскопы, центрифуги и расходные материалы для клинико-диагностических лабораторий.'),
    array('image' => $img_dir . '/laboratory-partner-3.png', 'name' => 'БиоТехно', 'text' => 'Производитель стерилизационного и холодильного оборудования, инкубаторов, термостатов и систем хранения биологических образцов.'),
);
$partners = lab_get_repeater('lab_partners', $default_partners);

// Request
$request_title = lab_get_field('lab_request_title', 'Подберём решение для вашего учреждения');
$request_desc = lab_get_field('lab_request_desc', 'Оставьте заявку и получите консультацию специалиста по оснащению лабораторий.');
$request_button_text = lab_get_field('lab_request_button_text', 'Получить консультацию');
?>

<main class="laboratory-page">

<!-- 1. Hero -->
<section class="lab-hero">
    <div class="lab-container">
        <div class="lab-hero-grid">
            <div class="lab-hero-left">
                <div class="lab-hero-top">
                    <h1 class="lab-hero-title"><?php
                        $hero_title = preg_replace('/(лабораторий)(\s+)(под ключ в Чите)(\s+)(и Забайкальском крае)/u', '<span class="text-green">$1</span><br>$3<br><em>$5</em>', $hero_title);
                        echo wp_kses_post($hero_title);
                    ?></h1>
                    <p class="lab-hero-desc"><?php echo esc_html($hero_desc); ?></p>
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
                <button class="lab-hero-bottom-btn" type="button"><?php echo esc_html($hero_bottom_button_text); ?></button>
            </div>

            <div class="lab-hero-visual">
                <div class="lab-hero-image-wrap">
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
                <button class="lab-hero-cta-btn" type="button"><?php echo esc_html($hero_button_text); ?></button>
            </div>
        </div>
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
        <div class="lab-included-grid">
            <h2 class="lab-included-title"><?php echo wp_kses_post($included_title); ?></h2>

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
            <div class="lab-why-stats">
                <img src="<?php echo esc_url($img_dir . '/laboratory-why-main.png'); ?>" alt="" class="lab-why-stats-bg">
                <?php foreach ($why_stats as $stat) : ?>
                    <div class="lab-why-stat-item">
                        <span class="num"><?php echo esc_html(!empty($stat['number']) ? $stat['number'] : ''); ?></span>
                        <span class="txt"><?php echo wp_kses_post(!empty($stat['text']) ? $stat['text'] : ''); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="lab-why-center-col">
                <div class="lab-why-warehouse">
                    <h3 class="lab-why-warehouse-title"><?php echo esc_html($why_warehouse_title); ?></h3>
                    <img src="<?php echo esc_url($why_warehouse_image); ?>" alt="">
                </div>
                <div class="lab-why-features-list">
                    <?php
                    $why_list_features = array_slice($why_features, 0, 2);
                    foreach ($why_list_features as $feature) : ?>
                        <div class="lab-why-feature-item"><span class="plus"></span><span><?php echo esc_html(!empty($feature['text']) ? $feature['text'] : ''); ?></span></div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="lab-why-right-card">
                <?php
                $why_right_feature = !empty($why_features[3]) ? $why_features[3] : array('text' => 'Работа с государственными и частными учреждениями');
                ?>
                <p><?php echo wp_kses_post(!empty($why_right_feature['text']) ? $why_right_feature['text'] : ''); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- 6. Projects -->
<section class="lab-projects">
    <div class="lab-section-inner">
        <div class="lab-projects-header">
            <h2 class="lab-projects-title"><?php echo wp_kses_post($projects_title); ?></h2>
            <?php if (!empty($projects_subtitle)) : ?>
                <p class="lab-projects-desc"><?php echo wp_kses_post($projects_subtitle); ?></p>
            <?php endif; ?>
        </div>

        <div class="lab-projects-slider">
            <?php foreach ($projects as $index => $project) :
                $project_image = !empty($project['image']) ? $project['image'] : $placeholder;
            ?>
                <div class="lab-project-slide <?php echo $index === 1 ? 'active' : ''; ?>">
                    <div class="lab-project-card">
                        <div class="lab-project-card-body">
                            <span class="lab-project-card-num"><?php echo esc_html(!empty($project['number']) ? $project['number'] : ''); ?></span>
                            <h3 class="lab-project-card-title"><?php echo esc_html(!empty($project['title']) ? $project['title'] : ''); ?></h3>
                            <div class="lab-project-card-block lab-project-card-delivered">
                                <p class="lab-project-card-label">Что было поставлено</p>
                                <p class="lab-project-card-text"><?php echo wp_kses_post(!empty($project['delivered']) ? $project['delivered'] : ''); ?></p>
                            </div>
                            <div class="lab-project-card-block lab-project-card-result">
                                <p class="lab-project-card-label">Результат</p>
                                <p class="lab-project-card-text"><?php echo wp_kses_post(!empty($project['result']) ? $project['result'] : ''); ?></p>
                            </div>
                        </div>
                        <div class="lab-project-card-img"><img src="<?php echo esc_url($project_image); ?>" alt=""></div>
                    </div>
                </div>
            <?php endforeach; ?>
            <button class="lab-slider-arrow prev" aria-label="Предыдущий проект"></button>
            <button class="lab-slider-arrow next" aria-label="Следующий проект"></button>
            <div class="lab-slider-dots">
                <?php for ($i = 0; $i < count($projects); $i++) : ?>
                    <button class="lab-slider-dot <?php echo $i === 1 ? 'active' : ''; ?>" data-slide="<?php echo $i; ?>" aria-label="Перейти к проекту <?php echo $i + 1; ?>"></button>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>

<!-- 7. Tasks -->
<section class="lab-tasks">
    <div class="lab-section-inner">
        <div class="lab-tasks-grid">
            <div class="lab-tasks-header">
                <p class="lab-tasks-subtitle"><?php echo esc_html($tasks_subtitle); ?></p>
                <h2 class="lab-tasks-title"><?php echo wp_kses_post($tasks_title); ?></h2>
            </div>
            <div class="lab-tasks-list">
                <?php foreach ($tasks_list as $task) : ?>
                    <div class="lab-tasks-item"><span class="lab-tasks-check"></span><span><?php echo esc_html(!empty($task['text']) ? $task['text'] : ''); ?></span></div>
                <?php endforeach; ?>
            </div>
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
