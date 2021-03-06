<?php require '../connexion/connexion.php'; ?>
<?php

	//gestion de contenu
	//insertion d'une compétence
	if(isset($_POST['titre_f'])){//si on récupère une nelle expérience
			if($_POST['titre_f']!='' && $_POST['description_f']!='' && $_POST['dates_f']!=''){// si expérience et les autres champs ne sont pas vide
				$titre_f = addslashes($_POST['titre_f']);
				$sous_titre_f = addslashes($_POST['sous_titre_f']);
            	$description_f = addslashes($_POST['description_f']);
            	$dates_f = addslashes($_POST['dates_f']);
				
				$pdoCV->exec(" INSERT INTO t_formations VALUES (NULL, '$titre_f', '$sous_titre_f', '$description_f', '$dates_f', '1') ");//mettre $id_utilisateur quand on l'aura en variable de session
				header("location: ../admin/formation.php");
				exit();
			}//ferme le if
		}//ferme le if isset
	
	
// Suppression de compétence
	if(isset($_GET['id_formation'])){
		$delete = $_GET['id_formation'];
		$sql = "DELETE FROM t_formations WHERE id_formation = '$delete' ";
		$pdoCV->query($sql); // ou on peut avec exec
		header("location: ../admin/formation.php ");
	}
	
	session_start();
	$utilisateur = $_SESSION['id_utilisateur'];
	
	
?>
<!DOCTYPE html>
<html lang="fr">

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

	<!-- My CSS -->
	<link rel="stylesheet" href="css/style.css">
	
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
						$sql = $pdoCV->prepare(" SELECT * FROM t_formations WHERE utilisateur_id = '$utilisateur' ");
						$sql->execute();
						$nb_formation = $sql->rowCount();
					?>
                    <div class="col-lg-12">
						<h2>Formations</h2>
						<p>il y a <?= $nb_formation ; ?> formations dans la table pour <?= $ligne['pseudo']; ?></p>
                        <table class="table table-striped">
							<thead> 
								<tr class="info">
									<th scope="col">Titres</th>
									<th scope="col">Sous-titres</th>
									<th class="centrage" scope="col">Description</th>
									<th scope="col">Dates</th>
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
									<td><a href="modif/modif_formation.php?id_formation=<?= $ligne['id_formation']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a class="suppr" href="formation.php?id_formation=<?= $ligne['id_formation']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<form class="form-horizontal" method="post" action="formation.php">
							<fieldset>

							<!-- Form Name -->
							<legend>Form Name</legend>

							<!-- Text input-->
							<div class="form-group">
								<label for="titre_f" class="col-md-4 control-label" >Titre de la formation</label>  
								<div class="col-md-4">
									<input id="titre_f" name="titre_f" type="text" placeholder="Ajoutez une formation..." class="form-control input-md" required="">
								</div>
							</div>
							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="sous_titre_f">Sous Titre</label>  
								<div class="col-md-4">
									<input id="sous_titre_f" name="sous_titre_f" type="text" placeholder="Facultatif...." class="form-control input-md">
								</div>
							</div>
							
							<!-- Text input-->
							<div class="form-group">
								<label class="col-md-4 control-label" for="dates_f">Dates</label>  
								<div class="col-md-4">
									<input id="dates_f" name="dates_f" type="text" placeholder="ex: 2012 - 2017" class="form-control input-md" required="">	
								</div>
							</div>

							<!-- Textarea -->
							<div class="form-group">
								<label class="col-md-4 control-label" for="description_f">Description</label>
								<div class="col-md-4">                     
									<textarea name="description_f" cols="80" rows="4" class="form-control" id="description" placeholder="description de l'expérience"></textarea>
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
	<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
	<script>
            CKEDITOR.replace( 'description' );
    </script>

</body>

</html>
