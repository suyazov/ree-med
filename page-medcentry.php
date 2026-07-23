<?php
/*
Template Name: Медцентры
*/
get_header();

$img_dir = trimed_get_image_dir('medcentry');
$placeholder = trimed_get_placeholder_url();

$hero_title = trimed_get_field_value('med_hero_title', 'Оснащение <span class="text-green">медицинских центров под ключ</span><br>в Забайкальском крае');
$hero_title = trimed_medcentry_format_hero_title($hero_title);
$hero_desc  = trimed_get_field_value('med_hero_desc', 'Помогаем клиникам запускаться, развиваться и работать на современном оборудовании от подбора до поставки');
$hero_btn   = trimed_get_field_value('med_hero_button_text', 'Получить консультацию');
$hero_image = trimed_image_field('med_hero_image', $img_dir . '/hero-main.png');
$hero_feature_bg = trimed_image_field('med_hero_feature_bg', $img_dir . '/hero-feature-bg.png');
$hero_feature_text = trimed_get_field_value('med_hero_feature_text', 'Склад в Чите — быстрая поставка');
$hero_warehouse = trimed_image_field('med_hero_warehouse', $img_dir . '/warehouse-illustration.png');
$hero_badge_glass_text = trimed_get_field_value('med_hero_badge_glass_text', 'Работаем с клиниками по всему Забайкальскому краю');
$hero_badge_green_num  = trimed_get_field_value('med_hero_badge_green_num', '5000+');
$hero_badge_green_text = trimed_get_field_value('med_hero_badge_green_text', 'позиций оборудования в наличии');

$audience_label = trimed_get_field_value('med_audience_label', 'Кому подходит');
$audience_title = trimed_get_field_value('med_audience_title', 'Работаем с медицинскими центрами на разных этапах');
$audience_desc  = trimed_get_field_value('med_audience_desc', 'Мы понимаем, что у каждой клиники своя задача, поэтому подходим к оснащению индивидуально');
$audience_lead  = trimed_get_field_value('med_audience_lead', 'Мы <span class="text-green">поможем</span>, если вы:');
$audience_summary = trimed_get_field_value('med_audience_summary', 'Мы создаём продуманное оснащение, которое помогает клинике работать <em>уверенно</em> каждый день.');
$audience_summary = trimed_medcentry_format_audience_summary($audience_summary);

$included_subtitle = trimed_get_field_value('med_included_subtitle', 'Что входит');
$included_title = trimed_get_field_value('med_included_title', '<span class="text-green">Комплексное</span> оснащение клиники');
$included_label = trimed_get_field_value('med_included_label', 'Мы берём на себя весь процесс:');
$included_desc  = trimed_get_field_value('med_included_desc', 'Оснащение медицинского центра — это не просто закупка оборудования. Важно подобрать решения, которые будут соответствовать профилю клиники, нагрузке и бюджету.');
$included_result_text = trimed_get_field_value('med_included_result_text', 'В результате, вы получаете не просто оборудование, а продуманную систему для стабильной и комфортной работы клиники');

$projects_title = trimed_get_field_value('med_projects_title', '<span class="text-green">Реализованные</span> проекты');
$projects_desc  = trimed_medcentry_format_projects_desc(trimed_get_field_value('med_projects_desc', 'За время работы мы реализовали проекты по оснащению медицинских кабинетов и центров в Забайкальском крае. Мы понимаем специфику региона, требования врачей и реальные условия работы.'));
$projects_desc_mobile = trimed_get_field_value('med_projects_desc_mobile', 'За время работы мы реализовали проекты по оснащению медицинских кабинетов и центров в Забайкальском крае.');
$projects_desc_desktop = str_replace('. Мы понимаем', '.<br>Мы понимаем', $projects_desc);

$process_title    = trimed_get_field_value('med_process_title', 'Как <span class="text-green">проходит работа</span>');
$process_subtitle = trimed_get_field_value('med_process_subtitle', 'Мы выстроили понятный и прозрачный процесс работы, чтобы клиенту было комфортно на каждом этапе.');
$process_image    = trimed_image_field('med_process_image', $img_dir . '/process-main.png');

$request_title  = trimed_get_field_value('med_request_title', 'Подберём оборудование под вашу клинику');
$request_title = trimed_medcentry_format_request_title($request_title);
$request_desc   = trimed_get_field_value('med_request_desc', 'Оставьте заявку — свяжемся с вами, разберём задачу и предложим решение');
$request_desc_mobile = trimed_get_field_value('med_request_desc_mobile', 'Оставьте заявку, мы свяжемся с вами и предложим решение');
$request_button = trimed_get_field_value('med_request_button_text', 'Получить консультацию');

$why_title    = trimed_get_field_value('med_why_title', 'Почему выбирают <span class="text-green">ТриМед</span>');
$why_warehouse_title = trimed_get_field_value('med_why_warehouse_title', 'Собственный склад в Чите');
$why_cta_text = trimed_get_field_value('med_why_cta_text', 'Нужна консультация по оборудованию?');
$why_cta_button = trimed_get_field_value('med_why_cta_button_text', 'Оставить заявку');
$why_cta_image = trimed_image_field('med_why_cta_image', $img_dir . '/why-cta-image.png');

// Fallbacks
$audience_cards = trimed_repeater_field('med_audience_cards', array(
    array('text' => 'Открываете медицинский центр с нуля и не понимаете, с чего начать', 'image' => $img_dir . '/audience-1-desktop.png', 'style' => 'image'),
    array('text' => 'Расширяете клинику и добавляете новые кресла', 'image' => $img_dir . '/audience-2.png', 'style' => 'white'),
    array('text' => 'Хотите заменить устаревшее оборудование', 'image' => $img_dir . '/audience-icon.png', 'style' => 'gray'),
    array('text' => 'Хотите работать без простоев и задержек поставок', 'image' => '', 'style' => 'green'),
));

$included_cards = trimed_repeater_field('med_included_cards', array(
    array('image' => $img_dir . '/audience-1.png', 'number' => '1', 'title' => 'Подбор оборудования под профиль клиники'),
    array('image' => $img_dir . '/included-2.png', 'number' => '2', 'title' => 'Оснащение кабинетов (приём, диагностика, лечение)'),
    array('image' => $img_dir . '/included-3.png', 'number' => '3', 'title' => 'Подбор оборудования под профиль клиники'),
    array('image' => $img_dir . '/included-4.png', 'number' => '4', 'title' => 'Поставка со склада или под заказ'),
    array('image' => $img_dir . '/included-5.png', 'number' => '5', 'title' => 'Консультации на всех этапах'),
));

$projects = trimed_repeater_field('med_projects', array(
    array('image' => $img_dir . '/project-1.png', 'number' => '01.', 'title' => 'Стоматология «Дента-Профи» (г. Чита)', 'text' => 'Оснащение двух кабинетов под ключ: стоматологические установки, компрессорная, стерилизационная.'),
    array('image' => $img_dir . '/project-2.png', 'number' => '02.', 'title' => 'Медицинский центр «Семейный доктор» (г. Краснокаменск)', 'text' => 'Поставка и монтаж рентген-кабинета с радиационной защитой, пуско-наладка.'),
    array('image' => $img_dir . '/project-3.png', 'number' => '03.', 'title' => 'Центр «Здоровье Забайкалья» (пгт. Агинское)', 'text' => 'Полное оснащение стоматологического кабинета: оборудование, мебель, инструменты, обучение персонала.'),
    array('image' => $img_dir . '/project-4.png', 'number' => '04.', 'title' => 'Стоматологический кабинет «Улыбка Забайкалья» (г. Борзя)', 'text' => 'Комплексное оснащение с нуля: установка, стерилизационное оборудование, цифровой визиограф, дизайн-проект и расстановка мебели.'),
));

$process_steps = trimed_repeater_field('med_process_steps', array(
    array('number' => '1', 'title' => 'Консультация', 'text' => 'Обсуждаем задачи, формат клиники и требования'),
    array('number' => '2', 'title' => 'Подбор оборудования', 'text' => 'Подбираем решения под бюджет и задачи'),
    array('number' => '3', 'title' => 'Поставка', 'text' => 'Доставляем оборудование со склада или под заказ'),
    array('number' => '4', 'title' => 'Сопровождение', 'text' => 'Остаёмся на связи и помогаем при необходимости'),
));

$why_stats = trimed_repeater_field('med_why_stats', array(
    array('number' => '20+', 'text' => 'лет на рынке', 'style' => 'image'),
    array('number' => '5000+', 'text' => 'позиций оборудования', 'style' => 'gray'),
));

$why_features = trimed_repeater_field('med_why_features', array(
    array('text' => 'Прямые поставки от производителей', 'icon' => 'delivery'),
    array('text' => 'Собственный склад в Чите', 'icon' => 'warehouse'),
));

$clover_icon = trimed_get_clover_svg('mc-clover', 20);

$arrow_icon = trimed_get_arrow_svg('mc-arrow', 18, 1.6);

$header_clover = '<svg class="mc-header-clover" width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M46.2073 18.7079C40.7314 18.7079 36.2909 14.2673 36.2909 8.79123C36.2909 3.93718 32.3557 0 27.5 0C22.6443 0 18.7073 3.93718 18.7073 8.79123C18.7073 14.2673 14.2686 18.7079 8.79274 18.7079C3.93704 18.7079 0 22.6432 0 27.5009C0 32.3567 3.93704 36.2921 8.79274 36.2921C14.2686 36.2921 18.7073 40.7309 18.7073 46.207C18.7073 51.0646 22.6443 55 27.5 55C32.3557 55 36.2909 51.0646 36.2909 46.207C36.2909 40.7309 40.7314 36.2921 46.2073 36.2921C51.063 36.2921 55 32.3567 55 27.5009C55 22.6432 51.063 18.7079 46.2073 18.7079Z" fill="url(#paint0_linear_header)"/><defs><linearGradient id="paint0_linear_header" x1="9.5" y1="10.5" x2="44" y2="43.5" gradientUnits="userSpaceOnUse"><stop stop-color="#3F8D50"/><stop offset="1" stop-color="#51A462"/></linearGradient></defs></svg>';

$delivery_icon = '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.9403 14.5498L16.7986 17.6548C17.6069 20.5798 18.0103 22.0432 19.1986 22.7082C20.3869 23.3748 21.8953 22.9815 24.9119 22.1982L28.1119 21.3648C31.1286 20.5815 32.6369 20.1898 33.3236 19.0382C34.0103 17.8848 33.6069 16.4215 32.7969 13.4965L31.9403 10.3932C31.1319 7.4665 30.7269 6.00317 29.5403 5.33817C28.3503 4.6715 26.8419 5.06483 23.8253 5.84983L20.6253 6.67983C17.6086 7.46317 16.1003 7.8565 15.4153 9.00983C14.7286 10.1615 15.1319 11.6248 15.9403 14.5498Z" fill="url(#paint0_wh_delivery)"/><path d="M3.79531 8.74496C3.83922 8.58667 3.91391 8.43859 4.01509 8.30918C4.11627 8.17976 4.24196 8.07157 4.38499 7.99077C4.52801 7.90997 4.68556 7.85815 4.84862 7.83828C5.01169 7.81841 5.17707 7.83087 5.33531 7.87496L8.17365 8.66163C8.92566 8.86637 9.61189 9.26223 10.1656 9.8107C10.7194 10.3592 11.1217 11.0416 11.3336 11.7916L14.9186 24.7683L15.182 25.68C16.2449 26.0717 17.1406 26.8174 17.7186 27.7916L18.2353 27.6316L33.0186 23.79C33.1775 23.7486 33.343 23.7389 33.5057 23.7615C33.6683 23.7841 33.8249 23.8385 33.9665 23.9216C34.1081 24.0047 34.232 24.1149 34.331 24.2459C34.43 24.3769 34.5023 24.5261 34.5436 24.685C34.585 24.8439 34.5947 25.0094 34.5721 25.172C34.5495 25.3346 34.4951 25.4912 34.412 25.6328C34.3289 25.7744 34.2187 25.8983 34.0877 25.9973C33.9567 26.0963 33.8075 26.1686 33.6486 26.21L18.9203 30.0366L18.3703 30.2066C18.3603 32.3233 16.8986 34.26 14.687 34.8333C12.037 35.5233 9.31198 33.9966 8.60198 31.4266C7.89198 28.8566 9.46531 26.2116 12.1153 25.5233C12.2475 25.49 12.3792 25.4611 12.5103 25.4366L8.92365 12.4566C8.82665 12.1234 8.6453 11.8208 8.39712 11.5782C8.14894 11.3355 7.84234 11.1611 7.50698 11.0716L4.66698 10.2833C4.50872 10.2396 4.36063 10.1651 4.23116 10.0641C4.1017 9.96307 3.9934 9.83757 3.91246 9.69471C3.83151 9.55185 3.7795 9.39445 3.7594 9.23149C3.7393 9.06853 3.7515 8.90321 3.79531 8.74496Z" fill="url(#paint1_wh_delivery)"/><defs><linearGradient id="paint0_wh_delivery" x1="18.2795" y1="19.6018" x2="29.6109" y2="8.42707" gradientUnits="userSpaceOnUse"><stop stop-color="#3F8D50"/><stop offset="1" stop-color="#51A462"/></linearGradient><linearGradient id="paint1_wh_delivery" x1="9.07587" y1="29.8121" x2="26.0784" y2="11.3556" gradientUnits="userSpaceOnUse"><stop stop-color="#3F8D50"/><stop offset="1" stop-color="#51A462"/></linearGradient></defs></svg>';

$warehouse_icon = '<svg width="32" height="29" viewBox="0 0 32 29" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M32 25.7512V8.45106C32 7.11903 31.2 5.9332 29.984 5.42963L17.184 0.23148C16.416 -0.0771601 15.568 -0.0771601 14.8 0.23148L2 5.42963C0.8 5.9332 0 7.13528 0 8.45106V25.7512C0 27.538 1.44 29 3.2 29H8V14.3802H24V29H28.8C30.56 29 32 27.538 32 25.7512ZM14.4 25.7512H11.2V29H14.4V25.7512ZM17.6 20.8779H14.4V24.1267H17.6V20.8779ZM20.8 25.7512H17.6V29H20.8V25.7512Z" fill="url(#paint0_wh_warehouse)"/><defs><linearGradient id="paint0_wh_warehouse" x1="5.52727" y1="23.4636" x2="23.7097" y2="4.27264" gradientUnits="userSpaceOnUse"><stop stop-color="#3F8D50"/><stop offset="1" stop-color="#51A462"/></linearGradient></defs></svg>';

?>

<main class="medcentry-page">

    <section class="mc-hero">
        <div class="mc-container">
            <div class="mc-hero-grid">
                <div class="mc-hero-left">
                    <h1 class="mc-hero-title"><?php echo wp_kses_post($hero_title); ?></h1>
                    <p class="mc-hero-desc"><?php echo esc_html($hero_desc); ?></p>

                    <div class="mc-hero-features">
                        <div class="mc-hero-feature-card mc-hero-feature-card--image">
                            <img src="<?php echo esc_url($hero_feature_bg); ?>" alt="">
                        </div>
                        <div class="mc-hero-feature-card mc-hero-feature-card--warehouse">
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
            <p class="mc-audience-label"><?php echo esc_html($audience_label); ?></p>
            <div class="mc-audience-header">
                <?php echo $header_clover; ?>
                <h2 class="mc-audience-title"><?php echo wp_kses_post($audience_title); ?></h2>
                <p class="mc-audience-desc"><?php echo esc_html($audience_desc); ?></p>
            </div>

            <div class="mc-audience-body">
                <p class="mc-audience-lead"><?php echo wp_kses_post($audience_lead); ?></p>

                <div class="mc-audience-grid">
                    <?php $audience_index = 0; foreach ($audience_cards as $card) : $audience_index++;
                        $card_style = !empty($card['style']) ? $card['style'] : 'default';
                        $card_class = trimed_audience_card_class('medcentry', $card_style);
                        $card_image = !empty($card['image']) ? $card['image'] : '';
                    ?>
                        <div class="<?php echo esc_attr($card_class); ?>">
                            <?php echo $clover_icon; ?>
                            <p class="text"><?php echo esc_html($card['text']); ?></p>
                            <?php if ($card_style === 'image' || $card_style === 'white' || $card_style === 'gray') : ?>
                                <img src="<?php echo esc_url($card_image ? $card_image : $placeholder); ?>" alt="" class="mc-audience-card-img">
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <p class="mc-audience-summary"><?php echo wp_kses_post($audience_summary); ?></p>
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

    <?php if (trimed_is_page_section_enabled('med_show_projects')) : ?>
    <section class="mc-projects trimed-projects">
        <div class="mc-section-inner">
            <div class="mc-projects-header">
                <h2 class="mc-projects-title"><?php echo wp_kses_post($projects_title); ?></h2>
                <p class="mc-projects-desc mc-projects-desc--desktop"><?php echo wp_kses_post($projects_desc_desktop); ?></p>
                <p class="mc-projects-desc mc-projects-desc--mobile"><?php echo esc_html($projects_desc_mobile); ?></p>
            </div>

            <div class="mc-projects-grid trimed-projects-grid">
                <?php
                foreach ($projects as $project_index => $project) :
                    trimed_render_case_card(array(
                        'variant'          => 'medcentry',
                        'image'            => !empty($project['image']) ? $project['image'] : $placeholder,
                        'mobile_image'     => !empty($project['mobile_image']) ? $project['mobile_image'] : '',
                        'meta'             => $project['number'],
                        'title'            => $project['title'],
                        'text'             => $project['text'],
                        'arrow'            => $arrow_icon,
                        'responsive_image' => true,
                    ));
                endforeach;
                ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="mc-process">
        <div class="mc-section-inner">
            <div class="mc-process-grid">
                <div class="mc-process-header">
                    <h2 class="mc-process-title">
                        <span class="mc-process-title-desktop"><?php echo wp_kses_post($process_title); ?></span>
                        <span class="mc-process-title-mobile">Как мы <span class="text-green">работаем</span></span>
                    </h2>
                    <p class="mc-process-subtitle"><?php echo esc_html($process_subtitle); ?></p>
                </div>
                <div class="mc-process-cards">
                    <?php $step_index = 0; foreach ($process_steps as $step) : $step_index++; ?>
                        <div class="mc-process-card <?php echo $step_index === 1 ? 'mc-process-card--green' : 'mc-process-card--light'; ?>">
                            <span class="mc-process-card-num"><?php echo esc_html($step['number']); ?></span>
                            <?php if ($step_index === 1) echo $clover_icon; ?>
                            <h3 class="mc-process-card-title"><?php echo esc_html($step['title']); ?></h3>
                            <p class="mc-process-card-text"><?php echo esc_html($step['text']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mc-process-image"><img src="<?php echo esc_url($process_image); ?>" alt=""></div>
            </div>
        </div>
    </section>

    <?php
    trimed_render_request_callout(array(
        'section_class'      => 'home-request mc-request',
        'section_id'         => 'request',
        'title'              => $request_title,
        'description'        => $request_desc,
        'description_mobile' => $request_desc_mobile,
        'form_args'          => array(
            'button_text'        => $request_button,
            'button_mobile_text' => 'Отправить',
        ),
    ));
    ?>

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
                    <img src="<?php echo esc_url($why_cta_image); ?>" alt="" class="mc-why-cta-bg">
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
