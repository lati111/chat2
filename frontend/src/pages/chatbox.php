<?php
session_start();
$url = "";
$backend = "";
$relativePath = "../../";
try {
    $config = json_decode(file_get_contents($relativePath."config.json"), true, 512, JSON_THROW_ON_ERROR);
    $url = $config["defaultPath"];
    $backend = $relativePath . $config["backendPath"];
} catch (JsonException $e) {
}
if (!isset($_SESSION["ID"])) {header("Location: {$url}index.php");}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>chatterbox</title>
    <link rel="stylesheet" href="<?php echo $url; ?>src/style/chat.css">
</head>
<body onload="getChats()">
<input type="hidden" id="userID" value="<?php echo $_SESSION["ID"] ?>">
<div id="usermenu">
    <b>je bent ingelogd als <?php echo $_SESSION["username"] ?></b>
</div>


<div id="chatInterface">
    <div id="chatList">
        <label id="userSearchContainer"><b>receiver ID:</b> <input type="number" id="targetID"></label>
        <div>
            <ul id="searchList">
                <li><label><input id="userSearch" type="text" placeholder="zoek gebruiker..." onkeyup="searchUser()"></label></li>
            </ul>

        </div>
        <ul id="incomingChats">

        </ul>
    </div>


    <div id="chatBox">
        <h4 id="chatTitle"></h4>
        <ul id="chatlog" data-current="0">

        </ul>
        <label for=""><b>message:</b> <input type="text" id="messageInput"></label>
        <button onclick="sendMessage()">verstuur</button>
    </div>
</div>

<script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>

<script>const relativePath = "<?php echo $relativePath; ?>";</script>
<script src="<?php echo $url; ?>src/scripts/config.js"></script>
<script src="<?php echo $url; ?>src/scripts/ajax.js"></script>
<script src="<?php echo $url; ?>src/scripts/chat.js"></script>
</body>
</html>
