<?php 
  session_start();
  include "config.inc.php";
  try {
    // Établissement de la connexion à la base de données
    $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8',DB_USER,DB_PASSWORD);

    // Configuration des options de PDO
    $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    // Gestion des exceptions PDO
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
  }

  if (isset($_SESSION['user_id'])) {
    header('Location: admin/index.php');
    exit();
  }



  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données soumises
    $username = htmlspecialchars($_POST['username']);
    $motdepasse = htmlspecialchars($_POST['pass']);
    
    // Requête pour vérifier si les données soumises sont valides
    $requete = $bdd->prepare("SELECT * FROM credential_admin WHERE username = :username AND password = :password");
    $requete->execute(array('username' => $username, 'password' => $motdepasse));
    
    // Vérification des résultats de la requête
    if ($requete->rowCount() > 0) {
      // Les données soumises sont valides
      $_SESSION['user_id'] = $requete->fetch()['id'];
      header("Location: admin/index.php");
      exit();
    } else {
      // Les données soumises sont invalides
      echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    }
  } 
  ?>
<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Connexion</title>
		<link rel="stylesheet" href="styles/php.css" />
	</head>
	<body>
		<div class="container">
			<form method="POST">
				<h3>Se connecter :</h3>
					<div class="inputbox">
						<input type="text" required="required" name="username" />
						<span>Nom d'utilisateur</span>
						<i></i>
					</div>
					<div class="inputbox">
						<input type="password" required="required" name="pass" />
						<span>Mot de passe</span>
						<i></i>
					</div>
					<input type="submit" value="Se connecter" />
						<div class="box-message">
					</div>
				</form>
			</div>
	</body>
</html>