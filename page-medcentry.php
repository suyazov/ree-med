<?php
/*
Template Name: Медцентры
*/
get_header();

$img_dir = get_template_directory_uri() . '/assets/img/medcentry';
$placeholder = get_template_directory_uri() . '/assets/img/placeholder.jpg';

function med_image_url($field, $placeholder) {
    if (function_exists('get_field')) {
        $url = get_field($field);
        if (!empty($url)) return $url;
    }
    return $placeholder;
}

function med_get_field($field, $fallback = '') {
    if (function_exists('get_field')) {
        $val = get_field($field);
        if (!empty($val)) return $val;
    }
    return $fallback;
}

$hero_title = med_get_field('med_hero_title', 'Оснащение <span class="text-green">медицинских центров под ключ</span> в Забайкальском крае');
$hero_desc  = med_get_field('med_hero_desc', 'Помогаем клиникам запускаться, развиваться и работать на современном оборудовании от подбора до поставки');
$hero_btn   = med_get_field('med_hero_button_text', 'Получить консультацию');
$hero_image = med_image_url('med_hero_image', $img_dir . '/hero-main.png');
$hero_feature_bg = med_image_url('med_hero_feature_bg', $img_dir . '/hero-feature-bg.png');
$hero_feature_text = med_get_field('med_hero_feature_text', 'Склад в Чите — быстрая поставка');
$hero_warehouse = med_image_url('med_hero_warehouse', $img_dir . '/warehouse-illustration.png');
$hero_badge_glass_text = med_get_field('med_hero_badge_glass_text', 'Работаем с клиниками по всему Забайкальскому краю');
$hero_badge_green_num  = med_get_field('med_hero_badge_green_num', '5000+');
$hero_badge_green_text = med_get_field('med_hero_badge_green_text', 'позиций оборудования в наличии');

$audience_label = med_get_field('med_audience_label', 'Кому подходит');
$audience_title = med_get_field('med_audience_title', 'Работаем с медицинскими центрами на разных этапах');
$audience_desc  = med_get_field('med_audience_desc', 'Мы понимаем, что у каждой клиники своя задача, поэтому подходим к оснащению индивидуально');
$audience_lead  = med_get_field('med_audience_lead', 'Мы поможем, если вы:');
$audience_summary = med_get_field('med_audience_summary', 'Мы создаём продуманное оснащение, которое помогает клинике работать уверенно каждый день.');

$included_subtitle = med_get_field('med_included_subtitle', 'Что входит');
$included_title = med_get_field('med_included_title', 'Комплексное <span class="text-green">оснащение клиники</span>');
$included_label = med_get_field('med_included_label', 'Мы берём на себя весь процесс:');
$included_desc  = med_get_field('med_included_desc', 'Оснащение медицинского центра — это не просто закупка оборудования. Важно подобрать решения, которые будут соответствовать профилю клиники, нагрузке и бюджету.');
$included_result_text = med_get_field('med_included_result_text', 'В результате, вы получаете не просто оборудование, а продуманную систему для стабильной и комфортной работы клиники');

$projects_title = med_get_field('med_projects_title', 'Реализованные проекты');
$projects_desc  = med_get_field('med_projects_desc', 'За время работы мы реализовали проекты по оснащению медицинских кабинетов и центров в Забайкальском крае. Мы понимаем специфику региона, требования врачей и реальные условия работы.');

$process_title    = med_get_field('med_process_title', 'Как мы работаем');
$process_subtitle = med_get_field('med_process_subtitle', 'Мы выстроили понятный и прозрачный процесс работы, чтобы клиенту было комфортно на каждом этапе.');
$process_image    = med_image_url('med_process_image', $img_dir . '/process-main.png');

$request_title  = med_get_field('med_request_title', 'Подберём оборудование под вашу клинику');
$request_desc   = med_get_field('med_request_desc', 'Оставьте заявку — свяжемся с вами, разберём задачу и предложим решение');
$request_note   = med_get_field('med_request_note', 'Консультация бесплатная');
$request_button = med_get_field('med_request_button_text', 'Отправить');

$why_title    = med_get_field('med_why_title', 'Почему выбирают <span class="text-green">ТриМед</span>');
$why_warehouse_title = med_get_field('med_why_warehouse_title', 'Собственный склад в Чите');
$why_cta_text = med_get_field('med_why_cta_text', 'Нужна консультация по оборудованию?');
$why_cta_button = med_get_field('med_why_cta_button_text', 'Оставить заявку');

// Fallbacks
$audience_cards = array(
    array('text' => 'Открываете медицинский центр с нуля и не понимаете, с чего начать', 'image' => $img_dir . '/audience-1.png', 'style' => 'image'),
    array('text' => 'Расширяете клинику и добавляете новые кресла', 'image' => $img_dir . '/audience-2.png', 'style' => 'white'),
    array('text' => 'Хотите заменить устаревшее оборудование', 'image' => $img_dir . '/audience-icon.png', 'style' => 'gray'),
    array('text' => 'Хотите работать без простоев и задержек поставок', 'image' => '', 'style' => 'green'),
);
if (function_exists('get_field')) {
    $acf_audience_cards = get_field('med_audience_cards');
    if (!empty($acf_audience_cards) && is_array($acf_audience_cards)) {
        $audience_cards = $acf_audience_cards;
    }
}

$included_cards = array(
    array('image' => $img_dir . '/included-1.png', 'number' => '1', 'title' => 'Подбор оборудования под профиль клиники'),
    array('image' => $img_dir . '/included-2.png', 'number' => '2', 'title' => 'Оснащение кабинетов (приём, диагностика, лечение)'),
    array('image' => $img_dir . '/included-3.png', 'number' => '3', 'title' => 'Планировка и расстановка оборудования'),
    array('image' => $img_dir . '/included-4.png', 'number' => '4', 'title' => 'Поставка со склада или под заказ'),
    array('image' => $img_dir . '/included-5.png', 'number' => '5', 'title' => 'Консультации на всех этапах'),
);
if (function_exists('get_field')) {
    $acf_included = get_field('med_included_cards');
    if (!empty($acf_included) && is_array($acf_included)) {
        $included_cards = $acf_included;
    }
}

$projects = array(
    array('image' => $img_dir . '/project-1.png', 'number' => '01.', 'title' => 'Стоматология «Дента-Профи» (г. Чита)', 'text' => 'Оснащение двух кабинетов под ключ: стоматологические установки, компрессорная, стерилизационная.'),
    array('image' => $img_dir . '/project-2.png', 'number' => '02.', 'title' => 'Медицинский центр «Семейный доктор» (г. Краснокаменск)', 'text' => 'Поставка и монтаж рентген-кабинета с радиационной защитой, пуско-наладка.'),
    array('image' => $img_dir . '/project-3.png', 'number' => '03.', 'title' => 'Центр «Здоровье Забайкалья» (пгт. Агинское)', 'text' => 'Полное оснащение стоматологического кабинета: оборудование, мебель, инструменты, обучение персонала.'),
    array('image' => $img_dir . '/project-4.png', 'number' => '04.', 'title' => 'Стоматологический кабинет «Улыбка Забайкалья» (г. Борзя)', 'text' => 'Комплексное оснащение с нуля: установка, стерилизационное оборудование, цифровой визиограф, дизайн-проект и расстановка мебели.'),
);
if (function_exists('get_field')) {
    $acf_projects = get_field('med_projects');
    if (!empty($acf_projects) && is_array($acf_projects)) {
        $projects = $acf_projects;
    }
}

$process_steps = array(
    array('number' => '1', 'title' => 'Консультация', 'text' => 'Обсуждаем задачи, формат клиники и требования'),
    array('number' => '2', 'title' => 'Подбор оборудования', 'text' => 'Подбираем решения под бюджет и задачи'),
    array('number' => '3', 'title' => 'Поставка', 'text' => 'Доставляем оборудование со склада или под заказ'),
    array('number' => '4', 'title' => 'Сопровождение', 'text' => 'Остаёмся на связи и помогаем при необходимости'),
);
if (function_exists('get_field')) {
    $acf_steps = get_field('med_process_steps');
    if (!empty($acf_steps) && is_array($acf_steps)) {
        $process_steps = $acf_steps;
    }
}

$why_stats = array(
    array('number' => '20+', 'text' => 'лет на рынке', 'style' => 'image'),
    array('number' => '5000+', 'text' => 'позиций оборудования', 'style' => 'gray'),
);
if (function_exists('get_field')) {
    $acf_stats = get_field('med_why_stats');
    if (!empty($acf_stats) && is_array($acf_stats)) {
        $why_stats = $acf_stats;
    }
}

$why_features = array(
    array('text' => 'Прямые поставки от производителей', 'icon' => 'delivery'),
    array('text' => 'Собственный склад в Чите', 'icon' => 'warehouse'),
);
if (function_exists('get_field')) {
    $acf_features = get_field('med_why_features');
    if (!empty($acf_features) && is_array($acf_features)) {
        $why_features = $acf_features;
    }
}

$audience_style_classes = array(
    'default' => 'mc-audience-card',
    'image' => 'mc-audience-card mc-audience-card--image',
    'white' => 'mc-audience-card mc-audience-card--white',
    'gray' => 'mc-audience-card mc-audience-card--gray',
    'green' => 'mc-audience-card mc-audience-card--green',
);

$clover_icon = '<svg class="mc-clover" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.8026 6.80286C14.8114 6.80286 13.1967 5.18812 13.1967 3.19681C13.1967 1.4317 11.7657 0 10 0C8.23429 0 6.80264 1.4317 6.80264 3.19681C6.80264 5.18812 5.1886 6.80286 3.19736 6.80286C1.43165 6.80286 0 8.23391 0 10.0003C0 11.7661 1.43165 13.1971 3.19736 13.1971C5.1886 13.1971 6.80264 14.8112 6.80264 16.8025C6.80264 18.569 8.23429 20 10 20C11.7657 20 13.1967 18.569 13.1967 16.8025C13.1967 14.8112 14.8114 13.1971 16.8026 13.1971C18.5683 13.1971 20 11.7661 20 10.0003C20 8.23391 18.5683 6.80286 16.8026 6.80286Z" fill="currentColor"/></svg>';

$arrow_icon = '<svg class="mc-arrow" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 15L15 3M15 3H6M15 3V12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>';

$header_clover = '<svg class="mc-header-clover" width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M46.2073 18.7079C40.7314 18.7079 36.2909 14.2673 36.2909 8.79123C36.2909 3.93718 32.3557 0 27.5 0C22.6443 0 18.7073 3.93718 18.7073 8.79123C18.7073 14.2673 14.2686 18.7079 8.79274 18.7079C3.93704 18.7079 0 22.6432 0 27.5009C0 32.3567 3.93704 36.2921 8.79274 36.2921C14.2686 36.2921 18.7073 40.7309 18.7073 46.207C18.7073 51.0646 22.6443 55 27.5 55C32.3557 55 36.2909 51.0646 36.2909 46.207C36.2909 40.7309 40.7314 36.2921 46.2073 36.2921C51.063 36.2921 55 32.3567 55 27.5009C55 22.6432 51.063 18.7079 46.2073 18.7079Z" fill="url(#paint0_linear_header)"/><defs><linearGradient id="paint0_linear_header" x1="9.5" y1="10.5" x2="44" y2="43.5" gradientUnits="userSpaceOnUse"><stop stop-color="#3F8D50"/><stop offset="1" stop-color="#51A462"/></linearGradient></defs></svg>';

$request_clover = '<svg class="mc-request-clover" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M33.6053 13.6057C29.6228 13.6057 26.3934 10.3762 26.3934 6.39362C26.3934 2.8634 23.5314 0 20 0C16.4686 0 13.6053 2.8634 13.6053 6.39362C13.6053 10.3762 10.3772 13.6057 6.39472 13.6057C2.8633 13.6057 0 16.4678 0 20.0007C0 23.5322 2.8633 26.3943 6.39472 26.3943C10.3772 26.3943 13.6053 29.6225 13.6053 33.6051C13.6053 37.1379 16.4686 40 20 40C23.5314 40 26.3934 37.1379 26.3934 33.6051C26.3934 29.6225 29.6228 26.3943 33.6053 26.3943C37.1367 26.3943 40 23.5322 40 20.0007C40 16.4678 37.1367 13.6057 33.6053 13.6057Z" fill="currentColor"/></svg>';

$check_icon = '<svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.40313 6.68015L1.10923 4.38624C0.9892 4.26622 0.821376 4.19457 0.650447 4.19457C0.479518 4.19457 0.311694 4.26622 0.191665 4.38624C0.0716365 4.50627 0 4.67409 0 4.84502C0 5.01595 0.0716365 5.18377 0.191665 5.3038L2.9378 8.04994C3.19341 8.30554 3.60631 8.30554 3.86192 8.04994L10.8092 1.10923C10.9292 0.989203 11.0008 0.821379 11.0008 0.65045C11.0008 0.479521 10.9292 0.311697 10.8092 0.191668C10.6892 0.0716393 10.5214 0 10.3504 0C10.1795 0 10.0117 0.0716393 9.89161 0.191668L3.40313 6.68015Z" fill="currentColor"/></svg>';

$delivery_icon = '<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 14L16 4l12 10v14H4V14z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 26V16h8v10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

$warehouse_icon = '<svg width="32" height="29" viewBox="0 0 32 29" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M32 25.7512V8.45106C32 7.11903 31.2 5.9332 29.984 5.42963L17.184 0.23148C16.416 -0.0771601 15.568 -0.0771601 14.8 0.23148L2 5.42963C0.8 5.9332 0 7.13528 0 8.45106V25.7512C0 27.538 1.44 29 3.2 29H8V14.3802H24V29H28.8C30.56 29 32 27.538 32 25.7512ZM14.4 25.7512H11.2V29H14.4V25.7512ZM17.6 20.8779H14.4V24.1267H17.6V20.8779ZM20.8 25.7512H17.6V29H20.8V25.7512Z" fill="url(#paint0_wh_warehouse)"/><defs><linearGradient id="paint0_wh_warehouse" x1="5.52727" y1="23.4636" x2="23.7097" y2="4.27264" gradientUnits="userSpaceOnUse"><stop stop-color="#3F8D50"/><stop offset="1" stop-color="#51A462"/></linearGradient></defs></svg>';

$phone_flag = '<img src="' . esc_url($img_dir . '/phone-flag.png') . '" alt="" width="20" height="13">';
?>

<main class="medcentry-page">

    <section class="mc-hero">
        <div class="mc-container">
            <div class="mc-hero-grid">
                <div class="mc-hero-left">
                    <h1 class="mc-hero-title"><?php echo wp_kses_post($hero_title); ?></h1>
                    <p class="mc-hero-desc"><?php echo esc_html($hero_desc); ?></p>

                    <div class="mc-hero-feature">
                        <img src="<?php echo esc_url($hero_feature_bg); ?>" alt="" class="mc-hero-feature-bg">
                        <div class="mc-hero-feature-content">
                            <span class="mc-hero-feature-text"><?php echo esc_html($hero_feature_text); ?></span>
                            <img src="<?php echo esc_url($hero_warehouse); ?>" alt="" class="mc-hero-feature-warehouse">
                        </div>
                    </div>

                    <a href="#contact-form" class="mc-hero-btn"><span><?php echo esc_html($hero_btn); ?></span></a>
                </div>

                <div class="mc-hero-right">
                    <img src="<?php echo esc_url($hero_image); ?>" alt="" class="mc-hero-image">
                    <div class="mc-hero-badges">
                        <div class="mc-hero-badge-glass">
                            <?php echo $clover_icon; ?>
                            <span><?php echo esc_html($hero_badge_glass_text); ?></span>
                        </div>
                        <div class="mc-hero-badge-green">
                            <span class="num"><?php echo esc_html($hero_badge_green_num); ?></span>
                            <span class="txt"><?php echo esc_html($hero_badge_green_text); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mc-audience">
        <div class="mc-section-inner">
            <div class="mc-audience-header">
                <?php echo $header_clover; ?>
                <div class="mc-audience-header-main">
                    <p class="mc-audience-label"><?php echo esc_html($audience_label); ?></p>
                    <h2 class="mc-audience-title"><?php echo wp_kses_post($audience_title); ?></h2>
                </div>
                <p class="mc-audience-desc"><?php echo esc_html($audience_desc); ?></p>
            </div>

            <div class="mc-audience-body">
                <p class="mc-audience-lead"><?php echo esc_html($audience_lead); ?></p>

                <div class="mc-audience-grid">
                    <?php $audience_index = 0; foreach ($audience_cards as $card) : $audience_index++;
                        $card_style = !empty($card['style']) ? $card['style'] : 'default';
                        $card_class = isset($audience_style_classes[$card_style]) ? $audience_style_classes[$card_style] : $audience_style_classes['default'];
                        $card_image = !empty($card['image']) ? $card['image'] : '';
                    ?>
                        <div class="<?php echo esc_attr($card_class); ?>">
                            <?php echo $clover_icon; ?>
                            <p class="text"><?php echo esc_html($card['text']); ?></p>
                            <?php if ($card_style === 'white' || $card_style === 'gray') : ?>
                                <img src="<?php echo esc_url($card_image ? $card_image : $placeholder); ?>" alt="" class="mc-audience-card-img">
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <p class="mc-audience-summary"><?php echo esc_html($audience_summary); ?></p>
        </div>
    </section>

    <section class="mc-included">
        <div class="mc-container">
            <div class="mc-included-header">
                <div class="mc-included-header-left">
                    <p class="mc-included-subtitle"><?php echo esc_html($included_subtitle); ?></p>
                    <h2 class="mc-included-title"><?php echo wp_kses_post($included_title); ?></h2>
                </div>
                <p class="mc-included-desc"><?php echo esc_html($included_desc); ?></p>
                <p class="mc-included-label"><?php echo esc_html($included_label); ?></p>
            </div>

            <div class="mc-included-grid">
                <?php foreach ($included_cards as $index => $card) : ?>
                    <div class="mc-included-card" data-index="<?php echo esc_attr($index + 1); ?>">
                        <div class="mc-included-card-img"><img src="<?php echo esc_url(!empty($card['image']) ? $card['image'] : $placeholder); ?>" alt=""></div>
                        <div class="mc-included-card-body">
                            <span class="mc-included-card-num"><?php echo esc_html($card['number']); ?></span>
                            <p class="mc-included-card-title"><?php echo esc_html($card['title']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mc-included-result">
                <?php echo $clover_icon; ?>
                <p><?php echo esc_html($included_result_text); ?></p>
            </div>
        </div>
    </section>

    <section class="mc-projects">
        <div class="mc-section-inner">
            <div class="mc-projects-header">
                <h2 class="mc-projects-title"><?php echo wp_kses_post($projects_title); ?></h2>
                <p class="mc-projects-desc"><?php echo esc_html($projects_desc); ?></p>
            </div>

            <div class="mc-projects-grid">
                <?php foreach ($projects as $project) : ?>
                    <div class="mc-project-card">
                        <div class="mc-project-card-img"><img src="<?php echo esc_url(!empty($project['image']) ? $project['image'] : $placeholder); ?>" alt=""></div>
                        <div class="mc-project-card-body">
                            <div class="mc-project-card-top">
                                <span class="mc-project-card-num"><?php echo esc_html($project['number']); ?></span>
                                <span class="mc-project-card-arrow"><?php echo $arrow_icon; ?></span>
                            </div>
                            <div>
                                <h3 class="mc-project-card-title"><?php echo esc_html($project['title']); ?></h3>
                                <p class="mc-project-card-text"><?php echo esc_html($project['text']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="mc-process">
        <div class="mc-section-inner">
            <div class="mc-process-grid">
                <div class="mc-process-header">
                    <h2 class="mc-process-title"><?php echo wp_kses_post($process_title); ?></h2>
                    <p class="mc-process-subtitle"><?php echo esc_html($process_subtitle); ?></p>
                </div>
                <div class="mc-process-cards">
                    <?php $step_index = 0; foreach ($process_steps as $step) : $step_index++; ?>
                        <div class="mc-process-card <?php echo $step_index === 1 ? 'mc-process-card--green' : 'mc-process-card--light'; ?>">
                            <span class="mc-process-card-num"><?php echo esc_html($step['number']); ?></span>
                            <h3 class="mc-process-card-title"><?php echo esc_html($step['title']); ?></h3>
                            <p class="mc-process-card-text"><?php echo esc_html($step['text']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mc-process-image"><img src="<?php echo esc_url($process_image); ?>" alt=""></div>
            </div>
        </div>
    </section>

    <section class="mc-request" id="request">
        <div class="mc-request-inner">
            <?php echo $request_clover; ?>
            <div class="mc-request-left">
                <h2 class="mc-request-title"><?php echo wp_kses_post($request_title); ?></h2>
                <p class="mc-request-desc"><?php echo esc_html($request_desc); ?></p>
                <div class="mc-request-note">
                    <span class="check"><?php echo $check_icon; ?></span>
                    <span><?php echo esc_html($request_note); ?></span>
                </div>
            </div>
            <form id="contact-form" class="mc-request-form">
                <input type="text" name="name" placeholder="Иванов Николай Сергеевич" required>
                <div class="phone-input">
                    <?php echo $phone_flag; ?>
                    <input type="tel" name="phone" placeholder="+7 (999) 999-99-99" required>
                </div>
                <textarea name="comment" placeholder="Ваш комментарий"></textarea>
                <label class="checkbox">
                    <input type="checkbox" name="agree" value="1" required>
                    <span>Оставляя заявку, я соглашаюсь с условиями Политики обработки персональных данных</span>
                </label>
                <div class="form-message"></div>
                <button type="submit"><span><?php echo esc_html($request_button); ?></span></button>
            </form>
        </div>
    </section>

    <section class="mc-why">
        <div class="mc-section-inner">
            <h2 class="mc-why-title"><?php echo wp_kses_post($why_title); ?></h2>
            <div class="mc-why-grid">
                <div class="mc-why-left">
                    <div class="mc-why-stats">
                        <?php foreach ($why_stats as $stat) :
                            $stat_class = 'mc-why-stat--' . (!empty($stat['style']) ? sanitize_html_class($stat['style']) : 'gray');
                        ?>
                            <div class="mc-why-stat <?php echo esc_attr($stat_class); ?>">
                                <span class="num"><?php echo esc_html($stat['number']); ?></span>
                                <span class="txt"><?php echo esc_html($stat['text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="mc-why-features">
                        <?php foreach ($why_features as $feature) : ?>
                            <div class="mc-why-feature">
                                <?php echo $feature['icon'] === 'warehouse' ? $warehouse_icon : $delivery_icon; ?>
                                <span><?php echo esc_html($feature['text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="mc-why-cta">
                    <img src="<?php echo esc_url($img_dir . '/why-cta-image.png'); ?>" alt="" class="mc-why-cta-bg">
                    <div class="mc-why-cta-content">
                        <p class="mc-why-cta-text"><?php echo esc_html($why_cta_text); ?></p>
                        <a href="#contact-form" class="mc-why-cta-btn"><span><?php echo esc_html($why_cta_button); ?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
