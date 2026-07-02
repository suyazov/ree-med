document.addEventListener('DOMContentLoaded', function() {
    function initSupplyLayout() {
        const suppliesItems = document.querySelector('.supplies-items');
        if (!suppliesItems) {
            return;
        }

        const supplyItems = suppliesItems.querySelectorAll('.supply-item');
        function resetSupplyItems() {
            if (window.innerWidth > 1024) {
                return;
            }

            supplyItems.forEach(function(item) {
                item.style.left = '';
                item.style.right = '';
                item.style.top = '';
                item.style.bottom = '';
                item.style.flexDirection = '';
            });
        }

        window.addEventListener('load', resetSupplyItems);
        window.addEventListener('resize', resetSupplyItems);
    }

    function initFAQAccordion() {
        const faqItems = document.querySelectorAll('.faq-item');
        const itemsWithAnswer = Array.from(faqItems).filter(item => !!item.querySelector('p'));

        if (itemsWithAnswer.length > 0) {
            let hasActive = false;
            itemsWithAnswer.forEach(function(item) {
                item.classList.remove('active');

                if (!hasActive) {
                    item.classList.add('active');
                    hasActive = true;
                }
            });
        }

        faqItems.forEach(function(item) {
            item.addEventListener('click', function() {
                const hasAnswer = !!item.querySelector('p');
                if (!hasAnswer) {
                    return;
                }
                const isActive = item.classList.contains('active');
                faqItems.forEach(function(targetItem) {
                    targetItem.classList.remove('active');
                });
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        });
    }

    function initMobileMenu() {
        const burger = document.querySelector('.menu-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');
        if (!burger || !mobileMenu) {
            return;
        }

        burger.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            burger.classList.toggle('active');
        });
    }

    function initSlider(container, slideSelector, prevSelector, nextSelector, dotSelector) {
        if (!container) {
            return;
        }

        const slides = container.querySelectorAll(slideSelector);
        const prevBtn = container.querySelector(prevSelector);
        const nextBtn = container.querySelector(nextSelector);
        const dots = container.querySelectorAll(dotSelector);
        let currentSlide = 0;
        const totalSlides = slides.length;

        function showSlide(index) {
            if (totalSlides === 0) {
                return;
            }

            currentSlide = (index + totalSlides) % totalSlides;
            slides.forEach(function(slide, i) {
                slide.classList.toggle('active', i === currentSlide);
            });
            dots.forEach(function(dot, i) {
                dot.classList.toggle('active', i === currentSlide);
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                showSlide(currentSlide - 1);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                showSlide(currentSlide + 1);
            });
        }

        dots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-slide'), 10);
                showSlide(index);
            });
        });
    }

    function initContactForms() {
        if (typeof trimed_ajax === 'undefined' || !trimed_ajax.ajax_url) {
            return;
        }

        document.querySelectorAll('.contact-form').forEach(function(contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const messageEl = contactForm.querySelector('.form-message');
                const submitBtn = contactForm.querySelector('button[type=\"submit\"]');
                const formData = new FormData(contactForm);

                formData.append('action', 'trimed_contact');
                formData.append('nonce', trimed_ajax.nonce);

                submitBtn.disabled = true;
                if (messageEl) {
                    messageEl.textContent = 'Отправка...';
                }

                fetch(trimed_ajax.ajax_url, {
                    method: 'POST',
                    body: formData,
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    submitBtn.disabled = false;
                    if (messageEl) {
                        messageEl.textContent = data.data || data.message || '';
                        messageEl.className = 'form-message ' + (data.success ? 'success' : 'error');
                    }
                    if (data.success) {
                        contactForm.reset();
                    }
                })
                .catch(function() {
                    submitBtn.disabled = false;
                    if (messageEl) {
                        messageEl.textContent = 'Произошла ошибка. Попробуйте позже.';
                        messageEl.className = 'form-message error';
                    }
                });
            });
        });
    }

    initSupplyLayout();
    initFAQAccordion();
    initMobileMenu();
    initSlider(document.querySelector('.projects-slider'), '.project-slide', '.slider-arrow.prev', '.slider-arrow.next', '.slider-dot');
    initSlider(document.querySelector('.lab-projects-slider'), '.lab-project-slide', '.lab-slider-arrow.prev', '.lab-slider-arrow.next', '.lab-slider-dot');
    initContactForms();
});
