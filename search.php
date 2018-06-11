<?php require 'db_connect.php';?>
<!DOCTYPE html>
<html lang="en">
<?php $pagetype = 2;?>
<?php include 'head.inc.php'; ?>
<body>
<?php include 'nav.inc.php'; ?>
<?php
define('ITEMNUM',9);
$cnn = getConnect();
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
$page = ceil(($result->num_rows)/ITEMNUM);
$pageIndex = 1;
$numOfItems = ($result->num_rows > ITEMNUM)?ITEMNUM:$result->num_rows;
$_SESSION['pageRows'] = $result;
function getIntroduction($intr){
    return substr($intr,0,80);
}
?>
<main>
    <h2 class="page-title">搜索结果:</h2>
    <div class="sortbar">
        <form method="get" action="" name="sort">
            <p>排序方式 &nbsp;
                价格:<input type="radio" name="sort" value="price">
                热度:<input type="radio" name="sort" value="view">
                标题:<input type="radio" name="sort" value="title"></p>
        </form>
    </div>
    <div class="item-box">
        <?php
        for ($i = 0; $i < $numOfItems; $i++){
            $row=$result->fetch_assoc();
            echo '<div class="item">
            <figure>
                <a href="detail.php?itemID='.$row['artworkID'].'"><img src="resources/img/'.$row['imageFileName'].'"></a>
            </figure>
            <div class="item-name">
                <h3>'.$row['title'].'</h3>
                <p>'.$row['artist'].'</p>
            </div>
            <p>'.getIntroduction($row['description']).'</p>
            <div>
                <a class="item-button" href="detail.php?itemID='.$row['artworkID'].'">查看</a>
                <a class="item-button" href="#">热度<span class="heat-number">'.$row['view'].'</span> </a>
            </div>
        </div>';
        }
        ?>
    </div>
    <div class="paging-div">
        <ul>
            <li><a href="#">< </a></li>
            <li><a href="#" class="paging-stay"> 1</a></li>
            <li><a href="#"> 2</a></li>
            <li><a href="#"> 3</a></li>
            <li><a href="#"> 4</a></li>
            <li><a href="#"> 5</a></li>
            <li><a href="#"> 6</a></li>
            <li><a href="#"> 7</a></li>
            <li><a href="#"> 8</a></li>
            <li><a href="#"> 9</a></li>
            <li><a href="#">10</a></li>
            <li><a href="#">11</a></li>
            <li><a href="#">12</a></li>
            <li><a href="#">13</a></li>
            <li><a href="#">14</a></li>
            <li><a href="#">15</a></li>
            <li><a href="#">16</a></li>
            <li><a href="#">17</a></li>
            <li><a href="#">18</a></li>
            <li><a href="#">19</a></li>
            <li><a href="#">20</a></li>
            <li><a href="#">></a></li>
        </ul>
    </div>
</main>
<?php require 'foot.inc.php';?>
</body>
</html>
