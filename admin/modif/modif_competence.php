<?php require '../../connexion/connexion.php'; ?>
<?php

// Gestion des contenus, mise à jour d'une compétence
	if(isset($_POST['competence'])){
		$competence = addslashes($_POST['competence']);
		$id_competence = $_POST['id_competence'];
		$pdoCV->exec(" UPDATE t_competences SET competence='$competence' WHERE id_competence='$id_competence' ");
		header('location: ../competence.php');
		exit();
	}

// Je recupere la competence
	$id_competence = $_GET['id_competence']; // par l'id et $_GET
	$sql = $pdoCV->query(" SELECT * FROM t_competences WHERE id_competence = '$id_competence' "); // la requête égale à l'id
	$competence = $sql->fetch(); // 
	
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
									<td><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a href="competence.php?id_competence=<?= $ligne['id_competence']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<form class="form-horizontal" method="post" action="modif_competence.php">
							<fieldset>

							<!-- Form Name -->
							<legend>Form Name</legend>

							<!-- Text input-->
							<div class="form-group">
								<label for="competence" class="col-md-4 control-label" >Compétence</label>  
								<div class="col-md-4">
									<input name="competence" type="text" class="form-control input-md" value="<?= $competence['competence']; ?>">
									<input name="id_competence" hidden value="<?= $competence['id_competence']; ?>">
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
