<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $mdp = $_POST['mdp'] ?? '';
    $fichier = '../db/utilisateur.json';

    $nouvelUtilisateur = [
        "nom" => $nom,
        "email" => $email,
        "mot de passe"=> $mdp
    ];

    // On initialise un tableau vide
    $utilisateurs = [];

    // Si le fichier existe et n'est pas vide
    if (file_exists($fichier)) {
        $contenu = file_get_contents($fichier);
        $utilisateurs = json_decode($contenu, true);
    }

    // Vérifie si l'email existe déjà
    $existeDeja = false;
    foreach ($utilisateurs as $utilisateur) {
        if (($utilisateur['email'] === $email)&&($utilisateur['email'] === $email))  {
            
            $existeDeja = true;
            break;
        }
    }

    if (!$existeDeja) {
        // Ajout du nouvel utilisateur
        $utilisateurs[] = $nouvelUtilisateur;

        file_put_contents($fichier, json_encode($utilisateurs, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        $_SESSION['user']=$email;
        // Redirection vers confirmation
        header("Location: ../view/tableaudebord.php");
        exit();
    }else{
        header("Location: ../index.php?erreur=utilisateur_existe");
        exit();
    }
}


?>
