// script pour afficher un aperçu de l'image à uploader
// source : http://www.xul.fr/html5/filereader.php
function imageHandler1(e2) { 
    var store = document.getElementById('imgstore1');
    store.innerHTML='<img class="imgcol" alt="imageColonne" src="' + e2.target.result +'">';
}
function imageHandler2(e2) { 
    var store = document.getElementById('imgstore2');
    store.innerHTML='<img class="imgcol" alt="imageColonne" src="' + e2.target.result +'">';
}
function imageHandler3(e2) { 
    var store = document.getElementById('imgstore3');
    store.innerHTML='<img class="imgcol" alt="imageColonne" src="' + e2.target.result +'">';
}
function imageHandler4(e2) { 
    var store = document.getElementById('imgstore4');
    store.innerHTML='<img class="imgcol" alt="imageColonne" src="' + e2.target.result +'">';
}
function imageHandler5(e2) { 
    var store = document.getElementById('imgstore5');
    store.innerHTML='<img class="imgcol" alt="imageColonne" src="' + e2.target.result +'">';
}
function imageHandler6(e2) { 
    var store = document.getElementById('imgstore6');
    store.innerHTML='<img class="imgcol" alt="imageColonne" src="' + e2.target.result +'">';
}
function imageHandler7(e2) { 
    var store = document.getElementById('imgstore7');
    store.innerHTML='<img class="imgcol" alt="imageColonne" src="' + e2.target.result +'">';
}
function imageHandler8(e2) { 
    var store = document.getElementById('imgstore8');
    store.innerHTML='<img class="imgcol" alt="imageColonne" src="' + e2.target.result +'">';
}
function imageHandler9(e2) { 
    var store = document.getElementById('imgstore9');
    store.innerHTML='<img class="imgcol" alt="imageColonne" src="' + e2.target.result +'">';
}
function imageHandler0(e2) { 
    var store = document.getElementById('imgstore0');
    store.innerHTML='<img class="imgcol" alt="imageColonne" src="' + e2.target.result +'">';
}
function loadimage1(e1) {
    var filename = e1.target.files[0]; 
    var fr = new FileReader();
    fr.onload = imageHandler1;  
    fr.readAsDataURL(filename); 
}
function loadimage2(e1) {
    var filename = e1.target.files[0]; 
    var fr = new FileReader();
    fr.onload = imageHandler2;  
    fr.readAsDataURL(filename); 
}
function loadimage3(e1) {
    var filename = e1.target.files[0]; 
    var fr = new FileReader();
    fr.onload = imageHandler3;  
    fr.readAsDataURL(filename); 
}
function loadimage4(e1) {
    var filename = e1.target.files[0]; 
    var fr = new FileReader();
    fr.onload = imageHandler4;  
    fr.readAsDataURL(filename); 
}
function loadimage5(e1) {
    var filename = e1.target.files[0]; 
    var fr = new FileReader();
    fr.onload = imageHandler5;  
    fr.readAsDataURL(filename); 
}
function loadimage6(e1) {
    var filename = e1.target.files[0]; 
    var fr = new FileReader();
    fr.onload = imageHandler6;  
    fr.readAsDataURL(filename); 
}
function loadimage7(e1) {
    var filename = e1.target.files[0]; 
    var fr = new FileReader();
    fr.onload = imageHandler7;  
    fr.readAsDataURL(filename); 
}
function loadimage8(e1) {
    var filename = e1.target.files[0]; 
    var fr = new FileReader();
    fr.onload = imageHandler8;  
    fr.readAsDataURL(filename); 
}
function loadimage9(e1) {
    var filename = e1.target.files[0]; 
    var fr = new FileReader();
    fr.onload = imageHandler9;  
    fr.readAsDataURL(filename); 
}
function loadimage0(e1) {
    var filename = e1.target.files[0]; 
    var fr = new FileReader();
    fr.onload = imageHandler0;  
    fr.readAsDataURL(filename); 
}
window.onload=function() {
    var y1 = document.getElementById("getimage1");
    var y2 = document.getElementById("getimage2");
    var y3 = document.getElementById("getimage3");
    var y4 = document.getElementById("getimage4");
    var y5 = document.getElementById("getimage5");
    var y6 = document.getElementById("getimage6");
    var y7 = document.getElementById("getimage7");
    var y8 = document.getElementById("getimage8");
    var y9 = document.getElementById("getimage9");
    var y0 = document.getElementById("getimage0");

    y1.addEventListener('change', loadimage1, false);
    y2.addEventListener('change', loadimage2, false);
    y3.addEventListener('change', loadimage3, false);
    y4.addEventListener('change', loadimage4, false);
    y5.addEventListener('change', loadimage5, false);
    y6.addEventListener('change', loadimage6, false);
    y7.addEventListener('change', loadimage7, false);
    y8.addEventListener('change', loadimage8, false);
    y9.addEventListener('change', loadimage9, false);
    y0.addEventListener('change', loadimage0, false);
}
function afficherLabelNP(t) {
    document.getElementById("labelNP"+t).style.display="inline";
}