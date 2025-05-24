<div class="contenu-conteneur">
    <div class="enteteReferentiel">
            <p>
               <span>
                 Référentiels
               </span> <br>
                Gerer les référentiels de la promotion 
            </p>

           <div class="sousEnteteReferentiel">
                <input type="text" name="rechercherReferentiel" id="rechercherReferentiel" placeholder="Rechercher un référentiel" class="rechercherReferentiel">
                <button class="tousRef"><i class="fa-solid fa-book"></i>  <a href="../view/tousLesRef.php">Tous les référentiels</a></button>
                <button class="ajouterRefPromo"><i class="fa-solid fa-plus"></i>  Ajouter à la promotion</button>
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
        <?php if(strtolower(trim($referentiel['statut']))=== 'actif'): ?>
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
        <?php endif ?>
    <?php endforeach; ?>
     <div class="vide"></div>
</div>
</div>



<div class="popAjouterRefToPromo">
        <form action="" id="formAddRefToPromo" method="post" class="formAddRefToPromo">
            <div class="formRefToPromoTitre">
                <h3>Ajouter un nouvel Référentiel  </h3>
                <i class="fa-solid fa-xmark mark2"></i>
            </div>
           <div class="champsRefToPromo">
                <label>Libellé Référentiel: <input type="text" id="libelleReferentiel" name="libelleReferentiel" required placeholder="Cloud & CyberSecurity"></label>
                <label>Promotion active: <div class="promotionActive">
                    <div class=" ref refDevMobile">DEV WEB/MOBILE <i class="fa-solid fa-xmark xmark3"  style=" color:rgb(83, 83, 83);"></i></div>
                    <div class=" ref refDig">REF DIG <i class="fa-solid fa-xmark xmark4" style=" color:rgb(83, 83, 83);"></i></div>
                    <div class=" ref refData"> BIG DATA <i class="fa-solid fa-xmark xmark5" style=" color:rgb(83, 83, 83);"></i></div>
                    <div class=" ref refAws">AWS <i class="fa-solid fa-xmark xmark6" style=" color:rgb(83, 83, 83);"></i></div>
                    <div class=" ref refHackeuse">HACKEUSE <i class="fa-solid fa-xmark xmark7" style=" color:rgb(83, 83, 83);"></i></div>
                </div></label>
                <div class="boutonRefToPromo">
                    <button type="button" class="annulerRef">Annuler</button>
                    <button type="submit" class="creerRef">Terminer</button>
                </div>
           </div>
        </form>
</div>


<script>
    let popAjouterRefToPromo = document.querySelector('.popAjouterRefToPromo');
    let ajouterRefPromo = document.querySelector('.ajouterRefPromo');
    let mark2 = document.querySelector('.mark2');
    let annulerRef = document.querySelector('.annulerRef');

    ajouterRefPromo.addEventListener('click', function(){
        popAjouterRefToPromo.style.transform = 'scale(1)';
        popAjouterRefToPromo.style.opacity = '1';
        popAjouterRefToPromo.style.transition = 'all 0.8s ease-in-out';
    });
    mark2.addEventListener('click', function(){
        popAjouterRefToPromo.style.transform = 'scale(0)';
        popAjouterRefToPromo.style.opacity = '0';
        popAjouterRefToPromo.style.transition = 'all 0.8s ease-in-out';
    });

    annulerRef.addEventListener('click', function(){
        popAjouterRefToPromo.style.transform = 'scale(0)';
        popAjouterRefToPromo.style.opacity = '0';
        popAjouterRefToPromo.style.transition = 'all 0.8s ease-in-out';
    });
</script>