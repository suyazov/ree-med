<?php
/*
Template Name: Стоматология
*/
get_header();

$img_dir = get_template_directory_uri() . '/assets/img';
$placeholder = $img_dir . '/placeholder.jpg';

$hero_title = get_field('stom_hero_title') ?: 'Оснащение<br><span class="text-green">стоматологии под ключ</span><br>в Забайкальском крае';
$hero_desc  = get_field('stom_hero_desc') ?: 'Подберём оборудование, поставим и поможем запустить кабинет без лишних затрат и ошибок';
$hero_btn   = get_field('stom_hero_button_text') ?: 'Получить консультацию';
$hero_image = trimed_image_field('stom_hero_image', $img_dir . '/stomatology-hero-main.png');
$hero_feature_image = trimed_image_field('stom_hero_feature_image', $img_dir . '/stomatology-hero-features.png');
$hero_features = trimed_repeater_field('stom_hero_features', array(
    array('text' => 'Помогаем подобрать оборудование под задачи и бюджет'),
    array('text' => 'Склад в Чите - быстрая поставка без ожидания'),
));
$hero_badge_glass_text = get_field('stom_hero_badge_glass_text') ?: 'Работаем с частными и государственными клиниками';
$hero_badge_green_num  = get_field('stom_hero_badge_green_num') ?: '5000+';
$hero_badge_green_text = get_field('stom_hero_badge_green_text') ?: 'позиций в наличии';

$audience_label = get_field('stom_audience_label') ?: 'Кому подходит';
$audience_title = get_field('stom_audience_title') ?: 'Работаем со стоматологиями <em>на разных этапах</em>';
$audience_desc  = get_field('stom_audience_desc') ?: 'Мы понимаем, что задачи у всех разные: кто-то открывается с нуля, кто-то расширяется, а кто-то просто хочет обновить оборудование.';
$audience_lead  = get_field('stom_audience_lead') ?: 'Мы будем полезны, если вы:';
$audience_cards = trimed_repeater_field('stom_audience_cards', array(
    array('text' => 'Открываете стоматологический кабинет и не знаете, какое оборудование выбрать', 'image' => $img_dir . '/stomatology-audience-2.png', 'style' => 'image'),
    array('text' => 'Расширяете клинику и добавляете новые кресла', 'image' => $img_dir . '/stomatology-audience-white-v2.png', 'style' => 'white'),
    array('text' => 'Хотите заменить устаревшее оборудование', 'image' => $img_dir . '/stomatology-audience-3.png', 'style' => 'gray'),
    array('text' => 'Хотите работать без простоев и задержек поставок', 'image' => '', 'style' => 'green'),
));
$audience_summary = get_field('stom_audience_summary') ?: 'Мы помогаем не просто купить оборудование, а сделать так, чтобы кабинет начал работать <span class="text-green">максимально эффективно за короткие сроки</span>.';

$included_title = get_field('stom_included_title') ?: 'Что входит в оснащение <span class="text-green">стоматологии</span>';
$included_label = get_field('stom_included_label') ?: 'Мы берём на себя весь процесс:';
$included_desc  = get_field('stom_included_desc') ?: "Оснащение стоматологического кабинета\xC2\xA0— это\xC2\xA0не\xC2\xA0только установка кресла. Важно учесть всё: от\xC2\xA0компрессоров до\xC2\xA0удобства работы врача.";
$included_desc = str_replace(array(' — ', ' не ', ' только ', 'от ', 'до ', ' работы', ' врача.'), array("\xC2\xA0—\xC2\xA0", "\xC2\xA0не\xC2\xA0", "\xC2\xA0только\xC2\xA0", "от\xC2\xA0", "до\xC2\xA0", "\xC2\xA0работы", "\xC2\xA0врача."), $included_desc);
$included_cards = trimed_repeater_field('stom_included_cards', array(
    array('image' => $img_dir . '/stomatology-included-1-v2.png', 'number' => '1', 'title' => 'Подбор стоматологических установок'),
    array('image' => $img_dir . '/stomatology-included-2-v2.png', 'number' => '2', 'title' => 'Компрессоры и аспирационные системы'),
    array('image' => $img_dir . '/stomatology-included-3-v2.png', 'number' => '3', 'title' => 'Стоматологические инструменты и оборудование'),
    array('image' => $img_dir . '/stomatology-included-4-v2.png', 'number' => '4', 'title' => 'Мебель и оснащение кабинета'),
    array('image' => $img_dir . '/stomatology-included-5-v2.png', 'number' => '5', 'title' => 'Поставку оборудования'),
    array('image' => $img_dir . '/stomatology-included-6-v2.png', 'number' => '6', 'title' => 'Консультации на всех этапах'),
));
$included_result_text = get_field('stom_included_result_text') ?: 'В результате вы получаете полностью готовый к работе кабинет в одном месте';

$projects_title = get_field('stom_projects_title') ?: 'Реализованные проекты';
$projects_desc  = get_field('stom_projects_desc') ?: 'Мы уже помогли оснастить стоматологические кабинеты в Забайкальском крае, как частные, так и государственные. Понимаем, какие решения подходят для региона и какие задачи стоят перед врачами.';
$projects = trimed_repeater_field('stom_projects', array(
    array(
        'image' => $img_dir . '/stomatology-project-1.png',
        'number' => '01.',
        'title' => 'Стоматология «Дента-Профи» (г. Чита)',
        'text' => 'Оснащение двух кабинетов под ключ: стоматологические установки, компрессорная, стерилизационная.',
    ),
    array(
        'image' => $img_dir . '/stomatology-project-2.png',
        'number' => '02.',
        'title' => 'Стоматологический кабинет «Улыбка Забайкалья» (г. Борзя)',
        'text' => 'Комплексное оснащение с нуля: установка, стерилизационное оборудование, цифровой визиограф, дизайн-проект и расстановка мебели.',
    ),
    array(
        'image' => $img_dir . '/stomatology-project-3.png',
        'number' => '03.',
        'title' => 'Стоматологический кабинет «Улыбка Забайкалья» (г. Борзя)',
        'text' => 'Комплексное оснащение с нуля: установка, стерилизационное оборудование, цифровой визиограф, дизайн-проект и расстановка мебели.',
    ),
    array(
        'image' => $img_dir . '/stomatology-project-4.png',
        'number' => '04.',
        'title' => 'Стоматология «Дента-Профи» (г. Чита)',
        'text' => 'Оснащение двух кабинетов под ключ: стоматологические установки, компрессорная, стерилизационная.',
    ),
));

$process_title    = get_field('stom_process_title') ?: 'Как проходит <span class="text-green">работа</span>';
$process_subtitle = get_field('stom_process_subtitle') ?: 'Мы выстроили простой и понятный процесс, чтобы вы не тратили время на разбор оборудования.';
$process_steps    = trimed_repeater_field('stom_process_steps', array(
    array('number' => '1', 'title' => 'Консультация', 'text' => 'Обсуждаем формат кабинета и задачи', 'image' => ''),
    array('number' => '2', 'title' => 'Подбор оборудования', 'text' => 'Подбираем решения под бюджет и нагрузку', 'image' => ''),
    array('number' => '3', 'title' => 'Поставка', 'text' => 'Доставляем оборудование со склада или под заказ', 'image' => ''),
    array('number' => '4', 'title' => 'Запуск', 'text' => 'Помогаем подготовить кабинет к работе', 'image' => $img_dir . '/stomatology-process-step.png'),
));
$process_image    = trimed_image_field('stom_process_image', $img_dir . '/stomatology-process.png');

$request_title  = get_field('stom_request_title') ?: 'Подберём оборудование под вашу <em>стоматологию</em>';
$request_desc   = get_field('stom_request_desc') ?: 'Оставьте заявку — свяжемся с вами и предложим решение';
$request_note   = get_field('stom_request_note') ?: 'Консультация бесплатная';
$request_button = get_field('stom_request_button_text') ?: 'Получить консультацию';

$why_title    = get_field('stom_why_title') ?: 'Почему выбирают <span class="text-green">ТриМед</span>';
$why_stats    = trimed_repeater_field('stom_why_stats', array(
    array('number' => '20+', 'text' => 'лет на рынке', 'style' => 'image'),
    array('number' => '5000+', 'text' => 'позиций оборудования', 'style' => 'gray'),
));
$why_features = trimed_repeater_field('stom_why_features', array(
    array('text' => 'Понимаем специфику стоматологий'),
    array('text' => 'Работаем с клиниками по всему краю'),
));
$why_feature_icons = array(
    '<svg viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 18h15v8H4z" stroke-linejoin="round"/><path d="M19 18v-4a2 2 0 0 1 2-2h3l5 5v5h-4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="24" r="2"/><circle cx="23" cy="24" r="2"/></svg>',
    '<svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M25 19.8157V6.50314C25 5.47813 24.375 4.56563 23.425 4.17813L13.425 0.178125C12.825 -0.0593751 12.1625 -0.0593751 11.5625 0.178125L1.5625 4.17813C0.625001 4.56563 0 5.49063 0 6.50314V19.8157C0 21.1907 1.125 22.3157 2.5 22.3157H6.25001V11.0656H18.75V22.3157H22.5C23.875 22.3157 25 21.1907 25 19.8157ZM11.25 19.8157H8.75001V22.3157H11.25V19.8157ZM13.75 16.0657H11.25V18.5657H13.75V16.0657ZM16.25 19.8157H13.75V22.3157H16.25V19.8157Z" fill="url(#paint0_linear_182_301)"/><defs><linearGradient id="paint0_linear_182_301" x1="4.31819" y1="18.0554" x2="18.2966" y2="3.07637" gradientUnits="userSpaceOnUse"><stop stop-color="#3F8D50"/><stop offset="1" stop-color="#51A462"/></linearGradient></defs></svg>',
);
$why_warehouse_title = get_field('stom_why_warehouse_title') ?: 'Собственный склад в Чите';
$why_warehouse_image = trimed_image_field('stom_why_warehouse_image', $img_dir . '/stomatology-warehouse.png');

$cta_text   = get_field('stom_cta_text') ?: 'Если вы планируете открыть стоматологию или обновить оборудование — мы поможем подобрать решения под вашу задачу и бюджет';
$cta_button = get_field('stom_cta_button_text') ?: 'Получить консультацию';

$included_top = array_slice($included_cards, 0, 3);
$included_bottom = array_slice($included_cards, 3);
?>

<main class="stomatology-page">

    <section class="stom-hero">
        <div class="stom-container">
            <div class="stom-hero-grid">
                <div class="stom-hero-left">
                    <h1 class="stom-hero-title"><?php echo wp_kses_post($hero_title); ?></h1>
                    <p class="stom-hero-desc"><?php echo esc_html($hero_desc); ?></p>

                    <div class="stom-hero-features">
                    <?php trimed_render_responsive_picture($hero_feature_image, array('class' => 'stom-hero-feature-img')); ?>
                        <div class="stom-hero-feature-cards">
                            <?php foreach ($hero_features as $feature) : ?>
                                <div class="stom-hero-feature-card">
                                    <img src="<?php echo esc_url($img_dir . '/stomatology-hero-check.svg'); ?>" alt="" width="20" height="20" class="check">
                                    <span><?php echo wp_kses_post($feature['text']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <button class="stom-hero-btn" type="button"><span><?php echo esc_html($hero_btn); ?></span></button>
                </div>

                <div class="stom-hero-right">
                    <?php trimed_render_responsive_picture($hero_image, array('class' => 'stom-hero-image')); ?>
                    <div class="stom-hero-badges">
                        <div class="stom-hero-badge-glass">
                            <?php echo trimed_get_clover_svg('badge-icon', 22); ?>
                            <span><?php echo esc_html($hero_badge_glass_text); ?></span>
                        </div>
                        <div class="stom-hero-badge-green">
                            <span class="num"><?php echo esc_html($hero_badge_green_num); ?></span>
                            <span class="txt"><?php echo esc_html($hero_badge_green_text); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stom-audience">
        <div class="stom-section-inner">
            <div class="stom-audience-header">
                <img class="icon" src="<?php echo esc_url($img_dir . '/stomatology-audience-icon.svg'); ?>" alt="" width="55" height="55">
                <div>
                    <p class="stom-audience-label"><?php echo esc_html($audience_label); ?></p>
                    <h2 class="stom-audience-title"><?php echo wp_kses_post($audience_title); ?></h2>
                </div>
                <p class="stom-audience-desc"><?php echo esc_html($audience_desc); ?></p>
            </div>

            <div class="stom-audience-body">
                <p class="stom-audience-lead"><?php echo esc_html($audience_lead); ?></p>

                <div class="stom-audience-grid">
                <?php foreach ($audience_cards as $card) :
                    $card_style = !empty($card['style']) ? $card['style'] : 'default';
                    $card_class = trimed_audience_card_class('stomatology', $card_style);
                    $card_image = !empty($card['image']) ? $card['image'] : '';
                    $arrow_class = '';
                    $show_arrow = false;
                    $show_mark = false;

                    if ($card_style === 'image') {
                        $show_arrow = true;
                        $arrow_class = 'arrow--image';
                    } elseif ($card_style === 'green') {
                        $show_arrow = true;
                        $arrow_class = 'arrow--green';
                    } elseif ($card_style === 'white' || $card_style === 'gray') {
                        $show_mark = true;
                    }
                ?>
                    <div class="<?php echo esc_attr($card_class); ?>">
                        <?php if ($show_arrow) : ?>
                            <svg class="arrow <?php echo esc_attr($arrow_class); ?>" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M7 17L17 7M17 7H7M17 7V17" />
                            </svg>
                        <?php endif; ?>
                        <?php if ($show_mark) : ?>
                            <?php echo trimed_get_clover_svg('stom-audience-mark', 20); ?>
                        <?php endif; ?>
                        <p class="text"><?php echo esc_html($card['text']); ?></p>
                        <?php if (in_array($card_style, ['white', 'gray'], true)) : ?>
                            <div class="stom-audience-card-media">
                                <?php trimed_render_responsive_picture(!empty($card_image) ? $card_image : $placeholder, array('width' => 100, 'height' => 100)); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            </div>

            <p class="stom-audience-summary"><?php echo wp_kses_post($audience_summary); ?></p>
        </div>
    </section>

    <section class="stom-included">
        <div class="stom-container">
            <div class="stom-included-header">
                <div>
                    <h2 class="stom-included-title"><?php echo wp_kses_post($included_title); ?></h2>
                    <p class="stom-included-label"><?php echo esc_html($included_label); ?></p>
                </div>
                <p class="stom-included-desc"><?php echo esc_html($included_desc); ?></p>
            </div>

            <div class="stom-included-top">
                <?php foreach ($included_top as $card) : ?>
                    <div class="stom-included-card">
                        <div class="stom-included-card-img"><?php trimed_render_responsive_picture(!empty($card['image']) ? $card['image'] : $placeholder); ?></div>
                        <div class="stom-included-card-body">
                            <span class="stom-included-card-num"><?php echo esc_html($card['number']); ?></span>
                            <p class="stom-included-card-title"><?php echo esc_html($card['title']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="stom-included-bottom">
                <?php foreach ($included_bottom as $card) : ?>
                    <div class="stom-included-card">
                        <div class="stom-included-card-img"><?php trimed_render_responsive_picture(!empty($card['image']) ? $card['image'] : $placeholder); ?></div>
                        <div class="stom-included-card-body">
                            <span class="stom-included-card-num"><?php echo esc_html($card['number']); ?></span>
                            <p class="stom-included-card-title"><?php echo esc_html($card['title']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="stom-included-result">
                    <img class="arrow" src="<?php echo esc_url($img_dir . '/stomatology-audience-arrow.svg'); ?>" alt="" width="13" height="13">
                    <p><?php echo esc_html($included_result_text); ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="stom-projects">
        <div class="stom-section-inner">
            <div class="stom-projects-header">
                <h2 class="stom-projects-title"><?php echo esc_html($projects_title); ?></h2>
                <p class="stom-projects-desc"><?php echo esc_html($projects_desc); ?></p>
            </div>

            <div class="stom-projects-grid">
                <?php foreach ($projects as $project) : ?>
                    <div class="stom-project-card">
                        <div class="stom-project-card-img"><?php trimed_render_responsive_picture(!empty($project['image']) ? $project['image'] : $placeholder); ?></div>
                        <div class="stom-project-card-body">
                            <div class="stom-project-card-top">
                                <span class="stom-project-card-num"><?php echo esc_html($project['number']); ?></span>
                                <span class="stom-project-card-arrow"><img src="<?php echo esc_url($img_dir . '/stomatology-project-arrow.svg'); ?>" alt="" width="14" height="14"></span>
                            </div>
                            <div>
                                <h3 class="stom-project-card-title"><?php echo esc_html($project['title']); ?></h3>
                                <p class="stom-project-card-text"><?php echo esc_html($project['text']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="stom-process">
        <div class="stom-section-inner">
            <div class="stom-process-grid">
                <div class="stom-process-header">
                    <h2 class="stom-process-title"><?php echo wp_kses_post($process_title); ?></h2>
                    <p class="stom-process-subtitle"><?php echo esc_html($process_subtitle); ?></p>
                </div>
                <div class="stom-process-cards">
                    <?php $step_index = 0; foreach ($process_steps as $step) : $step_index++; ?>
                        <div class="stom-process-card <?php echo $step_index === 1 ? 'stom-process-card--green' : 'stom-process-card--light'; ?>">
                            <span class="stom-process-card-num"><?php echo esc_html($step['number']); ?></span>
                            <h3 class="stom-process-card-title"><?php echo esc_html($step['title']); ?></h3>
                            <p class="stom-process-card-text"><?php echo esc_html($step['text']); ?></p>
                            <?php if (!empty($step['image'])) : ?>
                                <?php trimed_render_responsive_picture($step['image'], array('style' => 'position:absolute; right:0; bottom:0; width:236px; height:162px; object-fit:cover; opacity:.7;')); ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="stom-process-image"><?php trimed_render_responsive_picture($process_image); ?></div>
            </div>
        </div>
    </section>

    <?php
    trimed_render_service_request_section(array(
        'section_class' => 'stom-request',
        'inner_class'   => 'stom-request-inner',
        'summary'       => array(
            'icon'             => trimed_get_clover_svg('stom-request-icon', 16),
            'title'            => $request_title,
            'title_class'      => 'stom-request-title',
            'desc'             => $request_desc,
            'desc_class'       => 'stom-request-desc',
            'note'             => $request_note,
            'note_class'       => 'stom-request-note',
            'note_icon'        => '<svg width="10" height="8" viewBox="0 0 12 10" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 5l3 3 5-6"/></svg>',
            'note_label_class' => 'check',
        ),
        'form' => array(
            'class'       => 'stom-request-form request-form',
            'button_text' => $request_button,
            'button_span' => true,
        ),
    ));
    ?>

    <section class="stom-why">
        <div class="stom-section-inner">
            <div class="stom-why-header">
                <h2 class="stom-why-title"><?php echo wp_kses_post($why_title); ?></h2>
            </div>
            <div class="stom-why-grid">
                <div class="stom-why-left">
                    <div class="stom-why-stats">
                        <?php foreach ($why_stats as $stat) :
                            $stat_class = trimed_map_class(!empty($stat['style']) ? $stat['style'] : 'gray', array(
                                'gray'  => 'stom-why-stat--gray',
                                'green' => 'stom-why-stat--green',
                                'image' => 'stom-why-stat--img',
                                'img'   => 'stom-why-stat--img',
                            ), 'stom-why-stat--gray');
                        ?>
                            <div class="stom-why-stat <?php echo esc_attr($stat_class); ?>">
                                <span class="num"><?php echo esc_html($stat['number']); ?></span>
                                <span class="txt"><?php echo esc_html($stat['text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="stom-why-features">
                        <?php $why_feature_index = 0; foreach ($why_features as $feature) : $why_feature_index++; ?>
                            <div class="stom-why-feature">
                                <?php echo isset($why_feature_icons[$why_feature_index - 1]) ? $why_feature_icons[$why_feature_index - 1] : $why_feature_icons[0]; ?>
                                <span><?php echo esc_html($feature['text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="stom-why-warehouse">
                    <h3 class="stom-why-warehouse-title"><?php echo esc_html($why_warehouse_title); ?></h3>
                    <?php trimed_render_responsive_picture($why_warehouse_image); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="stom-cta">
        <div class="stom-cta-inner">
            <svg class="stom-cta-icon" viewBox="0 0 31 31" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="15.5" cy="15.5" r="12"/>
                <path d="M10 15.5h11M15.5 10v11" stroke-linecap="round"/>
            </svg>
            <p class="stom-cta-text"><?php echo esc_html($cta_text); ?></p>
            <button class="stom-cta-btn" type="button"><span><?php echo esc_html($cta_button); ?></span></button>
        </div>
    </section>

</main>

<?php
get_footer();
