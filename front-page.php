<?php
get_header();

$img_main = get_template_directory_uri() . '/assets/img/main';

function main_image($field, $fallback) {
    $url = get_field($field);
    return !empty($url) ? $url : $fallback;
}

// Hero
$hero_title = get_field('main_hero_title') ?: 'Комплексное оснащение медицинских учреждений в Забайкальском крае';
$hero_desc  = get_field('main_hero_desc')  ?: 'Подбираем оборудование, расходные материалы и готовые решения для клиник, лабораторий, стоматологий и медицинских центров.';
$hero_image = main_image('main_hero_image', $img_main . '/главная-1440-4.png');
$hero_btn1  = get_field('main_hero_btn1') ?: 'Получить консультацию';
$hero_btn2  = get_field('main_hero_btn2') ?: 'В магазин';
$hero_checks = get_field('main_hero_checks');
if (empty($hero_checks)) {
    $hero_checks = array(
        array('text' => 'Подбираем решения под задачи и бюджет'),
        array('text' => 'Собственный склад в Чите'),
    );
}
$hero_badges = get_field('main_hero_badges');
if (empty($hero_badges)) {
    $hero_badges = array(
        array('text' => 'Работаем с частными и государственными клиниками', 'sub' => '', 'light' => true),
        array('text' => '5000+', 'sub' => 'позиций в наличии', 'light' => false, 'stat' => true),
    );
}

// Stats bar
$stats = get_field('main_stats');
if (empty($stats)) {
    $stats = array(
        array('text' => 'Подбираем решения под задачи и бюджет'),
        array('text' => 'Собственный склад в Чите'),
    );
}

// About
$about_title = get_field('main_about_title') ?: 'ТриМед — поставщик медицинского оборудования и расходных материалов';
$about_desc  = get_field('main_about_desc')  ?: 'Мы помогаем медицинским учреждениям оснащать кабинеты, отделения и клиники современным оборудованием';
$about_text  = get_field('main_about_text')  ?: 'Берём на себя подбор решений, поставку, консультации и сопровождение проекта на всех этапах';
$about_image = main_image('main_about_image', $img_main . '/3-0.png');
$about_stats = get_field('main_about_stats');
if (empty($about_stats)) {
    $about_stats = array(
        array('num' => '8+ лет', 'label' => 'на рынке'),
        array('num' => '5000+', 'label' => 'позиций оборудования'),
        array('num' => '100+', 'label' => 'медицинских учреждений региона'),
        array('num' => '15', 'label' => 'специалистов в команде'),
    );
}

// Directions
$dir_subtitle = get_field('main_directions_subtitle') ?: 'Направления работы';
$dir_title    = get_field('main_directions_title')    ?: 'Решения для разных направлений медицины';
$directions   = get_field('main_directions');
if (empty($directions)) {
    $directions = array(
        array('title' => 'Стоматология', 'image' => $img_main . '/76-0.png', 'link' => home_url('/stomatologiya/'), 'large' => false),
        array('title' => 'Лаборатория',  'image' => $img_main . '/80-0.png', 'link' => home_url('/laboratoriya/'), 'large' => false),
        array('title' => 'Медицинские центры', 'image' => $img_main . '/78-0.png', 'link' => home_url('/medcentry/'), 'large' => true),
        array('title' => 'Дезинфекция и стерилизация', 'image' => $img_main . '/asset-10.png', 'link' => home_url('/dezinfektsiya/'), 'large' => false),
        array('title' => 'Расходные материалы', 'image' => $img_main . '/asset-11.png', 'link' => '#', 'large' => false),
    );
}

// Audience
$aud_subtitle = get_field('main_audience_subtitle') ?: 'Кому мы помогаем';
$aud_title    = get_field('main_audience_title')    ?: 'Работаем с медицинскими учреждениями любого масштаба';
$audience_items = get_field('main_audience_items');
if (empty($audience_items)) {
    $audience_items = array(
        array('icon' => $img_main . '/icons/figma-audience-hospital.png', 'text' => 'Государственные больницы'),
        array('icon' => $img_main . '/icons/figma-audience-polyclinic.png', 'text' => 'Поликлиники'),
        array('icon' => $img_main . '/icons/figma-audience-private.png', 'text' => 'Частные клиники'),
        array('icon' => $img_main . '/icons/figma-audience-dentistry.png', 'text' => 'Стоматологии'),
        array('icon' => $img_main . '/icons/figma-audience-lab.png', 'text' => 'Лаборатории'),
        array('icon' => $img_main . '/icons/figma-audience-rehab.png', 'text' => 'Реабилитационные центры'),
        array('icon' => $img_main . '/icons/figma-audience-sanatorium.png', 'text' => 'Санатории'),
        array('icon' => $img_main . '/icons/figma-audience-diagnostic.png', 'text' => 'Диагностические центры'),
    );
}

// Tasks
$tasks_title = get_field('main_tasks_title') ?: 'Не просто поставляем оборудование, а решаем задачи клиники';
$tasks = get_field('main_tasks');
if (empty($tasks)) {
    $tasks = array(
        array('num' => '01.', 'title' => 'Подбор под бюджет', 'image' => $img_main . '/104-0.png'),
        array('num' => '02.', 'title' => 'Склад в Чите', 'image' => $img_main . '/105-3.png'),
        array('num' => '03.', 'title' => 'Поставка под заказ', 'image' => $img_main . '/106-0.png'),
        array('num' => '04.', 'title' => 'Помощь в комплектации', 'image' => $img_main . '/asset-11.png'),
        array('num' => '05.', 'title' => 'Консультации специалистов', 'image' => $img_main . '/105-0.png'),
        array('num' => '06.', 'title' => 'Сервисное сопровождение', 'image' => $img_main . '/105-3.png'),
    );
}

// Projects
$projects_title = get_field('main_projects_title') ?: '<span class="text-green">Реализованные</span> проекты';
$projects_btn   = get_field('main_projects_btn')   ?: 'Смотреть все проекты';
$projects = get_field('main_projects');
if (empty($projects)) {
    $projects = array(
        array('cat' => '01. Оснащение стоматологического кабинета', 'title' => 'Стоматология «Дента-Профи» (г. Чита)', 'desc' => 'Оснащение двух кабинетов под ключ: стоматологические установки, компрессорная, стерилизационная.', 'image' => $img_main . '/67-0.png'),
        array('cat' => '02. Оснащение лаборатории', 'title' => 'Медицинский центр «Здоровье» (г. Чита)', 'desc' => 'Поставка и монтаж рентген-кабинета с радиационной защитой, пуско-наладка.', 'image' => $img_main . '/67-0.png'),
        array('cat' => '03. Поставка оборудования для медицинского центра', 'title' => 'Медицинский центр «Здоровье» (г. Чита)', 'desc' => 'Поставка и монтаж рентген-кабинета с радиационной защитой, пуско-наладка.', 'image' => $img_main . '/67-0.png'),
        array('cat' => '04. Оснащение стоматологического кабинета', 'title' => 'Центр «Здоровье Забайкалья» (пгт. Агинское)', 'desc' => 'Оснащение процедурного кабинета и перевязочной. Обеспечена непрерывная стерилизация инструментов и обеззараживание воздуха.', 'image' => $img_main . '/67-0.png'),
    );
}

// Categories
$cat_title = get_field('main_categories_title') ?: 'Основные категории <span class="text-green">оборудования</span>';
$categories = get_field('main_categories');
if (empty($categories)) {
    $categories = array(
        array('num' => '1', 'title' => 'Диагностика', 'image' => $img_main . '/cat-diagnostic.png', 'link' => '#'),
        array('num' => '2', 'title' => 'Стоматология', 'image' => $img_main . '/cat-stomatology.png', 'link' => home_url('/stomatologiya/')),
        array('num' => '3', 'title' => 'Лаборатория', 'image' => $img_main . '/cat-laboratory.png', 'link' => home_url('/laboratoriya/')),
        array('num' => '4', 'title' => 'Хирургия', 'image' => $img_main . '/68-0.png', 'link' => '#'),
        array('num' => '5', 'title' => 'Реабилитация', 'image' => $img_main . '/69-0.png', 'link' => '#'),
        array('num' => '6', 'title' => 'Расходные материалы', 'image' => $img_main . '/cat-consumables.png', 'link' => '#'),
        array('num' => '7', 'title' => 'Дезинфекция', 'image' => $img_main . '/82-0.png', 'link' => home_url('/dezinfektsiya/')),
    );
}

// Steps
$steps_subtitle = get_field('main_steps_subtitle') ?: 'Этапы работы';
$steps_title    = get_field('main_steps_title')    ?: 'От запроса <span class="text-green">до поставки</span>';
$steps_image    = main_image('main_steps_image', $img_main . '/103-0.png');
$steps = get_field('main_steps');
if (empty($steps)) {
    $steps = array(
        array('num' => '1', 'title' => 'Получаем задачу'),
        array('num' => '2', 'title' => 'Подбираем решение'),
        array('num' => '3', 'title' => 'Согласовываем спецификацию'),
        array('num' => '4', 'title' => 'Поставляем оборудование'),
        array('num' => '5', 'title' => 'Сопровождаем после поставки'),
    );
}

// Partners
$partners_title = get_field('main_partners_title') ?: 'Работаем с ведущими производителями медицинского оборудования';
    $partners_title_line1 = 'Работаем с ведущими';
    $partners_title_line2 = preg_replace('/^Работаем с ведущими\s*/u', '', $partners_title);
$partners = get_field('main_partners');
if (empty($partners)) {
    $partners = array(
        array('name' => 'ДеЗиЛаб', 'desc' => 'Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.', 'logo' => $img_main . '/662-0.png'),
        array('name' => 'ДеЗиЛаб', 'desc' => 'Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.', 'logo' => $img_main . '/662-0.png'),
        array('name' => 'ДеЗиЛаб', 'desc' => 'Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.', 'logo' => $img_main . '/662-0.png'),
    );
}

// Testimonials
$test_subtitle = get_field('main_testimonials_subtitle') ?: 'Что о нас говорят клиенты';
$test_title    = get_field('main_testimonials_title')    ?: 'Отзывы руководителей клиник и врачей';
    $test_title_first = 'Отзывы руководителей';
    $test_title_rest  = preg_replace('/^Отзывы руководителей\s*/u', '', $test_title);
$testimonials = get_field('main_testimonials');
if (empty($testimonials)) {
    $testimonials = array(
        array('name' => 'Киселёва Елена Валерьевна', 'position' => 'Главный врач ООО «Медицинский центр „Здоровье“» (г. Чита)', 'text' => 'Оснащали процедурный кабинет и перевязочную под ключ. Специалисты подобрали всё необходимое: от дезсредств до рециркуляторов и автоклава. Всё пришло точно в срок, без задержек. Особенно порадовала консультационная поддержка — помогли разобраться с нормативной документацией. Рекомендуем как надёжного поставщика', 'color' => '#315046'),
        array('name' => 'Андреева Марина Сергеевна', 'position' => 'Заведующая лабораторией ООО «Диагностика+» (г. Чита)', 'text' => 'Для лаборатории важно было получить не просто товар, а комплексное решение с учётом объёма исследований и бюджета. Нам подобрали дезсредства для поверхностей и оборудования, контейнеры для стерилизации, упаковочные материалы. Всё с документами, сертификатами. Работаем уже полгода — нареканий нет. Спасибо команде!', 'color' => '#367643'),
        array('name' => 'Гаврилов Сергей Николаевич', 'position' => 'Директор санатория «Забайкалье» (Забайкальский край)', 'text' => 'В двух корпусах санатория требовалось организовать систему инфекционного контроля. Поставили рециркуляторы воздуха, дозаторы с антисептиками, дезсредства для помещений. Всё качественное, сертифицированное, с зелёной маркировкой — удобно для контроля использования. Персонал обучен, проблем нет. Сотрудничество оставило только положительные впечатления', 'color' => '#3F8D50'),
        array('name' => 'Петров Дмитрий Владимирович', 'position' => 'Руководитель стоматологической клиники «Дента-Профи» (г. Чита)', 'text' => 'Открывали новую стоматологию с нуля. Обратились за полным оснащением двух кабинетов и стерилизационной. Получили чёткий расчёт, быструю поставку и монтаж. Инструменты, расходники, оборудование — всё в наличии было на складе в Чите, что сильно ускорило процесс. Клиника запущена в срок, проверки пройдены. Будем обращаться ещё.', 'color' => '#51A462'),
    );
}

// Form
$form_title = get_field('main_form_title') ?: 'Подберём оборудование<br><em>под задачи вашей клиники</em>';
$form_desc  = get_field('main_form_desc')  ?: 'Оставьте заявку и получите консультацию специалиста';
$form_btn_raw = get_field('main_form_btn');
$form_btn   = (!empty($form_btn_raw) && $form_btn_raw !== 'Отправить') ? $form_btn_raw : 'Получить консультацию';
?>

<main class="front-page">

    <section class="home-hero">
        <div class="container">
            <div class="home-hero-grid">
                <div class="home-hero-title-wrap">
                    <h1 class="home-hero-title"><span>Комплексное оснащение</span> <span class="text-green">медицинских учреждений</span> <span>в Забайкальском крае</span></h1>
                </div>
                <div class="home-hero-image-wrap">
                    <a href="#" class="home-hero-shop-btn"><?php echo esc_html($hero_btn2); ?><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
                    <img src="<?php echo esc_url($hero_image); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="home-hero-image">
                    <?php if (!empty($hero_badges)) : ?>
                    <div class="home-hero-badges">
                        <?php foreach ($hero_badges as $badge) :
                            $light = !empty($badge['light']);
                            $badge_text = $badge['text'] ?? '';
                            $badge_sub  = $badge['sub'] ?? '';
                        ?>
                            <div class="home-hero-badge<?php echo $light ? ' light' : ''; ?><?php echo !empty($badge['stat']) || !empty($badge_sub) ? ' stat' : ''; ?>">
                                <span class="badge-text"><?php echo wp_kses_post($badge_text); ?></span>
                                <?php if ($badge_sub) : ?><span class="badge-sub"><?php echo wp_kses_post($badge_sub); ?></span><?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="home-hero-desc-block">
                    <p class="home-hero-desc"><?php echo wp_kses_post($hero_desc); ?></p>
                </div>
                <div class="home-hero-bottom">
                    <div class="home-hero-thumb">
                        <img src="<?php echo esc_url($img_main . '/hero-thumb-3116-136.png'); ?>" alt="">
                    </div>
                    <?php if (!empty($hero_checks)) : ?>
                    <div class="home-hero-check-card">
                        <?php foreach ($hero_checks as $check) : ?>
                            <div class="home-hero-check">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="10" fill="#367643"/><path d="M6 10l3 3 5-6" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span><?php echo esc_html($check['text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <a href="#request" class="home-hero-cta"><?php echo esc_html($hero_btn1); ?></a>
                    <a href="#" class="home-hero-shop-btn-mobile"><?php echo esc_html($hero_btn2); ?><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
                </div>
            </div>
        </div>
    </section>

    <section class="home-about">
        <div class="container">
            <div class="home-about-grid">
                <span class="home-about-mobile-label">Кому подходит</span>
                <div class="home-about-left">
                    <div class="home-about-text">
                        <h2 class="section-title white"><?php echo wp_kses_post($about_title); ?></h2>
                        <p class="home-about-desc"><?php echo wp_kses_post($about_desc); ?></p>
                    </div>
                    <p class="home-about-add"><?php echo wp_kses_post($about_text); ?></p>
                </div>
                <div class="home-about-visual">
                    <img src="<?php echo esc_url($about_image); ?>" alt="" class="home-about-image">
                    <?php if (!empty($about_stats)) : ?>
                    <div class="home-about-stats">
                        <?php foreach ($about_stats as $st) : ?>
                            <div class="about-stat">
                                <span class="about-stat-num"><?php echo esc_html($st['num']); ?></span>
                                <span class="about-stat-label"><?php echo wp_kses_post($st['label']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="home-directions">
        <div class="container">
            <div class="section-header home-directions-header">
                <h2 class="section-title">
                    <span class="directions-copy-desktop">Решения для разных<br><span class="text-green">направлений медицины</span></span>
                    <span class="directions-copy-mobile">Помогаем выстроить систему <span class="text-green">инфекционного контроля</span></span>
                </h2>
                <span class="section-label"><span class="directions-copy-desktop"><?php echo esc_html($dir_subtitle); ?></span><span class="directions-copy-mobile">Что входит</span></span>
            </div>
            <?php if (!empty($directions)) : ?>
            <div class="directions-grid">
                <?php foreach ($directions as $dir) :
                    $large = !empty($dir['large']);
                    $link = !empty($dir['link']) ? $dir['link'] : '#';
                ?>
                    <a href="<?php echo esc_url($link); ?>" class="direction-card<?php echo $large ? ' large' : ''; ?>" style="background-image:url('<?php echo esc_url($dir['image'] ?: $img_main . '/главная-1440-4.png'); ?>')">
                        <span class="direction-overlay"></span>
                        <span class="direction-title"><?php echo esc_html($dir['title']); ?></span>
                        <span class="direction-arrow">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="home-audience">
        <div class="container">
            <div class="home-audience-grid">
                <div class="audience-left">
                    <span class="section-label"><?php echo esc_html($aud_subtitle); ?></span>
                    <h2 class="section-title white"><?php echo wp_kses_post($aud_title); ?></h2>
                </div>
                <?php if (!empty($audience_items)) : ?>
                <ul class="audience-list">
                    <?php foreach ($audience_items as $item) : ?>
                        <li>
                            <?php if (!empty($item['icon'])) : ?><img src="<?php echo esc_url($item['icon']); ?>" alt="" width="40" height="40"><?php endif; ?>
                            <span><?php echo esc_html($item['text']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="home-tasks">
        <div class="container">
            <h2 class="section-title">Не просто поставляем оборудование,<br><span class="text-green">а решаем задачи клиники</span></h2>
            <?php if (!empty($tasks)) : ?>
            <div class="tasks-grid">
                <?php foreach ($tasks as $task) :
                    $task_link = !empty($task['link']) ? $task['link'] : '#';
                ?>
                    <a href="<?php echo esc_url($task_link); ?>" class="task-card" style="background-image:url('<?php echo esc_url($task['image'] ?: $img_main . '/104-0.png'); ?>')">
                        <span class="task-overlay"></span>
                        <span class="task-num"><?php echo esc_html($task['num']); ?></span>
                        <span class="task-title"><?php echo esc_html($task['title']); ?></span>
                        <span class="task-arrow">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="home-projects">
        <div class="container">
            <div class="home-projects-header">
                <h2 class="section-title"><?php echo wp_kses_post($projects_title); ?></h2>
                <a href="#" class="btn btn-primary projects-btn-desktop"><?php echo esc_html($projects_btn); ?></a>
            </div>
            <?php if (!empty($projects)) : ?>
            <div class="home-projects-slider projects-slider">
                <button class="slider-arrow prev" aria-label="Предыдущие проекты"></button>
                <div class="project-slide active">
                    <div class="projects-grid">
                        <?php foreach ($projects as $project) :
                            $project_link = !empty($project['link']) ? $project['link'] : '#';
                            $project_cat = (string) $project['cat'];
                        ?>
                            <a href="<?php echo esc_url($project_link); ?>" class="project-card">
                                <div class="project-image">
                                    <img src="<?php echo esc_url($project['image'] ?: $img_main . '/67-0.png'); ?>" alt="">
                                </div>
                                <div class="project-body">
                                    <span class="project-cat"><?php echo esc_html($project_cat); ?></span>
                                    <h3 class="project-title"><?php echo esc_html($project['title']); ?></h3>
                                    <p class="project-desc"><?php echo wp_kses_post($project['desc']); ?></p>
                                </div>
                                <span class="project-arrow">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="slider-arrow next" aria-label="Следующие проекты"></button>
            </div>
            <?php endif; ?>
            <a href="#" class="btn btn-primary projects-btn-mobile"><?php echo esc_html($projects_btn); ?></a>
        </div>
    </section>

    <section class="home-categories">
        <div class="container">
            <div class="categories-layout">
                <h2 class="section-title"><?php echo wp_kses_post($cat_title); ?></h2>
                <?php if (!empty($categories)) : ?>
                <div class="categories-grid">
                <?php foreach ($categories as $cat) :
                    $cat_link = !empty($cat['link']) ? $cat['link'] : '#';
                ?>
                    <a href="<?php echo esc_url($cat_link); ?>" class="category-card">
                        <span class="category-num"><?php echo esc_html($cat['num']); ?></span>
                        <span class="category-image">
                            <img src="<?php echo esc_url($cat['image'] ?: $img_main . '/cat-diagnostic.png'); ?>" alt="<?php echo esc_attr($cat['title']); ?>">
                        </span>
                        <span class="category-title"><?php echo esc_html($cat['title']); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="home-steps">
        <div class="container">
            <div class="steps-layout">
                <span class="section-label steps-label"><?php echo esc_html($steps_subtitle); ?></span>
                <div class="steps-header">
                    <h2 class="section-title"><?php echo wp_kses_post(str_replace('до поставки', '<span class="text-green">до поставки</span>', wp_strip_all_tags($steps_title))); ?></h2>
                </div>
                <div class="steps-cards">
                    <?php foreach ($steps as $i => $step) :
                        $is_last = ($i === count($steps) - 1);
                        if ($is_last) : ?>
                            <div class="step-card step-card-mobile" style="--step-bg: url('<?php echo esc_url($steps_image); ?>');">
                                <span class="step-num"><?php echo esc_html($step['num']); ?></span>
                                <span class="step-title"><?php echo esc_html($step['title']); ?></span>
                            </div>
                        <?php else : ?>
                            <div class="step-card">
                                <span class="step-num"><?php echo esc_html($step['num']); ?></span>
                                <span class="step-title"><?php echo esc_html($step['title']); ?></span>
                            </div>
                        <?php endif;
                    endforeach; ?>
                </div>
                <div class="steps-image-wrap">
                    <img src="<?php echo esc_url($steps_image); ?>" alt="" class="steps-image">
                    <?php if (!empty($steps[4])) : ?>
                    <div class="step-image-card">
                        <span class="step-num"><?php echo esc_html($steps[4]['num']); ?></span>
                        <span class="step-title"><?php echo esc_html($steps[4]['title']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="home-partners">
        <div class="container">
            <h2 class="section-title center">Работаем с ведущими производителями<br><span class="text-green">медицинского оборудования</span></h2>
            <?php if (!empty($partners)) : ?>
            <div class="partners-grid">
                <?php foreach ($partners as $partner) :
                    $partner_link = !empty($partner['link']) ? $partner['link'] : '#';
                ?>
                    <a href="<?php echo esc_url($partner_link); ?>" class="partner-card">
                        <div class="partner-logo">
                            <img src="<?php echo esc_url($partner['logo'] ?: $img_main . '/662-0.png'); ?>" alt="<?php echo esc_attr($partner['name']); ?>">
                        </div>
                        <h3 class="partner-name"><?php echo esc_html($partner['name']); ?></h3>
                        <p class="partner-desc"><?php echo wp_kses_post($partner['desc']); ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="home-testimonials">
        <div class="container">
            <div class="testimonials-layout">
                <div class="testimonials-intro">
                    <h2 class="section-title"><span class="text-green"><?php echo esc_html($test_title_first); ?></span> <span><?php echo esc_html($test_title_rest); ?></span></h2>
                </div>
            <?php if (!empty($testimonials)) : ?>
                <div class="testimonials-content">
                    <span class="section-label"><?php echo esc_html($test_subtitle); ?></span>
                    <div class="testimonials-grid">
                <?php foreach ($testimonials as $test) :
                    $initial = mb_substr($test['name'], 0, 1);
                    $color = !empty($test['color']) ? $test['color'] : '#315046';
                ?>
                    <div class="testimonial-card">
                        <div class="testimonial-author">
                            <span class="testimonial-avatar" style="background-color:<?php echo esc_attr($color); ?>">
                                <img src="<?php echo esc_url($img_main . '/10-2.png'); ?>" alt="">
                                <span><?php echo esc_html($initial); ?></span>
                            </span>
                            <div class="testimonial-meta">
                                <strong><?php echo esc_html($test['name']); ?></strong>
                                <span><?php echo esc_html($test['position']); ?></span>
                            </div>
                        </div>
                        <p class="testimonial-text"><?php echo wp_kses_post($test['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
                    <div class="testimonials-dots" aria-hidden="true">
                        <?php foreach ($testimonials as $i => $_test) : ?>
                            <span class="testimonials-dot <?php echo $i === 0 ? 'active' : ''; ?>"></span>
                        <?php endforeach; ?>
                    </div>
            <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="home-request" id="request">
        <div class="container">
            <div class="request-grid">
                <svg class="request-plus" width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M16 4v24M4 16h24" stroke="currentColor" stroke-width="6" stroke-linecap="round"/></svg>
                <div class="request-text">
                    <h2 class="section-title white">
                        <span class="request-copy-desktop"><?php echo wp_kses_post($form_title); ?></span>
                        <span class="request-copy-mobile">Подберём оборудование<br><em>для вашей лаборатории</em></span>
                    </h2>
                    <p>
                        <span class="request-copy-desktop"><?php echo wp_kses_post($form_desc); ?></span>
                        <span class="request-copy-mobile">Оставьте заявку и получите консультацию специалиста по оснащению лабораторий</span>
                    </p>
                </div>
                <div class="request-form-wrap">
                    <?php
                    trimed_render_contact_form(array(
                        'class'              => 'home-request-form',
                        'layout'             => 'rows',
                        'fields'             => array('name', 'phone', 'organization', 'comment'),
                        'flag_url'           => $img_main . '/197-0.png',
                        'button_text'        => $form_btn,
                        'button_class'       => 'btn btn-primary request-submit',
                        'button_mobile_text' => 'Отправить',
                    ));
                    ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
