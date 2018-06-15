<?php require_once 'db_connect.php';?>
<?php
$cnn = getConnect();

function insert_orders($userID,$sum){
    global $cnn;
    $query = "INSERT INTO orders VALUES(NULL,?,?,NULL)";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param('dd',$userID,$sum);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        return $stmt->insert_id;
    }
    else{
        return false;
    }
}
?>