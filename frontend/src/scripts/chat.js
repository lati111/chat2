const pusher = new Pusher("68f57aa5e3617bb4abe6", {
    cluster: "eu",
});

let channel = pusher.subscribe('chatterbox');
channel.bind('user' + document.getElementById("userID").value, function(data) {
    receiveMessage(data.messageID, data.from)
});

let timer;

async function getChats() {
    const chats = await ajaxClass("chat", "getChats");
    console.log(chats)

    for (let i = 0; i < chats.length; i++) {
        await ajaxClass("users")

        addChat(chats[i], profile["username"]);
    }
}

function addChat(userID, username) {
    const chat = document.createElement("li");
    chat.classList.add("chat");
    chat.textContent = username;
    chat.id = "user_" + userID;
    chat.setAttribute("data-ID", userID)
    chat.addEventListener("click", loadChat, false);
    document.getElementById("incomingChats").prepend(chat);
}

function createMessage(messageID, messageText, datetime, sent = false) {
    const messageItem = document.createElement("li");
    messageItem.classList.add("message_in")
    messageItem.id = messageID;

    const message = document.createElement("span");
    message.textContent = messageText;
    message.classList.add("message");
    messageItem.append(message)

    const d = new Date();
    let timestamp = "";
    const months = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];
    let date = datetime.split(" ");
    let time = date[1].split(":"); date = date[0].split("-");
    if (parseInt(date[0]) !== d.getFullYear()) {
        timestamp = date[0];
    } else if (parseInt(date[1]) !== (d.getMonth() + 1)) {
        timestamp = date[2] + " " + months[parseInt(date[1])]
    } else {
        timestamp = time[0] + ":" + time[1] + ", " + date[2] + " " + months[parseInt(date[1])]
    }

    const timestampItem = document.createElement("span");
    timestampItem.textContent = timestamp + " ";
    timestampItem.classList.add("timestamp");
    messageItem.append(timestampItem)

    return messageItem;
}

async function receiveMessage(messageID, senderID) {
    console.log(document.getElementById("chatlog").getAttribute("data-current"), senderID.toString())
    if (document.getElementById("chatlog").getAttribute("data-current") === senderID.toString()) {
        let formData = new FormData();
        formData.append('messageID', messageID);

        const messageArray = await fetch("php/getMessage.php", {
            method: 'post',
            body: formData,
            headers: {'Accept': 'application/json'}})
            .then((response)=>response.json())
            .then((responseJson)=>{return responseJson});

        document.getElementById("chatlog").append(createMessage(messageArray["ID"], messageArray["message"], messageArray["timeSent"]))

    } else {
        if (document.getElementById("user_" + senderID) !== null) {
            const chat = document.getElementById("user_" + senderID);
            chat.classList.add("unreadChat");
            document.getElementById("incomingChats").prepend(chat);
        } else {
            let formData = new FormData();
            formData.append('userID', senderID);

            const profile = await fetch("php/getProfile.php", {
                method: 'post',
                body: formData,
                headers: {'Accept': 'application/json'}})
                .then((response)=>response.json())
                .then((responseJson)=>{return responseJson});

            const chat = document.createElement("li");
            chat.classList.add("chat");
            chat.classList.add("unreadChat");
            chat.textContent = profile["username"];
            chat.id = "user_" + senderID;
            chat.setAttribute("data-ID", senderID)
            chat.addEventListener("click", loadChat, false);
            document.getElementById("incomingChats").prepend(chat);
        }
    }
}

async function loadChat(e) {
    document.getElementById("chatTitle").textContent = e.target.textContent;
    document.getElementById("chatlog").setAttribute("data-current", e.target.getAttribute("data-ID"))

    let formData = new FormData();
    formData.append('senderID', e.target.getAttribute("data-ID"));

    const chatlog = await fetch("php/getChatlog.php", {
        method: 'post',
        body: formData,
        headers: {'Accept': 'application/json'}})
        .then((response)=>response.json())
        .then((responseJson)=>{return responseJson});

    for (let i = 0; i < chatlog.length; i++) {
        document.getElementById("chatlog").prepend(createMessage(chatlog[i]["ID"], chatlog[i]["message"], chatlog[i]["dateSent"]))
    }
}

function sendMessage() {
    const message = document.getElementById("messageInput").value;

    let http = new XMLHttpRequest();
    let url = 'php/sendMessage.php';
    let params = `ID=${document.getElementById("targetID").value}&message=${message}`;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            console.log(http.responseText);
        }
    }
    http.send(params);
}

async function searchUser() {
    clearTimeout(timer)
    if (document.getElementById("userSearch").value === "") {
        const elements = document.getElementsByClassName("searchResult");
        while(elements.length > 0){
            elements[0].parentNode.removeChild(elements[0]);
        } return;
    }
    timer = setTimeout(async () => {
        let formData = new FormData();
        formData.append('searchTerm', document.getElementById("userSearch").value);

        const results = await fetch("php/searchUser.php", {
            method: 'post',
            body: formData,
            headers: {'Accept': 'application/json'}})
            .then((response)=>response.json())
            .then((responseJson)=>{return responseJson});

        const elements = document.getElementsByClassName("searchResult");
        while(elements.length > 0){
            elements[0].parentNode.removeChild(elements[0]);
        }

        for (let i = 0; i < results.length; i++) {
            const result = document.createElement("li");
            result.textContent = results[i]["username"];
            result.setAttribute("data-ID", results[i]["ID"]);
            result.addEventListener("click", addUser, false);
            result.classList.add("searchResult");
            document.getElementById("searchList").append(result);
        }

    }, 1000);
}

function addUser(e) {
    const ID = e.target.getAttribute("data-ID");
    const username = e.target.textContent;


    if (document.getElementById("user_" + ID) === undefined) {
        addChat(ID, username);
    }

    const elements = document.getElementsByClassName("searchResult");
    while(elements.length > 0){
        elements[0].parentNode.removeChild(elements[0]);
    }
}