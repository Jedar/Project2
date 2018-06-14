<!DOCTYPE html>
<html lang="en">
<?php $pagetype = 3;?>
<?php include 'head.inc.php'; ?>
<body>
<?php include 'nav.inc.php'; ?>
<?php include 'carts_fns.php';?>
<main class="container">
    <div class="row justify-content-center">
        <aside class="user-data col-md-3">
            <?php
            echo '<table class="table table-hover ">
                <tr><td>用户:</td><td><span id="user-data-name">'.$_SESSION['name'].'</span> </td></tr>
                <tr><td>电话:</td><td><span id="user-data-phone">'.$_SESSION['tel'].'</span> </td></tr>
                <tr><td>邮箱:</td><td><span id="user-data-email">'.$_SESSION['email'].'</span> </td></tr>
                <tr><td>地址:</td><td><span id="user-data-address">'.$_SESSION['address'].'</span> </td></tr>
                <tr><td>余额:</td><td><span id="user-data-money">'.$_SESSION['balance'].'</span>  </td></tr>
            </table>';
            ?>
            <div class="text-right"><button type="button" id="bt-recharge" class="btn">充值</button> </div>
        </aside>
        <div class="col-md-8 offset-md-1">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#upload">Upload</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#purchase">Purchased</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#sold">Sold</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="upload" class="container tab-pane active"><br>
                    <table class="table table-hover">
                        <thead>我上传的艺术品：</thead>
                        <tbody>
                        <tr><th class="product-number">商品编号</th><th class="product-name">商品名称</th><th class="product-time">商品作者</th><th class="product-price">上传时间</th></tr>
                        <tr><td>#018951</td><td>The Man...</td><td>Polod</td><td>There is no...</td></tr>
                        <tr><td>#018969</td><td>Deo Pose</td><td>Stave</td><td>The painting is...</td></tr>
                        <tr><td>#045678</td><td>Lise Sods</td><td>Oaster</td><td>Oil on canvas</td></tr>
                        <tr><td>#014568</td><td>Mia Quad</td><td>Army</td><td>Famous art</td></tr>
                        <tr><td>#858788</td><td>Running Man</td><td>Jack</td><td>There is no...</td></tr>
                        </tbody>
                    </table>
                </div>
                <div id="purchase" class="container tab-pane fade"><br>
                    <table class="table table-hover">
                        <thead>我购买的艺术品：</thead>
                        <tbody>
                        <tr><th class="product-number">订单编号</th><th class="product-name">商品名称</th><th class="product-time">订单时间</th><th class="product-price">商品价格</th></tr>
                        <tr><td>#018896</td><td>The Man...</td><td>2018/2/11</td><td>$110</td></tr>
                        <tr><td>#018955</td><td>Tim One</td><td>2017/10/26</td><td>$778</td></tr>
                        </tbody>
                    </table>
                </div>
                <div id="sold" class="container tab-pane fade"><br>
                    <table class="table table-hover">
                        <thead>我卖出的艺术品：</thead>
                        <tbody>
                        <tr><th class="product-number">订单编号</th><th class="product-name">商品名称</th><th class="product-time">购买时间</th><th class="product-price">商品价格</th></tr>
                        <tr><td>#075896</td><td>Sad Pol</td><td>2018/1/5</td><td>$960</td></tr>
                        <tr><td>#543778</td><td>Family Time</td><td>2017/12/31</td><td>$888</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require 'foot.inc.php';?>
</body>
</html>
