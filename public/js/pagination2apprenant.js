let apprenants = []; // Données complètes
let currentPage = 1;
const rowsPerPage = 5;

// Références aux champs de filtre
const filtreNomPrenom = document.getElementById("barreRechercheApprenat");
const filtreReferentiel = document.getElementById("filtreApprenant");
const filtreStatut = document.getElementById("filtreApprenantStatut");

// Charger les données depuis PHP
fetch("../traitement/filtreApprenant.php")
    .then(res => res.json())
    .then(data => {
        apprenants = data;
        appliquerFiltres(); // Affichage initial filtré
    });

// Événements sur les filtres
filtreNomPrenom.addEventListener("input", appliquerFiltres);
filtreReferentiel.addEventListener("change", appliquerFiltres);
filtreStatut.addEventListener("change", appliquerFiltres);

// Fonction principale de filtrage
function appliquerFiltres() {
    const recherche = filtreNomPrenom.value.toLowerCase().trim();
    const filtreClasse = filtreReferentiel.value.toLowerCase();
    const filtreStatutValue = filtreStatut.value.toLowerCase();

    // Appliquer les filtres sur les données
    const donneesFiltrees = apprenants.filter(apprenant => {
        const nomComplet = `${apprenant.prenom} ${apprenant.nom}`.toLowerCase();
        const referentiel = apprenant.referentiel?.toLowerCase() || "";
        const statut = apprenant.statut?.toLowerCase() || "";
        const id = apprenant.id?.toString().toLowerCase() || "";
        const promotion = apprenant.promotion?.toLowerCase() || ""; // si présent

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

    currentPage = 1;
    afficherPage(donneesFiltrees, currentPage);
    ajouterPagination(donneesFiltrees);
}

// Affiche une page donnée avec les apprenants (après filtre attente)
function afficherPage(data, page) {
    const tbody = document.querySelector("#ListeRetenuTableau tbody");
    tbody.innerHTML = "";

    // Filtrer les apprenants à afficher (attente === false)
    const dataFiltreAttente = data.filter(apprenant => apprenant.attente === false);

    // Paginer les données après filtrage
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = dataFiltreAttente.slice(start, end);

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

// Génère les boutons de pagination dynamiquement
function ajouterPagination(data) {
    const pagination = document.getElementById("pagination");

    // On ne pagine que sur les apprenants dont attente === false
    const dataFiltreAttente = data.filter(apprenant => apprenant.attente === false);
    const pageCount = Math.ceil(dataFiltreAttente.length / rowsPerPage);

    pagination.innerHTML = "";

    for (let i = 1; i <= pageCount; i++) {
        const btn = document.createElement("button");
        btn.innerText = i;
        btn.classList.add("page-btnApprenant");
        if (i === currentPage) btn.classList.add("active");

        btn.addEventListener("click", function () {
            currentPage = i;
            afficherPage(data, currentPage);
            document.querySelectorAll(".page-btnApprenant").forEach(b => b.classList.remove("active"));
            this.classList.add("active");
        });

        pagination.appendChild(btn);
    }
}
