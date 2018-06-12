<!DOCTYPE html>
<html lang="en">
<?php $pagetype = 3;?>
<?php include 'head.inc.php'; ?>
<body>
<?php include 'nav.inc.php'; ?>
<?php include 'carts_fns.php';?>
<?php
$cartInfo = getCart($_SESSION['userID']);
$cartNum = count($cartInfo);
?>
<main>
    <h2 class="page-title">购物车</h2>
    <div class="item-wrapper">
        <?php
        for ($i = 0; $i < $cartNum; $i++){
            echo '<div class="item-like">
        <figure>
        <img src="resources/img/'.$cartInfo[$i]['imageFileName'].'">
        </figure>
        <div class="item-name">
        <h3>'.$cartInfo[$i]['title'].'</h3>
        <p>'.$cartInfo[$i]['artist'].'</p>
        </div>
        <div>
        <button class="bt-price"><i class="fa fa-star"></i> 价格:$<span class="item-price">'.$cartInfo[$i]['price'].'</span></button>
        <button class="bt-delete"><i class="fa fa-sign-out"></i> 删除</button>
        </div>
        </div>';
        }
        ?>
<!--        <div class="item-like">-->
<!--        <figure>-->
<!--        <img src="images/works/square-medium/005060.jpg">-->
<!--        </figure>-->
<!--        <div class="item-name">-->
<!--        <h3>Still Life with bowl and Fruit</h3>-->
<!--        <p>Polod Picacco</p>-->
<!--        </div>-->
<!--        <div>-->
<!--        <button class="bt-price"><i class="fa fa-star"></i> 价格:$<span class="item-price">120.0000</span></button>-->
<!--        <button class="bt-delete"><i class="fa fa-sign-out"></i> 删除</button>-->
<!--        </div>-->
<!--        </div>-->
        <div class="pay-div">
        <button id="bt-pay"><i class="fa fa-back"></i>结款:$000</button>
        </div>
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

