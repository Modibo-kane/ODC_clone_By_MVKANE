<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $mdp = $_POST['mdp'] ?? '';
    $fichier = '../db/utilisateur.json';

    // Vérifie si le fichier existe
    if (file_exists($fichier) && filesize($fichier) > 0) {
        $contenu = file_get_contents($fichier);
        $utilisateurs = json_decode($contenu, true);

        $utilisateurTrouve = false;

        // Parcours des utilisateurs pour chercher une correspondance
        foreach ($utilisateurs as $utilisateur) {
            if ($utilisateur['email'] === $email) {
                // Vérification du mot de passe haché
                if ($mdp=== $utilisateur['mot de passe']) {
                    $_SESSION['user'] = $email;
                    // Redirection vers le tableau de bord
                    header("Location: ../view/tableaudebord.php");
                    exit();
                } else {
                    // Mauvais mot de passe
                    header("Location: ../connexion.php?erreur=mot_de_passe_incorrect");
                    exit();
                }
            }
        }

        // Si aucun utilisateur trouvé avec cet email
        header("Location: ../connexion.php?erreur=utilisateur_inexistant");
        exit();
    } else {
        // Fichier inexistant ou vide
        header("Location: ../connexion.php?erreur=aucun_utilisateur");
        exit();
    }
}
?>
