<?php
$relativePath = "../../";
require $relativePath."src/functions/PDO.php";

class users {
    private $key;

    /**
     * @throws JsonException
     */
    public function __construct() {
        $this->key = json_decode(file_get_contents("../../config.json"), true, 512, JSON_THROW_ON_ERROR)["key"];
    }


    public function regUser(string $username, string $password): string {
        $database = new database("chat");
        $db = $database->getConn();

        $sql = "INSERT INTO users VALUES (DEFAULT, :username, AES_ENCRYPT(:password, :key))";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":key", $this->key);
        $stmt->execute();

        $ID = $db->lastInsertId();
        $_SESSION["ID"] = $ID;
        $_SESSION["username"] = $_POST["username"];
        return $ID;
    }

    /**
     * @throws JsonException
     */
    public function getProfile($userID) {
        $database = new database("chat");
        $db = $database->getConn();

        $sql = "SELECT username FROM users WHERE ID = :userID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":userID", $userID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function loginverify(string $username, string $password) {
        $database = new database("chat");
        $db = $database->getConn();

        $sql = "SELECT ID FROM users WHERE username = :username AND AES_DECRYPT(password, :key) = :password";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":key", $this->key);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $ID = $stmt->fetch(PDO::FETCH_ASSOC)["ID"];
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["ID"] = $ID;
            return $ID;
        }

        return 0;
    }

    /**
     * @throws JsonException
     */
    public function searchUser($searchTerm) {
        $database = new database("chat");
        $db = $database->getConn();
        $sql = "SELECT ID, username FROM users WHERE username LIKE :searchTerm AND NOT ID = :ID";

        $search = "%" . $searchTerm . "%";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":searchTerm", $search);
        $stmt->bindParam(":ID", $_SESSION["ID"]);
        $stmt->execute();

        return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_THROW_ON_ERROR);
    }
}