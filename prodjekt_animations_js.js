/**
 * PRODJEKT - Animations JavaScript
 * Animations spécifiques et effets interactifs
 */

// ====================================
// SPOTLIGHT EFFECT (pour les cartes Bento)
// ====================================

function initSpotlightCards() {
    const cardsContainer = document.getElementById("cards-container");
    const cards = document.querySelectorAll(".card");
    
    if (!cardsContainer || cards.length === 0) return;
    
    cardsContainer.addEventListener('mousemove', e => {
        for (const card of cards) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            card.style.setProperty("--mouse-x", `${x}px`);
            card.style.setProperty("--mouse-y", `${y}px`);
        }
    });
}

// ====================================
// CAMION ANIMÉ (Page d'accueil)
// ====================================

function initMovingTruck() {
    const truck = document.querySelector('.moving-truck');
    
    if (!truck) return;
    
    // Pause animation au hover
    truck.addEventListener('mouseenter', () => {
        truck.style.animationPlayState = 'paused';
    });
    
    truck.addEventListener('mouseleave', () => {
        truck.style.animationPlayState = 'running';
    });
}

// ====================================
// TECH GALLERY (Images expansibles)
// ====================================

function initTechGallery() {
    document.querySelectorAll('.tech-item').forEach(item => {
        item.addEventListener('click', function() {
            // Récupérer l'URL de l'image depuis le background-image
            const style = window.getComputedStyle(this).backgroundImage;
            const src = style.slice(5, -2).replace(/"/g, "");
            
            if (typeof openLightbox === 'function') {
                openLightbox(src);
            }
        });
    });
}

// ====================================
// SMOOTH SCROLL vers les ancres
// ====================================

function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            
            // Ignorer # seul
            if (href === '#') return;
            
            const target = document.querySelector(href);
            
            if (target) {
                e.preventDefault();
                
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Fermer le menu mobile si ouvert
                const mobileMenu = document.getElementById('mobileMenu');
                if (mobileMenu && mobileMenu.classList.contains('active')) {
                    toggleMenu();
                }
            }
        });
    });
}

// ====================================
// PARALLAX LIGHT (Sections au scroll)
// ====================================

function initParallax() {
    const sections = document.querySelectorAll('[data-parallax]');
    
    if (sections.length === 0) return;
    
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        
        sections.forEach(section => {
            const speed = section.dataset.parallax || 0.5;
            const yPos = -(scrolled * speed);
            section.style.transform = `translateY(${yPos}px)`;
        });
    });
}

// ====================================
// COUNT UP ANIMATION (pour chiffres)
// ====================================

function animateCountUp(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16); // 60 FPS
    
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(start);
        }
    }, 16);
}

function initCountUp() {
    const counters = document.querySelectorAll('[data-count]');
    
    if (counters.length === 0) return;
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.counted) {
                const target = parseInt(entry.target.dataset.count);
                animateCountUp(entry.target, target);
                entry.target.dataset.counted = 'true';
            }
        });
    });
    
    counters.forEach(counter => observer.observe(counter));
}

// ====================================
// TYPING EFFECT (optionnel)
// ====================================

function typeWriter(element, text, speed = 50) {
    let i = 0;
    element.textContent = '';
    
    function type() {
        if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
            setTimeout(type, speed);
        }
    }
    
    type();
}

// ====================================
// INIT ANIMATIONS
// ====================================

document.addEventListener('DOMContentLoaded', function() {
    initSpotlightCards();
    initMovingTruck();
    initTechGallery();
    initSmoothScroll();
    initParallax();
    initCountUp();
});

// ====================================
// PERFORMANCE: Throttle scroll events
// ====================================

function throttle(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Appliquer throttle aux events scroll intensifs
window.addEventListener('scroll', throttle(() => {
    // Les fonctions lourdes ici
}, 100));
