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
        if (isset($_GET['erreur']) && $_GET['erreur'] === 'utilisateur_existe') {
            echo "<p style='color: red;'>Cet utilisateur existe déjà.</p>";
        }
      ?>
    <form action="traitement/signUp.Traitement.php" method="post" id="formulaireConnexion">
      <h3>Creer un compte</h3>
      <label for="email">Prenom et Nom <br> <input type="text" name="nom" id="nom" placeholder="Nom complet" required></label>
       
      <label for="email">Login <br> <input type="email" name="email" id="email" placeholder="Matricule ou email" required></label>
      <label for="password">Mot de passe <br> <input type="password" name="mdp" id="password" placeholder="Mot de passe" required> </label>
      <div class="forgot-password">
        <a href="connexion.php">Vous avez déja un compte ?</a>
      </div>
      <a href="view/tableaudebord.php"><input type="submit" value="Se connecter" class="submit-btn"></a>
    </form>
  </div>
</body>
</html>

<!-- <script>
  let form= document.getElementById('formulaireConnexion').addEventListener('submit', function(){
    form.reset();
  })
</script> -->











