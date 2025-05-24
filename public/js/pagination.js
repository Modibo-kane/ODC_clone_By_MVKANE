let apprenants = []; // Stocke les données JSON
let currentPage = 1;
const rowsPerPage = 5; // nombre d’éléments par page

// Charger les données JSON
fetch("../traitement/filtreApprenant.php")
    .then(res => res.json())
    .then(data => {
        apprenants = data;
        afficherPage(apprenants, currentPage);
        ajouterPagination(apprenants);
    });

// Afficher les apprenants d'une page
function afficherPage(data, page) {
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = data.slice(start, end);

    const tbody = document.querySelector("#ListeAttenteTableauDetail tbody");
    tbody.innerHTML = ""; // vider

    pageData.forEach(apprenant => {
        tbody.innerHTML += `
            <tr>
                <td><img src="" alt="imag" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;"></td>
                <td>${apprenant.id}</td>
                <td>${apprenant.prenom} ${apprenant.nom}</td>
                <td>${apprenant["adresse"]}</td>
                <td><span class="${apprenant.statut === 'actif' ? 'statutActif' : 'statutInactif'}">Justifié</span></td>
                <td>
                    <a class="${apprenant.statut === 'actif' ? 'statutActif' : 'statutInactif'}"
                       href="../traitement/changer_statut.php?id=${apprenant.id}&statut=${apprenant.statut === 'actif' ? 'Remplacer' : 'actif'}">
                        ${apprenant.statut}
                    </a>
                </td>
                <td><a href="../view/detailsApprenant.php?id=${apprenant.id}"><i class="fa-solid fa-ellipsis"></i></a></td>
            </tr>
        `;
    });
}

// Ajouter la pagination
function ajouterPagination(data) {
    const pageCount = Math.ceil(data.length / rowsPerPage);
    const pagination = document.getElementById("pagination");
    pagination.innerHTML = "";

    for (let i = 1; i <= pageCount; i++) {
        const btn = document.createElement("button");
        btn.innerText = i;
        btn.classList.add("page-btnApprenant");
        if (i === currentPage) btn.classList.add("active");

        btn.addEventListener("click", function () {
            currentPage = i;
            afficherPage(apprenants, currentPage);
            document.querySelectorAll(".page-btnApprenant").forEach(b => b.classList.remove("active"));
            this.classList.add("active");
        });

        pagination.appendChild(btn);
    }
}
