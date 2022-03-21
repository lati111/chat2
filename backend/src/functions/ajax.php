<?php
session_start();

if (isset($_POST["class"])) {
    $class = "";
    try {
        $path = json_decode(file_get_contents("../../config.json"), true, 512, JSON_THROW_ON_ERROR)["defaultPath"];
    } catch (JsonException $e) {
    }
    switch ($_POST["class"]) {
        case "chat":
            require $path . 'src\classes\chat.php';
            $class = new chat(); break;
        case "message":
            require $path . 'src\classes\message.php';
            $class = new message($_POST["constructArgs"][0]); break;
        case "users":
            require $path . 'src\classes\users.php';
            $class = new users(); break;
        default:
            exit();
    }
    try {
        $parameters = json_decode($_POST["parameters"], true, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
    }
    $response = call_user_func_array(array($class, $_POST["function"]), $parameters);
    try {
        echo json_encode($response, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
    }
}

