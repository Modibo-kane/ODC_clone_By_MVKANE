<div class="contenu-conteneur">
    <div class="enteteReferentiel">
        <a href="../view/referentiels.php"><span class="retour"><i class="fa-solid fa-arrow-left"></i>Retour aux référentiels actifs</span></a>
            <p>
               <span>
                    Tous les Référentiels
               </span> <br>
               Liste complète des référentiel de formation 
            </p>

           <div class="sousEnteteReferentiel">
                <input type="text" name="rechercherReferentiel" id="rechercherReferentiel" placeholder="Rechercher un référentiel" class="rechercherReferentiel">
                <!-- <button class="tousRef"><i class="fa-solid fa-book"></i>  <a href="../view/tousLesRef.php">Tous les référentiels</a></button> -->
                <button class="ajouterRefPromo"><i class="fa-solid fa-plus"></i>Creer un nouveau référentiel</button>
           </div>
    </div>
    <?php 
        $fichier = "../db/referentiel.json";
        $data = [];

        if (file_exists($fichier)) {
            $contenu = file_get_contents($fichier);
            $data = json_decode($contenu, true);
            if (!is_array($data)) {
                $data = []; // Si le JSON est mal formé
            }
        }
    ?>


<div class="cardReferentielContainer" style="flex-wrap:wrap">
    <?php foreach ($data as $referentiel): ?>
        <div class="cardReferentiel">
            <img src="../upload/image/referentiel/<?= htmlspecialchars($referentiel['image']) ?>" alt="Image de <?= htmlspecialchars($referentiel['nom']) ?>">
            <div class="descrptionReferentiel">
                <div class="title"><?= htmlspecialchars($referentiel['nom']) ?></div>
                 <span><?= htmlspecialchars($referentiel['sessions']) ?></span>
                <p style="height: auto;"><?= htmlspecialchars($referentiel['description']) ?></p>
                <hr>
                <div class="cicle-cont">
                    <div class="circleRef"></div>
                    <div class="circleRef"></div>
                    <div class="circleRef"></div>
                    <span>Capacité : <?= htmlspecialchars($referentiel['capacite']) ?> personnes</span>
                </div> 
            </div>
        </div>
    <?php endforeach; ?>
     <div class="vide"></div>
</div>
</div>



<div class="popAjouterRefToPromo">
        <form action="../traitement/ajouterRef.php" id="formAddRefToPromo" method="post" class="formAddRefToPromo" enctype="multipart/form-data">
            <div class="formRefToPromoTitre">
                <h3>Creer un nouvel Référentiel  </h3>
                <i class="fa-solid fa-xmark markTousRef"></i>
            </div>
           <div class="champsRefToPromo">
            <label class="refPhoto" ><input type="file" name="refPhoto" id="refPhoto" hidden> <span class="diaparait">Cliquez pour ajouter une photo</span></label>
                <label>Nom* <input type="text" id="newRefNom" name="newRefNom" required placeholder="nom du référentiel"></label>
                <label>Description: <textarea  class="refDescription" name="refDescription"></textarea></label>
                <div class="capaciteSession">
                    <label>Capacité* <input type="number" name="capacite" id="capacite" placeholder="30"></label>
                    <label>Nombre de session* <select name="capaciteSelect" id="capaciteSelect">
                        <option value=" 1 session">1 session</option>
                        <option value=" 2 session">2 session</option>
                        <option value=" 3 session">3 session</option>
                        <option value=" 4 session">4 session</option>
                        <option value=" 5 session">5 session</option>
                        <option value=" 6 session">6 session</option>
                    </select></label>
                </div>
                <div class="boutonRefToPromo">
                    <button type="button" class="annulerRef">Annuler</button>
                    <button type="submit" class="creerRef">Creer</button>
                </div>
           </div>
        </form>
</div>


<script>
    let popAjouterRefToPromo = document.querySelector('.popAjouterRefToPromo');
    let ajouterRefPromo = document.querySelector('.ajouterRefPromo');
    let markTousRef = document.querySelector('.markTousRef');
    let annulerRef = document.querySelector('.annulerRef');
    let formAddRefToPromo= document.getElementById('formAddRefToPromo');
     const labelImage = document.querySelector('label.refPhoto');

    ajouterRefPromo.addEventListener('click', function(){
        popAjouterRefToPromo.style.transform = 'scale(1)';
        popAjouterRefToPromo.style.opacity = '1';
        popAjouterRefToPromo.style.transition = 'all 0.8s ease-in-out';
    });
    markTousRef.addEventListener('click', function(){
        popAjouterRefToPromo.style.transform = 'scale(0)';
        popAjouterRefToPromo.style.opacity = '0';
        popAjouterRefToPromo.style.transition = 'all 0.8s ease-in-out';
        formAddRefToPromo.reset();
        labelImage.textContent=" ";
    });

    annulerRef.addEventListener('click', function(){
        popAjouterRefToPromo.style.transform = 'scale(0)';
        popAjouterRefToPromo.style.opacity = '0';
        popAjouterRefToPromo.style.transition = 'all 0.8s ease-in-out';
        formAddRefToPromo.reset();
        labelImage.textContent=" ";
    });


    // previous image (-------------------------------------------------------------------------)


    document.addEventListener('DOMContentLoaded', () => {
    const inputImage = document.getElementById('refPhoto');
   

    inputImage.addEventListener('change', (e) => {
        const file = e.target.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(event) {
                // Supprimer les anciennes images dans le label
                const ancienneImage = labelImage.querySelector('img');
                if (ancienneImage) {
                    ancienneImage.remove();
                }

                // Créer une nouvelle balise image
                const imageApercu = document.createElement('img');
                imageApercu.src = event.target.result;
                imageApercu.alt = "Aperçu";
                imageApercu.style.width = "100%";
                imageApercu.style.height = "100%";
                imageApercu.style.objectFit = "cover";
                // imageApercu.style.marginLeft = "10px";
                imageApercu.style.borderRadius = "10px";

                labelImage.appendChild(imageApercu);
                if(imageApercu){
                    let diaparait=document.querySelector('.diaparait');
                    diaparait.style.display='none';
                    // labelImage.innerHTML= imageApercu;
                    labelImage.style.display="flex";
                    labelImage.style.justifyContent="center";
                    labelImage.style.alignItems="center";
                }
            };

            reader.readAsDataURL(file);
        }
    });
});

</script>