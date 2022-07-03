const form = document.querySelector(".typing-area"),
    destinatario = form.querySelector(".destinatario").value,
    inputField = form.querySelector(".input-field"),
    teste = document.getElementById("teste");
sendBtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box");


//prevents form from submitting??? nsei mas evita erros a submeter a msg
form.onsubmit = (e) => {
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = () => {
    if (inputField.value != "") {
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
}

//envia msg para a db
sendBtn.onclick = () => {
    //console.log(inputField.value)
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/message_sender.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = ""; //reset na area de escrita
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    /*for (var value of formData.values()) { //se a mensagem for rfrfrf, mostra brunie; aarf; rfrfrf
        teste.innerHTML += value;
        teste.innerHTML += "; ";
    }*/
    xhr.send(formData);
}

//deixa subir o chat sem puxar automaticamente para baixo; desativa scrollbottom
chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}

//update das msgs no chat sem recarregar a pagina
setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/message_getter.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("destinatario=" + destinatario);
    //teste.innerHTML += destinatario;
}, 500);

//mostra bottom do chat automaticamente
function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}