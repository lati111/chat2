<?php
session_start();
$url = "";
$relativePath = "../../";
try {
    $url = json_decode(file_get_contents($relativePath."config.json"), true, 512, JSON_THROW_ON_ERROR)["defaultPath"];
} catch (JsonException $e) {
}
if (isset($_SESSION["ID"])) {
    header("Location: {$url}src/pages/chatbox.php");
}
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="<?php echo $url; ?>src/style/login.css">
</head>

<body>
<div id="loginForm">
    <div id="error"></div>
    <h1>maak account aan</h1>
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
    <button id="loginButton" onclick="register()">registreer</button>
    <span><a href="<?php echo $url; ?>index.php">of log in</a></span>

    <script>const relativePath = "<?php echo $relativePath; ?>";</script>
    <script src="<?php echo $url; ?>src/scripts/config.js"></script>
    <script src="<?php echo $url; ?>src/scripts/login.js"></script>
</div>
</body>
</html>