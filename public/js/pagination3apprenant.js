let apprenantsAttente = []; // Données complètes pour attente
let currentPageAttente = 1;
const rowsPerPageAttente = 5;

// Références aux champs de filtre
const filtreNomPrenomAttente = document.getElementById("barreRechercheApprenat");
const filtreReferentielAttente = document.getElementById("filtreApprenant");
const filtreStatutAttente = document.getElementById("filtreApprenantStatut");

// Charger les données depuis PHP
fetch("../traitement/filtreApprenant.php")
    .then(res => res.json())
    .then(data => {
        apprenantsAttente = data;
        appliquerFiltresAttente(); // Affichage initial filtré
    });

// Événements sur les filtres
filtreNomPrenomAttente.addEventListener("input", appliquerFiltresAttente);
filtreReferentielAttente.addEventListener("change", appliquerFiltresAttente);
filtreStatutAttente.addEventListener("change", appliquerFiltresAttente);

// Fonction principale de filtrage
function appliquerFiltresAttente() {
    const recherche = filtreNomPrenomAttente.value.toLowerCase().trim();
    const filtreClasse = filtreReferentielAttente.value.toLowerCase();
    const filtreStatutValue = filtreStatutAttente.value.toLowerCase();

    // Appliquer les filtres sur les données
    const donneesFiltrees = apprenantsAttente.filter(apprenant => {
        const nomComplet = `${apprenant.prenom} ${apprenant.nom}`.toLowerCase();
        const referentiel = apprenant.referentiel?.toLowerCase() || "";
        const statut = apprenant.statut?.toLowerCase() || "";
        const id = apprenant.id?.toString().toLowerCase() || "";
        const promotion = apprenant.promotion?.toLowerCase() || "";

        const correspondRecherche =
            nomComplet.includes(recherche) ||
            referentiel.includes(recherche) ||
            statut.includes(recherche) ||
            id.includes(recherche) ||
            promotion.includes(recherche);

        const correspondClasse =
            filtreClasse === "filtre par classe" || referentiel === filtreClasse;

        const correspondStatut =
            filtreStatutValue === "tous" || statut === filtreStatutValue;

        return correspondRecherche && correspondClasse && correspondStatut;
    });

    currentPageAttente = 1;
    afficherPageAttente(donneesFiltrees, currentPageAttente);
    ajouterPaginationAttente(donneesFiltrees);
}

// Affiche une page donnée avec les apprenants en attente
function afficherPageAttente(data, page) {
    const tbody = document.querySelector("#ListeAttenteTableau tbody");
    tbody.innerHTML = "";

    // Filtrer les apprenants à afficher (attente === true)
    const dataFiltre = data.filter(apprenant => apprenant.attente === true);

    const start = (page - 1) * rowsPerPageAttente;
    const end = start + rowsPerPageAttente;
    const pageData = dataFiltre.slice(start, end);

    pageData.forEach(apprenant => {
        const row = `
            <tr>
                <td><img src="" alt="image" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;"></td>
                <td>${apprenant.id}</td>
                <td>${apprenant.prenom} ${apprenant.nom}</td>
                <td>${apprenant.adresse}</td>
                <td>${apprenant["numero de telephone"]}</td>
                <td>${apprenant.referentiel}</td>
                <td>
                    <a class="${apprenant.statut === 'actif' ? 'statutActif' : 'statutInactif'}"
                       href="../traitement/changer_statut.php?id=${apprenant.id}&statut=${apprenant.statut === 'actif' ? 'Remplacer' : 'actif'}">
                        ${apprenant.statut}
                    </a>
                </td>
                <td><a href="../view/detailsApprenant.php?id=${apprenant.id}"><i class="fa-solid fa-ellipsis"></i></a></td>
            </tr>
        `;
        tbody.innerHTML += row;
    });
}

// Génère les boutons de pagination pour attente
function ajouterPaginationAttente(data) {
    const paginationattente = document.getElementById("pagination-attente");

    const dataFiltre = data.filter(apprenant => apprenant.attente === true);
    const pageCount = Math.ceil(dataFiltre.length / rowsPerPageAttente);

    paginationattente.innerHTML = "";

    for (let i = 1; i <= pageCount; i++) {
        const btn = document.createElement("button");
        btn.innerText = i;
        btn.classList.add("page-btnAttente");
        if (i === currentPageAttente) btn.classList.add("active");

        btn.addEventListener("click", function () {
            currentPageAttente = i;
            afficherPageAttente(data, currentPageAttente);
            document.querySelectorAll(".page-btnAttente").forEach(b => b.classList.remove("active"));
            this.classList.add("active");
        });

        paginationattente.appendChild(btn);
    }
}
