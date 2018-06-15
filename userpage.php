<!DOCTYPE html>
<html lang="en">
<?php $pagetype = 4;?>
<?php include 'head.inc.php'; ?>
<body>
<?php include 'nav.inc.php'; ?>
<?php include 'carts_fns.php';?>
<?php include_once 'artworks_fns.php';?>
<?php include_once 'orders_fns.php';?>
<?php
$userID = $_SESSION['userID'];
?>
<main class="container">
    <div class="row justify-content-center">
        <aside class="user-data col-md-3">
            <?php
            echo '<table class="table table-hover">
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
                        <tr><th>商品名称</th><th>商品作者</th><th>上传时间</th><th>修改</th><th>删除</th></tr>
                        <?php
                        $myUpload = getUpload($userID);
                        for ($i = 0; $i < count($myUpload);$i++){
                            echo '<tr><td><a href="detail.php?itemID='.$myUpload[$i]['artworkID'].'">'.$myUpload[$i]['title'].'</a></td><td>'.$myUpload[$i]['artist'].'</td><td>'.$myUpload[$i]['timeReleased'].'</td><td><button class="btn-primary btn">修改</button> </td><td><button type="button" class="btn btn-danger">删除</button> </td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div id="purchase" class="container tab-pane fade"><br>
                    <table class="table table-hover">
                        <thead>我购买的艺术品：</thead>
                        <tbody>
                        <tr><th>订单编号</th><th>艺术品名称</th><th>订单时间</th><th>订单金额</th></tr>
                        <?php
                        $arr = getPurchase($userID);
                        foreach ($arr as $value){
                            $artList = '<div class="list-group">';
                            for($i = 0; $i < count($value['title']); $i++){
                                $artList.='<a href="detail.php?itemID='.$value['artworkID'][$i].'" class="list-group-item list-group-item-action">'.$value['title'][$i].'</a>';
                            }
                            $artList.='</div>';
                            echo '<tr><td>#'.$value['orderID'].'</td><td>'.$artList.'</td><td>'.$value['timeCreated'].'</td><td>$'.$value['sum'].'</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div id="sold" class="container tab-pane fade"><br>
                    <table class="table table-hover">
                        <thead>我卖出的艺术品：</thead>
                        <tbody>
                        <tr><th>商品名称</th><th>商品价格</th><th>订单时间</th><th>购买者信息</th></tr>
                        <?php
                        $arr = getSell($userID);
                        foreach ($arr as $value){
                            $buyer = '<table class="table table-sm">
                <tr><td>用户:</td><td>'.$value['name'].'</td></tr>
                <tr><td>电话:</td><td>'.$value['tel'].'</td></tr>
                <tr><td>邮箱:</td><td>'.$value['email'].'</td></tr>
                <tr><td>地址:</td><td>'.$value['address'].'</td></tr>
                </table>';
                            echo '<tr><td><a href="detail.php?itemID='.$value['title'].'">'.$value['title'].'</a></td><td>$'.$value['price'].'</td><td>'.$value['timeCreated'].'</td><td>'.$buyer.'</td><td></td></tr>';
                        }
                        ?>
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
