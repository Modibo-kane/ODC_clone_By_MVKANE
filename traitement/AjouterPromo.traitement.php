<?php
$uploadDir = '../upload/image/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $nom = $_POST['promotionName'] ?? '';
    $datedebut = $_POST['promotionDateStart'] ?? '';
    $datefin = $_POST['promotionDateEnd'] ?? '';
    $referentiel = $_POST['promotionDescription'] ?? '';
    $imageName = "";

    // Vérification de l'image
    if (isset($_FILES['promotionPhoto']) && $_FILES['promotionPhoto']['error'] === 0) {
        $tmpName = $_FILES['promotionPhoto']['tmp_name'];
        $fileSize = $_FILES['promotionPhoto']['size'];
        $fileExt = pathinfo($_FILES['promotionPhoto']['name'], PATHINFO_EXTENSION);

        // Vérifier que c'est bien une image
        $imageInfo = getimagesize($tmpName);
        if ($imageInfo === false) {
            header("Location: ../view/promotion.php?erreur=fichier_non_image");
            exit;
        }

        // Vérifier que la taille est inférieure ou égale à 2 Mo
        if ($fileSize > 2 * 1024 * 1024) {
            header("Location: ../view/promotion.php?erreur=image_trop_grande");
            exit;
        }

        // Génération du nom d'image et déplacement
        $imageName = time() . "." . $fileExt;
        move_uploaded_file($tmpName, $uploadDir . $imageName);
    } else {
        header("Location: ../view/promotion.php?erreur=upload_invalide");
        exit;
    }

    // Sauvegarde dans le JSON
    $jsonFile = '../db/addpromotion.json';
    $data = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
    $fichierJson_etudiant= '../db/etudiant.json';
    if(file_exists($fichierJson_etudiant)){
        $dataEtudiant= file_get_contents($fichierJson_etudiant);
        $tableauEtudiants= json_decode($dataEtudiant,true,);
        $i=0;
        foreach($tableauEtudiants as $etudiant){
            if (isset($etudiant["promotion"]) && 
            strtolower(trim($etudiant["promotion"])) === strtolower(trim($nom))) {
            $i++;
        }
        }
    }
    $data[] = [
        "nom" => $nom,
        "date de debut" => $datedebut,
        "date de fin" => $datefin,
        "referentiel" => $referentiel,
        "image" => $imageName,
        "nombre d'etudiant"=> $i
    ];

    file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT));

    header("Location: ../view/promotion.php");
    exit;
}
?>
