<!DOCTYPE html>
<html lang="fr">
	<style>
	table, th, td {
 		border: 1px solid black;
	}
	</style>
	<head>
		<meta charset="utf-8" />
		<title>société-produit</title>
	</head>
	<body>
		<!-- Affichez les sociétés clients qui ont commandé un produit précis qu’on aura spécifié, trié sur le nom de la société -->
		<h1>Selectionnez un produit par son numéro d'identification</h1>
		<form action="societe_produit.php" method="post">
		<label>Numéro id : </label><input type="text" name="id">
		<input type="submit" name="sub" value="Rechercher"></form>
		<?php
		include_once ('dbparams.php');
		$idcom = new mysqli(MYHOST, MYUSR, MYPWD, MYDB, MYPORT);
  		if (!$idcom) {
    		echo "connexion impossible";
    		exit();
  		}
  		if (!empty($_POST['id'])) {
  			$requete = "SELECT products.ProductName, customers.CompanyName FROM orders
						INNER JOIN customers ON orders.CustomerID = customers.CustomerID
						INNER JOIN orderdetails ON orders.OrderID = orderdetails.OrderID
						INNER JOIN products ON orderdetails.ProductID = products.ProductID
						WHERE products.ProductID = ".$_POST['id']."
						ORDER BY customers.CompanyName";
  			$result = $idcom->query($requete);
  			if (!$result)
  				echo "erreur : ".$idcom->error;
  			echo "<table><tr><td>Produit</td><td>Client</td></tr>";
  			while ($row = $result->fetch_row()) {
  				echo "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
  			}
  			echo "</table>";
		}
		$idcom->close();
		?>
	</body>
</html>