<!DOCTYPE html>
<html lang="en">
<?php $pagetype = 0;?>
<?php include 'head.inc.php'; ?>
<body>
<?php include 'nav.inc.php'; ?>
<?php
include 'db_connect.php';
$cnn = getConnect();
$query = "SELECT * FROM artworks ORDER BY view DESC LIMIT 0,3";
$resultView = $cnn->query($query);
$rowView = $resultView->fetch_assoc();
$query = "SELECT * FROM artworks ORDER BY timeReleased DESC LIMIT 0,3";
$resultTime = $cnn->query($query);
$rowTime = $resultTime->fetch_assoc();
function getDescription($des){
    if (strlen($des) > 300){
        return substr($des,0,300)."...";
    }
    else{
        return $des;
    }
}
?>
<div id="homeCarousel" class="carousel slide" data-ride="carousel">
    <!--首页导航栏-->
    <nav class="row justify-content-center home-nav">
        <div class="col-md-5 offset-md-1">
            <span class="home-logo">Art Store</span>
            <span class="logoBehind">Where you find GENIUS and EXTROORDINARY</span>
        </div>
        <div class="nav col-md-4 offset-md-2">
            <a href="home.php" class="nav-link">首页</a>
            <a href="search.php" class="nav-link">搜索</a>
            <a href="detail.php" class="nav-link">详情</a>
            <?php
            if ($_SESSION['isSigned']){
                echo '<a href="userpage.php" class="sign nav-link">个人</a>
            <a href="logout.php" class="register nav-link" data-toggle="modal" data-target="#confirm">登出</a>';
            }
            else{
                echo '<a href="login.php" class="sign nav-link">登陆</a>
            <a href="register.php" class="register nav-link">注册</a>';
            }
            ?>
        </div>
    </nav>
    <!-- 指示符 -->
    <ul class="carousel-indicators">
        <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#homeCarousel" data-slide-to="1"></li>
        <li data-target="#homeCarousel" data-slide-to="2"></li>
    </ul>
    <!-- 轮播图片 -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <?php
            echo '<img src="resources/img/'.$rowView['imageFileName'].'">
            <div class="carousel-caption">
                <h3>'.$rowView['title'].'</h3>
                <p>'.getDescription($rowView['description']).'</p>
                <button type="button" class="btn btn-light btn-lg" >Learn More</button>
            </div>';
            $rowView = $resultView->fetch_assoc();
            ?>
        </div>
        <div class="carousel-item">
            <?php
            echo '<img src="resources/img/'.$rowView['imageFileName'].'">
            <div class="carousel-caption">
                <h3>'.$rowView['title'].'</h3>
                <p>'.getDescription($rowView['description']).'</p>
                <button type="button" class="btn btn-light btn-lg" >Learn More</button>
            </div>';
            $rowView = $resultView->fetch_assoc();
            ?>
        </div>
        <div class="carousel-item">
            <?php
            echo '<img src="resources/img/'.$rowView['imageFileName'].'">
            <div class="carousel-caption">
                <h3>'.$rowView['title'].'</h3>
                <p>'.getDescription($rowView['description']).'</p>
                <button type="button" class="btn btn-light btn-lg" >Learn More</button>
            </div>';
            ?>
        </div>
    </div>
    <!-- 左右切换按钮 -->
    <a class="carousel-control-prev" href="#homeCarousel" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#homeCarousel" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>
<main class="container" id="home-hot-part">
    <div class="card">
        <h1 class="card-body">New Art Works</h1>
    </div>
    <hr>
    <div class="row featurette">
        <?php
        echo '<div class="col-md-7">
            <h2 class="featurete-heading">'.$rowTime['title'].'</h2>
            <p class="lead">'.getDescription($rowTime['description']).'</p>
            <button type="button" class="btn btn-primary">View Details</button>
        </div>
        <div class="col-md-5">
            <img src="resources/img/'.$rowTime['imageFileName'].'">
        </div>';
        $rowTime = $resultTime->fetch_assoc();
        ?>
    </div>
    <hr>
    <div class="row featurette">
        <?php
        echo '<div class="col-md-7 order-2">
            <h2 class="featurete-heading">'.$rowTime['title'].'</h2>
            <p class="lead">'.getDescription($rowTime['description']).'</p>
            <button type="button" class="btn btn-primary">View Details</button>
        </div>
        <div class="col-md-5 order-1">
            <img src="resources/img/'.$rowTime['imageFileName'].'">
        </div>';
        $rowTime = $resultTime->fetch_assoc();
        ?>
    </div>
    <hr>
    <div class="row featurette">
        <?php
        echo '<div class="col-md-7">
            <h2 class="featurete-heading">'.$rowTime['title'].'</h2>
            <p class="lead">'.getDescription($rowTime['description']).'</p>
            <button type="button" class="btn btn-primary">View Details</button>
        </div>
        <div class="col-md-5">
            <img src="resources/img/'.$rowTime['imageFileName'].'">
        </div>';
        ?>
    </div>
</main>
<?php include 'foot.inc.php';?>
</body>
</html>
