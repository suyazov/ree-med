<?php
/*
Template Name: Дезинфекция
*/
get_header();

$img_dir = get_template_directory_uri() . '/assets/img';

function dis_image_url($field, $fallback) {
    return trimed_image_field($field, $fallback);
}
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
                $hero_title = preg_replace('/(<\/span><\/span>)\s+и(.*)$/', '$1<br><span class="hero-title-last">и&nbsp;инфекционного&nbsp;контроля</span>', $hero_title);
                ?>
                <h1 class="hero-title"><?php echo wp_kses_post($hero_title); ?></h1>
                <div class="hero-image-wrap">
                    <img src="<?php echo esc_url(dis_image_url('hero_image', $img_dir . '/disinfection-hero-main.png')); ?>" alt="Дезинфекция" class="hero-image">
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
                    <p class="hero-desc"><?php echo wp_kses_post(get_field('hero_desc') ?: 'Подбираем дезинфицирующие средства, оборудование и расходные материалы для медицинских учреждений, стоматологий, лабораторий и организаций различных сфер деятельности'); ?></p>
                    <div class="hero-features">
                        <?php
                        $hero_features = get_field('hero_features');
                        if (!$hero_features) {
                            $hero_features = array(
                                array('icon' => $img_dir . '/disinfection-hero-icon-1.png', 'text' => 'Широкий выбор дезинфицирующих средств'),
                                array('icon' => $img_dir . '/disinfection-hero-icon-2.png', 'text' => 'Консультации по подбору решений'),
                                array('icon' => $img_dir . '/disinfection-hero-icon-3.png', 'text' => 'Поставка со склада в Чите'),
                                array('icon' => $img_dir . '/disinfection-hero-icon-4.png', 'text' => 'Оборудование для стерилизации и обработки'),
                            );
                        }
                        foreach ($hero_features as $feature) :
                            $icon = !empty($feature['icon']) ? $feature['icon'] : get_template_directory_uri() . '/assets/img/hero-icon-1.png';
                        ?>
                            <div class="hero-feature"><img src="<?php echo esc_url($icon); ?>" alt=""><span><?php echo wp_kses_post($feature['text']); ?></span></div>
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
                        array('title' => 'Стоматологии', 'style' => 'image', 'image' => $img_dir . '/disinfection-audience-stomatology.png'),
                        array('title' => 'Лаборатории', 'style' => 'image', 'image' => $img_dir . '/disinfection-audience-laboratory.png'),
                        array('title' => 'Больницы и поликлиники', 'style' => 'default'),
                        array('title' => 'Салоны красоты и косметологии', 'style' => 'default'),
                        array('title' => 'Санатории и реабилитационные центры', 'style' => 'green'),
                        array('title' => 'Предприятия и организации', 'style' => 'image', 'image' => $img_dir . '/disinfection-audience-enterprise.png'),
                        array('title' => 'Образовательные учреждения', 'style' => 'green'),
                        array('title' => 'Еще можно добавить', 'style' => 'default'),
                        array('title' => 'Еще можно добавить', 'style' => 'green'),
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
                        <?php if (($style === 'default' || $style === 'gray') && !empty($card['image'])) : ?>
                            <img src="<?php echo esc_url($card['image']); ?>" alt="" class="audience-card-img" style="position:absolute; right:0; bottom:0; width:80px; height:70px; object-fit:cover; opacity:1;">
                        <?php endif; ?>
                        <h3><?php echo wp_kses_post($card['title']); ?></h3>
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
                    $supplies_title = str_replace('Все для организации', '<span class="supplies-title-line">Все для организации</span>', $supplies_title);
                    $supplies_title = str_replace('инфекционного контроля', '<span class="text-green supplies-title-line">инфекционного контроля</span>', $supplies_title);
                    $supplies_title = str_replace('</span> <span class="text-green supplies-title-line">', '</span><br><span class="text-green supplies-title-line">', $supplies_title);
                    ?>
                    <h2 class="section-title"><?php echo wp_kses_post($supplies_title); ?></h2>
                </div>
                <div class="supplies-diagram">
                    <div class="supplies-center"><img src="<?php echo esc_url(dis_image_url('supplies_center_image', $img_dir . '/disinfection-supplies-center.png')); ?>" alt=""></div>
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
                            array('text' => 'Контейнеры для дезинфекции'),
                            array('text' => 'Автоклавы и стерилизационное оборудование'),
                            array('text' => 'Средства для обработки рук'),
                            array('text' => 'Дезинфицирующие салфетки'),
                            array('text' => 'Антисептики'),
                            array('text' => 'Средства для обработки эндоскопов'),
                            array('text' => 'Упаковочные материалы для стерилизации'),
                            array('text' => 'Рециркуляторы и обеззараживатели воздуха'),
                        );
                        if (!$supplies_items || count($supplies_items) < 11) {
                            $supplies_items = $supplies_defaults;
                        }
                        foreach ($supplies_items as $item) :
                        ?>
                            <div class="supply-item"><span class="dot"></span><span class="supply-text"><?php echo wp_kses_post($item['text']); ?></span></div>
                        <?php endforeach; ?>
                    </div>
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
                        array('image' => $img_dir . '/disinfection-included-1.png', 'number' => '1', 'title' => 'Анализ потребностей учреждения'),
                        array('image' => $img_dir . '/disinfection-included-2.png', 'number' => '2', 'title' => 'Подбор дезсредств под задачи'),
                        array('image' => $img_dir . '/disinfection-included-3.png', 'number' => '3', 'title' => 'Подбор оборудования'),
                        array('image' => $img_dir . '/disinfection-included-4.png', 'number' => '4', 'title' => 'Расчет потребности расходных материалов'),
                        array('image' => $img_dir . '/disinfection-included-5.png', 'number' => '5', 'title' => 'Консультации специалистов'),
                        array('image' => $img_dir . '/disinfection-included-6.png', 'number' => '6', 'title' => 'Поставка продукции'),
                        array('image' => $img_dir . '/disinfection-included-7.png', 'number' => '7', 'title' => 'Сопровождение и поддержка'),
                        array('is_green' => true, 'title' => $green_text),
                    );
                }
                foreach ($included_cards as $card) :
                    if (!empty($card['is_green'])) :
                ?>
                    <div class="included-card green-wide">
                        <p><?php echo wp_kses_post($card['title']); ?></p>
                    </div>
                <?php else : ?>
                    <div class="included-card">
                        <img src="<?php echo esc_url(!empty($card['image']) ? $card['image'] : get_template_directory_uri() . '/assets/img/what-included-1.png'); ?>" alt="">
                        <span class="num"><?php echo esc_html($card['number']); ?></span>
                        <h3><?php echo wp_kses_post($card['title']); ?></h3>
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
                    <?php
                    $tasks_title = get_field('tasks_title') ?: 'С чем к нам обращаются чаще всего';
                    if (wp_strip_all_tags($tasks_title) === 'С чем к нам обращаются чаще всего') {
                        $tasks_title = 'С чем к нам<br><em>обращаются</em><br>чаще всего';
                    }
                    ?>
                    <h2><?php echo wp_kses_post($tasks_title); ?></h2>
                </div>
                <div class="tasks-list">
                    <?php
                    $tasks_list = get_field('tasks_list');
                    if (!$tasks_list) {
                        $tasks_list = array(
                            array('icon' => $img_dir . '/disinfection-task-icon-1.png', 'text' => 'Оснащение нового медицинского кабинета'),
                            array('icon' => $img_dir . '/disinfection-task-icon-2.png', 'text' => 'Подбор дезинфицирующих средств'),
                            array('icon' => $img_dir . '/disinfection-task-icon-3.png', 'text' => 'Оснащение стерилизационной'),
                            array('icon' => $img_dir . '/disinfection-task-icon-4.png', 'text' => 'Подготовка к лицензированию'),
                            array('icon' => $img_dir . '/disinfection-task-icon-5.png', 'text' => 'Замена используемых средств'),
                            array('icon' => $img_dir . '/disinfection-task-icon-6.png', 'text' => 'Подбор рециркуляторов и обеззараживателей'),
                            array('icon' => $img_dir . '/disinfection-task-icon-7.png', 'text' => 'Организация инфекционного контроля в учреждении'),
                        );
                    }
                    foreach ($tasks_list as $task) :
                        $icon = !empty($task['icon']) ? $task['icon'] : get_template_directory_uri() . '/assets/img/task-icon-1.png';
                    ?>
                        <div class="task-item"><img src="<?php echo esc_url($icon); ?>" alt=""><span><?php echo wp_kses_post($task['text']); ?></span></div>
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
                    // Figma: first two words green on first line, the rest black on second line.
                    $why_title = preg_replace('/^(\S+\s+\S+)(.*)$/', '<span class="text-green">$1</span><br>$2', $why_title);
                    ?>
                    <h2 class="section-title"><?php echo wp_kses_post($why_title); ?></h2>
            </div>
            <div class="why-grid">
                <div class="why-image-card" style="background-image:url('<?php echo esc_url(dis_image_url('why_main_image', $img_dir . '/disinfection-why-main.png')); ?>')">
                    <div class="why-stats">
                        <div class="why-stat glass"><strong>20+ лет</strong><span>работы в медицинской сфере</span></div>
                        <div class="why-stat green"><strong>5000+</strong><span>позиций оборудования в наличии</span></div>
                    </div>
                </div>
                <div class="why-info-card">
                    <?php trimed_render_plus_svg('why-plus', 36, 'currentColor', 3, 4); ?>
                    <h3>Работа с государственными и частными учреждениями</h3>
                </div>
                <div class="why-warehouse-card" style="background-image:url('<?php echo esc_url(dis_image_url('why_warehouse_image', $img_dir . '/disinfection-warehouse.png')); ?>')">
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
                        <div class="why-feature"><span class="check"></span><span><?php echo wp_kses_post($feature['text']); ?></span></div>
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
                <p class="section-desc"><?php echo wp_kses_post(get_field('projects_desc') ?: 'За время работы мы реализовали проекты по оснащению медицинских кабинетов и центров в Забайкальском крае. Мы понимаем специфику региона, требования врачей и реальные условия работы.'); ?></p>
            </div>
            <?php
            $projects = get_field('projects_slides');
            if (empty($projects)) {
                $projects = array(
                    array(
                        'num' => '01.',
                        'title' => 'Стоматология «Дента-Профи» (г. Чита)',
                        'task' => 'Полное оснащение двух стоматологических кабинетов и стерилизационной комнаты под ключ для запуска новой клиники. Требовалось обеспечить соответствие санитарным нормам, организовать централизованную подачу воздуха и эффективную систему инфекционного контроля.',
                        'equipment' => 'Стоматологические установки (2 шт.), компрессорная станция, автоклав, упаковочные материалы для стерилизации, рециркулятор воздуха, дезинфицирующие средства, контейнеры для дезинфекции.',
                        'result' => 'Клиника введена в эксплуатацию в запланированные сроки. Все кабинеты укомплектованы, стерилизационная функционирует в полном объёме, соблюдены требования Роспотребнадзора. Персонал обеспечен всем необходимым для безопасной работы.',
                        'image' => $img_dir . '/disinfection-project-1.png',
                    ),
                    array(
                        'num' => '02.',
                        'title' => 'Медицинский центр «Забайкалье» (г. Чита)',
                        'task' => 'Комплексное оснащение процедурных кабинетов и стерилизационной зоны для многопрофильного медицинского центра. Задача включала подбор дезинфицирующих средств, оборудования для стерилизации и систем хранения.',
                        'equipment' => 'Автоклав класса B, ультразвуковая мойка, рециркуляторы воздуха, дезинфицирующие средства, контейнеры и упаковочные материалы для стерилизации.',
                        'result' => 'Центр получил полный комплект оборудования и расходных материалов в соответствии с действующими санитарными нормами. Персонал прошёл консультацию по эксплуатации оборудования.',
                        'image' => $img_dir . '/disinfection-project-2.png',
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
                                            <div><strong>Задача клиента</strong><p><?php echo wp_kses_post($project['task']); ?></p></div>
                                            <div><strong>Поставленное оборудование и материалы</strong><p><?php echo wp_kses_post($project['equipment']); ?></p></div>
                                        </div>
                                        <div class="project-result">
                                            <strong>Результат</strong>
                                            <p><?php echo wp_kses_post($project['result']); ?></p>
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
                    $partners_title = str_replace('производителями', '<br><span class="text-green">производителями</span>', $partners_title);
                    ?>
                    <h2 class="section-title partners-title"><?php echo wp_kses_post($partners_title); ?></h2>
            </div>
            <div class="partners-grid">
                <?php
                $partners = get_field('partners');
                if (!$partners) {
                    $partners = array(
                        array('logo' => $img_dir . '/disinfection-partner-1.png', 'name' => 'ДеЗиЛаб', 'desc' => 'Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.'),
                        array('logo' => $img_dir . '/disinfection-partner-2.png', 'name' => 'ДеЗиЛаб', 'desc' => 'Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.'),
                        array('logo' => $img_dir . '/disinfection-partner-3.png', 'name' => 'ДеЗиЛаб', 'desc' => 'Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.'),
                    );
                }
                foreach ($partners as $partner) :
                    $logo = !empty($partner['logo']) ? $partner['logo'] : get_template_directory_uri() . '/assets/img/partner-1.png';
                ?>
                    <div class="partner-card"><img src="<?php echo esc_url($logo); ?>" alt=""><h3><?php echo wp_kses_post($partner['name']); ?></h3><p><?php echo wp_kses_post($partner['desc']); ?></p></div>
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
            $faq_description = get_field('faq_description') ?: 'Ответы на популярные вопросы о дезинфекции, подборе оборудования и организации инфекционного контроля';
            ?>
            <div class="faq-header">
                <h2 class="section-title"><?php echo wp_kses_post($faq_title); ?></h2>
                <p class="faq-description"><?php echo wp_kses_post($faq_description); ?></p>
            </div>
            <div class="faq-grid">
                <?php
                $faq_items = get_field('faq_items');
                if (!$faq_items) {
                    $faq_items = array(
                        array('question' => 'Какие дезсредства выбрать для стоматологии?', 'answer' => '', 'is_open' => false),
                        array('question' => 'Как подобрать рециркулятор?', 'answer' => '', 'is_open' => false),
                        array('question' => 'Какие средства подходят для обработки инструментов?', 'answer' => '', 'is_open' => false),
                        array('question' => 'Какие документы предоставляются на продукцию?', 'answer' => '', 'is_open' => false),
                        array('question' => 'Есть ли товары в наличии в Чите?', 'answer' => 'Да, в Чите есть склад, и товары имеются в наличии — более 5000 позиций. Осуществляется поставка непосредственно со склада в Чите.', 'is_open' => true),
                    );
                }
                // Desktop layout as in Figma: first three questions in the left column,
                // the remaining questions in the right column.
                $faq_positions = array();
                $faq_left_count = (int) ceil(count($faq_items) / 2);
                foreach ($faq_items as $pos_i => $pos_item) {
                    $column = $pos_i < $faq_left_count ? 1 : 2;
                    $row = $pos_i < $faq_left_count ? $pos_i + 1 : $pos_i - $faq_left_count + 1;
                    $faq_positions[$pos_i] = 'grid-row:' . $row . ';grid-column:' . $column . ';';
                }
                $faq_icon_svg = '<svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.25L5 5.25L9 1.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
                foreach ($faq_items as $i => $item) :
                    $has_answer = !empty($item['answer']);
                    $active_class = !empty($item['is_open']) && $has_answer ? ' active' : '';
                    $position_style = isset($faq_positions[$i]) ? esc_attr($faq_positions[$i]) : '';
                ?>
                    <div class="faq-item<?php echo esc_attr($active_class); ?><?php echo $has_answer ? ' has-answer' : ''; ?>" style="<?php echo $position_style; ?>">
                        <span><?php echo wp_kses_post($item['question']); ?></span><span class="faq-icon"><?php echo $faq_icon_svg; ?></span>
                        <?php if (!empty($item['answer'])) : ?>
                            <p><?php echo wp_kses_post($item['answer']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Application -->
    <section class="home-request disinfection-request" id="application">
        <div class="container">
            <div class="request-grid">
                <svg class="request-plus" width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M16 4v24M4 16h24" stroke="currentColor" stroke-width="6" stroke-linecap="round"/></svg>
                <div class="request-text">
                    <?php
                    $application_title = get_field('application_title') ?: 'Подберём решение для вашего учреждения';
                    if (trim(wp_strip_all_tags($application_title)) === 'Подберём решение для вашего учреждения') {
                        $application_title = 'Подберём решение<br><em>для вашего учреждения</em>';
                    } else {
                        $application_title = str_replace('решение ', 'решение<br>', $application_title);
                    }
                    ?>
                    <h2 class="section-title white"><?php echo wp_kses_post($application_title); ?></h2>
                    <p><?php echo wp_kses_post(get_field('application_desc') ?: 'Оставьте заявку, и специалист поможет подобрать оборудование, дезинфицирующие средства и расходные материалы под ваши задачи.'); ?></p>
                </div>
                <div class="request-form-wrap">
                    <form id="contact-form" class="home-request-form">
                        <div class="form-row">
                            <label class="form-field">
                                <span class="form-field-label">Ваше имя</span>
                                <input type="text" name="name" placeholder="Иванов Николай Сергеевич" required>
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="form-field form-field-phone">
                                <span class="form-field-label">Телефон</span>
                                <img src="<?php echo esc_url($img_dir . '/main/197-0.png'); ?>" alt="" class="phone-flag">
                                <input type="tel" name="phone" placeholder="+7 (999) 999-99-99" required>
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="form-field">
                                <span class="form-field-label">Организация</span>
                                <input type="text" name="organization" placeholder="Название организации">
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="form-field">
                                <span class="form-field-label">Комментарий</span>
                                <textarea name="comment" rows="3" placeholder="Ваш комментарий"></textarea>
                            </label>
                        </div>
                        <div class="form-row form-agree">
                            <label class="checkbox-label">
                                <input type="checkbox" name="agree" value="1" required>
                                <span>Оставляя заявку, я соглашаюсь с условиями <a href="#">Политики обработки персональных данных</a></span>
                            </label>
                        </div>
                        <?php
                        $application_button_text = get_field('application_button_text') ?: 'Получить консультацию';
                        if (trim($application_button_text) === 'Отправить') {
                            $application_button_text = 'Получить консультацию';
                        }
                        ?>
                        <button type="submit" class="btn btn-primary request-submit"><?php echo esc_html($application_button_text); ?></button>
                        <div class="form-message"></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
