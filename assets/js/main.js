document.addEventListener('DOMContentLoaded', function() {
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
