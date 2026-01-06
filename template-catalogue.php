<?php
/*
Template Name: Catalogue Optimisé 2026
Description: Catalogue scénique avec filtres et graphiques
*/

// Configuration de la page
$page_title = "Catalogue Scénique | PRODJEKT";
$current_page = 'catalogue';

// CSS + Chart.js
$extra_css = '
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
}

/* Filters */
#filters {
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 40px;
    padding: 0 5%;
}

.filter-btn {
    background: rgba(255,255,255,0.1);
    color: var(--text-muted);
    border: 1px solid var(--glass-border);
    padding: 10px 20px;
    border-radius: var(--radius-full);
    cursor: pointer;
    transition: var(--transition-normal);
    font-family: "Space Grotesk", sans-serif;
    text-transform: uppercase;
    font-weight: 600;
    font-size: 0.8rem;
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--accent);
    color: white;
    border-color: var(--accent);
}

/* Product Grid */
#product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    padding: 0 5% 80px;
}

.product-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    transition: var(--transition-slow);
    cursor: pointer;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-10px);
    border-color: var(--accent);
    box-shadow: 0 10px 30px rgba(224,0,91,0.2);
}

.product-img-wrapper {
    position: relative;
    overflow: hidden;
    height: 220px;
}

.product-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.5s;
}

.product-card:hover .product-img {
    transform: scale(1.1);
}

.product-content {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-title {
    font-family: "Syne", sans-serif;
    font-size: 1.3rem;
    margin-bottom: 10px;
    color: white;
}

.product-desc {
    font-size: 0.9rem;
    color: #999;
    margin-bottom: 20px;
    line-height: 1.5;
    flex-grow: 1;
}

.product-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid rgba(255,255,255,0.1);
    padding-top: 15px;
}

.product-tag {
    background: rgba(224,0,91,0.2);
    color: var(--accent);
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 0.75rem;
    font-weight: 700;
}

.view-details {
    color: var(--accent);
    font-weight: 700;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Modal */
#details-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.95);
    backdrop-filter: blur(10px);
    z-index: var(--z-modal);
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    pointer-events: none;
    transition: 0.4s;
    overflow-y: auto;
}

#details-modal.active {
    opacity: 1;
    pointer-events: all;
}

.modal-content {
    background: #0a0a0a;
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-lg);
    width: 90%;
    max-width: 1100px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    padding: 40px;
    margin: 20px;
}

.modal-close {
    position: absolute;
    top: 20px;
    right: 20px;
    color: white;
    font-size: 2rem;
    cursor: pointer;
    z-index: calc(var(--z-modal) + 1);
    background: none;
    border: none;
}

.modal-close:hover {
    color: var(--accent);
}

.modal-info h3 {
    font-family: "Syne", sans-serif;
    font-size: 2.5rem;
    margin-bottom: 10px;
    color: white;
    text-transform: uppercase;
}

.specs-list {
    margin-top: 20px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.specs-list li {
    color: var(--text-muted);
    font-size: 0.95rem;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    padding-bottom: 5px;
}

.specs-list li strong {
    color: white;
}

/* Chart Section */
.chart-section {
    padding: 50px 10%;
    background: rgba(0,0,0,0.3);
    margin-bottom: 50px;
}

.chart-container {
    height: 400px;
    width: 100%;
    margin-top: 30px;
    background: rgba(255,255,255,0.02);
    border-radius: var(--radius-lg);
    padding: 20px;
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
    border-radius: var(--radius-md);
    background-position: center;
    background-size: cover;
    transition: all 0.5s ease;
    filter: grayscale(100%) brightness(0.6);
    cursor: pointer;
    position: relative;
    border: 1px solid rgba(255,255,255,0.1);
}

.tech-item:hover {
    flex: 4;
    filter: grayscale(0%) brightness(1.1);
    border-color: var(--accent);
}

/* Responsive */
@media (max-width: 768px) {
    .modal-content {
        padding: 20px;
        width: 95%;
    }
    
    .specs-list {
        grid-template-columns: 1fr;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .tech-gallery {
        flex-direction: column;
        height: 500px;
    }
    
    .tech-item:hover {
        flex: 2;
    }
}
</style>
';

// JS avec données produits + Chart.js
$extra_js = '
<script>
// Base de données produits
const products = [
    { category: "Grande Scène", name: "Grande Scène (B100R Prolyte)", description: "Idéale pour les grands festivals.", surface: 240, resistance: 750, charge: 13, hauteur: 9.5, images: ["https://www.prodjekt.fr/wp-content/uploads/2025/09/img144.jpg", "https://www.prodjekt.fr/wp-content/uploads/2020/03/Touquet-Music-Beach-Festival-2019.jpg"] },
    { category: "Grande Scène", name: "Alpha Stage 80 (Mobile)", description: "Solution mobile rapide.", surface: 82, resistance: 500, charge: 10, hauteur: 6, images: ["https://www.prodjekt.fr/wp-content/uploads/2025/09/IMG_7008.jpeg"] },
    { category: "Arc-Roof", name: "Arc-Roof 14 x 11 HT", description: "Show spectaculaire.", surface: 154, resistance: 750, charge: 5, hauteur: 7.1, images: ["https://www.prodjekt.fr/wp-content/uploads/2025/09/img174.jpg"] },
    { category: "Tunnels & Dômes", name: "Tunnel Roof", description: "Passerelles et entrées.", surface: 40, resistance: 0, charge: 1.5, hauteur: 4.2, images: ["https://www.prodjekt.fr/wp-content/uploads/2025/09/img294.jpg"] }
];

const grid = document.getElementById("product-grid");
const filtersDiv = document.getElementById("filters");
const categories = ["Tous", ...new Set(products.map(p => p.category))];
let currentCat = "Tous";

function renderFilters() {
    filtersDiv.innerHTML = categories.map(cat => 
        `<button class="filter-btn ${cat === currentCat ? "active" : ""}" onclick="filterProducts(\'${cat}\')">${cat}</button>`
    ).join("");
}

function filterProducts(cat) {
    currentCat = cat;
    renderFilters();
    const filtered = cat === "Tous" ? products : products.filter(p => p.category === cat);
    grid.innerHTML = filtered.map(p => `
        <div class="product-card" onclick="openModal(\'${p.name}\')">
            <div class="product-img-wrapper">
                <img src="${p.images[0]}" class="product-img" alt="${p.name}" loading="lazy">
            </div>
            <div class="product-content">
                <h4 class="product-title">${p.name}</h4>
                <p class="product-desc">${p.description}</p>
                <div class="product-meta">
                    <span class="product-tag">${p.surface} m²</span>
                    <span class="view-details">Détails <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    `).join("");
}

// Modal
const modal = document.getElementById("details-modal");
function openModal(productName) {
    const p = products.find(prod => prod.name === productName);
    if(!p) return;
    
    document.getElementById("modal-title").innerText = p.name;
    document.getElementById("modal-desc").innerText = p.description;
    
    const galleryContainer = document.getElementById("modal-gallery-container");
    let galleryHTML = "<div class=\"tech-gallery\">";
    p.images.forEach(imgSrc => { 
        galleryHTML += `<div class="tech-item" style="background-image: url(\'${imgSrc}\');" onclick="event.stopPropagation(); openLightbox(\'${imgSrc}\')"></div>`; 
    });
    galleryHTML += "</div>";
    galleryContainer.innerHTML = galleryHTML;

    let specs = `<li><strong>Surface :</strong> ${p.surface} m²</li>`;
    if(p.charge) specs += `<li><strong>Charge :</strong> ${p.charge} T</li>`;
    if(p.hauteur) specs += `<li><strong>Hauteur :</strong> ${p.hauteur} m</li>`;
    document.getElementById("modal-specs").innerHTML = specs;
    
    modal.classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeModal() {
    modal.classList.remove("active");
    document.body.style.overflow = "auto";
}

// Chart.js
let myChart;
function updateChart(metric, btn) {
    document.querySelectorAll("#chart-filters button").forEach(b => b.classList.remove("active"));
    btn.classList.add("active");
    const ctx = document.getElementById("comparisonChart").getContext("2d");
    const labels = products.map(p => p.name.substring(0, 15) + "...");
    const data = products.map(p => p[metric] || 0);
    if(myChart) myChart.destroy();
    myChart = new Chart(ctx, {
        type: "bar",
        data: { 
            labels: labels, 
            datasets: [{ 
                label: metric, 
                data: data, 
                backgroundColor: "rgba(224, 0, 91, 0.5)", 
                borderColor: "#e0005b", 
                borderWidth: 1 
            }] 
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false, 
            scales: { 
                y: { beginAtZero: true, grid: { color: "rgba(255,255,255,0.1)" }, ticks: { color: "#ccc" } }, 
                x: { grid: { display: false }, ticks: { color: "#ccc" } } 
            }, 
            plugins: { legend: { display: false } } 
        }
    });
}

// Init
document.addEventListener("DOMContentLoaded", function() {
    renderFilters();
    filterProducts("Tous");
    updateChart("surface", document.querySelector("#chart-filters button"));
});
</script>
';

// Inclusion du header
include(get_template_directory() . '/includes/header.php');
?>

<!-- PAGE HEADER -->
<div class="page-header">
    <h1 class="page-title text-glow-anim">Catalogue Scénique</h1>
    <p class="page-subtitle">Explorez notre parc de structures. Des scènes grandioses aux dômes immersifs.</p>
</div>

<!-- FILTERS -->
<div id="filters"></div>

<!-- PRODUCT GRID -->
<div id="product-grid"></div>

<!-- CHART SECTION -->
<div class="chart-section">
    <h2 class="text-center text-glow-anim" style="font-family:\'Syne\'; font-size:2rem; text-align:center; margin-bottom:30px;">
        COMPARATEUR TECHNIQUE
    </h2>
    <div id="chart-filters" style="display:flex; justify-content:center; gap:10px; margin-bottom:20px;">
        <button class="filter-btn active" onclick="updateChart(\'surface\', this)">Surface</button>
        <button class="filter-btn" onclick="updateChart(\'charge\', this)">Charge</button>
        <button class="filter-btn" onclick="updateChart(\'hauteur\', this)">Hauteur</button>
    </div>
    <div class="chart-container">
        <canvas id="comparisonChart"></canvas>
    </div>
</div>

<!-- MODAL DETAILS -->
<div id="details-modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal()" aria-label="Fermer">×</button>
        <div class="modal-info">
            <h3 id="modal-title"></h3>
            <p id="modal-desc" style="color:var(--text-muted); margin-bottom:20px;"></p>
        </div>
        <div id="modal-gallery-container" class="modal-gallery-wrapper"></div>
        <ul id="modal-specs" class="specs-list"></ul>
        <div style="text-align:center; margin-top:30px;">
            <a href="#contact" class="cta-btn">Demander un devis pour ce produit</a>
        </div>
    </div>
</div>

<?php
// Inclusion du footer
include(get_template_directory() . '/includes/footer.php');
?>
