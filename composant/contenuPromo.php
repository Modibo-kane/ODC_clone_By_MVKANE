
    <div class="contenuPromoContainer">
        <div class="entete">
            <p>
               <span>
                 Promotion
               </span> <br>
                Gerer les promotions de l'école
            </p>

            <button class="ajouterPromo"><i class="fa-solid fa-plus"></i>  Ajouter une promotion</button>
        </div>
        <div class="barreRecherche">
            <input type="text" placeholder="Rechercher une promotion" class="barreRechercheInput">
            <select id="filtrePromo">
                <option value="toutes">Toutes les promotions</option>
                <option value="Dev Web">Actif</option>
                <option value="Data">inactif</option>
            </select>
            <div class="affichage">
                <div class="grille"><a href="../view/promotion.php">Grille</a></div>
                <div class="liste"><a href="../view/promotionLste.php">Liste</a></div>
            </div>
        </div>
        <?php
            $jsonFile = '../db/addpromotion.json';
            $data = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
        ?>
        <div class="contenuPromo">
             <?php foreach($data as $promo): ?>
                <div class="cardPromo" style="height: auto" data-nom="<?= htmlspecialchars($promo["nom"]) ?>">
                    <div class="power">
                        <button name="AjouterPromoInactif" class="AjouterPromoInactif" style="display: none;">Inactive</button>
                        <div class="off"><i class="fa-solid fa-power-off"></i></div>
                    </div>
                    <div class="promoInfos">
                        <img src="../upload/image/<?= htmlspecialchars($promo["image"]) ?>" alt="image" class="promoImage" width="65" height="65" object-fit="cover" style="border-radius: 50%;">
                        <p>
                            <span class="spanPromotion"><?= htmlspecialchars($promo["nom"]) ?></span> <br>
                            <span class="calendar"><i class="fa-solid fa-calendar-days"></i>
                                <?= htmlspecialchars($promo["date de debut"]. " / ". $promo['date de fin']) ?>
                            </span>
                        </p>
                    </div>
                    <div class="nbreApprenantPromo">
                        <span>
                            <?php 
                                if (!empty($promo["nombre d'etudiant"])) {
                                    echo htmlspecialchars_decode($promo["nombre d'etudiant"]) . " Apprenant(s)";
                                } else {
                                    echo "0 Apprenant";
                                }
                            ?>
                        </span>

                    </div>
                    
                    <hr>
                    
                    <div class="details">
                        <button>
                            Voir détails <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
             <?php endforeach; ?>
             <br><br>
        <div style="color:transparent">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, sit. Quis quia laboriosam nemo praesentium doloremque quod facilis ullam inventore itaque, quasi voluptates, reiciendis ducimus. Aliquam fugiat voluptatibus voluptates beatae!
        </div>
        </div>
        
    </div>
    

    <div class="popAjouterPromo">
        <form action="../traitement/AjouterPromo.traitement.php" id="formAddPromo" method="POST" enctype="multipart/form-data">
            <i class="fa-solid fa-xmark"></i>
             <div class="formAddPromoTitre">
                <h3>Creer une nouvelle Promotion</h3>
               <span>Remplissez les informations si dessous pour ajouter une promotion.</span>
            </div>
           <div class="champs">
                <label>Nom de la promotion: <input type="text" id="promotionName" name="promotionName" required></label>
               <div class="dates">
                 <label>Date de début: <input type="date" id="promotionDateStart" name="promotionDateStart" required></label>
                <label>Date de fin: <input type="date" id="promotionDateEnd" name="promotionDateEnd" required></label>
               </div>
               <span>Photo de la promotion</span>
                <div class="image">
                    <label class="promotionPhoto"><span>Ajouter</span> ou glisser <input type="file" id="promotionPhoto" name="promotionPhoto" required hidden></label>
                    <?php 
                        if (isset($_GET['erreur'])) {
                            switch ($_GET['erreur']) {
                                case 'image_trop_grande':
                                    echo "<span style='color: red;'>L'image dépasse la taille autorisée de 2 Mo.</span>";
                                    break;
                                case 'fichier_non_image':
                                    echo "<span style='color: red;'>Le fichier doit être une image (PNG, JPG, etc.).</span>";
                                    break;
                                case 'upload_invalide':
                                    echo "<span style='color: red;'>Erreur lors du téléchargement de l'image.</span>";
                                    break;
                            }
                        } else {
                            echo '<span id="alertMessage" style="font-size: 0.9em;">Format PNG, JPG, Taille max 2MB</span>';
                        }
                    ?>
                </div>
                <label>Référentiel: <input type="text" id="promotionDescription" name="promotionDescription" required placeholder="Rechercher..."></label>
                <div class="bouton">
                    <button type="button" class="annuler">Annuler</button>
                    <button type="submit" class="creer">Créer la promotion</button>
                </div>
           </div>
        </form>
    </div>

    <script>
        let annuler= document.querySelector('.annuler');
        let popAjouterPromo = document.querySelector('.popAjouterPromo');
        let fermer = document.querySelector('.fa-xmark');
        let ajouterPromo = document.querySelector('.ajouterPromo');
        let form= document.getElementById('formAddPromo')
        
        

        fermer.addEventListener('click', () => {
            popAjouterPromo.style.opacity = 0;
            popAjouterPromo.style.transform = 'scale(0)';
            setTimeout(() => {
                popAjouterPromo.style.display = 'none';
            }, 500);
        });
        ajouterPromo.addEventListener('click', () => {
              popAjouterPromo.style.zIndex = 1000;
            popAjouterPromo.style.opacity = 1;
            popAjouterPromo.style.transform = 'scale(1)';
            popAjouterPromo.style.display = 'flex';
        });

       

     document.getElementById("promotionPhoto").addEventListener("change", function (e) {
    const file = e.target.files[0];
    const alertMessage = document.getElementById('alertMessage'); 
    if (!file) {
        alertMessage.textContent = "Aucun fichier sélectionné.";
        alertMessage.style.color = 'red';
        return;
    }

    // Vérifie si ce n'est pas une image
    if (!file.type.startsWith("image/")) {
        alertMessage.textContent = "Le fichier doit être une image (jpg, png, etc.)";
        alertMessage.style.color = 'red';
        e.target.value = ""; // Efface le fichier sélectionné
        return;
    }

    // Vérifie la taille
    if (file.size > 2 * 1024 * 1024) {
        alertMessage.textContent = "L'image ne doit pas dépasser 2 Mo.";
        alertMessage.style.color = 'red';
        e.target.value = ""; // Efface le fichier sélectionné
        return;
    }

    // Si tout est bon
    alertMessage.textContent = "Image chargée ✅";
    alertMessage.style.color = "green";
    alertMessage.style.fontSize = "21px";
    document.getElementById("promotionPhoto").style.backgroundColor= "rgba(0,0,0,0.3)";
});


let fileInput = document.getElementById("promotionPhoto");

annuler.addEventListener('click', () => {
    popAjouterPromo.style.opacity = 0;
    popAjouterPromo.style.transform = 'scale(0)';
    
    form.reset(); // reset les champs texte, date, etc.

    // Cloner le champ file pour le réinitialiser complètement
    // let newInput = fileInput.cloneNode(true);
    if (fileInput && fileInput.parentNode) {
        let newInput = fileInput.cloneNode(true);
        fileInput.parentNode.replaceChild(newInput, fileInput);
        alertMessage.textContent = "Format PNG, JPG, Taille max 2MB";
        alertMessage.style.color = "#d4d4d4";
        alertMessage.style.fontSize = "0.9rem";
    }

    setTimeout(() => {
        popAjouterPromo.style.display = 'none';
    }, 500);
});


//filtrage des promo :
const select = document.getElementById("filtrePromo");
  const cartes = document.querySelectorAll(".cardPromo");

  select.addEventListener("change", function () {
    const filtre = this.value.toLowerCase();

    cartes.forEach(carte => {
      const nomPromo = carte.getAttribute("data-nom").toLowerCase();

      if (filtre === "toutes" || nomPromo.includes(filtre)) {
        carte.style.display = "block";
      } else if( filtre=== active){

      } 
      else {
        carte.style.display = "none";
      }
    });
  });
   let fichierJson= fetch('../db/addpromotion.json')
   console.log(fichierJson);

  let changeStatut=document.querySelector('.off');
  changeStatut.addEventListener('click', function(){
  

  })

</script>