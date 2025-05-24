<div class="contenuPromo2">
        <div class="barreRecherche">
            <input type="text" placeholder="Rechercher une promotion" class="barreRechercheInput">
            <select name="categorie" class="categorie">
                <option value="Tous">Toutes</option>
                <option value="categorie1">Catégorie 1</option>
                <option value="categorie2">Catégorie 2</option>
                <option value="categorie3">Catégorie 3</option>
            </select>
            <div class="affichage">
                <div class="grille"><a href="../view/promotion.php">Grille</a></div>
                <div class="liste"><a href="../view/promotionLste.php">Liste</a></div>
            </div>
        </div>
    <table>
        <thead>
            <tr>
                <th>Promotion</th>
                <th>Photo</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Référentiel</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php
            $jsonFile = '../db/addpromotion.json';
            $data = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
        ?>
        <tbody>
            <?php foreach($data as $utilisateur): ?>
                <tr>
                    <td><?= htmlspecialchars($utilisateur['nom']) ?></td>
                    <td><img src="../upload/image/<?= htmlspecialchars($utilisateur['image']) ?>" alt="Image" style="height: 30px; width: 30px; border-raduis:30px; object-fit:cover;" ></td>
                    <td><?= htmlspecialchars($utilisateur['date de debut']) ?></td>
                    <td><?= htmlspecialchars($utilisateur["date de fin"]) ?></td>
                    <td> <span class="tag"><?= htmlspecialchars($utilisateur['referentiel']) ?></span> </td>
                    <td>
                        <a class="<?=$utilisateur['statut'] === 'actif' ? 'statutActif' : 'statutInactif'?>" href="#">
                           <?= $utilisateur['statut'] ?>
                        </a>
                    </td>
                    <td> 
                        <button class="btn-more"><div class="circleA"></div><div class="circleB"></div><div class="circleC"></div></button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        
    </table>
    <!-- <br> -->
   <div class="sousTableau">
    <div class="pages">Pages
       <select>
           <option value=""> 5</option>
       </select>
    </div>
    <div class="middle">
        1-5 sur 8
    </div>
     <div class="pagination">
        <button class="page-btn">&lt;</button>
        <button class="page-btn active">1</button>
        <button class="page-btn">2</button>
        <button class="page-btn">3</button>
        <button class="page-btn">&gt;</button>
    </div>
   </div>

</div>