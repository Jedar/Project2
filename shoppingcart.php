<!DOCTYPE html>
<html lang="en">
<?php $pagetype = 3;?>
<?php include_once 'head.inc.php'; ?>
<body>
<?php include_once 'nav.inc.php'; ?>
<?php include_once 'carts_fns.php';?>
<?php
$cartInfo = getCart($_SESSION['userID']);
$cartNum = count($cartInfo);
$totalPrice = 0;
function getIntroduction($intr){//repeat function
    $lastxEm = strpos($intr,'</em>',0)+6;
    $lastEm = strpos($intr,'<em>',0);
    $length = 80;
    if ($lastxEm > $length && $lastEm < $length){
        $length = $lastxEm + 3;
    }
    return substr($intr,0,$length).'...';
}
?>
<main>
    <h2 class="page-title">购物车</h2>
    <div class="item-wrapper">
        <?php
        if ($cartNum == 0){
            echo '<div class="alert alert-info">购物车里空空如也~~</div>';
        }
        for ($i = 0; $i < $cartNum; $i++){
            $totalPrice += $cartInfo[$i]['price'];
            echo '<div class="item-like" data-id="'.$cartInfo[$i]['artworkID'].'">
        <figure>
        <img src="resources/img/'.$cartInfo[$i]['imageFileName'].'">
        </figure>
        <div class="item-name">
        <h3>'.$cartInfo[$i]['title'].'</h3>
        <p>'.$cartInfo[$i]['artist'].'</p>
        <p>'.getIntroduction($cartInfo[$i]['description']).'</p>
        </div>
        <div>
        <button class="bt-price btn" data-id="'.$cartInfo[$i]['artworkID'].'"><i class="fa fa-star"></i> 价格:$<span class="item-price">'.$cartInfo[$i]['price'].'</span></button>
        <button class="bt-delete btn" data-id="'.$cartInfo[$i]['artworkID'].'"><i class="fa fa-sign-out"></i> 删除</button>
        </div>
        </div>';
        }
        ?>
        <div class="pay-div">
        <button id="bt-pay" class="btn"><i class="fa fa-back"></i>结款:$<?php echo $totalPrice;?></button>
        </div>
    </div>
</main>
<?php require 'foot.inc.php';?>
    </body>
</html>

