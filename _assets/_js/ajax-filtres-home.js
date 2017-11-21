

var p = {};

document.getElementById('selectPrix').addEventListener('change', function(){	
	p.prix = document.getElementById('selectPrix').value;
	console.log(p);
	ajaxFiltre();
});

document.getElementById('selectCapacite').addEventListener('change', function(){	
	p.capacite = document.getElementById('selectCapacite').value;
	console.log(p);
	ajaxFiltre();
});

document.querySelectorAll('.categorie').forEach(function(element) {
  /*console.log(element);*/
  element.addEventListener('click', function(){	
	p.categorie = this.getAttribute('value');
	console.log(p);
	ajaxFiltre();
}); // end addEventListener'click'
}); // end forEach

document.querySelectorAll('.ville').forEach(function(element) {
  /*console.log(element);*/
  element.addEventListener('click', function(){	
	p.ville = this.getAttribute('value');
	console.log(p);
	ajaxFiltre();
}); // end addEventListener'click'
}); // end forEach



	

/*parametres += $(par).val().slice(0,-1);*/

function ajaxFiltre(){

	/* PARAMETRES */
	var param = "";
	for (var prop in p) {
		param += prop + '=' + p[prop] + '&';
		console.log(param.slice(0,-1));
	}

	/* FICHIER CIBLE */
	var file = "_assets/_js/filtres-home.php";

	/* création de l'objet ajax */
	if (window.XMLHttpRequest) {
		var xhttp = new XMLHttpRequest();
	} else {
		var xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	// on prépare la connexion
	xhttp.open("POST", file, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour methode POST


	xhttp.onreadystatechange = function(){
		if (xhttp.status == 200 && xhttp.readyState == 4) {
			// pour controler le script php et voir les eventuelles erreurs :
			console.log(xhttp.responseText);

			// création de l'objet JS
			var obj = JSON.parse(xhttp.responseText);
			console.log(obj);

			// on place la réponse dans l'element
			document.getElementById('salles').innerHTML = obj.resultat;
		}
	}

	// on envoie les infos
	xhttp.send(param);	

} // end function ajaxFiltre()

