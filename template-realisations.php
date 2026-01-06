<?php
/*
Template Name: Réalisations Optimisé 2026
Description: Portfolio de projets avec filtres et modales
*/

// Configuration de la page
$page_title = "Nos Réalisations | PRODJEKT";
$current_page = 'realisations';

// CSS spécifique à cette page
$extra_css = '
<style>
/* Page Header */
.page-header {
    padding: 150px 5% 50px;
    text-align: center;
}

.page-title {
    font-family: "Syne", sans-serif;
    font-size: clamp(2rem, 4vw, 3.5rem);
    text-transform: uppercase;
    margin-bottom: 20px;
    line-height: 1.1;
}

.page-subtitle {
    color: var(--text-muted);
    max-width: 800px;
    margin: 0 auto;
    font-size: 1.2rem;
    line-height: 1.6;
}

/* Category Filters */
.category-filter-bar {
    position: sticky;
    top: 100px;
    z-index: var(--z-sticky);
    background: rgba(10, 10, 10, 0.8);
    backdrop-filter: blur(20px);
    padding: 20px 5%;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
    border-top: 1px solid var(--glass-border);
    border-bottom: 1px solid var(--glass-border);
}

.filter-btn {
    background: rgba(255,255,255,0.05);
    color: var(--text-muted);
    border: 1px solid var(--glass-border);
    padding: 10px 20px;
    border-radius: var(--radius-full);
    cursor: pointer;
    transition: var(--transition-normal);
    font-family: "Syne", sans-serif;
    text-transform: uppercase;
    font-weight: 700;
    font-size: 0.8rem;
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--accent);
    color: white;
    border-color: var(--accent);
    box-shadow: var(--shadow-accent);
}

/* Projects Grid */
#projects-container {
    padding: 50px 5%;
    min-height: 500px;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
}

/* Project Tiles */
.project-tile {
    height: 300px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    position: relative;
    cursor: pointer;
    border: 1px solid var(--glass-border);
    transition: var(--transition-slow);
    display: block;
}

.project-thumbnail {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.project-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.2));
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 30px;
    opacity: 0;
    transition: 0.3s ease;
}

.project-cat-tag {
    color: var(--accent);
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 5px;
    transform: translateY(20px);
    transition: 0.4s;
}

.project-title {
    font-family: "Syne", sans-serif;
    font-size: 1.5rem;
    color: white;
    text-transform: uppercase;
    transform: translateY(20px);
    transition: 0.3s ease;
}

.project-tile:hover .project-thumbnail {
    transform: scale(1.1);
}

.project-tile:hover .project-overlay {
    opacity: 1;
}

.project-tile:hover .project-title,
.project-tile:hover .project-cat-tag {
    transform: translateY(0);
}

/* Modal */
#project-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.98);
    z-index: var(--z-modal);
    display: flex;
    flex-direction: column;
    opacity: 0;
    pointer-events: none;
    transition: 0.4s;
    overflow-y: auto;
}

#project-modal.active {
    opacity: 1;
    pointer-events: all;
}

.modal-header {
    padding: 20px 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(20,20,20,0.8);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--glass-border);
    position: sticky;
    top: 0;
    z-index: calc(var(--z-modal) + 1);
}

.modal-title {
    font-family: "Syne", sans-serif;
    font-size: 1.5rem;
    text-transform: uppercase;
    color: white;
}

.modal-close {
    font-size: 2rem;
    color: white;
    cursor: pointer;
    transition: var(--transition-normal);
    background: none;
    border: none;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    color: var(--accent);
    transform: rotate(90deg);
}

.modal-body {
    flex-grow: 1;
    padding: 40px 5%;
}

/* Modal Gallery */
.gallery-video-container {
    width: 100%;
    margin-bottom: 40px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1px solid var(--glass-border);
}

.gallery-video {
    width: 100%;
    display: block;
}

.modal-gallery-grid {
    column-count: 3;
    column-gap: 20px;
}

.gallery-image {
    width: 100%;
    height: auto;
    display: block;
    margin-bottom: 20px;
    border-radius: var(--radius-md);
    border: 1px solid rgba(255,255,255,0.1);
    transition: var(--transition-normal);
    cursor: zoom-in;
    break-inside: avoid;
}

.gallery-image:hover {
    border-color: var(--accent);
    opacity: 0.9;
}

/* Responsive */
@media (max-width: 768px) {
    .projects-grid {
        grid-template-columns: 1fr;
    }
    
    .modal-gallery-grid {
        column-count: 1;
    }
    
    .modal-title {
        font-size: 1.2rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
}
</style>
';

// JS spécifique avec données des projets
$extra_js = '
<script>
// Base de données des projets
const allProjects = [
    // FESTIVAL
    { id: "tmb2025", cat: "festival", title: "Touquet Music Beach 2025", thumb: "https://www.prodjekt.fr/wp-content/uploads/2025/08/IMG_6887.jpg", video: "https://www.prodjekt.fr/wp-content/uploads/2025/08/TMB25.mp4", images: ["https://www.prodjekt.fr/wp-content/uploads/2025/08/IMG_6887.jpg", "https://www.prodjekt.fr/wp-content/uploads/2025/08/IMG_6923.jpg", "https://www.prodjekt.fr/wp-content/uploads/2025/08/IMG_6918.jpg"] },
    { id: "hetlindeboom2025", cat: "festival", title: "Het Lindeboom 2025", thumb: "https://www.prodjekt.fr/wp-content/uploads/2025/07/IMG_6731.jpg", video: "", images: ["https://www.prodjekt.fr/wp-content/uploads/2025/07/IMG_6731.jpg", "https://www.prodjekt.fr/wp-content/uploads/2025/07/IMG_6637.jpg"] },
    { id: "mainsquare2025", cat: "festival", title: "Main Square 2025", thumb: "https://www.prodjekt.fr/wp-content/uploads/2025/07/IMG_5665.jpg", video: "", images: ["https://www.prodjekt.fr/wp-content/uploads/2025/07/IMG_5665.jpg", "https://www.prodjekt.fr/wp-content/uploads/2025/07/IMG_5639.jpg"] },
    
    // CONCERT
    { id: "aire2025", cat: "concert", title: "Aire-sur-la-Lys 2025", thumb: "https://www.prodjekt.fr/wp-content/uploads/2025/09/IMG_7049.jpg", video: "https://www.prodjekt.fr/wp-content/uploads/2025/09/Aire-sur-la-Lys.mp4", images: ["https://www.prodjekt.fr/wp-content/uploads/2025/09/IMG_7049.jpg", "https://www.prodjekt.fr/wp-content/uploads/2025/09/IMG_7103.jpg"] },
    { id: "bethune2025", cat: "concert", title: "Béthune Summer Party 2025", thumb: "https://www.prodjekt.fr/wp-content/uploads/2025/07/IMG_6505.jpg", video: "https://www.prodjekt.fr/wp-content/uploads/2025/07/Bethune-Summer-Party-2025-1.mp4", images: ["https://www.prodjekt.fr/wp-content/uploads/2025/07/IMG_6505.jpg"] },
    
    // ENTREPRISE
    { id: "solidarite2025", cat: "entreprise", title: "Solidarité en Scène 2025", thumb: "https://www.prodjekt.fr/wp-content/uploads/2025/06/IMG_4516.jpg", video: "", images: ["https://www.prodjekt.fr/wp-content/uploads/2025/06/IMG_4516.jpg"] },
    
    // MAPPING
    { id: "saintebarbe2023", cat: "mapping", title: "Sainte Barbe 2023", thumb: "https://www.prodjekt.fr/wp-content/uploads/2024/01/IMG_7286.jpg", video: "https://www.prodjekt.fr/wp-content/uploads/2025/11/Sainte-Barbe-2023.mp4", images: ["https://www.prodjekt.fr/wp-content/uploads/2024/01/IMG_7286.jpg"] },
    
    // SPORT
    { id: "t1triathlon2025", cat: "sport", title: "T1 World Cup Indoor Triathlon 2025", thumb: "https://www.prodjekt.fr/wp-content/uploads/2025/06/IMG_4638.jpg", video: "", images: ["https://www.prodjekt.fr/wp-content/uploads/2025/06/IMG_4638.jpg"] },
    
    // COMMEMORATION
    { id: "dday80", cat: "commemoration", title: "D-Day 80 - Juno Beach 2024", thumb: "https://www.prodjekt.fr/wp-content/uploads/2025/11/IMG-20240608-WA0027.jpg", video: "", images: ["https://www.prodjekt.fr/wp-content/uploads/2025/11/IMG-20240608-WA0027.jpg"] }
];

// Render projects
const projectsContainer = document.getElementById("projects-grid");

function renderProjects(filterCat) {
    projectsContainer.innerHTML = "";
    
    const filtered = (filterCat === "all") 
        ? allProjects 
        : allProjects.filter(p => p.cat === filterCat);
        
    if(filtered.length === 0) {
        projectsContainer.innerHTML = \'<div style="grid-column: 1/-1; text-align: center; color: #555; padding: 60px;">Projets à venir</div>\';
        return;
    }

    filtered.forEach(p => {
        const tile = document.createElement("div");
        tile.className = "project-tile reveal";
        tile.onclick = () => openProject(p.id);
        tile.innerHTML = `
            <img src="${p.thumb}" class="project-thumbnail" alt="${p.title}" loading="lazy">
            <div class="project-overlay">
                <div class="project-cat-tag">${p.cat}</div>
                <h3 class="project-title">${p.title}</h3>
            </div>
        `;
        projectsContainer.appendChild(tile);
    });
    
    // Trigger reveal animation
    if(typeof reveal === "function") reveal();
}

function filterProjects(catId, btnElement) {
    document.querySelectorAll(".filter-btn").forEach(btn => btn.classList.remove("active"));
    btnElement.classList.add("active");
    renderProjects(catId);
}

// Modal logic
const modal = document.getElementById("project-modal");
const modalTitle = document.getElementById("modalProjectTitle");
const modalContent = document.getElementById("modalGalleryContent");

function openProject(projectId) {
    const data = allProjects.find(p => p.id === projectId);
    if (!data) return;

    modalTitle.innerText = data.title;
    modalContent.innerHTML = "";

    // Video
    if (data.video) {
        const videoContainer = document.createElement("div");
        videoContainer.className = "gallery-video-container";
        videoContainer.innerHTML = `<video src="${data.video}" class="gallery-video" autoplay loop muted playsinline controls></video>`;
        modalContent.appendChild(videoContainer);
    }

    // Images grid
    const gridContainer = document.createElement("div");
    gridContainer.className = "modal-gallery-grid";

    if (data.images) {
        data.images.forEach(imgSrc => {
            const img = document.createElement("img");
            img.src = imgSrc;
            img.className = "gallery-image";
            img.onclick = function() { openLightbox(this.src); };
            img.loading = "lazy";
            gridContainer.appendChild(img);
        });
    }
    modalContent.appendChild(gridContainer);
    
    modal.classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeProjectModal() {
    modal.classList.remove("active");
    document.body.style.overflow = "auto";
    const video = modalContent.querySelector("video");
    if(video) video.pause();
}

// Init
document.addEventListener("DOMContentLoaded", function() {
    renderProjects("all");
});
</script>
';

// Inclusion du header
include(get_template_directory() . '/includes/header.php');
?>

<!-- PAGE HEADER -->
<div class="page-header">
    <h1 class="page-title text-glow-anim">NOS RÉALISATIONS</h1>
    <p class="page-subtitle">Découvrez une sélection de nos projets les plus marquants. De la conception à la réalité.</p>
</div>

<!-- CATEGORY FILTERS -->
<div class="category-filter-bar">
    <button class="filter-btn active" onclick="filterProjects('all', this)">Tout voir</button>
    <button class="filter-btn" onclick="filterProjects('festival', this)">Festival</button>
    <button class="filter-btn" onclick="filterProjects('concert', this)">Concert</button>
    <button class="filter-btn" onclick="filterProjects('entreprise', this)">Entreprise</button>
    <button class="filter-btn" onclick="filterProjects('mapping', this)">Mapping</button>
    <button class="filter-btn" onclick="filterProjects('defile', this)">Défilé</button>
    <button class="filter-btn" onclick="filterProjects('emotion', this)">E-motion</button>
    <button class="filter-btn" onclick="filterProjects('sport', this)">Sport</button>
    <button class="filter-btn" onclick="filterProjects('commemoration', this)">Commémo</button>
</div>

<!-- PROJECTS GRID -->
<div id="projects-container">
    <div class="projects-grid" id="projects-grid"></div>
</div>

<!-- PROJECT MODAL -->
<div id="project-modal">
    <div class="modal-header">
        <h2 class="modal-title" id="modalProjectTitle">Titre</h2>
        <button class="modal-close" onclick="closeProjectModal()" aria-label="Fermer">×</button>
    </div>
    <div class="modal-body">
        <div id="modalGalleryContent"></div>
    </div>
</div>

<?php
// Inclusion du footer
include(get_template_directory() . '/includes/footer.php');
?>
