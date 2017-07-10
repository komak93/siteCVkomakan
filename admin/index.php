<?php 
	require '../connexion/connexion.php';
?>
<?php
	
	session_start();
	
		if(isset($_SESSION['connexion']) && 
		$_SESSION['connexion']=='connecté'){
			$id_utilisateur=$_SESSION['id_utilisateur'];
			$prenom=$_SESSION['prenom'];
			$nom=$_SESSION['nom'];
			
			echo $_SESSION['connexion'];
			
		}else{
			header('location: login.php');
			
		}
		
		if(isset($_GET['quitter'])){
			$_SESSION['connexion']='';
			$_SESSION['id_utilisateur']='';
			$_SESSION['prenom']='';
			$_SESSION['nom']='';
			
			unset($_SESSION['connexion']);
			session_destroy();
			
			header('location:../login.php');
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
				<li role="separator" class="divider"></li>
				<li>
                    <a href="index.php?quitter=oui">Déconnexion</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 style="text-align: center">ADMIN :: <?= $ligne['prenom'].' '.$ligne['nom']; ?> Site CV</h1>
							
							<code><?php 
								$datetime = date("d-m-Y H:i:s");
								echo $datetime; 
							?></code>
						
                        <br />
                        <br />
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
