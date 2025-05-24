<div class="ajouterApprenantCont">
    
    <i class="fa-solid fa-right-from-bracket fa-xl fa_out"></i>
    <h1>Ajout apprenant</h1>
    <form action="../traitement/ajouterEtudiant.traitement.php" method="POST">
        <div class="informationApprenant">
        <h3>Informations de l'apprenant   <i class="fa-solid fa-pen-to-square"></i></h3>
        <div class="infosApprenantContainer">
             <label>Prénom(s)    <input type="text" name="prenomApprenant" id="prenomApprenant" placeholder="Seydou Mouhammed"></label>
             <label>Nom    <input type="text" name="nomApprenant" id="nomApprenant" placeholder="Diop"></label>
             <label>Date de naissance      <input type="text" name="dateApprenant" id="dateApprenant" placeholder="01/03/2025"></label>
             <label>Lieu de naissance    <input type="text" name="lieuApprenant" id="lieuApprenant" placeholder="Dakar"></label>
             <label>Email    <input type="email" name="emailApprenant" id="EmailApprenant" placeholder="Seydou@gmail.com"></label>
             <label>Adresse    <input type="text" name="adresseApprenant" id="adresseApprenant" placeholder="Sicap Liberté 6 Villa 6059 Dakar Sénégal"></label>
             <label>Téléphone   <input type="text" name="telephoneApprenant" id="TelephoneApprenant" placeholder="+221 77 453 19 36"></label>
             <label>Référentiel   <input type="text" name="referentielApprenant" id="referentielApprenant" placeholder="DEV WEB/MOBILE"></label>
        </div><br>
        <h3>Informations du tuteur  <i class="fa-solid fa-pen-to-square"></i></h3>
        <div class="infosTuteurContainer">
            <label>Prénom(s) & Nom    <input type="text" name="PrenomNomTuteur" id="PrenomApprenant" placeholder="Assane Diop"></label>
            <label>Lien de parenté    <input type="text" name="lienTuteur" id="lienTuteur" placeholder="Père"></label>
             <label>Adresse    <input type="text" name="adresseTuteur" id="adresseTuteur" placeholder="Sicap Liberté 6 Villa 6059 Dakar Sénégal"></label>
             <label>Téléphone   <input type="text" name="telephoneTuteur" id="TelephoneTuteur" placeholder="+221 77 565 19 46"></label>
        </div>
    </div>
        <div class="buttonAjouterApprenant">
            <button class="annulerApprenant" type="button">Annuler</button>
            <button class="enregistrerApprenant" type="submit">Enregistrer</button>
        </div>
    </form>
</div>

<script>

</script>
<div class="contenuConteneurApprenant">
    <div class="enteteApprenant">
        <p>Apprenants</p>
        <span class="nombreApprenant">180 apprenants</span>
    </div>
    <div class="rechercheApprenant">
        <input type="text" name="barreRechercheApprenat" id="barreRechercheApprenat" placeholder="Rechercher...">
        <select name="filtreApprenant" id="filtreApprenant">
            <option value="Filtre par classe">Filtrer par classe</option>
            <option value="DEV WEB/MOBILE">DEV WEB/MOBILE</option>
            <option value="REF DIG">REF DIG</option>
            <option value="DATA">DATA</option>
        </select>
        <select name="filtreApprenantStatut" id="filtreApprenantStatut">
            <option value="tous">Tous</option>
            <option value="actif">Actif</option>
            <option value="remplacer">Remplacer</option>
        </select>
        <button class="telechargerListe">Télécharger la liste  <i class="fa-solid fa-file-arrow-down fa-xl"></i></button>
        <button type="button" class="ajouterApprenant"><i class="fa-solid fa-user-plus fa-xl"></i>Ajouter apprenant</button>
    </div>
    <div class="sousEnteteApprenant">
         <span class="listeApprenant">Liste des retenu</span></a>
        <span class="listeApprenant" >Liste d'attente</span></a>
    </div>
    <?php 
        $fichier='../db/etudiant.json';
        $data= file_exists($fichier) ? json_decode(file_get_contents($fichier), true): [];
    ?>
    <div class="ListeRetenu">
                <?php include '../composant/tableauRetenu.php'?>
    </div>
    <div class="ListeAttente">
                <?php include '../composant/tableauAttente.php'?>
    </div>

   
   
</div>
</div>


<div class="contFichierType">
    <div class="fichierType">
    <p><span class="pdf">PDF</span><i class="fa-solid fa-file-pdf"  color="red"></i></p> <hr>
    <p><span class="exel">Exel</span><i class="fa-solid fa-file" color= green></i></p>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="../public/js/hidden.js"></script>
<script src="../public/js/telechergerLaListe.js"></script>
<script src="../public/js/boutonSortir.js"></script>
<script src="../public/js/pagination2apprenant.js"></script>
<script src="../public/js/pagination3apprenant.js"></script>


