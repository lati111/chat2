<?php
require json_decode(file_get_contents("../../config.json"), true, 512, JSON_THROW_ON_ERROR)["defaultPath"] . 'src/functions.PDO.php';


class message {
    private int $messageID;
    private int $receiverID;
    private int $senderID;
    private $timeSent;
    private $message;

    public function __construct($messageID) {
        $this->messageID = $messageID;

        $database = new database("chat");
        $db = $database->getConn();

        $sql = "SELECT * FROM messages WHERE ID = :messageID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":messageID", $messageID);
        $stmt->execute();
        $message = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->receiverID = $message["receiverID"];
        $this->senderID = $message["senderID"];
        $this->timeSent = $message["dateSent"];
        $this->message = $message["message"];
    }

    function getMessageDetails() {
        $database = new database("chat");
        $db = $database->getConn();

        $messageDetails = ["messageID" => $this->messageID];
        $messageDetails["senderID"] = $this->senderID;
        $messageDetails["receiverID"] = $this->receiverID;
        $messageDetails["message"] = $this->message;
        $messageDetails["timeSent"] = $this->timeSent;
        return $messageDetails;
    }


}