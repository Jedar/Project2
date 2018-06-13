<?php require_once 'db_connect.php';?>
<?php
$cnn = getConnect();

function setBalance($userID,$balance){
    global $cnn;
    if ($balance <= 0){
        return false;
    }
    else{
        $query = "UPDATE users SET balance = $balance WHERE userID = $userID";
        $cnn->query($query);
        return true;
    }
}
function getBalance($userID){
    global $cnn;
    $query = "SELECT * FROM users WHERE userID = $userID";
    $result = $cnn->query($query);
    if ($row = $result->fetch_assoc()){
        return $row['balance'];
    }
    else{
        return false;
    }
}
?>