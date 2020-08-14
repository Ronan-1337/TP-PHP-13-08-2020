<!DOCTYPE html>
<html lang="fr">
	<style>
	table, th, td {
 		border: 1px solid black;
	}
	</style>
	<head>
		<meta charset="utf-8" />
		<title>employé - commandes</title>
	</head>
	<body>
		<!-- visualiser quel employé a passé quelles commandes et à quels clients -->
		<?php
		include_once ('dbparams.php');
		$idcom = new mysqli(MYHOST, MYUSR, MYPWD, MYDB, MYPORT);
  		if (!$idcom) {
    		echo "connexion impossible";
    		exit();
  		}
  		$requete = "SELECT orders.EmployeeID , orders.OrderID , orders.customerID FROM orders";
  		$result = $idcom->query($requete);
  		if (!$result) {
  			echo "erreur : ".$idcom->error;
      	}
      	$idcom->close();
  		echo "<table><tr><td>Identifiant d'employé</td><td>Identifiant de commande</td><td>Identifiant de client</td></tr>";
		while ($row = $result->fetch_row()) {
    		echo "<tr>";
    		foreach ($row as $value) {
    			echo "<td>$value</td>";
    		}
    		echo '</tr>';
		}
  		echo "</table>";
		?>
	</body>
</html>