<!DOCTYPE html>
<html lang="en">
<?php $pagetype = -2;?>
<?php include 'head.inc.php'; ?>
<body>
<?php include 'nav.inc.php'; ?>
<main class="register-img row">
    <div class="col-md-4 offset-md-6 card ">
        <div class="card-header">注册</div>
        <form class="card-body">
            <div class="form-group">
                <label>昵称：</label>
                <input class="form-control" type="text" id="register-name" name="name" placeholder="请输入用户名">
                <div class="conflictDiv hidden"><i class="fa fa-exclamation-circle fa-lg"></i> </div>
            </div>
            <div class="form-group">
                <label>密码：</label>
                <input class="form-control" type="password" id="register-psw" name="psw" placeholder="密码">
                <div class="conflictDiv hidden"><i class="fa fa-exclamation-circle fa-lg"></i> </div>
            </div>
            <div class="form-group">
                <label>确认密码：</label>
                <input class="form-control" type="password" id="register-sure" name="psw-sure" placeholder="确认密码">
                <div class="conflictDiv hidden"><i class="fa fa-exclamation-circle fa-lg"></i> </div>
            </div>
            <div class="form-group">
                <label>邮箱：</label>
                <input class="form-control" type="email" id="register-email" name="email" placeholder="邮箱">
                <div class="conflictDiv hidden"><i class="fa fa-exclamation-circle fa-lg"></i> </div>
            </div>
            <div class="form-group">
                <label>电话：</label>
                <input class="form-control" type="tel" id="register-phone" name="phone" placeholder="电话">
                <div class="conflictDiv hidden"><i class="fa fa-exclamation-circle fa-lg"></i> </div>
            </div>
            <div class="form-group">
                <label>地址：</label>
                <input class="form-control" type="text" id="register-address" name="address" placeholder="地址">
                <div class="conflictDiv hidden"><i class="fa fa-exclamation-circle fa-lg"></i> </div>
            </div>
            <div class="form-group">
                <label for="user-check">验证码：</label>
                <input class="form-control" type="text" id="user-check" name="user-check">
                <label class="check-number">1234</label>
                <div class="conflictDiv hidden"><i class="fa fa-exclamation-circle fa-lg"></i> </div>
            </div>
        </form>
        <div class="card-footer">
            <button type="button" class="btn btn-primary float-right" id="bt-register">注册</button>
        </div>
    </div>
</main>
<?php require 'foot.inc.php';?>
</body>
</html>
