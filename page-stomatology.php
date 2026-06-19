<?php
/*
Template Name: Стоматология
*/
get_header();

$img_dir = get_template_directory_uri() . '/assets/img';

$hero_title = get_field('stom_hero_title') ?: 'Оснащение стоматологии под ключ в Забайкальском крае';
$hero_desc  = get_field('stom_hero_desc') ?: 'Подберём оборудование, поставим и поможем запустить кабинет без лишних затрат и ошибок';
$hero_btn   = get_field('stom_hero_button_text') ?: 'Получить консультацию';
?>

<main class="stomatology-page">

    <section class="stom-hero">
        <div class="stom-container">
            <div class="stom-hero-grid">
                <div class="stom-hero-left">
                    <h1 class="stom-hero-title"><?php echo esc_html($hero_title); ?></h1>
                    <p class="stom-hero-desc"><?php echo esc_html($hero_desc); ?></p>

                    <div class="stom-hero-features">
                        <img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt="" class="stom-hero-feature-img">
                        <div class="stom-hero-feature-cards">
                            <div class="stom-hero-feature-card">
                                <span class="check"></span>
                                <span>Помогаем подобрать оборудование под задачи и бюджет</span>
                            </div>
                            <div class="stom-hero-feature-card">
                                <span class="check"></span>
                                <span><strong>Склад в Чите</strong> — быстрая поставка без ожидания</span>
                            </div>
                        </div>
                    </div>

                    <button class="stom-hero-btn" type="button"><?php echo esc_html($hero_btn); ?></button>
                </div>

                <div class="stom-hero-right">
                    <img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt="" class="stom-hero-image">
                    <div class="stom-hero-badges">
                        <div class="stom-hero-badge-glass">
                            <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="11" fill="#E6E7E8"/><path d="M6 12l4 4 8-8" stroke="#315046" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span>Работаем с частными и государственными клиниками</span>
                        </div>
                        <div class="stom-hero-badge-green">
                            <span class="num">5000+</span>
                            <span class="txt">позиций в наличии</span>
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
                    <p class="stom-audience-label">Кому подходит</p>
                    <h2 class="stom-audience-title">Работаем со стоматологиями на разных этапах</h2>
                </div>
                <p class="stom-audience-desc">Мы понимаем, что задачи у всех разные: кто-то открывается с нуля, кто-то расширяется, а кто-то просто хочет обновить оборудование.</p>
            </div>

            <p class="stom-audience-lead">Мы будем полезны, если вы:</p>

            <div class="stom-audience-grid">
                <div class="stom-audience-card stom-audience-card--image">
                    <svg class="arrow arrow--br" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                    <p class="text">Открываете стоматологический кабинет и не знаете, какое оборудование выбрать</p>
                </div>
                <div class="stom-audience-card stom-audience-card--white">
                    <svg class="arrow arrow--tr" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                    <p class="text">Расширяете клинику и добавляете новые кресла</p>
                    <img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt="" style="position:absolute; right:0; bottom:0; width:154px; height:132px; object-fit:cover; opacity:.8;">
                </div>
                <div class="stom-audience-card stom-audience-card--gray">
                    <svg class="arrow arrow--br" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                    <p class="text">Хотите заменить устаревшее оборудование</p>
                    <img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt="" style="position:absolute; right:0; bottom:0; width:100px; height:100px; object-fit:cover; opacity:.6;">
                </div>
                <div class="stom-audience-card stom-audience-card--green">
                    <svg class="arrow arrow--tr" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                    <p class="text">Хотите работать без простоев и задержек поставок</p>
                </div>
            </div>

            <p class="stom-audience-summary">Мы помогаем не просто купить оборудование, а сделать так, чтобы кабинет начал работать максимально эффективно за короткие сроки.</p>
        </div>
    </section>

    <section class="stom-included">
        <div class="stom-container">
            <div class="stom-included-header">
                <div>
                    <h2 class="stom-included-title">Что входит в оснащение стоматологии</h2>
                    <p class="stom-included-label">Мы берём на себя весь процесс:</p>
                </div>
                <p class="stom-included-desc">Оснащение стоматологического кабинета — это не только установка кресла. Важно учесть всё: от компрессоров до удобства работы врача.</p>
            </div>

            <div class="stom-included-top">
                <div class="stom-included-card">
                    <div class="stom-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                    <div class="stom-included-card-body">
                        <span class="stom-included-card-num">1</span>
                        <p class="stom-included-card-title">Подбор стоматологических установок</p>
                    </div>
                </div>
                <div class="stom-included-card">
                    <div class="stom-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                    <div class="stom-included-card-body">
                        <span class="stom-included-card-num">2</span>
                        <p class="stom-included-card-title">Компрессоры и аспирационные системы</p>
                    </div>
                </div>
                <div class="stom-included-card">
                    <div class="stom-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                    <div class="stom-included-card-body">
                        <span class="stom-included-card-num">3</span>
                        <p class="stom-included-card-title">Стоматологические инструменты и оборудование</p>
                    </div>
                </div>
            </div>

            <div class="stom-included-bottom">
                <div class="stom-included-card">
                    <div class="stom-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                    <div class="stom-included-card-body">
                        <span class="stom-included-card-num">4</span>
                        <p class="stom-included-card-title">Мебель и оснащение кабинета</p>
                    </div>
                </div>
                <div class="stom-included-card">
                    <div class="stom-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                    <div class="stom-included-card-body">
                        <span class="stom-included-card-num">5</span>
                        <p class="stom-included-card-title">Поставку оборудования</p>
                    </div>
                </div>
                <div class="stom-included-card">
                    <div class="stom-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                    <div class="stom-included-card-body">
                        <span class="stom-included-card-num">6</span>
                        <p class="stom-included-card-title">Консультации на всех этапах</p>
                    </div>
                </div>
                <div class="stom-included-result">
                    <svg class="arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                    <p>В результате вы получаете полностью готовый к работе кабинет в одном месте</p>
                </div>
            </div>
        </div>
    </section>

    <section class="stom-projects">
        <div class="stom-section-inner">
            <div class="stom-projects-header">
                <h2 class="stom-projects-title">Реализованные проекты</h2>
                <p class="stom-projects-desc">Мы уже помогли оснастить стоматологические кабинеты в Забайкальском крае, как частные, так и государственные. Понимаем, какие решения подходят для региона и какие задачи стоят перед врачами.</p>
            </div>

            <div class="stom-projects-grid">
                <div class="stom-project-card">
                    <div class="stom-project-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                    <div class="stom-project-card-body">
                        <div class="stom-project-card-top">
                            <span class="stom-project-card-num">01.</span>
                            <span class="stom-project-card-arrow"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg></span>
                        </div>
                        <div>
                            <h3 class="stom-project-card-title">Стоматология «Дента-Профи» (г. Чита)</h3>
                            <p class="stom-project-card-text">Оснащение двух кабинетов под ключ: стоматологические установки, компрессорная, стерилизационная.</p>
                        </div>
                    </div>
                </div>
                <div class="stom-project-card">
                    <div class="stom-project-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                    <div class="stom-project-card-body">
                        <div class="stom-project-card-top">
                            <span class="stom-project-card-num">02.</span>
                            <span class="stom-project-card-arrow"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg></span>
                        </div>
                        <div>
                            <h3 class="stom-project-card-title">Стоматологический кабинет «Улыбка Забайкалья» (г. Борзя)</h3>
                            <p class="stom-project-card-text">Комплексное оснащение с нуля: установка, стерилизационное оборудование, цифровой визиограф, дизайн-проект и расстановка мебели.</p>
                        </div>
                    </div>
                </div>
                <div class="stom-project-card">
                    <div class="stom-project-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                    <div class="stom-project-card-body">
                        <div class="stom-project-card-top">
                            <span class="stom-project-card-num">03.</span>
                            <span class="stom-project-card-arrow"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg></span>
                        </div>
                        <div>
                            <h3 class="stom-project-card-title">Стоматологический кабинет «Улыбка Забайкалья» (г. Борзя)</h3>
                            <p class="stom-project-card-text">Комплексное оснащение с нуля: установка, стерилизационное оборудование, цифровой визиограф, дизайн-проект и расстановка мебели.</p>
                        </div>
                    </div>
                </div>
                <div class="stom-project-card">
                    <div class="stom-project-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                    <div class="stom-project-card-body">
                        <div class="stom-project-card-top">
                            <span class="stom-project-card-num">04.</span>
                            <span class="stom-project-card-arrow"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg></span>
                        </div>
                        <div>
                            <h3 class="stom-project-card-title">Стоматология «Дента-Профи» (г. Чита)</h3>
                            <p class="stom-project-card-text">Оснащение двух кабинетов под ключ: стоматологические установки, компрессорная, стерилизационная.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stom-process">
        <div class="stom-section-inner">
            <div class="stom-process-header">
                <h2 class="stom-process-title">Как проходит работа</h2>
                <p class="stom-process-subtitle">Мы выстроили простой и понятный процесс, чтобы вы не тратили время на разбор оборудования.</p>
            </div>
            <div class="stom-process-grid">
                <div class="stom-process-cards">
                    <div class="stom-process-card stom-process-card--green">
                        <span class="stom-process-card-num">1</span>
                        <h3 class="stom-process-card-title">Консультация</h3>
                        <p class="stom-process-card-text">Обсуждаем формат кабинета и задачи</p>
                    </div>
                    <div class="stom-process-card stom-process-card--light">
                        <span class="stom-process-card-num">2</span>
                        <h3 class="stom-process-card-title">Подбор оборудования</h3>
                        <p class="stom-process-card-text">Подбираем решения под бюджет и нагрузку</p>
                    </div>
                    <div class="stom-process-card stom-process-card--light">
                        <span class="stom-process-card-num">3</span>
                        <h3 class="stom-process-card-title">Поставка</h3>
                        <p class="stom-process-card-text">Доставляем оборудование со склада или под заказ</p>
                    </div>
                    <div class="stom-process-card stom-process-card--light">
                        <span class="stom-process-card-num">4</span>
                        <h3 class="stom-process-card-title">Запуск</h3>
                        <p class="stom-process-card-text">Помогаем подготовить кабинет к работе</p>
                        <img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt="" style="position:absolute; right:0; bottom:0; width:236px; height:162px; object-fit:cover; opacity:.7;">
                    </div>
                </div>
                <div class="stom-process-image"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
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
                <h2 class="stom-request-title">Подберём оборудование под вашу стоматологию</h2>
                <p class="stom-request-desc">Оставьте заявку — свяжемся с вами и предложим решение</p>
                <div class="stom-request-note">
                    <span class="check"><svg width="10" height="8" viewBox="0 0 12 10" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 5l3 3 5-6"/></svg></span>
                    <span>Консультация бесплатная</span>
                </div>
            </div>
            <form class="stom-request-form" onsubmit="return false;">
                <input type="text" placeholder="Иванов Николай Сергеевич">
                <input type="tel" placeholder="+7 (999) 999-99-99">
                <textarea placeholder="Ваш комментарий"></textarea>
                <label class="checkbox">
                    <input type="checkbox">
                    <span>Оставляя заявку, я соглашаюсь с условиями Политики обработки персональных данных</span>
                </label>
                <button type="submit">Получить консультацию</button>
            </form>
        </div>
    </section>

    <section class="stom-why">
        <div class="stom-section-inner">
            <div class="stom-why-header">
                <h2 class="stom-why-title">Почему выбирают ТриМед</h2>
            </div>
            <div class="stom-why-grid">
                <div class="stom-why-left">
                    <div class="stom-why-stats">
                        <div class="stom-why-stat stom-why-stat--img">
                            <span class="num">20+</span>
                            <span class="txt">лет на рынке</span>
                        </div>
                        <div class="stom-why-stat stom-why-stat--gray">
                            <span class="num">5000+</span>
                            <span class="txt">позиций оборудования</span>
                        </div>
                    </div>
                    <div class="stom-why-features">
                        <div class="stom-why-feature">
                            <svg viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2"><circle cx="16" cy="16" r="12"/><path d="M11 16h10M16 11v10" stroke-linecap="round"/></svg>
                            <span>Понимаем специфику стоматологий</span>
                        </div>
                        <div class="stom-why-feature">
                            <svg viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 16h4l4-8 6 12 4-8h4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span>Работаем с клиниками по всему краю</span>
                        </div>
                    </div>
                </div>
                <div class="stom-why-warehouse">
                    <h3 class="stom-why-warehouse-title">Собственный склад в Чите</h3>
                    <img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt="">
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
            <p class="stom-cta-text">Если вы планируете открыть стоматологию или обновить оборудование — мы поможем подобрать решения под вашу задачу и бюджет</p>
            <button class="stom-cta-btn" type="button">Получить консультацию</button>
        </div>
    </section>

</main>

<?php
get_footer();
