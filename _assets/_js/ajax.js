"use strict";

// =======================================================================================================
// =======================================       APPLICATION AJAX
// =======================================================================================================

function listemembre(choix, action){
    console.clear();
    var file = '_datas/membre_ajax_01.php';
    if (window.XMLHttpRequest) {
            var xhttp = new XMLHttpRequest();
        }else{
            var xhttp = new ActiveXObject ("Microsoft.XMLHTTP");
        }
    console.log(xhttp);
    // var choix = document.getElementById('listeMembres').value;
    var param = 'id='+choix;
    console.log(choix + ' ' + param);
    xhttp.open("POST", file, true); 
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // ligne obligatoire pour post
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            console.log("Status HTTP :" + xhttp.status);
            console.log("Status AJAX :" + xhttp.readyState);
            console.log("Réponse HTTP :" + xhttp.responseText);
            var result = JSON.parse(xhttp.responseText);
            // console.log(result.liste);
            // console.log(result.fiche);

            document.getElementById("listemembre").innerHTML = result.liste;
            if (result.fiche.length != 0 ){
                document.getElementById("fichemembre").innerHTML = result.fiche;
            }
            switch (action){
            case 1:
                document.getElementById("message").innerHTML = '<div class="validation">Veuillez modifier les données et cliquer sur modifier</div>';
                break;
            case 2:
                document.getElementById("message").innerHTML = '<div class="erreur">Veuillez confirmer la suppression d\'un membre !</div>';
                break;

            }
        }
    }

    xhttp.send(param); // on envoie la demande 
}

function listesalle(choix, action){
    console.clear();
    var file = '_datas/salle_ajax_01.php';
    if (window.XMLHttpRequest) {
            var xhttp = new XMLHttpRequest();
        }else{
            var xhttp = new ActiveXObject ("Microsoft.XMLHTTP");
        }
    console.log(xhttp);
    // var choix = document.getElementById('listeMembres').value;
    var param = 'id='+choix;
    console.log(choix + ' ' + param);
    xhttp.open("POST", file, true); 
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // ligne obligatoire pour post
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            console.log("Status HTTP :" + xhttp.status);
            console.log("Status AJAX :" + xhttp.readyState);
            console.log("Réponse HTTP :" + xhttp.responseText);
            var result = JSON.parse(xhttp.responseText);
            // console.log(result.liste);
            // console.log(result.fiche);

            document.getElementById("listesalle").innerHTML = result.liste;
            if (result.fiche.length != 0 ){
                document.getElementById("fichesalle").innerHTML = result.fiche;
            }
            switch (action){
            case 1:
                document.getElementById("message").innerHTML = '<div class="validation">Veuillez modifier les données et cliquer sur modifier</div>';
                break;
            case 2:
                document.getElementById("message").innerHTML = '<div class="erreur">Veuillez confirmer la suppression d\'un membre !</div>';
                break;

            }
        }
    }

    xhttp.send(param); // on envoie la demande 
}

function listeavis(choix, action){
    console.clear();
    var file = '_datas/avis_ajax_01.php';
    if (window.XMLHttpRequest) {
            var xhttp = new XMLHttpRequest();
        }else{
            var xhttp = new ActiveXObject ("Microsoft.XMLHTTP");
        }
    console.log(xhttp);
    // var choix = document.getElementById('listeMembres').value;
    var param = 'id='+choix;
    console.log(choix + ' ' + param);
    xhttp.open("POST", file, true); 
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // ligne obligatoire pour post
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            console.log("Status HTTP :" + xhttp.status);
            console.log("Status AJAX :" + xhttp.readyState);
            // console.log("Réponse HTTP :" + xhttp.responseText);
            var result = JSON.parse(xhttp.responseText);
            // console.log(result.liste);
            console.log(result.listemembre);
            console.log(result.listesalle);
            
            // console.log(document.getElementById("id_membre").outerHTML);

            document.getElementById("listeavis").innerHTML = result.liste;

            if (result.fiche.length != 0 ){
                document.getElementById("ficheavis").innerHTML = result.fiche;
            }else{           
                document.getElementById("id_membre").outerHTML = result.listemembre;
                document.getElementById("id_salle").outerHTML = result.listesalle;
            }
            switch (action){
            case 1:
                document.getElementById("message").outerHTML = '<div class="validation">Veuillez modifier les données et cliquer sur modifier</div>';
                break;
            case 2:
                document.getElementById("message").outerHTML = '<div class="erreur">Veuillez confirmer la suppression d\'un membre !</div>';
                break;

            }
        }
    }

    xhttp.send(param); // on envoie la demande 
}


function listeproduit(choix, action){
    console.clear();
    var file = '_datas/produit_ajax_01.php';
    if (window.XMLHttpRequest) {
            var xhttp = new XMLHttpRequest();
        }else{
            var xhttp = new ActiveXObject ("Microsoft.XMLHTTP");
        }
    console.log(xhttp);
    // var choix = document.getElementById('listeMembres').value;
    var param = 'id='+choix;
    console.log(choix + ' ' + param);
    xhttp.open("POST", file, true); 
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // ligne obligatoire pour post
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            console.log("Status HTTP :" + xhttp.status);
            console.log("Status AJAX :" + xhttp.readyState);
            console.log("Réponse HTTP :" + xhttp.responseText);
            var result = JSON.parse(xhttp.responseText);
            // console.log(result.liste);

            console.log(result.listesalle);
            
            document.getElementById("listeproduit").innerHTML = result.liste;

            if (result.fiche.length != 0 ){
                document.getElementById("ficheproduit").innerHTML = result.fiche;
            }else{           
                document.getElementById("id_salle").outerHTML = result.listesalle;
                document.getElementById("etat").outerHTML = result.listeetat;
            }
            switch (action){
            case 1:
                document.getElementById("message").outerHTML = '<div class="validation">Veuillez modifier les données et cliquer sur modifier</div>';
                break;
            case 2:
                document.getElementById("message").outerHTML = '<div class="erreur">Veuillez confirmer la suppression d\'un membre !</div>';
                break;

            }
        }
    }

    xhttp.send(param); // on envoie la demande 
}

function listecommande(choix, action){
    console.clear();
    var file = '_datas/commande_ajax_01.php';
    if (window.XMLHttpRequest) {
            var xhttp = new XMLHttpRequest();
        }else{
            var xhttp = new ActiveXObject ("Microsoft.XMLHTTP");
        }
    console.log(xhttp);
    // var choix = document.getElementById('listeMembres').value;
    var param = 'id='+choix;
    console.log(choix + ' ' + param);
    xhttp.open("POST", file, true); 
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // ligne obligatoire pour post
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            console.log("Status HTTP :" + xhttp.status);
            console.log("Status AJAX :" + xhttp.readyState);
            console.log("Réponse HTTP :" + xhttp.responseText);
            var result = JSON.parse(xhttp.responseText);
            // console.log(result.liste);

            console.log(result.listesalle);
            
            document.getElementById("listecommande").innerHTML = result.liste;

            if (result.fiche.length != 0 ){
                document.getElementById("fichecommande").innerHTML = result.fiche;
            }else{           
                document.getElementById("id_membre").outerHTML = result.listemembre;
                document.getElementById("id_produit").outerHTML = result.listeproduit;
            }
            switch (action){
            case 1:
                document.getElementById("message").outerHTML = '<div class="validation">Veuillez modifier les données et cliquer sur modifier</div>';
                break;
            case 2:
                document.getElementById("message").outerHTML = '<div class="erreur">Veuillez confirmer la suppression d\'un membre !</div>';
                break;

            }
        }
    }

    xhttp.send(param); // on envoie la demande 
}

// ==================================================================================================

function chatFunction(){
    console.clear();
    // console.log(document.getElementById("cibleAjax01").innerHTML);

    var userTitle = document.getElementById("cibleAjax01");
    var userPicture = document.getElementById("cibleImage");
    var userAdress = document.getElementById("cibleAjax02");
    var userPays = document.getElementById("cibleAjax03");
    var userEmail = document.getElementById("cibleAjax04");

    console.log(userTitle);

    var file = "https://randomuser.me/api/";

    if (window.XMLHttpRequest) {
            var xhttp = new XMLHttpRequest();
        }else{
            var xhttp = new ActiveXObject ("Microsoft.XMLHTTP");
        }

    xhttp.open("GET", file, true); 
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            // console.log("Status HTTP :" + xhttp.status);
            // console.log("Status AJAX :" + xhttp.readyState);
            console.log("Réponse HTTP :" + xhttp.responseText);
            
            var ajax = JSON.parse(xhttp.responseText);
            
            console.log(ajax);
            console.log(ajax.results[0].name.first);

            userPicture.src = ajax.results[0].picture.large;
            userTitle.textContent = ajax.results[0].name.last[0].toUpperCase() + ' ' + ajax.results[0].name.first.substr(0,1).toUpperCase() + ajax.results[0].name.first.slice(1);
            userAdress.textContent = ajax.results[0].location.street; 
            userPays.textContent = ajax.results[0].location.city.toUpperCase(); 
            userEmail.textContent = ajax.results[0].email;
            // document.getElementById("cibleAjax03").innerHTML = result.indice;
        
        }
    }

    xhttp.send(); // on envoie la demande 
}

// ==================================================================================================

function randomUser(){
    console.clear();
    // console.log(document.getElementById("cibleAjax01").innerHTML);

    var userTitle = document.getElementById("cibleAjax01");
    var userPicture = document.getElementById("cibleImage");
    var userAdress = document.getElementById("cibleAjax02");
    var userPays = document.getElementById("cibleAjax03");
    var userEmail = document.getElementById("cibleAjax04");

    console.log(userTitle);

    var file = "https://randomuser.me/api/";

    if (window.XMLHttpRequest) {
            var xhttp = new XMLHttpRequest();
        }else{
            var xhttp = new ActiveXObject ("Microsoft.XMLHTTP");
        }

    xhttp.open("GET", file, true); 
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            // console.log("Status HTTP :" + xhttp.status);
            // console.log("Status AJAX :" + xhttp.readyState);
            console.log("Réponse HTTP :" + xhttp.responseText);
            
            var ajax = JSON.parse(xhttp.responseText);
            
            console.log(ajax);
            console.log(ajax.results[0].name.first);

            userPicture.src = ajax.results[0].picture.large;
            userTitle.textContent = ajax.results[0].name.last[0].toUpperCase() + ' ' + ajax.results[0].name.first.substr(0,1).toUpperCase() + ajax.results[0].name.first.slice(1);
            userAdress.textContent = ajax.results[0].location.street; 
            userPays.textContent = ajax.results[0].location.city.toUpperCase(); 
            userEmail.textContent = ajax.results[0].email;
            // document.getElementById("cibleAjax03").innerHTML = result.indice;
        
        }
    }

    xhttp.send(); // on envoie la demande 
}


function ajax01(){
    console.clear();
    // console.log(document.getElementById("cibleAjax01").innerHTML);
    // console.log(window.onresize.target.innerHeight);
    var file = 'datas/datas_ajax_01.php';

    if (window.XMLHttpRequest) {
            var xhttp = new XMLHttpRequest();
        }else{
            var xhttp = new ActiveXObject ("Microsoft.XMLHTTP");
        }

    console.log(xhttp);
    var choix = document.getElementById('option01').value;
    var param = 'id='+choix;
    console.log(choix + ' ' + param);

    xhttp.open("POST", file, true); 

    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // ligne obligatoire pour post

    

    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            console.log("Status HTTP :" + xhttp.status);
            console.log("Status AJAX :" + xhttp.readyState);
            console.log("Réponse HTTP :" + xhttp.responseText);
            
            var result = JSON.parse(xhttp.responseText);
            
            console.log(result.indice);

            document.getElementById("cibleAjax03").innerHTML = result.indice;
        
        }
    }

    xhttp.send(param); // on envoie la demande 
}


function changerTitre(){
    console.clear();
    // console.log(document.getElementById("cibleAjax01").innerHTML);
    // console.log(window.onresize.target.innerHeight);
    var xhttp = new XMLHttpRequest();
    console.log(xhttp);

    xhttp.onreadystatechange = function(){
        
        console.log("Status HTTP :" + xhttp.status);
        console.log("Status AJAX :" + xhttp.readyState);
        // vérification de la réponse :
        if(xhttp.readyState == 4 && xhttp.status == 200){
            console.log("Réponse HTTP :" + xhttp.responseText);
            // document.getElementById("cibleAjax01").innerHTML = xhttp.responseText;
            document.getElementById("cibleAjax02").textContent = xhttp.responseText;
        }


    }
    // xhttp.open("GET", "ajax_info.txt", true); // on prépare la demande avec methode, fichier cible et type de la demande
    xhttp.open("GET", "datas/ajax_info.txt", true); // on prépare la demande avec methode, fichier cible et type de la demande
    xhttp.send(); // on envoie la demande 

}

function changerContenu(e){
    e.preventDefault();
    console.clear();
    // console.log(document.getElementById("cibleAjax01").innerHTML);
    // console.log(window.onresize.target.innerHeight);
    var xhttp = new XMLHttpRequest();
    console.log(xhttp);

    xhttp.onreadystatechange = function(){
        
        console.log("Status HTTP :" + xhttp.status);
        console.log("Status AJAX :" + xhttp.readyState);
        // vérification de la réponse :
        if(xhttp.readyState == 4 && xhttp.status == 200){
            console.log("Réponse HTTP :" + xhttp.responseText);
            // document.getElementById("cibleAjax01").innerHTML = xhttp.responseText;
            document.getElementById("cibleAjax02").textContent = xhttp.responseText;
        }

    }
    // xhttp.open("GET", "ajax_info.txt", true); // on prépare la demande avec methode, fichier cible et type de la demande
    xhttp.open("GET", "datas/ajax_info_text.txt", true); // on prépare la demande avec methode, fichier cible et type de la demande
    xhttp.send(); // on envoie la demande 

}
