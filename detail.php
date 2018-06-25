<?php require 'db_connect.php';?>
<!DOCTYPE html>
<html lang="en">
<?php $pagetype = 1;?>
<?php include 'head.inc.php'; ?>
<body>
<?php include 'nav.inc.php'; ?>
<?php require_once 'artworks_fns.php';?>
<?php
if (!isset($_GET['itemID'])){
    $_GET['itemID'] = 347;
}
$userID = (isset($_SESSION['userID']))?$_SESSION['userID']:"";
$itemID = intval($_GET['itemID']);
view($itemID);//when one item is shown, the view will add one
$cnn = getConnect();
$query = "SELECT * FROM artworks WHERE artworkID = $itemID";
$result = $cnn->query($query);
$row = $result->fetch_assoc();
if (!$row){
    $itemID = 347;
    $query = "SELECT * FROM artworks WHERE artworkID = $itemID";
    $result = $cnn->query($query);
    $row = $result->fetch_assoc();
}
?>
<main class="row justify-content-center detail-main">
    <section class="detail-div col-md-8">
        <div class="container">
            <h2 class="goods-name"><?php echo $row['title'];?></h2>
            <a class="goods-author" href="search.php?typeartist=1&info=">By <?php echo $row['artist'];?></a>
        </div>
        <div class="row">
            <figure class="detail-fig col-md-5">
                <div class="box" id="box">
                    <?php
                    echo '<div id="smallBox" class="small">
                        <img src="resources/img/'.$row['imageFileName'].'" width="350" alt="'.$row['title'].'" />
                        <div id="mask" class="mask"></div>
                    </div>
                    <div id="bigBox" class="big">
                        <img src="resources/img/'.$row['imageFileName'].'" id="bigImg" width="800" alt="'.$row['title'].'" />
                    </div>';
                    ?>
                </div>
            </figure>
            <div class="col-md-7" id="details">
                <p class="introduction">Introduce: <?php echo $row['description'];?></p>
                <p class="price-p">price: <span id="price"><?php echo $row['price'];?></span> </p>
                <div>
                    <?php
                    if (!is_null($row['orderID'])){
                        echo '<div class="alert alert-info">This artwork has been sold out.</div>';
                    }elseif ($userID == $row['ownerID']){
                        echo '<div class="alert alert-info">You upload this artwork.</div>';
                    }
                    else{
                        if(!$_SESSION['isSigned']){
                            echo '<div class="alert alert-info">Please log in before add artwork to shopping cart.</div>';
                        }
                        echo '<button class="btn btn-primary btn-sm'.(!$_SESSION['isSigned']?' disabled':'').'"><i class="fa fa-star"></i> Add to Wish List</button>';
                        echo '<button id="bt-addToCart" class="btn btn-primary btn-sm'.(!$_SESSION['isSigned']?' disabled':'').'" data-target="'.$row['artworkID'].'"><i class="fa fa-shopping-cart"></i> Add to Shopping Cart</button>';
                    }
                    ?>
                </div>
                <?php
                echo '<table class="table table-striped">
                    <tr><th></th><th>Products Details</th></tr>
                    <tr><td>Date:</td><td>'.$row['yearOfWork'].'</td></tr>
                    <tr><td>Dimensions:</td><td>'.$row['height'].' cm * '.$row['width'].' cm'.'</td></tr>
                    <tr><td>Genres:</td><td>'.$row['genre'].'</td></tr>
                    <tr><td>Heat:</td><td>'.$row['view'].'</td></tr>
                </table>';
                ?>
            </div>
        </div>
    </section>
    <aside class="asideBar col-md-2">
        <div class="list-group" id="artist-list">
            <span class="list-group-item list-group-item-info">流行艺术家</span>
            <a href="search.php?typeartist=typeartist&info=Vincent Van Gogh" class="list-group-item list-group-item-action">Vincent Van Gogh</a>
            <a href="search.php?typeartist=typeartist&info=Pablo Picasso" class="list-group-item list-group-item-action">Pablo Picasso</a>
            <a href="search.php?typeartist=typeartist&info=Paul Cezanne" class="list-group-item list-group-item-action">Paul Cezanne</a>
            <a href="search.php?typeartist=typeartist&info=Raphael" class="list-group-item list-group-item-action">Raphael</a>
            <a href="search.php?typeartist=typeartist&info=Piero" class="list-group-item list-group-item-action">Piero</a>
            <a href="search.php?typeartist=typeartist&info=Henri Matisse" class="list-group-item list-group-item-action">Henri Matisse</a>
            <a href="search.php?typeartist=typeartist&info=Titian" class="list-group-item list-group-item-action">Titian</a>
        </div>
        <div class="list-group" id="genres-list">
            <span class="list-group-item list-group-item-info">流行流派</span>
            <a href="#" class="list-group-item list-group-item-action">Classic</a>
            <a href="#" class="list-group-item list-group-item-action">Cubuim</a>
            <a href="#" class="list-group-item list-group-item-action">Impresssion</a>
            <a href="#" class="list-group-item list-group-item-action">Banrosn</a>
            <a href="#" class="list-group-item list-group-item-action">nangsu</a>
        </div>
    </aside>
    <br>
</main>
<?php require 'foot.inc.php';?>
</body>
</html>
