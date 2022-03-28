<?php
session_start();
$url = "";
try {
    $url = json_decode(file_get_contents("config.json"), true, 512, JSON_THROW_ON_ERROR)["defaultPath"];
} catch (JsonException $e) {
}
if (!isset($_SESSION["ID"])) {
    header("Location: {$url}src/pages/chatbox.php");
}
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>log in</title>
    <link rel="stylesheet" href="<?php echo $url; ?>src/style/login.css">
</head>

<body>
<div id="loginForm">
    <div id="error"></div>
    <h1>log in</h1>
    <table>
        <tr>
            <td><span class="prepend"><b>gebruikersnaam</b></span></td>
            <td><label><input id="usernameField" type="text" name="username"></label></td>
        </tr>
        <tr>
            <td><span class="prepend"><b>wachtwoord</b></span></td>
            <td><label><input id="passwordField" type="text" name="password"></label></td>
        </tr>
    </table>
    <button id="loginButton" onclick="login()">log in</button>
    <span><a href="register.php">of maak een account aan</a></span>


</div>
<script>const relativePath = "";</script>
<script src="<?php echo $url; ?>src/scripts/config.js"></script>
<script src="<?php echo $url; ?>src/scripts/login.js"></script>
</body>
</html>
