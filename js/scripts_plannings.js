function envoyerDemande() {
  var v1 = document.getElementById("j1").value;
  var v2 = document.getElementById("j2").value;
  var tabv1 = v1.split("-");
  var tabv2 = v2.split("-");
  var DateDeb = /*tabv1[1]+"-"+tabv1[0]+"-"+tabv1[2];//*/new Date(Number(tabv1[2]),Number(tabv1[1])-1,Number(tabv1[0]));
  var DateFin = /*tabv2[1]+"-"+tabv2[0]+"-"+tabv2[2];//*/new Date(Number(tabv2[2]),Number(tabv2[1])-1,Number(tabv2[0]));
  //var DateDeb = new Date(Number(tabv1[1]),Number(tabv1[0]),Number(tabv1[2]));
  //var DateFin = new Date(Number(tabv2[1]),Number(tabv2[0]),Number(tabv2[2]));
  var maintenant = new Date();
  var jour = maintenant.getDate();
  var mois = maintenant.getMonth();
  var annee = maintenant.getFullYear();
  var aujourdhui = new Date(annee,mois,jour);
  //alert("date début = " + DateDeb);
  //alert("date fin = " + DateFin);
  //alert("aujourd'hui = " + maintenant);
  if ((v1!='')&&(v2!='')&&(DateFin > DateDeb)&&(DateDeb >= aujourdhui)) {
    alert("votre demande a été transmise. Vous allez bientôt recevoir un mail de confirmation.");
    document.getElementById('formReserver').submit();
  } else if (DateFin <= DateDeb) {
    alert("Oups, vérifiez vos dates !");
  } else if (DateDeb < aujourdhui) {
    alert("Oups, votre date de début est incorrecte !");
  } else {
    alert("formulaire incomplet !");
  }
}