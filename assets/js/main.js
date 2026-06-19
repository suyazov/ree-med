document.addEventListener('DOMContentLoaded', function() {
    // Supplies circular diagram positioning (desktop only)
    // Layout is now handled via CSS absolute positioning for the 11 fallback items.
    // This script only resets inline styles when switching to/from mobile breakpoints.
    const suppliesItems = document.querySelector('.supplies-items');
    if (suppliesItems) {
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

    // Projects slider
    const projectsSlider = document.querySelector('.projects-slider');
    if (projectsSlider) {
        const slides = projectsSlider.querySelectorAll('.project-slide');
        const prevBtn = projectsSlider.querySelector('.slider-arrow.prev');
        const nextBtn = projectsSlider.querySelector('.slider-arrow.next');
        const dots = projectsSlider.querySelectorAll('.slider-dot');
        let currentSlide = 0;
        const totalSlides = slides.length;

        function showSlide(index) {
            if (totalSlides === 0) return;
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

    // Laboratory projects slider
    const labProjectsSlider = document.querySelector('.lab-projects-slider');
    if (labProjectsSlider) {
        const labSlides = labProjectsSlider.querySelectorAll('.lab-project-slide');
        const labPrevBtn = labProjectsSlider.querySelector('.lab-slider-arrow.prev');
        const labNextBtn = labProjectsSlider.querySelector('.lab-slider-arrow.next');
        const labDots = labProjectsSlider.querySelectorAll('.lab-slider-dot');
        let currentLabSlide = 0;
        const totalLabSlides = labSlides.length;

        function showLabSlide(index) {
            if (totalLabSlides === 0) return;
            currentLabSlide = (index + totalLabSlides) % totalLabSlides;
            labSlides.forEach(function(slide, i) {
                slide.classList.toggle('active', i === currentLabSlide);
            });
            labDots.forEach(function(dot, i) {
                dot.classList.toggle('active', i === currentLabSlide);
            });
        }

        if (labPrevBtn) {
            labPrevBtn.addEventListener('click', function() {
                showLabSlide(currentLabSlide - 1);
            });
        }
        if (labNextBtn) {
            labNextBtn.addEventListener('click', function() {
                showLabSlide(currentLabSlide + 1);
            });
        }
        labDots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-slide'), 10);
                showLabSlide(index);
            });
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
