var ia = ["", "", "", "", ""];

function setinom(x){
    ia[0] = x;
}

function setieml(x){
    ia[1] = x;
}

function setidtr(x){
    ia[2] = x;
}

function seticonc(x){
    ia[3] = x;
}

function setifreg(x){
    ia[4] = x;
}

function isearch(){

    var str = "";
    
    if (ia[0] != "") {
        if (str == "") {
        str = str + "nom=" + ia[0];
        } else {
        str = str + "&nom=" + ia[0];
        }
    }

    if (ia[1] != "") {
        if (str == "") {
        str = str + "eml=" + ia[1];
        } else {
        str = str + "&eml=" + ia[1];
        }
    }

    if (ia[2] != "") {
        if (str == "") {
        str = str + "dtr=" + ia[2];
        } else {
        str = str + "&dtr=" + ia[2];
        }
    }
    
    if (ia[3] != "") {
        if (str == "") {
        str = str + "conc=" + ia[3];
        } else {
        str = str + "&conc=" + ia[3];
        }
    }
    
    if (ia[4] != "") {
        if (str == "") {
        str = str + "freg=" + ia[4];
        } else {
        str = str + "&freg=" + ia[4];
        }
    }

    console.log(str);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("insts").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "admin_get_instituitions.php?"+str, true);
    xhttp.send();

}