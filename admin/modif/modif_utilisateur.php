<?php require '../../connexion/connexion.php'; ?>
<?php

// Gestion des contenus, mise à jour d'une compétence
	if(isset($_POST['pseudo'])){
		$pseudo = addslashes($_POST['pseudo']);
		$email = addslashes($_POST['email']);
		$tel = addslashes($_POST['telephone']);
		$age = addslashes($_POST['age']);
		$image = addslashes($_POST['avatar']);
		$statut = addslashes($_POST['statut_marital']);
		$adresse = addslashes($_POST['adresse']);
		$cp = addslashes($_POST['code_postal']);
		$ville = addslashes($_POST['ville']);
		$pays = addslashes($_POST['pays']);
		
		$id_utilisateur = $_POST['id_utilisateur'];

// j'execute les requêtes
		$pdoCV->exec(" UPDATE t_utilisateurs SET pseudo='$pseudo' WHERE id_utilisateur='$id_utilisateur' ");
		$pdoCV->exec(" UPDATE t_utilisateurs SET email='$email' WHERE id_utilisateur='$id_utilisateur' ");
		$pdoCV->exec(" UPDATE t_utilisateurs SET telephone='$tel' WHERE id_utilisateur='$id_utilisateur' ");
		$pdoCV->exec(" UPDATE t_utilisateurs SET age='$age' WHERE id_utilisateur='$id_utilisateur' ");
		$pdoCV->exec(" UPDATE t_utilisateurs SET avatar='$image' WHERE id_utilisateur='$id_utilisateur' ");
		$pdoCV->exec(" UPDATE t_utilisateurs SET statut_marital='$statut' WHERE id_utilisateur='$id_utilisateur' ");
		$pdoCV->exec(" UPDATE t_utilisateurs SET adresse='$adresse' WHERE id_utilisateur='$id_utilisateur' ");
		$pdoCV->exec(" UPDATE t_utilisateurs SET code_postal='$cp' WHERE id_utilisateur='$id_utilisateur' ");
		$pdoCV->exec(" UPDATE t_utilisateurs SET pays='$pays' WHERE id_utilisateur='$id_utilisateur' ");
		header('location: ../utilisateur.php');
		exit();
	}

// Je recupere la competence
	$id_utilisateur = $_GET['id_utilisateur']; // par l'id et $_GET
	$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur' "); // la requête égale à l'id
	$ligne_user = $sql->fetch(); // 
	
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<?php
			$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='$id_utilisateur' ");
			$ligne = $sql->fetch(); // va chercher !
	?>
	
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $ligne['prenom'].' '.$ligne['nom']; ?></title>

     <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/simple-sidebar.css" rel="stylesheet">
	
	<link rel="stylesheet" href="../css/competence.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

     <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="../index.php">
                        HOME  :: <span class="glyphicon glyphicon-home"></span>
                    </a>
                </li>
                <li>
					<a href="../competence.php">Compétences</a>
                </li>
                <li>
                    <a href="../experience.php">Experiences</a>
                </li>
                <li>
                    <a href="../formation.php">Formations</a>
                </li>
                <li>
                    <a href="../loisir.php">Loisirs</a>
                </li>
                <li>
                    <a href="../realisations.php">Réalisation</a>
                </li>
                <li>
                    <a href="../utilisateur.php">Utilisateurs</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<h2>Modification d'une compétence</h2>
                         <table id="tableau" class="table table-striped">
							<thead> 
								<tr class="info">
									<th scope="col">Compétences</th>
									<th scope="col">Modifier</th>
									<th scope="col">Supprimer</th>
								</tr>
							</thead>
							<tbody>
								<?php while($ligne = $sql->fetch()){ ?>
								<tr>
									<td>
										<?= $ligne['pseudo'];?>
									</td>
								</tr>
								<tr>		
									<td>	
										<?= $ligne['email'];?>
									</td>
								</tr>
								<tr>	
									<td>
										<?= $ligne['telephone'];?>
									</td>
								</tr>	
								<tr>	
									<td>
										<?= $ligne['age'];?>
									</td>
								</tr>
								<tr>		
									<td>	
										<img src="image/<?= $ligne['avatar'];?>">
									</td>
								</tr>
								<tr>		
									<td>	
										<?= $ligne['statut_marital'];?>
									</td>
								</tr>
								<tr>		
									<td>	
										<?= $ligne['adresse'];?>
									</td>
								</tr>
								<tr>		
									<td>
										<?= $ligne['code_postal'];?>
									</td>
								</tr>	
								<tr>		
									<td>	
										<?= $ligne['ville'];?>
									</td>
								</tr>	
								<tr>		
									<td>	
										<?= $ligne['pays'];?>
									</td>
								</tr>					
								<tr>		
									<td><a href="modif_utilisateur.php?id_utilisateur=<?= $ligne['id_utilisateur']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<form class="form-horizontal" method="post" action="modif_utilisateur.php">
							<fieldset>

							<!-- Form Name -->
							<legend>Formulaire Utilisateur</legend>

							<!-- Text input-->
							<div class="form-group">
								<label for="pseudo" class="col-md-4 control-label" >Pseudo</label>  
								<div class="col-md-4">
									<input name="pseudo" type="text" class="form-control input-md" value="<?= $ligne_user['pseudo']; ?>">
									<input name="id_utilisateur" hidden value="<?= $ligne_user['id_utilisateur']; ?>">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label for="email" class="col-md-4 control-label" >Email</label>  
								<div class="col-md-4">
									<input name="email" type="text" class="form-control input-md" value="<?= $ligne_user['email']; ?>">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label for="telephone" class="col-md-4 control-label" >Telephone</label>  
								<div class="col-md-4">
									<input name="telephone" type="text" class="form-control input-md" value="<?= $ligne_user['telephone']; ?>">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label for="age" class="col-md-4 control-label" >Âge</label>  
								<div class="col-md-4">
									<input name="age" type="text" class="form-control input-md" value="<?= $ligne_user['age']; ?>">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label for="avatar" class="col-md-4 control-label" >Avatar</label>  
								<div class="col-md-4">
									<input name="avatar" type="file" class="form-control input-md" value="<?= $ligne_user['avatar']; ?>">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label for="statut_marital" class="col-md-4 control-label" >Statut marital</label>  
								<div class="col-md-4">
									<input name="statut_marital" type="text" class="form-control input-md" value="<?= $ligne_user['statut_marital']; ?>">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label for="adresse" class="col-md-4 control-label" >Adresse</label>  
								<div class="col-md-4">
									<input name="adresse" type="text" class="form-control input-md" value="<?= $ligne_user['adresse']; ?>">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label for="code_postal" class="col-md-4 control-label" >Code postal</label>  
								<div class="col-md-4">
									<input name="code_postal" type="text" class="form-control input-md" value="<?= $ligne_user['code_postal']; ?>">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label for="ville" class="col-md-4 control-label" >Ville</label>  
								<div class="col-md-4">
									<input name="ville" type="text" class="form-control input-md" value="<?= $ligne_user['ville']; ?>">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label for="pays" class="col-md-4 control-label" >Pays</label>  
								<div class="col-md-4">
									<input name="pays" type="text" class="form-control input-md" value="<?= $ligne_user['pays']; ?>">
								</div>
							</div>
							<!-- Button -->
							<div class="form-group">
								<label class="col-md-4 control-label" for=""></label>
								<div class="col-md-4">
									<button type="submit" class="btn btn-primary">Mettre à jour</button>
								</div>
							</div>

							</fieldset>
						</form>

						<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Affichage du Menu</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
	<script src="../js/mon_js.js" ></script>

</body>

</html>
