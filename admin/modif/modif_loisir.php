<?php require '../../connexion/connexion.php'; ?>
<?php

// Gestion des contenus, mise à jour d'un loisir
	if(isset($_POST['loisir'])){
		$loisir = addslashes($_POST['loisir']);
		
		$id_loisir = $_POST['id_loisir'];
		$pdoCV->exec(" UPDATE t_loisirs SET loisir='$loisir' WHERE id_loisir='$id_loisir' ");
		header('location: ../loisir.php');
		exit();
	}

// Je recupere les loisirs
	$id_loisir = $_GET['id_loisir']; // par l'id et $_GET
	$sql = $pdoCV->query(" SELECT * FROM t_loisirs WHERE id_loisir = '$id_loisir' "); // la requête égale à l'id
	$loisir = $sql->fetch(); // 
	
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
                    <div class="col-lg-12">
						<h2>Modification d'un loisir</h2>
                        <table class="table table-striped">
							<thead> 
								<tr class="info">
									<th scope="col">Loisir</th>
									<th scope="col">Modifier</th>
									<th scope="col">Supprimer</th>
								</tr>
							</thead>
							<tbody>
								<?php while($ligne = $sql->fetch()){ ?>
								<tr>
									<td>
										<?= $ligne['loisir']; ?>
									</td>
									<td><a href="modif_loisir.php?id_loisir=<?= $ligne['id_loisir']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
									<td><a href="modif_loisir.php?id_loisir=<?= $ligne['id_loisir']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<form class="form-horizontal" method="post" action="modif_loisir.php">
							<fieldset>

							<!-- Form Name -->
							<legend></legend>

							<!-- Text input-->
							<div class="form-group">
								<label for="loisir" class="col-md-4 control-label" >Loisir</label>  
								<div class="col-md-4">
									<input name="loisir" type="text" class="form-control input-md" value="<?= $loisir['loisir']; ?>">
									<input name="id_loisir" hidden value="<?= $loisir['id_loisir']; ?>">
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

						<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Menu !</a>
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
	<script src="../competence.js"></script>

</body>

</html>
