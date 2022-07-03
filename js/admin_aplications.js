var ca = ["", "", ""];

function setcid(x){
    ca[0] = x;
}

function setci(x){
    ca[1] = x;
}

function setcv(x){
    ca[2] = x;
}

function csearch(){

    var str = "";

    if (ca[0] != "") {
        if (str == "") {
        str = str + "pid=" + ca[0];
        } else {
        str = str + "&pid=" + ca[0];
        }
    }

    if (ca[1] != "") {
        if (str == "") {
        str = str + "inom=" + ca[1];
        } else {
        str = str + "&inom=" + ca[1];
        }
    }

    if (ca[2] != "") {
        if (str == "") {
        str = str + "vnom=" + ca[2];
        } else {
        str = str + "&vnom=" + ca[2];
        }
    }

    console.log(str);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("aplications").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "admin_get_aplications.php?"+str, true);
    xhttp.send();
}