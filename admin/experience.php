<?php require '../connexion/connexion.php'; ?>
<?php
	//gestion de contenu
	//insertion d'une compétence
	if(isset($_POST['titre_e'])){//si on récupère une nelle expérience
			if($_POST['titre_e']!='' && $_POST['description_e']!='' && $_POST['dates_e']!=''){// si expérience et les autres champs ne sont pas vide
				$titre_e = addslashes($_POST['titre_e']);
				$sous_titre_e = addslashes($_POST['sous_titre_e']);
            	$description_e = addslashes($_POST['description_e']);
            	$dates_e = addslashes($_POST['dates_e']);
				
				$pdoCV->exec(" INSERT INTO t_experiences VALUES (NULL, '$titre_e', '$sous_titre_e', '$description_e', '$dates_e', '1') ");//mettre $id_utilisateur quand on l'aura en variable de session
				header("location: ../admin/experience.php");
				exit();
			}//ferme le if
		}//ferme le if isset
	
	
// Suppression de compétence
	if(isset($_GET['id_experience'])){
		$delete = $_GET['id_experience'];
		$sql = "DELETE FROM t_experiences WHERE id_experience = '$delete' ";
		$pdoCV->query($sql); // ou on peut avec exec
		header("location: ../admin/experience.php ");
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
						$sql = $pdoCV->prepare(" SELECT * FROM t_experiences WHERE utilisateur_id = '$utilisateur' ");
						$sql->execute();
						$nb_experience = $sql->rowCount();
					?>
                    <div class="col-lg-12">
						<h2>Expériences</h2>
                        <table class="table table-striped">
							<thead> 
								<tr class="info">
									<th scope="col">Titres</th>
									<th scope="col">Sous-titres</th>
									<th scope="col">Description</th>
									<th scope="col">Dates</th>
									<th scope="col">Modifier</th>
									<th scope="col">Supprimer</th>
								</tr>
							</thead>
							<tbody>
								<?php while($ligne = $sql->fetch()){ ?>
								<tr>
									<td>
										<?= $ligne['titre_e'];?>
									</td>
									<td>
										<?= $ligne['sous_titre_e'];?>
									</td>	
									<td>	
										<?= $ligne['description_e'];?>
									</td>	
									<td>	
										<?= $ligne['dates_e'];?>
									</td>
									<td><a href="modif/modif_experience.php?id_experience=<?= $ligne['id_experience']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a class="suppr" href="experience.php?id_experience=<?= $ligne['id_experience']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<form class="form-horizontal" method="post" action="experience.php">
							<fieldset>

							<!-- Form Name -->
							<legend>Form Name</legend>

							<!-- Text input-->
							<div class="form-group">
								<label for="titre_e" class="col-md-4 control-label" >Titre de l'expérience</label>  
								<div class="col-md-4">
									<input id="titre_e" name="titre_e" type="text" placeholder="Ajoutez une expérience..." class="form-control input-md" required="">
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
									<textarea name="description_e" cols="80" rows="4" class="form-control" id="description_e" placeholder="description de l'expérience"></textarea>
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
            CKEDITOR.replace( 'description_e' );
    </script>

</body>

</html>
