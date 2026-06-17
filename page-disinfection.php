<?php
/*
Template Name: Дезинфекция
*/
get_header();
?>

<main class="disinfection-page">

    <!-- Hero -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-grid">
                <?php
                $hero_title = get_field('hero_title') ?: 'Комплексные решения для дезинфекции и инфекционного контроля';
                $hero_title = str_replace('решения ', 'решения<br>', $hero_title);
                $hero_title = str_replace('для дезинфекции', '<span class="hero-title-line">для <span class="text-green">дезинфекции</span></span>', $hero_title);
                $hero_title = str_replace('для дизенфекции', '<span class="hero-title-line">для <span class="text-green">дизенфекции</span></span>', $hero_title);
                $hero_title = preg_replace('/(<\/span><\/span>)\s+и/', '$1<br>и', $hero_title);
                ?>
                <h1 class="hero-title"><?php echo wp_kses_post($hero_title); ?></h1>
                <div class="hero-image-wrap">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero-image.png" alt="Дезинфекция" class="hero-image">
                    <div class="hero-badges">
                        <?php
                        $hero_badges = get_field('hero_badges');
                        if (!$hero_badges) {
                            $hero_badges = array(
                                array('text' => 'Безопасность персонала<br>и пациентов'),
                                array('text' => 'Соблюдение санитарных<br>требований'),
                                array('text' => 'Эффективная система инфекционного контроля'),
                            );
                        }
                        foreach ($hero_badges as $index => $badge) :
                            $badge_text = $badge['text'];
                            if ($index === 2) {
                                $badge_text = str_replace('<br>', ' ', $badge_text);
                                $badge_text = str_replace('<br/>', ' ', $badge_text);
                                $badge_text = str_replace('<br />', ' ', $badge_text);
                            }
                        ?>
                            <div class="hero-badge"><span class="check"></span> <?php echo wp_kses_post($badge_text); ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="hero-body">
                    <p class="hero-desc"><?php echo esc_html(get_field('hero_desc') ?: 'Подбираем дезинфицирующие средства, оборудование и расходные материалы для медицинских учреждений, стоматологий, лабораторий и организаций различных сфер деятельности'); ?></p>
                    <div class="hero-features">
                        <?php
                        $hero_features = get_field('hero_features');
                        if (!$hero_features) {
                            $hero_features = array(
                                array('icon' => get_template_directory_uri() . '/assets/img/hero-icon-1.png', 'text' => 'Широкий выбор дезинфицирующих средств'),
                                array('icon' => get_template_directory_uri() . '/assets/img/hero-icon-2.png', 'text' => 'Консультации по подбору решений'),
                                array('icon' => get_template_directory_uri() . '/assets/img/hero-icon-3.png', 'text' => 'Поставка со склада в Чите'),
                                array('icon' => get_template_directory_uri() . '/assets/img/hero-icon-4.png', 'text' => 'Оборудование для стерилизации и обработки'),
                            );
                        }
                        foreach ($hero_features as $feature) :
                            $icon = !empty($feature['icon']) ? $feature['icon'] : get_template_directory_uri() . '/assets/img/hero-icon-1.png';
                        ?>
                            <div class="hero-feature"><img src="<?php echo esc_url($icon); ?>" alt=""><span><?php echo esc_html($feature['text']); ?></span></div>
                        <?php endforeach; ?>
                    </div>
                    <a href="#application" class="btn btn-primary hero-btn-main"><?php echo esc_html(get_field('hero_button_text') ?: 'Подобрать решение'); ?></a>
                    <a href="#application" class="btn btn-secondary hero-btn-consult">Получить консультацию</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Audience -->
    <section class="audience-section">
        <div class="container">
            <div class="audience-inner">
                <div class="section-header">
                    <span class="section-label"><?php echo esc_html(get_field('audience_subtitle') ?: 'Кому подходит'); ?></span>
                    <?php
                    $audience_title = get_field('audience_title') ?: 'Работаем с учреждениями разных направлений';
                    $audience_title = str_replace('разных направлений', '<span class="text-green">разных направлений</span>', $audience_title);
                    ?>
                    <h2 class="section-title"><?php echo wp_kses_post($audience_title); ?></h2>
                </div>
                <div class="audience-grid">
                <?php
                $audience_cards = get_field('audience_cards');
                if (!$audience_cards) {
                    $audience_cards = array(
                        array('title' => 'Медицинские центры', 'style' => 'default'),
                        array('title' => 'Стоматологии', 'style' => 'image', 'image' => get_template_directory_uri() . '/assets/img/card-stomatology.png'),
                        array('title' => 'Больницы и поликлиники', 'style' => 'gray'),
                        array('title' => 'Лаборатории', 'style' => 'image', 'image' => get_template_directory_uri() . '/assets/img/card-lab.png'),
                        array('title' => 'Санатории и реабилитационные центры', 'style' => 'green'),
                        array('title' => 'Образовательные учреждения', 'style' => 'green'),
                        array('title' => 'Салоны красоты и косметологии', 'style' => 'default'),
                        array('title' => 'Предприятия и организации', 'style' => 'image', 'image' => get_template_directory_uri() . '/assets/img/card-enterprise.png'),
                        array('title' => 'Ещё можно добавить', 'style' => 'default'),
                        array('title' => 'Ещё можно добавить', 'style' => 'image-overlay', 'image' => get_template_directory_uri() . '/assets/img/card-medcenter.png'),
                    );
                }
                foreach ($audience_cards as $card) :
                    $style = !empty($card['style']) ? $card['style'] : 'default';
                    $classes = 'audience-card';
                    if ($style === 'green') $classes .= ' green';
                    if ($style === 'gray') $classes .= ' gray';
                    if ($style === 'image' || $style === 'image-overlay') {
                        if (!empty($card['image'])) $classes .= ' has-image';
                        $classes .= ' ' . esc_attr($style);
                    }
                    $bg = (($style === 'image' || $style === 'image-overlay') && !empty($card['image'])) ? ' style="background-image:url(\'' . esc_url($card['image']) . '\')"' : '';
                ?>
                    <div class="<?php echo esc_attr($classes); ?>"<?php echo $bg; ?>>
                        <?php if ($style === 'image' || $style === 'image-overlay') echo '<span class="overlay"></span>'; ?>
                        <h3><?php echo esc_html($card['title']); ?></h3>
                        <svg class="arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 17L17 7M17 7H9M17 7V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                <?php endforeach; ?>
            </div>
            </div>
        </div>
    </section>

    <!-- Supplies -->
    <section class="supplies-section">
        <div class="container">
            <div class="supplies-box">
                <div class="section-header">
                    <span class="section-label"><?php echo esc_html(get_field('supplies_subtitle') ?: 'Что мы поставляем'); ?></span>
                    <?php
                    $supplies_title = get_field('supplies_title') ?: 'Все для организации инфекционного контроля';
                    $supplies_title = str_replace('инфекционного контроля', '<span class="text-green">инфекционного контроля</span>', $supplies_title);
                    ?>
                    <h2 class="section-title"><?php echo wp_kses_post($supplies_title); ?></h2>
                </div>
                <div class="supplies-center"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/supplies-center.png" alt=""></div>
                <div class="supplies-rings">
                    <div class="ring ring-1"></div>
                    <div class="ring ring-2"></div>
                    <div class="ring ring-3"></div>
                </div>
                <div class="supplies-items">
                    <?php
                    $supplies_items = get_field('supplies_items');
                    $supplies_defaults = array(
                        array('text' => 'Дезинфицирующие средства'),
                        array('text' => 'Средства для обработки поверхностей'),
                        array('text' => 'Средства для стерилизации инструментов'),
                        array('text' => 'Средства для обработки эндоскопов'),
                        array('text' => 'Контейнеры для дезинфекции'),
                        array('text' => 'Автоклавы и стерилизационное оборудование'),
                        array('text' => 'Упаковочные материалы для стерилизации'),
                        array('text' => 'Рециркуляторы и обеззараживатели воздуха'),
                        array('text' => 'Дезинфицирующие салфетки'),
                        array('text' => 'Антисептики'),
                        array('text' => 'Средства для обработки рук'),
                    );
                    if (!$supplies_items || count($supplies_items) < 11) {
                        $supplies_items = $supplies_defaults;
                    }
                    foreach ($supplies_items as $item) :
                    ?>
                        <div class="supply-item"><span class="dot"></span><span class="supply-text"><?php echo esc_html($item['text']); ?></span></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- What included -->
    <section class="included-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label"><?php echo esc_html(get_field('included_subtitle') ?: 'Что входит'); ?></span>
                <?php
                    $included_title = get_field('included_title') ?: 'Помогаем выстроить систему инфекционного контроля';
                    $included_title = str_replace('инфекционного контроля', '<span class="text-green">инфекционного контроля</span>', $included_title);
                    ?>
                <h2 class="section-title"><?php echo wp_kses_post($included_title); ?></h2>
            </div>
            <div class="included-grid">
                <?php
                $included_cards = get_field('included_cards');
                if (!$included_cards) {
                    $green_text = get_field('included_card_text') ?: 'Мы помогаем подобрать решения, которые обеспечивают безопасность, удобство использования и соответствие действующим санитарным требованиям';
                    $included_cards = array(
                        array('image' => get_template_directory_uri() . '/assets/img/what-included-1.png', 'number' => '1', 'title' => 'Анализ потребностей учреждения'),
                        array('image' => get_template_directory_uri() . '/assets/img/what-included-2.png', 'number' => '2', 'title' => 'Подбор дезсредств под задачи'),
                        array('image' => get_template_directory_uri() . '/assets/img/what-included-3.png', 'number' => '3', 'title' => 'Подбор оборудования'),
                        array('image' => get_template_directory_uri() . '/assets/img/what-included-4.png', 'number' => '4', 'title' => 'Расчет потребности расходных материалов'),
                        array('image' => get_template_directory_uri() . '/assets/img/what-included-5.png', 'number' => '5', 'title' => 'Консультации специалистов'),
                        array('image' => get_template_directory_uri() . '/assets/img/what-included-6.png', 'number' => '6', 'title' => 'Поставка продукции'),
                        array('image' => get_template_directory_uri() . '/assets/img/what-included-7.png', 'number' => '7', 'title' => 'Сопровождение и поддержка'),
                        array('is_green' => true, 'title' => $green_text),
                    );
                }
                foreach ($included_cards as $card) :
                    if (!empty($card['is_green'])) :
                ?>
                    <div class="included-card green-wide">
                        <p><?php echo esc_html($card['title']); ?></p>
                    </div>
                <?php else : ?>
                    <div class="included-card">
                        <img src="<?php echo esc_url(!empty($card['image']) ? $card['image'] : get_template_directory_uri() . '/assets/img/what-included-1.png'); ?>" alt="">
                        <span class="num"><?php echo esc_html($card['number']); ?></span>
                        <h3><?php echo esc_html($card['title']); ?></h3>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Tasks -->
    <section class="tasks-section">
        <div class="container">
            <div class="tasks-grid">
                <div class="tasks-intro green-card">
                    <span class="tag"><?php echo esc_html(get_field('tasks_subtitle') ?: 'Популярные задачи клиентов'); ?></span>
                    <h2><?php echo esc_html(get_field('tasks_title') ?: 'С чем к нам обращаются чаще всего'); ?></h2>
                </div>
                <div class="tasks-list">
                    <?php
                    $tasks_list = get_field('tasks_list');
                    if (!$tasks_list) {
                        $tasks_list = array(
                            array('icon' => get_template_directory_uri() . '/assets/img/task-icon-1.png', 'text' => 'Оснащение нового медицинского кабинета'),
                            array('icon' => get_template_directory_uri() . '/assets/img/task-icon-2.png', 'text' => 'Подбор дезинфицирующих средств'),
                            array('icon' => get_template_directory_uri() . '/assets/img/task-icon-3.png', 'text' => 'Оснащение стерилизационной'),
                            array('icon' => get_template_directory_uri() . '/assets/img/task-icon-4.png', 'text' => 'Подготовка к лицензированию'),
                            array('icon' => get_template_directory_uri() . '/assets/img/task-icon-5.png', 'text' => 'Замена используемых средств'),
                            array('icon' => get_template_directory_uri() . '/assets/img/task-icon-6.png', 'text' => 'Подбор рециркуляторов и обеззараживателей'),
                            array('icon' => get_template_directory_uri() . '/assets/img/task-icon-7.png', 'text' => 'Организация инфекционного контроля в учреждении'),
                        );
                    }
                    foreach ($tasks_list as $task) :
                        $icon = !empty($task['icon']) ? $task['icon'] : get_template_directory_uri() . '/assets/img/task-icon-1.png';
                    ?>
                        <div class="task-item"><img src="<?php echo esc_url($icon); ?>" alt=""><span><?php echo esc_html($task['text']); ?></span></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Why choose -->
    <section class="why-section">
        <div class="container">
            <div class="section-header center">
                <span class="section-label"><?php echo esc_html(get_field('why_subtitle') ?: 'Почему выбирают ТриМед'); ?></span>
                    <?php
                    $why_title = get_field('why_title') ?: 'Надёжный поставщик для медицинских учреждений региона';
                    $why_title = str_replace(' для медицинских учреждений региона', ' <span class="text-green">для медицинских учреждений региона</span>', $why_title);
                    ?>
                    <h2 class="section-title"><?php echo wp_kses_post($why_title); ?></h2>
            </div>
            <div class="why-grid">
                <div class="why-image-card" style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/img/why-choose.png')">
                    <div class="why-stats">
                        <div class="why-stat glass"><strong>20+ лет</strong><span>работы в медицинской сфере</span></div>
                        <div class="why-stat green"><strong>5000+</strong><span>позиций в наличии</span></div>
                    </div>
                </div>
                <div class="why-info-card">
                    <svg class="why-plus" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 4V24M4 14H24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                    <h3>Работа с государственными и частными учреждениями</h3>
                </div>
                <div class="why-warehouse-card" style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/img/warehouse.png')">
                    <h3>Склад в Чите</h3>
                </div>
                <div class="why-features-list">
                    <?php
                    $why_features = get_field('why_features');
                    if (!$why_features) {
                        $why_features = array(
                            array('text' => 'Проверенные производители'),
                            array('text' => 'Консультационная поддержка'),
                            array('text' => 'Оперативная поставка'),
                        );
                    }
                    foreach ($why_features as $feature) :
                    ?>
                        <div class="why-feature"><span class="check"></span><span><?php echo esc_html($feature['text']); ?></span></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects -->
    <section class="projects-section">
        <div class="container">
            <div class="section-header row">
                <h2 class="section-title projects-section-title"><?php echo esc_html(get_field('projects_title') ?: 'Реализованные проекты'); ?></h2>
                <p class="section-desc"><?php echo esc_html(get_field('projects_desc') ?: 'За время работы мы реализовали проекты по оснащению медицинских кабинетов и центров в Забайкальском крае. Мы понимаем специфику региона, требования врачей и реальные условия работы.'); ?></p>
            </div>
            <?php
            $projects = get_field('projects_slides');
            if (empty($projects)) {
                $projects = array(
                    array(
                        'num' => '02.',
                        'title' => 'Стоматология «Дента-Профи» (г. Чита)',
                        'task' => 'Полное оснащение двух стоматологических кабинетов и стерилизационной комнаты под ключ для запуска новой клиники. Требовалось обеспечить соответствие санитарным нормам, организовать централизованную подачу воздуха и эффективную систему инфекционного контроля.',
                        'equipment' => 'Стоматологические установки (2 шт.), компрессорная станция, автоклав, упаковочные материалы для стерилизации, рециркулятор воздуха, дезинфицирующие средства, контейнеры для дезинфекции.',
                        'result' => 'Клиника введена в эксплуатацию в запланированные сроки. Все кабинеты укомплектованы, стерилизационная функционирует в полном объёме, соблюдены требования Роспотребнадзора. Персонал обеспечен всем необходимым для безопасной работы.',
                        'image' => get_template_directory_uri() . '/assets/img/project.png',
                    ),
                    array(
                        'num' => '03.',
                        'title' => 'Медицинский центр «Забайкалье» (г. Чита)',
                        'task' => 'Комплексное оснащение процедурных кабинетов и стерилизационной зоны для многопрофильного медицинского центра. Задача включала подбор дезинфицирующих средств, оборудования для стерилизации и систем хранения.',
                        'equipment' => 'Автоклав класса B, ультразвуковая мойка, рециркуляторы воздуха, дезинфицирующие средства, контейнеры и упаковочные материалы для стерилизации.',
                        'result' => 'Центр получил полный комплект оборудования и расходных материалов в соответствии с действующими санитарными нормами. Персонал прошёл консультацию по эксплуатации оборудования.',
                        'image' => get_template_directory_uri() . '/assets/img/warehouse.png',
                    ),
                );
            }
            $projects_count = count($projects);
            ?>
            <div class="projects-slider">
                <button class="slider-arrow prev" aria-label="Предыдущий слайд"></button>
                <div class="slides-track">
                    <?php foreach ($projects as $index => $project) : ?>
                        <div class="project-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="project-card">
                                <div class="project-card-inner">
                                    <div class="project-info">
                                        <span class="project-num"><?php echo esc_html($project['num'] ?: sprintf('%02d.', $index + 1)); ?></span>
                                        <h3><?php echo esc_html($project['title']); ?></h3>
                                        <div class="project-columns">
                                            <div><strong>Задача клиента</strong><p><?php echo esc_html($project['task']); ?></p></div>
                                            <div><strong>Поставленное оборудование и материалы</strong><p><?php echo esc_html($project['equipment']); ?></p></div>
                                        </div>
                                        <div class="project-result">
                                            <strong>Результат</strong>
                                            <p><?php echo esc_html($project['result']); ?></p>
                                        </div>
                                    </div>
                                    <div class="project-image"><img src="<?php echo esc_url($project['image']); ?>" alt=""></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="slider-arrow next" aria-label="Следующий слайд"></button>
                <div class="slider-dots">
                    <?php for ($i = 0; $i < $projects_count; $i++) : ?>
                        <button class="slider-dot <?php echo $i === 0 ? 'active' : ''; ?>" data-slide="<?php echo $i; ?>" aria-label="Перейти к слайду <?php echo $i + 1; ?>"></button>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners -->
    <section class="partners-section">
        <div class="container">
            <div class="section-header center">
                    <?php
                    $partners_title = get_field('partners_title') ?: 'Работаем с ведущими производителями';
                    $partners_title = str_replace('с ведущими', '<strong>с ведущими</strong>', $partners_title);
                    $partners_title = str_replace('производителями', '<span class="text-green">производителями</span>', $partners_title);
                    ?>
                    <h2 class="section-title partners-title"><?php echo wp_kses_post($partners_title); ?></h2>
            </div>
            <div class="partners-grid">
                <?php
                $partners = get_field('partners');
                if (!$partners) {
                    $partners = array(
                        array('logo' => get_template_directory_uri() . '/assets/img/partner-1.png', 'name' => 'ДеЗиЛаб', 'desc' => 'Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.'),
                        array('logo' => get_template_directory_uri() . '/assets/img/partner-2.png', 'name' => 'ДеЗиЛаб', 'desc' => 'Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.'),
                        array('logo' => get_template_directory_uri() . '/assets/img/partner-3.png', 'name' => 'ДеЗиЛаб', 'desc' => 'Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.'),
                    );
                }
                foreach ($partners as $partner) :
                    $logo = !empty($partner['logo']) ? $partner['logo'] : get_template_directory_uri() . '/assets/img/partner-1.png';
                ?>
                    <div class="partner-card"><img src="<?php echo esc_url($logo); ?>" alt=""><h3><?php echo esc_html($partner['name']); ?></h3><p><?php echo esc_html($partner['desc']); ?></p></div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="faq-section">
        <div class="container">
                    <?php
                    $faq_title = get_field('faq_title') ?: 'Часто задаваемые вопросы';
                    $faq_title = str_replace('вопросы', '<span class="text-green">вопросы</span>', $faq_title);
                    ?>
                    <h2 class="section-title center"><?php echo wp_kses_post($faq_title); ?></h2>
            <div class="faq-grid">
                <?php
                $faq_items = get_field('faq_items');
                if (!$faq_items) {
                    $faq_items = array(
                        array('question' => 'Какие дезсредства выбрать для стоматологии?', 'answer' => '', 'is_open' => false),
                        array('question' => 'Какие документы предоставляются на продукцию?', 'answer' => '', 'is_open' => false),
                        array('question' => 'Есть ли товары в наличии в Чите?', 'answer' => 'Да, в Чите есть склад, и товары имеются в наличии — более 5000 позиций. Осуществляется поставка непосредственно со склада в Чите.', 'is_open' => true),
                        array('question' => 'Как подобрать рециркулятор?', 'answer' => '', 'is_open' => false),
                        array('question' => 'Какие средства подходят для обработки инструментов?', 'answer' => '', 'is_open' => false),
                    );
                }
                // Desktop layout as in Figma: items flow row-wise, but the open item
                // is placed in the right column of its row to balance the columns.
                $faq_positions = array();
                $faq_pair_count = ceil(count($faq_items) / 2);
                for ($p = 0; $p < $faq_pair_count; $p++) {
                    $left_i = $p * 2;
                    $right_i = $left_i + 1;
                    $row = $p + 1;
                    $faq_positions[$left_i] = 'grid-row:' . $row . ';grid-column:1;';
                    if (isset($faq_items[$right_i])) {
                        $faq_positions[$right_i] = 'grid-row:' . $row . ';grid-column:2;';
                    }
                    if (!empty($faq_items[$left_i]['is_open']) && isset($faq_items[$right_i])) {
                        $faq_positions[$left_i] = 'grid-row:' . $row . ';grid-column:2;';
                        $faq_positions[$right_i] = 'grid-row:' . $row . ';grid-column:1;';
                    }
                }
                $faq_icon_svg = '<svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.25L5 5.25L9 1.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
                foreach ($faq_items as $i => $item) :
                    $active_class = !empty($item['is_open']) ? ' active' : '';
                    $position_style = isset($faq_positions[$i]) ? esc_attr($faq_positions[$i]) : '';
                ?>
                    <div class="faq-item<?php echo esc_attr($active_class); ?>" style="<?php echo $position_style; ?>">
                        <span><?php echo esc_html($item['question']); ?></span><span class="faq-icon"><?php echo $faq_icon_svg; ?></span>
                        <?php if (!empty($item['answer'])) : ?>
                            <p><?php echo esc_html($item['answer']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Application -->
    <section class="application-section" id="application">
        <div class="container">
            <div class="application-box">
                <div class="application-info">
                    <svg class="app-decor" width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M20 0L23.5 16.5L40 20L23.5 23.5L20 40L16.5 23.5L0 20L16.5 16.5L20 0Z" fill="#fff"/></svg>
                    <h2><?php echo esc_html(get_field('application_title') ?: 'Подберём решение для вашего учреждения'); ?></h2>
                    <p><?php echo esc_html(get_field('application_desc') ?: 'Оставьте заявку, и специалист поможет подобрать оборудование, дезинфицирующие средства и расходные материалы под ваши задачи.'); ?></p>
                </div>
                <div class="application-form-wrap">
                    <form class="application-form" id="contact-form">
                        <input type="text" name="name" placeholder="Иванов Николай Сергеевич" required>
                        <div class="phone-input"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/phone-flag.png" alt=""><input type="tel" name="phone" placeholder="+7 (999) 999-99-99" required></div>
                        <input type="text" name="organization" placeholder="Название организации">
                        <input type="text" name="comment" placeholder="Ваш комментарий">
                        <label class="form-agree"><input type="checkbox" name="agree" required><span>Оставляя заявку, я соглашаюсь с условиями Политики обработки персональных данных</span></label>
                        <button type="submit" class="btn btn-primary">Получить консультацию</button>
                        <div class="form-message"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
