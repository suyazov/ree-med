document.addEventListener('DOMContentLoaded', function() {
    // Supplies circular diagram uniform positioning (desktop only)
    const suppliesItems = document.querySelector('.supplies-items');
    if (suppliesItems) {
        const supplyItems = suppliesItems.querySelectorAll('.supply-item');
        function layoutSupplyItems() {
            if (window.innerWidth <= 1024) {
                supplyItems.forEach(function(item) {
                    item.style.left = '';
                    item.style.top = '';
                    item.style.flexDirection = '';
                });
                return;
            }
            const centerX = 600;
            const centerY = 520;
            const radiusX = 460;
            const radiusXBottom = 540;
            const radiusY = 280;
            const total = supplyItems.length;
            const step = (2 * Math.PI) / total;
            const startAngle = -Math.PI / 2;
            supplyItems.forEach(function(item, index) {
                const angle = startAngle + index * step;
                const itemWidth = item.offsetWidth;
                const itemHeight = item.offsetHeight;
                const bottomFactor = Math.pow(Math.sin(angle), 2);
                const rx = radiusX + (radiusXBottom - radiusX) * bottomFactor;
                const cx = centerX + rx * Math.cos(angle);
                const cy = centerY + radiusY * Math.sin(angle);
                item.style.left = (cx - itemWidth / 2) + 'px';
                item.style.top = (cy - itemHeight / 2) + 'px';
                item.style.flexDirection = Math.cos(angle) < 0 ? 'row-reverse' : 'row';
            });
        }
        window.addEventListener('load', layoutSupplyItems);
        window.addEventListener('resize', layoutSupplyItems);
    }

    // FAQ accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        item.addEventListener('click', function() {
            const isActive = this.classList.contains('active');
            faqItems.forEach(i => i.classList.remove('active'));
            if (!isActive) {
                this.classList.add('active');
            }
        });
    });

    // Mobile menu toggle
    const burger = document.querySelector('.menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    if (burger && mobileMenu) {
        burger.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            burger.classList.toggle('active');
        });
    }

    // Contact form AJAX
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const messageEl = contactForm.querySelector('.form-message');
            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const formData = new FormData(contactForm);
            formData.append('action', 'trimed_contact');
            formData.append('nonce', trimed_ajax.nonce);

            submitBtn.disabled = true;
            if (messageEl) messageEl.textContent = 'Отправка...';

            fetch(trimed_ajax.ajax_url, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.disabled = false;
                if (messageEl) {
                    messageEl.textContent = data.data || data.message || '';
                    messageEl.className = 'form-message ' + (data.success ? 'success' : 'error');
                }
                if (data.success) {
                    contactForm.reset();
                }
            })
            .catch(error => {
                submitBtn.disabled = false;
                if (messageEl) {
                    messageEl.textContent = 'Произошла ошибка. Попробуйте позже.';
                    messageEl.className = 'form-message error';
                }
            });
        });
    }
});
