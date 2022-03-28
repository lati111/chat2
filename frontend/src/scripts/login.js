function login() {
    const username = document.getElementById("usernameField").value;
    const password = document.getElementById("passwordField").value;
    if (username === "") {
        document.getElementById("error").textContent = "gebruikersnaam is niet ingevuld";
        setTimeout(function() {document.getElementById("error").textContent = ""}, 2000);
        return;
    } else if (password === "") {
        document.getElementById("error").textContent = "wachtwoord is niet ingevuld";
        setTimeout(function() {document.getElementById("error").textContent = ""}, 2000);
        return;
    }

    let http = new XMLHttpRequest();
    let url = '../php/loginVerify.php';
    let params = `username=${username}&password=${password}`;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            const responseID = http.responseText;
            if (parseInt(responseID) === 0) {
                document.getElementById("error").textContent = "gebruikersnaam of wachtwoord incorrect";
                setTimeout(function() {document.getElementById("error").textContent = ""}, 2000)
            } else {
                location.href = config + "src/pages/chatbox.php";
            }
        }
    }
    http.send(params);
}

function register() {
    const username = document.getElementById("usernameField").value;
    const password = document.getElementById("passwordField").value;
    if (username === "") {
        document.getElementById("error").textContent = "gebruikersnaam is niet ingevuld";
        setTimeout(function() {document.getElementById("error").textContent = ""}, 2000);
        return;
    } else if (password === "") {
        document.getElementById("error").textContent = "wachtwoord is niet ingevuld";
        setTimeout(function() {document.getElementById("error").textContent = ""}, 2000);
        return;
    }

    let http = new XMLHttpRequest();
    let url = '../php/regUser.php';
    let params = `username=${username}&password=${password}`;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            location.href = config + "src/pages/chatbox.php";
        }
    }
    http.send(params);
}