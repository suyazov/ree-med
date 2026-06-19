<?php
/*
Template Name: Стоматология
*/
get_header();

$img_dir = get_template_directory_uri() . '/assets/img';
$placeholder = $img_dir . '/placeholder.jpg';

function stom_image_url($field, $placeholder) {
    $url = get_field($field);
    return !empty($url) ? $url : $placeholder;
}

$hero_title = get_field('stom_hero_title') ?: 'Оснащение стоматологии под ключ в Забайкальском крае';
$hero_desc  = get_field('stom_hero_desc') ?: 'Подберём оборудование, поставим и поможем запустить кабинет без лишних затрат и ошибок';
$hero_btn   = get_field('stom_hero_button_text') ?: 'Получить консультацию';
$hero_image = stom_image_url('stom_hero_image', $placeholder);
$hero_features = get_field('stom_hero_features');
$hero_badge_glass_text = get_field('stom_hero_badge_glass_text') ?: 'Работаем с частными и государственными клиниками';
$hero_badge_green_num  = get_field('stom_hero_badge_green_num') ?: '5000+';
$hero_badge_green_text = get_field('stom_hero_badge_green_text') ?: 'позиций в наличии';

$audience_label = get_field('stom_audience_label') ?: 'Кому подходит';
$audience_title = get_field('stom_audience_title') ?: 'Работаем со стоматологиями на разных этапах';
$audience_desc  = get_field('stom_audience_desc') ?: 'Мы понимаем, что задачи у всех разные: кто-то открывается с нуля, кто-то расширяется, а кто-то просто хочет обновить оборудование.';
$audience_lead  = get_field('stom_audience_lead') ?: 'Мы будем полезны, если вы:';
$audience_cards = get_field('stom_audience_cards');
$audience_summary = get_field('stom_audience_summary') ?: 'Мы помогаем не просто купить оборудование, а сделать так, чтобы кабинет начал работать максимально эффективно за короткие сроки.';

$included_title = get_field('stom_included_title') ?: 'Что входит в оснащение стоматологии';
$included_label = get_field('stom_included_label') ?: 'Мы берём на себя весь процесс:';
$included_desc  = get_field('stom_included_desc') ?: 'Оснащение стоматологического кабинета — это не только установка кресла. Важно учесть всё: от компрессоров до удобства работы врача.';
$included_cards = get_field('stom_included_cards');
$included_result_text = get_field('stom_included_result_text') ?: 'В результате вы получаете полностью готовый к работе кабинет в одном месте';

$projects_title = get_field('stom_projects_title') ?: 'Реализованные проекты';
$projects_desc  = get_field('stom_projects_desc') ?: 'Мы уже помогли оснастить стоматологические кабинеты в Забайкальском крае, как частные, так и государственные. Понимаем, какие решения подходят для региона и какие задачи стоят перед врачами.';
$projects = get_field('stom_projects');

$process_title    = get_field('stom_process_title') ?: 'Как проходит работа';
$process_subtitle = get_field('stom_process_subtitle') ?: 'Мы выстроили простой и понятный процесс, чтобы вы не тратили время на разбор оборудования.';
$process_steps    = get_field('stom_process_steps');
$process_image    = stom_image_url('stom_process_image', $placeholder);

$request_title  = get_field('stom_request_title') ?: 'Подберём оборудование под вашу стоматологию';
$request_desc   = get_field('stom_request_desc') ?: 'Оставьте заявку — свяжемся с вами и предложим решение';
$request_note   = get_field('stom_request_note') ?: 'Консультация бесплатная';
$request_button = get_field('stom_request_button_text') ?: 'Получить консультацию';

$why_title    = get_field('stom_why_title') ?: 'Почему выбирают ТриМед';
$why_stats    = get_field('stom_why_stats');
$why_features = get_field('stom_why_features');
$why_warehouse_title = get_field('stom_why_warehouse_title') ?: 'Собственный склад в Чите';
$why_warehouse_image = stom_image_url('stom_why_warehouse_image', $placeholder);

$cta_text   = get_field('stom_cta_text') ?: 'Если вы планируете открыть стоматологию или обновить оборудование — мы поможем подобрать решения под вашу задачу и бюджет';
$cta_button = get_field('stom_cta_button_text') ?: 'Получить консультацию';

// Fallbacks for repeaters
if (empty($hero_features) || !is_array($hero_features)) {
    $hero_features = array(
        array('text' => 'Помогаем подобрать оборудование под задачи и бюджет'),
        array('text' => '<strong>Склад в Чите</strong> — быстрая поставка без ожидания'),
    );
}

if (empty($audience_cards) || !is_array($audience_cards)) {
    $audience_cards = array(
        array('text' => 'Открываете стоматологический кабинет и не знаете, какое оборудование выбрать', 'image' => '', 'style' => 'image'),
        array('text' => 'Расширяете клинику и добавляете новые кресла', 'image' => $placeholder, 'style' => 'white'),
        array('text' => 'Хотите заменить устаревшее оборудование', 'image' => $placeholder, 'style' => 'gray'),
        array('text' => 'Хотите работать без простоев и задержек поставок', 'image' => '', 'style' => 'green'),
    );
}

if (empty($included_cards) || !is_array($included_cards)) {
    $included_cards = array(
        array('image' => $placeholder, 'number' => '1', 'title' => 'Подбор стоматологических установок'),
        array('image' => $placeholder, 'number' => '2', 'title' => 'Компрессоры и аспирационные системы'),
        array('image' => $placeholder, 'number' => '3', 'title' => 'Стоматологические инструменты и оборудование'),
        array('image' => $placeholder, 'number' => '4', 'title' => 'Мебель и оснащение кабинета'),
        array('image' => $placeholder, 'number' => '5', 'title' => 'Поставку оборудования'),
        array('image' => $placeholder, 'number' => '6', 'title' => 'Консультации на всех этапах'),
    );
}

if (empty($projects) || !is_array($projects)) {
    $projects = array(
        array(
            'image' => $placeholder,
            'number' => '01.',
            'title' => 'Стоматология «Дента-Профи» (г. Чита)',
            'text' => 'Оснащение двух кабинетов под ключ: стоматологические установки, компрессорная, стерилизационная.',
        ),
        array(
            'image' => $placeholder,
            'number' => '02.',
            'title' => 'Стоматологический кабинет «Улыбка Забайкалья» (г. Борзя)',
            'text' => 'Комплексное оснащение с нуля: установка, стерилизационное оборудование, цифровой визиограф, дизайн-проект и расстановка мебели.',
        ),
        array(
            'image' => $placeholder,
            'number' => '03.',
            'title' => 'Стоматологический кабинет «Улыбка Забайкалья» (г. Борзя)',
            'text' => 'Комплексное оснащение с нуля: установка, стерилизационное оборудование, цифровой визиограф, дизайн-проект и расстановка мебели.',
        ),
        array(
            'image' => $placeholder,
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
        array('number' => '4', 'title' => 'Запуск', 'text' => 'Помогаем подготовить кабинет к работе', 'image' => $placeholder),
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
                    <h1 class="stom-hero-title"><?php echo esc_html($hero_title); ?></h1>
                    <p class="stom-hero-desc"><?php echo esc_html($hero_desc); ?></p>

                    <div class="stom-hero-features">
                        <img src="<?php echo esc_url($hero_image); ?>" alt="" class="stom-hero-feature-img">
                        <div class="stom-hero-feature-cards">
                            <?php foreach ($hero_features as $feature) : ?>
                                <div class="stom-hero-feature-card">
                                    <span class="check"></span>
                                    <span><?php echo wp_kses_post($feature['text']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <button class="stom-hero-btn" type="button"><?php echo esc_html($hero_btn); ?></button>
                </div>

                <div class="stom-hero-right">
                    <img src="<?php echo esc_url($hero_image); ?>" alt="" class="stom-hero-image">
                    <div class="stom-hero-badges">
                        <div class="stom-hero-badge-glass">
                            <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="11" fill="#E6E7E8"/><path d="M6 12l4 4 8-8" stroke="#315046" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
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
                <svg class="icon" viewBox="0 0 55 55" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="27.5" cy="27.5" r="24"/>
                    <path d="M18 27h8m0 0h8m-8 0v-8m0 8v8" stroke-linecap="round"/>
                </svg>
                <div>
                    <p class="stom-audience-label"><?php echo esc_html($audience_label); ?></p>
                    <h2 class="stom-audience-title"><?php echo esc_html($audience_title); ?></h2>
                </div>
                <p class="stom-audience-desc"><?php echo esc_html($audience_desc); ?></p>
            </div>

            <p class="stom-audience-lead"><?php echo esc_html($audience_lead); ?></p>

            <div class="stom-audience-grid">
                <?php $audience_index = 0; foreach ($audience_cards as $card) : $audience_index++;
                    $card_style = !empty($card['style']) ? $card['style'] : 'default';
                    $card_class = isset($audience_style_classes[$card_style]) ? $audience_style_classes[$card_style] : $audience_style_classes['default'];
                    $card_image = !empty($card['image']) ? $card['image'] : '';
                    $arrow_class = ($audience_index % 2 === 1) ? 'arrow--br' : 'arrow--tr';
                ?>
                    <div class="<?php echo esc_attr($card_class); ?>">
                        <svg class="arrow <?php echo esc_attr($arrow_class); ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                        <p class="text"><?php echo esc_html($card['text']); ?></p>
                        <?php if ($card_style === 'white' || $card_style === 'gray') : ?>
                            <img src="<?php echo esc_url(!empty($card_image) ? $card_image : $placeholder); ?>" alt="" style="position:absolute; right:0; bottom:0; width:154px; height:132px; object-fit:cover; opacity:.8;">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <p class="stom-audience-summary"><?php echo esc_html($audience_summary); ?></p>
        </div>
    </section>

    <section class="stom-included">
        <div class="stom-container">
            <div class="stom-included-header">
                <div>
                    <h2 class="stom-included-title"><?php echo esc_html($included_title); ?></h2>
                    <p class="stom-included-label"><?php echo esc_html($included_label); ?></p>
                </div>
                <p class="stom-included-desc"><?php echo esc_html($included_desc); ?></p>
            </div>

            <div class="stom-included-top">
                <?php foreach ($included_top as $card) : ?>
                    <div class="stom-included-card">
                        <div class="stom-included-card-img"><img src="<?php echo esc_url(!empty($card['image']) ? $card['image'] : $placeholder); ?>" alt=""></div>
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
                        <div class="stom-included-card-img"><img src="<?php echo esc_url(!empty($card['image']) ? $card['image'] : $placeholder); ?>" alt=""></div>
                        <div class="stom-included-card-body">
                            <span class="stom-included-card-num"><?php echo esc_html($card['number']); ?></span>
                            <p class="stom-included-card-title"><?php echo esc_html($card['title']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="stom-included-result">
                    <svg class="arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
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
                        <div class="stom-project-card-img"><img src="<?php echo esc_url(!empty($project['image']) ? $project['image'] : $placeholder); ?>" alt=""></div>
                        <div class="stom-project-card-body">
                            <div class="stom-project-card-top">
                                <span class="stom-project-card-num"><?php echo esc_html($project['number']); ?></span>
                                <span class="stom-project-card-arrow"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg></span>
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
            <div class="stom-process-header">
                <h2 class="stom-process-title"><?php echo esc_html($process_title); ?></h2>
                <p class="stom-process-subtitle"><?php echo esc_html($process_subtitle); ?></p>
            </div>
            <div class="stom-process-grid">
                <div class="stom-process-cards">
                    <?php $step_index = 0; foreach ($process_steps as $step) : $step_index++; ?>
                        <div class="stom-process-card <?php echo $step_index === 1 ? 'stom-process-card--green' : 'stom-process-card--light'; ?>">
                            <span class="stom-process-card-num"><?php echo esc_html($step['number']); ?></span>
                            <h3 class="stom-process-card-title"><?php echo esc_html($step['title']); ?></h3>
                            <p class="stom-process-card-text"><?php echo esc_html($step['text']); ?></p>
                            <?php if (!empty($step['image'])) : ?>
                                <img src="<?php echo esc_url($step['image']); ?>" alt="" style="position:absolute; right:0; bottom:0; width:236px; height:162px; object-fit:cover; opacity:.7;">
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="stom-process-image"><img src="<?php echo esc_url($process_image); ?>" alt=""></div>
            </div>
        </div>
    </section>

    <section class="stom-request">
        <div class="stom-request-inner">
            <svg class="stom-request-icon" viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="4" y="8" width="32" height="24" rx="4"/>
                <path d="M4 12l16 12 16-12" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div>
                <h2 class="stom-request-title"><?php echo esc_html($request_title); ?></h2>
                <p class="stom-request-desc"><?php echo esc_html($request_desc); ?></p>
                <div class="stom-request-note">
                    <span class="check"><svg width="10" height="8" viewBox="0 0 12 10" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 5l3 3 5-6"/></svg></span>
                    <span><?php echo esc_html($request_note); ?></span>
                </div>
            </div>
            <form id="contact-form" class="stom-request-form">
                <input type="text" name="name" placeholder="Иванов Николай Сергеевич" required>
                <input type="tel" name="phone" placeholder="+7 (999) 999-99-99" required>
                <textarea name="comment" placeholder="Ваш комментарий"></textarea>
                <label class="checkbox">
                    <input type="checkbox" name="agree" value="1" required>
                    <span>Оставляя заявку, я соглашаюсь с условиями Политики обработки персональных данных</span>
                </label>
                <div class="form-message"></div>
                <button type="submit"><?php echo esc_html($request_button); ?></button>
            </form>
        </div>
    </section>

    <section class="stom-why">
        <div class="stom-section-inner">
            <div class="stom-why-header">
                <h2 class="stom-why-title"><?php echo esc_html($why_title); ?></h2>
            </div>
            <div class="stom-why-grid">
                <div class="stom-why-left">
                    <div class="stom-why-stats">
                        <?php foreach ($why_stats as $stat) :
                            $stat_style = !empty($stat['style']) ? $stat['style'] : 'gray';
                            $stat_class = 'stom-why-stat--' . $stat_style;
                        ?>
                            <div class="stom-why-stat <?php echo esc_attr($stat_class); ?>">
                                <span class="num"><?php echo esc_html($stat['number']); ?></span>
                                <span class="txt"><?php echo esc_html($stat['text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="stom-why-features">
                        <?php foreach ($why_features as $feature) : ?>
                            <div class="stom-why-feature">
                                <svg viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2"><circle cx="16" cy="16" r="12"/><path d="M11 16h10M16 11v10" stroke-linecap="round"/></svg>
                                <span><?php echo esc_html($feature['text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="stom-why-warehouse">
                    <h3 class="stom-why-warehouse-title"><?php echo esc_html($why_warehouse_title); ?></h3>
                    <img src="<?php echo esc_url($why_warehouse_image); ?>" alt="">
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
            <button class="stom-cta-btn" type="button"><?php echo esc_html($cta_button); ?></button>
        </div>
    </section>

</main>

<?php
get_footer();
