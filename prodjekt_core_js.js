/**
 * PRODJEKT - Core JavaScript
 * Scripts essentiels communs à toutes les pages
 */

// ====================================
// MENU MOBILE
// ====================================

function toggleMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('active');
}

// ====================================
// CUSTOM CURSOR
// ====================================

function initCursor() {
    // Skip sur mobile/tablette
    if (window.matchMedia("(pointer: coarse)").matches) return;
    
    const cursorDot = document.querySelector('[data-cursor-dot]');
    const cursorOutline = document.querySelector('[data-cursor-outline]');
    
    if (!cursorDot || !cursorOutline) return;
    
    window.addEventListener("mousemove", function (e) {
        const posX = e.clientX;
        const posY = e.clientY;
        
        cursorDot.style.left = `${posX}px`;
        cursorDot.style.top = `${posY}px`;
        
        cursorOutline.animate(
            { left: `${posX}px`, top: `${posY}px` },
            { duration: 500, fill: "forwards" }
        );
    });
    
    // Hover effect
    const interactiveElements = document.querySelectorAll('a, button, .card, .project-tile, .news-card, .product-card, .filter-btn, .tech-item, select, input, textarea, .checkbox-label, .gallery-image, .trust-card');
    
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            document.body.classList.add('hovering');
        });
        el.addEventListener('mouseleave', () => {
            document.body.classList.remove('hovering');
        });
    });
}

// ====================================
// SCROLL REVEAL
// ====================================

function reveal() {
    const reveals = document.querySelectorAll(".reveal");
    const windowHeight = window.innerHeight;
    const elementVisible = 150;
    
    for (let i = 0; i < reveals.length; i++) {
        const elementTop = reveals[i].getBoundingClientRect().top;
        
        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("active");
        }
    }
}

// ====================================
// LIGHTBOX
// ====================================

function openLightbox(src) {
    const lightbox = document.getElementById('img-lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    
    if (lightbox && lightboxImg) {
        lightboxImg.src = src;
        lightbox.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeLightbox() {
    const lightbox = document.getElementById('img-lightbox');
    
    if (lightbox) {
        lightbox.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

// ====================================
// STICKER 3D INTERACTIF
// ====================================

function initStickerEffect() {
    const wrapper = document.querySelector('.sticker-wrapper');
    const sticker = document.querySelector('.sticker-30ans');
    
    if (!wrapper || !sticker) return;
    
    wrapper.addEventListener('mousemove', (e) => {
        const rect = wrapper.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const rotateX = -((y - centerY) / centerY) * 20;
        const rotateY = ((x - centerX) / centerX) * 20;
        
        sticker.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.1)`;
    });
    
    wrapper.addEventListener('mouseleave', () => {
        sticker.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1)';
    });
}

// ====================================
// INIT AU CHARGEMENT
// ====================================

document.addEventListener('DOMContentLoaded', function() {
    initCursor();
    reveal();
    initStickerEffect();
    
    // Scroll reveal on scroll
    window.addEventListener("scroll", reveal);
    
    // Fermer lightbox avec Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === "Escape") {
            closeLightbox();
            
            // Fermer aussi les modales si elles existent
            if (typeof closeNewsModal === 'function') closeNewsModal();
            if (typeof closeProjectModal === 'function') closeProjectModal();
            if (typeof closeModal === 'function') closeModal();
        }
    });
});

// ====================================
// LAZY LOADING IMAGES
// ====================================

if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                const src = img.getAttribute('data-src');
                
                if (src) {
                    img.src = src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            }
        });
    });
    
    // Attendre que le DOM soit chargé pour observer
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    });
}
