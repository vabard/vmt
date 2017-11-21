"use strict";


// =======================================================================================================
// =======================================       UTILITAIRES
// =======================================================================================================
function hello(event){
    // console.log(window.onresize);
    // console.log(window.onresize.target.innerHeight);
    console.clear();
    console.log(event.target.innerWidth);
    console.log(window.scrollY);
    }

function backgroundSlide(){
    // Renvoie un nombre entier aléatoire compris entre les arguments min et max inclus.
    // console.log(this);
    // var zebody = document.getElementsByTagName("body");
    // zebody.style.fontSize = "#ff0";
    }

function getRandomInteger(min, max){
    // Renvoie un nombre entier aléatoire compris entre les arguments min et max inclus.
    return Math.floor(Math.random() * (max - min + 1)) + min;
    }

function testlist(event){
    console.log(this);
    console.log(temp);
    }
