<?php require_once 'db_connect.php';?>
<?php
$cnn = getConnect();

function getMessageList($userID){
    global $cnn;
    $arr = array();
    $query = "SELECT messages.messageID, messages.content, messages.sendTime, messages.isRead, users.name FROM messages,users WHERE receiverID = $userID AND senderID = users.userID ORDER BY sendTime DESC";
    $result = $cnn->query($query);
    while ($row=$result->fetch_assoc()){
        array_push($arr,$row);
    }
    return $arr;
}
function sendMessage($userID,$receiver,$message){
    global $cnn;
    $query = "INSERT INTO messages (messageID,senderID,receiverID,content,sendTime,isRead)VALUES(NULL,?,?,?,NULL,0)";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param('dds',$userID,$receiver,$message);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        return true;
    }
    else{
        return false;
    }
}
function readMessage($messageID){
    global $cnn;
    $query = "UPDATE messages SET isRead = 1 WHERE messageID = $messageID";
    $stmt = $cnn->prepare($query);
    $stmt->execute();
    if ($stmt->errno == 0) {
        return true;
    }
    else{
        return false;
    }
}
function getNewMessageNum($userID){
    global $cnn;
    $query = "SELECT * FROM messages WHERE receiverID = $userID AND isRead = 0";
    $result = $cnn->query($query);
    return $result->num_rows;
}
function deleteMessage($messageID){
    global $cnn;
    $query = "DELETE FROM messages WHERE messageID = $messageID";
    $stmt = $cnn->prepare($query);
    $stmt->execute();
    if ($stmt->errno == 0){
        return true;
    }
    else
        return false;
}
?>