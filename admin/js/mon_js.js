$(function(){ // verifier que le chargement de la page se fait correctement
	/* console.log("WESH LA STREET !"); */
	$('.suppr').on("click",function(e){//
		e.preventDefault();//cela empeche le rechargement de la page
		
		if(confirm('Êtes vous sûr de vouloir supprimer cette info ?')){
		/* 	console.log('Bien ?'); */
			var lien= $(this).attr('href');
			window.location.href=lien;
		}
	
	});
		
});