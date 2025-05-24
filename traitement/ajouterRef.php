<?php
$uploadDir = '../upload/image/referentiel';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Charger les anciens référentiels
$dataFile = '../db/referentiel.json';
$referentiels = [];

if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $referentiels = json_decode($json, true);
}

// Sécurité : Nettoyer les données
$nom = isset($_POST['newRefNom']) ? trim($_POST['newRefNom']) : '';
$description = isset($_POST['refDescription']) ? trim($_POST['refDescription']) : '';
$capacite = isset($_POST['capacite']) ? (int)$_POST['capacite'] : 0;
$sessions = isset($_POST['capaciteSelect']) ? trim($_POST['capaciteSelect']) : '';

// Vérifie les champs obligatoires
if (empty($nom) || $capacite <= 0 || empty($sessions)) {
    header('location: ../view/referentiels.php?erreur : champs obligatoires manquants');
    exit;
}

// Traitement de l'image si présente
$photoNom = '';
if (isset($_FILES['refPhoto']) && $_FILES['refPhoto']['error'] === UPLOAD_ERR_OK) {
    $photoTmp = $_FILES['refPhoto']['tmp_name'];
    $photoNom = uniqid() . '_' . $_FILES['refPhoto']['name'];
    $photoDest = $uploadDir . '/' . $photoNom;

    if (!move_uploaded_file($photoTmp, $photoDest)) {
        echo "Erreur lors de l'enregistrement de l'image.";
        exit;
    }
}

// Création d’un nouvel identifiant (auto-incrémenté)
$id = "Ref".count($referentiels) + 1;

// Création du nouvel objet référentiel
$nouveauReferentiel = [
    'statut'=> 'actif',
    'id' => $id,
    'nom' => $nom,
    'description' => $description,
    'capacite' => $capacite,
    'sessions' => $sessions,
    'image' => $photoNom
];

// Ajout au tableau
$referentiels[] = $nouveauReferentiel;

// Sauvegarde dans le fichier JSON
file_put_contents($dataFile, json_encode($referentiels, JSON_PRETTY_PRINT));

// Redirection ou retour
header('Location: ../view/referentiels.php?success=1');
exit;
?>
