<?php
/*
Template Name: Стоматология
*/
get_header();

$img_dir = get_template_directory_uri() . '/assets/img';
$placeholder = $img_dir . '/placeholder.jpg';

function stom_picture($url, $class = '', $alt = '', $width = null, $height = null, $style = '') {
    $mobile = preg_replace('/\.(png|jpe?g|webp)(\?.*)?$/i', '-mobile.$1$2', $url);
    $mobile_path = str_replace(get_template_directory_uri(), get_template_directory(), $mobile);
    if (!file_exists($mobile_path)) {
        $mobile = $url;
    }
    $class_attr = $class ? ' class="' . esc_attr($class) . '"' : '';
    $wh_attr = ($width && $height) ? ' width="' . esc_attr($width) . '" height="' . esc_attr($height) . '"' : '';
    $style_attr = $style ? ' style="' . esc_attr($style) . '"' : '';
    echo '<picture><source media="(max-width: 768px)" srcset="' . esc_url($mobile) . '"><img src="' . esc_url($url) . '"' . $class_attr . $wh_attr . $style_attr . ' alt="' . esc_attr($alt) . '"></picture>';
}

$hero_title = get_field('stom_hero_title') ?: 'Оснащение<br><span class="text-green">стоматологии под ключ</span><br>в Забайкальском крае';
$hero_desc  = get_field('stom_hero_desc') ?: 'Подберём оборудование, поставим и поможем запустить кабинет без лишних затрат и ошибок';
$hero_btn   = get_field('stom_hero_button_text') ?: 'Получить консультацию';
$hero_image = trimed_image_field('stom_hero_image', $img_dir . '/stomatology-hero-main.png');
$hero_feature_image = trimed_image_field('stom_hero_feature_image', $img_dir . '/stomatology-hero-features.png');
$hero_features = get_field('stom_hero_features');
$hero_badge_glass_text = get_field('stom_hero_badge_glass_text') ?: 'Работаем с частными и государственными клиниками';
$hero_badge_green_num  = get_field('stom_hero_badge_green_num') ?: '5000+';
$hero_badge_green_text = get_field('stom_hero_badge_green_text') ?: 'позиций в наличии';

$audience_label = get_field('stom_audience_label') ?: 'Кому подходит';
$audience_title = get_field('stom_audience_title') ?: 'Работаем со стоматологиями <em>на разных этапах</em>';
$audience_desc  = get_field('stom_audience_desc') ?: 'Мы понимаем, что задачи у всех разные: кто-то открывается с нуля, кто-то расширяется, а кто-то просто хочет обновить оборудование.';
$audience_lead  = get_field('stom_audience_lead') ?: 'Мы будем полезны, если вы:';
$audience_cards = get_field('stom_audience_cards');
$audience_summary = get_field('stom_audience_summary') ?: 'Мы помогаем не просто купить оборудование, а сделать так, чтобы кабинет начал работать <span class="text-green">максимально эффективно за короткие сроки</span>.';

$included_title = get_field('stom_included_title') ?: 'Что входит в оснащение <span class="text-green">стоматологии</span>';
$included_label = get_field('stom_included_label') ?: 'Мы берём на себя весь процесс:';
$included_desc  = get_field('stom_included_desc') ?: "Оснащение стоматологического кабинета\xC2\xA0— это\xC2\xA0не\xC2\xA0только установка кресла. Важно учесть всё: от\xC2\xA0компрессоров до\xC2\xA0удобства работы врача.";
$included_desc = str_replace(array(' — ', ' не ', ' только ', 'от ', 'до ', ' работы', ' врача.'), array("\xC2\xA0—\xC2\xA0", "\xC2\xA0не\xC2\xA0", "\xC2\xA0только\xC2\xA0", "от\xC2\xA0", "до\xC2\xA0", "\xC2\xA0работы", "\xC2\xA0врача."), $included_desc);
$included_cards = get_field('stom_included_cards');
$included_result_text = get_field('stom_included_result_text') ?: 'В результате вы получаете полностью готовый к работе кабинет в одном месте';

$projects_title = get_field('stom_projects_title') ?: 'Реализованные проекты';
$projects_desc  = get_field('stom_projects_desc') ?: 'Мы уже помогли оснастить стоматологические кабинеты в Забайкальском крае, как частные, так и государственные. Понимаем, какие решения подходят для региона и какие задачи стоят перед врачами.';
$projects = get_field('stom_projects');

$process_title    = get_field('stom_process_title') ?: 'Как проходит <span class="text-green">работа</span>';
$process_subtitle = get_field('stom_process_subtitle') ?: 'Мы выстроили простой и понятный процесс, чтобы вы не тратили время на разбор оборудования.';
$process_steps    = get_field('stom_process_steps');
$process_image    = trimed_image_field('stom_process_image', $img_dir . '/stomatology-process.png');

$request_title  = get_field('stom_request_title') ?: 'Подберём оборудование под вашу <em>стоматологию</em>';
$request_desc   = get_field('stom_request_desc') ?: 'Оставьте заявку — свяжемся с вами и предложим решение';
$request_note   = get_field('stom_request_note') ?: 'Консультация бесплатная';
$request_button = get_field('stom_request_button_text') ?: 'Получить консультацию';

$why_title    = get_field('stom_why_title') ?: 'Почему выбирают <span class="text-green">ТриМед</span>';
$why_stats    = get_field('stom_why_stats');
$why_features = get_field('stom_why_features');
$why_feature_icons = array(
    '<svg viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 18h15v8H4z" stroke-linejoin="round"/><path d="M19 18v-4a2 2 0 0 1 2-2h3l5 5v5h-4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="24" r="2"/><circle cx="23" cy="24" r="2"/></svg>',
    '<svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M25 19.8157V6.50314C25 5.47813 24.375 4.56563 23.425 4.17813L13.425 0.178125C12.825 -0.0593751 12.1625 -0.0593751 11.5625 0.178125L1.5625 4.17813C0.625001 4.56563 0 5.49063 0 6.50314V19.8157C0 21.1907 1.125 22.3157 2.5 22.3157H6.25001V11.0656H18.75V22.3157H22.5C23.875 22.3157 25 21.1907 25 19.8157ZM11.25 19.8157H8.75001V22.3157H11.25V19.8157ZM13.75 16.0657H11.25V18.5657H13.75V16.0657ZM16.25 19.8157H13.75V22.3157H16.25V19.8157Z" fill="url(#paint0_linear_182_301)"/><defs><linearGradient id="paint0_linear_182_301" x1="4.31819" y1="18.0554" x2="18.2966" y2="3.07637" gradientUnits="userSpaceOnUse"><stop stop-color="#3F8D50"/><stop offset="1" stop-color="#51A462"/></linearGradient></defs></svg>',
);
$why_warehouse_title = get_field('stom_why_warehouse_title') ?: 'Собственный склад в Чите';
$why_warehouse_image = trimed_image_field('stom_why_warehouse_image', $img_dir . '/stomatology-warehouse.png');

$cta_text   = get_field('stom_cta_text') ?: 'Если вы планируете открыть стоматологию или обновить оборудование — мы поможем подобрать решения под вашу задачу и бюджет';
$cta_button = get_field('stom_cta_button_text') ?: 'Получить консультацию';

// Fallbacks for repeaters
if (empty($hero_features) || !is_array($hero_features)) {
    $hero_features = array(
        array('text' => 'Помогаем подобрать оборудование под задачи и бюджет'),
        array('text' => 'Склад в Чите - быстрая поставка без ожидания'),
    );
}

if (empty($audience_cards) || !is_array($audience_cards)) {
    $audience_cards = array(
        array('text' => 'Открываете стоматологический кабинет и не знаете, какое оборудование выбрать', 'image' => $img_dir . '/stomatology-audience-2.png', 'style' => 'image'),
        array('text' => 'Расширяете клинику и добавляете новые кресла', 'image' => $img_dir . '/stomatology-audience-white-v2.png', 'style' => 'white'),
        array('text' => 'Хотите заменить устаревшее оборудование', 'image' => $img_dir . '/stomatology-audience-3.png', 'style' => 'gray'),
        array('text' => 'Хотите работать без простоев и задержек поставок', 'image' => '', 'style' => 'green'),
    );
}

if (empty($included_cards) || !is_array($included_cards)) {
    $included_cards = array(
        array('image' => $img_dir . '/stomatology-included-1-v2.png', 'number' => '1', 'title' => 'Подбор стоматологических установок'),
        array('image' => $img_dir . '/stomatology-included-2-v2.png', 'number' => '2', 'title' => 'Компрессоры и аспирационные системы'),
        array('image' => $img_dir . '/stomatology-included-3-v2.png', 'number' => '3', 'title' => 'Стоматологические инструменты и оборудование'),
        array('image' => $img_dir . '/stomatology-included-4-v2.png', 'number' => '4', 'title' => 'Мебель и оснащение кабинета'),
        array('image' => $img_dir . '/stomatology-included-5-v2.png', 'number' => '5', 'title' => 'Поставку оборудования'),
        array('image' => $img_dir . '/stomatology-included-6-v2.png', 'number' => '6', 'title' => 'Консультации на всех этапах'),
    );
}

if (empty($projects) || !is_array($projects)) {
    $projects = array(
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
    );
}

if (empty($process_steps) || !is_array($process_steps)) {
    $process_steps = array(
        array('number' => '1', 'title' => 'Консультация', 'text' => 'Обсуждаем формат кабинета и задачи', 'image' => ''),
        array('number' => '2', 'title' => 'Подбор оборудования', 'text' => 'Подбираем решения под бюджет и нагрузку', 'image' => ''),
        array('number' => '3', 'title' => 'Поставка', 'text' => 'Доставляем оборудование со склада или под заказ', 'image' => ''),
        array('number' => '4', 'title' => 'Запуск', 'text' => 'Помогаем подготовить кабинет к работе', 'image' => $img_dir . '/stomatology-process-step.png'),
    );
}

if (empty($why_stats) || !is_array($why_stats)) {
    $why_stats = array(
        array('number' => '20+', 'text' => 'лет на рынке', 'style' => 'image'),
        array('number' => '5000+', 'text' => 'позиций оборудования', 'style' => 'gray'),
    );
}

if (empty($why_features) || !is_array($why_features)) {
    $why_features = array(
        array('text' => 'Понимаем специфику стоматологий'),
        array('text' => 'Работаем с клиниками по всему краю'),
    );
}

$audience_style_classes = array(
    'default' => 'stom-audience-card',
    'white' => 'stom-audience-card stom-audience-card--white',
    'gray' => 'stom-audience-card stom-audience-card--gray',
    'green' => 'stom-audience-card stom-audience-card--green',
    'image' => 'stom-audience-card stom-audience-card--image',
);

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
                        <?php stom_picture($hero_feature_image, 'stom-hero-feature-img', ''); ?>
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
                    <?php stom_picture($hero_image, 'stom-hero-image', ''); ?>
                    <div class="stom-hero-badges">
                        <div class="stom-hero-badge-glass">
                            <svg class="badge-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M18.4829 7.48289C16.2925 7.48289 14.5164 5.70673 14.5164 3.51636C14.5164 1.57481 12.9423 -1.33514e-05 11 -1.33514e-05C9.05772 -1.33514e-05 7.4829 1.57481 7.4829 3.51636C7.4829 5.70673 5.70746 7.48289 3.51709 7.48289C1.57482 7.48289 0 9.05699 0 11C0 12.9423 1.57482 14.5164 3.51709 14.5164C5.70746 14.5164 7.4829 16.2918 7.4829 18.4822C7.4829 20.4252 9.05772 21.9993 11 21.9993C12.9423 21.9993 14.5164 20.4252 14.5164 18.4822C14.5164 16.2918 16.2925 14.5164 18.4829 14.5164C20.4252 14.5164 22 12.9423 22 11C22 9.05699 20.4252 7.48289 18.4829 7.48289Z" fill="currentColor"/></svg>
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
                <?php $audience_index = 0; foreach ($audience_cards as $card) : $audience_index++;
                    $card_style = !empty($card['style']) ? $card['style'] : 'default';
                    $card_class = isset($audience_style_classes[$card_style]) ? $audience_style_classes[$card_style] : $audience_style_classes['default'];
                    $card_image = !empty($card['image']) ? $card['image'] : '';
                    $arrow_class = ($audience_index % 2 === 1) ? 'arrow--br' : 'arrow--tr';
                ?>
                    <div class="<?php echo esc_attr($card_class); ?>">
                        <img class="arrow <?php echo esc_attr($arrow_class); ?>" src="<?php echo esc_url($img_dir . '/stomatology-audience-arrow.svg'); ?>" alt="" width="20" height="20">
                        <p class="text"><?php echo esc_html($card['text']); ?></p>
                        <?php if ($card_style === 'white' || $card_style === 'gray') : ?>
                            <?php stom_picture(!empty($card_image) ? $card_image : $placeholder, '', '', null, null, 'position:absolute; right:0; bottom:0; width:154px; height:132px; object-fit:cover; opacity:.8;'); ?>
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
                        <div class="stom-included-card-img"><?php stom_picture(!empty($card['image']) ? $card['image'] : $placeholder, '', ''); ?></div>
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
                        <div class="stom-included-card-img"><?php stom_picture(!empty($card['image']) ? $card['image'] : $placeholder, '', ''); ?></div>
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
                        <div class="stom-project-card-img"><?php stom_picture(!empty($project['image']) ? $project['image'] : $placeholder, '', ''); ?></div>
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
                                <?php stom_picture($step['image'], '', '', null, null, 'position:absolute; right:0; bottom:0; width:236px; height:162px; object-fit:cover; opacity:.7;'); ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="stom-process-image"><?php stom_picture($process_image, '', ''); ?></div>
            </div>
        </div>
    </section>

    <?php
    trimed_render_service_request_section(array(
        'section_class' => 'stom-request',
        'inner_class'   => 'stom-request-inner',
        'summary'       => array(
            'icon'             => '<svg class="stom-request-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.4421 5.44229C11.8491 5.44229 10.5574 4.15049 10.5574 2.55745C10.5574 1.14536 9.41256 9.53674e-07 8 9.53674e-07C6.58744 9.53674e-07 5.44211 1.14536 5.44211 2.55745C5.44211 4.15049 4.15088 5.44229 2.55789 5.44229C1.14532 5.44229 0 6.58713 0 8.00026C0 9.41287 1.14532 10.5577 2.55789 10.5577C4.15088 10.5577 5.44211 11.849 5.44211 13.442C5.44211 14.8552 6.58744 16 8 16C9.41256 16 10.5574 14.8552 10.5574 13.442C10.5574 11.849 11.8491 10.5577 13.4421 10.5577C14.8547 10.5577 16 9.41287 16 8.00026C16 6.58713 14.8547 5.44229 13.4421 5.44229Z" fill="currentColor"/></svg>',
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
                    <?php stom_picture($why_warehouse_image, '', ''); ?>
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
