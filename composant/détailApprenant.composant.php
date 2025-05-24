<?php 
if (!isset($_GET['id'])) {
    die('id manquant');
} else {
    $idRecuperer = $_GET['id'];
    $fileEtudiant = "../db/etudiant.json";

    if (!file_exists($fileEtudiant) || filesize($fileEtudiant) === 0) {
        die('aucun fichier trouvé');
    } else {
        $dataEtudiant = file_get_contents($fileEtudiant);
        $etudiants = json_decode($dataEtudiant, true); // CORRIGÉ ICI

        $etudiantTrouver = null;

        foreach ($etudiants as $etudiant) {
            if ($etudiant["id"] === $idRecuperer) {
                $etudiantTrouver = $etudiant;
                break;
            }
        }

        if (!$etudiantTrouver) {
            die('aucun etudiant trouvé');
        }

        // Ici tu peux continuer à afficher les détails
    }
}

?>

<div class="detailApprenantContainerPrincipal">
  <div class="enteteDeatilApprenant">
    <p>
        <span>Apprenants</span> / Détails
    </p>
  </div>
  <div class="corpsDetailApprenant">
        <div class="detailApprenantGaucheCont">
            <div class="retourListe"><a href="../view/apprenants.php"><i class="fa-solid fa-arrow-left fa-retour"></i><span>Retour sur la liste</span></a></div>
            <div class="profildetailApprenant">
                <div class="profilImagecont"><img src="../image/ia.jpeg" alt="image"></div>
                <h3><?= htmlspecialchars($etudiantTrouver['prenom'] . ' ' . $etudiantTrouver['nom']) ?></h3>
                <div class="detailApprenantRef">
                    <?= htmlspecialchars($etudiantTrouver['referentiel']) ?>
                </div>
                <div class="detailApprenantActive">
                    <span>
                        <button class="<?= ($etudiantTrouver['statut'] === 'actif') ? 'statutActif' : 'statutInactif' ?>">
                            <?= ucfirst($etudiantTrouver['statut']) ?>
                        </button>
                    </span>
                </div>

                <div class="detailApprenantInfos">
                    <label><i class="fa-solid fa-phone"></i><span>Tel</span> <span> <?= htmlspecialchars($etudiantTrouver['numero de telephone']) ?></span></label>
                    <label><i class="fa-solid fa-envelope"></i><span>Email</span> <span> <?= htmlspecialchars($etudiantTrouver['email']) ?> </span></label>
                    <label><i class="fa-solid fa-location-dot"></i><span>Addresse</span> <span>  <?= htmlspecialchars($etudiantTrouver['adresse']) ?></span></label>
                </div>
            </div>
        </div>
        <div class="detailApprenantDroiteCont">
            <div class="detailApprenantCardCont">
                <div class="detailApprenantCard">
                    <div class="detailApprenantPresence"><i class=" fa-solid fa-check-double"></i></div>
                    <P class="vert">20 <br> Présence(s) </P>
                </div>
                <div class="detailApprenantCard">
                    <div class="detailApprenantRetard"><i class="fa-solid fa-bell"></i></div>
                    <P class="orange">5 <br> Retard(s) </P>
                </div>
                <div class="detailApprenantCard">
                    <div class="detailApprenantAbsence"> <i class="fa-solid fa-triangle-exclamation"></i></div>
                    <P class="rouge"> 1 <br> Absence(s) </P>
                </div>
            </div>
            <div class="detailApprenantSousEntete">
                <div class="programmeModules"> Programmes & Modules </div>
                <div class="ListePresenceApprenant"> Liste de présence des apprenants</div>
            </div>

                <div class="ListePresenceApprenantContTableau">
                <table id="ListeAttenteTableauDetail">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Matricule</th>
                            <th>Nom Complet</th>
                            <th>Date et heure</th>
                            <th>Justification</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php 
                        $fichier='../db/etudiant.json';
                        $data= file_exists($fichier) ? json_decode(file_get_contents($fichier), true): [];
                    ?>
                    <tbody id="corpsTableau">
                        <?php foreach($data as $etudiants):?>
                            <tr>
                                <td><img src="" alt="imag" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;"></td>
                                <td><span><?= htmlspecialchars($etudiants["id"]) ?></span></td>
                                <td><span><?= htmlspecialchars($etudiants["prenom"]." ".$etudiants['nom']) ?></span></td>
                                <td><span><?= htmlspecialchars($etudiants["adresse"]) ?></span></td>
                                <td><span class="<?= ($etudiants['statut'] === 'actif') ? 'statutActif' : 'statutInactif' ?>" >Justifié</span></td>
                                <td>
                                    <span>
                                        <a class="<?= ($etudiants['statut'] === 'actif') ? 'statutActif' : 'statutInactif' ?>" 
                                        href="../traitement/changer_statut.php?id=<?= urlencode($etudiants['id']) ?>&statut=<?= ($etudiants['statut'] === 'actif') ? 'Remplacer' : 'actif' ?>">
                                            <?= ucfirst($etudiants['statut']) ?>
                                        </a>
                                    </span>
                                </td>
                                <td><p class="moreDetail"><a href="../view/detailsApprenant.php?id=<?= urlencode($etudiants['id']) ?>"><i class="fa-solid fa-ellipsis"></i></a></p></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                    <div class="sousTableauApprenantDetail">
                        <div id="pagination"></div>
                    </div>
                </div>
                <div class="programme">
                    <div class="programmeCard">
                        <div class="dure">
                            <button><i class="fa-solid fa-clock"></i>30 jours</button>
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                        <div class="programmeTitre">
                            Algorithme & Langage C
                        </div>
                        <div class="programmeDescription">
                            Compléxité algorithmique & pratique codage en langage C
                        </div>
                        <div class="debutant">
                            <button>Débutant</button>
                        </div>

                        <div class="temps">
                            <div class="date">
                                <div class="calendar">
                                    <i class="fa-solid fa-calendar"></i>
                                </div>
                                <span>23 Mars 2024</span>
                            </div>
                            <div class="heure">
                               <div class="bell">
                                 <i class="fa-solid fa-bell"></i>
                               </div>
                                <span>12:45 pm</span>
                            </div>
                        </div>
                    </div>
                     <div class="programmeCard">
                        <div class="dure">
                            <button><i class="fa-solid fa-clock"></i>15 jours</button>
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                        <div class="programmeTitre">
                            Frontend 1: Html, Css & JS
                        </div>
                        <div class="programmeDescription">
                           Creation d'interfaces de dsign avec animations avancées !
                        </div>
                        <div class="debutant">
                            <button>Débutant</button>
                        </div>

                        <div class="temps">
                            <div class="date">
                                <div class="calendar">
                                    <i class="fa-solid fa-calendar"></i>
                                </div>
                                <span>23 Mars 2024</span>
                            </div>
                            <div class="heure">
                               <div class="bell">
                                 <i class="fa-solid fa-bell"></i>
                               </div>
                                <span>12:45 pm</span>
                            </div>
                        </div>
                    </div>
                     <div class="programmeCard">
                        <div class="dure">
                            <button><i class="fa-solid fa-clock"></i>20 jours</button>
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                        <div class="programmeTitre">
                            Backend 1: PhpPhp avancées & POO
                        </div>
                        <div class="programmeDescription">
                            Compléxité algorithmique & pratique codage en langage C
                        </div>
                        <div class="debutant">
                            <button>Débutant</button>
                        </div>

                        <div class="temps">
                            <div class="date">
                                <div class="calendar">
                                    <i class="fa-solid fa-calendar"></i>
                                </div>
                                <span>23 Mars 2024</span>
                            </div>
                            <div class="heure">
                               <div class="bell">
                                 <i class="fa-solid fa-bell"></i>
                               </div>
                                <span>12:45 pm</span>
                            </div>
                        </div>
                    </div>
                     <div class="programmeCard">
                        <div class="dure">
                            <button><i class="fa-solid fa-clock"></i>15 jours</button>
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                        <div class="programmeTitre">
                            Frontend 2: JS & TS + Tailwind
                        </div>
                        <div class="programmeDescription">
                            Compléxité algorithmique & pratique codage en langage C
                        </div>
                        <div class="debutant">
                            <button>Débutant</button>
                        </div>

                        <div class="temps">
                            <div class="date">
                                <div class="calendar">
                                    <i class="fa-solid fa-calendar"></i>
                                </div>
                                <span>23 Mars 2024</span>
                            </div>
                            <div class="heure">
                               <div class="bell">
                                 <i class="fa-solid fa-bell"></i>
                               </div>
                                <span>12:45 pm</span>
                            </div>
                        </div>
                    </div>
                     <div class="programmeCard">
                        <div class="dure">
                            <button><i class="fa-solid fa-clock"></i>30 jours</button>
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                        <div class="programmeTitre">
                            Backend 2: Laravel & SOLID
                        </div>
                        <div class="programmeDescription">
                            Compléxité algorithmique & pratique codage en langage C
                        </div>
                        <div class="debutant">
                            <button>Débutant</button>
                        </div>

                        <div class="temps">
                            <div class="date">
                                <div class="calendar">
                                    <i class="fa-solid fa-calendar"></i>
                                </div>
                                <span>23 Mars 2024</span>
                            </div>
                            <div class="heure">
                               <div class="bell">
                                 <i class="fa-solid fa-bell"></i>
                               </div>
                                <span>12:45 pm</span>
                            </div>
                        </div>
                    </div>
                     <div class="programmeCard">
                        <div class="dure">
                            <button><i class="fa-solid fa-clock"></i>15 jours</button>
                            <i class="fa-solid fa-ellipsis"></i>
                        </div>
                        <div class="programmeTitre">
                            Frontend 3: React Js
                        </div>
                        <div class="programmeDescription">
                            Compléxité algorithmique & pratique codage en langage C
                        </div>
                        <div class="debutant">
                            <button>Débutant</button>
                        </div>

                        <div class="temps">
                            <div class="date">
                                <div class="calendar">
                                    <i class="fa-solid fa-calendar"></i>
                                </div>
                                <span>23 Mars 2024</span>
                            </div>
                            <div class="heure">
                               <div class="bell">
                                 <i class="fa-solid fa-bell"></i>
                               </div>
                                <span>12:45 pm</span>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <!-- <div class="vide"></div> -->
</div>

<script src="../public/js/slideProgrammeliste.js"></script>
<script src="../public/js/pagination.js"></script>
