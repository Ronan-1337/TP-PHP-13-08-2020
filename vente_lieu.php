<!DOCTYPE html>
<html lang="fr">
	<style>
	table, th, td {
 		border: 1px solid black;
	}
	</style>
	<head>
		<meta charset="utf-8" />
		<title>vente-lieu</title>
	</head>
	<body>
		<!-- Affichez le nom, prénom et la société cliente pour les employés qui ont effectué une vente pour les clients dans un lieu précis qu’on aura spécifié, trié sur le nom de la société -->
		<h1>Selectionnez une ville</h1>
		<form action="vente_lieu.php" method="post">
		<?php
		include_once ('dbparams.php');
		$idcom = new mysqli(MYHOST, MYUSR, MYPWD, MYDB, MYPORT);
  		if (!$idcom) {
    		echo "connexion impossible";
    		exit();
  		}
  		$requete = "SELECT DISTINCT ShipCity FROM orders";
  		$result = $idcom->query($requete);
  		if (!$result)
  			echo "erreur : ".$idcom->error;
  		echo "<select name=\"ville\" size = 5>";
  		while ($row = $result->fetch_row()) {
  			echo "<option>".$row[0]."</option>";
  		}
  		echo "</select>";
		?>
		<input type="submit" name="recherche" value="Rechercher"></form>

		<?php
  		if (!empty($_POST['ville'])) {
  			$requete = "SELECT orders.ShipCity, employees.FirstName, employees.LastName, customers.CompanyName FROM orders
						INNER JOIN customers ON orders.CustomerID = customers.CustomerID
						INNER JOIN employees ON orders.EmployeeID = employees.EmployeeID
						WHERE orders.ShipCity = '".$_POST['ville']."'
						ORDER BY customers.CompanyName";
  			$result = $idcom->query($requete);
  			if (!$result)
  				echo "erreur : ".$idcom->error;
  			echo "<table><tr><td>Nom du vendeur</td><td>Prénom du vendeur</td><td>Société cliente</td></tr>";
  			while ($row = $result->fetch_row())
  				echo "<tr><td>$row[2]</td><td>$row[1]</td><td>$row[3]</td></tr>";
  			echo "</table>";
		}
		$idcom->close();
		?>
	</body>
</html>