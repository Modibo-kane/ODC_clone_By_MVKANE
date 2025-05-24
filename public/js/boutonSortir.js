let annulerApprenant= document.querySelector('.annulerApprenant');
let enregistrerApprenant= document.querySelector('.enregistrerApprenant');
let sortirApprenant= document.querySelector('.fa_out');
let ajouterApprenantCont= document.querySelector('.ajouterApprenantCont');
let ajouterApprenant= document.querySelector('.ajouterApprenant');
if (annulerApprenant) {
    annulerApprenant.addEventListener('click', function () {
        ajouterApprenantCont.classList.remove('active');
    });
}else{
    console.log('Undefine')
}

if (sortirApprenant) {
    sortirApprenant.addEventListener('click', function () {
        ajouterApprenantCont.classList.remove('active');
    });
}else{
    console.log('Undefine')
}

if (ajouterApprenant) {
    ajouterApprenant.addEventListener('click', function () {
        ajouterApprenantCont.classList.add('active');
    });
}else{
    console.log('Undefine')
}

