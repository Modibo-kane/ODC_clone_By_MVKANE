<?php 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nomEtudiant = htmlspecialchars_decode($_POST["nomApprenant"]);
    $prenomEtudiant = htmlspecialchars_decode($_POST["prenomApprenant"]);
    $dateEtudiant = htmlspecialchars_decode($_POST["dateApprenant"]);
    $lieuNaissance = htmlspecialchars_decode($_POST["lieuApprenant"]);
    $emailEtudiant = htmlspecialchars_decode($_POST["emailApprenant"]);
    $adresseEtudiant = htmlspecialchars_decode($_POST["adresseApprenant"]);
    $telephoneEtudiant = htmlspecialchars_decode($_POST["telephoneApprenant"]);
    $referentielEtudiant=htmlspecialchars_decode($_POST['referentielApprenant']);
    $nomPrenomTuteur = htmlspecialchars_decode($_POST["PrenomNomTuteur"]);
    $lienTuteur = htmlspecialchars_decode($_POST["lienTuteur"]);
    $adresseTuteur = htmlspecialchars_decode($_POST["adresseTuteur"]);
    $telephoneTuteur = htmlspecialchars_decode($_POST["telephoneTuteur"]);


    // pour reconnaitre facilement les données de chaque étudiant dans se fatiguer 
   $shortId = strtoupper(substr(uniqid(), -6));

        $nouvelEtudiant = [
            $shortId => [
                "promotion"=> "",
                "statut"=> "actif",
                "id" => $shortId,
                "nom" => $nomEtudiant,
                "prenom" => $prenomEtudiant,
                "date de naissance" => $dateEtudiant,
                "lieu de naissance" => $lieuNaissance,
                "email" => $emailEtudiant,
                "adresse" => $adresseEtudiant,
                "referentiel" => $referentielEtudiant,
                "numero de telephone" => $telephoneEtudiant,
                "tuteur infos" => [
                    "nom" => $nomPrenomTuteur,
                    "lien de parenté" => $lienTuteur,
                    "adresse du tuteur" => $adresseTuteur,
                    "numero de telephone" => $telephoneTuteur
                ]
            ]
        ];


    $fileEtudiant = '../db/etudiant.json';
    $etudiants = [];

    if (file_exists($fileEtudiant) && filesize($fileEtudiant) > 0) {
        $dataEtudiant = file_get_contents($fileEtudiant);
        $etudiants = json_decode($dataEtudiant, true);
    }

    // Fusion des données
    $etudiants = array_merge($etudiants, $nouvelEtudiant);

    file_put_contents($fileEtudiant, json_encode($etudiants, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

    header('Location: ../view/apprenants.php');
    exit();
}
?>
