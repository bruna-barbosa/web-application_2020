var va = ["", "", "", "", ""];

function setvnom(x){
va[0] = x;
}

function setveml(x){
va[1] = x;
}

function setvdtr(x){
va[2] = x;
}

function setvconc(x){
va[3] = x;
}

function setvfreg(x){
va[4] = x;
}

function vsearch(){

var str = "";

if (va[0] != "") {
    if (str == "") {
    str = str + "nom=" + va[0];
    } else {
    str = str + "&nom=" + va[0];
    }
}

if (va[1] != "") {
    if (str == "") {
    str = str + "eml=" + va[1];
    } else {
    str = str + "&eml=" + va[1];
    }
}

if (va[2] != "") {
    if (str == "") {
    str = str + "dtr=" + va[2];
    } else {
    str = str + "&dtr=" + va[2];
    }
}

if (va[3] != "") {
    if (str == "") {
    str = str + "conc=" + va[3];
    } else {
    str = str + "&conc=" + va[3];
    }
}

if (va[4] != "") {
    if (str == "") {
    str = str + "freg=" + va[4];
    } else {
    str = str + "&freg=" + va[4];
    }
}

console.log(str);
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("vols").innerHTML = this.responseText;
    }
};
xhttp.open("GET", "admin_get_volunteers.php?"+str, true);
xhttp.send();
}