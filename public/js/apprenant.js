(() => {
  let apprenants = [];
  const rowsPerPage = 5;

  // références DOM
  const rechercheInput = document.getElementById("barreRechercheApprenat");
  const filtreClasse    = document.getElementById("filtreApprenant");
  const filtreStatut    = document.getElementById("filtreApprenantStatut");
  const tabs            = document.querySelectorAll(".listeApprenant");

  // conteneurs et tbody/pagination
  const sections = {
    retenus: {
      tbody: document.getElementById("tbody-retenus"),
      pagination: document.getElementById("pagination-retenus"),
      filterFn: a => a.attente === false
    },
    attente: {
      tbody: document.getElementById("tbody-attente"),
      pagination: document.getElementById("pagination-attente"),
      filterFn: a => a.attente === true
    }
  };

  let state = {
    activeTab: "retenus",
    page: { retenus: 1, attente: 1 }
  };

  // FETCH + init
  fetch("../traitement/filtreApprenant.php")
    .then(r => r.json())
    .then(data => {
      apprenants = data;
      renderAll();
    });

  // listeners filtres
  [rechercheInput, filtreClasse, filtreStatut].forEach(el =>
    el.addEventListener("input", () => {
      state.page.retenus = state.page.attente = 1;
      renderAll();
    })
  );

  // listeners onglets
  tabs.forEach(tab => {
    tab.addEventListener("click", () => {
      const target = tab.dataset.target;
      state.activeTab = target;
      for (let s in sections) {
        document.getElementById(`conteneur-${s}`)
                .style.display = (s === target ? "block" : "none");
      }
    });
  });

  // render global (les deux sections)
  function renderAll() {
    for (let key of Object.keys(sections)) {
      renderSection(key);
    }
  }

  // render une section (retenus ou attente)
  function renderSection(key) {
    const { tbody, pagination, filterFn } = sections[key];
    const pageNum = state.page[key];

    // applique tous les filtres
    const search = rechercheInput.value.toLowerCase().trim();
    const cClasse = filtreClasse.value.toLowerCase();
    const cStatut = filtreStatut.value.toLowerCase();

    let filtered = apprenants
      .filter(filterFn)
      .filter(a => {
        const full  = `${a.prenom} ${a.nom}`.toLowerCase();
        const ref   = (a.referentiel || "").toLowerCase();
        const st    = (a.statut || "").toLowerCase();
        const id    = String(a.id).toLowerCase();
        return (
          (full.includes(search) || ref.includes(search) ||
           st.includes(search)   || id.includes(search)) &&
          (cClasse === ""  || ref === cClasse) &&
          (cStatut === ""  || st  === cStatut)
        );
      });

    // pagination
    const pageCount = Math.ceil(filtered.length / rowsPerPage);
    const start = (pageNum - 1) * rowsPerPage;
    const pageData = filtered.slice(start, start + rowsPerPage);

    // affichage rows
    tbody.innerHTML = pageData.map(a => `
      <tr>
        <td><img src="" alt="" style="width:30px;height:30px;border-radius:50%;object-fit:cover;"></td>
        <td>${a.id}</td>
        <td>${a.prenom} ${a.nom}</td>
        <td>${a.adresse}</td>
        <td>${a["numero de telephone"]}</td>
        <td>${a.referentiel}</td>
        <td>
          <a class="${a.statut==='actif'?'statutActif':'statutInactif'}"
             href="../traitement/changer_statut.php?id=${a.id}&statut=${a.statut==='actif' ? 'Remplacer' : 'actif'}">
            ${a.statut}
          </a>
        </td>
        <td><a href="../view/detailsApprenant.php?id=${a.id}"><i class="fa-solid fa-ellipsis"></i></a></td>
      </tr>
    `).join("");

    // affichage pagination
    pagination.innerHTML = "";
    for (let i = 1; i <= pageCount; i++) {
      const btn = document.createElement("button");
      btn.textContent = i;
      if (i === pageNum) btn.classList.add("active");
      btn.addEventListener("click", () => {
        state.page[key] = i;
        renderSection(key);
      });
      pagination.appendChild(btn);
    }
  }
})();
