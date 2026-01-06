<?php
/*
Template Name: Accueil Optimisé 2026
Description: Page d'accueil refactorisée avec header/footer communs
*/

// Configuration de la page
$page_title = "PRODJEKT | L'Art de la Technique";
$current_page = 'accueil';

// CSS spécifique à cette page
$extra_css = '
<style>
/* Hero Section */
.hero {
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 0 20px;
    position: relative;
    overflow: hidden;
}

.hero-video-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    mask-image: linear-gradient(to bottom, black 70%, transparent 100%);
    -webkit-mask-image: linear-gradient(to bottom, black 70%, transparent 100%);
}

.hero-video-wrapper video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-video-overlay-specific {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.hero h1 {
    font-family: "Syne", sans-serif;
    font-size: clamp(1.8rem, 4vw, 3.5rem);
    line-height: 1.1;
    font-weight: 800;
    margin-bottom: 20px;
    letter-spacing: -1px;
    text-transform: uppercase;
    text-shadow: 0 10px 30px rgba(0,0,0,0.5);
}

.gradient-text {
    background: linear-gradient(45deg, var(--primary), #fff, var(--accent));
    background-size: 200% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientText 5s ease infinite;
}

@keyframes gradientText {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}

.shimmer-text {
    display: inline-block;
    font-family: "Space Grotesk", sans-serif;
    font-size: 1.1rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 4px;
    background: linear-gradient(to right, #555 20%, #fff 50%, #555 80%);
    background-size: 200% auto;
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: shine 4s linear infinite;
    margin-bottom: 50px;
}

.scroll-indicator {
    position: absolute;
    bottom: 40px;
    z-index: 3;
    animation: bounce 2s infinite;
    opacity: 0.7;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
    40% {transform: translateY(-10px);}
    60% {transform: translateY(-5px);}
}

/* Intro Section */
.intro-section {
    display: flex;
    flex-direction: column;
    background: rgba(255,255,255,0.02);
    border-bottom: 1px solid var(--glass-border);
    padding-top: var(--spacing-xl);
    position: relative;
    overflow: hidden;
}

.intro-content-wrapper {
    padding: 0 10%;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 60px;
    z-index: 2;
    margin-bottom: 40px;
}

.intro-text {
    flex: 1;
    min-width: 300px;
}

.intro-text h2 {
    font-family: "Syne", sans-serif;
    font-size: 2.5rem;
    margin-bottom: 20px;
    line-height: 1.2;
}

.intro-text p {
    color: var(--text-muted);
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 15px;
}

.brand-highlight {
    color: var(--accent);
    font-weight: 700;
}

.brand-highlight-link {
    color: var(--accent);
    font-weight: 700;
    text-decoration: underline;
    transition: var(--transition-normal);
}

.brand-highlight-link:hover {
    color: white;
    text-shadow: 0 0 10px var(--accent);
}

/* Sticker 30 ans */
.sticker-wrapper {
    display: inline-block;
    perspective: 1000px;
    padding: 20px;
    z-index: 2;
}

.sticker-30ans {
    width: 220px;
    height: auto;
    transition: transform 0.1s ease-out, filter 0.3s ease;
    filter: drop-shadow(0 0 15px rgba(224, 0, 91, 0.3));
    will-change: transform;
}

/* Camion animé */
.truck-track-container {
    position: relative;
    width: 100%;
    height: 90px;
    z-index: 1;
    margin-top: 20px;
    pointer-events: none;
}

.moving-truck {
    height: 65px;
    width: auto;
    position: absolute;
    left: -300px;
    bottom: 15px;
    filter: drop-shadow(0 5px 5px rgba(0,0,0,0.5));
    transition: all 0.3s;
    cursor: pointer;
    pointer-events: auto;
    animation: driveAcross 18s linear infinite;
}

@keyframes driveAcross {
    0% { transform: translateX(0); left: -300px; }
    100% { transform: translateX(0); left: 100vw; }
}

.moving-truck:hover {
    animation-play-state: paused;
    filter: drop-shadow(0 0 25px rgba(224, 0, 91, 0.8));
    transform: scale(1.05);
}

/* Trust Section */
.trust-section {
    padding: 60px 10%;
    background: rgba(0,0,0,0.3);
    border-bottom: 1px solid var(--glass-border);
}

.trust-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 40px;
    align-items: center;
}

.trust-link {
    display: block;
    text-decoration: none;
}

.trust-item {
    text-align: center;
    padding: 20px;
    border: 1px solid transparent;
    border-radius: var(--radius-md);
    transition: var(--transition-normal);
}

.trust-item:hover {
    background: rgba(255,255,255,0.05);
    border-color: var(--glass-border);
}

.trust-img {
    height: 80px;
    width: auto;
    max-width: 100%;
    margin: 0 auto 20px;
    filter: brightness(0) invert(1) opacity(0.9);
    transition: 0.4s ease;
}

.trust-item:hover .trust-img {
    filter: brightness(1) invert(0) opacity(1);
    transform: scale(1.1);
}

.trust-name {
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 5px;
    color: white;
}

.trust-desc {
    font-size: 0.8rem;
    color: #888;
    line-height: 1.4;
}

/* Sections détails expertises */
.expertise-detail-section {
    border-top: 1px solid var(--glass-border);
    background: rgba(0,0,0,0.4);
    padding: 100px 10%;
}

.detail-content {
    max-width: 1000px;
    margin: 0 auto 40px auto;
    text-align: center;
}

.lead-text {
    font-size: 1.5rem;
    color: white;
    margin-bottom: 20px;
    font-weight: 500;
}

.detail-text p {
    color: var(--text-muted);
    line-height: 1.8;
    margin-bottom: 20px;
}

.grid-title {
    font-family: "Syne", sans-serif;
    font-size: 3rem;
    margin-bottom: 60px;
    text-shadow: 0 5px 15px rgba(0,0,0,0.5);
    text-transform: uppercase;
    text-align: center;
}

/* Bento Grid */
.section-padding {
    padding: 100px 10%;
}

.bento-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

/* Tech Gallery */
.tech-gallery {
    display: flex;
    width: 100%;
    height: 300px;
    gap: 10px;
    margin-top: 40px;
}

.tech-item {
    flex: 1;
    border-radius: 20px;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    transition: all 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    filter: grayscale(100%) brightness(0.9);
    position: relative;
    border: 1px solid rgba(255,255,255,0.1);
    cursor: zoom-in;
    overflow: hidden;
}

.tech-item::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    opacity: 1;
    transition: 0.4s;
}

.tech-item:hover {
    flex: 4;
    filter: grayscale(0%) brightness(1.1);
    border-color: var(--accent);
    box-shadow: 0 0 40px rgba(224,0,91,0.3);
    z-index: 10;
}

.tech-item:hover::after {
    opacity: 0;
}

/* Feature List */
.feature-list {
    margin: 30px auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    max-width: 800px;
    text-align: left;
}

.feature-list li {
    font-family: "Syne", sans-serif;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 15px;
    justify-content: center;
}

.feature-list li i {
    color: var(--accent);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .intro-section {
        padding: 50px 5%;
        gap: 30px;
        text-align: center;
    }
    
    .intro-text h2 {
        font-size: 1.8rem;
    }
    
    .sticker-wrapper {
        margin: 0 auto;
        transform: scale(0.8);
    }
    
    .section-padding {
        padding: 60px 5%;
    }
    
    .bento-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .grid-title {
        font-size: 2rem;
        margin-bottom: 30px;
    }
    
    .card h3 {
        font-size: 1.1rem;
        line-height: 1.2;
    }
    
    .tech-gallery {
        flex-direction: column;
        height: 600px;
    }
    
    .tech-item:hover {
        flex: 2;
    }
    
    .feature-list {
        grid-template-columns: 1fr;
    }
}
</style>
';

// JS spécifique (ajout de logique formulaire si besoin)
$extra_js = '<script src="' . get_template_directory_uri() . '/assets/js/form-handler.js"></script>';

// Inclusion du header
include(get_template_directory() . '/includes/header.php');
?>

<!-- HERO -->
<section class="hero">
    <div class="hero-video-wrapper">
        <video autoplay muted loop playsinline preload="metadata">
            <source src="https://www.prodjekt.fr/wp-content/uploads/2025/06/La-Garden-Fairway-720p.mp4" type="video/mp4">
        </video>
        <div class="hero-video-overlay-specific"></div>
    </div>
    <div class="hero-content reveal">
        <h1>Partenaire technique des <br><span class="gradient-text">créateurs d'événements audacieux</span></h1>
        <p class="shimmer-text">Son . Lumière . Vidéo . Structure</p>
    </div>
    <div class="scroll-indicator">
        <i class="fas fa-chevron-down" style="color: white;" aria-hidden="true"></i>
    </div>
</section>

<!-- INTRO -->
<section class="intro-section reveal">
    <div class="intro-content-wrapper">
        <div class="intro-text">
            <h2>Conjuguer audace, savoir-faire et émotion.</h2>
            <p>Depuis 30 ans, <span class="brand-highlight">PRODJEKT</span> maîtrise l'art de la technique pour sublimer vos événements. Au-delà d'un cadre technique parfaitement maîtrisé, nous insufflons ce supplément d'âme qui fait la différence.</p>
            <p>Adossés à la logistique de notre plateforme <a href="https://7rental.fr/" target="_blank" rel="noopener" class="brand-highlight-link">7Rental (SLS Group)</a>, nous vous accompagnons avec des moyens à la hauteur de vos ambitions.</p>
        </div>
        <div class="sticker-wrapper">
            <img src="https://www.prodjekt.fr/wp-content/uploads/2025/11/Firefly_GPT_sticker-holographique-avec-texte-30-ans-dexperience-.-Fond-transparent-822982.png" 
                 alt="30 ans d'expérience" 
                 class="sticker-30ans"
                 width="220"
                 height="220">
        </div>
    </div>
    <div class="truck-track-container">
        <img src="https://www.prodjekt.fr/wp-content/uploads/2025/11/Camion-7Rental-profil.png" 
             alt="Camion 7Rental" 
             class="moving-truck" 
             onclick="window.open('https://7rental.fr/', '_blank')"
             width="150"
             height="65">
    </div>
</section>

<!-- TRUST SECTION -->
<section class="trust-section reveal">
    <div class="trust-grid">
        <a href="https://www.synpase.fr/" target="_blank" rel="noopener" class="trust-link">
            <div class="trust-item">
                <img src="https://www.prodjekt.fr/wp-content/uploads/2025/11/labelogo-removebg-preview.png" 
                     alt="Label Spectacle Vivant" 
                     class="trust-img"
                     width="120"
                     height="80">
                <div class="trust-name">Spectacle Vivant®</div>
                <div class="trust-desc">Label 439 : Prestataire technique expert</div>
            </div>
        </a>
        <a href="https://www.prestadd.fr/" target="_blank" rel="noopener" class="trust-link">
            <div class="trust-item">
                <img src="https://www.prodjekt.fr/wp-content/uploads/2025/11/logo_label_prestadd-removebg-preview.png" 
                     alt="Label Prestadd" 
                     class="trust-img"
                     width="120"
                     height="80">
                <div class="trust-name">Prestadd®</div>
                <div class="trust-desc">Label 184 : Engagement RSE & Durable</div>
            </div>
        </a>
        <a href="https://www.l-acoustics.com/" target="_blank" rel="noopener" class="trust-link">
            <div class="trust-item">
                <img src="https://www.prodjekt.fr/wp-content/uploads/2024/11/653c31a72017e45a1a845bab_lacoustic-Logo-1080x1080-1.png" 
                     alt="L-Acoustics Certified" 
                     class="trust-img"
                     width="120"
                     height="80">
                <div class="trust-name">L-Acoustics</div>
                <div class="trust-desc">Partenaire Système Audio Certifié</div>
            </div>
        </a>
        <a href="https://www.synpase.fr/" target="_blank" rel="noopener" class="trust-link">
            <div class="trust-item">
                <img src="https://www.prodjekt.fr/wp-content/uploads/2025/11/logo-synpase-removebg-preview.png" 
                     alt="SYNPASE membre" 
                     class="trust-img"
                     width="120"
                     height="80">
                <div class="trust-name">SYNPASE</div>
                <div class="trust-desc">Membre du Syndicat National</div>
            </div>
        </a>
    </div>
</section>

<!-- EXPERTISES GRID -->
<section class="section-padding">
    <h2 class="grid-title reveal text-glow-anim">NOS EXPERTISES</h2>
    <div class="bento-grid" id="cards-container">
        <div class="card reveal" onclick="location.href='#entreprise'">
            <div class="card-content">
                <i class="fas fa-handshake card-icon" aria-hidden="true"></i>
                <h3>Événement Entreprise</h3>
                <p>Conventions & lancements.</p>
            </div>
            <a href="#entreprise" class="card-link">En savoir plus <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="card reveal" onclick="location.href='#mapping'">
            <div class="card-content">
                <i class="fas fa-project-diagram card-icon" aria-hidden="true"></i>
                <h3>Mapping Vidéo</h3>
                <p>Projection monumentale.</p>
            </div>
            <a href="#mapping" class="card-link">En savoir plus <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="card reveal" onclick="location.href='#defile'">
            <div class="card-content">
                <i class="fas fa-star card-icon" aria-hidden="true"></i>
                <h3>Défilé de mode</h3>
                <p>Catwalk & Light design.</p>
            </div>
            <a href="#defile" class="card-link">En savoir plus <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="card reveal" onclick="location.href='#emotion'">
            <div class="card-content">
                <i class="fas fa-wifi card-icon" aria-hidden="true"></i>
                <h3>E-motion</h3>
                <p>Digital & Streaming.</p>
            </div>
            <a href="#emotion" class="card-link">En savoir plus <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="card reveal" onclick="location.href='#sport'">
            <div class="card-content">
                <i class="fas fa-trophy card-icon" aria-hidden="true"></i>
                <h3>Événement sportif</h3>
                <p>Technique Outdoor.</p>
            </div>
            <a href="#sport" class="card-link">En savoir plus <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="card reveal" onclick="location.href='#commemoration'">
            <div class="card-content">
                <i class="fas fa-monument card-icon" aria-hidden="true"></i>
                <h3>Commémoration</h3>
                <p>Solennité & Patrimoine.</p>
            </div>
            <a href="#commemoration" class="card-link">En savoir plus <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="card reveal" onclick="location.href='#concert'">
            <div class="card-content">
                <i class="fas fa-guitar card-icon" aria-hidden="true"></i>
                <h3>Concert</h3>
                <p>Live, Son & Lumière.</p>
            </div>
            <a href="#concert" class="card-link">En savoir plus <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="card reveal" onclick="location.href='#festival'">
            <div class="card-content">
                <i class="fas fa-ticket-alt card-icon" aria-hidden="true"></i>
                <h3>Festival</h3>
                <p>Solutions XXL.</p>
            </div>
            <a href="#festival" class="card-link">En savoir plus <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="card reveal" onclick="location.href='/cle-en-main/'">
            <div class="card-content">
                <i class="fas fa-key card-icon" aria-hidden="true"></i>
                <h3>Clé en main</h3>
                <p>Gestion A à Z.</p>
            </div>
            <a href="/cle-en-main/" class="card-link">En savoir plus <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>
    </div>
</section>

<!-- DÉTAILS EXPERTISES (Exemples) -->
<section id="entreprise" class="expertise-detail-section reveal">
    <h2 class="grid-title text-glow-anim">ÉVÉNEMENT ENTREPRISE</h2>
    <div class="detail-content">
        <p class="lead-text">Transformez vos enjeux stratégiques en expériences mémorables.</p>
        <div class="detail-text">
            <p>Parce que chaque prise de parole compte, nous concevons l'écrin technique qui donnera de la portée à votre message.</p>
        </div>
        <ul class="feature-list">
            <li><i class="fas fa-check" aria-hidden="true"></i> Vœux & Cérémonies</li>
            <li><i class="fas fa-check" aria-hidden="true"></i> Conventions & Séminaires</li>
        </ul>
        <div class="tech-gallery">
            <div class="tech-item" style="background-image: url('https://www.prodjekt.fr/wp-content/uploads/2025/11/IMG_49293.jpg');"></div>
            <div class="tech-item" style="background-image: url('https://www.prodjekt.fr/wp-content/uploads/2025/11/IMG_4088.jpg');"></div>
            <div class="tech-item" style="background-image: url('https://www.prodjekt.fr/wp-content/uploads/2025/11/490860147_1218506650285133_5487751675451188613_n.jpg');"></div>
        </div>
        <div style="margin-top: 40px;">
            <a href="#contact" class="cta-btn">Échangeons sur votre projet</a>
        </div>
    </div>
</section>

<!-- Répéter pour les autres sections (mapping, défilé, etc.) selon le même modèle -->

<?php
// Inclusion du footer (avec formulaire CF7)
include(get_template_directory() . '/includes/footer.php');
?>
