<!DOCTYPE html>
<html lang="fr">
	<style>
	table, th, td {
 		border: 1px solid black;
	}
	</style>
	<head>
		<meta charset="utf-8" />
		<title>commandes-temps</title>
	</head>
	<body>
		<!-- Afficher les commandes et les produits commandés dans un interval de temps qu’on aura à choisir -->
		<h1>Selectionner un interval de temps pour lequel afficher les commandes</h1>
		<form action="commande_temps.php" method="post">
			<label>date de début :</label><input type="date" name="debut"><br>
			<label>date de fin :</label><input type="date" name="fin"><br>
			<input type="submit" name="recherche" value="Rechercher">
		</form>
		<?php
		if (!empty($_POST['debut']) && !empty($_POST['fin'])) {
			include_once ('dbparams.php');
			$idcom = new mysqli(MYHOST, MYUSR, MYPWD, MYDB, MYPORT);
  			if (!$idcom) {
    			echo "connexion impossible";
    			exit();
  			}
  			$requete = "";
  			$idcom->close();
  		}
		?>
	</body>
</html>