<?php require '../../connexion/connexion.php'; ?>
<?php

// Gestion des contenus, mise à jour d'une compétence
	if(isset($_POST['titre_f'])){
		$titre = addslashes($_POST['titre_f']);
		$sous_titre = addslashes($_POST['sous_titre_f']);
		$description = addslashes($_POST['description_f']);
		$dates = addslashes($_POST['dates_f']);
		
		$id_formation = $_POST['id_formation'];

// j'execute les requêtes
		$pdoCV->exec(" UPDATE t_formations SET titre_f='$titre' WHERE id_formation='$id_formation' ");
		$pdoCV->exec(" UPDATE t_formations SET sous_titre_f='$sous_titre' WHERE id_formation='$id_formation' ");
		$pdoCV->exec(" UPDATE t_formations SET description_f='$description' WHERE id_formation='$id_formation' ");
		$pdoCV->exec(" UPDATE t_formations SET dates_f='$dates' WHERE id_formation='$id_formation' ");
		header('location: ../formation.php');
		exit();
	}

// Je recupere la competence
	$id_formation = $_GET['id_formation']; // par l'id et $_GET
	$sql = $pdoCV->query(" SELECT * FROM t_formations WHERE id_formation = '$id_formation' "); // la requête égale à l'id
	$ligne_formation = $sql->fetch(); // 
	
	
	
	session_start();
	
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<?php
			$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1' ");
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

<body style="background: url(image/bgimg.png)no-repeat; background-size:cover;">

     <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="index.php">
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
                        <table class="table table-striped">
							<thead> 
								<tr class="info">
									<th scope="col">Formations</th>
									<th scope="col">Modifier</th>
									<th scope="col">Supprimer</th>
								</tr>
							</thead>
							<tbody>
								<?php while($ligne = $sql->fetch()){ ?>
								<tr>
									<td>
										<?= $ligne['titre_f'];?>
									</td>
									<td>
										<?= $ligne['sous_titre_f'];?>
									</td>	
									<td>	
										<?= $ligne['description_f'];?>
									</td>	
									<td>	
										<?= $ligne['dates_f'];?>
									</td>
									<td><a href="modif_formation.php?id_formation=<?= $ligne['id_formation']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a href="formation.php?id_formation=<?= $ligne['id_formation']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<form class="form-horizontal" method="post" action="modif_formation.php">
							<fieldset>

							<!-- Form Name -->
							<legend>Form Name</legend>

							<!-- Text input-->
							<div class="form-group">
								<label for="titre_f" class="col-md-4 control-label" >Titre de l'expérience</label>  
								<div class="col-md-4">
									<input name="titre_f" type="text" class="form-control input-md" value="<?= $ligne_formation['titre_f']; ?>">
									<input name="id_formation" hidden value="<?= $ligne_formation['id_formation']; ?>">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label for="sous_titre_f" class="col-md-4 control-label" >Sous-titre</label>  
								<div class="col-md-4">
									<input name="sous_titre_f" type="text" class="form-control input-md" value="<?= $ligne_formation['sous_titre_f']; ?>">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label for="dates_f" class="col-md-4 control-label" >Titre de l'expérience</label>  
								<div class="col-md-4">
									<input name="dates_f" type="text" class="form-control input-md" value="<?= $ligne_formation['dates_f']; ?>">
								</div>
							</div>
							<!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="description_f">Description</label>
								<div class="col-md-4">                     
									<textarea name="description_f" cols="80" rows="4" class="form-control"><?= $ligne_formation['description_f']; ?> </textarea>
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

						<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Afficher le Menu</a>
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
	<script src="../formation.js"></script>

</body>

</html>
