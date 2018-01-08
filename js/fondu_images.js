$(function() {
    var i=0;
    //affiche();
    function affiche() {
        i++;
        if (i==1) precedent = '#img4'
        else precedent = '#img' + (i-1);
        var actuel = '#img' + i;
        $(precedent).fadeOut(1500);
        $(actuel).fadeIn(1500);
        if (i==4) i=0;
        //document.getElementById('pp').innerHTML = "précédent : " + precedent + "<br>actuel : " + actuel;
    }
    setInterval(affiche, 3000);
});