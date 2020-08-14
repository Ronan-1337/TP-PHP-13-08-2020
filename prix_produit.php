<!DOCTYPE html>
<html lang="fr">
	<style>
	#pala {
		display:none;
	}
	table, th, td {
 		border: 1px solid black;
	}
	</style>
	<head>
		<meta charset="utf-8" />
		<title>Prix produits</title>
	</head>
	<body>
		<!-- Pouvoir modifier facilement les prix des produits -->
		<!--<?php
		include_once ('dbparams.php');
		$idcom = new mysqli(MYHOST, MYUSR, MYPWD, MYDB, MYPORT);
  		if (!$idcom) {
    		echo "connexion impossible";
    		exit();
  		}
  		$requete = "SELECT products.ProductID, products.ProductName, products.UnitPrice FROM products";
  		$result = $idcom->query($requete);
  		if (!$result)
  			echo "erreur : ".$idcom->error;
		echo "<form action=\"prix_produit.php\" method=\"post\"><table><tr><td>PRODUIT</td><td>PRIX</td></tr>";
		$i = 0;
		while($row = $result->fetch_row()){
			echo "<tr><td><label>$row[1] </label></td><td><input type=\"text\" name=\"$i\" value=\"$row[2]\"></td></tr>";
			$i++;
		}
		echo "<tr><td><input type=\"submit\" name=\"modifier\" value=\"Modifier\"></td></tr></table></form>";
		if (!empty($_POST)) {
			echo "BONJOUR";
  			$result = $idcom->query($requete);
			if (!$result)
  				echo "erreur : ".$idcom->error;
  			$i++;
  			$j = 0;
			while($row = $result->fetch_row() && $j != $i){
				if ($row[2] != $_POST["$j"]) {
					$result2 = $idcom->query("INSERT INTO products(UnitPrice) VALUES(".$_POST[$j].")");
					if (!$result2)
  						echo "erreur : ".$idcom->error;
				}
				$j++;
			}
		}	
  		$idcom->close();
		?>-->

		<h1>entrez l'identifiant du produit dont vous voulez changer le prix</h1>
		<form action="prix_produit.php" method="post"><label>Identifiant :</label><input type="text" name="id"><input type="submit" name="chercher" value="Rechercher"></form>
		<?php
		include_once ('dbparams.php');
		$idcom = new mysqli(MYHOST, MYUSR, MYPWD, MYDB, MYPORT);
  		if (!$idcom) {
    		echo "connexion impossible";
    		exit();
  		}
  		if (!empty($_POST['id'])) {
  			$requete = "SELECT products.ProductID, products.ProductName, products.UnitPrice FROM products WHERE products.ProductID = ".$_POST['id'];
  			$result = $idcom->query($requete);
  			if (!$result)
  				echo "erreur : ".$idcom->error;
  			$row = $result->fetch_row();
  			echo "<h1>Modifier le prix du produit</h1><form action=\"prix_produit.php\" method=\"post\"><input type=\"text\" name=\"idd\" value=\"$row[0]\" id=\"pala\"><label>Produit : $row[1] </label><br><label>Prix : </label><input type=\"text\" name=\"prix\" value=\"$row[2]\"><input type=\"submit\" name=\"modifier\" value=\"Modifier\"></form>";
  		}
  		if (!empty($_POST['prix'])) {
  			$requete = "UPDATE products SET UnitPrice = ".$_POST['prix']." WHERE ProductID = ".$_POST['idd'];
  			$result2 = $idcom->query($requete);
  			if (!$result2)
  				echo "erreur : ".$idcom->error;
  		}
  		$idcom->close();
		?>
	</body>
</html>