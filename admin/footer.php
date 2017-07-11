<?php  	
	$utilisateur = $_SESSION['id_utilisateur'];
	
	$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$utilisateur' ");
	$ligne = $sql->fetch(); // va chercher !

?>
<footer>
	<footer class="footer">
      <div class="container">
        <p class="text-muted">© <?= $ligne['prenom'].' '.$ligne['nom']; ?> . 2017</p>
      </div>
    </footer>
</footer>