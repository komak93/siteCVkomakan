<?php require '../connexion/connexion.php'; ?>
<?php
	//gestion de contenu
	//insertion d'une compétence
	if(isset($_POST['competence'])){ // si on récupère une nouvelle compétence
		if(!empty($_POST['competence'])){ // si compétence est different de vide
			$competence = addslashes($_POST['competence']);
			
			$pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '1') "); // mettre $id_utilisateur quand ont l'aura en variable de session
			header("location: ../admin/competence.php ");
			exit();
		}// ferme le if
	}// ferme le if isset
	
// Suppression de compétence
	if(isset($_GET['id_competence'])){
		$delete = $_GET['id_competence'];
		$sql = "DELETE FROM t_competences WHERE id_competence = '$delete' ";
		$pdoCV->query($sql); // ou on peut avec exec
		header("location: ../admin/competence.php ");
	}
	
	session_start();
	$utilisateur = $_SESSION['id_utilisateur'];
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$utilisateur' ");
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
<!-------------------------------------------------------------------------------------------------
									NAV (SIDEBAR) DEBUT
-------------------------------------------------------------------------------------------------->
				<?php  include_once('sidebar.inc.php');     ?>
<!-------------------------------------------------------------------------------------------------
									NAV (SIDEBAR) FIN
-------------------------------------------------------------------------------------------------->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
					<?php
						$sql = $pdoCV->prepare(" SELECT * FROM t_competences WHERE utilisateur_id = '$utilisateur' ");
						$sql->execute();
						$nb_competences = $sql->rowCount();
					?>
                    <div class="col-lg-12">
						<h2>Compétences</h2>
						<p>il y a <?= $nb_competences ; ?> compétences dans la table pour <?= $ligne['pseudo']; ?></p>
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
										<?= $ligne['competence']; ?>
									</td>
									<td><a href="modif/modif_competence.php?id_competence=<?= $ligne['id_competence']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a class="suppr" href="competence.php?id_competence=<?= $ligne['id_competence']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
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
								<label for="competence" class="col-md-4 control-label" >Compétence</label>  
								<div class="col-md-4">
									<input id="competence" name="competence" type="text" placeholder="Ajoutez une compétence..." class="form-control input-md" required="">
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

						<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Affichage du Menu</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
<!-------------------------------------------------------------------------------------------------
								FOOTER DEBUT
-------------------------------------------------------------------------------------------------->
							<?php  include_once('footer.php');     ?>
<!-------------------------------------------------------------------------------------------------
								FOOTER FIN
-------------------------------------------------------------------------------------------------->
	
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
	<script src="js/mon_js.js" ></script>

</body>

</html>
