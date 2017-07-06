<?php require '../connexion/connexion.php'; ?>
<?php
	//gestion de contenu
	//insertion d'une compétence
	if(isset($_POST['titre_e'])){
		if(!empty($_POST[''] && $_POST['']))
		
	}
			
			$pdoCV->exec(" INSERT INTO t_experiences VALUES (NULL, '$experience', '') "); // mettre $id_utilisateur quand ont l'aura en variable de session
			header("location: ../admin/experience.php ");
			exit();
		}// ferme le if
	}// ferme le if isset
	
// Suppression de compétence
	if(isset($_GET['id_experience'])){
		$delete = $_GET['id_experience'];
		$sql = "DELETE FROM t_experiences WHERE id_experience = '$delete' ";
		$pdoCV->query($sql); // ou on peut avec exec
		header("location: ../admin/experience.php ");
	}
	
	
	
?>
<!DOCTYPE html>
<html lang="en">

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

     <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="test.php">
                        HOME  :: <span class="glyphicon glyphicon-home"></span>
                    </a>
                </li>
                <li>
					<a href="competence.php">Compétences</a>
                </li>
                <li>
                    <a href="experience.php">Experiences</a>
                </li>
                <li>
                    <a href="formation.php">Formations</a>
                </li>
                <li>
                    <a href="loisir.php">Loisirs</a>
                </li>
                <li>
                    <a href="realisations.php">Réalisation</a>
                </li>
                <li>
                    <a href="utilisateur.php">Utilisateurs</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
					<?php
						$sql = $pdoCV->prepare(" SELECT * FROM t_experiences WHERE utilisateur_id = '1' ");
						$sql->execute();
						$nb_experience = $sql->rowCount();
					?>
                    <div class="col-lg-12">
						<h2>Expériences</h2>
						<p>il y a <?= $nb_experience ; ?> expériences dans la table pour <?= $ligne['pseudo']; ?></p>
                        <table class="table table-striped">
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
										<?= $ligne['experience']; ?>
									</td>
									<td><a href="modif_experience.php?id_experience=<?= $ligne['id_experience']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a href="experience.php?id_experience=<?= $ligne['id_experience']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<form class="form-horizontal" method="post" >
							<fieldset>

							<!-- Form Name -->
							<legend>Form Name</legend>

							<!-- Text input-->
							<div class="form-group">
								<label for="experience" class="col-md-4 control-label" >Expérience</label>  
								<div class="col-md-4">
									<input id="experience" name="experience" type="text" placeholder="Ajoutez une compétence..." class="form-control input-md" required="">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="sous_titre_e">Sous Titre</label>  
								<div class="col-md-4">
									<input id="sous_titre_e" name="sous_titre_e" type="text" placeholder="Facultatif...." class="form-control input-md">
								</div>
							</div>

							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="dates_e">Dates</label>  
								<div class="col-md-4">
									<input id="dates_e" name="dates_e" type="text" placeholder="ex: 2012 - 2017" class="form-control input-md" required="">	
								</div>
							</div>
							<!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="description_e">Description</label>
								<div class="col-md-4">                     
									<textarea class="form-control" id="description_e" name="description_e">....</textarea>
								</div>
							</div>

							<!-- Button -->
							<div class="form-group">
								<label class="col-md-4 control-label" for=""></label>
								<div class="col-md-4">
									<button type="submit" class="btn btn-primary">Envoyez</button>
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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
