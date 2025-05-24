let filtreNomPrenom = document.getElementById("barreRechercheApprenat");
let filtreReferentiel = document.getElementById("filtreApprenant");
let filtreStatut = document.getElementById("filtreApprenantStatut");

filtreNomPrenom.addEventListener("input", appliquerFiltres);
filtreReferentiel.addEventListener("change", appliquerFiltres);
filtreStatut.addEventListener("change", appliquerFiltres);


// fonction 

function appliquerFiltres() {
    const termeRecherche = filtreNomPrenom.value.toLowerCase();
    const referentielFiltre = filtreReferentiel.value.toLowerCase();
    const statutFiltre = filtreStatut.value.toLowerCase();

    let filtres = apprenants.filter(apprenant => {
        const nomComplet = `${apprenant.prenom} ${apprenant.nom}`.toLowerCase();
        const referentiel = apprenant.referentiel.toLowerCase();
        const statut = apprenant.statut.toLowerCase();

        const correspondNom = nomComplet.includes(termeRecherche);
        const correspondReferentiel = referentielFiltre === "filtre par classe" || referentiel.includes(referentielFiltre);
        const correspondStatut = statutFiltre === "tous" || statut === statutFiltre;

        return correspondNom && correspondReferentiel && correspondStatut;
    });

    currentPage = 1; // on revient à la première page
    afficherPage(filtres, currentPage);
    ajouterPagination(filtres);
}
