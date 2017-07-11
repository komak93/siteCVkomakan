<?php require '../connexion/connexion.php';?>
<?php

	session_start();// à mettre dans toutes las pages de l'admin ; SESSION et Authentification

	$msg_auth_err=''; // on initialisz la variable en cas d'erreur
	
	if(isset($_POST['connexion'])){// on envoie le form avec le name du bouton (on a cliqué sur le bouton)
		$pseudo = addslashes($_POST['pseudo']);
		$mdp = addslashes($_POST['mdp']);
		
		$sql = $pdoCV->prepare(" SELECT * FROM t_utilisateurs WHERE pseudo='$pseudo' AND mdp='$mdp' ");
		$sql->execute();
		$nbr_utilisateur= $sql->rowCount();
		
			if($nbr_utilisateur==0){
				$msg_auth_err="Erreur d'authentification !";
			}
			else{
				$ligne_utilisateur= $sql->fetch();
				
				$_SESSION['connexion']='connecté';
				$_SESSION['id_utilisateur']=$ligne_utilisateur['id_utilisateur'];
				$_SESSION['prenom']=$ligne_utilisateur['prenom'];
				$_SESSION['nom']=$ligne_utilisateur['nom'];
				
				header('location: index.php');
				exit();
			}
		

	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title></title>

		 <!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="css/simple-sidebar.css" rel="stylesheet">
		
		<link rel="stylesheet" href="css/competence.css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	
	</head>
	
	<body>
	
		<form class="form-horizontal" method="post" action="login.php">
			<fieldset>

			<!-- Form Name -->
			<legend>Login Admin</legend>

			<!-- Text input-->
			<div class="form-group">
				<label for="pseudo" class="col-md-3 col-md-offset-1 control-label" >Pseudo *</label>  
				<div class="col-md-4">
					<input id="pseudo" name="pseudo" type="text" class="form-control input-md" required="">
				</div>
			</div>
			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-3 col-md-offset-1 control-label" for="mdp">Mot de passe *</label>  
				<div class="col-md-4">
					<input id="mdp" name="mdp" type="password" class="form-control input-md">
				</div>
			</div>
			<!-- Button -->
			<div class="form-group">
				<label class="col-md-4 control-label" for=""></label>
				<div class="col-md-4">
					<button name="connexion" type="submit" class="btn btn-primary">Connexion</button>
				</div>
			</div>

			</fieldset>
		</form>
	</body>
</html>