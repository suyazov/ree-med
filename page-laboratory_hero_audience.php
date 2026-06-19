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
