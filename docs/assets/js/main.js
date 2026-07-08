/* Studio Vendrig V2 — interactie: header, mobiel menu, heroslider, reveal, lightbox */
(function () {
    'use strict';

    /* Header krijgt een vaste achtergrond zodra er wordt gescrold */
    var header = document.getElementById('siteHeader');
    function onScroll() {
        header.classList.toggle('is-scrolled', window.scrollY > 40);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    /* Mobiel menu */
    var toggle = document.getElementById('navToggle');
    var nav = document.getElementById('mainNav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('is-open');
            toggle.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            document.body.style.overflow = open ? 'hidden' : '';
        });
    }

    /* Hero-diavoorstelling */
    var slides = document.querySelectorAll('.hero-slide');
    var counter = document.getElementById('heroIndex');
    if (slides.length > 1) {
        var current = 0;
        setInterval(function () {
            slides[current].classList.remove('is-active');
            current = (current + 1) % slides.length;
            slides[current].classList.add('is-active');
            if (counter) {
                counter.textContent = String(current + 1).padStart(2, '0');
            }
        }, 5200);
    }

    /* Scroll-reveal */
    var revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window && revealEls.length) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(function (el) { io.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('is-visible'); });
    }

    /* Lightbox voor projectgalerijen */
    var lightbox = document.getElementById('lightbox');
    var links = Array.prototype.slice.call(document.querySelectorAll('.gallery-link'));
    if (lightbox && links.length) {
        var img = lightbox.querySelector('img');
        var caption = lightbox.querySelector('.lightbox-caption');
        var index = 0;

        function show(i) {
            index = (i + links.length) % links.length;
            img.src = links[index].getAttribute('href');
            var alt = links[index].querySelector('img').alt || '';
            img.alt = alt;
            caption.textContent = alt;
        }
        function open(i) {
            show(i);
            lightbox.hidden = false;
            document.body.style.overflow = 'hidden';
        }
        function close() {
            lightbox.hidden = true;
            document.body.style.overflow = '';
        }

        links.forEach(function (link, i) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                open(i);
            });
        });
        lightbox.querySelector('.lightbox-close').addEventListener('click', close);
        lightbox.querySelector('.lightbox-prev').addEventListener('click', function () { show(index - 1); });
        lightbox.querySelector('.lightbox-next').addEventListener('click', function () { show(index + 1); });
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) close();
        });
        document.addEventListener('keydown', function (e) {
            if (lightbox.hidden) return;
            if (e.key === 'Escape') close();
            if (e.key === 'ArrowLeft') show(index - 1);
            if (e.key === 'ArrowRight') show(index + 1);
        });
    }
})();
