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
        document.querySelectorAll('.faq-section').forEach(function(section) {
            const faqItems = section.querySelectorAll('.faq-item');
            const itemsWithAnswer = Array.from(faqItems).filter(item => !!item.querySelector('p'));
            const collapsedInitial = section.classList.contains('faq-section--collapsed-initial') && window.matchMedia('(max-width: 767px)').matches;

            if (itemsWithAnswer.length > 0) {
                let hasActive = false;
                itemsWithAnswer.forEach(function(item) {
                    item.classList.remove('active');

                    if (!collapsedInitial && !hasActive) {
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

    function initSliders(containerSelector, slideSelector, prevSelector, nextSelector, dotSelector) {
        document.querySelectorAll(containerSelector).forEach(function(container) {
            initSlider(container, slideSelector, prevSelector, nextSelector, dotSelector);
        });
    }

    function initScrollDotsSlider(containerSelector, trackSelector, itemSelector, dotSelector) {
        const container = document.querySelector(containerSelector);
        if (!container) {
            return;
        }

        const track = container.querySelector(trackSelector);
        const dots = container.querySelectorAll(dotSelector);
        if (!track || !dots.length) {
            return;
        }

        const slides = track.querySelectorAll(itemSelector);
        if (!slides.length) {
            return;
        }

        const items = Array.from(slides);
        let currentIndex = 0;

        function goTo(index, smooth) {
            currentIndex = Math.max(0, Math.min(index, items.length - 1));
            const target = items[currentIndex];
            if (!target) {
                return;
            }

            track.scrollTo({
                left: target.offsetLeft,
                behavior: smooth ? 'smooth' : 'auto',
            });

            dots.forEach(function(dot, dotIndex) {
                dot.classList.toggle('active', dotIndex === currentIndex);
            });
        }

        dots.forEach(function(dot, index) {
            dot.addEventListener('click', function() {
                goTo(index, true);
            });
        });

        track.addEventListener('scroll', function() {
            let nearestIndex = 0;
            let nearestOffset = Infinity;

            items.forEach(function(item, itemIndex) {
                const distance = Math.abs(track.scrollLeft - item.offsetLeft);
                if (distance < nearestOffset) {
                    nearestOffset = distance;
                    nearestIndex = itemIndex;
                }
            });

            if (nearestIndex !== currentIndex) {
                currentIndex = nearestIndex;
                dots.forEach(function(dot, dotIndex) {
                    dot.classList.toggle('active', dotIndex === currentIndex);
                });
            }
        }, { passive: true });

        goTo(0, false);
    }

    function initTestimonialsSlider() {
        initScrollDotsSlider('.home-testimonials', '.testimonials-grid', '.testimonial-card', '.testimonials-dot');
    }

    function initPartnersSlider() {
        initScrollDotsSlider('.home-partners', '.partners-grid', '.partner-card', '.partners-dot');
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
    initSliders('.projects-slider', '.project-slide', '.slider-arrow.prev', '.slider-arrow.next', '.slider-dot');
    initSliders('.lab-projects-slider', '.lab-project-slide', '.lab-slider-arrow.prev', '.lab-slider-arrow.next', '.lab-slider-dot');
    initPartnersSlider();
    initTestimonialsSlider();
    initContactForms();
});
