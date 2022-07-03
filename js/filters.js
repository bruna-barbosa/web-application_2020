// USER CC Nome3	Género	Idade5	Nascimento	Foto	E-mail8	Telemóvel	Distrito	Concelho	Freguesia	Carta
//Falta inicio, fim, areas, alvos e periodos
function admin_volunteers() {
    // var nameFilter, minFilter, maxFilter, locFilter, table, tr, i, n, a, l, nameValue, ageValue, locValue;
    var nameFilter, emailFilter, minAgeFilter, maxAgeFilter, districtFilter,  
        countyFilter, table, tr, n, e, a, d, c, i, nameValue, emailValue, 
        ageValue, districtValue, countyValue;
  
    // nameFilter = document.getElementById("myNameInput").value.toUpperCase();
    // inputMin = document.getElementById("myMinInput").value;
    // inputMax = document.getElementById("myMaxInput").value;
    // locFilter = document.getElementById("myLocInput").value.toUpperCase();
    nameFilter = document.getElementById("nameInput").value.toUpperCase();
    emailFilter = document.getElementById("emailInput").value.toUpperCase();
    minAgeFilter = document.getElementById("minAgeInput").value;
    maxAgeFilter = document.getElementById("maxAgeInput").value;
    districtFilter = document.getElementById("districtInput").value.toUpperCase();
    countyFilter = document.getElementById("countyInput").value.toUpperCase();
    
    // if (minFilter == '0') {
    //     minFilter = 0;
    // } else {
    //   minFilter = parseInt(minFilter) || "empty";
    // }
    
    // if (maxFilter == '0') {
    //   maxFilter = 0;
    // } else {
    //     maxFilter = parseInt(maxFilter) || "empty";
    // }
    if (minAgeFilter == '0') {
        minAgeFilter = 0;
    } else {
      minAgeFilter = parseInt(minAgeFilter) || "empty";
    }
    
    if (maxAgeFilter == '0') {
      maxAgeFilter = 0;
    } else {
        maxAgeFilter = parseInt(maxAgeFilter) || "empty";
    }

    // table = document.getElementById("myTable");
    // tr = table.getElementsByTagName("tr");
    table = document.getElementById("admin_volunteers");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
    //   n = tr[i].getElementsByTagName("td")[0];
    //   a = tr[i].getElementsByTagName("td")[1];
    //   l = tr[i].getElementsByTagName("td")[2];
        n = tr[i].getElementsByTagName("td")[3];
        e = tr[i].getElementsByTagName("td")[8];
        a = tr[i].getElementsByTagName("td")[5];
        d = tr[i].getElementsByTagName("td")[10];
        c = tr[i].getElementsByTagName("td")[11];
  
        // if (n && a && l) {
        if (n && e && a && d && c) {
            // nameValue = n.textContent || n.innerText;
            // ageValue = a.textContent || a.innerText;
            // locValue = l.textContent || l.innerText;
            // ageValue = parseInt(ageValue) || 0;
            nameValue = n.textContent || n.innerText;
            emailValue = e.textContent || e.innerText;
            ageValue = a.textContent || a.innerText;
            ageValue = parseInt(ageValue) || 0;
            districtValue = d.textContent || d.innerText;
            countyValue = c.textContent || c.innerText;
            
            // if (minFilter != "empty" && maxFilter != "empty") {
            if (minAgeFilter != "empty" && maxAgeFilter != "empty") {
            // if (nameValue.toUpperCase().indexOf(nameFilter) > -1 && locValue.toUpperCase().indexOf(locFilter) > -1 && minFilter <= ageValue && maxFilter >= ageValue) { 
                if (nameValue.toUpperCase().indexOf(nameFilter) > -1 && 
                    emailValue.toUpperCase().indexOf(emailFilter) > -1 && 
                    districtValue.toUpperCase().indexOf(districtFilter) > -1 && 
                    countyValue.toUpperCase().indexOf(countyFilter) > -1 && 
                    minAgeFilter <= ageValue && maxAgeFilter >= ageValue) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                    }
            // } else if (minFilter != "empty") {
            } else if (minAgeFilter != "empty") {
            // if (nameValue.toUpperCase().indexOf(nameFilter) > -1 && locValue.toUpperCase().indexOf(locFilter) > -1 && minFilter <= ageValue) {
                if (nameValue.toUpperCase().indexOf(nameFilter) > -1 && 
                    emailValue.toUpperCase().indexOf(emailFilter) > -1 && 
                    districtValue.toUpperCase().indexOf(districtFilter) > -1 && 
                    countyValue.toUpperCase().indexOf(countyFilter) > -1 && 
                    minAgeFilter <= ageValue) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            // } else if (maxFilter != "empty") {
            } else if (maxFilter != "empty") {
                if (nameValue.toUpperCase().indexOf(nameFilter) > -1 && 
                    emailValue.toUpperCase().indexOf(emailFilter) > -1 && 
                    districtValue.toUpperCase().indexOf(districtFilter) > -1 && 
                    countyValue.toUpperCase().indexOf(countyFilter) > -1 && 
                    maxFilter >= ageValue) { 
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            } else {
                if (nameValue.toUpperCase().indexOf(nameFilter) > -1 && 
                    emailValue.toUpperCase().indexOf(emailFilter) > -1 && 
                    districtValue.toUpperCase().indexOf(districtFilter) > -1 && 
                    countyValue.toUpperCase().indexOf(countyFilter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }      
    }
}

//Username  NIF  Nome2  Descrição  URL  Foto E-mail6  Telefone  Morada  Distrito9  Concelho10  Freguesia  Representante  E-mail Repr
function admin_instituitons() {
    var nameFilter, emailFilter, districtFilter, countyFilter, 
        table, tr, i, n, e, d, c, nameValue, emailValue, 
        districtValue, countyValue;
  
    nameFilter = document.getElementById("nameInput").value.toUpperCase();
    emailFilter = document.getElementById("emailInput").value.toUpperCase();
    districtFilter = document.getElementById("districtInput").value.toUpperCase();
    countyFilter = document.getElementById("countyInput").value.toUpperCase();

    table = document.getElementById("admin_institutions");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        n = tr[i].getElementsByTagName("td")[2];
        e = tr[i].getElementsByTagName("td")[6];
        d = tr[i].getElementsByTagName("td")[9];
        c = tr[i].getElementsByTagName("td")[10];
  
        if (n && e && d && c) {
            nameValue = n.textContent || n.innerText;
            emailValue = e.textContent || e.innerText;
            districtValue = d.textContent || d.innerText;
            countyValue = c.textContent || c.innerText;
            
            if (nameValue.toUpperCase().indexOf(nameFilter) > -1 && 
                emailValue.toUpperCase().indexOf(emailFilter) > -1 && 
                districtValue.toUpperCase().indexOf(districtFilter) > -1 && 
                countyValue.toUpperCase().indexOf(countyFilter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }  
    }
}

//ID Projeto Função Descrição Área Alvo Foto NIF Instituição  Instituição7  Distrito8  Concelho9  Freguesia10  Carta Vagas Início Fim Atividade15
function admin_projects() {
    var institutionFilter, districtFilter, countyFilter, parishFilter, 
        statusFilter, table, tr, j, i, d, c, p, s, institutionValue, 
        districtValue, countyValue, parishValue, statusValue ;

    institutionFilter = document.getElementById("institutionInput").value.toUpperCase();
    districtFilter = document.getElementById("districtInput").value.toUpperCase();
    countyFilter = document.getElementById("countyInput").value.toUpperCase();
    parishFilter = document.getElementById("parishInput").value.toUpperCase();
    statusFilter = document.getElementById("statusInput").value;

    if (statusFilter == "Ativa") {
        statusFilter = "1";
    } else {
        statusFilter = "0";
    }

    table = document.getElementById("admin_projects");
    tr = table.getElementsByTagName("tr");

    for (j = 0; j < tr.length; j++) {
        i = tr[j].getElementsByTagName("td")[7];
        d = tr[j].getElementsByTagName("td")[8];
        c = tr[j].getElementsByTagName("td")[9];
        p = tr[j].getElementsByTagName("td")[10];
        s = tr[j].getElementsByTagName("td")[15];

        if (i && d && c && p && s) {
            institutionValue = i.textContent || i.innerText;
            districtValue = d.textContent || d.innerText;
            countyValue = c.textContent || c.innerText;
            parishValue = p.textContent || p.innerText;
            statusValue = s.textContent || s.innerText;

            if (institutionValue.toUpperCase().indexOf(institutionFilter) > -1 && 
                districtValue.toUpperCase().indexOf(districtFilter) > -1 && 
                countyValue.toUpperCase().indexOf(countyFilter) > -1 && 
                parishValue.toUpperCase().indexOf(parishFilter) > -1 && 
                statusValue.toUpperCase().indexOf(statusFilter) > -1) {
                tr[j].style.display = "";
            } else {
                tr[j].style.display = "none";
            }
            
        }      
    }
}

//NIF instituição Instituição1  CC Voluntário Voluntário3
function admin_applications() {
    var institutionFilter, volunteerFilter, table, tr, j, i, v, 
        institutionValue, volunteerValue;

    institutionFilter = document.getElementById("institutionInput").value.toUpperCase();
    volunteerFilter = document.getElementById("volunteerInput").value.toUpperCase();
    
    table = document.getElementById("admin_applications");
    tr = table.getElementsByTagName("tr");

    for (j = 0; j < tr.length; j++) {
        i = tr[j].getElementsByTagName("td")[1];
        v = tr[j].getElementsByTagName("td")[3];

        if (i && v) {
            institutionValue = i.textContent || i.innerText;
            volunteerValue = v.textContent || v.innerText;

            if (institutionValue.toUpperCase().indexOf(institutionFilter) > -1 && 
                volunteerValue.toUpperCase().indexOf(volunteerFilter) > -1) {
                tr[j].style.display = "";
            } else {
                tr[j].style.display = "none";
            }   
        }      
    }
}