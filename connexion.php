<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - Telly Tech</title>
  <link rel="stylesheet" href="css/connexion.css">
</head>
<body>
  <div class="login-card">
    <div class="logo-section">
      <p class="logo-telly">Telly Digital Center</p>
      <p class="logo-blue">Telly Tech</p>
      <p class="academy-name">Bienvenue sur<br><span>Ecole du code Telly Tech Academy</span></p>
    </div>
     <?php
        if (isset($_GET['erreur']) && $_GET['erreur'] === 'mot_de_passe_incorrect') {
            echo "<p style='color: red;'>Mot de passe incorrect.</p>";
        };
        if (isset($_GET['erreur']) && $_GET['erreur'] === 'utilisateur_inexistant') {
            echo "<p style='color: red;'>utilisateur_inexistant.</p>";
        }
      ?>
    <form action="traitement/login.Traitement.php" method="post">
      <h3>Se connecter</h3>

      <label for="email">Login <br> <input type="email" name="email" id="email" placeholder="Matricule ou email" required></label>
      

      <label for="password">Mot de passe <br> <input type="password" name="mdp" id="password" placeholder="Mot de passe" required> </label>
     

      <div class="forgot-password">
        <a href="#" class="lien">Mot de passe oublié ?</a>
        <a href="index.php" class="lien">Pas de compte ?</a>
      </div>

      <button type="submit" value="Se connecter" class="submit-btn">Se connecter</button>
    </form>
  </div>
</body>
</html>


<?php 




?>