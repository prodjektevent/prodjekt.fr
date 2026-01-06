<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PRODJEKT - Partenaire technique de référence pour l'événementiel en France. Son, Lumière, Vidéo, Structure.">
    <meta name="author" content="PRODJEKT">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo isset($page_title) ? $page_title : 'PRODJEKT | L\'Art de la Technique'; ?>">
    <meta property="og:description" content="Partenaire technique des créateurs d'événements audacieux">
    <meta property="og:image" content="https://www.prodjekt.fr/wp-content/uploads/2025/11/Logo-Prodjekt-blanc.png">
    <meta property="og:url" content="https://www.prodjekt.fr">
    
    <title><?php echo isset($page_title) ? $page_title : 'PRODJEKT | L\'Art de la Technique'; ?></title>
    
    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/variables.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/components.css">
    <?php if(isset($extra_css)) echo $extra_css; ?>
</head>
<body>

    <!-- Custom Cursor -->
    <div class="cursor-dot" data-cursor-dot></div>
    <div class="cursor-outline" data-cursor-outline></div>

    <!-- Video Background -->
    <div class="global-video-container">
        <video autoplay muted loop playsinline preload="metadata">
            <source src="https://www.prodjekt.fr/wp-content/uploads/2025/11/1121.mp4" type="video/mp4">
        </video>
    </div>
    <div class="global-video-overlay"></div>

    <!-- Header Navigation -->
    <header>
        <a href="/" class="logo-wrapper">
            <img src="https://www.prodjekt.fr/wp-content/uploads/2025/11/Logo-Prodjekt-blanc.png" 
                 alt="Logo Prodjekt" 
                 class="logo-img"
                 width="150"
                 height="45">
        </a>
        
        <nav class="desktop-nav" aria-label="Navigation principale">
            <ul>
                <li><a href="/nos-realisations/" <?php echo (isset($current_page) && $current_page == 'realisations') ? 'class="active"' : ''; ?>>Nos réalisations</a></li>
                <li><a href="/cle-en-main/" <?php echo (isset($current_page) && $current_page == 'cle-en-main') ? 'class="active"' : ''; ?>>Clé en main</a></li>
                <li><a href="/actualites/" <?php echo (isset($current_page) && $current_page == 'actualites') ? 'class="active"' : ''; ?>>L'actu</a></li>
                <li><a href="/catalogue-scenique/" <?php echo (isset($current_page) && $current_page == 'catalogue') ? 'class="active"' : ''; ?>>Catalogue scénique</a></li>
            </ul>
        </nav>
        
        <a href="#contact" class="cta-btn">Échangeons sur votre projet</a>
        <button class="burger-menu-btn" onclick="toggleMenu()" aria-label="Menu mobile">
            <i class="fas fa-bars"></i>
        </button>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay" id="mobileMenu">
        <nav aria-label="Menu mobile">
            <ul>
                <li><a href="/nos-realisations/" onclick="toggleMenu()">Nos réalisations</a></li>
                <li><a href="/cle-en-main/" onclick="toggleMenu()">Clé en main</a></li>
                <li><a href="/actualites/" onclick="toggleMenu()">L'actu</a></li>
                <li><a href="/catalogue-scenique/" onclick="toggleMenu()">Catalogue scénique</a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <main>
