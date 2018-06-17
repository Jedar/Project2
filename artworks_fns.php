<?php include_once 'db_connect.php';?>
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
    $querySort = " ORDER BY $sort DESC";
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
function getArtwork($artworkID){
    global $cnn;
    $query = "SELECT * FROM artworks WHERE artworkID = $artworkID";
    $result = $cnn->query($query);
    $row = $result->fetch_assoc();
    return $row;
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
function setOwner($artworkID,$orderID){
    global $cnn;
    $orderID = intval($orderID);
    $query = "UPDATE artworks SET orderID = $orderID WHERE artworkID = $artworkID";
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
function getPath($artworkID){
    global $cnn;
    $query = "SELECT * FROM artworks WHERE artworkID = $artworkID";
    $result = $cnn->query($query);
    $row = $result->fetch_assoc();
    return $row['imageFileName'];
}
function getUpload($userID){
    global $cnn;
    $arr = array();
    $query = "SELECT * FROM artworks WHERE ownerID = $userID";
    $result = $cnn->query($query);
    while ($row=$result->fetch_assoc()){
        array_push($arr,$row);
    }
    return $arr;
}
function getPurchase($userID){
    global $cnn;
    $arr  = array();
    $query = "SELECT * FROM orders WHERE ownerID = $userID";
    $result = $cnn->query($query);
    while ($row = $result->fetch_assoc()){
        $row['artworkID'] = array();
        $row['title'] = array();
        $orderID = $row['orderID'];
        $queryx = "SELECT artworkID, title FROM artworks WHERE orderID = $orderID";
        $resultx = $cnn->query($queryx);
        while ($rowx = $resultx->fetch_assoc()){
            array_push($row['artworkID'],$rowx['artworkID']);
            array_push($row['title'],$rowx['title']);
        }
        array_push($arr,$row);
    }
    return $arr;
}
function getSell($userID){
    global $cnn;
    $arr = array();
    $query = "SELECT artworkID, title, price, orderID FROM artworks WHERE ownerID = $userID AND orderID IS NOT NULL";
    $result = $cnn->query($query);
    while ($row = $result->fetch_assoc()){
        $orderID = $row['orderID'];
        $queryx = "SELECT users.name, users.tel, users.email, users.address, orders.timeCreated FROM users, orders WHERE orders.orderID = $orderID AND orders.ownerID = users.userID";
        $resultx = $cnn->query($queryx);
        $rowx = $resultx->fetch_assoc();
        array_push($arr,array_merge($row,$rowx));
    }
    return $arr;
}
function deleteArtwork($userID,$artworkID){
    global $cnn;
    $query = "DELETE FROM artworks WHERE artworkID = $artworkID AND ownerID = $userID";
    $stmt = $cnn->prepare($query);
    $stmt->execute();
    if ($stmt->errno == 0){
        return true;
    }
    else
        return false;
}
function insertArtwork($userID,$artist,$title,$description,$yearOfWork,$genre,$width,$height,$price,$imgType){
    global $cnn;
    $query = "INSERT INTO artworks (artworkID,artist,title,description,yearOfWork,genre,width,height,price,view,ownerID,orderID,timeReleased)VALUES(NULL,?,?,?,?,?,?,?,?,0,?,NULL,NULL)";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param('sssdsdddd',$artist,$title,$description,$yearOfWork,$genre,$width,$height,$price,$userID);
    $stmt->execute();
    $artworkID = $stmt->insert_id;
    $imageFileName = ($artworkID).".".$imgType;
    if ($stmt->affected_rows > 0) {
        $queryx = "UPDATE artworks SET imageFileName = '$imageFileName' WHERE artworkID = $artworkID";
        $stmtx = $cnn->query($queryx);
        return $artworkID;
    }
    else{
        return false;
    }
}
function updateArtwork($userID,$artworkID,$artist,$title,$imageFileName,$description,$yearOfWork,$genre,$width,$height,$price){
    global $cnn;
    $query = "UPDATE artworks SET artist=?, title=?, imageFileName=?, description=?, yearOfWork=?, genre=?, width=?, height=?, price=? WHERE artworkID = $artworkID AND ownerID = $userID";
    $stmt = $cnn->prepare($query);
    $stmt->bind_param('ssssdsddd',$artist,$title,$imageFileName,$description,$yearOfWork,$genre,$width,$height,$price);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        return true;
    }
    else{
        return false;
    }
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