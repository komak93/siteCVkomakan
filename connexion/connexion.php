<?php
	
	$hote= 'localhost'; // le chemin vers le serveur
	$bdd = 'siteCV_ktoure'; // le nom de la base de données
	$utilisateur= 'root'; // le nom d'utilisateur pour se connecter
	$pass= ''; // mot de passe de l'utilisateur
	
	
	$pdoCV= new PDO('mysql:host='.$hote.';dbname='.$bdd, $utilisateur, $pass);
	//$pdoCV est le nom de la variable de la connexion qui sert partout o$ l'on doit se servir de cette connexion
	$pdoCV->exec("SET NAMES utf8");
	

?>