const programmeModules = document.querySelector('.programmeModules');
const listePresenceApprenant = document.querySelector('.ListePresenceApprenant');

const tableauPresence = document.querySelector('.ListePresenceApprenantContTableau');
const programme = document.querySelector('.programme');

programmeModules.addEventListener('click', function () {
    // Activer le programme, désactiver la présence
    programme.classList.add('slideActive');
    programme.classList.remove('slideDesactive');
    tableauPresence.classList.add('slideDesactive');
    tableauPresence.classList.remove('slideActive');
    programmeModules.style.borderBottom = "orangered solid 5px";
    listePresenceApprenant.style.borderBottom = "transparent solid 5px";
    programmeModules.style.backgroundColor = "rgba(255, 0, 0, 0.2)";
    listePresenceApprenant.style.backgroundColor = "transparent";
    listePresenceApprenant.style.color = "black";
});

listePresenceApprenant.addEventListener('click', function () {
    // Activer la présence, désactiver le programme
    tableauPresence.classList.add('slideActive');
    tableauPresence.classList.remove('slideDesactive');
    programme.classList.add('slideDesactive');
    programme.classList.remove('slideActive');
    listePresenceApprenant.style.borderBottom = "orangered solid 5px";
    programmeModules.style.borderBottom = "transparent solid 5px";
    listePresenceApprenant.style.backgroundColor = "rgba(255, 0, 0, 0.2)";
    programmeModules.style.backgroundColor = "transparent";
    listePresenceApprenant.style.color = "#fff";
});
