var pa = ["", "", "", "", ""];

function setpnif(x){
    pa[0] = x;
}

function setpact(x){
    pa[1] = x;
}

function setpdistr(x){
    pa[2] = x;
}

function setpconc(x){
    pa[3] = x;
}

function setpfreg(x){
    pa[4] = x;
}

function psearch(){

    var str = "";
    
    if (pa[0] != "") {
        if (str == "") {
        str = str + "pnif=" + pa[0];
        } else {
        str = str + "&pnif=" + pa[0];
        }
    }

    if (pa[1] != "") {
        if (str == "") {
        str = str + "pactv=" + pa[1];
        } else {
        str = str + "&pactv=" + pa[1];
        }
    }

    if (pa[2] != "") {
        if (str == "") {
        str = str + "pdistr=" + pa[2];
        } else {
        str = str + "&pdistr=" + pa[2];
        }
    }

    if (pa[3] != "") {
        if (str == "") {
        str = str + "pconce=" + pa[3];
        } else {
        str = str + "&pconce=" + pa[3];
        }
    }

    if (pa[4] != "") {
        if (str == "") {
        str = str + "pfregu=" + pa[4];
        } else {
        str = str + "&pfregu=" + pa[4];
        }
    }

    console.log(str);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("pjt").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "admin_get_projects.php?"+str, true);
    xhttp.send();

}