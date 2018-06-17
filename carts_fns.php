<?php include_once 'db_connect.php';?>
<?php
$cnn = getConnect();

function insert_carts($userID, $artworkID){
    global $cnn;
    $query = "INSERT INTO carts VALUES(NULL,?,?)";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param('dd',$userID,$artworkID);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        return true;
    }
    else{
        return false;
    }
}
function delete($userID, $artworkID){
    global $cnn;
    $query = "DELETE FROM carts WHERE artworkID = $artworkID AND userID = $userID";
    $stmt = $cnn->prepare($query);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        return true;
    }
    else{
        return false;
    }
}
function delete_by_id($artworkID){
    global $cnn;
    $query = "DELETE FROM carts WHERE artworkID = $artworkID";
    $stmt = $cnn->prepare($query);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        return true;
    }
    else{
        return false;
    }
}
function get_liker($artworkID){
    global $cnn;
    $query = "SELECT * FROM carts WHERE artworkID = $artworkID";
    $result = $cnn->query($query);
    $arr = array();
    while ($row = $result->fetch_assoc()){
        array_push($arr,$row);
    }
    return $arr;
}
function isExist_in_carts($userID,$artworkID){
    global $cnn;
    $query = "SELECT * FROM carts WHERE artworkID = $artworkID AND userID = $userID";
    $result = $cnn->query($query);
    return ($result->num_rows > 0);
}
function getCart($userID){
    global $cnn;
    $query = "SELECT artworks.artworkID, artworks.artist, artworks.imageFileName, artworks.title, artworks.price, artworks.orderID, artworks.description FROM artworks, carts WHERE carts.userID = $userID AND carts.artworkID = artworks.artworkID";
    $result = $cnn->query($query);
    $arr = array();
    while ($row = $result->fetch_assoc()){
        array_push($arr,$row);
    }
    return $arr;
}
function getCartNum($userID){
    $arr = getCart($userID);
    return count($arr);
}
function getCartPrice($userID){
    $arr = getCart($userID);
    $totalPrice = 0;
    for ($i = 0; $i < count($arr);$i++){
        $totalPrice+=$arr[$i]['price'];
    }
    return $totalPrice;
}
?>