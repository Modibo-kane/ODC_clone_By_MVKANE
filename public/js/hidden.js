let ListeRetenu= document.querySelector('.ListeRetenu');
let ListeAttente=document.querySelector('.ListeAttente');
ListeAttente.style.display='none'

let listeApprenant= document.querySelectorAll('.listeApprenant')

listeApprenant[0].addEventListener('click', function(){
    ListeAttente.style.display='none'
    ListeRetenu.style.display='block'
})

listeApprenant[1].addEventListener('click', function(){
    ListeAttente.style.display='block'
    ListeRetenu.style.display='none'
})