<?php  	
	$utilisateur = $_SESSION['id_utilisateur'];
	
	$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$utilisateur' ");
	$ligne = $sql->fetch(); // va chercher !

?>
<footer>
	<div class="footer">
		<div class="row">
			<div class="col-md-12 col-xs-12 footer">
				<p>© <?= $ligne['prenom'].' '.$ligne['nom']; ?> . 2017</p>
			</div>	
		</div>
	</div>
</footer>