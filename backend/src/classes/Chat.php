<?php
$relativePath = "../../";
require $relativePath . 'vendor/autoload.php';
require $relativePath . 'src/functions/PDO.php';

class Chat {
    private $db;
    private int $ID;
    private $pusher;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=chat", "root", "");
        $this->ID = $_SESSION["ID"];

        $this->pusher = new Pusher\Pusher(
            "68f57aa5e3617bb4abe6",
            "914344821ddc1802f0c3",
            "1340534",
            array('cluster' => 'eu')
        );
    }

    public function send(int $targetID, string $message): void{
        $sql = "INSERT INTO messages VALUES (DEFAULT, :senderID, :receiverID, :message, DEFAULT)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":senderID", $this->ID);
        $stmt->bindParam(":receiverID", $targetID);
        $stmt->bindParam(":message", $message);
        $stmt->execute();

        $this->pusher->trigger('chatterbox', "user{$targetID}", array('messageID' => $this->db->lastInsertId(), 'from' => $_SESSION["ID"]));
    }

    public function getMessages(int $senderID, int $offset = 0) {
        $sql = "SELECT * FROM messages WHERE (receiverID = :ID AND senderID = :senderID) OR (senderID = :ID AND receiverID = :senderID) ORDER BY ID DESC LIMIT 25 OFFSET $offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":ID", $_SESSION["ID"]);
        $stmt->bindParam(":senderID", $senderID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChats() {
        $sql = "SELECT senderID FROM messages WHERE receiverID = :ID GROUP BY senderID ORDER BY ID DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":ID", $_SESSION["ID"]);
        $stmt->execute();
        $chats = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $ID) {
            $chats[] = $ID["senderID"];
        }
        $sql = "SELECT receiverID FROM messages WHERE senderID = :ID GROUP BY receiverID ORDER BY ID DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":ID", $_SESSION["ID"]);
        $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $ID) {
            $chats[] = $ID["receiverID"];
        }
        return $chats;
    }
}