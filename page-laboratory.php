<?php
/*
Template Name: Лаборатория
*/
get_header();

$img_dir = get_template_directory_uri() . '/assets/img';

$hero_title = (function_exists('get_field') && get_field('lab_hero_title')) ? get_field('lab_hero_title') : 'Оснащение лабораторий под ключ в Чите и Забайкальском крае';
$hero_desc  = (function_exists('get_field') && get_field('lab_hero_desc')) ? get_field('lab_hero_desc') : 'Подбираем и поставляем лабораторное оборудование для медицинских, клинико-диагностических, исследовательских и производственных лабораторий.';
$hero_btn   = (function_exists('get_field') && get_field('lab_hero_button_text')) ? get_field('lab_hero_button_text') : 'Получить консультацию';
?>

<main class="laboratory-page">

<!-- 1. Hero -->
<section class="lab-hero">
    <div class="lab-container">
        <div class="lab-hero-grid">
            <div class="lab-hero-left">
                <div class="lab-hero-top">
                    <h1 class="lab-hero-title"><?php echo wp_kses_post(str_replace('лабораторий', '<span class="text-green">лабораторий</span>', $hero_title)); ?></h1>
                    <p class="lab-hero-desc"><?php echo esc_html($hero_desc); ?></p>
                </div>

                <div class="lab-hero-features">
                    <div class="lab-hero-feature-card">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2h4l2 5h-8z"/><path d="M12 7v13"/><path d="M9 20h6"/></svg>
                        <span>Комплексное оснащение лабораторий</span>
                    </div>
                    <div class="lab-hero-feature-card">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="8" width="20" height="10" rx="2"/><path d="M8 18v2"/><path d="M16 18v2"/><path d="M6 8V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"/></svg>
                        <span>Поставка со склада и под заказ</span>
                    </div>
                    <div class="lab-hero-feature-card">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                        <span>Оборудование ведущих производителей</span>
                    </div>
                    <div class="lab-hero-feature-card">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a3 3 0 0 0-3 3v3H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-9a2 2 0 0 0-2-2h-3V5a3 3 0 0 0-3-3z"/><path d="M12 18v-3"/></svg>
                        <span>Сервисное сопровождение</span>
                    </div>
                </div>
            </div>

            <div class="lab-hero-right">
                <img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt="" class="lab-hero-image">
                <div class="lab-hero-badges">
                    <div class="lab-hero-badge-green"><span>Безопасность лаборатории</span></div>
                    <div class="lab-hero-badge-green"><span>Расчёт под объём исследований</span></div>
                    <div class="lab-hero-badge-green"><span>Подбор под задачи учреждения</span></div>
                </div>
                <button class="lab-hero-cta-btn" type="button"><?php echo esc_html($hero_btn); ?></button>
            </div>
        </div>
        <button class="lab-hero-bottom-btn" type="button">Подобрать оборудование</button>
    </div>
</section>

<!-- 2. Audience -->
<section class="lab-audience">
    <div class="lab-section-inner">
        <div class="lab-audience-header">
            <div class="lab-audience-label">Для кого мы работаем</div>
            <h2 class="lab-audience-title">Решения <span class="text-green">для разных типов</span> лабораторий</h2>
        </div>

        <div class="lab-audience-grid">
            <div class="lab-audience-card lab-audience-card--image"><span class="arrow"></span><p class="text">Клинико-диагностические лаборатории</p></div>
            <div class="lab-audience-card lab-audience-card--white"><span class="arrow"></span><p class="text">Лаборатории медицинских центров</p></div>
            <div class="lab-audience-card lab-audience-card--image"><span class="arrow"></span><p class="text">Научно-исследовательские лаборатории</p></div>
            <div class="lab-audience-card lab-audience-card--gray"><span class="arrow"></span><p class="text">Ветеринарные лаборатории</p></div>
            <div class="lab-audience-card lab-audience-card--green"><span class="arrow"></span><p class="text">Государственные учреждения</p></div>
            <div class="lab-audience-card lab-audience-card--white"><span class="arrow"></span><p class="text">Производственные лаборатории</p></div>
        </div>
    </div>
</section>
<!-- 3. Supplies -->
<section class="lab-supplies">
    <div class="lab-section-inner">
        <div class="lab-supplies-header">
            <h2 class="lab-supplies-title">Комплексное оснащение лабораторий</h2>
            <p class="lab-supplies-subtitle">Подберём оборудование под&nbsp;задачи вашей лаборатории</p>
        </div>

        <div class="lab-supplies-diagram">
            <div class="lab-supplies-center">
                <span class="lab-supplies-center-num">10</span>
                <span class="lab-supplies-center-text">направлений</span>
            </div>
            <div class="lab-supplies-items">
                <span class="lab-supplies-item" style="--i:0">Лабораторная мебель</span>
                <span class="lab-supplies-item" style="--i:1">Автоматические анализаторы</span>
                <span class="lab-supplies-item" style="--i:2">Холодильное оборудование</span>
                <span class="lab-supplies-item" style="--i:3">Лабораторные расходные материалы</span>
                <span class="lab-supplies-item" style="--i:4">Микроскопы</span>
                <span class="lab-supplies-item" style="--i:5">Аналитическое оборудование</span>
                <span class="lab-supplies-item" style="--i:6">Центрифуги</span>
                <span class="lab-supplies-item" style="--i:7">Стерилизационное оборудование</span>
                <span class="lab-supplies-item" style="--i:8">Инкубаторы и термостаты</span>
                <span class="lab-supplies-item" style="--i:9">Системы хранения и подготовки образцов</span>
            </div>
        </div>
    </div>
</section>

<!-- 4. Included -->
<section class="lab-included">
    <div class="lab-section-inner">
        <h2 class="lab-included-title">Берём на&nbsp;себя весь процесс оснащения</h2>

        <div class="lab-included-grid">
            <div class="lab-included-card">
                <div class="lab-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                <div class="lab-included-card-body"><span class="lab-included-card-num">1</span><p>Анализ задач лаборатории</p></div>
            </div>
            <div class="lab-included-card">
                <div class="lab-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                <div class="lab-included-card-body"><span class="lab-included-card-num">2</span><p>Подбор оборудования и комплектации</p></div>
            </div>
            <div class="lab-included-card">
                <div class="lab-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                <div class="lab-included-card-body"><span class="lab-included-card-num">3</span><p>Подготовка коммерческого предложения</p></div>
            </div>
            <div class="lab-included-card">
                <div class="lab-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                <div class="lab-included-card-body"><span class="lab-included-card-num">4</span><p>Поставка оборудования</p></div>
            </div>
            <div class="lab-included-card">
                <div class="lab-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                <div class="lab-included-card-body"><span class="lab-included-card-num">5</span><p>Сервисное сопровождение</p></div>
            </div>
            <div class="lab-included-card">
                <div class="lab-included-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                <div class="lab-included-card-body"><span class="lab-included-card-num">6</span><p>Консультации по эксплуатации</p></div>
            </div>
            <div class="lab-included-result">
                <span class="arrow"></span>
                <p>Мы&nbsp;поставляем не&nbsp;отдельные позиции из&nbsp;каталога, а&nbsp;формируем полноценное решение, которое помогает лаборатории работать эффективно и&nbsp;соответствовать современным требованиям</p>
            </div>
        </div>
    </div>
</section>

<!-- 5. Why choose -->
<section class="lab-why">
    <div class="lab-section-inner">
        <div class="lab-why-header">
            <h2 class="lab-why-title">Почему выбирают ТриМед</h2>
            <p class="lab-why-subtitle">Надежный партнер для лабораторий региона</p>
        </div>

        <div class="lab-why-grid">
            <div class="lab-why-left">
                <div class="lab-why-stats">
                    <div class="lab-why-stat lab-why-stat--img">
                        <span class="num">20+ лет</span>
                        <span class="txt">опыта работы в&nbsp;медицинской отрасли</span>
                    </div>
                    <div class="lab-why-stat lab-why-stat--gray">
                        <span class="num">5000+</span>
                        <span class="txt">позиций оборудования и&nbsp;расходных материалов</span>
                    </div>
                </div>
                <div class="lab-why-features">
                    <div class="lab-why-feature"><span class="plus"></span><span>Прямые поставки от производителей</span></div>
                    <div class="lab-why-feature"><span class="plus"></span><span>Консультационная поддержка</span></div>
                    <div class="lab-why-feature"><span class="plus"></span><span>Склад в Чите</span></div>
                    <div class="lab-why-feature"><span class="plus"></span><span>Работа с&nbsp;государственными и&nbsp;частными учреждениями</span></div>
                </div>
            </div>
            <div class="lab-why-warehouse">
                <h3 class="lab-why-warehouse-title">Собственный склад в Чите</h3>
                <img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt="">
            </div>
        </div>
    </div>
</section>

<!-- 6. Projects -->
<section class="lab-projects">
    <div class="lab-section-inner">
        <div class="lab-projects-header">
            <h2 class="lab-projects-title">Реализованные проекты</h2>
            <p class="lab-projects-desc">За&nbsp;время работы мы&nbsp;реализовали проекты по&nbsp;оснащению медицинских кабинетов и&nbsp;центров в&nbsp;Забайкальском крае. Мы&nbsp;понимаем специфику региона, требования врачей и&nbsp;реальные условия работы.</p>
        </div>

        <div class="lab-projects-grid">
            <div class="lab-project-card">
                <div class="lab-project-card-img"><img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt=""></div>
                <div class="lab-project-card-body">
                    <div class="lab-project-card-top">
                        <span class="lab-project-card-num">02.</span>
                        <span class="lab-project-card-arrow"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M17 7H7M17 7V17"/></svg></span>
                    </div>
                    <div>
                        <h3 class="lab-project-card-title">Стоматология «Дента-Профи» (г. Чита)</h3>
                        <div class="lab-project-card-block">
                            <p class="lab-project-card-label">Что было поставлено</p>
                            <p class="lab-project-card-text">Стоматологические установки (2&nbsp;шт.), компрессорная станция, автоклав, упаковочные материалы для стерилизации, рециркулятор воздуха, дезинфицирующие средства, контейнеры для дезинфекции.</p>
                        </div>
                        <div class="lab-project-card-block">
                            <p class="lab-project-card-label">Результат</p>
                            <p class="lab-project-card-text">Клиника введена в эксплуатацию в запланированные сроки. Все кабинеты укомплектованы, стерилизационная функционирует в полном объёме, соблюдены требования Роспотребнадзора. Персонал обеспечен всем необходимым для безопасной работы.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. Tasks -->
<section class="lab-tasks">
    <div class="lab-section-inner">
        <div class="lab-tasks-header">
            <h2 class="lab-tasks-title">С чем к нам обращаются чаще всего</h2>
            <p class="lab-tasks-subtitle">Популярные задачи клиентов</p>
        </div>
        <div class="lab-tasks-grid">
            <div class="lab-tasks-item"><span class="lab-tasks-check"></span><span>Оснащение новой лаборатории</span></div>
            <div class="lab-tasks-item"><span class="lab-tasks-check"></span><span>Расширение существующей лаборатории</span></div>
            <div class="lab-tasks-item"><span class="lab-tasks-check"></span><span>Замена оборудования</span></div>
            <div class="lab-tasks-item"><span class="lab-tasks-check"></span><span>Подготовка к лицензированию</span></div>
            <div class="lab-tasks-item"><span class="lab-tasks-check"></span><span>Оснащение по техническому заданию</span></div>
            <div class="lab-tasks-item"><span class="lab-tasks-check"></span><span>Подбор оборудования под бюджет</span></div>
        </div>
    </div>
</section>

<!-- 8. Partners -->
<section class="lab-partners">
    <div class="lab-section-inner">
        <h2 class="lab-partners-title">Работаем с ведущими производителями</h2>
        <div class="lab-partners-grid">
            <div class="lab-partner-card">
                <img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt="">
                <h3 class="lab-partner-name">ДеЗиЛаб</h3>
                <p class="lab-partner-text">Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.</p>
            </div>
            <div class="lab-partner-card">
                <img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt="">
                <h3 class="lab-partner-name">ДеЗиЛаб</h3>
                <p class="lab-partner-text">Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.</p>
            </div>
            <div class="lab-partner-card">
                <img src="<?php echo esc_url($img_dir); ?>/placeholder.jpg" alt="">
                <h3 class="lab-partner-name">ДеЗиЛаб</h3>
                <p class="lab-partner-text">Российский производитель дезинфицирующих средств широкого спектра. Вся продукция зарегистрирована, эффективна против вирусов, бактерий, грибов.</p>
            </div>
        </div>
    </div>
</section>

<!-- 9. Request -->
<section class="lab-request">
    <div class="lab-section-inner">
        <div class="lab-request-grid">
            <div class="lab-request-text">
                <h2 class="lab-request-title">Подберём решение для&nbsp;вашего учреждения</h2>
                <p class="lab-request-desc">Оставьте заявку, и&nbsp;специалист поможет подобрать оборудование, дезинфицирующие средства и&nbsp;расходные материалы под&nbsp;ваши задачи.</p>
            </div>
            <form class="lab-request-form" onsubmit="return false;">
                <input type="text" placeholder="Иванов Николай Сергеевич">
                <input type="tel" placeholder="+7 (999) 999-99-99">
                <input type="text" placeholder="Название организации">
                <textarea placeholder="Ваш комментарий"></textarea>
                <label class="checkbox">
                    <input type="checkbox">
                    <span>Оставляя заявку, я соглашаюсь с условиями Политики обработки персональных данных</span>
                </label>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>
</section>


</main>

<?php
get_footer();
