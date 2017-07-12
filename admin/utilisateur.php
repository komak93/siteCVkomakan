<?php 
	require '../connexion/connexion.php';
?>
<?php
	
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
					$sql = $pdoCV->prepare(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$utilisateur' ");
					$sql->execute();
					$nb_info = $sql->rowCount();
				?>
                    <div class="col-lg-12">
                        <h1 class="index">Utilisateur Site CV :: <?= $ligne['prenom'].' '.$ligne['nom']; ?></h1>
							<h2 class="user">Modification d'une compétence</h2>
                        <table id="tableau" class="table table-striped">
							<thead> 
								<tr class="info">
									<th id="utilisateur"scope="col">Informations</th>
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
									<td><a href="modif/modif_utilisateur.php?id_utilisateur=<?= $ligne['id_utilisateur']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
                        <br />
                        <br />
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
