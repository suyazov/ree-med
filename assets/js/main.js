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

    function isMobileSliderViewport() {
        return window.matchMedia('(max-width: 768px)').matches;
    }

    function ensureSliderDots(container, dotSelector, totalSlides) {
        const dotClass = dotSelector.replace(/^\./, '');
        const dotsClass = dotClass + 's';
        let dotsContainer = container.querySelector('.' + dotsClass);

        if (!dotsContainer) {
            dotsContainer = document.createElement('div');
            dotsContainer.className = dotsClass;
            const arrowsWrap = container.querySelector('.lab-slider-arrows');
            const nextBtn = arrowsWrap ? arrowsWrap.querySelector('.next') : null;
            if (arrowsWrap && nextBtn) {
                arrowsWrap.insertBefore(dotsContainer, nextBtn);
            } else if (arrowsWrap) {
                arrowsWrap.appendChild(dotsContainer);
            } else {
                container.appendChild(dotsContainer);
            }
        }

        if (dotsContainer.children.length === 0) {
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = dotClass + (i === 0 ? ' active' : '');
                dot.setAttribute('data-slide', String(i));
                dot.setAttribute('aria-label', 'Перейти к слайду ' + (i + 1));
                dotsContainer.appendChild(dot);
            }
        }

        return dotsContainer.querySelectorAll(dotSelector);
    }

    function initSlider(container, slideSelector, prevSelector, nextSelector, dotSelector) {
        if (!container) {
            return;
        }

        const slides = container.querySelectorAll(slideSelector);
        const prevBtns = container.querySelectorAll(prevSelector);
        const nextBtns = container.querySelectorAll(nextSelector);
        let dots = container.querySelectorAll(dotSelector);
        let currentSlide = 0;
        const totalSlides = slides.length;
        const scrollTrack = container.querySelector('.slides-track, .lab-projects-track');

        if (dots.length === 0 && totalSlides > 1) {
            dots = ensureSliderDots(container, dotSelector, totalSlides);
        }

        function updateActive(index) {
            currentSlide = (index + totalSlides) % totalSlides;
            slides.forEach(function(slide, i) {
                slide.classList.toggle('active', i === currentSlide);
            });
            dots.forEach(function(dot, i) {
                dot.classList.toggle('active', i === currentSlide);
            });
        }

        function showSlide(index) {
            if (totalSlides === 0) {
                return;
            }

            updateActive(index);

            if (scrollTrack && isMobileSliderViewport()) {
                scrollTrack.scrollTo({
                    left: slides[currentSlide].offsetLeft,
                    behavior: 'smooth',
                });
            }
        }

        prevBtns.forEach(function(prevBtn) {
            prevBtn.addEventListener('click', function() {
                showSlide(currentSlide - 1);
            });
        });

        nextBtns.forEach(function(nextBtn) {
            nextBtn.addEventListener('click', function() {
                showSlide(currentSlide + 1);
            });
        });

        dots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-slide'), 10);
                showSlide(index);
            });
        });

        if (scrollTrack) {
            scrollTrack.addEventListener('scroll', function() {
                if (!isMobileSliderViewport()) {
                    return;
                }

                let nearestIndex = 0;
                let nearestDistance = Infinity;
                slides.forEach(function(slide, index) {
                    const distance = Math.abs(scrollTrack.scrollLeft - slide.offsetLeft);
                    if (distance < nearestDistance) {
                        nearestDistance = distance;
                        nearestIndex = index;
                    }
                });
                updateActive(nearestIndex);
            }, { passive: true });
        }
    }

    function initSliders(containerSelector, slideSelector, prevSelector, nextSelector, dotSelector) {
        document.querySelectorAll(containerSelector).forEach(function(container) {
            initSlider(container, slideSelector, prevSelector, nextSelector, dotSelector);
        });
    }

    function initScrollDotsSlider(containerSelector, trackSelector, itemSelector, dotSelector, options) {
        const settings = Object.assign({ arrows: false, dotsContainerClass: '' }, options || {});
        const container = document.querySelector(containerSelector);
        if (!container) {
            return;
        }

        const track = container.querySelector(trackSelector);
        if (!track) {
            return;
        }

        const slides = track.querySelectorAll(itemSelector);
        if (!slides.length) {
            return;
        }

        let dots = container.querySelectorAll(dotSelector);
        if (dots.length === 0 && slides.length > 1 && settings.dotsContainerClass) {
            const dotsContainer = document.createElement('div');
            dotsContainer.className = settings.dotsContainerClass;
            container.appendChild(dotsContainer);
            const dotClass = dotSelector.replace(/^\./, '');
            for (let i = 0; i < slides.length; i++) {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = dotClass + (i === 0 ? ' active' : '');
                dot.setAttribute('data-slide', String(i));
                dot.setAttribute('aria-label', 'Перейти к слайду ' + (i + 1));
                dotsContainer.appendChild(dot);
            }
            dots = container.querySelectorAll(dotSelector);
        }
        if (!dots.length) {
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

            // Rect-based target: exact scroll position inside the track regardless
            // of which ancestor is the offsetParent (offsetLeft is not reliable
            // when the track is not positioned).
            const left = track.scrollLeft + target.getBoundingClientRect().left - track.getBoundingClientRect().left;
            track.scrollTo({
                left: left,
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

        if (settings.arrows && items.length > 1) {
            const dotsContainer = dots[0].parentNode;
            ['prev', 'next'].forEach(function(direction) {
                if (container.querySelector('.scroll-slider-arrow.' + direction)) {
                    return;
                }
                const arrow = document.createElement('button');
                arrow.type = 'button';
                arrow.className = 'scroll-slider-arrow ' + direction;
                arrow.setAttribute('aria-label', direction === 'prev' ? 'Предыдущий слайд' : 'Следующий слайд');
                arrow.addEventListener('click', function() {
                    goTo(currentIndex + (direction === 'prev' ? -1 : 1), true);
                });
                if (direction === 'prev') {
                    dotsContainer.insertBefore(arrow, dotsContainer.firstChild);
                } else {
                    dotsContainer.appendChild(arrow);
                }
            });
        }

        track.addEventListener('scroll', function() {
            let nearestIndex = 0;
            let nearestOffset = Infinity;
            const trackLeft = track.getBoundingClientRect().left;

            items.forEach(function(item, itemIndex) {
                const distance = Math.abs(item.getBoundingClientRect().left - trackLeft);
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
        initScrollDotsSlider('.home-testimonials', '.testimonials-grid', '.testimonial-card', '.testimonials-dot', { arrows: true });
    }

    function initPartnersSlider() {
        initScrollDotsSlider('.home-partners', '.partners-grid', '.partner-card', '.partners-dot', { arrows: true });
    }

    function initHomeProjectsSlider() {
        initScrollDotsSlider('.home-projects-slider', '.projects-grid', '.project-card', '.home-projects-dot', {
            arrows: true,
            dotsContainerClass: 'home-projects-dots',
        });
    }

    // Service pages: mobile scroll-snap carousels get the same unified
    // control row (prev arrow + centered dots + next arrow) as the home
    // sliders. One shared dot/arrow class set (.scroll-slider-dot(s) /
    // .scroll-slider-arrow) keeps the row consistent across pages.
    function initServiceScrollSliders() {
        const configs = [
            // page-medcentry: projects carousel
            ['.medcentry-page .mc-projects .mc-section-inner', '.mc-projects-grid', '.mc-project-card'],
            // page-stomatology: projects carousel
            ['.stomatology-page .stom-projects .stom-section-inner', '.stom-projects-grid', '.stom-project-card'],
            // page-laboratory: partners carousel
            ['.laboratory-page .lab-partners .container', '.partners-grid', '.partner-card'],
            // page-disinfection: partners carousel. Controls are appended to
            // the section, not .container, because on small mobile the
            // container has a fixed height (337px) that must stay untouched.
            ['.disinfection-page .partners-section', '.partners-grid', '.partner-card'],
        ];

        configs.forEach(function(config) {
            initScrollDotsSlider(config[0], config[1], config[2], '.scroll-slider-dot', {
                arrows: true,
                dotsContainerClass: 'scroll-slider-dots',
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
    initSliders('.disinfection-page .projects-slider', '.project-slide', '.slider-arrow.prev', '.slider-arrow.next', '.slider-dot');
    initSliders('.lab-projects-slider', '.lab-project-slide', '.lab-projects-side-arrow.prev, .lab-slider-arrow.prev', '.lab-projects-side-arrow.next, .lab-slider-arrow.next', '.lab-slider-dot');
    initPartnersSlider();
    initTestimonialsSlider();
    initHomeProjectsSlider();
    initServiceScrollSliders();
    initContactForms();
});
