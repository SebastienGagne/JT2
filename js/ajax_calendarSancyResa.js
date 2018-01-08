function dates(i) {
    var tabMois=["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"];
    var tabMoisInverse = {"janvier":0,"février":1,"mars":2,"avril":3,"mai":4,"juin":5,"juillet":6,"août":7,"septembre":8,"octobre":9,"novembre":10,"décembre":11};
    var D = new Date(); 
    var month_year = "";
    var m = 0;
    var y = 2017;
    if (i == 0) {
        month_year = tabMois[D.getMonth()] + " " + D.getFullYear();
    } else {
        month_year = document.getElementById('moisannee').innerHTML;
        m = tabMoisInverse[month_year.split(" ")[0]];
        y = month_year.split(" ")[1];
        if (i == 1) {
            if (m == 11) {
                month_year = tabMois[0] + " " + (1 + Number(y));
            } else {
                month_year = tabMois[1 + Number(m)] + " " + Number(y);
            }
        } else {
            if (m == 0) {
                month_year = tabMois[11] + " " + (Number(y) - 1);
            } else {
                month_year = tabMois[Number(m) - 1] + " " + Number(y);
            }
        }
    }
    document.getElementById('moisannee').innerHTML = month_year;
    submitForm(document.getElementById('storage'));
}

function createInstance() {
    var req = null;
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                alert("XHR not created");
            }
        }
    }
    return req;
}

function storing(data, element) {
    element.innerHTML = data;
}

function submitForm(element) { 
    var req =  createInstance();
    var my = document.getElementById('moisannee').innerHTML;
    //alert(my);
    var tabMoisInverse = {"janvier":0,"février":1,"mars":2,"avril":3,"mai":4,"juin":5,"juillet":6,"août":7,"septembre":8,"octobre":9,"novembre":10,"décembre":11};
    var D = new Date();
    var m = Number(tabMoisInverse[my.split(" ")[0]]);
    var y = D.getFullYear();
    var data = "mois="+m+"&an="+y;
    //alert(data);
    req.onreadystatechange = function() { 
        if(req.readyState == 4) {
            if(req.status == 200) {
                //console.log(req.responseText);
                storing(req.responseText, element); 
            } else {
                alert("Error: returned status code " + req.status + " " + req.statusText);
            }   
        } 
    }; 
    req.open("POST", "view/sancy/ajax-get.php", true); 
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(data);
}

dates(0);