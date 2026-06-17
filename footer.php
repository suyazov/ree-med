<footer class="site-footer">
    <div class="container footer-container">
        <div class="footer-main">
            <div class="footer-bg" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/footer-map.png')"></div>
            <div class="map-pulse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <div class="footer-card">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo-white.png" alt="<?php bloginfo('name'); ?>" class="footer-logo">
                
                <div class="footer-contacts">
                    <a href="tel:+73022318888" class="footer-contact">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="#EFEFEF"/></svg>
                        <span>+7 (3022) 31 88 88</span>
                    </a>
                    <a href="mailto:treemed16@yandex.ru" class="footer-contact">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="#EFEFEF"/></svg>
                        <span>treemed16@yandex.ru</span>
                    </a>
                    <div class="footer-contact">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#EFEFEF"/></svg>
                        <span>Чита, ул.Фёдора Гладкова, 8А пом. 8</span>
                    </div>
                </div>

                <div class="footer-socials">
                    <a href="#" class="footer-social"></a>
                    <a href="#" class="footer-social"></a>
                    <a href="#" class="footer-social"></a>
                </div>

                <a href="#" class="btn btn-primary footer-callback">Заказать звонок</a>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-info">
                <p>© <?php echo date('Y'); ?>, «ТриМед». Все права защищены.</p>
                <p>ИНН 7500009501</p>
                <p>ОГРН 1237500001859</p>
            </div>
            <div class="footer-links">
                <a href="#">Согласие на обработку персональных данных</a>
                <a href="#">Политика об обработке персональных данных</a>
                <a href="#">Пользовательское соглашение</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
