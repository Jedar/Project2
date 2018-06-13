<?php require_once 'db_connect.php';?>
<?php
$cnn = getConnect();
define('ITEMNUM',9);

function getSearchResult($pageIndex){
    $pageIndex = intval($pageIndex);
    global $cnn;
    $info = (isset($_GET['info']))?$_GET['info']:"";
    $sort = (isset($_GET['sort']))?$_GET['sort']:"";
    $genre = (isset($_GET['genre']))?$_GET['genre']:"";
    $queryGenre = " AND genre = '$genre'";
    $queryInfo = " WHERE title LIKE '%$info%'";
    $querySort = " ORDER BY $sort";
    $query = "SELECT * FROM artworks";
    $query.=$queryInfo;
    if ($genre){
        $query.=$queryGenre;
    }
    if ($sort){
        $query.=$querySort;
    }
    $result=$cnn->query($query);
    $pageNum = ceil(($result->num_rows)/ITEMNUM);
    $numOfItems = (($result->num_rows)-$pageIndex*ITEMNUM > ITEMNUM)?ITEMNUM:(($result->num_rows)-$pageIndex*ITEMNUM);
    if ($pageIndex <0){
        $pageIndex = 0;
    }
    if ($pageIndex >= $pageNum){
        $pageIndex = $pageNum - 1;
    }
    $pageInfo = array();
    $result->data_seek($pageIndex*ITEMNUM);
    for ($i = $pageIndex*ITEMNUM; $i < $pageIndex*ITEMNUM +$numOfItems; $i++){
        $row=$result->fetch_assoc();
        $arr = [
            'artworkID'=>$row['artworkID'],
            'title'=>$row['title'],
            'imageFileName'=>$row['imageFileName'],
            'description'=>getIntroduction($row['description']),
            'view'=>$row['view'],
            'artist'=>$row['artist']
        ];
        array_push($pageInfo,$arr);
    }
    return ['pageNum'=>$pageNum,'numOfItems'=>$numOfItems,'pageInfo'=>$pageInfo];
}
function isExist_in_artworks($artworkID){
    global $cnn;
    $query = "SELECT * FROM artworks WHERE artworkID = $artworkID";
    $result = $cnn->query($query);
    return ($result->num_rows > 0);
}
function getOwner($artworkID){
    global $cnn;
    $query = "SELECT ownerID FROM artworks WHERE artworkID = $artworkID";
    $result = $cnn->query($query);
    $row = $result->fetch_assoc();
    return $row['ownerID'];
}
function setOwner($userID,$artworkID,$orderID){
    global $cnn;
    $orderID = intval($orderID);
    $query = "UPDATE artworks SET ownerID = $userID, orderID = $orderID WHERE artworkID = $artworkID";
    $stmt = $cnn->prepare($query);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}
function isOrdered($artworkID){
    global $cnn;
    $query = "SELECT * FROM artworks WHERE artworkID = $artworkID";
    $result = $cnn->query($query);
    $row = $result->fetch_assoc();
    return !is_null($row['orderID']);
}
function getPrice($artworkID){
    global $cnn;
    $query = "SELECT * FROM artworks WHERE artworkID = $artworkID";
    $result = $cnn->query($query);
    $row = $result->fetch_assoc();
    return $row['price'];
}
function view($artworkID){
    global $cnn;
    $query = "UPDATE artworks SET view=view+1 WHERE artworkID = $artworkID";
    $stmt = $cnn->prepare($query);
    $stmt->execute();
    return ($stmt->affected_rows > 0);
}
function getIntroduction($intr){
    $lastxEm = strpos($intr,'</em>',0)+6;
    $lastEm = strpos($intr,'<em>',0);
    $length = 80;
    if ($lastxEm > $length && $lastEm < $length){
        $length = $lastxEm + 3;
    }
    return substr($intr,0,$length).'...';
}
?>